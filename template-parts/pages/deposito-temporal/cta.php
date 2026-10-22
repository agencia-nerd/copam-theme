<?php
defined('ABSPATH') || exit;

/**
 * Depósito Temporal · cta: bloque de contacto con imagen (componente cta-cotizar).
 * Lee el grupo `deposito_temporal_cta` (ACF).
 */
$grupo = get_field('deposito_temporal_cta') ?: [];

get_template_part('template-parts/components/cta-cotizar', null, [
    'titulo'   => (string) ($grupo['titulo'] ?? ''),
    'bajada'   => (string) ($grupo['bajada'] ?? ''),
    'boton'    => $grupo['boton'] ?? null,
    'imagen'   => $grupo['imagen'] ?? null,
    'posicion' => 'object-[62%_62%]',
]);
