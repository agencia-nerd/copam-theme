import { EASE_IN_OUT, EASE_OUT, efectosActivos } from './util.js';

// Animaciones de entrada: [estado inicial, estado final, duración en ms].
// El estado inicial también está en input.css (solo con la clase `js`) para que no haya parpadeo.
const ANIMACIONES = {
    rise: [{ transform: 'translateY(115%) rotate(4deg)' }, { transform: 'none' }, 1150],
    clip: [{ clipPath: 'inset(0 0 100% 0)', transform: 'translateY(28px)' }, { clipPath: 'inset(0 0 0% 0)', transform: 'none' }, 1200],
    lineX: [{ transform: 'scaleX(0)' }, { transform: 'scaleX(1)' }, 1100],
    lineY: [{ transform: 'scaleY(0)' }, { transform: 'scaleY(1)' }, 1300],
    icon: [{ transform: 'rotate(-180deg) scale(0)' }, { transform: 'none' }, 1000],
    band: [{ clipPath: 'inset(0 50% 0 50%)' }, { clipPath: 'inset(0 0% 0 0%)' }, 1400],
    card: [{ clipPath: 'inset(100% 0 0 0)', transform: 'translateY(80px)' }, { clipPath: 'inset(0% 0 0 0)', transform: 'none' }, 1150],
    side: [{ clipPath: 'inset(0 0 0 100%)' }, { clipPath: 'inset(0 0 0 0%)' }, 1300],
    pop: [{ transform: 'scale(0) rotate(-45deg)' }, { transform: 'none' }, 1000],
    wipe: [{ clipPath: 'inset(100% 0 0 0)', transform: 'translateY(60px)' }, { clipPath: 'inset(0% 0 0 0)', transform: 'none' }, 1300],
};

// Los textos que suben (rise) e íconos se observan por su contenedor, porque el elemento
// mismo está desplazado fuera de su máscara.
const objetivo = (el) => (el.dataset.sr === 'rise' || el.dataset.sr === 'icon' ? el.parentElement : el);

function revelar(el) {
    if (el.dataset.srDone) return;
    el.dataset.srDone = '1';

    const animacion = ANIMACIONES[el.dataset.sr];
    if (!animacion) return;

    // data-sr-fast acorta la animación (pie). data-sr-shadow quita el recorte al terminar para que se vea la sombra.
    const [desde, hasta, duracion] = animacion;
    const factor = el.dataset.srFast !== undefined ? 0.6 : 1;
    Object.assign(el.style, hasta);
    const animacionWeb = el.animate([desde, hasta], {
        duration: duracion * factor,
        delay: Number(el.dataset.srDelay || 0),
        easing: el.dataset.sr === 'rise' || el.dataset.sr === 'card' ? EASE_OUT : EASE_IN_OUT,
        fill: 'backwards',
    });
    if (el.dataset.srShadow !== undefined) {
        animacionWeb.onfinish = () => {
            el.style.clipPath = 'none';
        };
    }
}

// Observadores compartidos: los crea iniciarRevelado() y los reutiliza observarRevelado() con contenido nuevo.
let observadores = null;

export function iniciarRevelado() {
    if (!efectosActivos() || !('IntersectionObserver' in window)) return;

    const porObjetivo = new Map();
    const alEntrar = (observador) => (entradas) => {
        entradas.forEach((entrada) => {
            if (!entrada.isIntersecting) return;
            observador.unobserve(entrada.target);
            (porObjetivo.get(entrada.target) || []).forEach(revelar);
            porObjetivo.delete(entrada.target);
        });
    };
    const normal = new IntersectionObserver((e) => alEntrar(normal)(e), { rootMargin: '0px 0px -12% 0px' });
    // data-sr-early: se revela antes de entrar del todo (el logo del pie, al fondo de la página).
    const temprano = new IntersectionObserver((e) => alEntrar(temprano)(e), { rootMargin: '0px 0px 25% 0px' });

    observadores = { porObjetivo, normal, temprano };
    observarRevelado(document);
}

// Observa los [data-sr] dentro de `raiz` (p. ej. resultados que llegan por fetch). Sin efectos, no hace nada.
export function observarRevelado(raiz) {
    if (!observadores) return;
    const { porObjetivo, normal, temprano } = observadores;

    raiz.querySelectorAll('[data-sr]').forEach((el) => {
        if (el.dataset.srDone) return;
        const destino = objetivo(el);
        if (!porObjetivo.has(destino)) porObjetivo.set(destino, []);
        porObjetivo.get(destino).push(el);
        (el.dataset.srEarly !== undefined ? temprano : normal).observe(destino);
    });
}
