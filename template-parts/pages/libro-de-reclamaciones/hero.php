<?php
defined('ABSPATH') || exit;

/**
 * Libro de Reclamaciones · hero (sin imagen): migas Inicio › Reclamos › página, título, bajada, botón a la hoja
 * de reclamación y accesos directos.
 * Lee el grupo `libro_de_reclamaciones_hero` (ACF); el contenido inicial está en inc/acf/seed/libro-de-reclamaciones.php.
 */
$hero = get_field('libro_de_reclamaciones_hero') ?: [];

$reclamos = copam_theme_hoja_pagina('pages/template-reclamos.php');
$migas    = [['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')]];
if ($reclamos) {
    $migas[] = ['texto' => get_the_title($reclamos), 'url' => get_permalink($reclamos)];
}
$migas[] = ['texto' => get_the_title()];

// El botón siempre baja a la hoja; su texto es un campo.
$boton_texto = trim((string) ($hero['boton_texto'] ?? ''));

get_template_part('template-parts/components/hero-servicio', null, [
    'migas'          => $migas,
    'titulo'         => (string) ($hero['titulo'] ?? ''),
    'bajada'         => (string) ($hero['bajada'] ?? ''),
    'boton'          => $boton_texto !== '' ? ['title' => $boton_texto, 'url' => '#formulario', 'target' => ''] : null,
    'accesos_titulo' => (string) ($hero['accesos_titulo'] ?? ''),
    'accesos'        => array_map(static fn($fila) => $fila['enlace'] ?? null, (array) ($hero['accesos'] ?? [])),
]);
