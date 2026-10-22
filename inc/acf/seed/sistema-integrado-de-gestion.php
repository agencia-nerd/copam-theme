<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Sistema Integrado de Gestión (spec `sistema-integrado-de-gestion`). Lo carga inc/acf/runner.php
 * una sola vez por grupo: lo que el cliente edite después no se sobrescribe. Los PDF pasan a la biblioteca de medios;
 * las fechas se guardan como aaaammdd (formato interno de ACF).
 */
return [
    'page'   => 'sistema-integrado-de-gestion',
    'fields' => [
        'sistema_integrado_de_gestion_hero' => [
            'titulo' => 'Sistema Integrado de Gestión',
            'bajada' => 'Gestionamos la operación y conservación del Terminal Portuario de Yurimaguas – Nueva Reforma bajo un sistema que integra calidad, gestión ambiental y seguridad y salud en el trabajo, certificado por AENOR.',
            'imagen' => ['_file' => 'assets/img/sig-hero.webp', 'alt' => 'Izaje de carga de proyecto con grúa celosía, supervisado por personal con equipo de seguridad'],
        ],

        'sistema_integrado_de_gestion_indice' => [
            'titulo' => 'En esta página',
            'enlace' => ['title' => 'Compromiso Ambiental', 'url' => '/compromiso-ambiental/'],
        ],

        'sistema_integrado_de_gestion_sistema' => [
            'titulo'            => 'Nuestro sistema',
            'texto'             => 'Nuestro Sistema Integrado de Gestión reúne en un solo marco los requisitos de tres normas internacionales: ISO 9001 (calidad), ISO 14001 (gestión ambiental) e ISO 45001 (seguridad y salud en el trabajo). Está certificado por AENOR y reconocido por la red internacional IQNet.',
            'alcance_etiqueta'  => 'Alcance de la certificación',
            'alcance_texto'     => 'Gestión de la operación portuaria: servicio a la nave, a la carga y a los pasajeros (embarque y desembarque de personas), y conservación del terminal portuario: mantenimiento rutinario, periódico y reparación por emergencia.',
            'alcance_direccion' => 'Vía de Evitamiento Km 0.0, Caserío Santa Rosa, Yurimaguas, Alto Amazonas, Loreto.',
            'consulta_etiqueta' => 'Consulta y participación',
            'consulta_texto'    => 'Usuarios, proveedores y trabajadores pueden enviarnos sugerencias y consultas sobre nuestro sistema de gestión.',
            'consulta_enlace'   => ['title' => 'Ir al Buzón de sugerencias', 'url' => '/contacto/#buzon'],
        ],

        'sistema_integrado_de_gestion_certificaciones' => [
            'titulo' => 'Certificaciones',
            'items'  => [
                [
                    'norma'             => 'ISO 9001',
                    'nombre'            => 'Gestión de la calidad',
                    'certificado_aenor' => 'Certificado AENOR ER-0730/2018',
                    'certificado_iqnet' => 'IQNet ES-0730/2018',
                    'primera_emision'   => '20181210',
                    'ultima_emision'    => '20241228',
                    'vigente_hasta'     => '20271210',
                    'enlaces'           => [
                        ['texto' => 'Certificado (PDF)', 'archivo' => ['_file' => 'assets/docs/certificado-iso-9001.pdf']],
                        ['texto' => 'English', 'archivo' => ['_file' => 'assets/docs/certificado-iso-9001-en.pdf']],
                        ['texto' => 'IQNet', 'archivo' => ['_file' => 'assets/docs/iqnet-iso-9001.pdf']],
                    ],
                ],
                [
                    'norma'             => 'ISO 14001',
                    'nombre'            => 'Gestión ambiental',
                    'certificado_aenor' => 'Certificado AENOR GA-2018/0324',
                    'certificado_iqnet' => 'IQNet ES-2018/0324',
                    'primera_emision'   => '20181210',
                    'ultima_emision'    => '20241228',
                    'vigente_hasta'     => '20271210',
                    'enlaces'           => [
                        ['texto' => 'Certificado (PDF)', 'archivo' => ['_file' => 'assets/docs/certificado-iso-14001.pdf']],
                        ['texto' => 'English', 'archivo' => ['_file' => 'assets/docs/certificado-iso-14001-en.pdf']],
                        ['texto' => 'IQNet', 'archivo' => ['_file' => 'assets/docs/iqnet-iso-14001.pdf']],
                    ],
                ],
                [
                    'norma'             => 'ISO 45001',
                    'nombre'            => 'Seguridad y salud en el trabajo',
                    'certificado_aenor' => 'Certificado AENOR SST-0165/2018',
                    'certificado_iqnet' => 'IQNet ES-SST-0165/2018',
                    'primera_emision'   => '20211125',
                    'ultima_emision'    => '20241228',
                    'vigente_hasta'     => '20271210',
                    'enlaces'           => [
                        ['texto' => 'Certificado (PDF)', 'archivo' => ['_file' => 'assets/docs/certificado-iso-45001.pdf']],
                        ['texto' => 'English', 'archivo' => ['_file' => 'assets/docs/certificado-iso-45001-en.pdf']],
                        ['texto' => 'IQNet', 'archivo' => ['_file' => 'assets/docs/iqnet-iso-45001.pdf']],
                    ],
                ],
            ],
        ],

        'sistema_integrado_de_gestion_politica' => [
            'titulo'      => 'Política del SIG',
            'intro'       => 'COPAM S.A., empresa concesionaria que administra la operación y conservación del terminal portuario de Yurimaguas – Nueva Reforma, se compromete a:',
            'bloques'     => [
                [
                    'titulo'      => 'Calidad y servicio',
                    'compromisos' => [
                        ['texto' => 'Satisfacer las expectativas de nuestros usuarios con una cultura de calidad basada en valores, principios, seguridad, rentabilidad, capacidad y el compromiso de todo el equipo.'],
                        ['texto' => 'Brindar la mejor atención a nuestros usuarios mediante la oportuna planificación de los servicios y un eficiente control operativo.'],
                    ],
                ],
                [
                    'titulo'      => 'Seguridad y salud en el trabajo',
                    'compromisos' => [
                        ['texto' => 'Proteger la integridad física y la salud de trabajadores, usuarios, proveedores y visitantes, con una cultura de prevención.'],
                        ['texto' => 'Identificar los peligros, evaluar los riesgos y establecer medidas de control; eliminar los peligros y reducir los riesgos.'],
                        ['texto' => 'Proporcionar condiciones y recursos para un trabajo seguro y saludable.'],
                        ['texto' => 'Promover la consulta y participación de los trabajadores y sus representantes.'],
                    ],
                ],
                [
                    'titulo'      => 'Ambiente y clima',
                    'compromisos' => [
                        ['texto' => 'Conservar el ambiente mediante el buen uso de nuestros recursos y la prevención de la contaminación, contando con un IGA aprobado.'],
                        ['texto' => 'Contribuir a la mitigación (reducción de emisiones) y la adaptación (resiliencia ante los impactos climáticos) del terminal ante el cambio climático.'],
                    ],
                ],
                [
                    'titulo'      => 'Mejora y cumplimiento',
                    'compromisos' => [
                        ['texto' => 'Promover la mejora continua del sistema integrado de gestión, con comunicación permanente entre áreas y colaboradores.'],
                        ['texto' => 'Cumplir los requisitos legales, normativos y regulatorios aplicables, en el marco del Contrato de Concesión.'],
                    ],
                ],
            ],
            'aprobacion'  => 'Aprobada por la Gerencia General · Ing. Carmen Benítez Hernández · 21 de octubre de 2025',
            'boton_texto' => 'Descargar política (PDF)',
            'archivo'     => ['_file' => 'assets/docs/politica-sig-2025.pdf'],
        ],

        'sistema_integrado_de_gestion_documentos' => [
            'titulo'        => 'Documentos',
            'grupos'        => [
                [
                    'nombre'     => 'Política',
                    'documentos' => [
                        ['titulo' => 'Política del Sistema Integrado de Gestión', 'subtitulo' => '2025', 'vigente' => 1, 'archivo' => ['_file' => 'assets/docs/politica-sig-2025.pdf']],
                    ],
                ],
                [
                    'nombre'     => 'ISO 9001',
                    'documentos' => [
                        ['titulo' => 'Certificado AENOR (español)', 'subtitulo' => 'ER-0730/2018', 'archivo' => ['_file' => 'assets/docs/certificado-iso-9001.pdf']],
                        ['titulo' => 'Certificate AENOR (English)', 'subtitulo' => 'ER-0730/2018', 'archivo' => ['_file' => 'assets/docs/certificado-iso-9001-en.pdf']],
                        ['titulo' => 'Certificado IQNet', 'subtitulo' => 'ES-0730/2018', 'archivo' => ['_file' => 'assets/docs/iqnet-iso-9001.pdf']],
                    ],
                ],
                [
                    'nombre'     => 'ISO 14001',
                    'documentos' => [
                        ['titulo' => 'Certificado AENOR (español)', 'subtitulo' => 'GA-2018/0324', 'archivo' => ['_file' => 'assets/docs/certificado-iso-14001.pdf']],
                        ['titulo' => 'Certificate AENOR (English)', 'subtitulo' => 'GA-2018/0324', 'archivo' => ['_file' => 'assets/docs/certificado-iso-14001-en.pdf']],
                        ['titulo' => 'Certificado IQNet', 'subtitulo' => 'ES-2018/0324', 'archivo' => ['_file' => 'assets/docs/iqnet-iso-14001.pdf']],
                    ],
                ],
                [
                    'nombre'     => 'ISO 45001',
                    'documentos' => [
                        ['titulo' => 'Certificado AENOR (español)', 'subtitulo' => 'SST-0165/2018', 'archivo' => ['_file' => 'assets/docs/certificado-iso-45001.pdf']],
                        ['titulo' => 'Certificate AENOR (English)', 'subtitulo' => 'SST-0165/2018', 'archivo' => ['_file' => 'assets/docs/certificado-iso-45001-en.pdf']],
                        ['titulo' => 'Certificado IQNet', 'subtitulo' => 'ES-SST-0165/2018', 'archivo' => ['_file' => 'assets/docs/iqnet-iso-45001.pdf']],
                    ],
                ],
            ],
            'mensaje_vacio' => 'Los documentos de esta sección se publicarán próximamente.',
        ],

        'sistema_integrado_de_gestion_acceso' => [
            'titulo'      => 'Compromiso Ambiental',
            'descripcion' => 'Política ambiental e instrumentos de gestión del terminal.',
            'boton'       => ['title' => 'Ver compromiso ambiental', 'url' => '/compromiso-ambiental/'],
            'imagen'      => ['_file' => 'assets/img/ambiental-acceso.webp', 'alt' => 'Vista aérea del terminal rodeado de bosque amazónico'],
        ],
    ],
];
