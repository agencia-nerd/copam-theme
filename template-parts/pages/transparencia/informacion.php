<?php
defined('ABSPATH') || exit;

/**
 * Transparencia · información publicada: filas clicables (título a la izquierda, enlace con flecha a la derecha)
 * dentro del marco de líneas de la página, separadas por líneas finas. En móvil título y enlace se apilan.
 * Lee el grupo `transparencia_informacion` (ACF).
 */
$grupo = get_field('transparencia_informacion') ?: [];
$filas = array_values(array_filter((array) ($grupo['filas'] ?? []), static fn($f): bool => is_array($f) && copam_theme_link_data($f['enlace'] ?? null) !== null));
$flecha = '<svg class="absolute inset-0 transition-transform duration-[550ms] ease-in-out %s" width="12" height="12" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.6"></path></svg>';
?>
<section class="relative z-[1] bg-white pt-[clamp(40px,3.6vw,68px)] pb-[clamp(88px,7.3vw,140px)]" id="info">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    </div>
    <?php if ($filas) : ?>
        <div class="relative mt-[clamp(26px,2.1vw,40px)]">
            <span class="absolute inset-x-0 top-0 z-[3] h-px bg-line" data-sr="lineX" aria-hidden="true"></span>
            <span class="absolute inset-x-0 bottom-0 z-[3] h-px bg-line" data-sr="lineX" data-sr-delay="200" aria-hidden="true"></span>
            <div class="relative mx-[clamp(20px,4.17vw,80px)]">
                <span class="absolute inset-y-0 left-0 z-[2] w-px bg-line" data-sr="lineY" data-sr-delay="120" aria-hidden="true"></span>
                <span class="absolute inset-y-0 right-0 z-[2] w-px bg-line" data-sr="lineY" data-sr-delay="120" aria-hidden="true"></span>
                <?php foreach ($filas as $i => $fila) :
                    $enlace = $fila['enlace'];
                    $blank  = copam_theme_link_resolve(copam_theme_link_data($enlace), [])['blank'];
                    ?>
                    <a<?= copam_theme_link_attrs($enlace, ['class' => 'group relative flex flex-col items-start gap-x-6 gap-y-2 px-[clamp(20px,2.1vw,40px)] py-[clamp(18px,1.4vw,26px)] text-ink md:flex-row md:flex-wrap md:items-center md:justify-between']) ?>>
                        <?php if ($i > 0) : ?>
                            <span class="absolute inset-x-0 top-0 h-px bg-line" data-sr="lineX" aria-hidden="true"></span>
                        <?php endif; ?>
                        <span class="block min-w-0 overflow-hidden">
                            <span class="block text-[clamp(16px,.95vw,18px)] leading-[1.4] font-medium" data-sr="rise" data-sr-delay="<?= esc_attr((string) ($i * 60)) ?>"><?= esc_html((string) ($fila['titulo'] ?? '')) ?></span>
                        </span>
                        <span class="block overflow-hidden text-gris-7a transition-colors duration-300 group-hover:text-brand group-focus-visible:text-brand">
                            <span class="flex items-center gap-2 text-[clamp(14px,.85vw,16px)]" data-sr="rise" data-sr-delay="<?= esc_attr((string) ($i * 60 + 60)) ?>">
                                <?= esc_html((string) ($fila['texto_enlace'] ?? '')) ?>
                                <span class="relative block size-3 flex-none overflow-hidden" aria-hidden="true">
                                    <?php
                                    printf($flecha, 'group-hover:translate-x-[130%] group-focus-visible:translate-x-[130%]');
                                    printf($flecha, '-translate-x-[130%] group-hover:translate-x-0 group-focus-visible:translate-x-0');
                                    ?>
                                </span>
                            </span>
                        </span>
                        <?php if ($blank) : ?><span class="sr-only">(<?= esc_html__('se abre en una pestaña nueva', 'copam-theme') ?>)</span><?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
