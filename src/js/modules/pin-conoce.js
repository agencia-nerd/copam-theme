import { alCambiarVista, aplicarRetardos, clamp, efectosActivos } from './util.js';

// Tres paneles a pantalla completa que se cubren uno a otro mientras la sección está fijada.
export function iniciarConoce() {
    const seccion = document.querySelector('[data-pin="conoce"]');
    if (!seccion || !efectosActivos()) return;

    const paneles = [...seccion.querySelectorAll('[data-pin-panel]')];
    const imagenes = [...seccion.querySelectorAll('[data-pin-img]')];
    const barras = [...seccion.querySelectorAll('[data-pin-bar]')];
    const n = paneles.length;
    if (n < 2) return;

    // Altura del recorrido: un alto de pantalla por panel y un poco más para salir.
    seccion.style.height = `${n * 100 + 10}vh`;
    aplicarRetardos(seccion);
    paneles.slice(1).forEach((panel) => panel.classList.add('is-on'));

    alCambiarVista(() => {
        const vh = window.innerHeight;
        const r = seccion.getBoundingClientRect();
        const total = Math.max(1, seccion.offsetHeight - vh);
        const avance = clamp(-r.top / total);
        const t = avance * (n - 1);

        // El primer panel anima su texto cuando la sección ya ocupa casi toda la pantalla.
        paneles[0].classList.toggle('is-on', r.top < vh * 0.45);
        barras.forEach((barra) => {
            barra.style.transform = `scaleX(${avance.toFixed(4)})`;
        });

        for (let i = 1; i < n; i++) {
            const local = clamp(t - (i - 1));
            const lineal = clamp((local - 0.02) / 0.96);
            const e = lineal * 0.65 + (0.5 - 0.5 * Math.cos(Math.PI * lineal)) * 0.35;

            paneles[i].style.clipPath = `inset(${((1 - e) * 100).toFixed(3)}% 0 0 0)`;
            imagenes[i].style.transform = `translateY(${((1 - e) * 22).toFixed(3)}%)`;
            if (e > 0) imagenes[i - 1].style.transform = `translateY(${(-e * 12).toFixed(3)}%)`;
        }
        if (t === 0) imagenes[0].style.transform = `translateY(${((Math.max(0, r.top) / vh) * -8).toFixed(3)}%)`;
    });
}
