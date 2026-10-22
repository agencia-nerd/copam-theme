<?php
defined('ABSPATH') || exit;

/**
 * Portada · conoce: tres paneles a pantalla completa que se cubren uno a otro al hacer scroll
 * (módulo `pin-conoce.js`). Sin JS o con movimiento reducido se leen apilados, uno tras otro.
 * Lee el grupo `home_conoce` (ACF); el contenido inicial está en inc/acf/seed/home.php.
 */
$conoce   = get_field('home_conoce') ?: [];
$etiqueta = (string) ($conoce['etiqueta'] ?? '');
$paneles  = array_values(array_filter((array) ($conoce['paneles'] ?? []), static fn($p): bool => !empty($p['imagen'])));

// Columnas de las cifras según cuántas hay (ajuste de diseño, no contenido).
$columnas_cifras = static fn(int $cantidad): string => $cantidad > 4
    ? 'grid-cols-[repeat(2,max-content)] md:grid-cols-[repeat(3,max-content)]'
    : 'grid-cols-[repeat(2,max-content)]';
$vineta = 'bg-[radial-gradient(ellipse_farthest-corner_at_50%_46%,rgba(10,22,28,0)_35%,rgba(10,22,28,.22)_70%,rgba(10,22,28,.5)_100%)]';
?>
<section class="relative z-[1] bg-gris-1a" data-pin="conoce" data-nav-oscuro data-pin-total="<?= esc_attr((string) count($paneles)) ?>" aria-label="<?= esc_attr__('Conoce COPAM', 'copam-theme') ?>">
    <div class="js:sticky js:top-0 js:h-screen js:overflow-hidden" data-pin-stage>
        <?php foreach ($paneles as $i => $p) : ?>
            <div class="relative isolate flex min-h-svh flex-col justify-end overflow-hidden bg-gris-1a text-white js:absolute js:inset-0 js:min-h-0" data-pin-panel>
                <div class="absolute inset-0 overflow-hidden will-change-transform" data-pin-img>
                    <?= copam_theme_image($p['imagen'], ['class' => 'absolute top-0 left-0 size-full object-cover', 'alt' => (string) ($p['alt'] ?? ''), 'sizes' => '100vw']) ?>
                </div>
                <div class="pointer-events-none absolute inset-0 <?= esc_attr($vineta) ?>" aria-hidden="true"></div>
                <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(10,10,10,.08)_0%,rgba(10,10,10,0)_35%,rgba(10,10,10,.62)_100%)]" aria-hidden="true"></div>

                <div class="relative z-[1] px-[clamp(20px,2.1vw,40px)] pb-[clamp(40px,5vw,96px)]">
                    <span class="relative block h-0.5 overflow-hidden rounded-[1px] bg-white/[.22] max-md:absolute max-md:inset-x-5 max-md:top-[clamp(84px,13svh,120px)]" data-pin-line aria-hidden="true">
                        <span class="absolute inset-0 origin-left scale-x-0 bg-white" data-pin-bar></span>
                    </span>
                    <div class="mt-[clamp(32px,2.6vw,50px)] grid grid-cols-1 gap-x-10 gap-y-7 md:grid-cols-2 xl:grid-cols-[clamp(150px,11vw,210px)_minmax(0,1fr)_minmax(0,640px)]">
                        <div class="overflow-hidden pt-[.4em]">
                            <span class="block text-[clamp(14px,.95vw,18px)] font-medium tracking-[.02em] whitespace-nowrap uppercase" data-pin-rise data-d="120"><?= esc_html($etiqueta) ?></span>
                        </div>
                        <div class="min-w-0">
                            <h2 class="m-0 overflow-hidden pb-[.06em] text-[clamp(30px,2.5vw,48px)] leading-[1.05] font-bold tracking-[-.01em] uppercase">
                                <span class="block" data-pin-rise data-d="180"><?= esc_html((string) ($p['titulo'] ?? '')) ?></span>
                            </h2>
                            <p class="mt-[clamp(16px,1.2vw,22px)] max-w-[700px] text-[15px] leading-[1.6] text-pretty" data-pin-clip data-d="320"><?= esc_html((string) ($p['descripcion'] ?? '')) ?></p>
                        </div>
                        <?php if (!empty($p['cifras'])) : ?>
                            <ul class="m-0 grid list-none content-start gap-x-[clamp(24px,3vw,56px)] gap-y-[clamp(20px,2vw,36px)] p-0 <?= esc_attr($columnas_cifras(count($p['cifras']))) ?>">
                                <?php foreach ($p['cifras'] as $j => $cifra) : ?>
                                    <li class="overflow-hidden">
                                        <div data-pin-rise data-d="<?= esc_attr((string) (420 + $j * 70)) ?>">
                                            <div class="text-[clamp(26px,1.9vw,36px)] leading-[1.1] font-bold tracking-[-.01em] whitespace-nowrap"><?= esc_html((string) ($cifra['numero'] ?? '')) ?></div>
                                            <div class="mt-1.5 text-[clamp(13px,.8vw,15px)]"><?= esc_html((string) ($cifra['rotulo'] ?? '')) ?></div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?php if (!empty($p['lista'])) : ?>
                            <ul class="m-0 grid list-none grid-cols-1 content-start gap-x-[clamp(20px,2vw,40px)] gap-y-[clamp(14px,1.3vw,24px)] p-0 md:grid-cols-[repeat(2,minmax(0,max-content))]">
                                <?php foreach ($p['lista'] as $j => $item) : ?>
                                    <li class="overflow-hidden">
                                        <span class="flex gap-2.5 text-[clamp(14px,.85vw,16px)] leading-[1.4]" data-pin-rise data-d="<?= esc_attr((string) (420 + $j * 70)) ?>"><span aria-hidden="true">•</span><span><?= esc_html((string) ($item['texto'] ?? '')) ?></span></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
