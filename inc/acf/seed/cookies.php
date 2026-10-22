<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Política de cookies (spec `cookies`). Lo carga inc/acf/runner.php una sola vez por grupo;
 * lo que el cliente edite en el admin no se vuelve a pisar.
 * El texto de las cláusulas y la fecha son provisionales del diseño: COPAM debe entregarlos.
 */
return [
    'page'   => 'cookies',
    'fields' => [
        'cookies_hero' => [
            'titulo'        => 'Cookies',
            'actualizacion' => 'Última actualización: por definir.',
        ],
        'cookies_contenido' => [
            'texto' => implode("\n", [
                '<h2>1. Qué son las cookies</h2>',
                '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                '<h2>2. Cookies que utilizamos</h2>',
                '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                '<h2>3. Cómo gestionar las cookies</h2>',
                '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
            ]),
        ],
    ],
];
