<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Política de privacidad (spec `privacidad`). Lo carga inc/acf/runner.php una sola vez por
 * grupo; lo que el cliente edite en el admin no se vuelve a pisar.
 * El texto de las cláusulas y la fecha son provisionales del diseño: COPAM debe entregarlos.
 */
return [
    'page'   => 'privacidad',
    'fields' => [
        'privacidad_hero' => [
            'titulo'        => 'Privacidad',
            'actualizacion' => 'Última actualización: por definir.',
        ],
        'privacidad_contenido' => [
            'texto' => implode("\n", [
                '<h2>1. Responsable del tratamiento</h2>',
                '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                '<h2>2. Datos personales que se recopilan</h2>',
                '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                '<h2>3. Finalidades del tratamiento</h2>',
                '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                '<h2>4. Destinatarios</h2>',
                '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                '<h2>5. Plazo de conservación</h2>',
                '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                '<h2>6. Transferencias</h2>',
                '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                '<h2>7. Derechos del titular y cómo ejercerlos</h2>',
                '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
                '<h2>8. Banco de datos inscrito</h2>',
                '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
            ]),
        ],
    ],
];
