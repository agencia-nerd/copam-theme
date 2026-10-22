<?php
defined('ABSPATH') || exit;

/**
 * Servicios especiales · tarifas y precios: texto, botón para descargar el tarifario vigente y enlace a las
 * versiones anteriores. Sin tabla de montos.
 * Lee el grupo `servicios_especiales_tarifas` (ACF).
 */
$grupo     = get_field('servicios_especiales_tarifas') ?: [];
$texto     = (string) ($grupo['texto'] ?? '');
$archivo   = $grupo['archivo'] ?? null;
$descarga  = is_array($archivo) && !empty($archivo['url']) ? ['url' => (string) $archivo['url'], 'target' => '_blank'] : null;
$peso      = is_array($archivo) && !empty($archivo['filesize']) ? 'PDF · ' . size_format((int) $archivo['filesize'], 0) : '';
$versiones = $grupo['versiones'] ?? null;
$ver_data  = copam_theme_link_data($versiones);
?>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="tarifas">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
        <?php if ($texto !== '') : ?>
            <p class="mt-[clamp(26px,2.1vw,40px)] mb-0 max-w-[1100px] text-[15px] leading-[1.6] text-pretty text-gris-5a" data-sr="clip" data-sr-delay="200"><?= esc_html($texto) ?></p>
        <?php endif; ?>
        <div class="mt-[clamp(24px,2.1vw,40px)] flex flex-wrap items-center gap-x-7 gap-y-4">
            <?php if ($descarga) : ?>
                <div class="overflow-hidden rounded">
                    <?php get_template_part('template-parts/components/boton', null, [
                        'texto'  => (string) ($grupo['boton_texto'] ?? ''),
                        'enlace' => $descarga,
                        'titulo' => $peso,
                        'datos'  => ['sr' => 'rise', 'sr-delay' => '300'],
                    ]); ?>
                </div>
            <?php endif; ?>
            <?php if ($ver_data && trim((string) ($ver_data['title'] ?? '')) !== '') : ?>
                <div class="overflow-hidden">
                    <a<?= copam_theme_link_attrs($versiones, ['class' => 'group flex items-center gap-2 text-[clamp(15px,.9vw,17px)] font-medium text-brand transition-colors duration-[250ms] hover:text-brand-hover']) ?> data-sr="rise" data-sr-delay="380">
                        <span><?= esc_html((string) $ver_data['title']) ?></span>
                        <span class="relative block size-3.5 overflow-hidden" aria-hidden="true">
                            <svg class="absolute inset-0 transition-transform duration-[550ms] ease-in-out group-hover:translate-x-[120%] group-focus-visible:translate-x-[120%]" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.6"></path></svg>
                            <svg class="absolute inset-0 -translate-x-[120%] transition-transform duration-[550ms] ease-in-out group-hover:translate-x-0 group-focus-visible:translate-x-0" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.6"></path></svg>
                        </span>
                        <?php if (copam_theme_link_resolve($ver_data, [])['blank']) : ?><span class="sr-only">(<?= esc_html__('se abre en una pestaña nueva', 'copam-theme') ?>)</span><?php endif; ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
