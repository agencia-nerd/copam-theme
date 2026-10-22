// Hojas de reclamación del Depósito Temporal y del Libro de Reclamaciones
// (template-parts/forms/hoja-reclamacion-dt.php y libro-de-reclamaciones.php).
// El envío, la validación y los errores son del motor de wp-form (form.js); aquí solo va lo propio de la hoja:
// los datos del padre o madre al marcar "Soy menor de edad", las reglas del número de documento según su tipo
// y del monto (Libro), la fecha del día, el panel de éxito y la copia impresa.

import { iniciarReglasExtra } from './reglas-extra.js';

const escapar = (texto) =>
    String(texto).replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[c]);

// Fecha del día en Lima, con el separador de la hoja (`/` en el Depósito, `-` en el Libro).
const hoy = (separador = '/') =>
    new Intl.DateTimeFormat('es-PE', { day: '2-digit', month: '2-digit', year: 'numeric', timeZone: 'America/Lima' })
        .format(new Date())
        .replace(/\//g, separador);

// Número de documento según su tipo (las mismas reglas que COPAM_THEME_LIBRO_DOCUMENTOS en PHP).
const DOCUMENTOS = {
    dni: { patron: /^\d{8}$/, mensaje: 'El DNI tiene 8 dígitos.', max: 8, modo: 'numeric', ejemplo: 'Ej. 45678912' },
    ce: { patron: /^[A-Za-z0-9]{6,12}$/, mensaje: 'El carné de extranjería tiene de 6 a 12 letras o números.', max: 12, modo: 'text', ejemplo: 'Ej. 001234567' },
    pasaporte: { patron: /^[A-Za-z0-9]{6,12}$/, mensaje: 'El pasaporte tiene de 6 a 12 letras o números.', max: 12, modo: 'text', ejemplo: 'Ej. AB1234567' },
    ruc: { patron: /^\d{11}$/, mensaje: 'El RUC tiene 11 dígitos.', max: 11, modo: 'numeric', ejemplo: 'Ej. 20543480291' },
};
const MONTO = /^\d{1,9}([.,]\d{1,2})?$/;

// Texto visible de una etiqueta, sin el asterisco ni "(opcional)".
const textoEtiqueta = (label) => (label?.textContent ?? '').replace(/\s*\*\s*$/, '').replace(/\s*\(opcional\)\s*$/, '').trim();

// Foto de la hoja en el momento de enviar: secciones con sus pares etiqueta / valor.
function capturar(form) {
    const secciones = [];
    let actual = null;
    form.querySelectorAll('h3, [name]').forEach((el) => {
        if (el.tagName === 'H3') {
            actual = { titulo: el.textContent.trim(), filas: [] };
            secciones.push(actual);
            return;
        }
        if (!actual || el.type === 'hidden' || el.closest('[aria-hidden="true"]') || el.disabled) return;
        if (el.type === 'radio') {
            if (!el.checked) return;
            const leyenda = el.closest('fieldset')?.querySelector('legend');
            actual.filas.push([textoEtiqueta(leyenda), el.closest('label')?.querySelector('[data-hoja-opcion]')?.textContent.trim() ?? el.value]);
            return;
        }
        if (el.type === 'checkbox') {
            if (el.dataset.hojaMenor !== undefined) actual.filas.push([textoEtiqueta(form.querySelector(`label[for="${el.id}"]`)), el.checked ? 'Sí' : 'No']);
            return;
        }
        if (el.name === 'copam_theme_hp') return;
        const valor = el.tagName === 'SELECT' ? el.selectedOptions[0]?.textContent ?? '' : el.value;
        actual.filas.push([textoEtiqueta(form.querySelector(`label[for="${el.id}"]`)), valor.trim() || '—']);
    });
    return secciones.filter((s) => s.filas.length);
}

function imprimir({ numero, fecha, proveedor, secciones, observaciones }) {
    const ventana = window.open('', '_blank');
    if (!ventana) return;
    const filas = (lista) =>
        lista.map(([etiqueta, valor]) => `<tr><th>${escapar(etiqueta)}</th><td>${escapar(valor)}</td></tr>`).join('');
    ventana.document.write(`<!doctype html><html lang="es"><head><meta charset="utf-8">
<title>Hoja de reclamación ${escapar(numero)}</title>
<style>
body{font:14px/1.5 system-ui,sans-serif;color:#2B2B2B;margin:32px}
h1{font-size:20px;margin:0 0 4px}h2{font-size:15px;margin:24px 0 8px;padding-bottom:4px;border-bottom:1px solid #DADADA}
table{width:100%;border-collapse:collapse}th,td{text-align:left;vertical-align:top;padding:4px 8px 4px 0}
th{width:38%;font-weight:500;color:#6B6B6B}td{white-space:pre-line}p{margin:0}
</style></head><body>
<h1>Hoja de reclamación N.° ${escapar(numero)}</h1><p>Fecha: ${escapar(fecha)}</p>
<h2>Datos del proveedor</h2><table>${filas(proveedor)}</table>
${secciones.map((s) => `<h2>${escapar(s.titulo)}</h2><table>${filas(s.filas)}</table>`).join('')}
<h2>${escapar(observaciones.titulo)}</h2>
<p>Las completa COPAM al dar respuesta, en un plazo no mayor a quince (15) días hábiles.</p>
</body></html>`);
    ventana.document.close();
    ventana.focus();
    ventana.print();
}

export function iniciarHojaReclamacion() {
    document.querySelectorAll('[data-hoja-reclamacion]').forEach((raiz) => {
        const form = raiz.querySelector('form[data-form]');
        const exito = raiz.querySelector('[data-hoja-exito]');
        if (!form || !exito) return;

        // Fecha del día (la del HTML puede venir de una página en caché).
        const separador = raiz.dataset.hojaSeparador || '/';
        const fecha = raiz.querySelector('[data-hoja-fecha]');
        if (fecha) fecha.textContent = hoy(separador);

        // Menor de edad: abre el bloque del padre o madre y vuelve obligatorios sus campos.
        const menor = form.querySelector('[data-hoja-menor]');
        const apoderado = form.querySelector('[data-hoja-apoderado]');
        const grupo = apoderado?.querySelector('fieldset');
        const sincronizar = () => {
            const abierto = Boolean(menor?.checked);
            apoderado?.toggleAttribute('data-abierto', abierto);
            if (!grupo) return;
            grupo.disabled = !abierto;
            grupo.querySelectorAll('input').forEach((input) => {
                input.required = abierto;
                if (!abierto) {
                    input.value = '';
                    input.removeAttribute('aria-invalid');
                    const error = form.querySelector(`[data-error-for="${input.name}"]`);
                    if (error) error.textContent = '';
                }
            });
        };
        menor?.addEventListener('change', sincronizar);
        sincronizar();

        // Tipo de documento (Libro): el número cambia de largo, teclado y ejemplo según el tipo.
        const docTipo = form.querySelector('[data-hoja-doc-tipo]');
        const documento = form.querySelector('[data-hoja-documento]');
        const ajustarDocumento = () => {
            const regla = DOCUMENTOS[docTipo?.value];
            if (!regla || !documento) return;
            documento.maxLength = regla.max;
            documento.inputMode = regla.modo;
            documento.placeholder = regla.ejemplo;
        };
        docTipo?.addEventListener('change', ajustarDocumento);
        ajustarDocumento();

        const reglas = {};
        const obligatorioSiMenor = (nombre) => () =>
            menor?.checked && !form.elements.namedItem(nombre)?.value.trim() ? 'Este campo es obligatorio.' : '';
        if (menor) {
            reglas.apo_nombre = obligatorioSiMenor('apo_nombre');
            reglas.apo_documento = obligatorioSiMenor('apo_documento');
        }
        if (docTipo && documento) {
            reglas[documento.name] = () => {
                const regla = DOCUMENTOS[docTipo.value];
                const valor = documento.value.trim();
                return regla && valor && !regla.patron.test(valor) ? regla.mensaje : '';
            };
        }
        const monto = form.querySelector('[data-hoja-monto]');
        if (monto) {
            reglas[monto.name] = () => {
                const valor = monto.value.trim();
                return valor && !MONTO.test(valor) ? 'Ingresa solo números, con hasta 2 decimales.' : '';
            };
        }
        iniciarReglasExtra(form, reglas);

        // El motor valida y envía; aquí se guarda la foto de lo enviado para la copia impresa.
        let enviado = null;
        form.addEventListener('submit', () => {
            enviado = {
                proveedor: [...raiz.querySelectorAll('[data-hoja-proveedor] > div')].map((fila) => [
                    fila.querySelector('dt')?.textContent.trim() ?? '',
                    fila.querySelector('dd')?.textContent.trim() ?? '',
                ]),
                secciones: capturar(form),
                observaciones: {
                    titulo:
                        form.querySelector('[data-hoja-observaciones-titulo]')?.textContent.trim() ??
                        '4. Observaciones y acciones adoptadas por el proveedor',
                },
            };
        });
        form.addEventListener('reset', () => requestAnimationFrame(sincronizar));
        form.addEventListener('reset', () => requestAnimationFrame(ajustarDocumento));

        form.addEventListener('wp-form:success', (event) => {
            const mensaje = event.detail?.message ?? '';
            raiz.querySelector('[data-hoja-mensaje]').textContent = mensaje;
            const numero = /N\.° ([A-Z0-9-]+)/.exec(mensaje)?.[1] ?? '';
            const dia = /el (\d{2}[/-]\d{2}[/-]\d{4})/.exec(mensaje)?.[1] ?? hoy(separador);
            form.hidden = true;
            exito.hidden = false;
            exito.focus({ preventScroll: true });
            exito.scrollIntoView({ block: 'center', behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth' });

            const imprimirBtn = exito.querySelector('[data-hoja-imprimir]');
            imprimirBtn.hidden = !numero || !enviado;
            imprimirBtn.onclick = () => enviado && imprimir({ numero, fecha: dia, ...enviado });
        });
    });
}
