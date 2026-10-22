import { alCambiarVista, clamp, efectosActivos } from './util.js';

// Pila de las páginas de servicios: el bloque [data-pila] queda fijo cuando su borde inferior llega al fondo de
// la pantalla y, mientras la sección [data-pila-tope] (la FAQ) sube sobre él, se achica, baja un poco, se
// desenfoca y lo cubre un velo blanco ([data-pila-velo]). Sin JS o con movimiento reducido no es sticky (input.css).
const PROFUNDIDAD = 0.06;
const DESENFOQUE = 10;

export function iniciarPila() {
    if (!efectosActivos()) return;

    const pila = document.querySelector('[data-pila]');
    const tope = document.querySelector('[data-pila-tope]');
    if (!pila || !tope) return;
    const velo = pila.querySelector('[data-pila-velo]');

    let arriba = null;
    alCambiarVista(() => {
        const vh = window.innerHeight;
        const top = Math.min(0, vh - pila.offsetHeight);
        if (top !== arriba) {
            arriba = top;
            pila.style.top = `${top}px`;
        }

        const p = clamp((vh - tope.getBoundingClientRect().top) / vh);
        pila.style.transform = p > 0 ? `scale(${(1 - PROFUNDIDAD * p).toFixed(4)}) translateY(${(p * vh * 0.06).toFixed(2)}px)` : '';
        if (velo) velo.style.opacity = Math.min(1, p * 1.25).toFixed(3);
        const blur = Math.min(1, p * 1.3) * DESENFOQUE;
        pila.style.filter = blur > 0.05 ? `blur(${blur.toFixed(2)}px)` : '';
    });
}
