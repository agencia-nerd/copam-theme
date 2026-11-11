<?php
defined('ABSPATH') || exit;

/*
 * Línea legal del pie (web y correos). Es fija; solo el año cambia solo, con la zona horaria de Ajustes > Generales.
 *
 *   <?= esc_html(copam_theme_copyright()) ?>
 */
function copam_theme_copyright(): string
{
    return sprintf(
        /* translators: %s: año actual */
        __('© %s Concesionaria Puerto Amazonas S.A. · RUC 20543480291', 'copam-theme'),
        wp_date('Y')
    );
}
