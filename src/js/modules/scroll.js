import { alListo } from './util.js';

// Desplazamiento de todo el sitio:
//  - rueda del mouse con inercia (scroll suave), salvo en pantallas táctiles o con "reducir movimiento";
//  - enlaces a anclas de la misma página: bajan con animación, dejan espacio para el header y marcan el destino;
//  - al cargar con #ancla en la URL, baja a ella.
// Los paneles con scroll propio (menú móvil, resultados del buscador) llevan data-native-scroll.

const SUAVIDAD = 0.085;
const EASE = (t) => 1 - Math.pow(1 - t, 3);
const TECLAS = { ArrowUp: 1, ArrowDown: 1, PageUp: 1, PageDown: 1, Home: 1, End: 1, ' ': 1, Spacebar: 1 };

const reducido = () => matchMedia('(prefers-reduced-motion: reduce)').matches;
const maxScroll = () => document.documentElement.scrollHeight - window.innerHeight;

let actual = 0;
let meta = 0;
let corriendo = false;
let raf = 0;
let ultimo = 0;
let desbloquear = null;
let marca = null;
let rafAncla = 0;

function detenerSuave() {
    if (!corriendo) return;
    corriendo = false;
    cancelAnimationFrame(raf);
}

function iniciarSuave() {
    if (reducido() || matchMedia('(hover: none) and (pointer: coarse)').matches) return;

    const paso = (ahora) => {
        const dt = Math.min(64, ahora - (ultimo || ahora));
        ultimo = ahora;
        const k = 1 - Math.pow(1 - SUAVIDAD, dt / 16.67 || 1);
        actual += (meta - actual) * k;
        if (Math.abs(meta - actual) < 1) {
            actual = meta;
            corriendo = false;
        }
        window.scrollTo(0, actual);
        if (corriendo) raf = requestAnimationFrame(paso);
    };

    window.addEventListener(
        'wheel',
        (e) => {
            if (e.ctrlKey || Math.abs(e.deltaX) > Math.abs(e.deltaY)) return;
            if (e.target.closest?.('[data-native-scroll], textarea')) return;
            e.preventDefault();
            let d = e.deltaY;
            if (e.deltaMode === 1) d *= 16;
            else if (e.deltaMode === 2) d *= window.innerHeight;
            if (!corriendo) actual = meta = window.scrollY;
            meta = Math.max(0, Math.min(maxScroll(), meta + d));
            if (!corriendo) {
                corriendo = true;
                ultimo = 0;
                raf = requestAnimationFrame(paso);
            }
        },
        { passive: false },
    );
    window.addEventListener('pointerdown', detenerSuave);
    window.addEventListener('keydown', detenerSuave);
}

// ── Anclas ───────────────────────────────────────────────────────────────────

// Resalta el destino: una línea verde sobre la línea punteada del título o, si no hay, un borde alrededor.
function marcarDestino(el) {
    marca?.();
    const reduce = reducido();
    const linea = [...el.querySelectorAll('[data-sr="lineX"]')].find((n) => /repeating-linear-gradient/.test((n.getAttribute('style') || '') + ' ' + (n.getAttribute('class') || '')));
    const anfitrion = linea || el;
    const posicionPrevia = anfitrion.style.position;
    if (getComputedStyle(anfitrion).position === 'static') anfitrion.style.position = 'relative';

    const o = document.createElement('span');
    o.setAttribute('aria-hidden', 'true');
    o.style.cssText = linea
        ? 'position:absolute;left:0;top:50%;width:100%;height:2px;margin-top:-1px;background:#0B8A3E;transform-origin:left center;pointer-events:none;transform:' + (reduce ? 'scaleX(1)' : 'scaleX(0)')
        : 'position:absolute;inset:0;box-sizing:border-box;border:2px solid #0B8A3E;border-radius:' + getComputedStyle(el).borderRadius + ';pointer-events:none;z-index:5;opacity:' + (reduce ? '1' : '0');
    anfitrion.appendChild(o);

    const temporizadores = [];
    const limpiar = () => {
        temporizadores.forEach(clearTimeout);
        o.remove();
        anfitrion.style.position = posicionPrevia;
        if (marca === limpiar) marca = null;
    };
    marca = limpiar;
    if (reduce) {
        temporizadores.push(setTimeout(limpiar, 1500));
        return;
    }
    void o.offsetWidth;
    if (linea) {
        o.style.transition = 'transform .4s cubic-bezier(.33,1,.68,1)';
        o.style.transform = 'scaleX(1)';
    } else {
        o.style.transition = 'opacity .3s ease';
        o.style.opacity = '1';
    }
    const entrada = linea ? 400 : 300;
    temporizadores.push(setTimeout(() => {
        o.style.transition = 'opacity .6s ease';
        o.style.opacity = '0';
    }, entrada + 1500));
    temporizadores.push(setTimeout(limpiar, entrada + 2100));
}

function irA(id) {
    const arriba = id === '__arriba';
    const el = arriba ? document.documentElement : document.getElementById(id);
    if (!el) return;

    detenerSuave();
    cancelAnimationFrame(rafAncla);
    desbloquear?.();
    marca?.();

    const header = document.querySelector('[data-header]');
    const margen = () => Math.round(header?.getBoundingClientRect().height || 64) + (window.innerWidth < 760 ? 24 : 40);
    const destino = () => Math.max(0, Math.min(maxScroll(), el.getBoundingClientRect().top + window.scrollY - margen()));
    const saltar = (y) => {
        window.scrollTo(0, y);
        actual = meta = y;
    };

    const desde = window.scrollY;
    const hasta = destino();
    const distancia = Math.abs(hasta - desde);
    if (distancia < 2) return arriba || marcarDestino(el);
    if (reducido()) {
        saltar(hasta);
        requestAnimationFrame(() => {
            saltar(destino());
            if (!arriba) marcarDestino(el);
        });
        return;
    }

    const duracion = Math.min(700, Math.max(350, distancia * 0.25));
    const t0 = performance.now();

    // Mientras baja, se bloquea la rueda, el toque y las teclas para que el usuario no la interrumpa a medias.
    const bloquear = (e) => e.cancelable && e.preventDefault();
    const bloquearTecla = (e) => {
        const tg = e.target;
        const escribiendo = tg && (tg.isContentEditable || /^(INPUT|TEXTAREA|SELECT)$/.test(tg.tagName));
        if (TECLAS[e.key] && !escribiendo) e.preventDefault();
    };
    const opciones = { passive: false };
    window.addEventListener('wheel', bloquear, opciones);
    window.addEventListener('touchmove', bloquear, opciones);
    window.addEventListener('keydown', bloquearTecla, opciones);
    let seguridad = 0;
    const liberar = () => {
        window.removeEventListener('wheel', bloquear, opciones);
        window.removeEventListener('touchmove', bloquear, opciones);
        window.removeEventListener('keydown', bloquearTecla, opciones);
        clearTimeout(seguridad);
        if (desbloquear === liberar) desbloquear = null;
    };
    desbloquear = liberar;
    seguridad = setTimeout(() => {
        cancelAnimationFrame(rafAncla);
        liberar();
    }, 1000);

    const paso = (ahora) => {
        const t = Math.min(1, (ahora - t0) / duracion);
        saltar(desde + (hasta - desde) * EASE(t));
        if (t < 1) {
            rafAncla = requestAnimationFrame(paso);
            return;
        }
        liberar();
        const ajuste = destino();
        if (Math.abs(ajuste - window.scrollY) > 1) saltar(ajuste);
        requestAnimationFrame(() => {
            const final = destino();
            if (Math.abs(final - window.scrollY) > 1) saltar(final);
            if (!arriba) marcarDestino(el);
        });
    };
    rafAncla = requestAnimationFrame(paso);
}

const rutaSinBarra = (ruta) => decodeURIComponent(ruta).replace(/\/+$/, '') || '/';

function iniciarAnclas() {
    document.addEventListener('click', (e) => {
        if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
        const enlace = e.target.closest?.('a[href]');
        if (!enlace || enlace.target) return;
        const href = enlace.getAttribute('href');
        if (href === '#') return e.preventDefault();
        if (!href || /^(mailto:|tel:|javascript:)/i.test(href)) return;

        let url;
        try {
            url = new URL(href, location.href);
        } catch (err) {
            return;
        }
        if (url.origin !== location.origin || rutaSinBarra(url.pathname) !== rutaSinBarra(location.pathname)) return;
        const id = decodeURIComponent(url.hash.slice(1));
        if (!id || !document.getElementById(id)) return;

        e.preventDefault();
        document.dispatchEvent(new Event('copam:cerrar-paneles'));
        if (url.hash !== location.hash) history.pushState({ copamAncla: id }, '', url.pathname + url.search + url.hash);
        irA(id);
    });
    window.addEventListener('popstate', () => {
        const id = decodeURIComponent(location.hash.slice(1));
        irA(id || '__arriba');
    });
}

export function iniciarScroll() {
    iniciarSuave();
    iniciarAnclas();

    // Con #ancla en la URL, baja a ella cuando la entrada de la página ya terminó.
    const id = decodeURIComponent(location.hash.slice(1));
    if (id) alListo(() => setTimeout(() => irA(id), 900));
}
