<?php
defined('ABSPATH') || exit;

/**
 * Servicios al pasajero · cta: bloque de cotización con imagen.
 * Lee el grupo `servicios_al_pasajero_cta` (ACF).
 */
$grupo = get_field('servicios_al_pasajero_cta') ?: [];

get_template_part('template-parts/components/cta-cotizar', null, [
    'titulo'   => (string) ($grupo['titulo'] ?? ''),
    'bajada'   => (string) ($grupo['bajada'] ?? ''),
    'boton'    => $grupo['boton'] ?? null,
    'imagen'   => $grupo['imagen'] ?? null,
    'posicion' => 'object-center',
]);
