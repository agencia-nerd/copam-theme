// Reporte del Canal de hostigamiento sexual (template-parts/forms/reporte-hostigamiento.php).
// El envío, la validación y los errores son del motor de wp-form (form.js); aquí solo va lo propio del reporte:
// - "¿Deseas identificarte?" abre los datos personales o solo el correo de contacto (el bloque cerrado se vacía);
// - la fecha usa el selector del navegador;
// - la evidencia se sube aparte (el motor no envía archivos) y el form manda el identificador del lote.

import { iniciarAdjuntos } from './adjuntos.js';

function limpiarCampos(contenedor, form) {
    contenedor.querySelectorAll('input').forEach((input) => {
        input.value = '';
        input.removeAttribute('aria-invalid');
        const error = form.querySelector(`[data-error-for="${input.name}"]`);
        if (error) error.textContent = '';
    });
}

function iniciarIdentificacion(form) {
    const bloques = [...form.querySelectorAll('[data-reporte-bloque]')];
    const sincronizar = () => {
        const identificado = form.elements.namedItem('identificarse')?.value !== 'no';
        bloques.forEach((bloque) => {
            const abierto = (bloque.dataset.reporteBloque === 'identificado') === identificado;
            const grupo = bloque.querySelector('fieldset');
            bloque.toggleAttribute('data-abierto', abierto);
            if (grupo) grupo.disabled = !abierto;
            if (!abierto) limpiarCampos(bloque, form);
        });
    };
    form.addEventListener('change', (event) => {
        if (event.target.name === 'identificarse') sincronizar();
    });
    form.addEventListener('reset', () => requestAnimationFrame(sincronizar));
    sincronizar();
}

function iniciarEvidencia(form) {
    const caja = form.querySelector('[data-reporte-evidencia]');
    const archivos = caja?.querySelector('[data-reporte-archivos]');
    const estado = caja?.querySelector('[data-reporte-estado]');
    const lote = caja?.querySelector('[data-reporte-lote]');
    if (!caja || !archivos || !estado || !lote) return;

    iniciarAdjuntos({
        form,
        archivos,
        estado,
        lote,
        zona: caja.querySelector('[data-reporte-zona]'),
        url: caja.dataset.ajaxUrl,
        accion: 'copam_theme_reporte_adjuntos',
        maxArchivos: 5,
        maxBytes: 10 * 1024 * 1024,
    });
}

export function iniciarReporteHostigamiento() {
    document.querySelectorAll('form[data-reporte]').forEach((form) => {
        // Con JS, la fecha usa el selector del navegador (sin JS queda como texto libre).
        const fecha = form.querySelector('[data-reporte-fecha]');
        if (fecha) {
            fecha.type = 'date';
            fecha.max = new Date().toISOString().slice(0, 10);
        }
        iniciarIdentificacion(form);
        iniciarEvidencia(form);
    });
}
