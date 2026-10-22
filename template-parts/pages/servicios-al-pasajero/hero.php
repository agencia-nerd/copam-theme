<?php
defined('ABSPATH') || exit;

/**
 * Servicios al pasajero · hero: migas, imagen, título, bajada, botón y accesos directos.
 * Lee el grupo `servicios_al_pasajero_hero` (ACF); el contenido inicial está en inc/acf/seed/servicios-al-pasajero.php.
 */
$hero = get_field('servicios_al_pasajero_hero') ?: [];

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
    'posicion'       => 'object-center',
    'accesos_titulo' => (string) ($hero['accesos_titulo'] ?? ''),
    'accesos'        => array_map(static fn($fila) => $fila['enlace'] ?? null, (array) ($hero['accesos'] ?? [])),
]);
