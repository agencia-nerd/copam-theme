// Subida de archivos de los formularios (el motor de wp-form no envía archivos; ver inc/helpers/adjuntos.php).
// Cada vez que cambia la selección, los archivos se suben juntos al endpoint del formulario y el campo oculto
// `lote` recibe el identificador que el form envía. Mientras sube, el botón de envío queda deshabilitado.

const TIPOS = ['application/pdf', 'image/jpeg', 'image/png'];
const EXTENSIONES = /\.(pdf|jpe?g|png)$/i;

/**
 * @param {object} o
 * @param {HTMLFormElement} o.form
 * @param {HTMLInputElement} o.archivos  input type="file"
 * @param {HTMLElement} o.estado        texto de la zona (nombre del archivo o error)
 * @param {HTMLInputElement} o.lote      campo de texto oculto que se envía con el form
 * @param {HTMLElement} [o.zona]         recibe data-arrastre mientras se arrastra encima
 * @param {string} o.url                 admin-ajax.php
 * @param {string} o.accion              acción AJAX del endpoint
 * @param {number} o.maxArchivos
 * @param {number} o.maxBytes
 */
export function iniciarAdjuntos({ form, archivos, estado, lote, zona, url, accion, maxArchivos, maxBytes }) {
    const enviar = form.querySelector('[type="submit"]');
    const textoInicial = estado.textContent;
    const megas = Math.round(maxBytes / (1024 * 1024));
    let pedido = 0;

    const mostrar = (texto, error = false) => {
        estado.textContent = texto;
        if (error) estado.dataset.state = 'error';
        else delete estado.dataset.state;
        zona?.toggleAttribute('data-con-archivo', !error && texto !== textoInicial);
    };

    const subir = async (lista) => {
        const actual = ++pedido;
        const anterior = lote.value;
        lote.value = '';
        lote.dispatchEvent(new Event('input', { bubbles: true }));
        if (!lista.length) {
            mostrar(textoInicial);
            return;
        }
        if (lista.length > maxArchivos) {
            return mostrar(maxArchivos === 1 ? 'Adjunta un solo archivo.' : `Puedes adjuntar hasta ${maxArchivos} archivos.`, true);
        }
        if (lista.some((f) => !TIPOS.includes(f.type) && !EXTENSIONES.test(f.name))) {
            return mostrar('Solo se aceptan archivos PDF, JPG o PNG.', true);
        }
        if (lista.reduce((total, f) => total + f.size, 0) > maxBytes) {
            return mostrar(`Los archivos superan los ${megas} MB en total.`, true);
        }

        const nombres = lista.length === 1 ? lista[0].name : `${lista.length} archivos seleccionados`;
        mostrar(`Subiendo ${nombres}…`);
        if (enviar) enviar.disabled = true;

        const cuerpo = new FormData();
        cuerpo.append('action', accion);
        if (anterior) cuerpo.append('anterior', anterior);
        lista.forEach((archivo) => cuerpo.append('archivos[]', archivo));

        try {
            const respuesta = await fetch(url, { method: 'POST', body: cuerpo, credentials: 'same-origin' });
            const json = await respuesta.json().catch(() => null);
            if (actual !== pedido) return;
            if (!json?.success) throw new Error(json?.data?.message || '');
            lote.value = json.data.lote;
            lote.dispatchEvent(new Event('input', { bubbles: true }));
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
        requestAnimationFrame(() => {
            lote.value = '';
            mostrar(textoInicial);
        });
    });
}
