<?php
defined('ABSPATH') || exit;

/**
 * Servicios no portuarios · tarifas y precios: texto, botón de descarga del tarifario vigente y enlace a las
 * versiones anteriores. Lee el grupo `servicios_no_portuarios_tarifas` (ACF).
 */
$grupo     = get_field('servicios_no_portuarios_tarifas') ?: [];
$texto     = (string) ($grupo['texto'] ?? '');
$tarifario = $grupo['tarifario'] ?? null;
$descarga  = is_array($tarifario) && !empty($tarifario['url']) ? ['url' => (string) $tarifario['url'], 'target' => '_blank'] : null;
$peso      = is_array($tarifario) && !empty($tarifario['filesize']) ? 'PDF · ' . size_format((int) $tarifario['filesize'], 0) : '';
?>
<section class="relative z-[1] bg-white pb-[clamp(88px,7.3vw,140px)]" id="tarifas">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
        <?php if ($texto !== '') : ?>
            <p class="mt-[clamp(26px,2.1vw,40px)] mb-0 max-w-[1100px] text-[15px] leading-[1.6] text-pretty text-gris-5a" data-sr="clip" data-sr-delay="200"><?= esc_html($texto) ?></p>
        <?php endif; ?>
        <div class="mt-[clamp(24px,2.1vw,40px)] flex flex-wrap items-center gap-x-7 gap-y-4">
            <div class="overflow-hidden rounded">
                <?php get_template_part('template-parts/components/boton', null, [
                    'texto'  => (string) ($grupo['boton_texto'] ?? ''),
                    'enlace' => $descarga,
                    'titulo' => $peso,
                    'datos'  => ['sr' => 'rise', 'sr-delay' => '300'],
                ]); ?>
            </div>
            <?php get_template_part('template-parts/components/enlace-flecha', null, ['enlace' => $grupo['versiones'] ?? null]); ?>
        </div>
    </div>
</section>
