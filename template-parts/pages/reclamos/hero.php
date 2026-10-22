<?php
defined('ABSPATH') || exit;

/**
 * Reclamos · hero (sin imagen): migas, título, bajada, botón al formulario y accesos directos a las secciones.
 * Lee el grupo `reclamos_hero` (ACF); el contenido inicial está en inc/acf/seed/reclamos.php.
 */
$hero = get_field('reclamos_hero') ?: [];

get_template_part('template-parts/components/hero-servicio', null, [
    'migas'          => [
        ['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')],
        ['texto' => get_the_title()],
    ],
    'titulo'         => (string) ($hero['titulo'] ?? ''),
    'bajada'         => (string) ($hero['bajada'] ?? ''),
    'boton'          => $hero['boton'] ?? null,
    'accesos_titulo' => (string) ($hero['accesos_titulo'] ?? ''),
    'accesos'        => array_map(static fn($fila) => $fila['enlace'] ?? null, (array) ($hero['accesos'] ?? [])),
]);
