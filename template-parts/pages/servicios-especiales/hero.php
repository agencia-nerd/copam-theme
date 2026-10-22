<?php
defined('ABSPATH') || exit;

/**
 * Servicios especiales · hero: migas, imagen, título, bajada, botón y accesos directos.
 * Lee el grupo `servicios_especiales_hero` (ACF); el contenido inicial está en inc/acf/seed/servicios-especiales.php.
 */
$hero = get_field('servicios_especiales_hero') ?: [];

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
    'posicion'       => 'object-[50%_55%]',
    'accesos_titulo' => (string) ($hero['accesos_titulo'] ?? ''),
    'accesos'        => array_map(static fn($fila) => $fila['enlace'] ?? null, (array) ($hero['accesos'] ?? [])),
]);
