<?php
defined('ABSPATH') || exit;

/**
 * Términos y condiciones · contenido: el texto completo en un solo campo WYSIWYG; cada h2 recibe el id
 * que usa el índice lateral. Lee el grupo `terminos_contenido` (ACF); el contenido inicial está en
 * inc/acf/seed/terminos.php.
 */
$contenido = get_field('terminos_contenido') ?: [];
$legal     = copam_theme_texto_legal($contenido['texto'] ?? '', true);
if ($legal['html'] === '') {
    return;
}
?>
<div class="texto-legal min-w-0 max-w-[900px]">
    <?= $legal['html'] // phpcs:ignore WordPress.Security.EscapeOutput -- pasó por wp_kses_post en copam_theme_texto_legal ?>
</div>
