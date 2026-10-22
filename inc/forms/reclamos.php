<?php
defined('ABSPATH') || exit;

/*
 * Formulario de reclamos, reconsideraciones y apelaciones (spec `reclamos`, sección formulario), conforme al
 * reglamento de reclamos de OSITRAN. La vista es template-parts/forms/reclamos.php; lo propio del front está en
 * src/js/modules/reclamos.js.
 *
 * Además de lo que hace el motor (inc/forms.php), este form:
 *  - exige el N.° de reclamo y la resolución solo con Reconsideración o Apelación;
 *  - recibe el documento de representación y los medios probatorios por su propio endpoint
 *    (inc/helpers/adjuntos.php): viajan adjuntos en el correo al área y se borran del servidor al enviar;
 *  - numera cada solicitud por año (RC-2026-00001), la guarda en "Envíos" con los nombres de los archivos,
 *    envía una copia al solicitante (sin los archivos) y responde con el número.
 * Los destinatarios salen de Ajustes del sitio > Correos > Reclamos.
 */
const COPAM_THEME_FORM_RECLAMOS = 'reclamos';

// Archivos: el documento de representación (uno) y los medios probatorios (hasta 10, 10 MB entre todos).
const COPAM_THEME_RECLAMOS_ADJUNTOS = [
    'rep_acredita' => [
        'carpeta'      => 'copam-reclamos-tmp',
        'limite'       => 'reclamos-adjuntos',
        'max_archivos' => 1,
        'max_bytes'    => 10 * MB_IN_BYTES,
    ],
    'adjuntos' => [
        'carpeta'      => 'copam-reclamos-tmp',
        'limite'       => 'reclamos-adjuntos',
        'max_archivos' => 10,
        'max_bytes'    => 10 * MB_IN_BYTES,
    ],
];

add_filter('copam_theme_forms', 'copam_theme_reclamos_definicion');
function copam_theme_reclamos_definicion($forms)
{
    // N.° de reclamo y resolución: solo obligatorios si se impugna una resolución.
    $recurso = copam_theme_reclamos_es_envio()
        && isset($_POST['tipo']) // phpcs:ignore WordPress.Security.NonceVerification -- el motor verifica el nonce antes de validar
        && in_array(sanitize_key(wp_unslash($_POST['tipo'])), ['reconsideracion', 'apelacion'], true);

    $forms[COPAM_THEME_FORM_RECLAMOS] = [
        'title'    => 'Reclamos',
        'subject'  => 'Nueva solicitud de reclamo',
        'to'       => copam_theme_correos('reclamos'),
        'reply_to' => 'correo',
        'store'    => 'all',
        'redirect' => '',
        'success'  => 'Recibimos tu solicitud. Te enviamos una copia a tu correo.',

        'fields' => [
            'tipo' => [
                'type'     => 'radio',
                'label'    => 'Tipo de solicitud',
                'required' => true,
                'options'  => [
                    'reclamo'         => 'Reclamo',
                    'reconsideracion' => 'Reconsideración',
                    'apelacion'       => 'Apelación',
                ],
            ],
            'nro_reclamo' => [
                'type'     => 'digits',
                'label'    => 'N.° de reclamo',
                'required' => $recurso,
                'max'      => 10,
            ],
            'resolucion' => [
                'type'         => 'text',
                'label'        => 'N.° y fecha de la resolución que impugnas',
                'required'     => $recurso,
                'max'          => 120,
                'autocomplete' => 'off',
            ],
            'nombre' => [
                'type'     => 'name',
                'label'    => 'Nombre y apellidos',
                'required' => true,
                'min'      => 3,
            ],
            'documento' => [
                'type'     => 'digits',
                'label'    => 'DNI, CE o RUC',
                'required' => true,
                'min'      => 8,
                'max'      => 11,
                'messages' => ['min' => 'Ingresa entre 8 y 11 dígitos.'],
            ],
            'domicilio' => [
                'type'         => 'text',
                'label'        => 'Domicilio',
                'required'     => true,
                'max'          => 200,
                'autocomplete' => 'street-address',
            ],
            'domicilio_notif' => [
                'type'         => 'text',
                'label'        => 'Domicilio para notificaciones',
                'required'     => true,
                'max'          => 200,
                'autocomplete' => 'off',
            ],
            'telefono' => [
                'type'  => 'phone',
                'label' => 'Teléfono',
            ],
            'correo' => [
                'type'     => 'email',
                'label'    => 'Correo electrónico',
                'required' => true,
            ],
            'representacion' => [
                'type'  => 'checkbox',
                'label' => 'Presenta la solicitud en representación de otra persona o empresa',
            ],
            'rep_nombre' => [
                'type'         => 'name',
                'label'        => 'Nombre y apellidos del representante',
                'min'          => 3,
                'autocomplete' => 'off',
            ],
            'rep_documento' => [
                'type'     => 'digits',
                'label'    => 'Documento de identidad del representante',
                'min'      => 8,
                'max'      => 11,
                'messages' => ['min' => 'Ingresa entre 8 y 11 dígitos.'],
            ],
            // Identificador del lote subido por copam_theme_reclamos_subir_*(); la vista lo oculta.
            'rep_acredita' => [
                'type'         => 'text',
                'label'        => 'Documento que acredita la representación',
                'max'          => 32,
                'autocomplete' => 'off',
            ],
            'servicio' => [
                'type'     => 'select',
                'label'    => 'Servicio relacionado',
                'required' => true,
                'options'  => [
                    'nave'                => 'Servicios a la nave',
                    'carga'               => 'Servicios a la carga',
                    'especiales'          => 'Servicios especiales',
                    'deposito_temporal'   => 'Depósito Temporal',
                    'atencion_al_usuario' => 'Atención al usuario',
                ],
            ],
            'referencia' => [
                'type'         => 'text',
                'label'        => 'Referencia de la operación',
                'max'          => 150,
                'autocomplete' => 'off',
            ],
            'pretension' => [
                'type'     => 'textarea',
                'label'    => 'Pretensión',
                'required' => true,
                'min'      => 10,
                'max'      => 2000,
            ],
            'fundamentos' => [
                'type'     => 'textarea',
                'label'    => 'Fundamentos',
                'required' => true,
                'min'      => 10,
                'max'      => 5000,
            ],
            'adjuntos' => [
                'type'         => 'text',
                'label'        => 'Medios probatorios',
                'max'          => 32,
                'autocomplete' => 'off',
            ],
            'notif_correo' => [
                'type'  => 'checkbox',
                'label' => 'Autoriza la notificación por correo electrónico',
            ],
            'veraz' => [
                'type'     => 'consent',
                'label'    => 'Declara que la información proporcionada es veraz',
                'messages' => ['required' => 'Debes declarar que la información es veraz.'],
            ],
            'informe_oral' => [
                'type'  => 'checkbox',
                'label' => 'Solicita informe oral',
            ],
            'consentimiento' => [
                'type'  => 'consent',
                'label' => 'Acepta la Política de privacidad y el tratamiento de sus datos personales',
            ],
        ],
    ];

    return $forms;
}

function copam_theme_reclamos_es_envio()
{
    return wp_doing_ajax()
        && isset($_POST['form']) // phpcs:ignore WordPress.Security.NonceVerification -- el motor verifica el nonce antes de validar
        && sanitize_key(wp_unslash($_POST['form'])) === COPAM_THEME_FORM_RECLAMOS;
}

// Nombres de los archivos de cada campo de adjuntos ('' si no hay), para el correo y el envío guardado.
function copam_theme_reclamos_nombres(array $data)
{
    $nombres = [];
    foreach (COPAM_THEME_RECLAMOS_ADJUNTOS as $campo => $canal) {
        $lote     = (string) ($data[$campo] ?? '');
        $archivos = copam_theme_adjuntos_archivos($canal['carpeta'], $lote);
        $nombres[$campo] = $archivos
            ? implode(', ', array_map('wp_basename', $archivos))
            : ($lote !== '' ? 'no se recibieron archivos' : '');
    }
    return $nombres;
}

// Texto de la solicitud (correo al área y copia al solicitante).
function copam_theme_reclamos_texto(array $form, array $data, array $hoja, array $nombres)
{
    $omitir = [];
    if (($data['tipo'] ?? '') === 'reclamo') {
        $omitir = ['nro_reclamo', 'resolucion'];
    }
    if (empty($data['representacion'])) {
        $omitir = array_merge($omitir, ['rep_nombre', 'rep_documento', 'rep_acredita']);
    }

    return implode("\n", array_merge(
        [
            'Solicitud N.° ' . $hoja['numero'],
            'Fecha: ' . $hoja['fecha'],
        ],
        copam_theme_hoja_lineas($form, $data, [
            'TIPO DE SOLICITUD'          => ['tipo', 'nro_reclamo', 'resolucion'],
            'DATOS DEL SOLICITANTE'      => ['nombre', 'documento', 'domicilio', 'domicilio_notif', 'telefono', 'correo', 'representacion', 'rep_nombre', 'rep_documento', 'rep_acredita'],
            'DETALLE DE LA SOLICITUD'    => ['servicio', 'referencia', 'pretension', 'fundamentos', 'adjuntos'],
            'AUTORIZACIONES'             => ['notif_correo', 'informe_oral', 'veraz', 'consentimiento'],
        ], $omitir, $nombres)
    ));
}

// Correo al área: asigna el número, reemplaza el cuerpo y adjunta los archivos.
add_filter('copam_theme_form_mail', 'copam_theme_reclamos_correo', 10, 3);
function copam_theme_reclamos_correo($mail, $form, $data)
{
    if (($form['id'] ?? '') !== COPAM_THEME_FORM_RECLAMOS) {
        return $mail;
    }

    $hoja = ['numero' => copam_theme_hoja_siguiente_numero('RC'), 'fecha' => wp_date('d/m/Y')];
    copam_theme_hoja_en_curso($hoja);

    $archivos = [];
    foreach (COPAM_THEME_RECLAMOS_ADJUNTOS as $campo => $canal) {
        $archivos = array_merge($archivos, copam_theme_adjuntos_archivos($canal['carpeta'], (string) ($data[$campo] ?? '')));
    }
    copam_theme_adjuntos_pendientes($archivos);

    $mail['subject'] .= ' · N.° ' . $hoja['numero'];
    $mail['message']  = copam_theme_reclamos_texto($form, $data, $hoja, copam_theme_reclamos_nombres($data));

    return $mail;
}

/*
 * Tras enviar: el envío guardado muestra los nombres de los archivos (no el identificador del lote), los
 * archivos se borran, sale la copia al solicitante y la respuesta lleva el número. Si el correo falló, los
 * archivos quedan para el reintento y se borran solos pasado COPAM_THEME_ADJUNTOS_VIDA.
 */
add_action('copam_theme_form_submitted', 'copam_theme_reclamos_enviado', 10, 4);
function copam_theme_reclamos_enviado($form_id, $data, $sent, $form)
{
    if ($form_id !== COPAM_THEME_FORM_RECLAMOS) {
        return;
    }
    copam_theme_adjuntos_pendientes([]);
    $hoja = copam_theme_hoja_en_curso();
    copam_theme_hoja_en_curso([]);
    if (!$hoja) {
        return;
    }

    $nombres = copam_theme_reclamos_nombres($data);
    if (!empty($hoja['envio'])) {
        $etiquetas = [];
        foreach (array_keys(COPAM_THEME_RECLAMOS_ADJUNTOS) as $campo) {
            $etiquetas[$form['fields'][$campo]['label']] = $nombres[$campo];
        }
        $filas = (array) get_post_meta($hoja['envio'], '_copam_theme_rows', true);
        foreach ($filas as &$fila) {
            if (isset($fila['label']) && array_key_exists($fila['label'], $etiquetas)) {
                $fila['value'] = $etiquetas[$fila['label']];
            }
        }
        unset($fila);
        update_post_meta($hoja['envio'], '_copam_theme_rows', wp_slash($filas));
    }

    if (!$sent) {
        return;
    }
    foreach (COPAM_THEME_RECLAMOS_ADJUNTOS as $campo => $canal) {
        copam_theme_adjuntos_borrar_lote($canal['carpeta'], (string) ($data[$campo] ?? ''));
    }

    $correo = (string) ($data['correo'] ?? '');
    copam_theme_hoja_enviar_copia(
        $correo,
        'Copia de tu solicitud N.° ' . $hoja['numero'],
        "Hola,\n\nEsta es la copia de tu solicitud presentada ante Concesionaria Puerto Amazonas S.A. Los archivos que adjuntaste los recibió el área de Atención al Usuario.\n\n"
            . copam_theme_reclamos_texto($form, $data, $hoja, $nombres)
    );

    wp_send_json_success([
        'message'  => sprintf('Recibimos tu solicitud N.° %1$s el %2$s. Te enviamos una copia a %3$s.', $hoja['numero'], $hoja['fecha'], $correo),
        'redirect' => '',
    ]);
}

// Endpoints de los archivos: responden con el identificador del lote, que el form envía en su campo.
add_action('wp_ajax_copam_theme_reclamos_acredita', 'copam_theme_reclamos_subir_acredita');
add_action('wp_ajax_nopriv_copam_theme_reclamos_acredita', 'copam_theme_reclamos_subir_acredita');
function copam_theme_reclamos_subir_acredita()
{
    copam_theme_adjuntos_recibir(COPAM_THEME_RECLAMOS_ADJUNTOS['rep_acredita']);
}

add_action('wp_ajax_copam_theme_reclamos_adjuntos', 'copam_theme_reclamos_subir_adjuntos');
add_action('wp_ajax_nopriv_copam_theme_reclamos_adjuntos', 'copam_theme_reclamos_subir_adjuntos');
function copam_theme_reclamos_subir_adjuntos()
{
    copam_theme_adjuntos_recibir(COPAM_THEME_RECLAMOS_ADJUNTOS['adjuntos']);
}
