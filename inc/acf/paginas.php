<?php
defined('ABSPATH') || exit;

/*
 * Páginas de WordPress que crea inc/acf/runner.php. Lo genera wp-acf (generate.mjs) desde specs/_index.md:
 * no se edita a mano.
 */
return [
    'compromiso-ambiental' => ['titulo' => 'Compromiso Ambiental', 'slug' => 'compromiso-ambiental', 'frente' => false, 'plantilla' => 'pages/template-compromiso-ambiental.php'],
    'home' => ['titulo' => 'Inicio', 'slug' => 'inicio', 'frente' => true, 'plantilla' => ''],
    'nosotros' => ['titulo' => 'Nosotros', 'slug' => 'nosotros', 'frente' => false, 'plantilla' => 'pages/template-nosotros.php'],
    'sistema-integrado-de-gestion' => ['titulo' => 'Sistema Integrado de Gestión', 'slug' => 'sistema-integrado-de-gestion', 'frente' => false, 'plantilla' => 'pages/template-sistema-integrado-de-gestion.php'],
];
