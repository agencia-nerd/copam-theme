<?php
defined('ABSPATH') || exit;

/**
 * Sistema Integrado de Gestión · nuestro sistema: párrafo y dos tarjetas (alcance de la certificación, consulta).
 * Lee el grupo `sistema_integrado_de_gestion_sistema` (ACF).
 */
$grupo = get_field('sistema_integrado_de_gestion_sistema') ?: [];

$alcance_etiqueta  = (string) ($grupo['alcance_etiqueta'] ?? '');
$alcance_texto     = (string) ($grupo['alcance_texto'] ?? '');
$alcance_direccion = (string) ($grupo['alcance_direccion'] ?? '');
$consulta_etiqueta = (string) ($grupo['consulta_etiqueta'] ?? '');
$consulta_texto    = (string) ($grupo['consulta_texto'] ?? '');
$consulta_enlace   = $grupo['consulta_enlace'] ?? null;

$etiqueta = 'block text-xs leading-[1.3] font-semibold tracking-[.14em] text-brand uppercase';
?>
<section id="sistema">
    <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
    <p class="mt-[clamp(20px,1.6vw,30px)] text-[15px] leading-[1.65] text-pretty text-gris-3a" data-sr="clip" data-sr-delay="200"><?= esc_html((string) ($grupo['texto'] ?? '')) ?></p>

    <?php if ($alcance_etiqueta !== '' || $alcance_texto !== '' || $alcance_direccion !== '') : ?>
        <div class="mt-[clamp(20px,1.6vw,30px)] rounded-md bg-[#F8F8F8] px-[clamp(22px,1.7vw,32px)] py-[clamp(24px,1.9vw,36px)]" data-sr="card" data-sr-delay="240">
            <?php if ($alcance_etiqueta !== '') : ?><span class="<?= esc_attr($etiqueta) ?>"><?= esc_html($alcance_etiqueta) ?></span><?php endif; ?>
            <?php if ($alcance_texto !== '') : ?><p class="mt-3 text-[15px] leading-[1.65] text-pretty text-gris-3a"><?= esc_html($alcance_texto) ?></p><?php endif; ?>
            <?php if ($alcance_direccion !== '') : ?><p class="mt-2.5 text-sm leading-[1.6] text-gris-7a"><?= esc_html($alcance_direccion) ?></p><?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($consulta_etiqueta !== '' || $consulta_texto !== '' || $consulta_enlace) : ?>
        <div class="mt-1.5 rounded-md bg-[#F8F8F8] px-[clamp(22px,1.7vw,32px)] py-[clamp(22px,1.7vw,30px)]" data-sr="card" data-sr-delay="300">
            <?php if ($consulta_etiqueta !== '') : ?><span class="<?= esc_attr($etiqueta) ?>"><?= esc_html($consulta_etiqueta) ?></span><?php endif; ?>
            <?php if ($consulta_texto !== '') : ?><p class="mt-2.5 text-[15px] leading-[1.6] text-pretty text-gris-3a"><?= esc_html($consulta_texto) ?></p><?php endif; ?>
            <?php get_template_part('template-parts/components/enlace-flecha', null, ['enlace' => $consulta_enlace, 'clase' => 'mt-3']); ?>
        </div>
    <?php endif; ?>
</section>
