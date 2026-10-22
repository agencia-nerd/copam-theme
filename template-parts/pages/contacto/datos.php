<?php
defined('ABSPATH') || exit;

/**
 * Contacto · datos de contacto: tabla etiqueta / valor con líneas entre filas. Una fila sin valor es el
 * subtítulo de un grupo (fondo gris y texto en negrita, h3); cada par es un <dl> propio.
 * Lee el grupo `contacto_datos` (ACF).
 */
$grupo = get_field('contacto_datos') ?: [];
$filas = array_values(array_filter((array) ($grupo['filas'] ?? []), static fn($fila): bool => trim((string) ($fila['etiqueta'] ?? '')) !== ''));
?>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="datos">
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
                    $valor  = trim((string) ($fila['valor'] ?? ''));
                    $titulo = $valor === '';
                    $d      = (string) ($i * 50);
                    ?>
                    <div class="relative px-[clamp(20px,2.1vw,40px)] py-[clamp(14px,1.1vw,20px)] <?= $titulo ? 'bg-[#F6F6F6]' : 'bg-white' ?>">
                        <?php if ($i > 0) : ?>
                            <span class="absolute inset-x-0 top-0 h-px bg-line" data-sr="lineX" aria-hidden="true"></span>
                        <?php endif; ?>
                        <?php if ($titulo) : ?>
                            <h3 class="m-0 block overflow-hidden text-[clamp(15px,.9vw,17px)] font-semibold text-ink"><span class="block" data-sr="rise" data-sr-delay="<?= esc_attr($d) ?>"><?= esc_html((string) $fila['etiqueta']) ?></span></h3>
                        <?php else : ?>
                            <dl class="m-0 flex flex-wrap items-center justify-between gap-x-8 gap-y-1.5">
                            <dt class="block overflow-hidden"><span class="block text-[clamp(14px,.85vw,16px)] text-gris-7a" data-sr="rise" data-sr-delay="<?= esc_attr($d) ?>"><?= esc_html((string) $fila['etiqueta']) ?></span></dt>
                            <dd class="m-0 block min-w-0 overflow-hidden"><span class="block text-right text-[clamp(14px,.85vw,16px)] leading-normal whitespace-pre-line text-ink" data-sr="rise" data-sr-delay="<?= esc_attr((string) ($i * 50 + 50)) ?>"><?= esc_html($valor) ?></span></dd>
                            </dl>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
