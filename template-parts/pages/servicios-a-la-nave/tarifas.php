<?php
defined('ABSPATH') || exit;

/**
 * Servicios a la nave · tarifas: tabla de prestaciones y su unidad de cobro, con una nota que enlaza al Tarifario.
 * Lee el grupo `servicios_a_la_nave_tarifas` (ACF).
 */
$grupo = get_field('servicios_a_la_nave_tarifas') ?: [];

get_template_part('template-parts/components/tabla-tarifas', null, [
    'id'                 => 'tarifas',
    'titulo'             => (string) ($grupo['titulo'] ?? ''),
    'columna_prestacion' => (string) ($grupo['columna_prestacion'] ?? ''),
    'columna_unidad'     => (string) ($grupo['columna_unidad'] ?? ''),
    'filas'              => (array) ($grupo['filas'] ?? []),
    'nota'               => (string) ($grupo['nota'] ?? ''),
]);
