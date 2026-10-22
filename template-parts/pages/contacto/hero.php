<?php
defined('ABSPATH') || exit;

/**
 * Contacto · hero: migas, imagen, título, bajada, botón al formulario y accesos directos.
 * Lee el grupo `contacto_hero` (ACF); el contenido inicial está en inc/acf/seed/contacto.php.
 */
$hero = get_field('contacto_hero') ?: [];

get_template_part('template-parts/components/hero-servicio', null, [
    'migas'          => [
        ['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')],
        ['texto' => get_the_title()],
    ],
    'titulo'         => (string) ($hero['titulo'] ?? ''),
    'bajada'         => (string) ($hero['bajada'] ?? ''),
    'boton'          => $hero['boton'] ?? null,
    'imagen'         => $hero['imagen'] ?? null,
    'posicion'       => 'object-[100%_58%]',
    'accesos_titulo' => (string) ($hero['accesos_titulo'] ?? ''),
    'accesos'        => array_map(static fn($fila) => $fila['enlace'] ?? null, (array) ($hero['accesos'] ?? [])),
]);
