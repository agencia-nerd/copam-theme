<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Servicios a la carga (spec `servicios-a-la-carga`). Lo carga inc/acf/runner.php una sola vez por grupo:
 * lo que el cliente edite después no se sobrescribe. Los enlaces a páginas del sitio son rutas relativas (/pagina/), así funcionan igual en local y en producción.
 */
return [
    'page'   => 'servicios-a-la-carga',
    'fields' => [
        'servicios_a_la_carga_hero' => [
            'titulo'         => 'Servicios a la carga',
            'bajada'         => 'Embarque, descarga, transferencia y almacenamiento de carga general, contenedores y graneles en el Terminal Portuario de Yurimaguas – Nueva Reforma.',
            'boton'          => ['title' => 'Solicitar cotización', 'url' => '/contacto/#formulario'],
            'imagen'         => ['_file' => 'assets/img/servicio-carga-hero.webp', 'alt' => 'Reach stacker cargando un contenedor sobre un camión en el patio del terminal'],
            'accesos_titulo' => 'Accesos directos',
            'accesos'        => [
                ['texto' => 'Qué incluye'],
                ['texto' => 'Tarifas'],
                ['texto' => 'Documentos relacionados'],
                ['texto' => 'Preguntas frecuentes'],
            ],
        ],

        'servicios_a_la_carga_que_incluye' => [
            'titulo' => 'Qué incluye',
            'items'  => [
                ['titulo' => 'Embarque, descarga y transferencia', 'descripcion' => 'Movimiento de la carga entre la nave y el muelle, y su traslado dentro del terminal hacia las zonas de almacenamiento.'],
                ['titulo' => 'Almacenamiento y depósito', 'descripcion' => 'Almacén techado de 6,092 m², cámara de frío de 600 m² y Depósito Temporal autorizado por SUNAT.'],
                ['titulo' => 'Contenedores secos y refrigerados', 'descripcion' => 'Patio de contenedores de 10,000 m² y 72 tomas para contenedores reefer.'],
                ['titulo' => 'Carga general y graneles', 'descripcion' => 'Carga fraccionada y de proyecto, carga rodante, y graneles sólidos y líquidos.'],
            ],
        ],

        'servicios_a_la_carga_tarifas' => [
            'titulo' => 'Tarifas',
            'filas'  => [
                ['tipo_carga' => 'Carga fraccionada', 'unidad_cobro' => 'Tonelada'],
                ['tipo_carga' => 'Carga rodante', 'unidad_cobro' => 'Tonelada'],
                ['tipo_carga' => 'Carga sólida a granel', 'unidad_cobro' => 'Tonelada'],
                ['tipo_carga' => 'Carga líquida a granel', 'unidad_cobro' => 'Tonelada'],
                ['tipo_carga' => 'Contenedor de 20 pies con carga', 'unidad_cobro' => 'Contenedor'],
                ['tipo_carga' => 'Contenedor de 20 pies vacío', 'unidad_cobro' => 'Contenedor'],
                ['tipo_carga' => 'Contenedor de 40 pies con carga', 'unidad_cobro' => 'Contenedor'],
                ['tipo_carga' => 'Contenedor de 40 pies vacío', 'unidad_cobro' => 'Contenedor'],
            ],
            'nota'   => '<p>Unidades de cobro del servicio estándar a la carga. Los montos se aplican según el Tarifario de Servicios Portuarios vigente, aprobado por OSITRAN; consulta el documento oficial en la página de <a href="/tarifario/">Tarifario</a>.</p>',
        ],

        'servicios_a_la_carga_documentos' => [
            'titulo' => 'Documentos relacionados',
            'items'  => [
                ['etiqueta' => 'Tarifario', 'titulo' => 'Tarifario de Servicios Portuarios', 'fecha' => 'Vigente desde el 16-06-2026', 'archivo' => ['_file' => 'assets/docs/tarifario-2026-06-16.pdf']],
                ['etiqueta' => 'Reglamento', 'titulo' => 'Reglamento de Tarifas y Precios de COPAM · V 5.3', 'fecha' => 'Vigente desde junio de 2026', 'archivo' => ['_file' => 'assets/docs/reta-v5-3.pdf']],
                ['etiqueta' => 'Reglamento', 'titulo' => 'Reglamento de Operaciones · REIN-TPY-001', 'fecha' => 'Aprobado el 15-06-2026', 'archivo' => ['_file' => 'assets/docs/reop-2026.pdf']],
                ['etiqueta' => 'Tarifario', 'titulo' => 'Tarifario del Depósito Temporal', 'fecha' => 'Vigente desde el 23-10-2025', 'archivo' => ['_file' => 'assets/docs/tarifario-deposito-temporal.pdf']],
            ],
        ],

        'servicios_a_la_carga_faq' => [
            'titulo'      => 'Preguntas frecuentes',
            'descripcion' => 'Respuestas a las consultas más comunes sobre los servicios a la carga.',
            'items'       => [
                ['pregunta' => '¿Qué tipos de carga atiende el terminal?', 'respuesta' => 'Contenedores secos y refrigerados, carga fraccionada y de proyecto, carga rodante, y graneles sólidos y líquidos.'],
                ['pregunta' => '¿Cómo se cobra el servicio estándar a la carga?', 'respuesta' => 'Según el tipo de carga: por tonelada en carga fraccionada, rodante y a granel, y por contenedor en contenedores de 20 y 40 pies, de acuerdo con el tarifario vigente.'],
                ['pregunta' => '¿Qué capacidad de almacenamiento tiene el terminal?', 'respuesta' => 'El terminal cuenta con un almacén techado de 6,092 m², un patio de contenedores de 10,000 m² y una cámara de frío de 600 m².'],
                ['pregunta' => '¿Puedo almacenar carga bajo control aduanero?', 'respuesta' => 'Sí. El terminal cuenta con un Depósito Temporal autorizado por SUNAT. Sus tarifas y condiciones están en la página de Depósito Temporal.'],
                ['pregunta' => '¿Con cuánta anticipación debo coordinar una operación?', 'respuesta' => 'La coordinación debe realizarse con la anticipación indicada en el Reglamento de Operaciones, junto con la información de la carga y la nave.'],
                ['pregunta' => '¿A quién contacto para cotizar un servicio?', 'respuesta' => 'Al área Comercial, a través de los canales de atención publicados en Contacto o del botón Solicitar cotización.'],
            ],
        ],

        'servicios_a_la_carga_cta' => [
            'titulo' => '¿Necesitas cotizar un servicio o coordinar una operación?',
            'bajada' => 'Te acompañamos desde la cotización hasta la operación en el terminal.',
            'boton'  => ['title' => 'Contáctanos', 'url' => '/contacto/#formulario'],
            'imagen' => ['_file' => 'assets/img/cta-carga.webp', 'alt' => 'Reach stacker trasladando un contenedor reefer en el patio'],
        ],
    ],
];
