import { observarRevelado } from './reveal.js';

// Filtros del listado de comunicados sin recargar: las pastillas, el buscador, el año y la paginación piden la
// misma URL que cargarían (el servidor filtra) y se cambian solo las zonas data-comunicados-*. La URL del
// navegador se actualiza, así cada filtro se puede compartir y "atrás" funciona. Si algo falla, se navega normal.
const ESPERA_BUSQUEDA = 350;

export function iniciarComunicados() {
    const lista = document.querySelector('[data-comunicados]');
    const form = lista?.querySelector('[data-comunicados-form]');
    if (!lista || !form) return;

    const buscar = form.querySelector('[data-comunicados-buscar]');
    const anio = form.querySelector('[data-comunicados-anio]');
    const zonas = ['[data-comunicados-encabezado]', '[data-comunicados-pastillas]', '[data-comunicados-resultados]'];
    const resultados = () => lista.querySelector('[data-comunicados-resultados]');
    let pedido = null;
    let espera = 0;

    // URL del form: su action (categoría actual) + búsqueda y año, sin los vacíos.
    const urlDelForm = () => {
        const url = new URL(form.action, window.location.href);
        const texto = buscar.value.trim();
        if (texto) {
            url.searchParams.set('s', texto);
            url.searchParams.set('post_type', 'post');
        }
        if (anio.value) url.searchParams.set('anio', anio.value);
        return url.toString();
    };

    // Deja el buscador y el año como dice la URL (al volver con "atrás").
    const leerUrl = (url) => {
        const params = new URL(url).searchParams;
        buscar.value = params.get('s') || '';
        anio.value = params.get('anio') || '';
    };

    async function cargar(url, { push = true, alInicio = false } = {}) {
        pedido?.abort();
        pedido = new AbortController();
        resultados().setAttribute('aria-busy', 'true');

        try {
            const respuesta = await fetch(url, { signal: pedido.signal, headers: { 'X-Requested-With': 'fetch' } });
            if (!respuesta.ok && respuesta.status !== 404) throw new Error(String(respuesta.status));
            const doc = new DOMParser().parseFromString(await respuesta.text(), 'text/html');
            const nuevaLista = doc.querySelector('[data-comunicados]');
            if (!nuevaLista) throw new Error('sin listado');

            zonas.forEach((selector) => {
                const actual = document.querySelector(selector);
                const nueva = doc.querySelector(selector);
                if (!actual || !nueva) return;
                // El encabezado y las pastillas ya se vieron entrar: cambian sin animación. Las tarjetas sí entran.
                if (selector !== '[data-comunicados-resultados]') {
                    nueva.querySelectorAll('[data-sr]').forEach((el) => el.removeAttribute('data-sr'));
                }
                actual.innerHTML = nueva.innerHTML;
                observarRevelado(actual);
            });
            form.action = doc.querySelector('[data-comunicados-form]')?.getAttribute('action') || form.action;
            document.title = doc.title;
            if (push) history.pushState({ comunicados: true }, '', url);
            if (alInicio) {
                const reducido = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                lista.scrollIntoView({ behavior: reducido ? 'auto' : 'smooth', block: 'start' });
            }
        } catch (error) {
            if (error.name === 'AbortError') return;
            window.location.href = url;
        } finally {
            resultados()?.removeAttribute('aria-busy');
        }
    }

    // Pastillas de categoría y paginación (enlaces del mismo sitio dentro del listado).
    lista.addEventListener('click', (evento) => {
        const enlace = evento.target.closest('a[href]');
        if (!enlace || !lista.contains(enlace) || evento.defaultPrevented || evento.button !== 0 || evento.metaKey || evento.ctrlKey || evento.shiftKey || evento.altKey) return;
        const url = new URL(enlace.href, window.location.href);
        if (url.origin !== window.location.origin) return;
        evento.preventDefault();
        const paginacion = !!enlace.closest('nav');
        url.hash = '';
        cargar(url.toString(), { alInicio: paginacion });
    });

    form.addEventListener('submit', (evento) => {
        evento.preventDefault();
        clearTimeout(espera);
        cargar(urlDelForm());
    });

    anio.addEventListener('change', () => cargar(urlDelForm()));

    buscar.addEventListener('input', () => {
        clearTimeout(espera);
        espera = setTimeout(() => cargar(urlDelForm()), ESPERA_BUSQUEDA);
    });

    window.addEventListener('popstate', () => {
        leerUrl(window.location.href);
        cargar(window.location.href, { push: false });
    });
}
