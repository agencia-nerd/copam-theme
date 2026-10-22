import { alCambiarVista, aplicarRetardos, clamp, efectosActivos } from './util.js';

// La foto crece desde el centro hasta cubrir la pantalla y se oscurece; entonces suben los tipos de carga.
export function iniciarCarga() {
    const seccion = document.querySelector('[data-pin="carga"]');
    if (!seccion || !efectosActivos()) return;

    const recorte = seccion.querySelector('[data-carga-clip]');
    const imagen = recorte?.querySelector('img');
    const velo = seccion.querySelector('[data-carga-dim]');
    if (!recorte || !imagen) return;

    const pausa = 0.45;
    const oscuridad = 0.55;
    seccion.style.height = `${230 + pausa * 100}vh`;
    aplicarRetardos(seccion);

    alCambiarVista(() => {
        const vh = window.innerHeight;
        const vw = recorte.offsetWidth;
        const r = seccion.getBoundingClientRect();
        const espera = vh * pausa;
        const total = Math.max(1, seccion.offsetHeight - vh - espera);
        const p = clamp((-r.top - espera) / total);
        const lineal = clamp(p / 0.72);
        const e = lineal < 0.5 ? 4 * lineal ** 3 : 1 - (-2 * lineal + 2) ** 3 / 2;
        const entrada = clamp(1 - r.top / (vh * 0.8));

        // Tamaño inicial de la foto: ~58 % del ancho, con la proporción del diseño.
        const ancho0 = Math.min(vw * 0.583, vw - 40);
        const alto0 = Math.min((ancho0 * 544) / 1120, vh * 0.52);
        const ancho = ancho0 + (vw - ancho0) * e;
        const alto = alto0 + (vh - alto0) * e;
        const margenY = (vh - alto) / 2;
        const margenX = (vw - ancho) / 2;
        const arriba = margenY + (1 - entrada) * alto;
        const radio = (1 - e) * 3;

        recorte.style.clipPath = `inset(${arriba.toFixed(2)}px ${margenX.toFixed(2)}px ${margenY.toFixed(2)}px ${margenX.toFixed(2)}px round ${radio.toFixed(2)}px)`;
        const escala = Math.max(ancho / vw, alto / vh);
        imagen.style.transform = `scale(${(escala * (1 + (1 - entrada) * 0.12)).toFixed(4)})`;
        if (velo) velo.style.opacity = (e * oscuridad).toFixed(3);

        seccion.classList.toggle('is-on', lineal >= 0.98);
    });
}
