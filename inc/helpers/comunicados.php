<?php
defined('ABSPATH') || exit;

/*
 * Datos de un comunicado (entrada del blog) listos para el componente comunicado-card y la cabecera del detalle.
 *
 *   get_template_part('template-parts/components/comunicado-card', null, copam_theme_comunicado($post) + [...]);
 *
 * Devuelve titulo, fecha ("18 jul 2026"), categoria (la primera, sin "Sin categoría") y url.
 */
function copam_theme_comunicado($post = null): array
{
    $post = get_post($post);
    if (!$post) {
        return [];
    }

    $categoria = '';
    foreach (get_the_category($post->ID) as $term) {
        if ((int) $term->term_id !== (int) get_option('default_category')) {
            $categoria = $term->name;
            break;
        }
    }

    return [
        'titulo'    => get_the_title($post),
        'fecha'     => copam_theme_comunicado_fecha($post),
        'categoria' => $categoria,
        'url'       => (string) get_permalink($post),
    ];
}

// Fecha de publicación como en el diseño: día con dos cifras, mes abreviado en minúsculas y año ("02 jul 2026").
function copam_theme_comunicado_fecha($post = null): string
{
    $post = get_post($post);
    if (!$post) {
        return '';
    }
    $meses = ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'set', 'oct', 'nov', 'dic'];
    $time  = (int) get_post_time('U', true, $post);

    return wp_date('d', $time) . ' ' . $meses[(int) wp_date('n', $time) - 1] . ' ' . wp_date('Y', $time);
}

// Clases de la píldora de una categoría (valores sueltos del diseño, no tokens); otra categoría va en gris.
function copam_theme_comunicado_pildora(string $categoria, string $otra = 'bg-gris-f2 text-ink'): string
{
    $pildoras = [
        'Operativo'     => 'bg-[#E4F3EA] text-[#0A7434]',
        'Noticias'      => 'bg-[#E6ECF6] text-[#2A4C80]',
        'Mantenimiento' => 'bg-[#FBE8E5] text-[#A8362A]',
    ];

    return $pildoras[$categoria] ?? $otra;
}

// URL del listado de comunicados (la página de entradas); la portada si aún no hay una.
function copam_theme_comunicados_url(): string
{
    $id = (int) get_option('page_for_posts');

    return $id && get_post_status($id) === 'publish' ? (string) get_permalink($id) : home_url('/');
}
