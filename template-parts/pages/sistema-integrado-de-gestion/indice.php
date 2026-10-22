<?php
defined('ABSPATH') || exit;

/**
 * Sistema Integrado de Gestión · índice lateral. Los enlaces salen de los títulos de las secciones.
 * Lee el grupo `sistema_integrado_de_gestion_indice` (ACF).
 */
$indice = get_field('sistema_integrado_de_gestion_indice') ?: [];

$items = [];
foreach (['sistema', 'certificaciones', 'politica', 'documentos'] as $seccion) {
    $grupo   = get_field('sistema_integrado_de_gestion_' . $seccion) ?: [];
    $items[] = ['texto' => (string) ($grupo['titulo'] ?? ''), 'ancla' => $seccion];
}

get_template_part('template-parts/components/indice-lateral', null, [
    'titulo' => (string) ($indice['titulo'] ?? ''),
    'items'  => $items,
    'enlace' => $indice['enlace'] ?? null,
]);
