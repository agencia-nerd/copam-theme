<?php
defined('ABSPATH') || exit;

/**
 * Portada · llamada a la acción: invita a cotizar un servicio o coordinar una operación.
 * Lee el grupo `home_cta` (ACF); el contenido inicial está en inc/acf/seed/home.php.
 */
$cta         = get_field('home_cta') ?: [];
$titulo      = (string) ($cta['titulo'] ?? '');
$descripcion = (string) ($cta['descripcion'] ?? '');
$boton       = $cta['boton'] ?? null;
?>
<section class="relative z-[1] bg-gris-f4 px-[clamp(20px,4.17vw,80px)] pt-[clamp(80px,6.6vw,128px)] pb-[clamp(94px,7.71vw,148px)]" aria-label="<?= esc_attr__('Contacto', 'copam-theme') ?>">
    <div class="grid grid-cols-1 gap-[clamp(10px,.83vw,16px)] lg:grid-cols-[minmax(0,886fr)_minmax(0,1454fr)]">
        <div class="flex min-w-0 flex-col items-start justify-center rounded-md bg-ink px-[clamp(24px,2.1vw,40px)] py-[clamp(40px,3.4vw,66px)]" data-sr="wipe">
            <h2 class="m-0 flex flex-wrap gap-x-[.25em] text-[clamp(28px,2.25vw,43px)] leading-[1.08] font-semibold tracking-[-.005em] text-white uppercase">
                <?php foreach (preg_split('/\s+/', $titulo) as $i => $palabra) : ?>
                    <span class="block overflow-hidden pb-[.06em]"><span class="block" data-sr="rise" data-sr-delay="<?= esc_attr((string) (220 + $i * 45)) ?>"><?= esc_html($palabra) ?></span></span>
                <?php endforeach; ?>
            </h2>
            <p class="mt-[clamp(18px,1.4vw,26px)] text-[15px] leading-[1.5] text-pretty text-gris-d2" data-sr="clip" data-sr-delay="560"><?= esc_html($descripcion) ?></p>
            <div class="mt-[clamp(26px,1.95vw,37px)] overflow-hidden rounded">
                <?php get_template_part('template-parts/components/boton', null, [
                    'texto'  => (string) ($boton['title'] ?? ''),
                    'enlace' => $boton,
                    'datos'  => ['sr' => 'rise', 'sr-delay' => '660'],
                ]); ?>
            </div>
        </div>
        <div class="relative min-h-[56vw] min-w-0 overflow-hidden rounded-md bg-gris-e4 lg:min-h-[max(380px,22.9vw)]" data-sr="card" data-sr-delay="140">
            <?= copam_theme_image($cta['imagen'] ?? null, ['class' => 'absolute inset-0 block size-full object-cover', 'alt' => (string) ($cta['alt'] ?? '')]) ?>
        </div>
    </div>
</section>
