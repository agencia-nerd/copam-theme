// Reporte del Canal de hostigamiento sexual (template-parts/forms/reporte-hostigamiento.php).
// El envío, la validación y los errores son del motor de wp-form (form.js); aquí solo va lo propio del reporte:
// - "¿Deseas identificarte?" abre los datos personales o solo el correo de contacto (el bloque cerrado se vacía);
// - la fecha usa el selector del navegador;
// - la evidencia se sube aparte (el motor no envía archivos) y el form manda el identificador del lote.

const MAX_ARCHIVOS = 5;
const MAX_BYTES = 10 * 1024 * 1024;
const TIPOS = ['application/pdf', 'image/jpeg', 'image/png'];
const EXTENSIONES = /\.(pdf|jpe?g|png)$/i;

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
    const zona = caja?.querySelector('[data-reporte-zona]');
    const archivos = caja?.querySelector('[data-reporte-archivos]');
    const estado = caja?.querySelector('[data-reporte-estado]');
    const lote = caja?.querySelector('[data-reporte-lote]');
    const enviar = form.querySelector('[type="submit"]');
    if (!caja || !archivos || !estado || !lote) return;

    const textoInicial = estado.textContent;
    let pedido = 0;

    const mostrar = (texto, error = false) => {
        estado.textContent = texto;
        if (error) estado.dataset.state = 'error';
        else delete estado.dataset.state;
    };

    const reiniciar = () => {
        lote.value = '';
        mostrar(textoInicial);
    };

    const subir = async (lista) => {
        const actual = ++pedido;
        const anterior = lote.value;
        lote.value = '';
        if (!lista.length) {
            mostrar(textoInicial);
            return;
        }
        if (lista.length > MAX_ARCHIVOS) return mostrar(`Puedes adjuntar hasta ${MAX_ARCHIVOS} archivos.`, true);
        if (lista.some((f) => !TIPOS.includes(f.type) && !EXTENSIONES.test(f.name))) {
            return mostrar('Solo se aceptan archivos PDF, JPG o PNG.', true);
        }
        if (lista.reduce((total, f) => total + f.size, 0) > MAX_BYTES) {
            return mostrar('Los archivos superan los 10 MB en total.', true);
        }

        const nombres = lista.length === 1 ? lista[0].name : `${lista.length} archivos seleccionados`;
        mostrar(`Subiendo ${nombres}…`);
        if (enviar) enviar.disabled = true;

        const cuerpo = new FormData();
        cuerpo.append('action', 'copam_theme_reporte_adjuntos');
        if (anterior) cuerpo.append('anterior', anterior);
        lista.forEach((archivo) => cuerpo.append('archivos[]', archivo));

        try {
            const respuesta = await fetch(caja.dataset.ajaxUrl, { method: 'POST', body: cuerpo, credentials: 'same-origin' });
            const json = await respuesta.json().catch(() => null);
            if (actual !== pedido) return;
            if (!json?.success) throw new Error(json?.data?.message || '');
            lote.value = json.data.lote;
            mostrar(nombres);
        } catch (error) {
            if (actual !== pedido) return;
            archivos.value = '';
            mostrar(error.message || 'No pudimos subir los archivos. Intenta de nuevo.', true);
        } finally {
            if (actual === pedido && enviar) enviar.disabled = false;
        }
    };

    archivos.addEventListener('change', () => subir([...archivos.files]));

    // Arrastrar y soltar: el input cubre toda la zona, así que el navegador ya los recibe; solo se marca el estado.
    ['dragenter', 'dragover'].forEach((tipo) => archivos.addEventListener(tipo, () => zona?.setAttribute('data-arrastre', '')));
    ['dragleave', 'drop'].forEach((tipo) => archivos.addEventListener(tipo, () => zona?.removeAttribute('data-arrastre')));

    form.addEventListener('reset', () => {
        pedido++;
        requestAnimationFrame(reiniciar);
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
