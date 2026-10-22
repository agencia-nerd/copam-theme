<?php
defined('ABSPATH') || exit;

/*
 * Hoja de reclamación del Depósito Temporal (spec `deposito-temporal`, sección quejas_reclamos).
 * La vista es template-parts/forms/hoja-reclamacion-dt.php.
 *
 * Además de lo que hace el motor (inc/forms.php), este form:
 *  - exige los datos del padre o madre solo cuando se marca "Soy menor de edad" (lo valida el servidor);
 *  - numera cada hoja de forma correlativa por año (DT-2026-00001), como pide el Libro de Reclamaciones;
 *  - envía una copia al correo del reclamante y responde con el número de hoja.
 * Los destinatarios salen de Ajustes del sitio > Correos > Depósito Temporal.
 */
const COPAM_THEME_HOJA_DT = 'hoja-reclamacion-dt';

add_filter('copam_theme_forms', 'copam_theme_hoja_dt_definicion');
function copam_theme_hoja_dt_definicion($forms)
{
    // Los datos del padre o madre solo son obligatorios si el envío marca "menor".
    $menor = wp_doing_ajax()
        && isset($_POST['form'], $_POST['menor']) // phpcs:ignore WordPress.Security.NonceVerification -- el motor verifica el nonce antes de validar
        && sanitize_key(wp_unslash($_POST['form'])) === COPAM_THEME_HOJA_DT
        && in_array(sanitize_text_field(wp_unslash($_POST['menor'])), ['1', 'on', 'true'], true);

    $opciones = function_exists('get_field') ? get_field('opciones_correos', 'option') : null;
    $correos  = is_array($opciones) ? (array) ($opciones['deposito'] ?? []) : [];

    $forms[COPAM_THEME_HOJA_DT] = [
        'title'    => 'Hoja de reclamación · Depósito Temporal',
        'subject'  => 'Nueva queja o reclamo del Depósito Temporal',
        'to'       => array_values(array_filter(array_map(static fn($fila): string => (string) ($fila['correo'] ?? ''), $correos))),
        'reply_to' => 'correo',
        'store'    => 'all',
        'redirect' => '',
        'success'  => 'Tu queja o reclamo fue registrado. COPAM dará respuesta en un plazo no mayor a quince (15) días hábiles.',

        'fields' => [
            'nombre' => [
                'type'     => 'name',
                'label'    => 'Nombre',
                'required' => true,
                'min'      => 3,
            ],
            'doc_tipo' => [
                'type'     => 'select',
                'label'    => 'Tipo de documento',
                'required' => true,
                'options'  => [
                    'dni' => 'DNI',
                    'ce'  => 'Carné de extranjería',
                ],
            ],
            'num_doc' => [
                'type'     => 'digits',
                'label'    => 'Número de documento',
                'required' => true,
                'min'      => 8,
                'max'      => 12,
                'messages' => ['min' => 'Ingresa entre 8 y 12 dígitos.'],
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
                'label'        => 'Padre o madre',
                'required'     => $menor,
                'min'          => 3,
                'autocomplete' => 'off',
            ],
            'apo_documento' => [
                'type'     => 'digits',
                'label'    => 'Número de documento del padre o madre',
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
                'label'    => 'Tipo',
                'required' => true,
                'options'  => [
                    'reclamo' => 'Reclamo',
                    'queja'   => 'Queja',
                ],
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
                'type'  => 'consent',
                'label' => 'Declara que la información es verdadera y acepta la Política de privacidad',
            ],
        ],
    ];

    return $forms;
}

// Datos del proveedor que se muestran en la hoja: campos de la página Depósito Temporal.
function copam_theme_hoja_dt_proveedor($post_id = 0)
{
    if (!$post_id) {
        $paginas = get_pages(['meta_key' => '_wp_page_template', 'meta_value' => 'pages/template-deposito-temporal.php', 'number' => 1]);
        $post_id = $paginas ? (int) $paginas[0]->ID : 0;
    }
    $grupo = ($post_id && function_exists('get_field')) ? (get_field('deposito_temporal_quejas_reclamos', $post_id) ?: []) : [];

    return [
        'razon_social' => (string) ($grupo['razon_social'] ?? ''),
        'ruc'          => (string) ($grupo['ruc'] ?? ''),
        'domicilio'    => (string) ($grupo['domicilio'] ?? ''),
        'codigo'       => (string) ($grupo['codigo'] ?? ''),
    ];
}

// Número y fecha de la hoja en curso (se asignan una sola vez por envío, al armar el correo).
function copam_theme_hoja_dt_actual(?array $nueva = null)
{
    static $hoja = null;
    if ($nueva !== null) {
        $hoja = $nueva;
    }
    return $hoja;
}

// Texto de la hoja (correo al proveedor y copia al reclamante).
function copam_theme_hoja_dt_texto(array $form, array $data, array $hoja)
{
    $proveedor = copam_theme_hoja_dt_proveedor();
    $lineas = [
        'Hoja de reclamación N.° ' . $hoja['numero'],
        'Fecha: ' . $hoja['fecha'],
        '',
        'DATOS DEL PROVEEDOR',
        'Razón social: ' . $proveedor['razon_social'],
        'RUC: ' . $proveedor['ruc'],
        'Domicilio del establecimiento: ' . $proveedor['domicilio'],
    ];
    if ($proveedor['codigo'] !== '') {
        $lineas[] = 'Código de identificación: ' . $proveedor['codigo'];
    }

    $secciones = [
        '1. IDENTIFICACIÓN DEL CONSUMIDOR RECLAMANTE' => ['nombre', 'doc_tipo', 'num_doc', 'domicilio', 'telefono', 'correo', 'menor', 'apo_nombre', 'apo_documento'],
        '2. IDENTIFICACIÓN DEL BIEN CONTRATADO'        => ['bien', 'monto', 'bien_desc'],
        '3. DETALLE DE LA RECLAMACIÓN Y PEDIDO'        => ['tipo', 'detalle', 'pedido'],
    ];
    foreach ($secciones as $titulo => $claves) {
        $lineas[] = '';
        $lineas[] = $titulo;
        foreach ($claves as $clave) {
            $campo = $form['fields'][$clave];
            $valor = $data[$clave] ?? '';
            if (in_array($clave, ['apo_nombre', 'apo_documento'], true) && empty($data['menor'])) {
                continue;
            }
            if (is_bool($valor)) {
                $valor = $valor ? 'Sí' : 'No';
            } elseif (in_array($campo['type'], ['select', 'radio'], true) && $valor !== '') {
                $valor = (string) ($campo['options'][$valor] ?? $valor);
            }
            $lineas[] = $campo['type'] === 'textarea' ? $campo['label'] . ":\n" . $valor : $campo['label'] . ': ' . ($valor !== '' ? $valor : '—');
        }
    }

    $lineas[] = '';
    $lineas[] = '4. OBSERVACIONES Y ACCIONES ADOPTADAS POR EL PROVEEDOR';
    $lineas[] = 'Las completa COPAM al dar respuesta, en un plazo no mayor a quince (15) días hábiles.';

    return implode("\n", $lineas);
}

// Correo al proveedor: asigna el número y reemplaza el cuerpo por la hoja completa.
add_filter('copam_theme_form_mail', 'copam_theme_hoja_dt_correo', 10, 3);
function copam_theme_hoja_dt_correo($mail, $form, $data)
{
    if (($form['id'] ?? '') !== COPAM_THEME_HOJA_DT) {
        return $mail;
    }

    $hoja = copam_theme_hoja_dt_actual(['numero' => copam_theme_hoja_siguiente_numero('DT'), 'fecha' => wp_date('d/m/Y')]);
    $mail['subject'] .= ' · N.° ' . $hoja['numero'];
    $mail['message']  = copam_theme_hoja_dt_texto($form, $data, $hoja);

    return $mail;
}

// El envío guardado en el admin lleva el número de hoja en el título.
add_filter('wp_insert_post_data', 'copam_theme_hoja_dt_titulo_envio', 20, 2);
function copam_theme_hoja_dt_titulo_envio($post_data, $postarr)
{
    $hoja = copam_theme_hoja_dt_actual();
    if ($hoja && empty($postarr['ID']) && defined('COPAM_THEME_ENTRY_TYPE') && ($post_data['post_type'] ?? '') === COPAM_THEME_ENTRY_TYPE) {
        $post_data['post_title'] = wp_slash('N.° ' . $hoja['numero'] . ' — ') . $post_data['post_title'];
    }
    return $post_data;
}

// Tras enviar: copia al reclamante y respuesta con el número de hoja.
add_action('copam_theme_form_submitted', 'copam_theme_hoja_dt_enviado', 10, 4);
function copam_theme_hoja_dt_enviado($form_id, $data, $sent, $form)
{
    $hoja = copam_theme_hoja_dt_actual();
    if ($form_id !== COPAM_THEME_HOJA_DT || !$sent || !$hoja) {
        return;
    }

    $correo = (string) ($data['correo'] ?? '');
    if (is_email($correo)) {
        $copia = "Hola,\n\nEsta es la copia de tu hoja de reclamación registrada en el Depósito Temporal de Concesionaria Puerto Amazonas S.A.\n\n"
            . copam_theme_hoja_dt_texto($form, $data, $hoja);
        if (!wp_mail($correo, 'Copia de tu hoja de reclamación N.° ' . $hoja['numero'], $copia, ['Content-Type: text/plain; charset=UTF-8'])) {
            copam_theme_form_log('No se pudo enviar la copia de la hoja ' . $hoja['numero'] . ' al reclamante.');
        }
    }

    wp_send_json_success([
        'message'  => sprintf(
            'Tu queja o reclamo fue registrado con la hoja N.° %1$s el %2$s. Enviamos una copia a %3$s. COPAM dará respuesta en un plazo no mayor a quince (15) días hábiles.',
            $hoja['numero'],
            $hoja['fecha'],
            $correo
        ),
        'redirect' => '',
    ]);
}
