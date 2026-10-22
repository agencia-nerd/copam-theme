<?php
defined('ABSPATH') || exit;

function copam_theme_setup()
{
    load_theme_textdomain('copam-theme', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);

    // Las ubicaciones de menú (principal, pie y legal) y el logo personalizado los declara inc/acf/runner.php
    // desde inc/acf/sitio.php.
}
add_action('after_setup_theme', 'copam_theme_setup');
