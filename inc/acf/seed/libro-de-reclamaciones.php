<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de la página Libro de Reclamaciones (spec `libro-de-reclamaciones`). Lo carga
 * inc/acf/runner.php una sola vez por grupo; lo que el cliente edite en el admin no se vuelve a pisar.
 */
return [
    'page'   => 'libro-de-reclamaciones',
    'fields' => [
        'libro_de_reclamaciones_hero' => [
            'titulo'         => 'Libro de Reclamaciones',
            'bajada'         => 'Conforme a lo establecido en el Código de Protección y Defensa del Consumidor, contamos con un Libro de Reclamaciones virtual a tu disposición.',
            'boton_texto'    => 'Llenar hoja de reclamación',
            'accesos_titulo' => 'Accesos directos',
            'accesos'        => [
                ['enlace' => ['title' => 'Hoja de reclamación', 'url' => '#formulario']],
                ['enlace' => ['title' => 'Formulario de reclamos OSITRAN', 'url' => '/reclamos/#formulario']],
                ['enlace' => ['title' => 'Cómo reclamar', 'url' => ['_page' => 'reclamos']]],
            ],
        ],
        'libro_de_reclamaciones_formulario' => [
            'titulo'                 => 'Hoja de reclamación',
            'nota_obligatorios'      => 'Los campos con * son obligatorios.',
            'aviso_ositran'          => 'Si tu reclamo se refiere a la prestación de servicios portuarios (servicios a la nave, a la carga o al pasajero), también puedes presentarlo mediante el',
            'aviso_enlace'           => ['title' => 'Formulario de reclamos del procedimiento OSITRAN', 'url' => '/reclamos/#formulario'],
            'proveedor_razon_social' => 'Concesionaria Puerto Amazonas S.A.',
            'proveedor_ruc'          => '20543480291',
            'proveedor_direccion'    => 'Vía de Evitamiento Km 0.0, Caserío Santa Rosa, Yurimaguas, Alto Amazonas, Loreto',
            'nota_observaciones'     => 'Este espacio será completado por COPAM al dar respuesta a tu reclamo o queja.',
            'nota_envio'             => 'El formulario se envía a',
            'mensaje_exito'          => 'Tu hoja de reclamación fue enviada correctamente. COPAM dará respuesta a tu reclamo o queja en un plazo no mayor a quince (15) días hábiles.',
            'nota_legal_indecopi'    => 'La formulación del reclamo no impide acudir a otras vías de solución de controversias ni es requisito previo para interponer una denuncia ante el INDECOPI.',
            'nota_legal_plazo'       => 'El proveedor deberá dar respuesta al reclamo o queja en un plazo no mayor a quince (15) días hábiles improrrogables.',
        ],
    ],
];
