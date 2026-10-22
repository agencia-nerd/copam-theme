<?php
defined('ABSPATH') || exit;

/*
 * Contenido inicial de la página Reclamos (spec `reclamos`). Lo carga inc/acf/runner.php una sola vez por grupo;
 * lo que el cliente edite en el admin no se vuelve a pisar. Los plazos van entre ~ (en verde, copam_theme_highlight).
 */
return [
    'page'   => 'reclamos',
    'fields' => [
        'reclamos_hero' => [
            'titulo'         => 'Reclamos',
            'bajada'         => 'Presenta un reclamo sobre los servicios del terminal, o una reconsideración o apelación. Tu solicitud se atiende conforme al Reglamento de Atención de Reclamos y Solución de Controversias de OSITRAN.',
            'boton'          => ['title' => 'Presentar reclamo', 'url' => '#formulario'],
            'accesos_titulo' => 'Accesos directos',
            'accesos'        => [
                ['enlace' => ['title' => 'Formulario de reclamos', 'url' => '#formulario']],
                ['enlace' => ['title' => 'Documentos y formatos', 'url' => '#documentos']],
                ['enlace' => ['title' => 'Libro de Reclamaciones', 'url' => '#libro']],
                ['enlace' => ['title' => 'Derechos y deberes del usuario', 'url' => '#derechos']],
                ['enlace' => ['title' => 'Preguntas frecuentes', 'url' => '#faq']],
            ],
        ],
        'reclamos_proceso' => [
            'titulo' => 'Proceso de atención',
            'pasos'  => [
                ['titulo' => 'Presenta tu reclamo', 'descripcion' => 'Ante COPAM, dentro de los ~60 días~ de ocurrido el hecho o de conocido este.'],
                ['titulo' => 'Subsana, si falta un requisito', 'descripcion' => 'COPAM te pide subsanar en ~2 días hábiles~ y tienes ~2 días hábiles~ para hacerlo.'],
                ['titulo' => 'COPAM resuelve', 'descripcion' => 'En ~15 días hábiles~, ampliables hasta ~30 días hábiles~ en casos complejos, por decisión motivada.'],
                ['titulo' => 'Te notificamos la resolución', 'descripcion' => 'A más tardar dentro de los ~5 días hábiles~ posteriores a su emisión, en el domicilio o correo que indicaste (art. 29 del Reglamento de Reclamos de OSITRAN).'],
                ['titulo' => 'Si COPAM no responde', 'descripcion' => 'Si COPAM no responde dentro del plazo, se aplica el silencio administrativo positivo.'],
            ],
        ],
        'reclamos_formulario' => [
            'titulo'                => 'Formulario de reclamos, reconsideraciones y apelaciones',
            'nota_obligatorios'     => 'Los campos con * son obligatorios.',
            'nota_reclamo'          => 'Elige Reclamo si no estás conforme con un servicio del terminal: un cobro, la calidad o demora del servicio, daños a tu carga o información incorrecta. Tienes 60 días desde ocurrido el hecho o desde que lo conociste.',
            'nota_reconsideracion'  => 'Elige Reconsideración si ya recibiste la respuesta de COPAM a tu reclamo, no estás de acuerdo y tienes una nueva prueba. La revisa COPAM. Tienes 15 días hábiles desde que te notificaron la respuesta.',
            'nota_apelacion'        => 'Elige Apelación si no estás de acuerdo con la respuesta de COPAM y quieres que la revise OSITRAN. La presentas aquí y COPAM la envía al Tribunal de OSITRAN. Tienes 15 días hábiles desde que te notificaron la respuesta.',
            'procedimiento_texto'   => 'Ver el procedimiento completo (PDF)',
            'procedimiento_archivo' => ['_file' => 'assets/docs/guia-procedimiento-reclamos.pdf'],
            'plazo_1'               => 'Tienes 60 días desde ocurrido el hecho, o desde que lo conociste, para presentar un reclamo.',
            'plazo_2'               => 'Si lo presentas en físico o por correo, incluye los mismos datos del formulario, la fecha y tu firma o huella.',
            'diagrama_texto'        => 'Descargar diagrama del procedimiento (PDF)',
            'diagrama_archivo'      => ['_file' => 'assets/docs/flujograma-reclamos-2026.pdf'],
            'nota_envio'            => 'Se envía al área de Atención al Usuario:',
        ],
        'reclamos_conforme' => [
            'titulo'     => '¿No estás conforme con la respuesta a tu reclamo?',
            'texto'      => 'Si ya presentaste un reclamo y recibiste la resolución de COPAM, pero no estás de acuerdo con ella, puedes pedir que tu caso se revise. Tienes dos caminos: que COPAM lo vuelva a evaluar o que lo resuelva OSITRAN. Ten a mano el número de tu reclamo y la resolución que recibiste.',
            'nota'       => 'Si estás conforme con la resolución, el procedimiento termina.',
            'instancias' => [
                [
                    'etiqueta'    => 'Opcional · ante COPAM',
                    'titulo'      => 'Reconsideración',
                    'descripcion' => 'Si tienes una nueva prueba, pide a COPAM que revise su respuesta. Preséntala dentro de los ~15 días hábiles~ de notificada la resolución. COPAM resuelve en ~15 días hábiles~.',
                    'boton'       => ['title' => 'Solicitar reconsideración', 'url' => '#formulario'],
                ],
                [
                    'etiqueta'    => 'Ante OSITRAN',
                    'titulo'      => 'Apelación',
                    'descripcion' => 'Si quieres que tu caso lo resuelva OSITRAN. Preséntala ante COPAM dentro de los ~15 días hábiles~ de notificada la resolución; COPAM eleva el expediente al Tribunal de OSITRAN.',
                    'boton'       => ['title' => 'Presentar apelación', 'url' => '#formulario'],
                ],
                [
                    'etiqueta'    => 'Informativo · OSITRAN',
                    'titulo'      => 'Queja ante OSITRAN',
                    'descripcion' => 'Procede si el trámite de tu reclamo se paraliza por demoras, o si se rechaza sin justificación tu reconsideración o apelación. Se presenta ante el Tribunal de OSITRAN, no con este formulario.',
                    'boton'       => ['title' => 'Ir al portal de OSITRAN', 'url' => 'https://www.gob.pe/ositran', 'target' => '_blank'],
                ],
            ],
        ],
        'reclamos_documentos' => [
            'titulo'      => 'Documentos y formatos',
            'texto_boton' => 'Descargar PDF',
            'grupos'      => [
                [
                    'nombre'     => 'Normativa OSITRAN',
                    'documentos' => [
                        ['titulo' => 'Reglamento de Atención de Reclamos y Solución de Controversias de OSITRAN', 'subtitulo' => 'Res. de Consejo Directivo N.° 019-2011-CD-OSITRAN y modificatorias (Res. 0042-2020-CD-OSITRAN y Res. de Presidencia 0040-2025-PD-OSITRAN)', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/reglamento-reclamos-ositran.pdf']],
                    ],
                ],
                [
                    'nombre'     => 'Procedimiento',
                    'documentos' => [
                        ['titulo' => 'Guía de usuario · Procedimiento de atención de reclamos', 'subtitulo' => 'Versión vigente', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/guia-procedimiento-reclamos.pdf']],
                        ['titulo' => 'Diagrama del procedimiento de atención de reclamos', 'subtitulo' => 'Versión vigente', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/flujograma-reclamos-2026.pdf']],
                    ],
                ],
                [
                    'nombre'     => 'Formatos',
                    'documentos' => [
                        ['titulo' => 'Formato de reclamo físico', 'subtitulo' => 'Hoja de reclamación para presentación en físico', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/formato-reclamo-fisico.pdf']],
                    ],
                ],
                [
                    'nombre'     => 'Registro',
                    'documentos' => [
                        ['titulo' => 'Registro de reclamos', 'subtitulo' => 'Registro publicado por COPAM', 'vigente' => 0, 'archivo' => ['_file' => 'assets/docs/registro-reclamos.pdf']],
                    ],
                ],
            ],
        ],
        'reclamos_libro' => [
            'titulo'      => 'Libro de Reclamaciones (reclamos de consumo)',
            'descripcion' => 'Canal de Indecopi para reclamos de consumo, distinto del procedimiento de reclamos de OSITRAN. Plazo de respuesta: 15 días hábiles improrrogables.',
            'boton'       => ['title' => 'Ir al Libro de Reclamaciones', 'url' => ['_page' => 'libro-de-reclamaciones']],
            'imagen'      => ['_file' => 'assets/img/cta-atencion.webp', 'alt' => 'Equipo de COPAM en el muelle del terminal'],
        ],
        'reclamos_derechos' => [
            'titulo'            => 'Derechos y deberes del usuario',
            'bajada'            => 'Reglamento de Usuarios de las Infraestructuras de Transporte de Uso Público de OSITRAN (Res. de Consejo Directivo N.° 035-2017-CD-OSITRAN).',
            'derechos_etiqueta' => 'Derechos · art. 7',
            'derechos_titulo'   => 'Tus derechos como usuario',
            'derechos_items'    => [
                ['texto' => 'A la información'],
                ['texto' => 'A presentar reclamos'],
                ['texto' => 'A presentar sugerencias'],
                ['texto' => 'A presentar denuncias'],
                ['texto' => 'A la atención adecuada'],
                ['texto' => 'A la calidad y cobertura del servicio'],
                ['texto' => 'A recibir comprobante de pago'],
                ['texto' => 'A la no discriminación'],
                ['texto' => 'A participar en los Consejos de Usuarios del OSITRAN'],
                ['texto' => 'A la reparación de daños'],
                ['texto' => 'A la seguridad'],
                ['texto' => 'Al libre uso de la infraestructura'],
            ],
            'deberes_etiqueta'  => 'Deberes · art. 8',
            'deberes_titulo'    => 'Tus deberes como usuario',
            'deberes_items'     => [
                ['texto' => 'Pagar la tarifa o el precio del servicio'],
                ['texto' => 'Mantener una conducta debida y respetar las reglas de uso'],
                ['texto' => 'Conservar la infraestructura y evitar daños'],
                ['texto' => 'Contar con seguro por daños a terceros, cuando corresponda'],
                ['texto' => 'Cumplir los requisitos de acceso a facilidades esenciales, cuando corresponda'],
            ],
        ],
        'reclamos_otros_canales' => [
            'titulo'   => 'Otros canales del usuario',
            'tarjetas' => [
                [
                    'etiqueta'    => 'Ante OSITRAN · Arts. 48 a 51',
                    'titulo'      => 'Denuncias',
                    'descripcion' => 'Cualquier persona puede informar al OSITRAN un posible incumplimiento de COPAM, sin necesidad de demostrar un daño. Se presenta por mesa de partes, el Portal del Usuario o la central telefónica del OSITRAN.',
                    'nota'        => 'Incluye tus datos, la descripción de los hechos con lugar y fecha, y pruebas si las tienes.',
                    'enlace'      => ['title' => 'Ir al portal de OSITRAN', 'url' => 'https://www.gob.pe/ositran', 'target' => '_blank'],
                ],
                [
                    'etiqueta'      => 'Normativa',
                    'titulo'        => 'Reglamento de Usuarios',
                    'descripcion'   => 'Conoce todos tus derechos y deberes como usuario del terminal. Res. de Consejo Directivo N.° 035-2017-CD-OSITRAN.',
                    'archivo'       => ['_file' => 'assets/docs/reglamento-usuarios-ositran.pdf'],
                    'texto_archivo' => 'Ver documento (PDF)',
                ],
                [
                    'etiqueta'    => 'Ante COPAM',
                    'titulo'      => 'Sugerencias',
                    'descripcion' => 'Tus comentarios nos ayudan a mejorar el servicio. Envíalos por el Buzón de sugerencias.',
                    'enlace'      => ['title' => 'Ir al Buzón de sugerencias', 'url' => '/contacto/#buzon'],
                ],
            ],
        ],
        'reclamos_faq' => [
            'titulo' => 'Preguntas frecuentes',
            'bajada' => 'Respuestas a las consultas más comunes sobre reclamos y recursos.',
            'items'  => [
                ['pregunta' => '¿Qué es la queja ante OSITRAN?', 'respuesta' => 'Es un recurso ante el Tribunal de Solución de Controversias de OSITRAN por defectos en la tramitación del procedimiento. No es un reclamo sobre el servicio y no se presenta con el formulario de esta página.'],
                ['pregunta' => '¿Dónde presento mi reclamo?', 'respuesta' => 'Con el formulario de esta página, en formato físico en el terminal o por correo electrónico a servicioclientes@copam.com.pe, dentro de los 60 días de ocurrido el hecho o de conocido este.'],
                ['pregunta' => '¿Qué datos necesito para presentar un reclamo?', 'respuesta' => 'Nombre o razón social, documento, domicilio y domicilio para notificaciones, teléfono y correo; los datos de tu representante, si actúas mediante uno; y tu pretensión, sus fundamentos y los medios probatorios. Puedes solicitar informe oral.'],
                ['pregunta' => '¿El Libro de Reclamaciones es lo mismo que este formulario?', 'respuesta' => 'No. El Libro de Reclamaciones es el canal de Indecopi para reclamos de consumo. Los reclamos sobre los servicios del terminal se presentan con este formulario, conforme al reglamento de OSITRAN.'],
                ['pregunta' => '¿Qué hago si no estoy de acuerdo con la respuesta?', 'respuesta' => 'Dentro de los 15 días hábiles de notificada la resolución, puedes presentar una reconsideración ante COPAM, con nueva prueba, o una apelación, que COPAM eleva al Tribunal de OSITRAN. Indica el número de tu reclamo y la resolución que impugnas.'],
            ],
        ],
    ],
];
