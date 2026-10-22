<?php
defined('ABSPATH') || exit;

/**
 * Servicios a la carga · preguntas frecuentes (componente faq-ayuda + wp-accordion).
 * Lee el grupo `servicios_a_la_carga_faq` (ACF). La etiqueta del encabezado es fija (no es campo en esta página).
 */
$grupo = get_field('servicios_a_la_carga_faq') ?: [];

get_template_part('template-parts/components/faq-ayuda', null, [
    'etiqueta'    => __('Ayuda', 'copam-theme'),
    'titulo'      => (string) ($grupo['titulo'] ?? ''),
    'descripcion' => (string) ($grupo['descripcion'] ?? ''),
    'items'       => (array) ($grupo['items'] ?? []),
]);
