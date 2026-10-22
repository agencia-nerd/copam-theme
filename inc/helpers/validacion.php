<?php
defined('ABSPATH') || exit;

/*
 * Reglas extra de los formularios que el motor de wp-form no expresa (un formato que depende de otro campo,
 * un monto con decimales). Corre antes del envío del motor: si el form tiene errores extra, responde 422 con
 * todos los errores juntos (los del motor y los extra), igual que el motor; si no, el motor sigue como siempre.
 *
 * Cada form agrega los suyos con el filtro `copam_theme_form_errores_extra`:
 *   add_filter('copam_theme_form_errores_extra', function ($errores, $form_id, $data) { ... return $errores; }, 10, 3);
 * donde $data son los valores ya saneados por el motor y $errores es ['campo' => 'mensaje'].
 */
add_action('wp_ajax_copam_theme_form_submit', 'copam_theme_form_validar_extra', 1);
add_action('wp_ajax_nopriv_copam_theme_form_submit', 'copam_theme_form_validar_extra', 1);
function copam_theme_form_validar_extra()
{
    $form_id = isset($_POST['form']) ? sanitize_key(wp_unslash($_POST['form'])) : ''; // phpcs:ignore WordPress.Security.NonceVerification -- se verifica abajo
    $form    = $form_id !== '' ? copam_theme_get_form($form_id) : null;
    if (!$form || !has_filter('copam_theme_form_errores_extra')) {
        return;
    }
    // Sin nonce válido o con el honeypot lleno, decide el motor.
    if (!check_ajax_referer(COPAM_THEME_FORM_NONCE, 'nonce', false) || !empty($_POST[COPAM_THEME_FORM_HONEYPOT])) {
        return;
    }

    [$data, $errores] = copam_theme_validate_form($form, $_POST);
    $extra = (array) apply_filters('copam_theme_form_errores_extra', [], $form_id, $data);
    $extra = array_diff_key(array_filter($extra), $errores);
    if ($extra) {
        copam_theme_form_error('Revisa los campos marcados.', 422, ['fields' => $errores + $extra]);
    }
}
