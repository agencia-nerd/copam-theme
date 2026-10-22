<?php
defined('ABSPATH') || exit;

/**
 * Nosotros · acceso: bloque de cierre en columna.
 * Lee el grupo `nosotros_acceso` (ACF).
 */
$grupo = get_field('nosotros_acceso') ?: [];

get_template_part('template-parts/components/bloque-acceso', null, [
    'variante'    => 'columna',
    'titulo'      => (string) ($grupo['titulo'] ?? ''),
    'descripcion' => (string) ($grupo['descripcion'] ?? ''),
    'boton'       => $grupo['boton'] ?? null,
    'imagen'      => $grupo['imagen'] ?? null,
]);
