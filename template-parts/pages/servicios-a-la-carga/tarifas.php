<?php
defined('ABSPATH') || exit;

/**
 * Servicios a la carga · tarifas: tabla de tipos de carga y su unidad de cobro, con una nota que enlaza al Tarifario.
 * Lee el grupo `servicios_a_la_carga_tarifas` (ACF). La cabecera de la tabla es fija (no es campo).
 */
$grupo = get_field('servicios_a_la_carga_tarifas') ?: [];
$filas = array_map(static fn($fila): array => [
    'prestacion' => (string) ($fila['tipo_carga'] ?? ''),
    'unidad'     => (string) ($fila['unidad_cobro'] ?? ''),
], (array) ($grupo['filas'] ?? []));

get_template_part('template-parts/components/tabla-tarifas', null, [
    'id'                 => 'tarifas',
    'titulo'             => (string) ($grupo['titulo'] ?? ''),
    'columna_prestacion' => __('Tipo de carga', 'copam-theme'),
    'columna_unidad'     => __('Unidad de cobro', 'copam-theme'),
    'filas'              => $filas,
    'nota'               => (string) ($grupo['nota'] ?? ''),
]);
