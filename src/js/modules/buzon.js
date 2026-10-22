// Buzón de sugerencias (template-parts/forms/buzon-sugerencias.php). El envío es del motor de wp-form (form.js);
// aquí solo: el campo Área se abre al elegir "Trabajador de COPAM" y el placeholder del mensaje sigue al tipo.

export function iniciarBuzon() {
    document.querySelectorAll('form[data-buzon]').forEach((form) => {
        const bloque = form.querySelector('[data-buzon-area]');
        const grupo = bloque?.querySelector('fieldset');
        const mensaje = form.querySelector('[data-buzon-mensaje]');
        let textos = {};
        try {
            textos = JSON.parse(mensaje?.dataset.placeholders || '{}');
        } catch {
            textos = {};
        }

        const sincronizar = () => {
            const abierto = form.elements.namedItem('quien')?.value === 'trabajador';
            bloque?.toggleAttribute('data-abierto', abierto);
            if (grupo) {
                grupo.disabled = !abierto;
                if (!abierto) {
                    grupo.querySelectorAll('input').forEach((input) => {
                        input.value = '';
                        input.removeAttribute('aria-invalid');
                        const error = form.querySelector(`[data-error-for="${input.name}"]`);
                        if (error) error.textContent = '';
                    });
                }
            }
            const tipo = form.elements.namedItem('tipo')?.value;
            if (mensaje && textos[tipo]) mensaje.placeholder = textos[tipo];
        };

        form.addEventListener('change', (event) => {
            if (['quien', 'tipo'].includes(event.target.name)) sincronizar();
        });
        form.addEventListener('reset', () => requestAnimationFrame(sincronizar));
        sincronizar();
    });
}
