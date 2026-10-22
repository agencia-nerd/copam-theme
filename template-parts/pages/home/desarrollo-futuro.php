<?php
defined('ABSPATH') || exit;

/**
 * Portada · desarrollo futuro: dos tarjetas con estructura distinta (plan maestro y fase II).
 * Lee el grupo `home_desarrollo_futuro` (ACF); el contenido inicial está en inc/acf/seed/home.php.
 */
$sec  = get_field('home_desarrollo_futuro') ?: [];
$plan = [
    'etiqueta'    => (string) ($sec['plan_etiqueta'] ?? ''),
    'titulo'      => (string) ($sec['plan_titulo'] ?? ''),
    'descripcion' => (string) ($sec['plan_descripcion'] ?? ''),
    'nota'        => (string) ($sec['plan_nota'] ?? ''),
];
$fase = [
    'etiqueta' => (string) ($sec['fase_etiqueta'] ?? ''),
    'cifras'   => (array) ($sec['fase_cifras'] ?? []),
    'nota'     => (string) ($sec['fase_nota'] ?? ''),
];
?>
<section id="desarrollo-futuro" class="relative z-[1] bg-white pt-[clamp(72px,5.2vw,100px)] pb-[clamp(24px,2vw,40px)]" aria-label="<?= esc_attr((string) ($sec['titulo'] ?? '')) ?>">
    <?php get_template_part('template-parts/components/encabezado-seccion', null, [
        'etiqueta' => (string) ($sec['etiqueta'] ?? ''),
        'titulo'   => (string) ($sec['titulo'] ?? ''),
        'bajada'   => (string) ($sec['bajada'] ?? ''),
    ]); ?>

    <div class="relative mt-[clamp(56px,4.4vw,84px)]">
        <div class="absolute inset-0 bg-[linear-gradient(90deg,var(--color-gris-e4),var(--color-gris-ee)_60%,var(--color-gris-e9))]" data-sr="band"></div>
        <div class="relative grid grid-cols-[repeat(auto-fit,minmax(min(100%,440px),1fr))] gap-1 px-[clamp(20px,4.17vw,80px)] py-1">
            <article class="relative flex min-h-[clamp(280px,17vw,330px)] flex-col items-start overflow-hidden rounded bg-white p-[clamp(24px,1.67vw,32px)]" data-sr="card" data-sr-delay="0">
                <span class="text-[13px] font-medium tracking-[.03em] text-brand uppercase"><?= esc_html($plan['etiqueta']) ?></span>
                <h3 class="mt-[clamp(14px,1.1vw,20px)] text-[clamp(26px,2vw,38px)] leading-[1.1] font-semibold tracking-[-.01em] text-ink"><?= esc_html($plan['titulo']) ?></h3>
                <p class="mt-4 max-w-[520px] text-[15px] leading-[1.6] text-pretty text-gris-5a"><?= esc_html($plan['descripcion']) ?></p>
                <span class="mt-auto pt-[clamp(24px,2vw,36px)] text-[13px] leading-[1.5] text-ink-muted"><?= esc_html($plan['nota']) ?></span>
            </article>
            <article class="relative flex min-h-[clamp(280px,17vw,330px)] flex-col items-start overflow-hidden rounded bg-white p-[clamp(24px,1.67vw,32px)]" data-sr="card" data-sr-delay="110">
                <span class="text-[13px] font-medium tracking-[.03em] text-brand uppercase"><?= esc_html($fase['etiqueta']) ?></span>
                <ul class="m-0 mt-[clamp(14px,1.1vw,20px)] flex list-none flex-wrap gap-x-[clamp(32px,3vw,56px)] gap-y-5 p-0">
                    <?php foreach ($fase['cifras'] as $cifra) : ?>
                        <li class="flex flex-col gap-1.5">
                            <span class="text-[clamp(26px,2vw,38px)] leading-[1.1] font-semibold tracking-[-.01em] text-ink"><?= esc_html((string) ($cifra['numero'] ?? '')) ?></span>
                            <span class="text-[15px] leading-[1.4] text-gris-5a"><?= esc_html((string) ($cifra['rotulo'] ?? '')) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <span class="mt-auto pt-[clamp(24px,2vw,36px)] text-[13px] leading-[1.5] text-ink-muted"><?= esc_html($fase['nota']) ?></span>
            </article>
        </div>
    </div>
</section>
