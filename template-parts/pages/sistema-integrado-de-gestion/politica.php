<?php
defined('ABSPATH') || exit;

/**
 * Sistema Integrado de Gestión · política del SIG: introducción, cuatro tarjetas de compromisos y descarga del PDF.
 * Lee el grupo `sistema_integrado_de_gestion_politica` (ACF).
 */
$grupo      = get_field('sistema_integrado_de_gestion_politica') ?: [];
$bloques    = array_values(array_filter((array) ($grupo['bloques'] ?? []), static fn($bloque): bool => trim((string) ($bloque['titulo'] ?? '')) !== ''));
$aprobacion = (string) ($grupo['aprobacion'] ?? '');
$boton      = (string) ($grupo['boton_texto'] ?? '');
$archivo    = $grupo['archivo'] ?? null;
$peso       = is_array($archivo) && !empty($archivo['filesize']) ? ' · ' . size_format((int) $archivo['filesize'], 0) : '';
$enlace_pdf = is_array($archivo) && !empty($archivo['url']) ? ['url' => $archivo['url'], 'target' => '_blank'] : null;
?>
<section id="politica">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <p class="mt-[clamp(20px,1.6vw,30px)] text-[15px] leading-[1.65] text-pretty text-gris-3a" data-sr="clip" data-sr-delay="200"><?= esc_html((string) ($grupo['intro'] ?? '')) ?></p>

    <?php if ($bloques) : ?>
        <div class="relative mt-[clamp(20px,1.6vw,30px)]">
            <div class="absolute inset-0 bg-[linear-gradient(90deg,var(--color-gris-e4),var(--color-gris-ee)_60%,var(--color-gris-e9))]" data-sr="band" aria-hidden="true"></div>
            <div class="relative grid grid-cols-1 gap-1 p-1 min-[760px]:grid-cols-2">
                <?php foreach ($bloques as $i => $bloque) :
                    $compromisos = array_values(array_filter((array) ($bloque['compromisos'] ?? []), static fn($c): bool => trim((string) ($c['texto'] ?? '')) !== ''));
                    ?>
                    <article class="flex min-w-0 flex-col rounded bg-white px-[clamp(22px,1.7vw,32px)] py-[clamp(24px,1.9vw,36px)]" data-sr="card" data-sr-delay="<?= esc_attr((string) (($i % 2) * 110)) ?>">
                        <h3 class="m-0 mb-3.5 text-[clamp(17px,.95vw,18px)] leading-[1.3] font-bold tracking-[.01em] text-ink uppercase"><?= esc_html((string) $bloque['titulo']) ?></h3>
                        <?php if ($compromisos) : ?>
                            <ul class="m-0 list-none p-0">
                                <?php foreach ($compromisos as $compromiso) : ?>
                                    <li class="relative border-t border-[#EDEDED] py-2.5 pl-5 text-[15px] leading-[1.55] text-pretty text-gris-5a">
                                        <span class="absolute top-[18px] left-0 size-1.5 rounded-[1px] bg-brand" aria-hidden="true"></span><?= esc_html((string) $compromiso['texto']) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($aprobacion !== '' || ($enlace_pdf && $boton !== '')) : ?>
        <div class="mt-[clamp(20px,1.6vw,30px)] flex flex-wrap items-center justify-between gap-x-6 gap-y-4" data-sr="clip" data-sr-delay="120">
            <?php if ($aprobacion !== '') : ?><p class="m-0 text-sm leading-[1.6] text-gris-7a"><?= esc_html($aprobacion) ?></p><?php endif; ?>
            <?php get_template_part('template-parts/components/boton', null, ['texto' => $boton, 'enlace' => $enlace_pdf, 'flecha' => true, 'relleno' => 'px-6', 'titulo' => 'PDF' . $peso]); ?>
        </div>
    <?php endif; ?>
</section>
