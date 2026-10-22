<?php
defined('ABSPATH') || exit;

/**
 * Portada · servicios: cinco tarjetas con enlace al detalle de cada servicio.
 * Lee el grupo `home_servicios` (ACF); el contenido inicial está en inc/acf/seed/home.php.
 */
$sec       = get_field('home_servicios') ?: [];
$servicios = (array) ($sec['items'] ?? []);
$total = count($servicios);
?>
<section id="servicios" class="relative z-[1] bg-white pt-[clamp(80px,7.3vw,140px)] pb-[clamp(96px,7.8vw,150px)]" aria-label="<?= esc_attr((string) ($sec['titulo'] ?? '')) ?>">
    <?php get_template_part('template-parts/components/encabezado-seccion', null, [
        'etiqueta' => (string) ($sec['etiqueta'] ?? ''),
        'titulo'   => (string) ($sec['titulo'] ?? ''),
        'bajada'   => (string) ($sec['bajada'] ?? ''),
    ]); ?>

    <div class="relative mt-[clamp(56px,4.4vw,84px)]">
        <div class="absolute inset-0 bg-[linear-gradient(90deg,var(--color-gris-e4),var(--color-gris-ee)_60%,var(--color-gris-e9))]" data-sr="band"></div>
        <div class="relative grid grid-cols-1 gap-1 px-[clamp(20px,4.17vw,80px)] py-1 sm:grid-cols-2 xl:grid-cols-6">
            <?php foreach ($servicios as $i => $s) :
                // Con cinco tarjetas, las dos últimas ocupan tres columnas cada una y quedan centradas.
                $ancho = ($total === 5 && $i >= 3) ? 'xl:col-span-3' : 'xl:col-span-2';
                ?>
                <article class="relative flex min-h-[clamp(240px,14vw,270px)] flex-col items-start overflow-hidden rounded bg-white p-[clamp(24px,1.67vw,32px)] <?= esc_attr($ancho) ?>" data-sr="card" data-sr-delay="<?= esc_attr((string) (($i % 3) * 110 + intdiv($i, 3) * 90)) ?>">
                    <h3 class="mt-[clamp(8px,.8vw,16px)] w-full text-[clamp(17px,.95vw,18px)] leading-[1.3] font-bold tracking-[.01em] text-ink uppercase"><?= esc_html((string) ($s['titulo'] ?? '')) ?></h3>
                    <p class="mt-3.5 mb-[clamp(28px,2.4vw,46px)] w-full text-[15px] leading-[1.5] text-pretty text-gris-5a"><?= esc_html((string) ($s['descripcion'] ?? '')) ?></p>
                    <?php get_template_part('template-parts/components/boton', null, [
                        'texto'   => __('Ver detalle', 'copam-theme'),
                        'enlace'  => $s['enlace'] ?? null,
                        'flecha'  => true,
                        'relleno' => 'px-6',
                        'clase'   => 'mt-auto',
                    ]); ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
