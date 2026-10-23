<?php
defined('ABSPATH') || exit;

/*
 * Reporte del Canal de hostigamiento sexual (spec `canal-hostigamiento-sexual`, sección reporte).
 * La vista es template-parts/forms/reporte-hostigamiento.php; lo propio del front está en
 * src/js/modules/reporte-hostigamiento.js.
 *
 * Es confidencial. Además de lo que hace el motor (inc/forms.php), este form:
 *  - envía solo a Ajustes del sitio > Correos > Canal de hostigamiento: si no hay correo, el envío falla
 *    (nunca cae en el correo del administrador ni en otro destinatario);
 *  - no guarda envíos en la base (`store` none) ni escribe sus campos en el log;
 *  - con "Prefiero no identificarme" descarta nombre, documento, correo y teléfono aunque lleguen en el POST,
 *    y solo toma el correo de contacto opcional;
 *  - recibe la evidencia por su propio endpoint (el motor no envía archivos): se guarda en una carpeta
 *    temporal privada, viaja adjunta en el correo y se borra al enviar. Nada pasa por la biblioteca de medios.
 */
const COPAM_THEME_FORM_REPORTE = 'reporte-hostigamiento';
// Evidencia: hasta 5 archivos y 10 MB entre todos (inc/helpers/adjuntos.php).
const COPAM_THEME_REPORTE_ADJUNTOS = [
    'carpeta'      => 'copam-reporte-tmp',
    'limite'       => 'reporte-adjuntos',
    'max_archivos' => 5,
    'max_bytes'    => 10 * MB_IN_BYTES,
];

add_filter('copam_theme_forms', 'copam_theme_reporte_definicion');
function copam_theme_reporte_definicion($forms)
{
    $es_envio = copam_theme_reporte_es_envio();
    $anonimo  = $es_envio
        && isset($_POST['identificarse']) // phpcs:ignore WordPress.Security.NonceVerification -- el motor verifica el nonce antes de validar
        && sanitize_key(wp_unslash($_POST['identificarse'])) === 'no'; // phpcs:ignore WordPress.Security.NonceVerification

    // Los datos personales solo son obligatorios al identificarse; la vista los muestra según la opción.
    $identificado = $es_envio && !$anonimo;

    $fields = [
        'quien' => [
            'type'     => 'radio',
            'label'    => '¿Quién reporta?',
            'required' => true,
            'options'  => [
                'trabajador' => 'Trabajador de COPAM',
                'proveedor'  => 'Proveedor o contratista',
                'usuario'    => 'Usuario o visitante',
                'otro'       => 'Otro',
            ],
        ],
        'identificarse' => [
            'type'     => 'radio',
            'label'    => '¿Desea identificarse?',
            'required' => true,
            'options'  => [
                'si' => 'Sí',
                'no' => 'Prefiero no identificarme',
            ],
        ],
        'nombre' => [
            'type'     => 'name',
            'label'    => 'Nombre y apellidos',
            'required' => $identificado,
            'min'      => 3,
        ],
        'documento' => [
            'type'     => 'digits',
            'label'    => 'Documento de identidad',
            'required' => $identificado,
            'min'      => 8,
            'max'      => 11,
            'messages' => ['min' => 'Ingresa entre 8 y 11 dígitos.'],
        ],
        'correo' => [
            'type'     => 'email',
            'label'    => 'Correo electrónico',
            'required' => $identificado,
        ],
        'telefono' => [
            'type'  => 'phone',
            'label' => 'Teléfono',
        ],
        'correo_contacto' => [
            'type'  => 'email',
            'label' => 'Correo de contacto',
        ],
        'afectada' => [
            'type'     => 'radio',
            'label'    => '¿Es la persona afectada?',
            'required' => true,
            'options'  => [
                'si' => 'Sí',
                'no' => 'No, soy testigo o tercero',
            ],
        ],
        'fecha' => [
            'type'         => 'text',
            'label'        => 'Fecha aproximada de los hechos',
            'max'          => 10,
            'autocomplete' => 'off',
        ],
        'lugar' => [
            'type'         => 'text',
            'label'        => 'Lugar',
            'autocomplete' => 'off',
        ],
        'descripcion' => [
            'type'     => 'textarea',
            'label'    => 'Descripción de los hechos',
            'required' => true,
            'min'      => 10,
            'max'      => 5000,
        ],
        'involucrados' => [
            'type'         => 'text',
            'label'        => 'Persona(s) involucrada(s)',
            'max'          => 300,
            'autocomplete' => 'off',
        ],
        // Identificador del lote de evidencia subido por copam_theme_reporte_adjuntos(); la vista lo oculta.
        'adjuntos' => [
            'type'         => 'text',
            'label'        => 'Evidencia adjunta',
            'max'          => 32,
            'autocomplete' => 'off',
        ],
        'privacidad' => [
            'type'     => 'consent',
            'label'    => 'Acepta la Política de privacidad y el tratamiento de sus datos personales',
            'messages' => ['required' => 'Debes aceptar la Política de privacidad para enviar el reporte.'],
        ],
        'declaracion' => [
            'type'     => 'consent',
            'label'    => 'Declara que la información es veraz y acepta que sea tratada de forma confidencial por el Delegado',
            'messages' => ['required' => 'Debes aceptar la declaración para enviar el reporte.'],
        ],
    ];

    if ($es_envio && $anonimo) {
        unset($fields['nombre'], $fields['documento'], $fields['correo'], $fields['telefono']);
    } elseif ($es_envio) {
        unset($fields['correo_contacto']);
    }

    $forms[COPAM_THEME_FORM_REPORTE] = [
        'title'      => 'Canal de hostigamiento sexual',
        'subject'    => 'Nuevo reporte del Canal de hostigamiento sexual',
        'to'         => copam_theme_correos('hostigamiento'),
        'reply_to'   => $anonimo ? 'correo_contacto' : 'correo',
        'store'      => 'none',
        'redirect'   => '',
        'success'    => $es_envio ? copam_theme_reporte_exito() : '',
        'rate_limit' => 5,
        'fields'     => $fields,
    ];

    return $forms;
}

function copam_theme_reporte_es_envio()
{
    return wp_doing_ajax()
        && isset($_POST['form']) // phpcs:ignore WordPress.Security.NonceVerification -- el motor verifica el nonce antes de validar
        && sanitize_key(wp_unslash($_POST['form'])) === COPAM_THEME_FORM_REPORTE;
}

// Mensaje de éxito: campo de la página del Canal (el envío llega por AJAX, sin la página en contexto).
function copam_theme_reporte_exito()
{
    $paginas = get_pages(['meta_key' => '_wp_page_template', 'meta_value' => 'pages/template-canal-hostigamiento-sexual.php', 'number' => 1]);
    $grupo   = ($paginas && function_exists('get_field')) ? (get_field('canal_hostigamiento_sexual_reporte', (int) $paginas[0]->ID) ?: []) : [];

    return (string) ($grupo['mensaje_exito'] ?? '');
}

/* -------------------------------------------------------------------------
 * Correo: solo al Delegado, con la evidencia adjunta
 * ---------------------------------------------------------------------- */

add_filter('copam_theme_form_mail', 'copam_theme_reporte_correo', 10, 3);
function copam_theme_reporte_correo($mail, $form, $data)
{
    if (!copam_theme_reporte_es_envio()) {
        return $mail;
    }

    // Solo el Delegado: si el repetidor está vacío, wp_mail falla y el visitante ve el error (no hay respaldo).
    $mail['to'] = copam_theme_correos('hostigamiento');

    $lote     = (string) ($data['adjuntos'] ?? '');
    $archivos = copam_theme_adjuntos_archivos(COPAM_THEME_REPORTE_ADJUNTOS['carpeta'], $lote);
    copam_theme_adjuntos_pendientes($archivos);

    // En el cuerpo, el identificador del lote se cambia por los nombres de los archivos.
    if ($lote !== '') {
        $nombres = $archivos ? implode(', ', array_map('wp_basename', $archivos)) : 'no se recibieron archivos';
        $mail['message'] = str_replace('Evidencia adjunta: ' . $lote, 'Evidencia adjunta: ' . $nombres, $mail['message']);
    }
    // Sin la URL de la página: el correo no debe decir más de lo necesario.
    $mail['message'] = preg_replace('/

Página: .*$/u', '', $mail['message']);

    return $mail;
}

// Enviado el correo, la evidencia se borra del servidor. Si falló, el lote queda para el reintento
// y se borra solo pasado COPAM_THEME_ADJUNTOS_VIDA.
add_action('copam_theme_form_submitted', 'copam_theme_reporte_limpiar', 10, 3);
function copam_theme_reporte_limpiar($form_id, $data, $sent)
{
    if ($form_id !== COPAM_THEME_FORM_REPORTE) {
        return;
    }
    copam_theme_adjuntos_pendientes([]);
    if ($sent) {
        copam_theme_adjuntos_borrar_lote(COPAM_THEME_REPORTE_ADJUNTOS['carpeta'], (string) ($data['adjuntos'] ?? ''));
    }
}

// Endpoint de la evidencia: responde con el identificador del lote, que el form envía en el campo `adjuntos`.
add_action('wp_ajax_copam_theme_reporte_adjuntos', 'copam_theme_reporte_adjuntos');
add_action('wp_ajax_nopriv_copam_theme_reporte_adjuntos', 'copam_theme_reporte_adjuntos');
function copam_theme_reporte_adjuntos()
{
    copam_theme_adjuntos_recibir(COPAM_THEME_REPORTE_ADJUNTOS);
}
