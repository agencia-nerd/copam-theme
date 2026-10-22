<?php
defined('ABSPATH') || exit;

/**
 * Servicios a la carga · hero: migas, imagen, título, bajada, botón y accesos directos.
 * Lee el grupo `servicios_a_la_carga_hero` (ACF); el contenido inicial está en inc/acf/seed/servicios-a-la-carga.php.
 * Los destinos de los accesos son las anclas fijas de la página, en orden; solo el texto es editable.
 */
$hero    = get_field('servicios_a_la_carga_hero') ?: [];
$anclas  = ['#que-incluye', '#tarifas', '#documentos', '#faq'];
$accesos = [];
foreach (array_values((array) ($hero['accesos'] ?? [])) as $i => $fila) {
    if (isset($anclas[$i])) {
        $accesos[] = ['title' => (string) ($fila['texto'] ?? ''), 'url' => $anclas[$i]];
    }
}

get_template_part('template-parts/components/hero-servicio', null, [
    'migas'          => [
        ['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')],
        ['texto' => __('Zona Clientes', 'copam-theme')],
        ['texto' => get_the_title()],
    ],
    'titulo'         => (string) ($hero['titulo'] ?? ''),
    'bajada'         => (string) ($hero['bajada'] ?? ''),
    'boton'          => $hero['boton'] ?? null,
    'imagen'         => $hero['imagen'] ?? null,
    'posicion'       => 'object-[50%_44%]',
    'accesos_titulo' => (string) ($hero['accesos_titulo'] ?? ''),
    'accesos'        => $accesos,
]);
