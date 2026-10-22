<?php
defined('ABSPATH') || exit;

/**
 * Servicios a la nave · preguntas frecuentes (componente faq-ayuda + wp-accordion).
 * Lee el grupo `servicios_a_la_nave_faq` (ACF).
 */
$grupo = get_field('servicios_a_la_nave_faq') ?: [];

get_template_part('template-parts/components/faq-ayuda', null, [
    'etiqueta'    => (string) ($grupo['etiqueta'] ?? ''),
    'titulo'      => (string) ($grupo['titulo'] ?? ''),
    'descripcion' => (string) ($grupo['descripcion'] ?? ''),
    'items'       => (array) ($grupo['items'] ?? []),
]);
