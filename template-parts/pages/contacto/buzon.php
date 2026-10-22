<?php
defined('ABSPATH') || exit;

/**
 * Contacto · buzón de sugerencias: a la izquierda el texto, las condiciones y el aviso que deriva a reclamos;
 * a la derecha el form de wp-form (template-parts/forms/buzon-sugerencias.php). Dos columnas desde 1000 px.
 * Lee el grupo `contacto_buzon` (ACF); el mensaje de éxito (`exito`) lo usa la definición del form.
 */
$grupo  = get_field('contacto_buzon') ?: [];
$puntos = array_values(array_filter((array) ($grupo['puntos'] ?? []), static fn($p): bool => trim((string) ($p['texto'] ?? '')) !== ''));
$sub    = (string) ($grupo['subtitulo'] ?? '');
$bajada = (string) ($grupo['bajada'] ?? '');
$aviso_titulo = (string) ($grupo['aviso_titulo'] ?? '');
$aviso_texto  = (string) ($grupo['aviso_texto'] ?? '');
$aviso_enlace = $grupo['aviso_enlace'] ?? null;
$hay_aviso    = $aviso_titulo !== '' || $aviso_texto !== '' || copam_theme_link_data($aviso_enlace);
?>
<section class="relative z-[1] bg-white px-[clamp(20px,4.17vw,80px)] pt-[clamp(72px,6vw,116px)] pb-[clamp(48px,4vw,76px)]" id="buzon">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>

    <div class="mt-[clamp(28px,2.4vw,46px)] grid grid-cols-[minmax(0,1fr)] items-start gap-x-[clamp(32px,3.6vw,72px)] gap-y-9 min-[1000px]:grid-cols-[minmax(0,.9fr)_minmax(0,1.6fr)]">
        <div class="flex min-w-0 flex-col items-start pt-[clamp(0px,.6vw,12px)]">
            <?php if ($sub !== '') : ?>
                <h3 class="m-0 overflow-hidden pb-[.06em]"><span class="block text-[clamp(17px,1.05vw,20px)] leading-[1.3] font-semibold text-ink" data-sr="rise" data-sr-delay="80"><?= esc_html($sub) ?></span></h3>
            <?php endif; ?>
            <?php if ($bajada !== '') : ?>
                <p class="mt-[clamp(14px,1.1vw,20px)] mb-0 max-w-[520px] text-[clamp(16px,.95vw,18px)] leading-[1.6] text-pretty text-gris-7a" data-sr="clip" data-sr-delay="160"><?= esc_html($bajada) ?></p>
            <?php endif; ?>
            <?php if ($puntos) : ?>
                <ul class="mt-[clamp(28px,2.2vw,42px)] mb-0 flex list-none flex-col gap-3 p-0">
                    <?php foreach ($puntos as $i => $punto) : ?>
                        <li class="flex items-baseline gap-3 text-[15px] leading-normal text-ink" data-sr="clip" data-sr-delay="<?= esc_attr((string) (220 + $i * 60)) ?>"><span class="block size-[5px] flex-none -translate-y-[3px] rounded-full bg-brand" aria-hidden="true"></span><span><?= esc_html((string) $punto['texto']) ?></span></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <?php if ($hay_aviso) : ?>
                <div class="mt-[clamp(32px,2.6vw,50px)] self-stretch rounded-md bg-[#F8F8F8] px-[clamp(18px,1.4vw,26px)] py-[clamp(20px,1.5vw,28px)]" data-sr="card" data-sr-delay="380">
                    <?php if ($aviso_titulo !== '') : ?>
                        <p class="m-0 text-[15px] font-semibold text-ink"><?= esc_html($aviso_titulo) ?></p>
                    <?php endif; ?>
                    <?php if ($aviso_texto !== '') : ?>
                        <p class="mt-2.5 mb-0 text-sm leading-[1.6] text-pretty text-gris-7a"><?= esc_html($aviso_texto) ?></p>
                    <?php endif; ?>
                    <?php if (copam_theme_link_data($aviso_enlace)) : ?>
                        <a<?= copam_theme_link_attrs($aviso_enlace, ['class' => 'group mt-3 flex w-max items-center gap-1.5 text-[15px] font-medium text-brand transition-colors duration-[250ms] hover:text-brand-hover']) ?>>
                            <?= esc_html((string) ($aviso_enlace['title'] ?? '')) ?>
                            <svg class="block flex-none transition-transform duration-[450ms] ease-out group-hover:translate-x-1" width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true"><path d="M1 6h9.5M6.5 2l4 4-4 4" stroke="currentColor" stroke-width="1.5"></path></svg>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php get_template_part('template-parts/forms/buzon-sugerencias'); ?>
    </div>
</section>
