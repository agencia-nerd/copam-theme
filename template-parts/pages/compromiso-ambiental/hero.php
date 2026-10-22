<?php
defined('ABSPATH') || exit;

/**
 * Compromiso Ambiental · hero: migas, título, bajada e imagen panorámica.
 * Lee el grupo `compromiso_ambiental_hero` (ACF); el contenido inicial está en inc/acf/seed/compromiso-ambiental.php.
 */
$hero = get_field('compromiso_ambiental_hero') ?: [];

get_template_part('template-parts/components/hero-interno', null, [
    'migas'  => [
        ['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')],
        ['texto' => __('Nosotros', 'copam-theme'), 'url' => home_url('/nosotros/')],
        ['texto' => __('Compromiso Ambiental', 'copam-theme')],
    ],
    'titulo' => (string) ($hero['titulo'] ?? ''),
    'bajada' => (string) ($hero['bajada'] ?? ''),
    'imagen' => $hero['imagen'] ?? null,
]);
