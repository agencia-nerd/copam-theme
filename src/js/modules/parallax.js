import { alCambiarVista, clamp, efectosActivos } from './util.js';

// Desplaza en vertical los elementos con data-parallax="<píxeles>" según su posición en la pantalla.
// data-parallax-zoom (hero de servicios): baja y se agranda con el scroll de la primera pantalla.
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

    document.querySelectorAll('[data-parallax-zoom]').forEach((el) => {
        alCambiarVista(() => {
            const vh = Math.max(1, window.innerHeight);
            const y = Math.min(Math.max(0, window.scrollY), vh);
            const zoom = 1 + Math.min(1, (y / vh) * 1.6) * 0.26;
            el.style.transform = `translate3d(0,${(y * 0.16).toFixed(2)}px,0) scale(${zoom.toFixed(4)})`;
        });
    });
}
