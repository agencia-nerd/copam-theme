<?php
defined('ABSPATH') || exit;

/**
 * Nosotros · índice lateral. Los enlaces salen de los títulos de las secciones (no son campos propios).
 * Lee el grupo `nosotros_indice` (ACF).
 */
$indice = get_field('nosotros_indice') ?: [];

$items = [];
foreach (['mision', 'vision', 'concesion', 'sistema', 'operamos'] as $seccion) {
    $grupo   = get_field('nosotros_' . $seccion) ?: [];
    $items[] = ['texto' => (string) ($grupo['titulo'] ?? ''), 'ancla' => $seccion];
}

get_template_part('template-parts/components/indice-lateral', null, [
    'titulo' => (string) ($indice['titulo'] ?? ''),
    'items'  => $items,
    'enlace' => $indice['enlace'] ?? null,
]);
