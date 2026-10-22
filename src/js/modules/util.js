// Curvas del diseño (las mismas que --ease-out y --ease-in-out de input.css).
export const EASE_OUT = 'cubic-bezier(.22,1,.36,1)';
export const EASE_IN_OUT = 'cubic-bezier(.77,0,.18,1)';

export const clamp = (valor, min = 0, max = 1) => Math.min(max, Math.max(min, valor));

// Los efectos solo corren con la clase `js` (la pone inc/head.php salvo con movimiento reducido).
export const efectosActivos = () => document.documentElement.classList.contains('js');

// Ejecuta `fn` una vez por fotograma tras un scroll o un cambio de tamaño, y una vez al empezar.
// Devuelve la función para pedir un recálculo manual.
export function alCambiarVista(fn) {
    let raf = 0;
    const pedir = () => {
        if (raf) return;
        raf = requestAnimationFrame(() => {
            raf = 0;
            fn();
        });
    };
    window.addEventListener('scroll', pedir, { passive: true });
    window.addEventListener('resize', pedir);
    fn();
    return pedir;
}

// Aplica el retardo de transición escrito en data-d="<ms>" a cada elemento animado por CSS.
export function aplicarRetardos(raiz) {
    raiz.querySelectorAll('[data-d]').forEach((el) => {
        el.style.transitionDelay = `${el.dataset.d}ms`;
    });
}

// Ejecuta `fn` cuando termina la precarga (evento `copam:listo`); si no hay precarga, de inmediato.
export function alListo(fn) {
    if (!document.documentElement.classList.contains('precarga')) return fn();
    document.addEventListener('copam:listo', fn, { once: true });
}
