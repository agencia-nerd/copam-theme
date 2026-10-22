// Reglas de un form que el motor de wp-form no expresa: un campo obligatorio solo en un caso, un formato que
// depende de otro campo. Las mismas reglas están en PHP (filtro copam_theme_form_errores_extra o la definición
// del form); aquí solo se muestran antes, con los mismos mensajes y en la misma caja de error del motor.
//
// reglas: { campo: (form) => 'mensaje' | '' }

const caja = (form, nombre) => form.querySelector(`[data-error-for="${CSS.escape(nombre)}"]`);

function marcar(form, nombre, mensaje) {
    const error = caja(form, nombre);
    if (error) error.textContent = mensaje;
    form.querySelectorAll(`[name="${CSS.escape(nombre)}"]`).forEach((input) => {
        if (mensaje) input.setAttribute('aria-invalid', 'true');
        else input.removeAttribute('aria-invalid');
    });
}

// Aplica la regla solo si el motor no dejó ya un error en ese campo.
function revisar(form, reglas, nombre) {
    const regla = reglas[nombre];
    if (!regla) return '';
    const mensaje = regla(form);
    const error = caja(form, nombre);
    if (mensaje && !error?.textContent) marcar(form, nombre, mensaje);
    return mensaje;
}

export function iniciarReglasExtra(form, reglas) {
    // Después del motor, que en focusout e input valida con sus reglas y podría borrar el error extra.
    const despues = (event) => {
        const { name } = event.target;
        if (reglas[name]) setTimeout(() => revisar(form, reglas, name));
    };
    form.addEventListener('focusout', despues);
    form.addEventListener('input', despues);
    form.addEventListener('change', despues);

    // Antes del envío del motor: si falla una regla extra, se muestran todos los errores y no se envía.
    form.addEventListener(
        'submit',
        (event) => {
            const fallan = Object.keys(reglas).filter((nombre) => reglas[nombre](form));
            if (!fallan.length) return;
            event.preventDefault();
            event.stopImmediatePropagation();

            // El motor valida cada campo al salir de él o al cambiarlo: se le pide revisar todos.
            form.querySelectorAll('[name]').forEach((campo) => {
                if (campo.disabled || campo.type === 'hidden') return;
                const tipo = ['radio', 'checkbox'].includes(campo.type) || campo.tagName === 'SELECT' ? 'change' : 'focusout';
                campo.dispatchEvent(new Event(tipo, { bubbles: true }));
            });
            setTimeout(() => {
                fallan.forEach((nombre) => revisar(form, reglas, nombre));
                const status = form.querySelector('[data-form-status]');
                if (status) {
                    status.textContent = 'Revisa los campos marcados.';
                    status.dataset.state = 'error';
                }
                form.querySelector('[aria-invalid="true"]')?.focus();
            });
        },
        true
    );
}
