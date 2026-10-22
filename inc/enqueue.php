<?php
defined('ABSPATH') || exit;

// Fallback si el archivo `hot` está vacío.
const COPAM_THEME_VITE_DEV_SERVER = 'http://localhost:5173';
const COPAM_THEME_CSS_ENTRY = 'src/css/input.css';
const COPAM_THEME_JS_ENTRY = 'src/js/main.js';

function copam_theme_hot_path()
{
    return get_template_directory() . '/hot';
}

function copam_theme_manifest_path()
{
    return get_template_directory() . '/dist/manifest.json';
}

// Dev = entorno local + archivo `hot` (lo crea `pnpm dev`). Si no, producción.
// El chequeo de entorno evita servir assets de Vite si `hot` llega por error al servidor.
function copam_theme_is_vite_dev()
{
    return in_array(wp_get_environment_type(), ['local', 'development'], true)
        && file_exists(copam_theme_hot_path());
}

function copam_theme_vite_dev_server()
{
    $url = trim((string) @file_get_contents(copam_theme_hot_path()));

    return $url !== '' ? untrailingslashit($url) : COPAM_THEME_VITE_DEV_SERVER;
}

function copam_theme_log($message)
{
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('[copam-theme] ' . $message);
    }
}

// Devuelve el manifest como array, o null si falta o es inválido.
function copam_theme_get_manifest()
{
    $path = copam_theme_manifest_path();

    if (!file_exists($path)) {
        copam_theme_log('dist/manifest.json no existe. Ejecuta `pnpm build`.');
        return null;
    }

    $manifest = wp_json_file_decode($path, ['associative' => true]);

    if (!is_array($manifest)) {
        copam_theme_log('dist/manifest.json es inválido.');
        return null;
    }

    return $manifest;
}

function copam_theme_enqueue_assets()
{
    if (copam_theme_is_vite_dev()) {
        // DESARROLLO - HMR
        $server = copam_theme_vite_dev_server();
        wp_enqueue_script('vite-client', $server . '/@vite/client', [], null);
        wp_enqueue_script('copam-theme-js', $server . '/' . COPAM_THEME_JS_ENTRY, [], null, true);
        wp_enqueue_style('copam-theme-css', $server . '/' . COPAM_THEME_CSS_ENTRY, [], null);
        return;
    }

    // PRODUCCIÓN
    $manifest = copam_theme_get_manifest();
    if ($manifest === null) {
        return;
    }

    $dist_uri = get_template_directory_uri() . '/dist/';

    if (isset($manifest[COPAM_THEME_CSS_ENTRY]['file'])) {
        wp_enqueue_style('copam-theme-css', $dist_uri . $manifest[COPAM_THEME_CSS_ENTRY]['file'], [], null);
    }

    if (isset($manifest[COPAM_THEME_JS_ENTRY]['file'])) {
        wp_enqueue_script('copam-theme-js', $dist_uri . $manifest[COPAM_THEME_JS_ENTRY]['file'], [], null, true);
    }
}
add_action('wp_enqueue_scripts', 'copam_theme_enqueue_assets');

// Vite emite ES modules: type="module" en dev y producción.
function copam_theme_add_module_type($tag, $handle)
{
    if ($handle !== 'vite-client' && $handle !== 'copam-theme-js') {
        return $tag;
    }

    // Solo <script src>, y solo si aún no tiene type.
    return preg_replace('/<script(?=\s[^>]*\ssrc=)(?![^>]*\stype=)/', '<script type="module"', $tag);
}
add_filter('script_loader_tag', 'copam_theme_add_module_type', 10, 2);
