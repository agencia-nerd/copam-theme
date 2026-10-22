<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Depósito Temporal (spec `deposito-temporal`). Lo carga inc/acf/runner.php una sola vez por grupo:
 * lo que el cliente edite después no se sobrescribe. Los enlaces a páginas del sitio son rutas relativas (/pagina/), así funcionan igual en local y en producción.
 * El código de identificación del establecimiento queda vacío (el diseño lo marca como pendiente) y su fila no se muestra hasta que se cargue.
 */
return [
    'page'   => 'deposito-temporal',
    'fields' => [
        'deposito_temporal_hero' => [
            'titulo'         => 'Depósito Temporal',
            'bajada'         => 'Recepción, almacenamiento y retiro de mercancía bajo control aduanero de SUNAT, con requisitos y plazos de permanencia propios.',
            'boton'          => ['title' => 'Seguimiento de carga', 'url' => 'http://45.232.151.188:8081/consultacarga/', 'target' => '_blank'],
            'imagen'         => ['_file' => 'assets/img/deposito-hero.webp', 'alt' => 'Almacén techado del depósito temporal con carga de madera y montacargas'],
            'accesos_titulo' => 'Accesos directos',
            'accesos'        => [
                ['enlace' => ['title' => 'Tarifario del depósito', 'url' => '#tarifas']],
                ['enlace' => ['title' => 'Autorización SUNAT', 'url' => '#documentos']],
                ['enlace' => ['title' => 'Procedimientos y formatos', 'url' => '#documentos']],
                ['enlace' => ['title' => 'Canales de atención', 'url' => '/contacto/#canales']],
                ['enlace' => ['title' => 'Quejas y reclamos', 'url' => '#quejas-y-reclamos']],
                ['enlace' => ['title' => 'Preguntas frecuentes', 'url' => '#faq']],
            ],
        ],

        'deposito_temporal_atendemos' => [
            'titulo' => 'Qué atendemos en el depósito',
            'items'  => [
                ['titulo' => 'Contenedores secos', 'descripcion' => 'Trámites operativos y administrativos, y almacenamiento a partir del cuarto día de permanencia. Tiempo promedio de atención: 3 h · máximo: 8 h.', 'boton' => ['title' => 'Ver tarifa', 'url' => '#tarifas']],
                ['titulo' => 'Contenedores reefer', 'descripcion' => 'Trámites operativos, almacenamiento a partir del cuarto día y suministro de energía a solicitud del usuario. Tiempo promedio de atención: 3 h · máximo: 8 h.', 'boton' => ['title' => 'Ver tarifa', 'url' => '#tarifas']],
                ['titulo' => 'Carga fraccionada', 'descripcion' => 'Trámites operativos y administrativos por tonelada, y almacenamiento a partir del cuarto día de permanencia. Tiempo promedio de atención: 3 h · máximo: 8 h.', 'boton' => ['title' => 'Ver tarifa', 'url' => '#tarifas']],
            ],
        ],

        'deposito_temporal_tarifas' => [
            'titulo' => 'Tarifas del depósito',
            'filas'  => [
                ['es_grupo' => 1, 'servicio' => 'Contenedores'],
                ['es_grupo' => 0, 'servicio' => 'Contenedor seco · Trámites operativos y administrativos', 'unidad' => 'Contenedor', 'tarifa' => '211.93', 'igv' => '38.15'],
                ['es_grupo' => 0, 'servicio' => 'Contenedor seco · Almacenamiento desde el día 4', 'unidad' => 'TEU · día', 'tarifa' => '1.88', 'igv' => '0.34'],
                ['es_grupo' => 0, 'servicio' => 'Contenedor reefer · Trámites operativos y administrativos', 'unidad' => 'Contenedor', 'tarifa' => '211.93', 'igv' => '38.15'],
                ['es_grupo' => 0, 'servicio' => 'Contenedor reefer · Almacenamiento desde el día 4', 'unidad' => 'TEU · día', 'tarifa' => '1.88', 'igv' => '0.34'],
                ['es_grupo' => 0, 'servicio' => 'Contenedor reefer · Suministro de energía', 'unidad' => 'Contenedor · hora', 'tarifa' => '5.28', 'igv' => '0.95'],
                ['es_grupo' => 1, 'servicio' => 'Carga fraccionada'],
                ['es_grupo' => 0, 'servicio' => 'Carga fraccionada · Trámites operativos y administrativos', 'unidad' => 'Tonelada', 'tarifa' => '10.60', 'igv' => '1.91'],
                ['es_grupo' => 0, 'servicio' => 'Carga fraccionada · Almacenamiento desde el día 4', 'unidad' => 'Tonelada · día', 'tarifa' => '0.14', 'igv' => '0.03'],
            ],
            'nota'   => 'Tarifas reguladas y fijadas por el Ositrán, vigentes desde el 23 de octubre de 2025, en soles (S/). Los tres primeros días de permanencia están incluidos en el servicio estándar. El documento oficial es el tarifario vigente desde el 23 de octubre de 2025.',
        ],

        'deposito_temporal_documentos' => [
            'titulo' => 'Documentos',
            'grupos' => [
                [
                    'titulo'       => 'Tarifario del depósito',
                    'estado_vacio' => 'Próximamente',
                    'documentos'   => [
                        ['titulo' => 'Tarifario Depósito Temporal Fluvial', 'subtitulo' => 'Vigente desde el 23-10-2025', 'vigente' => 1, 'archivo' => ['_file' => 'assets/docs/tarifario-deposito-temporal.pdf'], 'boton_texto' => 'Descargar PDF'],
                        ['titulo' => 'Resolución de Presidencia N.° 0002-2025-PD-OSITRAN', 'subtitulo' => 'Fija las tarifas del Depósito Temporal Fluvial · 06-01-2025', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/rp-0002-2025-pd-ositran.pdf'], 'boton_texto' => 'Descargar PDF'],
                    ],
                ],
                [
                    'titulo'       => 'Autorización SUNAT',
                    'estado_vacio' => 'Próximamente',
                    'documentos'   => [
                        ['titulo' => 'Resolución de División N.° 000 324200/2025-000167', 'subtitulo' => 'Autoriza a Concesionaria Puerto Amazonas S.A. a operar como Almacén Aduanero – Depósito Temporal · 06-10-2025', 'vigente' => 1, 'archivo' => ['_file' => 'assets/docs/resolucion-sunat-deposito-temporal.pdf'], 'boton_texto' => 'Descargar PDF'],
                    ],
                ],
                [
                    'titulo'       => 'Procedimientos',
                    'estado_vacio' => 'Próximamente',
                    'documentos'   => [
                        ['titulo' => 'PR-OP-DT-09 · Ingreso de carga al DT – Importación', 'subtitulo' => 'Regímenes de importación definitiva y admisión temporal · Versión 1 · Julio de 2026', 'vigente' => 1, 'archivo' => ['_file' => 'assets/docs/pr-op-dt-09.pdf'], 'boton_texto' => 'Descargar PDF'],
                        ['titulo' => 'PR-OP-DT-10 · Salida de carga del DT – Importación', 'subtitulo' => 'Regímenes de importación definitiva y admisión temporal · Versión 1 · Julio de 2026', 'vigente' => 1, 'archivo' => ['_file' => 'assets/docs/pr-op-dt-10.pdf'], 'boton_texto' => 'Descargar PDF'],
                        ['titulo' => 'PR-OP-DT-05 · Ingreso de carga al DT – Exportación', 'subtitulo' => 'Exportación definitiva, reexportación y reembarque · Versión 1 · Julio de 2026', 'vigente' => 1, 'archivo' => ['_file' => 'assets/docs/pr-op-dt-05.pdf'], 'boton_texto' => 'Descargar PDF'],
                        ['titulo' => 'PR-OP-DT-11 · Salida de carga del DT – Exportación', 'subtitulo' => 'Exportación definitiva, reexportación y reembarque · Versión 1 · Julio de 2026', 'vigente' => 1, 'archivo' => ['_file' => 'assets/docs/pr-op-dt-11.pdf'], 'boton_texto' => 'Descargar PDF'],
                    ],
                ],
                [
                    'titulo'       => 'Formatos y solicitudes',
                    'estado_vacio' => 'Próximamente',
                    'documentos'   => [
                        ['titulo' => 'Formato de petición de servicios', 'subtitulo' => 'Incluye lista de camiones, cargo plan fluvial y manifiesto de carga · Excel', 'vigente' => 1, 'archivo' => ['_file' => 'assets/docs/formato-peticion-servicios.xlsx'], 'boton_texto' => 'Descargar Excel', 'archivo_alterno' => ['_file' => 'assets/docs/formato-peticion-servicios.pdf']],
                    ],
                ],
            ],
        ],

        'deposito_temporal_quejas_reclamos' => [
            'titulo'        => 'Quejas y reclamos',
            'texto'         => 'Registra tu queja o reclamo sobre los servicios del Depósito Temporal, conforme al Código de Protección y Defensa del Consumidor. Los campos con * son obligatorios.',
            'razon_social'  => 'Concesionaria Puerto Amazonas S.A.',
            'ruc'           => '20543480291',
            'domicilio'     => 'Vía de Evitamiento Km 0.0, Caserío Santa Rosa, Yurimaguas, Alto Amazonas, Loreto',
            'codigo'        => '',
            'nota_indecopi' => 'La formulación del reclamo no impide acudir a otras vías de solución de controversias ni es requisito previo para interponer una denuncia ante el INDECOPI.',
            'nota_plazo'    => 'El proveedor debe dar respuesta al reclamo o queja en un plazo no mayor a quince (15) días hábiles, el cual es improrrogable.',
            'nota_copia'    => 'Recibirás una copia de tu hoja de reclamación en el correo electrónico que registraste.',
        ],

        'deposito_temporal_seguimiento' => [
            'titulo'      => 'Seguimiento de carga',
            'descripcion' => 'Consulta el estado de tu carga dentro del recinto portuario.',
            'boton'       => ['title' => 'Consultar mi carga', 'url' => 'http://45.232.151.188:8081/consultacarga/', 'target' => '_blank'],
            'imagen'      => ['_file' => 'assets/img/cta-deposito.webp', 'alt' => 'Almacenes y patio del depósito temporal del terminal'],
        ],

        'deposito_temporal_faq' => [
            'etiqueta'    => 'Ayuda',
            'titulo'      => 'Preguntas frecuentes',
            'descripcion' => 'Respuestas a las consultas más comunes sobre el depósito temporal.',
            'items'       => [
                ['pregunta' => '¿Cuántos días de almacenamiento están incluidos?', 'respuesta' => 'Los tres primeros días de permanencia están incluidos en el servicio estándar, según el Contrato de Concesión. A partir del cuarto día, el almacenamiento se activa a solicitud del usuario y se cobra según el tarifario vigente del depósito.'],
                ['pregunta' => '¿Qué incluyen los trámites operativos y administrativos?', 'respuesta' => 'Incluyen la transmisión a aduanas, el cambio de condición del contenedor o de la carga, la emisión de volante, el desdoblamiento, el estado de hechos, y la revisión y verificación a la entrada y salida del depósito temporal fluvial. Tiempo promedio de atención: 3 h · máximo: 8 h.'],
                ['pregunta' => '¿Qué es el depósito temporal?', 'respuesta' => 'Es el recinto autorizado por SUNAT donde la mercancía permanece bajo control aduanero hasta que se completa su trámite de despacho.'],
                ['pregunta' => '¿Cómo solicito energía para un contenedor reefer?', 'respuesta' => 'El suministro de energía se solicita al área de Operaciones y se cobra por hora de conexión, según el tarifario vigente del depósito.'],
                ['pregunta' => '¿Cómo consulto el estado de mi carga?', 'respuesta' => 'Desde el aplicativo de Seguimiento de carga, disponible en esta página.'],
                ['pregunta' => '¿Dónde encuentro los procedimientos aduaneros?', 'respuesta' => 'En la sección Documentos de esta página, cuando se publiquen, y en el portal de SUNAT.'],
            ],
        ],

        'deposito_temporal_cta' => [
            'titulo' => '¿Necesitas almacenar tu carga?',
            'bajada' => 'Coordina con nuestro equipo el ingreso de tu carga al Depósito Temporal.',
            'boton'  => ['title' => 'Contáctanos', 'url' => '/contacto/#formulario'],
            'imagen' => ['_file' => 'assets/img/cta-deposito-balanza.webp', 'alt' => 'Camión con contenedor en la balanza de ingreso del terminal'],
        ],
    ],
];
