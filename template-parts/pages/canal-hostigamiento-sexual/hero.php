<?php
defined('ABSPATH') || exit;

/**
 * Canal de hostigamiento sexual · hero (sin imagen): migas Inicio › Contacto › página, título, bajada, botón al
 * reporte y accesos directos a las secciones de la página, con el título de cada sección.
 * Lee el grupo `canal_hostigamiento_sexual_hero` (ACF) y el título de cada sección.
 */
$hero = get_field('canal_hostigamiento_sexual_hero') ?: [];

$contacto = get_pages(['meta_key' => '_wp_page_template', 'meta_value' => 'pages/template-contacto.php', 'number' => 1]);
$migas    = [['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')]];
if ($contacto) {
    $migas[] = ['texto' => get_the_title($contacto[0]), 'url' => get_permalink($contacto[0])];
}
$migas[] = ['texto' => get_the_title()];

// Cada acceso lleva al ancla de su sección y usa el título que el cliente le puso.
$secciones = [
    'como_funciona' => '#como-funciona',
    'reporte'       => '#reporte',
    'politica'      => '#politica',
    'otros_canales' => '#otros-canales',
];
$accesos = [];
foreach ($secciones as $seccion => $ancla) {
    $grupo  = get_field('canal_hostigamiento_sexual_' . $seccion) ?: [];
    $titulo = trim((string) ($grupo['titulo'] ?? ''));
    if ($titulo !== '') {
        $accesos[] = ['title' => $titulo, 'url' => $ancla, 'target' => ''];
    }
}

get_template_part('template-parts/components/hero-servicio', null, [
    'migas'          => $migas,
    'titulo'         => (string) ($hero['titulo'] ?? ''),
    'bajada'         => (string) ($hero['bajada'] ?? ''),
    'boton'          => $hero['boton'] ?? null,
    'accesos_titulo' => (string) ($hero['accesos_titulo'] ?? ''),
    'accesos'        => $accesos,
]);
