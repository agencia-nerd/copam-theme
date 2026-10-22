<?php
defined('ABSPATH') || exit;

/**
 * Servicios al pasajero · infraestructura: tarjetas de las instalaciones para pasajeros sobre una banda gris.
 * Lee el grupo `servicios_al_pasajero_infraestructura` (ACF).
 */
$grupo = get_field('servicios_al_pasajero_infraestructura') ?: [];
$items = array_values(array_filter((array) ($grupo['items'] ?? []), static fn($item): bool => trim((string) ($item['titulo'] ?? '')) !== ''));
?>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="infraestructura">
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
</section>
