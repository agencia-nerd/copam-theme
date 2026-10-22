<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Términos y condiciones (spec `terminos`). Lo carga inc/acf/runner.php una sola vez por
 * grupo; lo que el cliente edite en el admin no se vuelve a pisar.
 * El texto de las cláusulas y la fecha son provisionales del diseño: COPAM debe entregarlos.
 * Cada h2 alimenta el índice lateral (copam_theme_texto_legal le da su id).
 */
return [
    'page'   => 'terminos',
    'fields' => [
        'terminos_hero' => [
            'titulo'        => 'Términos',
            'actualizacion' => 'Última actualización: por definir.',
        ],
        'terminos_contenido' => [
            'texto' => implode("\n", [
                '<h2>1. Aceptación de los términos</h2>',
                '<p>[Aquí irá el texto de esta sección, a definir por COPAM.]</p>',
                '<h2>2. Uso del sitio web</h2>',
                '<p>[Aquí irá el texto de esta sección, a definir por COPAM.]</p>',
                '<h2>3. Propiedad intelectual</h2>',
                '<p>[Aquí irá el texto de esta sección, a definir por COPAM.]</p>',
                '<h2>4. Información y documentos publicados</h2>',
                '<p>[Aquí irá el texto de esta sección, a definir por COPAM.]</p>',
                '<h2>5. Enlaces a sitios de terceros</h2>',
                '<p>[Aquí irá el texto de esta sección, a definir por COPAM.]</p>',
                '<h2>6. Limitación de responsabilidad</h2>',
                '<p>[Aquí irá el texto de esta sección, a definir por COPAM.]</p>',
                '<h2>7. Protección de datos personales</h2>',
                '<p>[Aquí irá el texto de esta sección, a definir por COPAM.]</p>',
                '<h2>8. Modificaciones de los términos</h2>',
                '<p>[Aquí irá el texto de esta sección, a definir por COPAM.]</p>',
                '<h2>9. Legislación aplicable y jurisdicción</h2>',
                '<p>[Aquí irá el texto de esta sección, a definir por COPAM.]</p>',
                '<h2>10. Contacto</h2>',
                '<p>[Aquí irá el texto de esta sección, a definir por COPAM.]</p>',
            ]),
        ],
    ],
];
