<?php
defined('ABSPATH') || exit;

/**
 * Operación del terminal · preguntas frecuentes (componente faq-ayuda + wp-accordion).
 * Lee el grupo `operacion_del_terminal_faq` (ACF).
 */
$grupo = get_field('operacion_del_terminal_faq') ?: [];

get_template_part('template-parts/components/faq-ayuda', null, [
    'etiqueta'    => (string) ($grupo['etiqueta'] ?? ''),
    'titulo'      => (string) ($grupo['titulo'] ?? ''),
    'descripcion' => (string) ($grupo['descripcion'] ?? ''),
    'items'       => (array) ($grupo['items'] ?? []),
]);
