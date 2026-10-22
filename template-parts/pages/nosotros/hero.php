<?php
defined('ABSPATH') || exit;

/**
 * Nosotros · hero: migas, título, bajada e imagen panorámica.
 * Lee el grupo `nosotros_hero` (ACF); el contenido inicial está en inc/acf/seed/nosotros.php.
 */
$hero = get_field('nosotros_hero') ?: [];

get_template_part('template-parts/components/hero-interno', null, [
    'migas'    => [
        ['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')],
        ['texto' => __('Nosotros', 'copam-theme')],
    ],
    'titulo'   => (string) ($hero['titulo'] ?? ''),
    'bajada'   => (string) ($hero['bajada'] ?? ''),
    'imagen'   => $hero['imagen'] ?? null,
    'posicion' => 'object-[50%_55%]',
]);
