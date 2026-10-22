<?php
defined('ABSPATH') || exit;

/**
 * Canal de hostigamiento sexual · política y procedimiento: bajada y la tarjeta del documento vigente con su
 * botón de descarga (pestaña nueva). Sin archivo, la tarjeta no muestra el botón.
 * Lee el grupo `canal_hostigamiento_sexual_politica` (ACF).
 */
$grupo   = get_field('canal_hostigamiento_sexual_politica') ?: [];
$bajada  = (string) ($grupo['bajada'] ?? '');
$titulo  = (string) ($grupo['documento_titulo'] ?? '');
$detalle = (string) ($grupo['documento_detalle'] ?? '');
$estado  = (string) ($grupo['documento_estado'] ?? '');
$texto   = (string) ($grupo['documento_boton_texto'] ?? '');
$archivo = $grupo['documento_archivo'] ?? null;
$enlace  = is_array($archivo) && !empty($archivo['url']) ? ['url' => (string) $archivo['url'], 'target' => '_blank', 'title' => $texto] : null;
$peso    = is_array($archivo) && !empty($archivo['filesize']) ? 'PDF · ' . size_format((int) $archivo['filesize'], 0) : '';
?>
<section class="relative z-[1] bg-white px-[clamp(20px,4.17vw,80px)] pt-[clamp(56px,5vw,96px)]" id="politica">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <?php if ($bajada !== '') : ?>
        <p class="mt-[clamp(16px,1.3vw,24px)] mb-0 max-w-[720px] text-[15px] leading-[1.6] text-pretty text-ink-muted" data-sr="clip" data-sr-delay="200"><?= esc_html($bajada) ?></p>
    <?php endif; ?>
    <?php if ($titulo !== '') : ?>
        <div class="mt-[clamp(20px,1.6vw,30px)] flex flex-wrap items-center justify-between gap-x-6 gap-y-4 rounded bg-[#F8F8F8] px-[clamp(20px,2.1vw,40px)] py-[clamp(18px,1.4vw,26px)]" data-sr="clip" data-sr-delay="260">
            <div class="flex min-w-0 flex-wrap items-center gap-x-[18px] gap-y-2.5">
                <div class="flex min-w-0 flex-col gap-1.5">
                    <h3 class="m-0 text-[clamp(16px,.95vw,18px)] leading-[1.35] font-medium text-ink"><?= esc_html($titulo) ?></h3>
                    <?php if ($detalle !== '') : ?>
                        <span class="text-sm text-gris-7a"><?= esc_html($detalle) ?></span>
                    <?php endif; ?>
                </div>
                <?php if ($estado !== '') : ?>
                    <span class="block rounded-[3px] bg-warning px-2.5 py-1.5 text-xs leading-[1.2] font-semibold tracking-[.14em] text-ink uppercase"><?= esc_html($estado) ?></span>
                <?php endif; ?>
            </div>
            <?php if ($enlace && $texto !== '') : ?>
                <a<?= copam_theme_link_attrs($enlace, ['class' => 'flex h-[46px] flex-none items-center rounded-[3px] bg-brand px-5 text-base font-medium text-white transition-colors duration-300 hover:bg-brand-hover hover:text-white']) ?><?= $peso !== '' ? ' title="' . esc_attr($peso) . '"' : '' ?>>
                    <?= esc_html($texto) ?><span class="sr-only"> (<?= esc_html__('se abre en una pestaña nueva', 'copam-theme') ?>)</span>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>
