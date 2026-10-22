<?php
defined('ABSPATH') || exit;

/**
 * Comunicado · cuerpo: el contenido de la entrada, "Volver a comunicados" y "Copiar enlace"
 * (src/js/modules/copiar-enlace.js). Sin campos ACF: todo el texto está en el editor de la entrada.
 */
$contenido = (string) apply_filters('the_content', get_the_content());

// Cada bloque del contenido entra con el recorte del diseño (reveal.js).
$etiquetas = new WP_HTML_Tag_Processor($contenido);
while ($etiquetas->next_tag()) {
    if (in_array($etiquetas->get_tag(), ['P', 'UL', 'OL', 'H2', 'H3', 'FIGURE'], true)) {
        $etiquetas->set_attribute('data-sr', 'clip');
    }
}
$contenido = $etiquetas->get_updated_html();

$flecha = '<path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.6"></path>';
?>
<div class="px-[clamp(20px,4.17vw,80px)] text-center">
<div class="mx-auto max-w-[950px]">
    <?php if (trim($contenido) !== '') : ?>
        <div class="texto-comunicado mt-[clamp(36px,3.1vw,60px)]">
            <?= $contenido // phpcs:ignore WordPress.Security.EscapeOutput -- the_content ya filtrado por WordPress. ?>
        </div>
    <?php endif; ?>
    <span class="mt-[clamp(36px,3.1vw,60px)] block h-px origin-center bg-[#E1E1E1]" data-sr="lineX" data-sr-delay="200" aria-hidden="true"></span>

    <div class="mt-[clamp(20px,1.6vw,30px)] flex flex-wrap items-center justify-between gap-4">
        <div class="overflow-hidden">
            <a class="group flex items-center gap-2.5 text-[clamp(15px,.9vw,17px)] font-medium text-ink transition-colors duration-300 hover:text-brand" href="<?= esc_url(copam_theme_comunicados_url()) ?>" data-sr="rise">
                <span class="block rotate-180" aria-hidden="true">
                    <span class="relative block size-3.5 flex-none overflow-hidden">
                        <svg class="absolute inset-0 transition-transform duration-[550ms] ease-in-out group-hover:translate-x-[130%]" width="14" height="14" viewBox="0 0 14 14" fill="none"><?= $flecha // phpcs:ignore -- SVG fijo. ?></svg>
                        <svg class="absolute inset-0 -translate-x-[130%] transition-transform duration-[550ms] ease-in-out group-hover:translate-x-0" width="14" height="14" viewBox="0 0 14 14" fill="none"><?= $flecha // phpcs:ignore -- SVG fijo. ?></svg>
                    </span>
                </span>
                <span><?= esc_html__('Volver a comunicados', 'copam-theme') ?></span>
            </a>
        </div>
        <div class="overflow-hidden rounded-[3px]">
            <button class="block h-12 cursor-pointer rounded-[3px] border border-[#DADADA] bg-white px-6 text-[15px] font-medium text-ink transition-colors duration-300 hover:border-ink" type="button" data-sr="rise" data-sr-delay="80" data-copiar-enlace data-copiado="<?= esc_attr__('Enlace copiado', 'copam-theme') ?>"><?= esc_html__('Copiar enlace', 'copam-theme') ?></button>
        </div>
        <span class="sr-only" aria-live="polite" data-copiar-estado></span>
    </div>
</div>
</div>
