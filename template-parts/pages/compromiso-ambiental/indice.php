<?php
defined('ABSPATH') || exit;

/**
 * Compromiso Ambiental · índice lateral. Los enlaces salen de los títulos de las secciones.
 * Lee el grupo `compromiso_ambiental_indice` (ACF).
 */
$indice = get_field('compromiso_ambiental_indice') ?: [];

$items = [];
foreach (['compromiso', 'politica', 'operacion', 'instrumentos', 'cumplimiento'] as $seccion) {
    $grupo   = get_field('compromiso_ambiental_' . $seccion) ?: [];
    $items[] = ['texto' => (string) ($grupo['titulo'] ?? ''), 'ancla' => $seccion];
}

get_template_part('template-parts/components/indice-lateral', null, [
    'titulo' => (string) ($indice['titulo'] ?? ''),
    'items'  => $items,
    'enlace' => $indice['enlace'] ?? null,
]);
