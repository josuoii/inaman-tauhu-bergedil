

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
