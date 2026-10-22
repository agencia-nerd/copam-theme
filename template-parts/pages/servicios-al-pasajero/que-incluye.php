<?php
defined('ABSPATH') || exit;

/**
 * Servicios al pasajero · qué incluye: tarjetas de las prestaciones sobre una banda gris y una nota debajo.
 * Lee el grupo `servicios_al_pasajero_que_incluye` (ACF).
 */
$grupo = get_field('servicios_al_pasajero_que_incluye') ?: [];
$items = array_values(array_filter((array) ($grupo['items'] ?? []), static fn($item): bool => trim((string) ($item['titulo'] ?? '')) !== ''));
$nota  = trim((string) ($grupo['nota'] ?? ''));
?>
<section class="relative z-[1] bg-white pt-[clamp(40px,3.6vw,68px)] pb-[clamp(88px,7.3vw,140px)]" id="que-incluye">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    </div>
    <?php if ($items) : ?>
        <div class="relative mt-[clamp(26px,2.1vw,40px)]">
            <div class="absolute inset-0 bg-[linear-gradient(90deg,var(--color-gris-e4),var(--color-gris-ee)_60%,var(--color-gris-e9))]" data-sr="band" aria-hidden="true"></div>
            <div class="relative grid grid-cols-[minmax(0,1fr)] gap-1 px-[clamp(20px,4.17vw,80px)] py-1 sm:grid-cols-[repeat(2,minmax(0,1fr))]">
                <?php foreach ($items as $i => $item) {
                    get_template_part('template-parts/components/tarjeta-servicio', null, [
                        'titulo'      => (string) $item['titulo'],
                        'descripcion' => (string) ($item['descripcion'] ?? ''),
                        'retardo'     => ($i % 2) * 110 + intdiv($i, 2) * 90,
                    ]);
                } ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($nota !== '') : ?>
        <p class="mx-[clamp(20px,4.17vw,80px)] mt-[clamp(24px,2.1vw,40px)] mb-0 text-sm leading-[1.6] text-pretty text-gris-7a" data-sr="clip" data-sr-delay="200"><?= esc_html($nota) ?></p>
    <?php endif; ?>
</section>
