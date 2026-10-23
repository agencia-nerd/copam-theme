import { EASE_OUT, alCambiarVista, alListo, efectosActivos } from './util.js';

// Cabecera: estado al hacer scroll, menús por grupos, menú móvil, buscador y aviso de mantenimiento.
// Los estilos de cada estado viven en el marcado (header.php) como variantes de Tailwind sobre data-*.

const MAYOR_QUE_MOVIL = window.matchMedia('(min-width: 1180px)');

// Colores de la pastilla de cada tipo de resultado del buscador.
const COLOR_TIPO = {
    Documento: 'bg-[#F3ECDD] text-[#7A5510]',
    Reglamento: 'bg-[#ECECEC] text-ink',
    Servicio: 'bg-[#E3F3E8] text-[#0B7A38]',
    Comunicado: 'bg-[#E6ECF5] text-[#1E3F73]',
    Página: 'bg-[#EFEAF4] text-[#4B2F6E]',
    Formulario: 'bg-[#FBE8E5] text-[#A8362A]',
};
const MAX_RESULTADOS = 8;

const normalizar = (texto) =>
    [...texto].map((c) => c.normalize('NFD')[0].toLowerCase()).join('');

function bloquearScroll(bloquear) {
    document.documentElement.style.overflow = bloquear ? 'hidden' : '';
    document.body.style.overflow = bloquear ? 'hidden' : '';
}

export function iniciarHeader() {
    const header = document.querySelector('[data-header]');
    if (!header) return;

    const panelMovil = header.querySelector('[data-menu-movil]');
    const botonMovil = header.querySelector('[data-menu-movil-boton]');
    const buscador = document.querySelector('[data-buscador]');
    const menus = [...header.querySelectorAll('[data-menu]')];

    const menuMovilAbierto = () => header.hasAttribute('data-menu-abierto');
    const buscadorAbierto = () => !!buscador && buscador.hasAttribute('data-abierto');

    // ── Entrada: cada pieza baja desde arriba, en escalera ──
    if (efectosActivos()) {
        alListo(() =>
            header.querySelectorAll('[data-drop]').forEach((el, i) => {
                el.animate([{ transform: 'translateY(-120%)' }, { transform: 'none' }], { duration: 900, delay: i * 55, easing: EASE_OUT, fill: 'backwards' });
                el.style.transform = 'none';
            }),
        );
    }

    // ── Estado según el scroll: sombra y fondo oscuro sobre las secciones oscuras ──
    const secciones = [...document.querySelectorAll('[data-nav-oscuro]')];
    const actualizarScroll = () => {
        header.toggleAttribute('data-scrolled', window.scrollY > 8);
        const sobreOscuro = secciones.some((s) => {
            const r = s.getBoundingClientRect();
            return r.top <= 40 && r.bottom >= 40;
        });
        header.toggleAttribute('data-oscuro', sobreOscuro && !menuMovilAbierto() && !buscadorAbierto());
    };
    const pedirScroll = alCambiarVista(actualizarScroll);

    // ── Menús por grupos (escritorio) ──
    // El cursor y el foco de teclado los abren por CSS; aquí se sincroniza aria-expanded y se agrega
    // el clic (pantallas táctiles) y Escape.
    const sincronizarMenu = (menu) => {
        const boton = menu.querySelector('[data-menu-boton]');
        const abierto = menu.hasAttribute('data-abierto') || menu.matches(':hover') || menu.matches(':has(:focus-visible)');
        boton.setAttribute('aria-expanded', String(abierto));
    };
    const cerrarMenus = (salvo) => {
        menus.forEach((m) => {
            if (m === salvo) return;
            m.removeAttribute('data-abierto');
            sincronizarMenu(m);
        });
    };
    menus.forEach((menu) => {
        const boton = menu.querySelector('[data-menu-boton]');
        boton.addEventListener('click', () => {
            const abrir = !menu.hasAttribute('data-abierto');
            cerrarMenus(menu);
            menu.toggleAttribute('data-abierto', abrir);
            sincronizarMenu(menu);
        });
        ['mouseenter', 'mouseleave', 'focusin', 'focusout'].forEach((tipo) => menu.addEventListener(tipo, () => requestAnimationFrame(() => sincronizarMenu(menu))));
    });
    document.addEventListener('click', (e) => {
        if (!e.target.closest('[data-menu]')) cerrarMenus();
    });

    // ── Menú móvil ──
    const alternarMenuMovil = (abrir) => {
        if (!panelMovil || !botonMovil) return;
        if (abrir) cerrarBuscador(false);
        header.toggleAttribute('data-menu-abierto', abrir);
        panelMovil.inert = !abrir;
        botonMovil.setAttribute('aria-expanded', String(abrir));
        bloquearScroll(abrir);
        actualizarScroll();
    };
    if (panelMovil && botonMovil) {
        botonMovil.addEventListener('click', () => alternarMenuMovil(!menuMovilAbierto()));
        panelMovil.addEventListener('click', (e) => {
            if (e.target.closest('a')) alternarMenuMovil(false);
        });
    }

    // ── Buscador ──
    let abridor = null;
    let temporizadorFoco = 0;
    const campo = buscador?.querySelector('[data-buscar-texto]');
    const lista = buscador?.querySelector('[data-buscar-lista]');
    const titulo = buscador?.querySelector('[data-buscar-titulo]');
    const cuenta = buscador?.querySelector('[data-buscar-cuenta]');
    const vacio = buscador?.querySelector('[data-buscar-vacio]');
    const consulta = buscador?.querySelector('[data-buscar-consulta]');
    // El índice (inc/buscador.php) se pide una sola vez, al acercarse al botón de buscar o al abrirlo.
    const api = buscador?.dataset.buscadorApi || '';
    let indice = [];
    let sugerencias = [];
    let pedidoIndice = null;
    const cargarIndice = () => {
        if (pedidoIndice || !api) return pedidoIndice;
        pedidoIndice = fetch(api, { headers: { Accept: 'application/json' } })
            .then((r) => (r.ok ? r.json() : Promise.reject(new Error(String(r.status)))))
            .then((datos) => {
                indice = (datos.indice || []).map((r, orden) => ({ ...r, orden, buscable: normalizar(`${r.tipo} ${r.titulo} ${r.subtitulo} ${r.claves || ''}`), tituloNormal: normalizar(r.titulo) }));
                const porUrl = new Map(indice.map((r) => [r.url, r]));
                sugerencias = (datos.sugerencias || []).map((url) => porUrl.get(url)).filter(Boolean);
            })
            .catch(() => {
                pedidoIndice = null;
            })
            .finally(() => {
                if (buscadorAbierto()) pintarResultados();
            });
        return pedidoIndice;
    };
    // Cuenta el resultado elegido para las sugerencias ("más buscados"). Anónimo: solo la URL.
    const contarClic = (url) => {
        if (!api || !navigator.sendBeacon) return;
        const datos = new FormData();
        datos.append('url', url);
        navigator.sendBeacon(`${api}/clic`, datos);
    };

    const fila = (r, palabras) => {
        const a = document.createElement('a');
        a.className = 'grid grid-cols-[120px_minmax(0,1fr)_auto] items-center gap-x-4 rounded px-3.5 py-3 text-ink transition-colors hover:bg-gris-f4';
        a.href = r.url;
        if (r.externo) {
            a.target = '_blank';
            a.rel = 'noopener noreferrer';
        }
        if (r.peso) a.title = r.peso;

        const tipo = document.createElement('span');
        tipo.className = `justify-self-start rounded-[3px] px-[9px] py-[5px] text-[11px] leading-[1.2] font-semibold tracking-[.1em] uppercase ${COLOR_TIPO[r.tipo] || COLOR_TIPO.Página}`;
        tipo.textContent = r.tipo;

        const texto = document.createElement('span');
        texto.className = 'flex min-w-0 flex-col gap-[3px]';
        const nombre = document.createElement('span');
        nombre.className = 'truncate text-base leading-[1.3] font-medium';
        const normal = normalizar(r.titulo);
        const palabra = palabras.slice().sort((x, y) => y.length - x.length).find((p) => normal.includes(p));
        if (palabra) {
            const i = normal.indexOf(palabra);
            const marca = document.createElement('mark');
            marca.className = 'rounded-[2px] bg-brand-soft px-px text-brand-dark';
            marca.textContent = r.titulo.slice(i, i + palabra.length);
            nombre.append(r.titulo.slice(0, i), marca, r.titulo.slice(i + palabra.length));
        } else {
            nombre.textContent = r.titulo;
        }
        const sub = document.createElement('span');
        sub.className = 'truncate text-[13px] text-gris-7a';
        sub.textContent = r.subtitulo;
        texto.append(nombre, sub);

        const flecha = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        flecha.setAttribute('width', '14');
        flecha.setAttribute('height', '14');
        flecha.setAttribute('viewBox', '0 0 14 14');
        flecha.setAttribute('fill', 'none');
        flecha.setAttribute('aria-hidden', 'true');
        flecha.innerHTML = '<path d="M3 11L11 3M4.5 3H11v6.5" stroke="#2B2B2B" stroke-width="1.6"></path>';

        a.append(tipo, texto, flecha);
        return a;
    };

    const pintarResultados = () => {
        if (!lista) return;
        const q = campo.value.trim();
        const frase = normalizar(q);
        const palabras = frase.split(/\s+/).filter(Boolean);
        // Puntaje: el título empieza con lo escrito > el título lo contiene > solo en el resto. Luego, lo más elegido.
        const puntaje = (r) => (r.tituloNormal.startsWith(frase) ? 3 : palabras.every((p) => r.tituloNormal.includes(p)) ? 2 : 1);
        const filas = palabras.length
            ? indice
                  .filter((r) => palabras.every((p) => r.buscable.includes(p)))
                  .map((r) => ({ r, p: puntaje(r) }))
                  .sort((a, b) => b.p - a.p || (b.r.popularidad || 0) - (a.r.popularidad || 0) || a.r.orden - b.r.orden)
                  .map(({ r }) => r)
            : sugerencias;
        const cargando = !!pedidoIndice && !indice.length;
        lista.replaceChildren(...filas.slice(0, MAX_RESULTADOS).map((r) => fila(r, palabras)));
        titulo.textContent = cargando ? 'Cargando…' : palabras.length ? 'Resultados' : 'Más buscados';
        cuenta.textContent = palabras.length && !cargando ? (filas.length === 1 ? '1 resultado' : `${filas.length} resultados`) : '';
        const sinResultados = palabras.length > 0 && filas.length === 0 && !cargando;
        vacio.classList.toggle('hidden', !sinResultados);
        consulta.textContent = `“${q}”`;
    };

    function cerrarBuscador(devolverFoco = true) {
        if (!buscador || !buscadorAbierto()) return;
        buscador.removeAttribute('data-abierto');
        buscador.inert = true;
        clearTimeout(temporizadorFoco);
        document.querySelectorAll('[data-buscar-abrir]').forEach((b) => b.setAttribute('aria-expanded', 'false'));
        if (devolverFoco && abridor) abridor.focus({ preventScroll: true });
        actualizarScroll();
    }
    function abrirBuscador(boton) {
        if (!buscador) return;
        alternarMenuMovil(false);
        cerrarMenus();
        abridor = boton;
        cargarIndice();
        pintarResultados();
        buscador.inert = false;
        buscador.setAttribute('data-abierto', '');
        document.querySelectorAll('[data-buscar-abrir]').forEach((b) => b.setAttribute('aria-expanded', 'true'));
        temporizadorFoco = setTimeout(() => campo.focus({ preventScroll: true }), 350);
        actualizarScroll();
    }

    if (buscador && campo) {
        document.querySelectorAll('[data-buscar-abrir]').forEach((b) => {
            b.addEventListener('click', () => (buscadorAbierto() ? cerrarBuscador() : abrirBuscador(b)));
            ['pointerenter', 'focus'].forEach((evento) => b.addEventListener(evento, cargarIndice, { once: true }));
        });
        buscador.querySelectorAll('[data-buscar-cerrar]').forEach((b) => b.addEventListener('click', () => cerrarBuscador()));
        // Enter abre el primer resultado.
        buscador.querySelector('[data-buscar-form]').addEventListener('submit', (e) => {
            e.preventDefault();
            lista.querySelector('a')?.click();
        });
        campo.addEventListener('input', pintarResultados);
        // Flechas: del campo a los resultados y entre ellos.
        buscador.addEventListener('keydown', (e) => {
            if (e.key !== 'ArrowDown' && e.key !== 'ArrowUp') return;
            const enlaces = [...lista.querySelectorAll('a')];
            if (!enlaces.length) return;
            const actual = enlaces.indexOf(document.activeElement);
            if (actual === -1 && document.activeElement !== campo) return;
            e.preventDefault();
            const siguiente = actual + (e.key === 'ArrowDown' ? 1 : -1);
            if (siguiente < 0) campo.focus();
            else enlaces[Math.min(siguiente, enlaces.length - 1)].focus();
        });
        // Al elegir un resultado se cuenta; si es de esta misma página (ancla), el panel se cierra.
        buscador.addEventListener('click', (e) => {
            const enlace = e.target.closest('a');
            if (!enlace || !lista.contains(enlace)) return;
            contarClic(enlace.href);
            if (!enlace.target) cerrarBuscador(false);
        });
    }

    // Un enlace a un ancla de esta página (scroll.js) cierra el menú móvil y el buscador.
    document.addEventListener('copam:cerrar-paneles', () => {
        alternarMenuMovil(false);
        cerrarBuscador(false);
    });

    // ── Teclado y tamaño de pantalla ──
    document.addEventListener('keydown', (e) => {
        if (e.key !== 'Escape') return;
        if (buscadorAbierto()) return cerrarBuscador();
        if (menuMovilAbierto()) {
            alternarMenuMovil(false);
            botonMovil?.focus({ preventScroll: true });
            return;
        }
        const abierto = menus.find((m) => m.matches('[data-abierto], :hover, :has(:focus-visible)'));
        if (abierto) {
            cerrarMenus();
            if (abierto.contains(document.activeElement)) abierto.querySelector('[data-menu-boton]').focus({ preventScroll: true });
        }
    });
    MAYOR_QUE_MOVIL.addEventListener('change', () => {
        if (MAYOR_QUE_MOVIL.matches) alternarMenuMovil(false);
        iniciarAviso.ajustar?.();
        pedirScroll();
    });

    iniciarAviso(header);
}

// ── Aviso de mantenimiento: franja bajo la barra (móvil) o aviso flotante (escritorio) ──
function iniciarAviso(header) {
    const avisos = [...document.querySelectorAll('[data-aviso]')];
    if (!avisos.length) return;

    const CLAVE = 'copam-toast-x';
    let cerrado = false;
    try {
        cerrado = sessionStorage.getItem(CLAVE) === '1';
    } catch (e) {}
    const quitar = () => {
        avisos.forEach((a) => a.remove());
        header.removeAttribute('data-aviso');
    };
    if (cerrado) return quitar();

    // En móvil la franja empuja la página y el menú compacto debe bajar su contenido.
    iniciarAviso.ajustar = () => header.toggleAttribute('data-aviso', !MAYOR_QUE_MOVIL.matches && window.innerWidth < 760 && avisos.some((a) => a.hasAttribute('data-visible')));
    alListo(() =>
        setTimeout(() => {
            avisos.forEach((a) => a.setAttribute('data-visible', ''));
            iniciarAviso.ajustar();
        }, efectosActivos() ? 700 : 0),
    );
    window.addEventListener('resize', iniciarAviso.ajustar);

    document.querySelectorAll('[data-aviso-cerrar]').forEach((b) =>
        b.addEventListener('click', () => {
            try {
                sessionStorage.setItem(CLAVE, '1');
            } catch (e) {}
            avisos.forEach((a) => a.removeAttribute('data-visible'));
            iniciarAviso.ajustar();
            setTimeout(quitar, 1500);
        }),
    );
}
