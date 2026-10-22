<?php
defined('ABSPATH') || exit;

/**
 * Sistema Integrado de Gestión · hero: migas, título, bajada e imagen panorámica.
 * Lee el grupo `sistema_integrado_de_gestion_hero` (ACF); el contenido inicial está en inc/acf/seed/sistema-integrado-de-gestion.php.
 */
$hero = get_field('sistema_integrado_de_gestion_hero') ?: [];

get_template_part('template-parts/components/hero-interno', null, [
    'migas'    => [
        ['texto' => __('Inicio', 'copam-theme'), 'url' => home_url('/')],
        ['texto' => __('Nosotros', 'copam-theme'), 'url' => home_url('/nosotros/')],
        ['texto' => __('Sistema Integrado de Gestión', 'copam-theme')],
    ],
    'titulo'   => (string) ($hero['titulo'] ?? ''),
    'bajada'   => (string) ($hero['bajada'] ?? ''),
    'imagen'   => $hero['imagen'] ?? null,
    'posicion' => 'object-[50%_45%]',
]);
