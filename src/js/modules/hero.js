import { alListo, EASE_IN_OUT, EASE_OUT, alCambiarVista, clamp, efectosActivos } from './util.js';

const AUTOPLAY_MS = 7000;
const esTactil = () => window.matchMedia('(hover: none)').matches;

export function iniciarHero() {
    const hero = document.querySelector('[data-hero]');
    if (!hero || !efectosActivos()) return;

    const principales = [...hero.querySelectorAll('[data-hero-slide]')];
    const laterales = [...hero.querySelectorAll('[data-hero-side]')];
    const total = principales.length;
    if (!total) return;

    const contadores = [...hero.querySelectorAll('[data-hero-counter]')];
    const progresos = [...hero.querySelectorAll('[data-hero-progress]')];
    const estado = hero.querySelector('[data-hero-status]');
    const medios = hero.querySelector('[data-hero-media]');
    estado?.setAttribute('aria-live', 'off'); // en silencio hasta que el usuario cambie de imagen (ver mover)

    let actual = 0;
    let ocupado = false;
    let listo = false;
    let pausado = false;
    // Razones activas de pausa: 'usuario' (botón), 'foco', 'cursor' y 'pestana'. Con cualquiera, el autoplay se detiene.
    const razones = new Set();
    let animacionProgreso = null;
    let temporizadorOcupado = 0;

    // ── Cambio de imagen ─────────────────────────────────────────────────────

    function kenBurns(el, retardo) {
        const img = el && el.querySelector('img');
        if (!img) return;
        img.animate([{ transform: 'scale(1)' }, { transform: 'scale(1.085)' }], {
            duration: 16000,
            delay: retardo,
            easing: 'cubic-bezier(.33,0,.4,1)',
            fill: 'both',
        });
    }

    function revelarInicial(el, retardo) {
        if (!el) return;
        el.style.zIndex = 2;
        el.style.clipPath = 'inset(0 0 0 0%)';
        kenBurns(el, retardo);
        el.animate([{ clipPath: 'inset(0 0 0 100%)' }, { clipPath: 'inset(0 0 0 0%)' }], { duration: 1400, delay: retardo, easing: EASE_IN_OUT, fill: 'backwards' });
        el.firstElementChild.animate([{ transform: 'translateX(24%) scale(1.12)' }, { transform: 'none' }], { duration: 1700, delay: retardo, easing: EASE_OUT, fill: 'backwards' });
    }

    function intercambiar(grupo, desde, hacia, direccion, retardo) {
        const entra = grupo[hacia];
        const sale = grupo[desde];
        if (!entra || !sale) return;

        const tactil = esTactil();
        const duracion = tactil ? 750 : 1250;
        if (tactil) {
            retardo = Math.min(retardo, 60);
            grupo.forEach((el) => el.getAnimations({ subtree: true }).forEach((a) => a.finish()));
        }

        grupo.actual = hacia;
        grupo.forEach((el, i) => {
            if (i !== hacia && i !== desde) el.style.zIndex = 0;
        });
        sale.style.zIndex = 1;
        entra.style.zIndex = 2;
        entra.getAnimations({ subtree: true }).forEach((a) => a.cancel());
        entra.style.clipPath = 'inset(0 0 0 0%)';
        kenBurns(entra, retardo);

        const inicio = direccion > 0 ? 'inset(0 0 0 100%)' : 'inset(0 100% 0 0)';
        entra.animate([{ clipPath: inicio }, { clipPath: 'inset(0 0 0 0%)' }], { duration: duracion, delay: retardo, easing: EASE_IN_OUT, fill: 'backwards' });
        entra.firstElementChild.animate([{ transform: `translateX(${direccion * 20}%) scale(1.1)` }, { transform: 'none' }], { duration: duracion + 250, delay: retardo, easing: EASE_OUT, fill: 'backwards' });
        sale.firstElementChild.animate([{ transform: 'none' }, { transform: `translateX(${-direccion * 16}%)` }], { duration: duracion, delay: retardo, easing: EASE_IN_OUT, fill: 'forwards' });

        setTimeout(() => {
            if (grupo.actual === desde) return;
            sale.getAnimations({ subtree: true }).forEach((a) => a.cancel());
            sale.style.clipPath = 'inset(0 0 0 100%)';
            sale.style.zIndex = 0;
        }, retardo + duracion + 300);
    }

    function irA(hacia, direccion) {
        if (!listo || hacia === actual) return;
        if (ocupado && !esTactil()) return;

        const desde = actual;
        ocupado = true;
        intercambiar(principales, desde, hacia, direccion, 0);
        intercambiar(laterales, (desde + 1) % total, (hacia + 1) % total, direccion, 140);
        actual = hacia;
        actualizarIndicadores();
        iniciarProgreso();

        clearTimeout(temporizadorOcupado);
        temporizadorOcupado = setTimeout(() => {
            ocupado = false;
        }, esTactil() ? 0 : 1100);
    }

    // El estado se anuncia solo cuando el cambio lo pide el usuario; en el autoplay queda en silencio.
    const mover = (direccion, anunciar = false) => {
        estado?.setAttribute('aria-live', anunciar ? 'polite' : 'off');
        irA((actual + direccion + total) % total, direccion);
    };

    function actualizarIndicadores() {
        contadores.forEach((el) => {
            el.style.transform = `translateY(${-actual * 1.2}em)`;
        });
        principales.forEach((el, i) => el.setAttribute('aria-hidden', i === actual ? 'false' : 'true'));
        if (estado) {
            const alt = principales[actual].querySelector('img')?.alt || '';
            estado.textContent = `${actual + 1} / ${total}. ${alt}`;
        }
    }

    // ── Autoplay con barra de progreso ───────────────────────────────────────

    function iniciarProgreso() {
        if (!listo) return;
        animacionProgreso?.cancel();
        const barras = progresos.filter((el) => el.offsetParent !== null);
        if (!barras.length) return;

        const animaciones = barras.map((barra) => {
            const eje = barra.dataset.heroProgress === 'y' ? 'scaleY' : 'scaleX';
            return barra.animate([{ transform: `${eje}(0)` }, { transform: `${eje}(1)` }], { duration: AUTOPLAY_MS, easing: 'linear', fill: 'forwards' });
        });
        animacionProgreso = animaciones[0];
        animacionProgreso.onfinish = () => mover(1);
        if (pausado) animaciones.forEach((a) => a.pause());
        animacionProgreso.todas = animaciones;
    }

    function pausar(razon, activa) {
        if (activa) razones.add(razon);
        else razones.delete(razon);
        pausado = razones.size > 0;
        const animaciones = animacionProgreso?.todas || [];
        animaciones.forEach((a) => (pausado ? a.pause() : a.play()));
    }

    // ── Entrada inicial ──────────────────────────────────────────────────────

    function entrada() {
        revelarInicial(principales[0], 150);
        revelarInicial(laterales[1 % total], 360);

        const sube = [...hero.querySelectorAll('[data-hero-rise]')];
        sube.forEach((el, i) => {
            el.style.transform = 'none';
            el.animate([{ transform: 'translateY(115%) rotate(4deg)' }, { transform: 'none' }], { duration: 1150, delay: 600 + i * 75, easing: EASE_OUT, fill: 'backwards' });
        });
        hero.querySelectorAll('[data-hero-clip]').forEach((el) => {
            el.style.clipPath = 'inset(0 0 0% 0)';
            el.style.transform = 'none';
            el.animate([{ clipPath: 'inset(0 0 100% 0)', transform: 'translateY(28px)' }, { clipPath: 'inset(0 0 0% 0)', transform: 'none' }], { duration: 1200, delay: 950, easing: EASE_IN_OUT, fill: 'backwards' });
        });

        actualizarIndicadores();
        listo = true;
        setTimeout(iniciarProgreso, 1500);
    }

    // ── Controles ────────────────────────────────────────────────────────────

    hero.querySelector('[data-hero-prev]')?.addEventListener('click', () => mover(-1, true));
    hero.querySelector('[data-hero-next]')?.addEventListener('click', () => mover(1, true));
    medios?.addEventListener('focusin', () => pausar('foco', true));
    medios?.addEventListener('focusout', () => pausar('foco', false));
    medios?.addEventListener('mouseenter', () => pausar('cursor', true));
    medios?.addEventListener('mouseleave', () => pausar('cursor', false));
    document.addEventListener('visibilitychange', () => pausar('pestana', document.hidden));

    const botonPausa = hero.querySelector('[data-hero-pausa]');
    botonPausa?.addEventListener('click', () => {
        const enPausa = !razones.has('usuario');
        pausar('usuario', enPausa);
        botonPausa.setAttribute('aria-pressed', String(enPausa));
        botonPausa.setAttribute('aria-label', enPausa ? botonPausa.dataset.labelReanudar : botonPausa.dataset.labelPausar);
    });

    // ── Título: si una línea se parte, reduce el tamaño hasta que entre ──────

    const h1 = hero.querySelector('[data-hero-h1]');
    const base = h1 ? { tamano: h1.style.fontSize, flex: h1.style.flex } : null;

    function ajustarTitulo() {
        if (!h1) return;
        h1.style.fontSize = base.tamano;
        h1.style.flex = base.flex;
        if (window.innerWidth < 760) return;

        const lineas = h1.querySelectorAll('[data-h1l]');
        const seParte = () => [...lineas].some((linea) => {
            const hijos = linea.children;
            return hijos.length > 1 && hijos[hijos.length - 1].offsetTop - hijos[0].offsetTop > 2;
        });
        if (!seParte()) return;

        if (window.innerWidth >= 1200) h1.style.flex = '1 1 0';
        const tamanoBase = parseFloat(getComputedStyle(h1).fontSize);
        for (let f = 0.98; f >= 0.8; f -= 0.02) {
            h1.style.fontSize = `${(tamanoBase * f).toFixed(2)}px`;
            if (!seParte()) break;
        }
    }

    ajustarTitulo();
    document.fonts?.ready.then(ajustarTitulo);
    window.addEventListener('resize', ajustarTitulo);

    // ── Efecto de pila: al llegar la sección siguiente, el hero se aleja y se desenfoca ──

    const siguiente = document.querySelector('[data-hero-siguiente]');
    const velo = hero.querySelector('[data-hero-wash]');
    let topActual = null;

    alCambiarVista(() => {
        const vh = window.innerHeight;
        const top = Math.min(0, vh - hero.offsetHeight);
        if (top !== topActual) {
            topActual = top;
            hero.style.top = `${top}px`;
        }
        if (!siguiente) return;

        const y = window.scrollY;
        const inicioSiguiente = siguiente.getBoundingClientRect().top + y;
        const desde = Math.max(0, inicioSiguiente - vh);
        const p = y <= desde ? 0 : clamp((y - desde) / Math.max(1, inicioSiguiente - desde));

        hero.style.transform = p > 0 ? `scale(${1 - 0.06 * p}) translateY(${p * 6}%)` : '';
        if (velo) velo.style.opacity = Math.min(1, p * 1.25).toFixed(3);
        const desenfoque = Math.min(1, p * 1.3) * 10;
        hero.style.filter = desenfoque > 0.05 ? `blur(${desenfoque.toFixed(2)}px)` : '';
    });

    // Arranca cuando la tipografía está lista, para que el título no salte.
    const arrancar = () => alListo(() => requestAnimationFrame(entrada));
    if (document.fonts?.ready) document.fonts.ready.then(arrancar);
    else arrancar();
}
