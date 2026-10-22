<?php
defined('ABSPATH') || exit;

/**
 * Servicios no portuarios · preguntas frecuentes (componente faq-ayuda + wp-accordion).
 * Lee el grupo `servicios_no_portuarios_faq` (ACF).
 */
$grupo = get_field('servicios_no_portuarios_faq') ?: [];

get_template_part('template-parts/components/faq-ayuda', null, [
    'etiqueta'    => (string) ($grupo['etiqueta'] ?? ''),
    'titulo'      => (string) ($grupo['titulo'] ?? ''),
    'descripcion' => (string) ($grupo['descripcion'] ?? ''),
    'items'       => (array) ($grupo['items'] ?? []),
]);
