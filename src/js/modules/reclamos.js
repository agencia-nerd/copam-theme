// Formulario de reclamos, reconsideraciones y apelaciones (template-parts/forms/reclamos.php).
// El envío, la validación y los errores son del motor de wp-form (form.js); aquí solo va lo propio del form:
// - la nota bajo el tipo de solicitud cambia con el tipo, y con Reconsideración o Apelación se abren (y exigen)
//   el N.° de reclamo y la resolución;
// - los enlaces con data-tipo (tarjetas de "¿No estás conforme?") eligen el tipo y bajan al formulario;
// - "Es el mismo que mi domicilio" copia el domicilio y deja el campo de solo lectura;
// - la representación abre sus campos; cerrada, se vacían;
// - los archivos se suben aparte (el motor no envía archivos) y el form manda el identificador del lote.

import { iniciarAdjuntos } from './adjuntos.js';
import { iniciarReglasExtra } from './reglas-extra.js';

const RECURSOS = ['reconsideracion', 'apelacion'];

function limpiar(contenedor, form) {
    contenedor.querySelectorAll('input:not([type="checkbox"]), textarea').forEach((input) => {
        const tenia = input.value !== '';
        input.value = '';
        // Un archivo quitado vuelve la zona a su texto inicial (adjuntos.js escucha el change).
        if (input.type === 'file' && tenia) input.dispatchEvent(new Event('change'));
        input.removeAttribute('aria-invalid');
        const error = form.querySelector(`[data-error-for="${CSS.escape(input.name)}"]`);
        if (error) error.textContent = '';
    });
}

// Bloque plegable: abre o cierra, habilita su fieldset y lo vacía al cerrarse.
function plegar(bloque, abierto, form) {
    if (!bloque) return;
    bloque.toggleAttribute('data-abierto', abierto);
    const grupo = bloque.querySelector('fieldset');
    if (grupo) grupo.disabled = !abierto;
    if (!abierto) limpiar(bloque, form);
}

function iniciarTipo(form) {
    const recurso = form.querySelector('[data-reclamos-recurso]');
    const notas = [...form.querySelectorAll('[data-reclamos-nota]')];
    const tipo = () => form.elements.namedItem('tipo')?.value || 'reclamo';

    const sincronizar = () => {
        const actual = tipo();
        notas.forEach((nota) => {
            nota.hidden = nota.dataset.reclamosNota !== actual;
        });
        plegar(recurso, RECURSOS.includes(actual), form);
    };
    form.addEventListener('change', (event) => {
        if (event.target.name === 'tipo') sincronizar();
    });
    form.addEventListener('reset', () => requestAnimationFrame(sincronizar));
    sincronizar();

    // Enlaces de otras secciones que eligen el tipo: el ancla hace el desplazamiento.
    document.querySelectorAll('a[data-tipo][href$="#formulario"]').forEach((enlace) => {
        enlace.addEventListener('click', () => {
            const opcion = form.querySelector(`input[name="tipo"][value="${CSS.escape(enlace.dataset.tipo)}"]`);
            if (!opcion) return;
            opcion.checked = true;
            sincronizar();
        });
    });

    const obligatorioSiRecurso = (nombre) => () =>
        RECURSOS.includes(tipo()) && !form.elements.namedItem(nombre)?.value.trim() ? 'Este campo es obligatorio.' : '';
    return { nro_reclamo: obligatorioSiRecurso('nro_reclamo'), resolucion: obligatorioSiRecurso('resolucion') };
}

function iniciarDomicilio(form) {
    const mismo = form.querySelector('[data-reclamos-mismo]');
    const domicilio = form.querySelector('[data-reclamos-domicilio]');
    const notificaciones = form.querySelector('[data-reclamos-notificaciones]');
    if (!mismo || !domicilio || !notificaciones) return;

    const copiar = () => {
        if (!mismo.checked) return;
        notificaciones.value = domicilio.value;
        notificaciones.dispatchEvent(new Event('input', { bubbles: true }));
    };
    mismo.addEventListener('change', () => {
        notificaciones.readOnly = mismo.checked;
        copiar();
    });
    domicilio.addEventListener('input', copiar);
    form.addEventListener('reset', () => {
        notificaciones.readOnly = false;
    });
}

function iniciarRepresentacion(form) {
    const casilla = form.elements.namedItem('representacion');
    const bloque = form.querySelector('[data-reclamos-representante]');
    if (!casilla || !bloque) return;
    const sincronizar = () => plegar(bloque, casilla.checked, form);
    casilla.addEventListener('change', sincronizar);
    form.addEventListener('reset', () => requestAnimationFrame(sincronizar));
    sincronizar();
}

function iniciarArchivos(form) {
    form.querySelectorAll('[data-reclamos-archivo]').forEach((caja) => {
        const archivos = caja.querySelector('[data-archivos]');
        const estado = caja.querySelector('[data-estado]');
        const lote = caja.querySelector('[data-lote]');
        if (!archivos || !estado || !lote) return;
        iniciarAdjuntos({
            form,
            archivos,
            estado,
            lote,
            zona: caja.querySelector('[data-zona]'),
            url: caja.dataset.ajaxUrl,
            accion: caja.dataset.reclamosArchivo,
            maxArchivos: Number(caja.dataset.maxArchivos) || 1,
            maxBytes: 10 * 1024 * 1024,
        });
    });
}

export function iniciarReclamos() {
    document.querySelectorAll('form[data-reclamos]').forEach((form) => {
        const reglas = iniciarTipo(form);
        iniciarDomicilio(form);
        iniciarRepresentacion(form);
        iniciarArchivos(form);
        iniciarReglasExtra(form, reglas);
    });
}
