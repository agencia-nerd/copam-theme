import { alCambiarVista, clamp, efectosActivos } from './util.js';

const FONDO_ANCHO = 1224;
const FONDO_ALTO = 686;

// Seis etapas: el mapa de la izquierda pasa de una a otra y el texto de la derecha sube o baja.
export function iniciarConectividad() {
    const seccion = document.querySelector('[data-pin="conectividad"]');
    if (!seccion || !efectosActivos()) return;

    const escenario = seccion.querySelector('[data-conn-stage]');
    const fijo = seccion.querySelector('[data-pin-stage]');
    const figuras = [...seccion.querySelectorAll('[data-conn-figure]')];
    const medios = [...seccion.querySelectorAll('[data-conn-media]')];
    const pasos = [...seccion.querySelectorAll('[data-conn-step]')];
    const contador = seccion.querySelector('[data-conn-counter]');
    const n = figuras.length;
    if (!escenario || !fijo || n < 2) return;

    const pausa = 0.45; // alto de pantalla que se mantiene quieto al inicio
    seccion.style.height = `${(n - 1) * 75 + 100 + pausa * 100}vh`;

    const suavizar = (x) => x * 0.55 + (0.5 - 0.5 * Math.cos(Math.PI * x)) * 0.45;
    const mezclar = (a, b, p) => a.map((v, k) => v + (b[k] - v) * p);
    const proporcion = FONDO_ANCHO / FONDO_ALTO;
    let activa = -1;

    function marcarEtapa(indice) {
        if (indice === activa) return;
        activa = indice;
        pasos.forEach((paso, i) => {
            paso.classList.toggle('is-active', i === indice);
            paso.classList.toggle('is-before', i < indice);
            paso.classList.toggle('is-after', i > indice);
            paso.style.pointerEvents = i === indice ? 'auto' : 'none';
            paso.querySelectorAll('[data-conn-point]').forEach((punto, j) => {
                punto.style.transitionDelay = i === indice ? `${120 + j * 60}ms` : `${j * 30}ms`;
            });
        });
        if (contador) contador.style.transform = `translateY(${-indice * 1.2}em)`;
    }

    alCambiarVista(() => {
        const vh = window.innerHeight;
        const r = seccion.getBoundingClientRect();
        const ancho = escenario.offsetWidth;
        const espacio = vh - (escenario.getBoundingClientRect().top - fijo.getBoundingClientRect().top) - parseFloat(getComputedStyle(fijo).paddingBottom);
        const alto = Math.max(160, Math.min((ancho * 620) / 1132, espacio));
        escenario.style.height = `${alto}px`;

        // Rectángulos [x, y, ancho, alto]: la etapa visible ocupa casi todo el escenario y la
        // siguiente asoma pequeña en la esquina inferior derecha.
        const grande = [0, 0, (ancho * 880) / 1132, alto];
        const chicoAncho = (ancho * 220) / 1132;
        const chicoAlto = Math.min((alto * 260) / 620, chicoAncho * 1.35);
        const chico = [ancho - chicoAncho, alto - chicoAlto, chicoAncho, chicoAlto];

        const espera = vh * pausa;
        const total = Math.max(1, seccion.offsetHeight - vh - espera);
        const bruto = clamp((-r.top - espera) / total) * (n - 1);
        const tramo = Math.min(n - 2, Math.floor(bruto));
        const f = bruto - tramo;
        const g = suavizar(clamp((f - 0.02) / 0.76));
        const q = clamp((f - 0.8) / 0.18);

        figuras.forEach((figura, i) => {
            const medio = medios[i];
            let rect = grande;
            let recorte = 'inset(0 0 0 0)';
            let paralaje = 0;
            let visible = true;
            let z = 1;

            if (i === tramo) {
                const salida = suavizar(Math.min(1, g * 1.15));
                const k = 1 - 0.25 * salida;
                const w = grande[2] * k;
                const h = alto * k;
                rect = [-salida * (w + 8), -salida * h * 0.4, w, h];
                paralaje = salida * 6;
                visible = salida < 1;
                if (i === 0) recorte = `inset(${((1 - clamp(1 - r.top / (vh * 0.7))) * 100).toFixed(2)}% 0 0 0)`;
            } else if (i === tramo + 1) {
                rect = mezclar(chico, grande, g);
                z = 3;
                if (i === 1) recorte = `inset(${((1 - clamp(1 - r.top / (vh * 0.45))) * 100).toFixed(2)}% 0 0 0)`;
            } else if (i === tramo + 2) {
                rect = chico;
                z = 2;
                visible = q > 0;
                recorte = `inset(${((1 - q) * 100).toFixed(2)}% 0 0 0)`;
            } else {
                visible = false;
            }

            figura.style.visibility = visible ? 'visible' : 'hidden';
            if (!visible) return;

            figura.style.left = `${rect[0]}px`;
            figura.style.top = `${rect[1]}px`;
            figura.style.width = `${rect[2]}px`;
            figura.style.height = `${rect[3]}px`;
            figura.style.clipPath = recorte;
            figura.style.zIndex = z;

            const anchoImg = Math.max(rect[2], rect[3] * proporcion);
            medio.style.width = `${anchoImg}px`;
            medio.style.height = `${anchoImg / proporcion}px`;
            medio.style.transform = `translate(-50%,-50%) translateX(${paralaje}%)`;
        });

        marcarEtapa(Math.max(0, Math.min(n - 1, g >= 0.5 ? tramo + 1 : tramo)));
    });
}
