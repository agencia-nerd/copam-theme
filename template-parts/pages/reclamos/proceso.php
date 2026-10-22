<?php
defined('ABSPATH') || exit;

/**
 * Reclamos · proceso de atención: pasos numerados sobre una banda gris (5 columnas desde 1180 px, 2 desde 600 px).
 * El número sale de la posición; los plazos van en verde con el marcador ~.
 * Lee el grupo `reclamos_proceso` (ACF).
 */
$grupo = get_field('reclamos_proceso') ?: [];
$pasos = array_values(array_filter((array) ($grupo['pasos'] ?? []), static fn($p): bool => trim((string) ($p['titulo'] ?? '')) !== ''));
?>
<section class="relative z-[1] bg-white pt-[clamp(40px,3.6vw,68px)] pb-[clamp(88px,7.3vw,140px)]" id="proceso">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    </div>
    <?php if ($pasos) : ?>
        <div class="relative mt-[clamp(26px,2.1vw,40px)]">
            <div class="absolute inset-0 bg-[linear-gradient(90deg,var(--color-gris-e4),var(--color-gris-ee)_60%,var(--color-gris-e9))]" data-sr="band" aria-hidden="true"></div>
            <ol class="relative m-0 grid list-none grid-cols-[minmax(0,1fr)] gap-1 px-[clamp(20px,4.17vw,80px)] py-1 sm:grid-cols-[repeat(2,minmax(0,1fr))] xl:grid-cols-[repeat(5,minmax(0,1fr))]">
                <?php foreach ($pasos as $i => $paso) : ?>
                    <li class="grid min-w-0">
                        <?php get_template_part('template-parts/components/tarjeta-paso', null, [
                            'numero'  => sprintf('%02d', $i + 1),
                            'titulo'  => (string) $paso['titulo'],
                            'texto'   => (string) ($paso['descripcion'] ?? ''),
                            'retardo' => ($i % 5) * 110,
                        ]); ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    <?php endif; ?>
</section>
