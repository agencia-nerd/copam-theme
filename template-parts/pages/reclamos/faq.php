<?php
defined('ABSPATH') || exit;

/**
 * Reclamos · preguntas frecuentes (componente faq-ayuda + wp-accordion).
 * Lee el grupo `reclamos_faq` (ACF).
 */
$grupo = get_field('reclamos_faq') ?: [];

get_template_part('template-parts/components/faq-ayuda', null, [
    'etiqueta'    => __('Ayuda', 'copam-theme'),
    'titulo'      => (string) ($grupo['titulo'] ?? ''),
    'descripcion' => (string) ($grupo['bajada'] ?? ''),
    'items'       => (array) ($grupo['items'] ?? []),
]);
