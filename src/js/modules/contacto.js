// Contacto (template-parts/pages/contacto/). El envío es del motor de wp-form (form.js); aquí solo:
// - el botón de una tarjeta de Canales que baja al formulario deja elegida el área de esa tarjeta;
// - tras enviar, el botón dice "Mensaje enviado" unos segundos, como en el diseño.

const normalizar = (texto) => texto.normalize('NFD').replace(/\p{M}/gu, '').trim().toLowerCase();

export function iniciarContacto() {
    const form = document.querySelector('[data-contacto-form]');
    if (!form) return;
    const area = form.querySelector('[data-contacto-area]');

    document.querySelectorAll('[data-canales] article').forEach((tarjeta) => {
        const titulo = normalizar(tarjeta.querySelector('h2, h3, h4')?.textContent ?? '');
        tarjeta.querySelectorAll(`a[href$="#${form.closest('section')?.id || 'formulario'}"]`).forEach((enlace) => {
            enlace.addEventListener('click', () => {
                const opcion = [...(area?.options ?? [])].find((o) => o.value && normalizar(o.textContent) === titulo);
                if (!opcion) return;
                area.value = opcion.value;
                area.dispatchEvent(new Event('change', { bubbles: true }));
            });
        });
    });

    const etiqueta = form.querySelector('[data-submit-label]');
    const etiquetas = etiqueta ? [etiqueta, etiqueta.nextElementSibling].filter(Boolean) : [];
    const inicial = etiqueta?.textContent ?? '';
    form.addEventListener('wp-form:success', () => {
        // form.js restaura la etiqueta al terminar el envío; se cambia después.
        setTimeout(() => {
            etiquetas.forEach((el) => (el.textContent = 'Mensaje enviado'));
            setTimeout(() => etiquetas.forEach((el) => (el.textContent = inicial)), 4000);
        });
    });
}
