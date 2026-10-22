<?php
defined('ABSPATH') || exit;

/**
 * Normativa OSITRAN · hero: migas, título, bajada, botón al portal de OSITRAN y accesos directos (sin imagen).
 * Lee el grupo `normativa_ositran_hero` (ACF); el contenido inicial está en inc/acf/seed/normativa-ositran.php.
 */
$hero = get_field('normativa_ositran_hero') ?: [];

get_template_part('template-parts/components/hero-servicio', null, [
    'migas'          => [
        ['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')],
        ['texto' => __('Reglamentos', 'copam-theme')],
        ['texto' => get_the_title()],
    ],
    'titulo'         => (string) ($hero['titulo'] ?? ''),
    'bajada'         => (string) ($hero['bajada'] ?? ''),
    'boton'          => $hero['boton'] ?? null,
    'accesos_titulo' => (string) ($hero['accesos_titulo'] ?? ''),
    'accesos'        => array_map(static fn($fila) => $fila['enlace'] ?? null, (array) ($hero['accesos'] ?? [])),
]);
