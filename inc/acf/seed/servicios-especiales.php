<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Servicios especiales (spec `servicios-especiales`). Lo carga inc/acf/runner.php una sola vez por grupo:
 * lo que el cliente edite después no se sobrescribe. Los enlaces a páginas del sitio son rutas relativas (/pagina/), así funcionan igual en local y en producción.
 */
return [
    'page'   => 'servicios-especiales',
    'fields' => [
        'servicios_especiales_hero' => [
            'titulo'         => 'Servicios especiales',
            'bajada'         => 'Almacenamiento prolongado, consolidación, pesaje, energía reefer, provisión de equipos y otros servicios del tarifario vigente.',
            'boton'          => ['title' => 'Solicitar cotización', 'url' => '/contacto/#formulario'],
            'imagen'         => ['_file' => 'assets/img/servicio-especiales-hero.webp', 'alt' => 'Camión con contenedor en la vía interna del terminal, junto al almacén y el patio'],
            'accesos_titulo' => 'Accesos directos',
            'accesos'        => [
                ['enlace' => ['title' => 'Qué incluye', 'url' => '#que-incluye']],
                ['enlace' => ['title' => 'Tarifas y precios', 'url' => '#tarifas']],
                ['enlace' => ['title' => 'Documentos relacionados', 'url' => '#documentos']],
                ['enlace' => ['title' => 'Preguntas frecuentes', 'url' => '#faq']],
            ],
        ],

        'servicios_especiales_que_incluye' => [
            'titulo' => 'Qué incluye',
            'items'  => [
                ['titulo' => 'Almacenamiento desde el día 4', 'descripcion' => 'Contenedores llenos y vacíos, carga fraccionada, refrigerada y rodante.'],
                ['titulo' => 'Recargos por carga especial', 'descripcion' => 'Carga peligrosa y carga sobredimensionada.'],
                ['titulo' => 'Contenedores IMO', 'descripcion' => 'Embarque y descarga de contenedores con mercancía peligrosa.'],
                ['titulo' => 'Consolidación y desconsolidación', 'descripcion' => 'De carga en contenedores dentro del terminal.'],
                ['titulo' => 'Pesaje adicional', 'descripcion' => 'Pesaje de carga o unidades adicional al servicio estándar.'],
                ['titulo' => 'Etiquetas y precintos', 'descripcion' => 'Colocación y remoción de etiquetas y precintos.'],
                ['titulo' => 'Energía reefer', 'descripcion' => 'Suministro de energía a contenedores refrigerados.'],
                ['titulo' => 'Provisión de equipamiento', 'descripcion' => 'Grúa celosía, grúa telescópica, reach stacker y montacargas.'],
                ['titulo' => 'Reestiba', 'descripcion' => 'Reestiba de carga en nave y en camión.'],
                ['titulo' => 'Estadía adicional en antepuerto', 'descripcion' => 'Permanencia adicional de unidades en el antepuerto.'],
                ['titulo' => 'Acondicionamiento de carga fraccionada', 'descripcion' => 'Preparación y acondicionamiento de carga fraccionada.'],
            ],
            'enlace' => ['title' => 'Montos y condiciones en el Tarifario vigente', 'url' => '/tarifario/'],
        ],

        'servicios_especiales_tarifas' => [
            'titulo'      => 'Tarifas y precios',
            'texto'       => 'Las tarifas y los precios de estos servicios figuran en el Tarifario de Servicios Portuarios vigente, aprobado por OSITRAN. Descarga el documento oficial para consultar el detalle de cada prestación.',
            'archivo'     => ['_file' => 'assets/docs/tarifario-2026-06-16.pdf'],
            'boton_texto' => 'Descargar tarifario vigente',
            'versiones'   => ['title' => 'Ver versiones anteriores', 'url' => '/tarifario/#versiones'],
        ],

        'servicios_especiales_documentos' => [
            'titulo' => 'Documentos relacionados',
            'items'  => [
                ['etiqueta' => 'Reglamento', 'titulo' => 'Reglamento de Tarifas y Precios de COPAM · V 5.3', 'fecha' => 'Vigente desde junio de 2026', 'archivo' => ['_file' => 'assets/docs/reta-v5-3.pdf']],
                ['etiqueta' => 'Reglamento', 'titulo' => 'Reglamento de Operaciones · REIN-TPY-001', 'fecha' => 'Aprobado el 15-06-2026', 'archivo' => ['_file' => 'assets/docs/reop-2026.pdf']],
            ],
        ],

        'servicios_especiales_faq' => [
            'etiqueta'    => 'Ayuda',
            'titulo'      => 'Preguntas frecuentes',
            'descripcion' => 'Respuestas a las consultas más comunes sobre los servicios especiales.',
            'items'       => [
                ['pregunta' => '¿Qué se considera un servicio especial?', 'respuesta' => 'Los servicios complementarios al servicio estándar previstos en el tarifario vigente, como almacenamiento desde el día 4, recargos por carga peligrosa o sobredimensionada, pesaje adicional y provisión de equipamiento.'],
                ['pregunta' => '¿Con qué equipamiento cuenta el terminal?', 'respuesta' => 'Con una grúa celosía de 130 t, una grúa camión de 55 t y un reach stacker de 45 t.'],
                ['pregunta' => '¿Cómo se cobran los servicios especiales?', 'respuesta' => 'Según el tarifario vigente. El documento oficial está disponible en la página de Tarifario.'],
                ['pregunta' => '¿Con cuánta anticipación debo coordinar una maniobra?', 'respuesta' => 'La maniobra debe coordinarse con la anticipación indicada en el Reglamento de Operaciones, para planificar el equipamiento y el personal necesarios.'],
                ['pregunta' => '¿Qué información necesito para cotizar?', 'respuesta' => 'Las dimensiones y el peso de la carga, el tipo de maniobra requerida y la fecha estimada de la operación.'],
            ],
        ],

        'servicios_especiales_cta' => [
            'titulo' => '¿Necesitas cotizar un servicio o coordinar una operación?',
            'bajada' => 'Te acompañamos desde la cotización hasta la operación en el terminal.',
            'boton'  => ['title' => 'Contáctanos', 'url' => '/contacto/#formulario'],
            'imagen' => ['_file' => 'assets/img/cta-especiales.webp', 'alt' => 'Grúa de celosía izando maquinaria sobredimensionada en el patio'],
        ],
    ],
];
