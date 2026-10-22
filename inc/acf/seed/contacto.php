<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de Contacto (spec `contacto`). Lo carga inc/acf/runner.php una sola vez por grupo:
 * lo que el cliente edite después no se sobrescribe. Los enlaces a páginas del sitio son rutas relativas (/pagina/),
 * así funcionan igual en local y en producción.
 * El correo de Operaciones no está en el diseño ([PENDIENTE]): su tarjeta muestra solo el teléfono hasta que se cargue.
 * "Formulario de reclamos, reconsideraciones y apelaciones" reemplaza al "Libro de Reclamaciones virtual" del diseño.
 */
return [
    'page'   => 'contacto',
    'fields' => [
        'contacto_hero' => [
            'imagen'         => ['_file' => 'assets/img/contacto-hero.webp', 'alt' => 'Camión con carga cubierta y montacargas en el patio del terminal'],
            'titulo'         => 'Contacto',
            'bajada'         => 'Cada consulta tiene un canal directo. Elige el área que corresponde o escríbenos mediante el formulario de contacto.',
            'boton'          => ['title' => 'Escríbenos', 'url' => '#formulario'],
            'accesos_titulo' => 'Accesos directos',
            'accesos'        => [
                ['enlace' => ['title' => 'Formulario de contacto', 'url' => '#formulario']],
                ['enlace' => ['title' => 'Buzón de sugerencias', 'url' => '#buzon']],
                ['enlace' => ['title' => 'Presentar un reclamo', 'url' => '/reclamos/#formulario']],
                ['enlace' => ['title' => 'Formulario de reclamos, reconsideraciones y apelaciones', 'url' => '/reclamos/#formulario']],
                ['enlace' => ['title' => 'Seguimiento de carga', 'url' => 'http://45.232.151.188:8081/consultacarga/', 'target' => '_blank']],
                ['enlace' => ['title' => 'Tarifario', 'url' => '/tarifario/']],
                ['enlace' => ['title' => 'Canal de hostigamiento sexual', 'url' => '/canal-hostigamiento-sexual/']],
            ],
        ],

        'contacto_canales' => [
            'titulo' => 'Canales de atención',
            'items'  => [
                [
                    'titulo'      => 'Atención al usuario',
                    'descripcion' => "Reclamos, reconsideraciones y consultas sobre el servicio.\nservicioclientes@copam.com.pe · Tel. (01) 500-0450",
                    'boton'       => ['title' => 'Ir a reclamos', 'url' => '/reclamos/'],
                ],
                [
                    'titulo'      => 'Operaciones',
                    'descripcion' => "Coordinación de naves, embarque, descarga y contingencias. Atención operativa las 24 horas.\nTel. (01) 500-0450",
                    'boton'       => ['title' => 'Llamar a operaciones', 'url' => 'tel:015000450'],
                ],
                [
                    'titulo'      => 'Comercial',
                    'descripcion' => "Cotizaciones, nuevos servicios y acuerdos comerciales, con un ejecutivo según el tipo de carga.\ncomercial@copam.com.pe · Tel. (+511) 500-2670\nAv. Javier Prado Este 4135, Piso 7, Santiago de Surco, Lima",
                    'boton'       => ['title' => 'Enviar consulta', 'url' => '#formulario'],
                ],
            ],
        ],

        'contacto_datos' => [
            'titulo' => 'Datos de contacto',
            'filas'  => [
                ['etiqueta' => 'Sedes', 'valor' => ''],
                ['etiqueta' => 'Terminal portuario', 'valor' => 'Vía de Evitamiento Km 0, Caserío Santa Rosa (río Huallaga), Yurimaguas, Loreto · Tel. (01) 500-0450'],
                ['etiqueta' => 'Oficina Lima', 'valor' => 'Av. Javier Prado Este 4135, Piso 7, Santiago de Surco, Lima · Tel. (+511) 500-2670'],
                ['etiqueta' => 'Datos de la empresa', 'valor' => ''],
                ['etiqueta' => 'Razón social', 'valor' => 'Concesionaria Puerto Amazonas S.A.'],
                ['etiqueta' => 'RUC', 'valor' => '20543480291'],
                ['etiqueta' => 'Correo de atención', 'valor' => 'servicioclientes@copam.com.pe'],
                ['etiqueta' => 'Horario de atención', 'valor' => 'Administrativo: Lun–Vie 08:00–17:00 h · Sáb 08:00–13:00 h · Operativo: 24 horas'],
            ],
        ],

        'contacto_formulario' => [
            'titulo'     => 'Formulario de contacto',
            'nota_envio' => 'El formulario se envía a',
        ],

        'contacto_buzon' => [
            'titulo'       => 'Buzón de sugerencias',
            'subtitulo'    => 'Tu opinión nos ayuda a mejorar',
            'bajada'       => 'Comparte una sugerencia, una felicitación o una idea para mejorar nuestros servicios y la atención en el terminal.',
            'puntos'       => [
                ['texto' => 'Puedes enviarla de forma anónima.'],
                ['texto' => 'Si quieres una respuesta, déjanos tu correo.'],
                ['texto' => 'Las sugerencias las revisa el Coordinador del Sistema Integrado de Gestión.'],
            ],
            'aviso_titulo' => '¿Tienes un problema con un servicio?',
            'aviso_texto'  => 'El buzón no reemplaza al reclamo. Si necesitas una respuesta formal en plazo, presenta un reclamo.',
            'aviso_enlace' => ['title' => 'Presentar un reclamo', 'url' => '/reclamos/#formulario'],
            'exito'        => 'Gracias. Tu mensaje fue registrado y será revisado por el Coordinador del SIG.',
        ],
    ],
];
