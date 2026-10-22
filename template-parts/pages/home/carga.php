<?php
defined('ABSPATH') || exit;

/**
 * Portada · carga de la Amazonía: foto que crece hasta ocupar la pantalla y se oscurece mientras
 * suben los tipos de carga (módulo `pin-carga.js`). Sin JS la foto ya está oscurecida y todo se lee.
 * Lee el grupo `home_carga` (ACF); el contenido inicial está en inc/acf/seed/home.php.
 */
$carga       = get_field('home_carga') ?: [];
$titulo      = (string) ($carga['titulo'] ?? '');
$tipos       = array_values(array_filter(array_map(static fn($tipo): string => (string) ($tipo['nombre'] ?? ''), (array) ($carga['tipos'] ?? []))));
$descripcion = (string) ($carga['descripcion'] ?? '');
?>
<section class="relative z-[1] bg-[linear-gradient(135deg,#00652F_0%,#005A2A_55%,#004D24_100%)]" data-pin="carga" data-nav-oscuro data-pin-hold="0.45" aria-label="<?= esc_attr($titulo) ?>">
    <div class="relative js:sticky js:top-0 js:h-screen js:overflow-hidden">
        <div class="absolute inset-0 overflow-hidden js:[clip-path:inset(50%)]" data-carga-clip>
            <?= copam_theme_image($carga['imagen'] ?? null, ['class' => 'absolute inset-0 size-full origin-center object-cover will-change-transform', 'alt' => (string) ($carga['alt'] ?? ''), 'sizes' => '100vw']) ?>
            <div class="absolute inset-0 bg-[#0B0F0C] opacity-55 js:opacity-0" data-carga-dim></div>
        </div>

        <div class="pointer-events-none relative z-[3] flex min-h-svh flex-col items-center justify-between px-[clamp(20px,4.17vw,80px)] pt-[104px] pb-[clamp(40px,min(9vw,11vh),110px)] text-center text-white min-[760px]:pt-[clamp(84px,min(9vw,13vh),130px)] js:h-full js:min-h-0">
            <h2 class="m-0 flex flex-wrap justify-center gap-x-[.25em] text-[clamp(30px,3.15vw,60px)] leading-none font-bold tracking-[-.02em] uppercase">
                <?php foreach (preg_split('/\s+/', $titulo) as $i => $palabra) : ?>
                    <span class="block overflow-hidden pb-[.06em]"><span class="block" data-sr="rise"<?= $i ? ' data-sr-delay="' . esc_attr((string) ($i * 60)) . '"' : '' ?>><?= esc_html($palabra) ?></span></span>
                <?php endforeach; ?>
            </h2>
            <ul class="m-0 flex max-w-[1400px] list-none flex-wrap justify-center gap-x-[clamp(20px,2.1vw,40px)] gap-y-3.5 p-0">
                <?php foreach ($tipos as $i => $tipo) : ?>
                    <li class="overflow-hidden pb-[.08em]">
                        <span class="block text-[clamp(15px,1.05vw,20px)] font-semibold tracking-[.01em] whitespace-nowrap uppercase" data-carga-tipo data-d="<?= esc_attr((string) ($i * 80)) ?>"><?= esc_html($tipo) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p class="m-0 max-w-[660px] text-[15px] leading-[1.6] text-pretty" data-sr="clip" data-sr-delay="200"><?= esc_html($descripcion) ?></p>
        </div>
    </div>
</section>
