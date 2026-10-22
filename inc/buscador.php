<?php
defined('ABSPATH') || exit;

/**
 * Buscador del header: el índice de todo el sitio (páginas, servicios, formularios, documentos, comunicados y
 * enlaces del menú) y las sugerencias "más buscadas". El navegador lo pide una vez por REST
 * (GET copam/v1/buscador) y filtra en el momento (src/js/modules/header.js). Cada resultado elegido suma un
 * clic anónimo (POST copam/v1/buscador/clic): solo la URL y un contador.
 */

const COPAM_THEME_BUSCADOR_CACHE  = 'copam_theme_buscador_indice';
const COPAM_THEME_BUSCADOR_CLICS  = 'copam_theme_buscador_clics';
const COPAM_THEME_BUSCADOR_MAX_SUGERENCIAS = 5;

/**
 * @return array<int, array{tipo: string, titulo: string, subtitulo: string, url: string, externo: bool, peso: string, claves: string}>
 */
function copam_theme_buscador_indice(): array
{
    $cache = get_transient(COPAM_THEME_BUSCADOR_CACHE);
    if (is_array($cache)) {
        return $cache;
    }

    $filas = [];
    $urls  = [];
    $sumar = static function (string $tipo, string $titulo, string $subtitulo, string $url, string $peso = '', string $claves = '') use (&$filas, &$urls): void {
        $titulo = trim(wp_strip_all_tags($titulo));
        if ($titulo === '' || $url === '' || isset($urls[$url])) {
            return;
        }
        $urls[$url] = true;
        $host       = (string) wp_parse_url($url, PHP_URL_HOST);
        $filas[]    = [
            'tipo'      => $tipo,
            'titulo'    => html_entity_decode($titulo, ENT_QUOTES, 'UTF-8'),
            'subtitulo' => html_entity_decode(trim(wp_strip_all_tags($subtitulo)), ENT_QUOTES, 'UTF-8'),
            'url'       => $url,
            'externo'   => $peso !== '' || ($host !== '' && $host !== wp_parse_url(home_url(), PHP_URL_HOST)),
            'peso'      => $peso,
            'claves'    => wp_trim_words(wp_strip_all_tags($claves), 30, ''),
        ];
    };

    $paginas  = get_pages(['post_status' => 'publish', 'sort_column' => 'menu_order,post_title']);
    $por_slug = [];
    foreach ($paginas as $p) {
        $por_slug[$p->post_name] = $p;
    }
    $portada   = (int) get_option('page_on_front');
    $servicios = $por_slug['servicios'] ?? null;
    $es_servicio = static fn(WP_Post $p): bool => ($servicios && ($p->ID === $servicios->ID || (int) $p->post_parent === $servicios->ID))
        || $p->post_name === 'deposito-temporal';

    // Formularios (son código: la lista vive aquí). [slug de la página, ancla, nombre].
    $formularios = [
        ['contacto', 'formulario', __('Formulario de contacto', 'copam-theme')],
        ['contacto', 'buzon', __('Buzón de sugerencias', 'copam-theme')],
        ['reclamos', 'formulario', __('Presentar un reclamo', 'copam-theme')],
        ['libro-de-reclamaciones', 'formulario', __('Libro de Reclamaciones', 'copam-theme')],
        ['canal-hostigamiento-sexual', 'reporte', __('Reporte de hostigamiento sexual', 'copam-theme')],
        ['transparencia', 'solicitud', __('Solicitud de acceso a la información', 'copam-theme')],
        ['deposito-temporal', 'quejas-y-reclamos', __('Quejas y reclamos del Depósito Temporal', 'copam-theme')],
    ];

    // 1. Servicios (sin "Servicios": no tiene diseño y redirige a su primera hija, inc/redirecciones.php).
    foreach ($paginas as $p) {
        if ($es_servicio($p) && get_page_template_slug($p) !== 'pages/template-servicios.php') {
            $sumar(__('Servicio', 'copam-theme'), get_the_title($p), copam_theme_buscador_bajada($p) ?: __('Servicios', 'copam-theme'), (string) get_permalink($p));
        }
    }

    // 2. Formularios.
    foreach ($formularios as [$slug, $ancla, $nombre]) {
        if (isset($por_slug[$slug])) {
            $sumar(__('Formulario', 'copam-theme'), $nombre, get_the_title($por_slug[$slug]), get_permalink($por_slug[$slug]) . '#' . $ancla);
        }
    }

    // 3. Páginas (las legales al final).
    $legales = ['privacidad', 'terminos', 'cookies'];
    $orden   = array_merge(
        array_filter($paginas, static fn(WP_Post $p): bool => !in_array($p->post_name, $legales, true)),
        array_filter($paginas, static fn(WP_Post $p): bool => in_array($p->post_name, $legales, true))
    );
    foreach ($orden as $p) {
        if ($p->ID === $portada || $es_servicio($p)) {
            continue;
        }
        $madre = $p->post_parent ? get_the_title($p->post_parent) : '';
        $sumar(__('Página', 'copam-theme'), get_the_title($p), copam_theme_buscador_bajada($p) ?: ($madre ?: 'COPAM'), (string) get_permalink($p));
    }

    // 4. Documentos: los archivos de los campos ACF de cada página.
    if (function_exists('get_fields')) {
        foreach ($paginas as $p) {
            $tipo = $p->post_name === 'normativa-ositran' ? __('Reglamento', 'copam-theme') : __('Documento', 'copam-theme');
            foreach (copam_theme_buscador_archivos((array) get_fields($p->ID)) as $doc) {
                $formato = strtoupper((string) ($doc['archivo']['subtype'] ?? ''));
                $peso    = trim($formato . ' · ' . size_format((int) ($doc['archivo']['filesize'] ?? 0)), ' ·');
                $detalle = implode(' · ', array_filter([$doc['detalle'], $peso, get_the_title($p)]));
                $sumar($tipo, $doc['titulo'] ?: (string) ($doc['archivo']['title'] ?? ''), $detalle, (string) $doc['archivo']['url'], $peso ?: __('Archivo', 'copam-theme'));
            }
        }
    }

    // 5. Comunicados.
    foreach (get_posts(['numberposts' => 50, 'ignore_sticky_posts' => true, 'no_found_rows' => true]) as $post) {
        $c = copam_theme_comunicado($post);
        $sumar(__('Comunicado', 'copam-theme'), $c['titulo'], implode(' · ', array_filter([$c['fecha'], $c['categoria']])), $c['url'], '', get_the_excerpt($post));
    }

    // 6. Enlaces del menú principal que no están arriba (anclas de secciones, sitios externos).
    $recorrer = static function (array $items, string $grupo) use (&$recorrer, $sumar): void {
        foreach ($items as $item) {
            $url = (string) $item['url'];
            if ($url !== '' && $url !== '#' && empty($item['subtitulo'])) {
                $sumar(__('Página', 'copam-theme'), (string) $item['texto'], $grupo, $url);
            }
            $recorrer((array) ($item['hijos'] ?? []), $grupo !== '' ? $grupo : (string) $item['texto']);
        }
    };
    foreach (copam_theme_sitio_menu('principal') as $raiz) {
        $recorrer((array) ($raiz['hijos'] ?? []), (string) $raiz['texto']);
    }

    set_transient(COPAM_THEME_BUSCADOR_CACHE, $filas, DAY_IN_SECONDS);

    return $filas;
}

// Bajada del primer grupo ACF de una página (su hero), para el subtítulo.
function copam_theme_buscador_bajada(WP_Post $p): string
{
    if (!function_exists('get_fields')) {
        return '';
    }
    foreach ((array) get_fields($p->ID) as $grupo) {
        if (is_array($grupo)) {
            foreach (['bajada', 'descripcion', 'subtitulo'] as $campo) {
                if (!empty($grupo[$campo]) && is_string($grupo[$campo])) {
                    return wp_trim_words(wp_strip_all_tags($grupo[$campo]), 14);
                }
            }
        }
        break;
    }
    return '';
}

/**
 * Filas de campos ACF que traen un archivo (`archivo` de tipo file), en cualquier nivel de grupos y repetidores.
 *
 * @return array<int, array{titulo: string, detalle: string, archivo: array}>
 */
function copam_theme_buscador_archivos(array $valores): array
{
    // Primero los niveles internos: si un mismo archivo está también en un hero, gana la fila del listado.
    $docs = [];
    foreach ($valores as $clave => $valor) {
        if ($clave !== 'archivo' && is_array($valor)) {
            array_push($docs, ...copam_theme_buscador_archivos($valor));
        }
    }
    if (isset($valores['archivo']) && is_array($valores['archivo']) && !empty($valores['archivo']['url'])) {
        $detalle = '';
        foreach (['detalle', 'subtitulo', 'fecha'] as $campo) {
            if (!empty($valores[$campo]) && is_string($valores[$campo])) {
                $detalle = trim($valores[$campo]);
                break;
            }
        }
        $docs[] = [
            'titulo'  => is_string($valores['titulo'] ?? null) ? $valores['titulo'] : '',
            'detalle' => $detalle,
            'archivo' => $valores['archivo'],
        ];
    }
    return $docs;
}

function copam_theme_buscador_limpiar(): void
{
    delete_transient(COPAM_THEME_BUSCADOR_CACHE);
}
add_action('save_post', 'copam_theme_buscador_limpiar');
add_action('deleted_post', 'copam_theme_buscador_limpiar');
add_action('wp_update_nav_menu', 'copam_theme_buscador_limpiar');
add_action('acf/save_post', 'copam_theme_buscador_limpiar');

// Sugerencias: los resultados más elegidos que siguen en el índice, completados con una selección por defecto.
function copam_theme_buscador_sugerencias(array $indice): array
{
    $urls  = array_column($indice, 'url');
    $clics = (array) get_option(COPAM_THEME_BUSCADOR_CLICS, []);
    arsort($clics);

    $elegidas = array_values(array_intersect(array_keys($clics), $urls));

    $por_defecto = [];
    $tarifario   = array_values(array_filter($indice, static fn(array $f): bool => $f['tipo'] === __('Documento', 'copam-theme') && stripos($f['titulo'], 'tarifario') !== false));
    if ($tarifario) {
        $por_defecto[] = $tarifario[0]['url'];
    }
    foreach (['tarifario', 'servicios-a-la-carga', 'contacto', 'libro-de-reclamaciones'] as $slug) {
        $p = get_page_by_path($slug) ?: get_page_by_path('servicios/' . $slug);
        if ($p && $p->post_status === 'publish') {
            $por_defecto[] = (string) get_permalink($p);
        }
    }
    $ultimo = get_posts(['numberposts' => 1, 'fields' => 'ids', 'no_found_rows' => true]);
    if ($ultimo) {
        $por_defecto[] = (string) get_permalink($ultimo[0]);
    }

    $lista = array_values(array_unique(array_merge($elegidas, array_intersect($por_defecto, $urls))));
    return array_slice($lista, 0, COPAM_THEME_BUSCADOR_MAX_SUGERENCIAS);
}

function copam_theme_buscador_rutas(): void
{
    register_rest_route('copam/v1', '/buscador', [
        'methods'             => 'GET',
        'permission_callback' => '__return_true',
        'callback'            => static function (): WP_REST_Response {
            $indice = copam_theme_buscador_indice();
            $clics  = (array) get_option(COPAM_THEME_BUSCADOR_CLICS, []);
            foreach ($indice as &$fila) {
                $fila['popularidad'] = (int) ($clics[$fila['url']] ?? 0);
            }
            unset($fila);

            return new WP_REST_Response(['indice' => $indice, 'sugerencias' => copam_theme_buscador_sugerencias($indice)]);
        },
    ]);

    register_rest_route('copam/v1', '/buscador/clic', [
        'methods'             => 'POST',
        'permission_callback' => '__return_true',
        'args'                => [
            'url' => ['type' => 'string', 'required' => true, 'sanitize_callback' => 'esc_url_raw'],
        ],
        'callback'            => static function (WP_REST_Request $request): WP_REST_Response {
            $url = (string) $request->get_param('url');
            if (!in_array($url, array_column(copam_theme_buscador_indice(), 'url'), true)) {
                return new WP_REST_Response(['ok' => false], 400);
            }

            // Un clic por persona y resultado cada 30 s (solo un hash de la IP, por 30 s).
            $ip    = (string) ($_SERVER['REMOTE_ADDR'] ?? '');
            $freno = 'copam_theme_bclic_' . md5($ip . '|' . $url);
            if (get_transient($freno)) {
                return new WP_REST_Response(['ok' => true, 'contado' => false]);
            }
            set_transient($freno, 1, 30);

            $clics       = (array) get_option(COPAM_THEME_BUSCADOR_CLICS, []);
            $clics[$url] = (int) ($clics[$url] ?? 0) + 1;
            arsort($clics);
            update_option(COPAM_THEME_BUSCADOR_CLICS, array_slice($clics, 0, 100, true), false);

            return new WP_REST_Response(['ok' => true, 'contado' => true]);
        },
    ]);
}
add_action('rest_api_init', 'copam_theme_buscador_rutas');
