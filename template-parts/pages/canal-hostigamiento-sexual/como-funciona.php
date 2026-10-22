<?php
defined('ABSPATH') || exit;

/**
 * Canal de hostigamiento sexual · cómo funciona: tres tarjetas (una fila desde 1000 px) sobre una banda gris
 * y la nota con la base legal.
 * Lee el grupo `canal_hostigamiento_sexual_como_funciona` (ACF).
 */
$grupo    = get_field('canal_hostigamiento_sexual_como_funciona') ?: [];
$tarjetas = array_values(array_filter((array) ($grupo['tarjetas'] ?? []), static fn($t): bool => trim((string) ($t['titulo'] ?? '')) !== ''));
$nota     = (string) ($grupo['nota_legal'] ?? '');
?>
<section class="relative z-[1] bg-white pt-[clamp(40px,3.6vw,68px)]" id="como-funciona">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    </div>
    <?php if ($tarjetas) : ?>
        <div class="relative mt-[clamp(26px,2.1vw,40px)]">
            <div class="absolute inset-0 bg-[linear-gradient(90deg,var(--color-gris-e4),var(--color-gris-ee)_60%,var(--color-gris-e9))]" data-sr="band" aria-hidden="true"></div>
            <div class="relative grid grid-cols-[minmax(0,1fr)] gap-1 px-[clamp(20px,4.17vw,80px)] py-1 min-[1000px]:grid-cols-[repeat(3,minmax(0,1fr))]">
                <?php foreach ($tarjetas as $i => $tarjeta) {
                    get_template_part('template-parts/components/tarjeta-servicio', null, [
                        'titulo'      => (string) $tarjeta['titulo'],
                        'descripcion' => (string) ($tarjeta['descripcion'] ?? ''),
                        'retardo'     => $i * 110,
                    ]);
                } ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($nota !== '') : ?>
        <p class="mt-[clamp(16px,1.3vw,24px)] mb-0 px-[clamp(20px,4.17vw,80px)] text-[13px] leading-normal text-gris-7a" data-sr="clip" data-sr-delay="200"><?= esc_html($nota) ?></p>
    <?php endif; ?>
</section>
