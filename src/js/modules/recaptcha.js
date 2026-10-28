// reCAPTCHA v3: la clave llega de inc/recaptcha.php en `window.copamRecaptcha`. Sin ella no hace nada.
// El script de Google se carga al acercarse a un formulario, no en todas las páginas.

let carga = null;

const config = () => window.copamRecaptcha;

export function precargarRecaptcha() {
    const clave = config()?.siteKey;
    if (!clave) return null;
    if (!carga) {
        carga = new Promise((resolve, reject) => {
            const script = document.createElement('script');
            script.src = `https://www.google.com/recaptcha/api.js?render=${encodeURIComponent(clave)}`;
            script.async = true;
            script.onload = () => window.grecaptcha.ready(resolve);
            script.onerror = () => {
                carga = null;
                reject(new Error('recaptcha'));
            };
            document.head.append(script);
        });
    }
    return carga;
}

// Token fresco para un envío ('' si reCAPTCHA no está configurado). Dura 2 minutos: se pide al enviar.
export async function tokenRecaptcha() {
    const { siteKey, action } = config() ?? {};
    if (!siteKey) return '';
    try {
        await precargarRecaptcha();
        return await window.grecaptcha.execute(siteKey, { action });
    } catch {
        return ''; // Bloqueado por una extensión o sin red: el servidor decide.
    }
}
