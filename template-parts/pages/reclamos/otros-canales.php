<?php
defined('ABSPATH') || exit;

/**
 * Reclamos · otros canales del usuario: tarjetas (denuncias, reglamento de usuarios, sugerencias) sobre una banda
 * gris. Cada tarjeta usa su enlace o, si no tiene, el PDF con su texto.
 * Lee el grupo `reclamos_otros_canales` (ACF).
 */
$grupo    = get_field('reclamos_otros_canales') ?: [];
$tarjetas = array_values(array_filter((array) ($grupo['tarjetas'] ?? []), static fn($t): bool => trim((string) ($t['titulo'] ?? '')) !== ''));
?>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="otros-canales">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    </div>
    <?php if ($tarjetas) : ?>
        <div class="relative mt-[clamp(26px,2.1vw,40px)]">
            <div class="absolute inset-0 bg-[linear-gradient(90deg,var(--color-gris-e4),var(--color-gris-ee)_60%,var(--color-gris-e9))]" data-sr="band" aria-hidden="true"></div>
            <div class="relative grid grid-cols-[minmax(0,1fr)] gap-1 px-[clamp(20px,4.17vw,80px)] py-1 sm:grid-cols-[repeat(2,minmax(0,1fr))] xl:grid-cols-[repeat(3,minmax(0,1fr))]">
                <?php foreach ($tarjetas as $i => $tarjeta) {
                    get_template_part('template-parts/components/tarjeta-paso', null, [
                        'etiqueta'      => (string) ($tarjeta['etiqueta'] ?? ''),
                        'titulo'        => (string) $tarjeta['titulo'],
                        'texto'         => (string) ($tarjeta['descripcion'] ?? ''),
                        'nota'          => (string) ($tarjeta['nota'] ?? ''),
                        'enlace'        => $tarjeta['enlace'] ?? null,
                        'archivo'       => $tarjeta['archivo'] ?? null,
                        'texto_archivo' => (string) ($tarjeta['texto_archivo'] ?? ''),
                        'retardo'       => ($i % 3) * 110,
                    ]);
                } ?>
            </div>
        </div>
    <?php endif; ?>
</section>
