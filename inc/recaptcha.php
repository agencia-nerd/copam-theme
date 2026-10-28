<?php
defined('ABSPATH') || exit;

/*
 * reCAPTCHA v3 en todos los formularios (los que pasan por el motor de inc/forms.php).
 *
 * Las claves no van en el repo: se definen en wp-config.php de cada entorno.
 *   define('COPAM_THEME_RECAPTCHA_SITE_KEY', '...');
 *   define('COPAM_THEME_RECAPTCHA_SECRET_KEY', '...');
 * Sin las dos constantes no se carga ni se exige nada (local sin claves, o antes de configurarlo).
 *
 * Front: src/js/modules/recaptcha.js carga el script de Google al acercarse al form y form.js manda el token
 * en el campo `recaptcha`. Aquí se verifica antes de que el motor procese el envío (prioridad 0).
 */

const COPAM_THEME_RECAPTCHA_ACTION = 'copam_form';
const COPAM_THEME_RECAPTCHA_MIN_SCORE = 0.5;
const COPAM_THEME_RECAPTCHA_VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

function copam_theme_recaptcha_site_key()
{
    return defined('COPAM_THEME_RECAPTCHA_SITE_KEY') ? (string) COPAM_THEME_RECAPTCHA_SITE_KEY : '';
}

function copam_theme_recaptcha_secret_key()
{
    return defined('COPAM_THEME_RECAPTCHA_SECRET_KEY') ? (string) COPAM_THEME_RECAPTCHA_SECRET_KEY : '';
}

function copam_theme_recaptcha_enabled()
{
    return copam_theme_recaptcha_site_key() !== '' && copam_theme_recaptcha_secret_key() !== '';
}

// La clave pública llega al JS antes del bundle.
function copam_theme_recaptcha_config()
{
    if (!copam_theme_recaptcha_enabled()) {
        return;
    }

    wp_add_inline_script(
        'copam-theme-js',
        'window.copamRecaptcha=' . wp_json_encode(['siteKey' => copam_theme_recaptcha_site_key(), 'action' => COPAM_THEME_RECAPTCHA_ACTION]) . ';',
        'before'
    );
}
add_action('wp_enqueue_scripts', 'copam_theme_recaptcha_config', 20);

// Verifica el token contra Google. Un error de Google o de configuración no bloquea el envío
// (queda en el log); un token ausente, vencido o con puntaje bajo sí.
function copam_theme_recaptcha_verificar()
{
    if (!copam_theme_recaptcha_enabled()) {
        return;
    }
    // Un bot con el honeypot lleno lo resuelve el motor.
    if (!empty($_POST[COPAM_THEME_FORM_HONEYPOT])) { // phpcs:ignore WordPress.Security.NonceVerification -- lo verifica el motor
        return;
    }

    $form_id = isset($_POST['form']) ? sanitize_key(wp_unslash($_POST['form'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification
    $token   = isset($_POST['recaptcha']) ? sanitize_text_field(wp_unslash($_POST['recaptcha'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification
    $rechazo = 'No pudimos verificar que eres una persona. Recarga la página e intenta de nuevo; si usas un bloqueador, desactívalo para este sitio.';

    if ($token === '') {
        copam_theme_form_log("reCAPTCHA: envío sin token en \"$form_id\".");
        copam_theme_form_error($rechazo, 403, ['code' => 'recaptcha']);
    }

    $respuesta = wp_remote_post(COPAM_THEME_RECAPTCHA_VERIFY_URL, [
        'timeout' => 5,
        'body'    => [
            'secret'   => copam_theme_recaptcha_secret_key(),
            'response' => $token,
            'remoteip' => copam_theme_form_client_ip(),
        ],
    ]);
    if (is_wp_error($respuesta) || (int) wp_remote_retrieve_response_code($respuesta) !== 200) {
        copam_theme_form_log('reCAPTCHA: Google no respondió, el envío sigue sin verificar.');
        return;
    }

    $datos = json_decode(wp_remote_retrieve_body($respuesta), true);
    if (!is_array($datos)) {
        copam_theme_form_log('reCAPTCHA: respuesta ilegible, el envío sigue sin verificar.');
        return;
    }

    if (empty($datos['success'])) {
        $errores = (array) ($datos['error-codes'] ?? []);
        // Clave secreta mal puesta: es un error del sitio, no del visitante.
        if (array_intersect($errores, ['missing-input-secret', 'invalid-input-secret', 'bad-request'])) {
            copam_theme_form_log('reCAPTCHA: configuración inválida (' . implode(', ', $errores) . '), el envío sigue sin verificar.');
            return;
        }
        copam_theme_form_log("reCAPTCHA: token rechazado en \"$form_id\" (" . implode(', ', $errores) . ').');
        copam_theme_form_error($rechazo, 403, ['code' => 'recaptcha']);
    }

    $minimo = (float) apply_filters('copam_theme_recaptcha_min_score', COPAM_THEME_RECAPTCHA_MIN_SCORE, $form_id);
    $score  = (float) ($datos['score'] ?? 0);
    if (($datos['action'] ?? '') !== COPAM_THEME_RECAPTCHA_ACTION || $score < $minimo) {
        copam_theme_form_log(sprintf('reCAPTCHA: puntaje %.1f (mínimo %.1f) en "%s".', $score, $minimo, $form_id));
        copam_theme_form_error($rechazo, 403, ['code' => 'recaptcha']);
    }
}
add_action('wp_ajax_copam_theme_form_submit', 'copam_theme_recaptcha_verificar', 0);
add_action('wp_ajax_nopriv_copam_theme_form_submit', 'copam_theme_recaptcha_verificar', 0);
