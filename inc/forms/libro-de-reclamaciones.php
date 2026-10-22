<?php
defined('ABSPATH') || exit;

/*
 * Hoja de reclamación del Libro de Reclamaciones virtual (spec `libro-de-reclamaciones`, sección formulario).
 * La vista es template-parts/forms/libro-de-reclamaciones.php; lo propio del front está en
 * src/js/modules/hoja-reclamacion.js (el mismo de la hoja del Depósito Temporal).
 *
 * Además de lo que hace el motor (inc/forms.php), este form:
 *  - valida el número de documento según su tipo (DNI 8 dígitos, RUC 11, carné de extranjería o pasaporte de
 *    6 a 12 letras o números) y el monto con hasta 2 decimales (inc/helpers/validacion.php);
 *  - exige los datos del padre, madre o apoderado solo cuando se marca "Soy menor de edad";
 *  - numera cada hoja por año (LR-2026-00001), la guarda en "Envíos", envía una copia al reclamante y responde
 *    con el número.
 * Los destinatarios salen de Ajustes del sitio > Correos > Libro de Reclamaciones.
 */
const COPAM_THEME_FORM_LIBRO = 'libro-de-reclamaciones';

// Reglas del número de documento por tipo: patrón y mensaje (las mismas en hoja-reclamacion.js).
const COPAM_THEME_LIBRO_DOCUMENTOS = [
    'dni'       => ['/^\d{8}$/', 'El DNI tiene 8 dígitos.'],
    'ce'        => ['/^[A-Za-z0-9]{6,12}$/', 'El carné de extranjería tiene de 6 a 12 letras o números.'],
    'pasaporte' => ['/^[A-Za-z0-9]{6,12}$/', 'El pasaporte tiene de 6 a 12 letras o números.'],
    'ruc'       => ['/^\d{11}$/', 'El RUC tiene 11 dígitos.'],
];

add_filter('copam_theme_forms', 'copam_theme_libro_definicion');
function copam_theme_libro_definicion($forms)
{
    $es_envio = copam_theme_libro_es_envio();
    $menor    = $es_envio
        && isset($_POST['menor']) // phpcs:ignore WordPress.Security.NonceVerification -- el motor verifica el nonce antes de validar
        && in_array(sanitize_text_field(wp_unslash($_POST['menor'])), ['1', 'on', 'true'], true);

    $forms[COPAM_THEME_FORM_LIBRO] = [
        'title'    => 'Libro de Reclamaciones',
        'subject'  => 'Nueva hoja del Libro de Reclamaciones',
        'to'       => copam_theme_correos('libro'),
        'reply_to' => 'correo',
        'store'    => 'all',
        'redirect' => '',
        'success'  => 'Tu hoja de reclamación fue enviada correctamente.',

        'fields' => [
            'nombre' => [
                'type'     => 'name',
                'label'    => 'Nombres y apellidos',
                'required' => true,
                'min'      => 3,
            ],
            'doc_tipo' => [
                'type'     => 'select',
                'label'    => 'Tipo de documento',
                'required' => true,
                'options'  => [
                    'dni'       => 'DNI',
                    'ce'        => 'Carné de extranjería',
                    'pasaporte' => 'Pasaporte',
                    'ruc'       => 'RUC',
                ],
            ],
            'num_doc' => [
                'type'         => 'text',
                'label'        => 'Número de documento',
                'required'     => true,
                'max'          => 12,
                'autocomplete' => 'off',
            ],
            'domicilio' => [
                'type'         => 'text',
                'label'        => 'Domicilio',
                'required'     => true,
                'max'          => 200,
                'autocomplete' => 'street-address',
            ],
            'telefono' => [
                'type'     => 'phone',
                'label'    => 'Teléfono',
                'required' => true,
            ],
            'correo' => [
                'type'     => 'email',
                'label'    => 'Correo electrónico',
                'required' => true,
            ],
            'menor' => [
                'type'  => 'checkbox',
                'label' => 'Soy menor de edad',
            ],
            'apo_nombre' => [
                'type'         => 'name',
                'label'        => 'Nombre del padre, madre o apoderado',
                'required'     => $menor,
                'min'          => 3,
                'autocomplete' => 'off',
            ],
            'apo_documento' => [
                'type'     => 'digits',
                'label'    => 'Número de documento del padre, madre o apoderado',
                'required' => $menor,
                'min'      => 8,
                'max'      => 12,
                'messages' => ['min' => 'Ingresa entre 8 y 12 dígitos.'],
            ],
            'bien' => [
                'type'     => 'radio',
                'label'    => 'Tipo de bien contratado',
                'required' => true,
                'options'  => [
                    'producto' => 'Producto',
                    'servicio' => 'Servicio',
                ],
                'messages' => ['required' => 'Selecciona una opción.'],
            ],
            'monto' => [
                'type'  => 'text',
                'label' => 'Monto reclamado (S/)',
                'max'   => 12,
            ],
            'bien_desc' => [
                'type'     => 'textarea',
                'label'    => 'Descripción del bien contratado',
                'required' => true,
                'min'      => 10,
            ],
            'tipo' => [
                'type'     => 'radio',
                'label'    => 'Tipo de reclamación',
                'required' => true,
                'options'  => [
                    'reclamo' => 'Reclamo',
                    'queja'   => 'Queja',
                ],
                'messages' => ['required' => 'Selecciona una opción.'],
            ],
            'detalle' => [
                'type'     => 'textarea',
                'label'    => 'Detalle',
                'required' => true,
                'min'      => 10,
                'max'      => 2000,
            ],
            'pedido' => [
                'type'     => 'textarea',
                'label'    => 'Pedido',
                'required' => true,
                'min'      => 10,
            ],
            'consentimiento' => [
                'type'     => 'consent',
                'label'    => 'Declara que la información es verdadera y acepta la Política de privacidad',
                'messages' => ['required' => 'Debes aceptar la declaración y la política de privacidad.'],
            ],
        ],
    ];

    return $forms;
}

function copam_theme_libro_es_envio()
{
    return wp_doing_ajax()
        && isset($_POST['form']) // phpcs:ignore WordPress.Security.NonceVerification -- el motor verifica el nonce antes de validar
        && sanitize_key(wp_unslash($_POST['form'])) === COPAM_THEME_FORM_LIBRO;
}

// Número de documento según su tipo y monto con hasta 2 decimales.
add_filter('copam_theme_form_errores_extra', 'copam_theme_libro_errores', 10, 3);
function copam_theme_libro_errores($errores, $form_id, $data)
{
    if ($form_id !== COPAM_THEME_FORM_LIBRO) {
        return $errores;
    }
    $regla  = COPAM_THEME_LIBRO_DOCUMENTOS[$data['doc_tipo'] ?? ''] ?? null;
    $numero = (string) ($data['num_doc'] ?? '');
    if ($regla && $numero !== '' && !preg_match($regla[0], $numero)) {
        $errores['num_doc'] = $regla[1];
    }
    $monto = (string) ($data['monto'] ?? '');
    if ($monto !== '' && !preg_match('/^\d{1,9}([.,]\d{1,2})?$/', $monto)) {
        $errores['monto'] = 'Ingresa solo números, con hasta 2 decimales.';
    }
    return $errores;
}

// Datos de la hoja que el cliente edita en la página: proveedor y mensaje de éxito.
function copam_theme_libro_campos()
{
    $post_id = copam_theme_hoja_pagina('pages/template-libro-de-reclamaciones.php');
    $grupo   = ($post_id && function_exists('get_field')) ? (get_field('libro_de_reclamaciones_formulario', $post_id) ?: []) : [];

    return [
        'razon_social'  => (string) ($grupo['proveedor_razon_social'] ?? ''),
        'ruc'           => (string) ($grupo['proveedor_ruc'] ?? ''),
        'direccion'     => (string) ($grupo['proveedor_direccion'] ?? ''),
        'mensaje_exito' => (string) ($grupo['mensaje_exito'] ?? ''),
    ];
}

// Texto de la hoja (correo al área y copia al reclamante).
function copam_theme_libro_texto(array $form, array $data, array $hoja)
{
    $campos = copam_theme_libro_campos();
    $lineas = array_merge(
        [
            'Hoja de reclamación N.° ' . $hoja['numero'],
            'Fecha: ' . $hoja['fecha'],
            '',
            '1. DATOS DEL PROVEEDOR',
            'Razón social: ' . $campos['razon_social'],
            'RUC: ' . $campos['ruc'],
            'Dirección: ' . $campos['direccion'],
        ],
        copam_theme_hoja_lineas($form, $data, [
            '2. IDENTIFICACIÓN DEL CONSUMIDOR RECLAMANTE'                => ['nombre', 'doc_tipo', 'num_doc', 'domicilio', 'telefono', 'correo', 'menor', 'apo_nombre', 'apo_documento'],
            '3. IDENTIFICACIÓN DEL BIEN CONTRATADO'                       => ['bien', 'monto', 'bien_desc'],
            '4. DETALLE DE LA RECLAMACIÓN Y PEDIDO DEL CONSUMIDOR'        => ['tipo', 'detalle', 'pedido'],
        ], empty($data['menor']) ? ['apo_nombre', 'apo_documento'] : []),
        [
            '',
            '5. OBSERVACIONES Y ACCIONES ADOPTADAS POR EL PROVEEDOR',
            'Las completa COPAM al dar respuesta, en un plazo no mayor a quince (15) días hábiles.',
        ]
    );

    return implode("\n", $lineas);
}

// Correo al área: asigna el número y reemplaza el cuerpo por la hoja completa.
add_filter('copam_theme_form_mail', 'copam_theme_libro_correo', 10, 3);
function copam_theme_libro_correo($mail, $form, $data)
{
    if (($form['id'] ?? '') !== COPAM_THEME_FORM_LIBRO) {
        return $mail;
    }

    $hoja = ['numero' => copam_theme_hoja_siguiente_numero('LR'), 'fecha' => wp_date('d-m-Y')];
    copam_theme_hoja_en_curso($hoja);
    $mail['subject'] .= ' · N.° ' . $hoja['numero'];
    $mail['message']  = copam_theme_libro_texto($form, $data, $hoja);

    return $mail;
}

// Tras enviar: copia al reclamante y respuesta con el número de hoja.
add_action('copam_theme_form_submitted', 'copam_theme_libro_enviado', 10, 4);
function copam_theme_libro_enviado($form_id, $data, $sent, $form)
{
    $hoja = copam_theme_hoja_en_curso();
    if ($form_id !== COPAM_THEME_FORM_LIBRO || !$sent || !$hoja) {
        return;
    }
    copam_theme_hoja_en_curso([]);

    $correo = (string) ($data['correo'] ?? '');
    copam_theme_hoja_enviar_copia(
        $correo,
        'Copia de tu hoja de reclamación N.° ' . $hoja['numero'],
        "Hola,\n\nEsta es la copia de tu hoja de reclamación del Libro de Reclamaciones de Concesionaria Puerto Amazonas S.A.\n\n"
            . copam_theme_libro_texto($form, $data, $hoja)
    );

    $mensaje = trim(copam_theme_libro_campos()['mensaje_exito']) ?: $form['success'];
    wp_send_json_success([
        'message'  => sprintf(
            '%1$s Tu hoja es la N.° %2$s, registrada el %3$s; enviamos una copia a %4$s.',
            $mensaje,
            $hoja['numero'],
            $hoja['fecha'],
            $correo
        ),
        'redirect' => '',
    ]);
}
