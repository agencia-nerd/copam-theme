<?php
defined('ABSPATH') || exit;

/**
 * Política de cookies · contenido: el texto completo en un solo campo WYSIWYG, en una columna de lectura.
 * Lee el grupo `cookies_contenido` (ACF); el contenido inicial está en inc/acf/seed/cookies.php.
 */
$contenido = get_field('cookies_contenido') ?: [];
$legal     = copam_theme_texto_legal($contenido['texto'] ?? '');
if ($legal['html'] === '') {
    return;
}
?>
<section class="relative z-[1] bg-white px-[clamp(20px,4.17vw,80px)] pb-[clamp(88px,7.3vw,140px)]">
    <div class="texto-legal max-w-[900px]">
        <?= $legal['html'] // phpcs:ignore WordPress.Security.EscapeOutput -- pasó por wp_kses_post en copam_theme_texto_legal ?>
    </div>
</section>
