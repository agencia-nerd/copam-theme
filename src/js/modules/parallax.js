import { alCambiarVista, clamp, efectosActivos } from './util.js';

// Desplaza en vertical los elementos con data-parallax="<píxeles>" según su posición en la pantalla.
export function iniciarParalaje() {
    if (!efectosActivos()) return;

    document.querySelectorAll('[data-parallax-root]').forEach((raiz) => {
        const elementos = [...raiz.querySelectorAll('[data-parallax]')];
        if (!elementos.length) return;

        alCambiarVista(() => {
            const vh = window.innerHeight;
            const r = raiz.getBoundingClientRect();
            if (r.bottom < -50 || r.top > vh + 50) return;

            const centro = clamp((vh - r.top) / (vh + r.height)) - 0.5;
            elementos.forEach((el) => {
                el.style.transform = `translate3d(0,${(centro * Number(el.dataset.parallax)).toFixed(2)}px,0)`;
            });
        });
    });
}
