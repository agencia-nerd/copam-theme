import { alCambiarVista } from './util.js';

// Índice lateral de las páginas internas: marca con aria-current el enlace de la sección que se está leyendo.
// Una sección está "activa" cuando su borde superior pasó el tercio superior de la pantalla.
export function iniciarIndice() {
    document.querySelectorAll('[data-indice]').forEach((indice) => {
        const enlaces = [...indice.querySelectorAll('[data-indice-link]')];
        const secciones = enlaces
            .map((enlace) => document.getElementById(enlace.getAttribute('href').slice(1)))
            .map((seccion, i) => (seccion ? { seccion, enlace: enlaces[i] } : null))
            .filter(Boolean);
        if (!secciones.length) return;

        alCambiarVista(() => {
            const limite = window.innerHeight * 0.34;
            let activo = secciones[0];
            secciones.forEach((par) => {
                if (par.seccion.getBoundingClientRect().top <= limite) activo = par;
            });
            secciones.forEach((par) => {
                if (par === activo) par.enlace.setAttribute('aria-current', 'true');
                else par.enlace.removeAttribute('aria-current');
            });
        });
    });
}
