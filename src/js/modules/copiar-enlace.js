// "Copiar enlace" del detalle de un comunicado: copia la URL de la página y, durante 2 s, el botón dice
// "Enlace copiado" (texto en data-copiado). El aviso para lectores de pantalla va en [data-copiar-estado].
const DURACION = 2000;

// navigator.clipboard solo existe en https (o localhost); en http se copia con un textarea temporal.
async function copiar(texto) {
    if (navigator.clipboard && window.isSecureContext) {
        try {
            await navigator.clipboard.writeText(texto);
            return true;
        } catch {
            // Sin permiso: se intenta con el respaldo.
        }
    }
    const area = document.createElement('textarea');
    area.value = texto;
    area.setAttribute('readonly', '');
    area.style.cssText = 'position:fixed;top:0;left:0;opacity:0;pointer-events:none';
    document.body.appendChild(area);
    area.select();
    let ok = false;
    try {
        ok = document.execCommand('copy');
    } catch {
        ok = false;
    }
    area.remove();
    return ok;
}

export function iniciarCopiarEnlace() {
    document.querySelectorAll('[data-copiar-enlace]').forEach((boton) => {
        const original = boton.textContent;
        const copiado = boton.dataset.copiado || original;
        const estado = boton.closest('div')?.parentElement?.querySelector('[data-copiar-estado]');
        let espera = 0;

        boton.addEventListener('click', async () => {
            if (!(await copiar(window.location.href))) return;
            boton.focus();
            boton.textContent = copiado;
            if (estado) estado.textContent = copiado;
            clearTimeout(espera);
            espera = setTimeout(() => {
                boton.textContent = original;
                if (estado) estado.textContent = '';
            }, DURACION);
        });
    });
}
