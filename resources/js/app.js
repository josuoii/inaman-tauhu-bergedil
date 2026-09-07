import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

/* ─────────────────────────────────────────────────────────────────────────────
   PRELOADER
   ───────────────────────────────────────────────────────────────────────────── */
const ilPre  = document.getElementById('il-preloader');
let   ilDone = false;

function ilFinish() {
    if (ilDone || !ilPre) return;
    ilDone = true;
    ilPre.classList.add('il-done');
    setTimeout(() => ilPre.remove(), 750);
}

if (ilPre) {
    window.addEventListener('load', () => setTimeout(ilFinish, 650));
    setTimeout(ilFinish, 3500);
}

/* ─────────────────────────────────────────────────────────────────────────────
   SCROLL REVEAL — IntersectionObserver adds .is-visible
   ───────────────────────────────────────────────────────────────────────────── */
function initScrollReveal() {
    const targets = document.querySelectorAll('.reveal-on-scroll');
    if (!targets.length) return;

    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -48px 0px' }
    );

    targets.forEach(el => io.observe(el));
}

/* ─────────────────────────────────────────────────────────────────────────────
   NUMBER COUNTER ANIMATION — animates [data-counter] attributes
   Usage: <span class="counter" data-target="100" data-suffix="%">0%</span>
   ───────────────────────────────────────────────────────────────────────────── */
function animateCounter(el) {
    const target  = parseInt(el.dataset.target, 10);
    const suffix  = el.dataset.suffix  ?? '';
    const prefix  = el.dataset.prefix  ?? '';
    const duration = parseInt(el.dataset.duration ?? '1200', 10);
    const start    = performance.now();

    function tick(now) {
        const elapsed  = now - start;
        const progress = Math.min(elapsed / duration, 1);
        // Ease-out cubic
        const eased    = 1 - Math.pow(1 - progress, 3);
        const current  = Math.round(eased * target);
        el.textContent = prefix + current + suffix;
        if (progress < 1) requestAnimationFrame(tick);
    }

    requestAnimationFrame(tick);
}

function initCounters() {
    const counters = document.querySelectorAll('[data-counter]');
    if (!counters.length) return;

    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    io.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.5 }
    );

    counters.forEach(el => io.observe(el));
}

/* ─────────────────────────────────────────────────────────────────────────────
   FLOATING WHATSAPP CTA — hide on hero, show after scrolling past it
   ───────────────────────────────────────────────────────────────────────────── */
function initFloatingCTA() {
    const floatBtn = document.getElementById('wa-float-btn');
    if (!floatBtn) return;

    // Show button after scrolling 400px
    const THRESHOLD = 380;

    function update() {
        if (window.scrollY > THRESHOLD) {
            floatBtn.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-6');
            floatBtn.classList.add('opacity-100', 'translate-y-0');
        } else {
            floatBtn.classList.add('opacity-0', 'pointer-events-none', 'translate-y-6');
            floatBtn.classList.remove('opacity-100', 'translate-y-0');
        }
    }

    window.addEventListener('scroll', update, { passive: true });
    update();
}

/* ─────────────────────────────────────────────────────────────────────────────
   MOBILE DRAWER NAV
   ───────────────────────────────────────────────────────────────────────────── */
function initMobileDrawer() {
    const openBtn  = document.getElementById('nav-open');
    const closeBtn = document.getElementById('nav-close');
    const drawer   = document.getElementById('mobile-drawer');
    const overlay  = document.getElementById('drawer-overlay');

    if (!openBtn || !drawer) return;

    function openDrawer() {
        drawer.classList.remove('translate-x-full');
        overlay?.classList.remove('opacity-0', 'pointer-events-none');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        drawer.classList.add('translate-x-full');
        overlay?.classList.add('opacity-0', 'pointer-events-none');
        document.body.style.overflow = '';
    }

    openBtn.addEventListener('click',  openDrawer);
    closeBtn?.addEventListener('click', closeDrawer);
    overlay?.addEventListener('click', closeDrawer);

    // Close on nav link click
    drawer.querySelectorAll('a').forEach(a => a.addEventListener('click', closeDrawer));
}

/* ─────────────────────────────────────────────────────────────────────────────
   ACTIVE NAV LINK HIGHLIGHT
   ───────────────────────────────────────────────────────────────────────────── */
function initActiveNav() {
    const path   = window.location.pathname;
    const links  = document.querySelectorAll('.nav-link');
    links.forEach(link => {
        const href = link.getAttribute('href');
        if (!href) return;
        // Check if current path starts with link href (for nested pages)
        const isActive = href === '/'
            ? path === '/'
            : path.startsWith(href);
        if (isActive) link.classList.add('active');
    });
}

/* ─────────────────────────────────────────────────────────────────────────────
   HEADER SHADOW ON SCROLL
   ───────────────────────────────────────────────────────────────────────────── */
function initHeaderScroll() {
    const header = document.getElementById('site-header');
    if (!header) return;

    window.addEventListener('scroll', () => {
        if (window.scrollY > 10) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }, { passive: true });
}

/* ─────────────────────────────────────────────────────────────────────────────
   INIT ALL
   ───────────────────────────────────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
    initScrollReveal();
    initCounters();
    initFloatingCTA();
    initMobileDrawer();
    initActiveNav();
    initHeaderScroll();
});
