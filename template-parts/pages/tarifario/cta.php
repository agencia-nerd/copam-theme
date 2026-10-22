<?php
defined('ABSPATH') || exit;

/**
 * Tarifario · cta: bloque de cotización con imagen.
 * Lee el grupo `tarifario_cta` (ACF).
 */
$grupo = get_field('tarifario_cta') ?: [];

get_template_part('template-parts/components/cta-cotizar', null, [
    'titulo'   => (string) ($grupo['titulo'] ?? ''),
    'bajada'   => (string) ($grupo['bajada'] ?? ''),
    'boton'    => $grupo['boton'] ?? null,
    'imagen'   => $grupo['imagen'] ?? null,
    'posicion' => 'object-center',
]);
