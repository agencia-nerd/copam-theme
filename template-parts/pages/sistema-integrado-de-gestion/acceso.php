<?php
defined('ABSPATH') || exit;

/**
 * Sistema Integrado de Gestión · acceso: bloque de cierre en columna.
 * Lee el grupo `sistema_integrado_de_gestion_acceso` (ACF).
 */
$grupo = get_field('sistema_integrado_de_gestion_acceso') ?: [];

get_template_part('template-parts/components/bloque-acceso', null, [
    'variante'    => 'columna',
    'titulo'      => (string) ($grupo['titulo'] ?? ''),
    'descripcion' => (string) ($grupo['descripcion'] ?? ''),
    'boton'       => $grupo['boton'] ?? null,
    'imagen'      => $grupo['imagen'] ?? null,
]);
