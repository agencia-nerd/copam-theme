<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Servicios no portuarios (spec `servicios-no-portuarios`). Lo carga inc/acf/runner.php una sola vez por grupo:
 * lo que el cliente edite después no se sobrescribe. Los enlaces a páginas del sitio son rutas relativas (/pagina/), así funcionan igual en local y en producción.
 */
return [
    'page'   => 'servicios-no-portuarios',
    'fields' => [
        'servicios_no_portuarios_hero' => [
            'titulo'         => 'No portuarios',
            'bajada'         => 'Uso de áreas, servicios complementarios y facilidades prestadas a terceros dentro del recinto del Terminal Portuario de Yurimaguas – Nueva Reforma.',
            'boton'          => ['title' => 'Solicitar cotización', 'url' => '/contacto/#formulario'],
            'imagen'         => ['_file' => 'assets/img/servicio-noportuarios-hero.jpg', 'alt' => 'Superficie del río Huallaga'],
            'accesos_titulo' => 'Accesos directos',
            'accesos'        => [
                ['enlace' => ['title' => 'Qué incluye', 'url' => '#que-incluye']],
                ['enlace' => ['title' => 'Tarifas y precios', 'url' => '#tarifas']],
                ['enlace' => ['title' => 'Documentos relacionados', 'url' => '#documentos']],
                ['enlace' => ['title' => 'Preguntas frecuentes', 'url' => '#faq']],
            ],
        ],

        'servicios_no_portuarios_que_incluye' => [
            'titulo' => 'Qué incluye',
            'items'  => [
                ['titulo' => 'Uso de áreas', 'descripcion' => 'Uso de espacios dentro del recinto portuario por parte de terceros.'],
                ['titulo' => 'Servicios complementarios', 'descripcion' => 'Servicios de apoyo prestados dentro del terminal, distintos de los servicios portuarios estándar.'],
                ['titulo' => 'Facilidades a terceros', 'descripcion' => 'Facilidades brindadas a usuarios y empresas que operan dentro del recinto.'],
            ],
        ],

        'servicios_no_portuarios_tarifas' => [
            'titulo'      => 'Tarifas y precios',
            'texto'       => 'Las tarifas y los precios de estos servicios figuran en el Tarifario de Servicios Portuarios vigente, aprobado por OSITRAN. Descarga el documento oficial para consultar el detalle de cada prestación.',
            'boton_texto' => 'Descargar tarifario vigente',
            'tarifario'   => ['_file' => 'assets/docs/tarifario-2026-06-16.pdf'],
            'versiones'   => ['title' => 'Ver versiones anteriores', 'url' => '/tarifario/#versiones'],
        ],

        'servicios_no_portuarios_documentos' => [
            'titulo' => 'Documentos relacionados',
            'items'  => [
                ['etiqueta' => 'Reglamento', 'titulo' => 'Reglamento de Tarifas y Precios de COPAM · V 5.3', 'fecha' => 'Vigente desde junio de 2026', 'archivo' => ['_file' => 'assets/docs/reta-v5-3.pdf']],
                ['etiqueta' => 'Reglamento', 'titulo' => 'Reglamento de Operaciones · REIN-TPY-001', 'fecha' => 'Aprobado el 15-06-2026', 'archivo' => ['_file' => 'assets/docs/reop-2026.pdf']],
            ],
        ],

        'servicios_no_portuarios_faq' => [
            'etiqueta'    => 'Ayuda',
            'titulo'      => 'Preguntas frecuentes',
            'descripcion' => 'Respuestas a las consultas más comunes sobre los servicios no portuarios.',
            'items'       => [
                ['pregunta' => '¿Qué son los servicios no portuarios?', 'respuesta' => 'Son el uso de áreas, los servicios complementarios y las facilidades que el terminal presta a terceros dentro de su recinto.'],
                ['pregunta' => '¿Cómo se cobran?', 'respuesta' => 'Según el tarifario vigente. El documento oficial está disponible en la página de Tarifario.'],
                ['pregunta' => '¿Quién puede solicitarlos?', 'respuesta' => 'Usuarios, agentes y empresas que requieran operar o contar con apoyo dentro del recinto portuario.'],
                ['pregunta' => '¿Cómo solicito el uso de un área del terminal?', 'respuesta' => 'A través del área Comercial, indicando el área requerida, el plazo de uso y la actividad a realizar.'],
            ],
        ],

        'servicios_no_portuarios_cta' => [
            'titulo' => '¿Necesitas cotizar un servicio o coordinar una operación?',
            'bajada' => 'Te acompañamos desde la cotización hasta la operación en el terminal.',
            'boton'  => ['title' => 'Contáctanos', 'url' => '/contacto/#formulario'],
            'imagen' => ['_file' => 'assets/img/cta-no-portuarios.webp', 'alt' => 'Camión con carga pesada en la balanza de ingreso del terminal'],
        ],
    ],
];
