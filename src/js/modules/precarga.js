import { clamp } from './util.js';

// Precarga: el logo se llena como una ola de abajo hacia arriba mientras carga la página, y se despide.
// Solo aparece la primera vez de cada visita (sessionStorage) y con efectos activos: inc/head.php pone la clase
// `precarga` en <html> antes de pintar. Al terminar avisa con el evento `copam:listo` para que arranquen
// las animaciones de entrada (header, hero, aviso).

const SALIDA = 'cubic-bezier(.65,0,.35,1)';
const DURACION_MIN_MS = 2800;
const LIMITE_CARGA_MS = 7000;

// Contorno de la ola: un polígono cuya orilla superior se mueve con el tiempo y se aplana al llegar a 100 %.
function ola(progreso, t) {
    const amplitud = 9 * Math.min(1, (1 - progreso) * 6);
    const base = (1 - progreso) * (100 + 2 * amplitud) - amplitud;
    const puntos = [];
    for (let x = 0; x <= 100; x += 4) {
        const y = base + amplitud * Math.sin(x * 0.075 + t * 0.006) + amplitud * 0.45 * Math.sin(x * 0.19 - t * 0.009);
        puntos.push(`${x}% ${y.toFixed(2)}%`);
    }
    return `polygon(${puntos.join(',')},100% 100%,0% 100%)`;
}

export function iniciarPrecarga() {
    const html = document.documentElement;
    const cubierta = document.querySelector('[data-precarga]');
    if (!cubierta || !html.classList.contains('precarga')) return;

    const caja = cubierta.querySelector('[data-precarga-caja]');
    const base = cubierta.querySelector('[data-precarga-base]');
    const relleno = cubierta.querySelector('[data-precarga-relleno]');
    const logo = cubierta.querySelector('[data-precarga-logo]');

    const terminar = () => {
        try {
            sessionStorage.setItem('copam-pre', '1');
        } catch (e) {}
        html.style.overflow = '';
        html.classList.remove('precarga');
        cubierta.remove();
        document.dispatchEvent(new Event('copam:listo'));
    };
    if (!caja || !base || !relleno || !logo) return terminar();

    html.style.overflow = 'hidden';
    const imagenes = [...document.images].filter((img) => !cubierta.contains(img));
    const inicio = performance.now();
    let mostrado = 0;
    let cargada = document.readyState === 'complete';
    window.addEventListener('load', () => (cargada = true), { once: true });
    const tope = setTimeout(() => (cargada = true), LIMITE_CARGA_MS);

    const paso = (ahora) => {
        const parte = imagenes.length ? imagenes.filter((img) => img.complete).length / imagenes.length : 1;
        const meta = Math.min(cargada ? 1 : Math.min(0.9, 0.15 + parte * 0.75), (ahora - inicio) / DURACION_MIN_MS);
        mostrado += (meta - mostrado) * 0.08;
        if (meta >= 1 && 1 - mostrado < 0.003) mostrado = 1;
        relleno.style.clipPath = ola(clamp(mostrado), ahora);
        if (mostrado < 1) return requestAnimationFrame(paso);

        // Llena: el fondo pasa a blanco, el logo real aparece y todo se desvanece.
        clearTimeout(tope);
        relleno.style.clipPath = 'none';
        cubierta.style.transition = 'background-color .35s ' + SALIDA;
        cubierta.style.backgroundColor = '#fff';
        const opciones = { duration: 350, easing: SALIDA, fill: 'forwards' };
        caja.animate([{ transform: 'scale(1)' }, { transform: 'scale(1.07)' }], { duration: 420, easing: 'cubic-bezier(.22,1,.36,1)', fill: 'forwards' });
        base.animate([{ opacity: 1 }, { opacity: 0 }], opciones);
        relleno.animate([{ opacity: 1 }, { opacity: 0 }], opciones);
        logo.animate([{ opacity: 0 }, { opacity: 1 }], opciones);
        setTimeout(() => {
            caja.animate([{ opacity: 1, transform: 'scale(1.07)' }, { opacity: 0, transform: 'scale(1.02)' }], { duration: 280, easing: SALIDA, fill: 'forwards' });
            cubierta.animate([{ opacity: 1 }, { opacity: 0 }], { duration: 300, delay: 120, easing: SALIDA, fill: 'forwards' }).finished.then(terminar, terminar);
        }, 560);
    };

    // Empieza con la tipografía lista, como el diseño, para que el logo no parpadee.
    const arrancar = () => requestAnimationFrame(paso);
    if (document.fonts?.ready) document.fonts.ready.then(arrancar);
    else arrancar();
}
