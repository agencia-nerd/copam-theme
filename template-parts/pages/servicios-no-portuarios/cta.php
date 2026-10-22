<?php
defined('ABSPATH') || exit;

/**
 * Servicios no portuarios · cta: bloque de cotización con imagen.
 * Lee el grupo `servicios_no_portuarios_cta` (ACF).
 */
$grupo = get_field('servicios_no_portuarios_cta') ?: [];

get_template_part('template-parts/components/cta-cotizar', null, [
    'titulo'   => (string) ($grupo['titulo'] ?? ''),
    'bajada'   => (string) ($grupo['bajada'] ?? ''),
    'boton'    => $grupo['boton'] ?? null,
    'imagen'   => $grupo['imagen'] ?? null,
    'posicion' => 'object-[52%_62%]',
]);
