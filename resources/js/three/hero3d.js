import * as THREE from 'three';
import { RGBELoader } from 'three/examples/jsm/loaders/RGBELoader.js';
import { RoomEnvironment } from 'three/examples/jsm/environments/RoomEnvironment.js';

// Deterministic pseudo-random for reproducible geometry (no external dep).
function mulberry32(seed) {
    return function () {
        let t = (seed += 0x6d2b79f5);
        t = Math.imul(t ^ (t >>> 15), t | 1);
        t ^= t + Math.imul(t ^ (t >>> 7), t | 61);
        return ((t ^ (t >>> 14)) >>> 0) / 4294967296;
    };
}

// 3D value noise (hash-based) — 2 octaves for organic "isi" lumps.
function makeNoise3D() {
    const perm = new Uint8Array(512);
    const p = new Uint8Array(256);
    for (let i = 0; i < 256; i++) p[i] = i;
    // Shuffle with fixed seed for stable result across reloads.
    const rnd = mulberry32(20260907);
    for (let i = 255; i > 0; i--) {
        const j = Math.floor(rnd() * (i + 1));
        const tmp = p[i]; p[i] = p[j]; p[j] = tmp;
    }
    for (let i = 0; i < 512; i++) perm[i] = p[i & 255];

    const fade = (t) => t * t * t * (t * (t * 6 - 15) + 10);
    const lerp = (a, b, t) => a + t * (b - a);

    function hash(x, y, z) {
        return perm[x + perm[y + perm[z & 255] & 255] & 255] / 255;
    }

    function noise(x, y, z) {
        const X = Math.floor(x) & 255;
        const Y = Math.floor(y) & 255;
        const Z = Math.floor(z) & 255;
        const xf = x - Math.floor(x);
        const yf = y - Math.floor(y);
        const zf = z - Math.floor(z);
        const u = fade(xf);
        const v = fade(yf);
        const w = fade(zf);
        const n000 = hash(X, Y, Z);
        const n100 = hash(X + 1, Y, Z);
        const n010 = hash(X, Y + 1, Z);
        const n110 = hash(X + 1, Y + 1, Z);
        const n001 = hash(X, Y, Z + 1);
        const n101 = hash(X + 1, Y, Z + 1);
        const n011 = hash(X, Y + 1, Z + 1);
        const n111 = hash(X + 1, Y + 1, Z + 1);
        const x00 = lerp(n000, n100, u);
        const x10 = lerp(n010, n110, u);
        const x01 = lerp(n001, n101, u);
        const x11 = lerp(n011, n111, u);
        const y0 = lerp(x00, x10, v);
        const y1 = lerp(x01, x11, v);
        return lerp(y0, y1, w) * 2 - 1;
    }

    function fbm(x, y, z, octaves) {
        let amp = 0.5;
        let freq = 1;
        let sum = 0;
        let norm = 0;
        for (let i = 0; i < octaves; i++) {
            sum += amp * noise(x * freq, y * freq, z * freq);
            norm += amp;
            amp *= 0.5;
            freq *= 2;
        }
        return sum / norm;
    }

    return { noise, fbm };
}

// Build a warm studio environment map procedurally as fallback if HDRI fails.
function buildStudioEnvironment(renderer) {
    const pmrem = new THREE.PMREMGenerator(renderer);
    const scene = new THREE.Scene();
    const top = new THREE.DirectionalLight(0xfff2d0, 3);
    top.position.set(0, 3, 2);
    scene.add(top);
    const side = new THREE.DirectionalLight(0xffd9a0, 2);
    side.position.set(-3, 0, 1);
    scene.add(side);
    const rim = new THREE.DirectionalLight(0xbfd9ff, 1.2);
    rim.position.set(2, -1, -2);
    scene.add(rim);
    const amb = new THREE.AmbientLight(0xffe9c4, 0.5);
    scene.add(amb);
    const env = pmrem.fromScene(scene, 0.04);
    scene.traverse((o) => { if (o.isLight) scene.remove(o); });
    pmrem.dispose();
    return env;
}

export function initHero3D(container) {
    // --- Guard: WebGL2 support ---
    const gl = document.createElement('canvas').getContext('webgl2');
    if (!gl) {
        // Fallback: leave hero.jpg visible. Container stays transparent.
        return { dispose() {} };
    }

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const width = container.clientWidth || 600;
    const height = container.clientHeight || 600;

    let renderer;
    try {
        renderer = new THREE.WebGLRenderer({
            alpha: true,
            antialias: true,
            powerPreference: 'high-performance',
        });
    } catch (e) {
        return { dispose() {} };
    }
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
    renderer.setSize(width, height, false);
    renderer.outputColorSpace = THREE.SRGBColorSpace;
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.05;

    // Ensure the canvas sits above the fallback <img> and fills the container.
    renderer.domElement.style.position = 'absolute';
    renderer.domElement.style.inset = '0';
    renderer.domElement.style.width = '100%';
    renderer.domElement.style.height = '100%';
    renderer.domElement.style.zIndex = '1';

    container.appendChild(renderer.domElement);

    const scene = new THREE.Scene();
    scene.background = null; // transparent

    const camera = new THREE.PerspectiveCamera(32, width / height, 0.1, 50);
    camera.position.set(0, 0.35, 4.6);
    camera.lookAt(0, 0, 0);

    const pmrem = new THREE.PMREMGenerator(renderer);

    // --- IBL: try HDRI, fallback to procedural studio ---
    const envStore = { current: null, fallback: null };
    const timerIds = [];
    const rgb = new RGBELoader();
    rgb.setPath('').load(
        '/hdr/studio.hdr',
        (hdr) => {
            const tex = pmrem.fromEquirectangular(hdr).texture;
            envStore.current = tex;
            scene.environment = tex;
            hdr.dispose();
            pmrem.dispose();
        },
        undefined,
        () => {
            // network/file block -> procedural studio environment
            if (!envStore.fallback) {
                envStore.fallback = buildStudioEnvironment(renderer);
            }
            scene.environment = envStore.fallback.texture;
        }
    );

    // Failsafe after 6s: ensure environment exists even if callbacks stall.
    const failsafeTimeout = setTimeout(() => {
        if (!scene.environment) {
            if (!envStore.fallback) envStore.fallback = buildStudioEnvironment(renderer);
            scene.environment = envStore.fallback.texture;
        }
    }, 6000);
    timerIds.push(failsafeTimeout);

    // --- Lighting ---
    const keyLight = new THREE.DirectionalLight(0xffd9a0, 2.2);
    keyLight.position.set(3, 4, 3);
    scene.add(keyLight);
    const rimLight = new THREE.DirectionalLight(0xbfd9ff, 1.1);
    rimLight.position.set(-3, 1, -2.5);
    scene.add(rimLight);
    const hemi = new THREE.HemisphereLight(0xfff2d0, 0x8a4a20, 0.5);
    scene.add(hemi);

    // --- Procedural albedo texture (canvas noise on golden-brown) ---
    function buildAlbedoTexture() {
        const c = document.createElement('canvas');
        c.width = c.height = 512;
        const ctx = c.getContext('2d');
        const rnd = mulberry32(101);
        ctx.fillStyle = '#d99a3e';
        ctx.fillRect(0, 0, 512, 512);
        // Speckle — golden crisp flecks + darker toast spots.
        for (let i = 0; i < 4200; i++) {
            const x = rnd() * 512;
            const y = rnd() * 512;
            const r = rnd() * 3 + 0.8;
            const bright = rnd();
            if (bright > 0.62) ctx.fillStyle = 'rgba(243,199,120,0.9)';
            else if (bright > 0.35) ctx.fillStyle = 'rgba(180,110,40,0.55)';
            else ctx.fillStyle = 'rgba(110,60,20,0.5)';
            ctx.beginPath();
            ctx.arc(x, y, r, 0, Math.PI * 2);
            ctx.fill();
        }
        // Large soft mottling for oil sheen variation.
        const grad = ctx.createRadialGradient(120, 120, 10, 120, 120, 220);
        grad.addColorStop(0, 'rgba(255,214,140,0.25)');
        grad.addColorStop(1, 'rgba(120,64,24,0.18)');
        ctx.fillStyle = grad;
        ctx.fillRect(0, 0, 512, 512);
        const tex = new THREE.CanvasTexture(c);
        tex.colorSpace = THREE.SRGBColorSpace;
        tex.wrapS = tex.wrapT = THREE.RepeatWrapping;
        return tex;
    }

    // Build roughness map from the same albedo luminance.
    function buildRoughnessFromAlbedo(albedo) {
        const c = document.createElement('canvas');
        c.width = c.height = 512;
        const ctx = c.getContext('2d');
        ctx.drawImage(albedo.image, 0, 0);
        const img = ctx.getImageData(0, 0, 512, 512);
        const d = img.data;
        for (let i = 0; i < d.length; i += 4) {
            const lum = 0.299 * d[i] + 0.587 * d[i + 1] + 0.114 * d[i + 2];
            // Darker = crisp shiny (low roughness), brighter = soft matte (high).
            const rough = Math.min(0.92, Math.max(0.3, (lum / 255) * 0.7 + 0.25));
            const g = Math.round(rough * 255);
            d[i] = g; d[i + 1] = g; d[i + 2] = g;
        }
        ctx.putImageData(img, 0, 0);
        const tex = new THREE.CanvasTexture(c);
        tex.wrapS = tex.wrapT = THREE.RepeatWrapping;
        return tex;
    }

    const albedoTex = buildAlbedoTexture();
    const roughnessTex = buildRoughnessFromAlbedo(albedoTex);

    // --- Tauhu geometry: sphere + displacement noise + big "isi" lumps ---
    function buildTauhu() {
        const geo = new THREE.SphereGeometry(1, 128, 96);
        const pos = geo.attributes.position;
        const { fbm } = makeNoise3D();
        const tempV = new THREE.Vector3();
        const colors = new Float32Array(pos.count * 3);
        const bumps = [];

        for (let i = 0; i < pos.count; i++) {
            tempV.fromBufferAttribute(pos, i);
            const x = tempV.x, y = tempV.y, z = tempV.z;

            // 2-layer displacement: broad lumps + fine toast roughness.
            const broad = fbm(x * 1.6, y * 1.6, z * 1.6, 3);
            const fine = fbm(x * 5.5, y * 5.5, z * 5.5, 2);
            let d = 0.10 * broad + 0.035 * fine;

            // 3-5 distinct "isi" bumps on upper hemisphere (lip-side).
            const nx = tempV.clone().normalize();
            let lumps = 0;
            for (let k = 0; k < 4; k++) {
                const a = k * 2.39996323 + 0.7;
                const cx = Math.cos(a) * 0.55;
                const cz = Math.sin(a) * 0.55;
                const cy = 0.35 + (k % 2) * 0.25;
                const dx = (x - cx) / 0.42;
                const dy = (y - cy) / 0.5;
                const dz = (z - cz) / 0.42;
                const dist = Math.sqrt(dx * dx + dy * dy + dz * dz);
                if (dist < 1) {
                    lumps += Math.pow(1 - dist, 2) * 0.10;
                }
            }
            d += lumps;

            // Only push "isi" outward if on the upper hemisphere to form fillet.
            if (y > 0.05) d *= 1 + 0.06 * (y);

            tempV.setLength(1 + Math.max(0, d));
            geo.attributes.position.setXYZ(i, tempV.x, tempV.y, tempV.z);

            // Vertex color: valley -> toast brown, peak -> golden.
            const elevation = Math.max(0, d) / 0.3;
            const toastR = 0x8a / 255, toastG = 0x4a / 255, toastB = 0x20 / 255;
            const goldR = 0xd9 / 255, goldG = 0x9a / 255, goldB = 0x3e / 255;
            const t = Math.min(1, elevation);
            colors[i * 3] = toastR + (goldR - toastR) * t;
            colors[i * 3 + 1] = toastG + (goldG - toastG) * t;
            colors[i * 3 + 2] = toastB + (goldB - toastB) * t;
            bumps.push([nx.x, nx.y, nx.z, elevation]);
        }

        geo.setAttribute('color', new THREE.BufferAttribute(colors, 3));
        geo.computeVertexNormals();

        // Reposition to sit nicely in frame (denser at bottom? keep centered).
        geo.computeBoundingSphere();

        // Return bumps metadata for optional debug (not required at runtime).
        const mat = new THREE.MeshPhysicalMaterial({
            color: 0xffffff,
            map: albedoTex,
            roughnessMap: roughnessTex,
            roughness: 0.55,
            metalness: 0.0,
            sheen: 0.8,
            sheenColor: new THREE.Color(0xb3892f),
            sheenRoughness: 0.6,
            clearcoat: 0.15,
            clearcoatRoughness: 0.35,
            envMapIntensity: 1.0,
            vertexColors: true,
        });

        const mesh = new THREE.Mesh(geo, mat);
        mesh.scale.setScalar(0.72);
        return mesh;
    }

    const tauhuGroup = new THREE.Group();
    const tauhu = buildTauhu();
    tauhuGroup.add(tauhu);
    tauhuGroup.position.y = -0.05;
    scene.add(tauhuGroup);

    // --- Blob background sprites (brand-gold radial gradients) ---
    function makeBlob(color, size, x, y, opacity) {
        const c = document.createElement('canvas');
        c.width = c.height = 256;
        const ctx = c.getContext('2d');
        const g = ctx.createRadialGradient(128, 128, 0, 128, 128, 128);
        g.addColorStop(0, color);
        g.addColorStop(1, 'rgba(0,0,0,0)');
        ctx.fillStyle = g;
        ctx.fillRect(0, 0, 256, 256);
        const tex = new THREE.CanvasTexture(c);
        tex.colorSpace = THREE.SRGBColorSpace;
        const mat = new THREE.SpriteMaterial({
            map: tex,
            transparent: true,
            opacity,
            depthWrite: false,
        });
        const sprite = new THREE.Sprite(mat);
        sprite.scale.set(size, size, 1);
        sprite.position.set(x, y, -1.2);
        return sprite;
    }

    const blobGroup = new THREE.Group();
    const blobDefs = [
        ['rgba(212,168,67,0.55)', 5.0, -2.6, 0.7, 0.5],
        ['rgba(242,223,180,0.6)', 4.4, 2.7, -0.4, 0.5],
        ['rgba(244,224,178,0.5)', 3.6, 2.2, 1.4, 0.45],
        ['rgba(179,137,47,0.4)', 3.0, -2.2, -1.2, 0.4],
    ];
    const blobs = blobDefs.map(([c, s, x, y, o]) => {
        const b = makeBlob(c, s, x, y, o);
        blobGroup.add(b);
        b.userData = { baseX: x, baseY: y, amp: 0.25, speed: 0.5 + Math.random() * 0.4 };
        return b;
    });
    scene.add(blobGroup);

    // --- Steam particles ---
    function makeSteam(count) {
        const c = document.createElement('canvas');
        c.width = c.height = 64;
        const ctx = c.getContext('2d');
        const g = ctx.createRadialGradient(32, 32, 0, 32, 32, 32);
        g.addColorStop(0, 'rgba(255,255,255,0.55)');
        g.addColorStop(0.5, 'rgba(255,244,220,0.22)');
        g.addColorStop(1, 'rgba(255,255,255,0)');
        ctx.fillStyle = g;
        ctx.fillRect(0, 0, 64, 64);
        const tex = new THREE.CanvasTexture(c);
        tex.colorSpace = THREE.SRGBColorSpace;

        const positions = new Float32Array(count * 3);
        const sizes = new Float32Array(count);
        const seeds = new Float32Array(count);
        for (let i = 0; i < count; i++) {
            positions[i * 3] = (Math.random() - 0.5) * 0.8;
            positions[i * 3 + 1] = 0.1 + Math.random() * 0.4;
            positions[i * 3 + 2] = (Math.random() - 0.5) * 0.8;
            sizes[i] = 0.05 + Math.random() * 0.09;
            seeds[i] = Math.random() * Math.PI * 2;
        }
        const pGeo = new THREE.BufferGeometry();
        pGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        pGeo.setAttribute('aSize', new THREE.BufferAttribute(sizes, 1));
        pGeo.setAttribute('aSeed', new THREE.BufferAttribute(seeds, 1));

        const pMat = new THREE.ShaderMaterial({
            transparent: true,
            depthWrite: false,
            blending: THREE.AdditiveBlending,
            vertexShader: `
                attribute float aSize;
                attribute float aSeed;
                varying float vSeed;
                void main() {
                    vSeed = aSeed;
                    vec4 mv = modelViewMatrix * vec4(position, 1.0);
                    gl_PointSize = aSize * 320.0 / -mv.z;
                    gl_Position = projectionMatrix * mv;
                }
            `,
            fragmentShader: `
                uniform sampler2D uTex;
                uniform float uTime;
                varying float vSeed;
                void main() {
                    vec2 uv = gl_PointCoord;
                    vec4 tex = texture2D(uTex, uv);
                    float fade = 0.5 + 0.5 * sin(vSeed * 20.0 + uTime * 1.4);
                    gl_FragColor = vec4(tex.rgb, tex.a * fade);
                }
            `,
            uniforms: {
                uTex: { value: tex },
                uTime: { value: 0 },
            },
        });

        const points = new THREE.Points(pGeo, pMat);
        points.frustumCulled = false;
        return points;
    }

    const steamCount = window.innerWidth < 768 ? 55 : 110;
    const steam = makeSteam(steamCount);
    steam.position.y = 0.15;
    scene.add(steam);

    // --- Interaction ---
    const pointer = { x: 0, y: 0, px: 0, py: 0 };
    function onPointerMove(e) {
        const rect = container.getBoundingClientRect();
        pointer.x = ((e.clientX - rect.left) / rect.width) * 2 - 1;
        pointer.y = -(((e.clientY - rect.top) / rect.height) * 2 - 1);
    }
    function onTouchMove(e) {
        if (e.touches.length === 0) return;
        const rect = container.getBoundingClientRect();
        const t = e.touches[0];
        pointer.x = ((t.clientX - rect.left) / rect.width) * 2 - 1;
        pointer.y = -(((t.clientY - rect.top) / rect.height) * 2 - 1);
    }
    window.addEventListener('pointermove', onPointerMove, { passive: true });
    window.addEventListener('touchmove', onTouchMove, { passive: true });

    // --- Resize ---
    function onResize() {
        const w = container.clientWidth || 600;
        const h = container.clientHeight || 600;
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
        renderer.setSize(w, h, false);
    }
    const resizeObserver = new ResizeObserver(onResize);
    resizeObserver.observe(container);

    // --- Visibility / Intersection pause ---
    let visible = true;
    const io = new IntersectionObserver(([entry]) => {
        visible = entry.isIntersecting;
    }, { threshold: 0.02 });
    io.observe(container);
    let pageVisible = !document.hidden;
    function onVis() { pageVisible = !document.hidden; }
    document.addEventListener('visibilitychange', onVis);

    // --- Render loop ---
    const clock = new THREE.Clock();
    let rafId = 0;
    let disposed = false;

    function tick() {
        if (disposed) return;
        rafId = requestAnimationFrame(tick);
        if (!visible || !pageVisible) return;

        const dt = Math.min(clock.getDelta(), 0.05);
        const t = clock.elapsedTime;

        // Auto-rotate
        tauhuGroup.rotation.y += dt * 0.15;
        tauhuGroup.rotation.x = Math.sin(t * 0.25) * 0.04;

        // Parallax lerp toward pointer
        pointer.px += (pointer.x - pointer.px) * 0.05;
        pointer.py += (pointer.y - pointer.py) * 0.05;

        const sway = reducedMotion ? 0 : 1;
        tauhuGroup.position.x = pointer.px * 0.28 * sway;
        tauhuGroup.position.y = -0.05 + pointer.py * 0.18 * sway;

        // Blobs drift
        blobGroup.position.x = 0;
        for (let i = 0; i < blobs.length; i++) {
            const b = blobs[i];
            if (!reducedMotion) {
                b.position.x = b.userData.baseX + Math.sin(t * b.userData.speed + i) * b.userData.amp;
                b.position.y = b.userData.baseY + Math.cos(t * b.userData.speed * 0.7 + i) * b.userData.amp;
            }
        }

        // Steam rise
        if (!reducedMotion) {
            const posAttr = steam.geometry.attributes.position;
            const seeds = steam.geometry.attributes.aSeed.array;
            for (let i = 0; i < posAttr.count; i++) {
                let y = posAttr.getY(i) + dt * 0.22;
                if (y > 1.6) y = 0.05;
                posAttr.setY(i, y);
                const x = posAttr.getX(i) + Math.sin(t * 1.2 + seeds[i] * 6.0) * dt * 0.05;
                posAttr.setX(i, x);
            }
            posAttr.needsUpdate = true;
            steam.material.uniforms.uTime.value = t;
        }

        renderer.render(scene, camera);

        if (reducedMotion) {
            // Render exactly one static frame then stop.
            cancelAnimationFrame(rafId);
            return;
        }
    }

    if (reducedMotion) {
        // Single static render.
        renderer.render(scene, camera);
    } else {
        tick();
    }

    // --- Cleanup ---
    function dispose() {
        disposed = true;
        if (rafId) cancelAnimationFrame(rafId);
        window.removeEventListener('pointermove', onPointerMove);
        window.removeEventListener('touchmove', onTouchMove);
        document.removeEventListener('visibilitychange', onVis);
        io.disconnect();
        resizeObserver.disconnect();
        timerIds.forEach((id) => clearTimeout(id));
        scene.traverse((obj) => {
            if (obj.geometry) obj.geometry.dispose();
            if (obj.material) {
                const mats = Array.isArray(obj.material) ? obj.material : [obj.material];
                mats.forEach((m) => {
                    for (const key in m) {
                        if (m[key] && m[key].isTexture) m[key].dispose();
                    }
                    m.dispose();
                });
            }
        });
        albedoTex.dispose();
        roughnessTex.dispose();
        if (envStore.current) envStore.current.dispose();
        if (envStore.fallback) envStore.fallback.dispose();
        pmrem.dispose();
        renderer.dispose();
        if (renderer.domElement.parentNode === container) {
            container.removeChild(renderer.domElement);
        }
    }

    // Store timers for cleanup.
    return { dispose, renderer };
}
