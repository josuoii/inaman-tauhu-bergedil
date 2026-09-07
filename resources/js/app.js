

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const ilPre = document.getElementById('il-preloader');
let ilDone = false;

function ilFinish() {
    if (ilDone || !ilPre) return;
    ilDone = true;
    ilPre.classList.add('il-done');
    setTimeout(() => ilPre.remove(), 700);
}

if (ilPre) {
    window.addEventListener('load', () => setTimeout(ilFinish, 700));
    setTimeout(ilFinish, 3200);
}

// Hero 3D — load three as a separate chunk only when the hero canvas exists.
const hero3d = document.getElementById('hero-3d');
if (hero3d) {
    import('./three/hero3d.js').then(({ initHero3D }) => {
        const instance = initHero3D(hero3d);
        // Dispose on page unload to free GPU memory.
        window.addEventListener('pagehide', () => instance.dispose(), { once: true });
    }).catch((err) => {
        console.error('[hero3d] failed to initialise', err);
        // Fallback: hero.jpg remains visible (container is empty).
    });
}
