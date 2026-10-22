<?php
defined('ABSPATH') || exit;

/**
 * Contenido que se repite en todo el sitio (spec `opciones`): menús de WordPress leídos para la cabecera y el pie,
 * e índice del buscador. Los menús se editan en Apariencia > Menús (ubicaciones `principal`, `pie` y `legal`).
 */

/** URL absoluta de un destino: las rutas del sitio (nosotros/) cuelgan de home_url(). */
function copam_theme_sitio_url(string $destino): string
{
    if (preg_match('#^https?://#', $destino)) {
        return $destino;
    }
    if (str_starts_with($destino, 'assets/')) {
        return copam_theme_sitio_medio($destino);
    }
    return home_url('/' . ltrim($destino, '/'));
}

/** Un archivo del tema ya cargado a Medios (por el contenido inicial) sale de Medios; si no, del tema. */
function copam_theme_sitio_medio(string $relativo): string
{
    $id = get_posts([
        'post_type'      => 'attachment',
        'post_status'    => 'inherit',
        'posts_per_page' => 1,
        'fields'         => 'ids',
        'meta_key'       => '_copam_theme_seed_file',
        'meta_value'     => $relativo,
    ]);
    $url = $id ? wp_get_attachment_url((int) $id[0]) : '';
    return $url ?: get_theme_file_uri($relativo);
}

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

/**
 * Índice del buscador del header: [tipo, título, subtítulo, destino, peso (opcional)].
 * Se decide después de qué fuente busca de verdad; mientras tanto filtra este listado.
 *
 * @return array<int, array{tipo: string, titulo: string, subtitulo: string, url: string, externo: bool, peso: string}>
 */
function copam_theme_sitio_indice_busqueda(): array
{
    $filas = [
        ['Documento', 'Tarifario de Servicios Portuarios · vigente desde el 16-06-2026', 'PDF · 410 KB · Zona clientes', 'assets/docs/tarifario-2026-06-16.pdf', 'PDF · 410 KB'],
        ['Página', 'Plan Maestro APN 2025', 'Desarrollo futuro del terminal', '#desarrollo-futuro', ''],
        ['Documento', 'Procedimiento de atención de reclamos', 'PDF · 2.9 MB · Atención', 'assets/docs/guia-procedimiento-reclamos.pdf', 'PDF · 2.9 MB'],
        ['Página', 'Requisitos del Depósito Temporal', 'Documentos del depósito temporal', 'deposito-temporal/#documentos', ''],
        ['Documento', 'Autorización SUNAT del Depósito Temporal', 'Resolución de División N.° 000 324200/2025-000167', 'deposito-temporal/#documentos', ''],
        ['Documento', 'Procedimientos del Depósito Temporal', 'Ingreso y salida de carga de importación y exportación', 'deposito-temporal/#documentos', ''],
        ['Documento', 'Formato de petición de servicios', 'Lista de camiones, cargo plan y manifiesto de carga', 'deposito-temporal/#documentos', ''],
        ['Página', 'Quejas y reclamos del Depósito Temporal', 'Formulario conforme al Libro de Reclamaciones (INDECOPI)', 'deposito-temporal/#quejas-y-reclamos', ''],
        ['Reglamento', 'Reglamento de Operaciones', 'Normas operativas del terminal', 'assets/docs/reop-2026.pdf', 'PDF · 2.6 MB'],
        ['Reglamento', 'Reglamento de Tarifas y Precios de COPAM', 'Versión 5.3 · junio 2026', 'assets/docs/reta-v5-3.pdf', 'PDF · 650 KB'],
        ['Reglamento', 'Reglamento General de Tarifas del OSITRAN (RETA)', 'Res. N.° 003-2021-CD-OSITRAN', 'https://www.ositran.gob.pe/anterior/wp-content/uploads/2025/08/reglamento-general-de-tarifas-del-ositran-spij-4-agosto-2025.pdf', ''],
        ['Reglamento', 'Contrato de concesión', 'Cumplimiento de la concesión', 'normativa-ositran/#contrato', ''],
        ['Servicio', 'Servicios a la nave', 'Amarre, desamarre y uso de amarradero', 'servicios-a-la-nave/', ''],
        ['Servicio', 'Servicios a la carga', 'Embarque, descarga, transferencia y almacenamiento', 'servicios-a-la-carga/', ''],
        ['Servicio', 'Servicios especiales', 'Carga de proyecto y sobredimensionada', 'servicios-especiales/', ''],
        ['Servicio', 'Depósito temporal', 'Mercancía bajo control aduanero de SUNAT', 'deposito-temporal/', ''],
        ['Servicio', 'Servicios al pasajero', 'Embarque y desembarque fluvial', 'servicios-al-pasajero/', ''],
        ['Comunicado', 'Atención restringida en ventanilla por feriados', '18 jul 2026 · Operativo', 'comunicados/', ''],
        ['Comunicado', 'Publicación del tarifario vigente 2026', '02 jul 2026 · Noticias', 'comunicados/', ''],
        ['Página', 'Seguimiento de carga', 'Consulta el estado de tu carga', 'http://45.232.151.188:8081/consultacarga/', ''],
        ['Página', 'Contacto', 'Oficinas y canales de atención', 'contacto/', ''],
        ['Página', 'Sistema Integrado de Gestión', 'ISO 9001, ISO 14001 e ISO 45001', 'sistema-integrado-de-gestion/', ''],
        ['Página', 'Libro de Reclamaciones', 'Reclamos de consumo (Indecopi)', 'libro-de-reclamaciones/', ''],
        ['Página', 'Canal de hostigamiento sexual', 'Reporte confidencial al Delegado', 'canal-hostigamiento-sexual/', ''],
        ['Documento', 'Política de prevención del hostigamiento sexual', 'Procedimiento de COPAM', 'assets/docs/politica-hostigamiento-sexual.pdf', 'PDF · 20 KB'],
        ['Página', 'Resoluciones tarifarias', 'Fijación de tarifas y reajustes anuales del OSITRAN', 'normativa-ositran/?grupo=resoluciones#normativa', ''],
    ];

    return array_map(static function (array $f): array {
        $url = $f[3][0] === '#' ? home_url('/' . $f[3]) : copam_theme_sitio_url($f[3]);
        return [
            'tipo'     => $f[0],
            'titulo'   => $f[1],
            'subtitulo' => $f[2],
            'url'      => $url,
            'externo'  => (bool) preg_match('#^https?://#', $f[3]) || str_ends_with($f[3], '.pdf'),
            'peso'     => $f[4],
        ];
    }, $filas);
}
