<?php
defined('ABSPATH') || exit;

/*
 * Páginas de WordPress que crea inc/acf/runner.php. Lo genera wp-acf (generate.mjs) desde specs/_index.md:
 * no se edita a mano.
 */
return [
    'compromiso-ambiental' => ['titulo' => 'Compromiso Ambiental', 'slug' => 'compromiso-ambiental', 'frente' => false, 'plantilla' => 'pages/template-compromiso-ambiental.php', 'padre' => ''],
    'home' => ['titulo' => 'Inicio', 'slug' => 'inicio', 'frente' => true, 'plantilla' => '', 'padre' => ''],
    'nosotros' => ['titulo' => 'Nosotros', 'slug' => 'nosotros', 'frente' => false, 'plantilla' => 'pages/template-nosotros.php', 'padre' => ''],
    'servicios' => ['titulo' => 'Servicios', 'slug' => 'servicios', 'frente' => false, 'plantilla' => 'pages/template-servicios.php', 'padre' => ''],
    'servicios-a-la-carga' => ['titulo' => 'Servicios a la carga', 'slug' => 'servicios-a-la-carga', 'frente' => false, 'plantilla' => 'pages/template-servicios-a-la-carga.php', 'padre' => 'servicios'],
    'servicios-a-la-nave' => ['titulo' => 'Servicios a la nave', 'slug' => 'servicios-a-la-nave', 'frente' => false, 'plantilla' => 'pages/template-servicios-a-la-nave.php', 'padre' => 'servicios'],
    'servicios-al-pasajero' => ['titulo' => 'Servicios al pasajero', 'slug' => 'servicios-al-pasajero', 'frente' => false, 'plantilla' => 'pages/template-servicios-al-pasajero.php', 'padre' => 'servicios'],
    'servicios-especiales' => ['titulo' => 'Servicios especiales', 'slug' => 'servicios-especiales', 'frente' => false, 'plantilla' => 'pages/template-servicios-especiales.php', 'padre' => 'servicios'],
    'sistema-integrado-de-gestion' => ['titulo' => 'Sistema Integrado de Gestión', 'slug' => 'sistema-integrado-de-gestion', 'frente' => false, 'plantilla' => 'pages/template-sistema-integrado-de-gestion.php', 'padre' => ''],
];
