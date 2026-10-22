<?php
defined('ABSPATH') || exit;

/*
 * Cuerpo de las páginas legales (privacidad, términos, cookies): el HTML de un campo WYSIWYG listo para
 * imprimirse dentro de `.texto-legal` (estilos en src/css/input.css).
 *
 *   $legal = copam_theme_texto_legal($grupo['texto'] ?? '', true);
 *   <?= $legal['html'] ?>                       ya pasó por wp_kses_post
 *   $legal['indice']                            [['texto' => ..., 'ancla' => ...]] para indice-lateral
 *
 * Cada h2 lleva encima la línea del diseño y su texto sube al entrar (reveal.js); párrafos y listas se revelan.
 * Con $anclas, cada h2 recibe un id a partir de su texto sin el número ("1. Uso del sitio" → "uso-del-sitio").
 * Los enlaces que abren pestaña nueva salen con rel="noopener noreferrer".
 */
function copam_theme_texto_legal($html, bool $anclas = false): array
{
    $html = trim(wp_kses_post((string) $html));
    if ($html === '') {
        return ['html' => '', 'indice' => []];
    }

    $indice = [];
    if ($anclas && preg_match_all('#<h2\b[^>]*>(.*?)</h2>#is', $html, $titulos)) {
        $usadas = [];
        foreach ($titulos[1] as $interior) {
            $texto = trim(html_entity_decode(wp_strip_all_tags($interior), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
            $base  = sanitize_title((string) preg_replace('/^\d+\s*[.)-]?\s*/u', '', $texto)) ?: 'seccion';
            $ancla = $base;
            for ($n = 2; isset($usadas[$ancla]); $n++) {
                $ancla = $base . '-' . $n;
            }
            $usadas[$ancla] = true;
            $indice[]       = ['texto' => $texto, 'ancla' => $ancla];
        }
    }

    $etiquetas = new WP_HTML_Tag_Processor($html);
    $h2        = 0;
    while ($etiquetas->next_tag()) {
        switch ($etiquetas->get_tag()) {
            case 'H2':
                if (isset($indice[$h2])) {
                    $etiquetas->set_attribute('id', $indice[$h2]['ancla']);
                }
                $h2++;
                break;
            case 'P':
            case 'UL':
            case 'OL':
                $etiquetas->set_attribute('data-sr', 'clip');
                $etiquetas->set_attribute('data-sr-delay', '140');
                break;
            case 'A':
                if ($etiquetas->get_attribute('target') === '_blank') {
                    $rel = preg_split('/\s+/', strtolower((string) $etiquetas->get_attribute('rel')), -1, PREG_SPLIT_NO_EMPTY);
                    $etiquetas->set_attribute('rel', implode(' ', array_unique(array_merge($rel, ['noopener', 'noreferrer']))));
                }
                break;
        }
    }

    $html = (string) preg_replace(
        '#<h2\b([^>]*)>(.*?)</h2>#is',
        '<span class="texto-legal-linea" data-sr="lineX" aria-hidden="true"></span><h2$1><span class="block" data-sr="rise" data-sr-delay="60">$2</span></h2>',
        $etiquetas->get_updated_html()
    );

    return ['html' => $html, 'indice' => $indice];
}
