<?php
defined('ABSPATH') || exit;

/**
 * Operación del terminal · cta: bloque de contacto con imagen.
 * Lee el grupo `operacion_del_terminal_cta` (ACF).
 */
$grupo = get_field('operacion_del_terminal_cta') ?: [];

get_template_part('template-parts/components/cta-cotizar', null, [
    'titulo'   => (string) ($grupo['titulo'] ?? ''),
    'bajada'   => (string) ($grupo['bajada'] ?? ''),
    'boton'    => $grupo['boton'] ?? null,
    'imagen'   => $grupo['imagen'] ?? null,
    'posicion' => 'object-[55%_62%]',
]);
