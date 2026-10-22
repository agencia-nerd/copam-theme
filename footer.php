<?php
defined('ABSPATH') || exit;

/**
 * Pie del sitio: datos de contacto, columnas del menú `pie`, línea legal (menú `legal`) y logo grande sobre el fondo de agua.
 * Los textos son el grupo `opciones_pie` de Ajustes del sitio; los menús, de Apariencia > Menús.
 */
$pie         = get_field('opciones_pie', 'option') ?: [];
$descripcion = (string) ($pie['descripcion'] ?? '');
$telefono    = (string) ($pie['telefono'] ?? '');
$correo      = (string) ($pie['correo'] ?? '');
$copyright   = (string) ($pie['copyright'] ?? '');

// Cada elemento de primer nivel es una columna; sus hijos, los enlaces.
$columnas = array_map(static fn(array $columna): array => [
    'titulo'  => $columna['texto'],
    'enlaces' => array_map(static fn(array $hijo): array => ['texto' => $hijo['texto'], 'url' => $hijo['url'], 'externo' => $hijo['externo']], $columna['hijos']),
], copam_theme_sitio_menu('pie'));
$legal = copam_theme_sitio_menu('legal');
$logo  = get_theme_mod('custom_logo');
?>
    <footer class="relative z-[1] overflow-hidden bg-[linear-gradient(180deg,var(--color-gris-f4)_0,var(--color-gris-f4)_40px,var(--color-petrol)_40px,var(--color-petrol-dark)_55%,var(--color-petrol-deep)_100%)] px-[clamp(16px,4.17vw,80px)] pb-[clamp(24px,2.5vw,48px)]">
        <div class="pointer-events-none absolute inset-x-0 top-10 bottom-0 -z-10" data-ocean aria-hidden="true"></div>

        <div class="relative overflow-hidden rounded-md bg-white shadow-[0_14px_36px_-14px_rgba(0,0,0,.3),0_3px_10px_rgba(0,0,0,.1)]" data-sr="wipe" data-sr-fast data-sr-shadow>
            <div class="px-[clamp(20px,3.3vw,64px)] pt-[clamp(40px,3.6vw,68px)]">
                <div class="grid grid-cols-2 gap-x-[clamp(20px,2vw,40px)] gap-y-9 min-[600px]:grid-cols-3 xl:grid-cols-[minmax(0,1.5fr)_repeat(5,minmax(0,1fr))]">
                    <div class="overflow-hidden">
                        <div data-sr="rise" data-sr-fast data-sr-delay="120">
                            <p class="m-0 max-w-[300px] text-[15px] leading-[1.6] text-ink-muted"><?= esc_html($descripcion) ?></p>
                            <?php if ($telefono !== '') : ?>
                                <a class="mt-4 inline-block text-base font-medium text-ink" href="<?= esc_url('tel:' . preg_replace('/\D+/', '', $telefono)) ?>"><?= esc_html($telefono) ?></a>
                            <?php endif; ?>
                            <?php if ($correo !== '') : ?>
                                <a class="mt-2.5 block text-[15px] font-medium text-ink transition-colors hover:text-brand" href="<?= esc_url('mailto:' . $correo) ?>"><?= esc_html($correo) ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php foreach ($columnas as $i => $columna) : ?>
                        <div class="overflow-hidden">
                            <div data-sr="rise" data-sr-fast data-sr-delay="<?= esc_attr((string) (140 + $i * 40)) ?>">
                                <h2 class="m-0 border-b border-gris-e4 pb-3 text-[clamp(13px,.75vw,14px)] font-semibold tracking-[.1em] text-ink-muted uppercase"><?= esc_html($columna['titulo']) ?></h2>
                                <ul class="m-0 mt-[clamp(18px,1.4vw,26px)] flex list-none flex-col gap-3.5 p-0">
                                    <?php foreach ($columna['enlaces'] as $enlace) : ?>
                                        <li>
                                            <a class="inline-flex items-center gap-1.5 text-[clamp(15px,.85vw,16px)] text-ink transition-colors duration-[250ms] hover:text-brand" href="<?= esc_url($enlace['url']) ?>"<?= $enlace['externo'] ? ' target="_blank" rel="noopener noreferrer"' : '' ?>>
                                                <span><?= esc_html($enlace['texto']) ?></span>
                                                <?php if ($enlace['externo']) : ?>
                                                    <svg width="11" height="11" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M3 11L11 3M4.5 3H11v6.5" stroke="currentColor" stroke-width="1.8"></path></svg>
                                                    <span class="sr-only"><?= esc_html__('(se abre en una pestaña nueva)', 'copam-theme') ?></span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <span class="mt-[clamp(40px,3.6vw,68px)] block h-px bg-line js:origin-left js:scale-x-0" data-sr="lineX" data-sr-fast data-sr-delay="200"></span>
                <div class="overflow-hidden">
                    <div class="flex flex-wrap items-center justify-between gap-x-8 gap-y-5 py-[clamp(24px,2vw,38px)]" data-sr="rise" data-sr-fast data-sr-delay="248">
                        <p class="m-0 text-sm text-ink-muted"><?= esc_html($copyright) ?></p>
                        <div class="flex flex-wrap gap-x-6 gap-y-3">
                            <?php foreach ($legal as $enlace) : ?>
                                <a class="text-sm text-ink-muted underline underline-offset-[3px] transition-colors hover:text-brand" href="<?= esc_url($enlace['url']) ?>"><?= esc_html($enlace['texto']) ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-[clamp(56px,5vw,96px)] overflow-hidden">
            <span class="block" data-sr="wipe" data-sr-fast data-sr-early data-sr-delay="40"><?= copam_theme_image($logo, ['class' => 'block h-auto w-full brightness-0 invert', 'alt' => get_bloginfo('name'), 'fallback' => get_theme_file_uri('assets/img/logo-copam.svg')]) ?></span>
        </div>
    </footer>

    <?php get_template_part('template-parts/components/aviso-superior', null, ['parte' => 'flotante']); ?>
    <?php wp_footer(); ?>
</body>

</html>
