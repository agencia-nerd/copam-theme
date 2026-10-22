<?php
defined('ABSPATH') || exit;

/*
 * Envíos guardados (skill wp-form, módulo opcional).
 *
 * Se instala solo si el proyecto quiere ver los envíos en el admin. Cada form decide
 * qué guarda con 'store' (none | all | failed).
 *
 * - Solo administradores (manage_options): los envíos tienen datos personales.
 * - Solo lectura: no se crean ni se editan desde el admin. Sí se pueden borrar.
 * - Datos personales (Ley 29733): conexión con Herramientas → Exportar / Borrar datos
 *   personales de WordPress (busca por email). Sin borrado automático por antigüedad.
 */

const COPAM_THEME_ENTRY_TYPE = 'copam_theme_envio';
const COPAM_THEME_ENTRY_CAP = 'manage_options';

function copam_theme_register_entries()
{
    $cap = COPAM_THEME_ENTRY_CAP;

    register_post_type(COPAM_THEME_ENTRY_TYPE, [
        'labels' => [
            'name'               => 'Envíos',
            'singular_name'      => 'Envío',
            'menu_name'          => 'Envíos',
            'all_items'          => 'Todos los envíos',
            'edit_item'          => 'Ver envío',
            'search_items'       => 'Buscar envíos',
            'not_found'          => 'No hay envíos.',
            'not_found_in_trash' => 'No hay envíos en la papelera.',
        ],
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => false,
        'exclude_from_search' => true,
        'menu_icon'           => 'dashicons-email-alt',
        'supports'            => false,
        'map_meta_cap'        => false,
        'capabilities'        => [
            'create_posts'           => 'do_not_allow',
            'publish_posts'          => 'do_not_allow',
            'edit_post'              => $cap,
            'read_post'              => $cap,
            'delete_post'            => $cap,
            'edit_posts'             => $cap,
            'edit_others_posts'      => $cap,
            'edit_private_posts'     => $cap,
            'edit_published_posts'   => $cap,
            'read_private_posts'     => $cap,
            'delete_posts'           => $cap,
            'delete_others_posts'    => $cap,
            'delete_private_posts'   => $cap,
            'delete_published_posts' => $cap,
        ],
        'rewrite'             => false,
        'query_var'           => false,
    ]);
}
add_action('init', 'copam_theme_register_entries');

// Lo llama el motor de forms según el valor de 'store'.
function copam_theme_form_store_entry(array $form, array $data, $sent)
{
    $rows = [];
    foreach ($form['fields'] as $key => $field) {
        $value = $data[$key] ?? '';
        if (is_bool($value)) {
            $value = $value ? 'Sí' : 'No';
        } elseif (in_array($field['type'], ['select', 'radio'], true) && $value !== '') {
            $value = (string) ($field['options'][$value] ?? $value);
        }
        $rows[] = [
            'label'     => $field['label'] !== '' ? $field['label'] : $key,
            'value'     => (string) $value,
            'multiline' => $field['type'] === 'textarea',
        ];
    }

    $email = '';
    foreach ($form['fields'] as $key => $field) {
        if ($field['type'] === 'email' && !empty($data[$key])) {
            $email = strtolower((string) $data[$key]);
            break;
        }
    }

    // wp_insert_post y update_post_meta quitan barras invertidas: se escapan antes
    // para que un "\" escrito por el usuario se guarde tal cual.
    $post_id = wp_insert_post(wp_slash([
        'post_type'   => COPAM_THEME_ENTRY_TYPE,
        'post_status' => 'private',
        'post_title'  => $form['title'] . ($email !== '' ? ' — ' . $email : ''),
    ]), true);

    if (is_wp_error($post_id)) {
        copam_theme_form_log('No se pudo guardar el envío: ' . $post_id->get_error_message());
        return;
    }

    update_post_meta($post_id, '_copam_theme_form', $form['id']);
    update_post_meta($post_id, '_copam_theme_status', $sent ? 'sent' : 'failed');
    update_post_meta($post_id, '_copam_theme_email', $email);
    update_post_meta($post_id, '_copam_theme_rows', wp_slash($rows));
}

/* -------------------------------------------------------------------------
 * Admin: listado y detalle de solo lectura
 * ---------------------------------------------------------------------- */

function copam_theme_entries_columns($columns)
{
    return [
        'cb'                => $columns['cb'] ?? '',
        'title'             => 'Envío',
        'copam_theme_form'   => 'Formulario',
        'copam_theme_status' => 'Estado',
        'date'              => 'Fecha',
    ];
}
add_filter('manage_' . COPAM_THEME_ENTRY_TYPE . '_posts_columns', 'copam_theme_entries_columns');

function copam_theme_entries_column($column, $post_id)
{
    if ($column === 'copam_theme_form') {
        echo esc_html((string) get_post_meta($post_id, '_copam_theme_form', true));
    }
    if ($column === 'copam_theme_status') {
        $sent = get_post_meta($post_id, '_copam_theme_status', true) === 'sent';
        printf(
            '<span style="color:%s;font-weight:600;">%s</span>',
            $sent ? '#00703c' : '#b32d2e',
            $sent ? 'Enviado' : 'Correo no enviado'
        );
    }
}
add_action('manage_' . COPAM_THEME_ENTRY_TYPE . '_posts_custom_column', 'copam_theme_entries_column', 10, 2);

// Sin edición rápida ni edición masiva: solo ver y borrar.
function copam_theme_entries_row_actions($actions, $post)
{
    if ($post->post_type !== COPAM_THEME_ENTRY_TYPE) {
        return $actions;
    }
    unset($actions['inline hide-if-no-js']);
    if (isset($actions['edit'])) {
        $actions['edit'] = sprintf('<a href="%s">Ver</a>', esc_url(get_edit_post_link($post->ID)));
    }

    return $actions;
}
add_filter('post_row_actions', 'copam_theme_entries_row_actions', 10, 2);

function copam_theme_entries_bulk_actions($actions)
{
    unset($actions['edit']);

    return $actions;
}
add_filter('bulk_actions-edit-' . COPAM_THEME_ENTRY_TYPE, 'copam_theme_entries_bulk_actions');

function copam_theme_entries_meta_boxes()
{
    // Sin caja "Publicar": no se cambia estado ni fecha. Se borra desde el listado.
    remove_meta_box('submitdiv', COPAM_THEME_ENTRY_TYPE, 'side');
    remove_meta_box('slugdiv', COPAM_THEME_ENTRY_TYPE, 'normal');
    add_meta_box('copam_theme_entry_data', 'Datos del envío', 'copam_theme_entries_render', COPAM_THEME_ENTRY_TYPE, 'normal', 'high');
}
add_action('add_meta_boxes', 'copam_theme_entries_meta_boxes');

// Aunque alguien fuerce un POST al editor, el envío no cambia.
function copam_theme_entries_block_save($data, $postarr)
{
    if ($data['post_type'] === COPAM_THEME_ENTRY_TYPE && !empty($postarr['ID']) && is_admin() && isset($_POST['action']) && $_POST['action'] === 'editpost') {
        $original = get_post((int) $postarr['ID']);
        if ($original) {
            $data['post_title'] = wp_slash($original->post_title);
            $data['post_status'] = $original->post_status;
            $data['post_date'] = $original->post_date;
            $data['post_date_gmt'] = $original->post_date_gmt;
        }
    }

    return $data;
}
add_filter('wp_insert_post_data', 'copam_theme_entries_block_save', 10, 2);

function copam_theme_entries_render($post)
{
    $rows = (array) get_post_meta($post->ID, '_copam_theme_rows', true);
    $sent = get_post_meta($post->ID, '_copam_theme_status', true) === 'sent';

    echo '<p><strong>Estado:</strong> ' . esc_html($sent ? 'Correo enviado' : 'El correo no se pudo enviar') . '</p>';
    echo '<p><strong>Recibido:</strong> ' . esc_html(get_the_date('', $post) . ' ' . get_the_time('', $post)) . '</p>';
    echo '<table class="widefat striped"><tbody>';
    foreach ($rows as $row) {
        $value = esc_html((string) ($row['value'] ?? ''));
        printf(
            '<tr><th style="width:25%%;">%s</th><td>%s</td></tr>',
            esc_html((string) ($row['label'] ?? '')),
            !empty($row['multiline']) ? nl2br($value) : $value
        );
    }
    echo '</tbody></table>';
}

/* -------------------------------------------------------------------------
 * Privacidad: Herramientas → Exportar / Borrar datos personales
 * ---------------------------------------------------------------------- */

function copam_theme_entries_by_email($email, $page)
{
    return get_posts([
        'post_type'      => COPAM_THEME_ENTRY_TYPE,
        'post_status'    => 'any',
        'posts_per_page' => 50,
        'paged'          => (int) $page,
        'meta_key'       => '_copam_theme_email',
        'meta_value'     => strtolower((string) $email),
    ]);
}

function copam_theme_entries_exporter($email, $page = 1)
{
    $items = [];
    $posts = copam_theme_entries_by_email($email, $page);

    foreach ($posts as $post) {
        $data = [['name' => 'Fecha', 'value' => get_the_date('Y-m-d H:i', $post)]];
        foreach ((array) get_post_meta($post->ID, '_copam_theme_rows', true) as $row) {
            $data[] = ['name' => (string) ($row['label'] ?? ''), 'value' => (string) ($row['value'] ?? '')];
        }
        $items[] = [
            'group_id'    => 'copam_theme_form_entries',
            'group_label' => 'Envíos de formularios',
            'item_id'     => 'entry-' . $post->ID,
            'data'        => $data,
        ];
    }

    return ['data' => $items, 'done' => count($posts) < 50];
}

function copam_theme_entries_eraser($email, $page = 1)
{
    // Siempre página 1: lo borrado ya no aparece en la siguiente consulta.
    $posts = copam_theme_entries_by_email($email, 1);
    foreach ($posts as $post) {
        wp_delete_post($post->ID, true);
    }

    return [
        'items_removed'  => count($posts) > 0,
        'items_retained' => false,
        'messages'       => [],
        'done'           => count($posts) < 50,
    ];
}

function copam_theme_entries_register_exporter($exporters)
{
    $exporters['copam_theme-form-entries'] = [
        'exporter_friendly_name' => 'Envíos de formularios',
        'callback'               => 'copam_theme_entries_exporter',
    ];

    return $exporters;
}
add_filter('wp_privacy_personal_data_exporters', 'copam_theme_entries_register_exporter');

function copam_theme_entries_register_eraser($erasers)
{
    $erasers['copam_theme-form-entries'] = [
        'eraser_friendly_name' => 'Envíos de formularios',
        'callback'             => 'copam_theme_entries_eraser',
    ];

    return $erasers;
}
add_filter('wp_privacy_personal_data_erasers', 'copam_theme_entries_register_eraser');
