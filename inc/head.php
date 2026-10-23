<?php
defined('ABSPATH') || exit;

/**
 * Marca la página con la clase `js` antes de pintar, salvo que se pida reducir el movimiento. En la primera
 * visita de la sesión agrega además `precarga`, que muestra la pantalla de carga con el logo (precarga.js la quita).
 * Los estados iniciales de las animaciones (src/css/input.css) solo valen con esa clase: sin JS
 * o con movimiento reducido, todo el contenido se ve completo y quieto.
 * Red de seguridad: si a los COPAM_THEME_JS_ESPERA_MS main.js no marcó `js-listo` (no cargó o falló antes de
 * empezar), se quitan `js` y `precarga` para que el contenido no quede oculto por los estados iniciales.
 */
const COPAM_THEME_JS_ESPERA_MS = 4000;

function copam_theme_head_js_class()
{
    echo "<script>(function(d){if(!window.matchMedia||!window.matchMedia('(prefers-reduced-motion: reduce)').matches){d.classList.add('js');setTimeout(function(){if(!d.classList.contains('js-listo')){d.classList.remove('js','precarga');d.style.overflow='';}}," . (int) COPAM_THEME_JS_ESPERA_MS . ");try{if(!sessionStorage.getItem('copam-pre')){d.classList.add('precarga');setTimeout(function(){d.classList.remove('precarga');d.style.overflow='';},12000);}}catch(e){}}})(document.documentElement);</script>
";
}
add_action('wp_head', 'copam_theme_head_js_class', 1);

// Funnel Display, la tipografía del diseño (Google Fonts, como en la maqueta).
const COPAM_THEME_FONTS_URL = 'https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&display=swap';

function copam_theme_enqueue_fonts()
{
    wp_enqueue_style('copam-theme-fonts', COPAM_THEME_FONTS_URL, [], null);
}
add_action('wp_enqueue_scripts', 'copam_theme_enqueue_fonts', 5);

function copam_theme_font_resource_hints($urls, $relation_type)
{
    if ($relation_type === 'preconnect') {
        $urls[] = 'https://fonts.googleapis.com';
        $urls[] = ['href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous'];
    }

    return $urls;
}
add_filter('wp_resource_hints', 'copam_theme_font_resource_hints', 10, 2);
