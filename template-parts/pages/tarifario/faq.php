<?php
defined('ABSPATH') || exit;

/**
 * Tarifario · preguntas frecuentes (componente faq-ayuda + wp-accordion).
 * Lee el grupo `tarifario_faq` (ACF).
 */
$grupo = get_field('tarifario_faq') ?: [];

get_template_part('template-parts/components/faq-ayuda', null, [
    'etiqueta'    => (string) ($grupo['etiqueta'] ?? ''),
    'titulo'      => (string) ($grupo['titulo'] ?? ''),
    'descripcion' => (string) ($grupo['descripcion'] ?? ''),
    'items'       => (array) ($grupo['items'] ?? []),
]);
