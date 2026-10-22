<?php
defined('ABSPATH') || exit;

/**
 * Contenido que se repite en todo el sitio (spec `opciones`): menús de WordPress leídos para la cabecera y el pie.
 * Los menús se editan en Apariencia > Menús (ubicaciones `principal`, `pie` y `legal`). El buscador: inc/buscador.php.
 */

/**
 * Elementos de un menú de WordPress como árbol: [['texto', 'url', 'externo', 'subtitulo', 'hijos']].
 * Un elemento con la clase `subtitulo` es un encabezado sin enlace.
 *
 * @return array<int, array<string, mixed>>
 */
function copam_theme_sitio_menu(string $ubicacion): array
{
    $ubicaciones = get_nav_menu_locations();
    $elementos   = !empty($ubicaciones[$ubicacion]) ? wp_get_nav_menu_items((int) $ubicaciones[$ubicacion]) : [];
    if (!$elementos) {
        return [];
    }

    $host_sitio = preg_replace('/^www\./', '', strtolower((string) wp_parse_url(home_url(), PHP_URL_HOST)));
    $por_padre  = [];
    foreach ($elementos as $e) {
        $url  = (string) $e->url;
        $host = preg_replace('/^www\./', '', strtolower((string) wp_parse_url($url, PHP_URL_HOST)));
        $por_padre[(int) $e->menu_item_parent][] = [
            'id'        => (int) $e->ID,
            'texto'     => (string) $e->title,
            'url'       => $url !== '' && $url[0] === '/' ? home_url($url) : $url,
            'externo'   => $host !== '' && $host !== $host_sitio,
            'subtitulo' => in_array('subtitulo', (array) $e->classes, true),
        ];
    }

    $armar = static function (int $padre) use (&$armar, $por_padre): array {
        return array_map(static function (array $item) use (&$armar): array {
            $item['hijos'] = $armar($item['id']);
            return $item;
        }, $por_padre[$padre] ?? []);
    };

    return $armar(0);
}
