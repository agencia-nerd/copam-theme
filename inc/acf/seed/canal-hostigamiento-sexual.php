<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial del Canal de hostigamiento sexual (spec `canal-hostigamiento-sexual`). Lo carga
 * inc/acf/runner.php una sola vez por grupo: lo que el cliente edite después no se sobrescribe.
 * Los enlaces a páginas del sitio son rutas relativas (/pagina/). El correo del Delegado no está aquí:
 * sale de Ajustes del sitio > Correos > Canal de hostigamiento.
 */
return [
    'page'   => 'canal-hostigamiento-sexual',
    'fields' => [
        'canal_hostigamiento_sexual_hero' => [
            'titulo'         => 'Canal de hostigamiento sexual',
            'bajada'         => 'Un canal confidencial para reportar situaciones de hostigamiento sexual en el ámbito laboral de COPAM. Cada reporte lo recibe y atiende el Delegado de prevención y sanción del hostigamiento sexual.',
            'boton'          => ['title' => 'Enviar un reporte', 'url' => '#reporte'],
            'accesos_titulo' => 'Accesos directos',
        ],

        'canal_hostigamiento_sexual_como_funciona' => [
            'titulo'     => 'Cómo funciona',
            'tarjetas'   => [
                ['titulo' => 'Confidencial', 'descripcion' => 'Tu reporte llega solo al Delegado. Se guarda reserva de tu identidad frente a personas ajenas al procedimiento.'],
                ['titulo' => 'Tolerancia cero', 'descripcion' => 'COPAM aplica una política de tolerancia cero contra cualquier forma de hostigamiento sexual.'],
                ['titulo' => 'Seguimiento', 'descripcion' => 'Las medidas de protección se dictan en un plazo máximo de 3 días hábiles. La investigación concluye en un plazo no mayor de 15 días calendario, y el procedimiento no supera los 30 días calendario desde la presentación del reporte. La decisión la emite la Oficina de Administración y Finanzas y puede impugnarse ante la Gerencia General.'],
            ],
            'nota_legal' => 'Conforme a la Ley N.° 27942, Ley de Prevención y Sanción del Hostigamiento Sexual, y su Reglamento (D.S. N.° 014-2019-MIMP).',
        ],

        'canal_hostigamiento_sexual_reporte' => [
            'titulo'        => 'Enviar un reporte',
            'nota_envio'    => 'Llega únicamente al Delegado de prevención y sanción del hostigamiento sexual:',
            'mensaje_exito' => 'Tu reporte fue enviado de forma confidencial al Delegado.',
        ],

        'canal_hostigamiento_sexual_politica' => [
            'titulo'                => 'Política y procedimiento',
            'bajada'                => 'Conoce la política de prevención y el procedimiento de atención de COPAM.',
            'documento_titulo'      => 'Políticas y procedimiento aplicable a la prevención y sanción del hostigamiento sexual',
            'documento_detalle'     => 'Conforme a la Ley N.° 27942 y su Reglamento (D.S. N.° 014-2019-MIMP)',
            'documento_estado'      => 'Vigente',
            'documento_archivo'     => ['_file' => 'assets/docs/politica-hostigamiento-sexual.pdf'],
            'documento_boton_texto' => 'Descargar PDF',
        ],

        'canal_hostigamiento_sexual_otros_canales' => [
            'titulo'  => 'Otros canales',
            'bajada'  => 'También puedes presentar tu queja de forma verbal o escrita ante tu jefe inmediato o ante el Delegado.',
            'aviso'   => 'El Buzón de sugerencias y Reclamos son canales para otros temas.',
            'enlaces' => [
                ['enlace' => ['title' => 'Buzón de sugerencias', 'url' => '/contacto/#buzon']],
                ['enlace' => ['title' => 'Reclamos', 'url' => '/reclamos/']],
            ],
        ],
    ],
];
