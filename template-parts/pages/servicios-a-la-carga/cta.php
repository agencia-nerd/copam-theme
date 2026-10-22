<?php
defined('ABSPATH') || exit;

/**
 * Servicios a la carga · cta: bloque de cotización con imagen.
 * Lee el grupo `servicios_a_la_carga_cta` (ACF).
 */
$grupo = get_field('servicios_a_la_carga_cta') ?: [];

get_template_part('template-parts/components/cta-cotizar', null, [
    'titulo'   => (string) ($grupo['titulo'] ?? ''),
    'bajada'   => (string) ($grupo['bajada'] ?? ''),
    'boton'    => $grupo['boton'] ?? null,
    'imagen'   => $grupo['imagen'] ?? null,
    'posicion' => 'object-[50%_62%]',
]);
