<?php
defined('ABSPATH') || exit;

/**
 * Servicios no portuarios · hero: migas, imagen, título, bajada, botón y accesos directos.
 * Lee el grupo `servicios_no_portuarios_hero` (ACF); el contenido inicial está en inc/acf/seed/servicios-no-portuarios.php.
 */
$hero = get_field('servicios_no_portuarios_hero') ?: [];

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
    'posicion'       => 'object-[center_40%]',
    'accesos_titulo' => (string) ($hero['accesos_titulo'] ?? ''),
    'accesos'        => array_map(static fn($fila) => $fila['enlace'] ?? null, (array) ($hero['accesos'] ?? [])),
]);
