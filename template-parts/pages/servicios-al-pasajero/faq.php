<?php
defined('ABSPATH') || exit;

/**
 * Servicios al pasajero · preguntas frecuentes (componente faq-ayuda + wp-accordion).
 * Lee el grupo `servicios_al_pasajero_faq` (ACF).
 */
$grupo = get_field('servicios_al_pasajero_faq') ?: [];

get_template_part('template-parts/components/faq-ayuda', null, [
    'etiqueta'    => (string) ($grupo['etiqueta'] ?? ''),
    'titulo'      => (string) ($grupo['titulo'] ?? ''),
    'descripcion' => (string) ($grupo['descripcion'] ?? ''),
    'items'       => (array) ($grupo['items'] ?? []),
]);
