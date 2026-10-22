<?php
defined('ABSPATH') || exit;

/**
 * Cabecera del sitio: barra con logo, menú por grupos (escritorio) o menú compacto (móvil), buscador y aviso.
 * El logo sale de Personalizar > Identidad del sitio y el menú de Apariencia > Menús (ubicación `principal`);
 * ambos se cargan solos con el contenido inicial (inc/acf/). Comportamiento: src/js/modules/header.js.
 */
$indice = copam_theme_sitio_indice_busqueda();
$logo   = get_theme_mod('custom_logo');

// Cada elemento de primer nivel es un grupo; sus hijos son los enlaces del panel (los `subtitulo` no llevan enlace).
$menu = array_map(static function (array $grupo): array {
    return [
        'etiqueta' => $grupo['texto'],
        'enlaces'  => array_map(static fn(array $hijo): array => $hijo['subtitulo']
            ? ['subtitulo' => $hijo['texto']]
            : ['texto' => $hijo['texto'], 'url' => $hijo['url'], 'externo' => $hijo['externo']], $grupo['hijos']),
    ];
}, copam_theme_sitio_menu('principal'));

// Los retardos del escalonado van como clases completas para que Tailwind las detecte.
$retardo_enlace = ['group-abierto/m:delay-100', 'group-abierto/m:delay-[140ms]', 'group-abierto/m:delay-[180ms]', 'group-abierto/m:delay-[220ms]', 'group-abierto/m:delay-[260ms]', 'group-abierto/m:delay-[300ms]', 'group-abierto/m:delay-[340ms]', 'group-abierto/m:delay-[380ms]', 'group-abierto/m:delay-[420ms]'];
$retardo_grupo  = ['group-data-[menu-abierto]/nav:delay-[250ms]', 'group-data-[menu-abierto]/nav:delay-[310ms]', 'group-data-[menu-abierto]/nav:delay-[370ms]', 'group-data-[menu-abierto]/nav:delay-[430ms]', 'group-data-[menu-abierto]/nav:delay-[490ms]', 'group-data-[menu-abierto]/nav:delay-[550ms]'];

$flecha_externa = '<svg class="flex-none opacity-0 transition-[opacity,translate] duration-250 ease-out -translate-x-1 translate-y-1 group-hover/e:translate-x-0 group-hover/e:translate-y-0 group-hover/e:opacity-100 group-focus-visible/e:translate-x-0 group-focus-visible/e:translate-y-0 group-focus-visible/e:opacity-100" width="12" height="12" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M3 11L11 3M4.5 3H11v6.5" stroke="currentColor" stroke-width="1.6"></path></svg>';
$lupa = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true"><circle cx="8.5" cy="8.5" r="6" stroke="#fff" stroke-width="1.8"></circle><path d="M13 13l5 5" stroke="#fff" stroke-width="1.8"></path></svg>';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php
    // Pantalla de carga: solo se ve con la clase `precarga` en <html> (primera visita de la sesión, con efectos).
    $logo_datos = copam_theme_image_data($logo);
    $logo_url   = $logo_datos['url'] ?? get_theme_file_uri('assets/img/logo-copam.svg');
    $mascara    = '[-webkit-mask:var(--logo)_center/contain_no-repeat] [mask:var(--logo)_center/contain_no-repeat]';
    ?>
    <div class="fixed inset-0 z-[10001] hidden place-items-center bg-brand transition-[background-color] duration-[600ms] precarga:grid" data-precarga aria-hidden="true">
        <div class="relative aspect-[174/30] w-[min(320px,64vw)]" style="--logo:url('<?= esc_url($logo_url) ?>')" data-precarga-caja>
            <div class="absolute inset-0 bg-white/[.22] <?= esc_attr($mascara) ?>" data-precarga-base></div>
            <div class="absolute inset-0 bg-white [clip-path:inset(100%_0_0_0)] <?= esc_attr($mascara) ?>" data-precarga-relleno></div>
            <img class="absolute inset-0 block size-full object-contain opacity-0" src="<?= esc_url($logo_url) ?>" alt="" data-precarga-logo>
        </div>
    </div>
    <a class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-[60] focus:rounded focus:bg-ink focus:px-4 focus:py-2 focus:text-white" href="#main-content"><?= esc_html__('Saltar al contenido', 'copam-theme') ?></a>

    <header class="group/nav pointer-events-none sticky top-0 z-50 h-16" data-header>
        <div class="pointer-events-auto flex items-center justify-between gap-6 bg-white px-[clamp(20px,4.17vw,80px)] py-2 transition-[box-shadow,padding,background-color] duration-500 group-data-[scrolled]/nav:shadow-[0_6px_18px_-10px_rgba(0,0,0,.10)] group-data-[oscuro]/nav:bg-[rgba(20,24,26,.58)] group-data-[oscuro]/nav:shadow-none group-data-[oscuro]/nav:backdrop-blur-[14px] group-data-[oscuro]/nav:backdrop-saturate-[1.4]">
            <a class="block flex-none overflow-hidden transition-transform duration-[450ms] ease-out hover:scale-[1.03]" href="<?= esc_url(home_url('/')) ?>">
                <span class="block" data-drop><?= copam_theme_image($logo, ['class' => 'block h-auto w-[clamp(150px,10.4vw,202px)] transition-[filter] duration-500 group-data-[oscuro]/nav:brightness-0 group-data-[oscuro]/nav:invert', 'alt' => get_bloginfo('name'), 'loading' => 'eager', 'fallback' => get_theme_file_uri('assets/img/logo-copam.svg')]) ?></span>
            </a>

            <nav class="hidden items-center gap-2 xl:flex" aria-label="<?= esc_attr__('Principal', 'copam-theme') ?>">
                <?php foreach ($menu as $i => $grupo) : ?>
                    <div class="group/m relative" data-menu>
                        <div class="overflow-hidden rounded">
                            <button class="flex h-[46px] cursor-pointer items-center gap-3 rounded border-0 bg-gris-f2 px-[clamp(14px,1.25vw,24px)] text-xs leading-none font-medium tracking-[.02em] whitespace-nowrap text-ink uppercase transition-[background-color,color] duration-300 group-abierto/m:bg-gris-e7 group-data-[oscuro]/nav:bg-white/[.08] group-data-[oscuro]/nav:text-white group-data-[oscuro]/nav:group-abierto/m:bg-white/[.18]" type="button" data-drop data-menu-boton aria-expanded="false" aria-haspopup="true" aria-controls="menu-<?= esc_attr((string) $i) ?>">
                                <span><?= esc_html($grupo['etiqueta']) ?></span>
                                <span class="size-1 rounded-full bg-ink transition-[scale,background-color] duration-[450ms] ease-in-out group-abierto/m:scale-[1.75] group-abierto/m:bg-brand group-data-[oscuro]/nav:bg-white group-data-[oscuro]/nav:group-abierto/m:bg-brand" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="invisible absolute top-full left-0 min-w-[max(100%,260px)] pt-2 transition-[visibility] delay-200 duration-0 group-abierto/m:visible group-abierto/m:delay-0" id="menu-<?= esc_attr((string) $i) ?>">
                            <div class="rounded bg-ink p-2 [clip-path:inset(0_0_100%_0_round_4px)] -translate-y-1 transition-[clip-path,translate] duration-200 ease-in group-abierto/m:translate-y-0 group-abierto/m:[clip-path:inset(0_0_0_0_round_4px)] group-abierto/m:duration-500 group-abierto/m:ease-[cubic-bezier(.16,1,.3,1)]">
                                <?php foreach ($grupo['enlaces'] as $j => $enlace) : ?>
                                    <div class="overflow-hidden">
                                        <?php if (isset($enlace['subtitulo'])) : ?>
                                            <div class="<?= $j ? 'mt-1.5 border-t border-[#3E3E3E] px-3.5 pt-3.5 pb-1' : 'px-3.5 pt-2 pb-1' ?> -translate-y-[60%] text-xs font-semibold tracking-[.12em] text-gris-9a uppercase opacity-0 transition-[translate,opacity] duration-150 ease-in group-abierto/m:translate-y-0 group-abierto/m:opacity-100 group-abierto/m:duration-[550ms] group-abierto/m:ease-[cubic-bezier(.16,1,.3,1)] <?= esc_attr($retardo_enlace[min($j, 8)]) ?>"><?= esc_html($enlace['subtitulo']) ?></div>
                                        <?php else : ?>
                                            <a class="group/e flex -translate-y-[60%] items-center justify-between gap-4 rounded-[3px] px-3.5 py-3 text-[15px] text-gris-f2 opacity-0 transition-[translate,opacity,background-color,color] duration-150 ease-in hover:bg-gris-3a hover:text-white group-abierto/m:translate-y-0 group-abierto/m:opacity-100 group-abierto/m:duration-[550ms] group-abierto/m:ease-[cubic-bezier(.16,1,.3,1)] <?= esc_attr($retardo_enlace[min($j, 8)]) ?>" href="<?= esc_url($enlace['url']) ?>"<?= $enlace['externo'] ? ' target="_blank" rel="noopener noreferrer"' : '' ?>>
                                                <span><?= esc_html($enlace['texto']) ?></span>
                                                <?php if ($enlace['externo']) : ?><?= $flecha_externa ?><span class="sr-only"><?= esc_html__('(se abre en una pestaña nueva)', 'copam-theme') ?></span><?php endif; ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="ml-1 overflow-hidden rounded">
                    <button class="group/b grid h-12 w-[72px] cursor-pointer place-items-center rounded border-0 bg-brand transition-colors duration-300 hover:bg-brand-hover" type="button" data-drop data-buscar-abrir aria-label="<?= esc_attr__('Buscar', 'copam-theme') ?>" aria-expanded="false" aria-controls="buscador">
                        <span class="block size-5 overflow-hidden" aria-hidden="true">
                            <span class="flex flex-col transition-transform duration-[550ms] ease-in-out group-hover/b:-translate-y-1/2"><?= $lupa . $lupa ?></span>
                        </span>
                    </button>
                </div>
            </nav>

            <div class="flex items-center gap-2 xl:hidden">
                <div class="size-12 flex-none overflow-hidden rounded">
                    <button class="grid size-12 flex-none cursor-pointer place-items-center rounded border-0 bg-brand p-0" type="button" data-drop data-buscar-abrir aria-label="<?= esc_attr__('Buscar', 'copam-theme') ?>" aria-expanded="false" aria-controls="buscador"><?= $lupa ?></button>
                </div>
                <div class="size-12 flex-none overflow-hidden rounded">
                    <button class="relative block size-12 flex-none cursor-pointer rounded border-0 bg-ink p-0" type="button" data-drop data-menu-movil-boton aria-label="<?= esc_attr__('Menú', 'copam-theme') ?>" aria-expanded="false" aria-controls="menu-movil">
                        <span class="absolute top-[23px] left-[15px] h-[1.8px] w-[18px] -translate-y-1 bg-white transition-transform duration-500 ease-in-out group-data-[menu-abierto]/nav:translate-y-0 group-data-[menu-abierto]/nav:rotate-45" aria-hidden="true"></span>
                        <span class="absolute top-[23px] left-[15px] h-[1.8px] w-[18px] translate-y-1 bg-white transition-transform duration-500 ease-in-out group-data-[menu-abierto]/nav:translate-y-0 group-data-[menu-abierto]/nav:-rotate-45" aria-hidden="true"></span>
                    </button>
                </div>
            </div>

            <div class="fixed inset-0 -z-10 overflow-y-auto overscroll-contain bg-white px-[clamp(20px,4.17vw,80px)] pt-24 pb-10 [clip-path:inset(0_0_0_100%)] transition-[clip-path] duration-[750ms] ease-in-out group-data-[menu-abierto]/nav:[clip-path:inset(0_0_0_0)] group-data-[aviso]/nav:pt-[136px] xl:hidden" id="menu-movil" data-menu-movil data-native-scroll inert>
                <div class="flex flex-col gap-10">
                    <?php foreach ($menu as $i => $grupo) : ?>
                        <div class="overflow-hidden">
                            <div class="flex translate-y-[110%] flex-col gap-4 transition-transform duration-[800ms] ease-out group-data-[menu-abierto]/nav:translate-y-0 <?= esc_attr($retardo_grupo[min($i, 5)]) ?>">
                                <span class="text-[26px] font-bold tracking-[-.01em] uppercase"><?= esc_html($grupo['etiqueta']) ?></span>
                                <div class="-mt-1.5 flex flex-col gap-1">
                                    <?php foreach ($grupo['enlaces'] as $j => $enlace) : ?>
                                        <?php if (isset($enlace['subtitulo'])) : ?>
                                            <span class="block <?= $j ? 'mt-2.5 border-t border-[#E6E6E6] pt-3.5 pb-0.5' : 'pt-1 pb-0.5' ?> text-xs font-semibold tracking-[.12em] text-ink-muted uppercase"><?= esc_html($enlace['subtitulo']) ?></span>
                                        <?php else : ?>
                                            <a class="block py-[9px] text-base text-gris-5a" href="<?= esc_url($enlace['url']) ?>"<?= $enlace['externo'] ? ' target="_blank" rel="noopener noreferrer"' : '' ?>><?= esc_html($enlace['texto']) ?><?php if ($enlace['externo']) : ?><span class="sr-only"> <?= esc_html__('(se abre en una pestaña nueva)', 'copam-theme') ?></span><?php endif; ?></a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php get_template_part('template-parts/components/aviso-superior', null, ['parte' => 'franja']); ?>
    </header>
    <?php get_template_part('template-parts/components/aviso-superior', null, ['parte' => 'espaciador']); ?>

    <div class="group/b pointer-events-none invisible fixed inset-x-0 top-16 bottom-0 z-[49] transition-[visibility] delay-[800ms] duration-0 data-[abierto]:pointer-events-auto data-[abierto]:visible data-[abierto]:delay-0" id="buscador" role="dialog" aria-modal="true" aria-label="<?= esc_attr__('Buscar', 'copam-theme') ?>" data-buscador data-indice="<?= esc_attr(wp_json_encode($indice, JSON_UNESCAPED_UNICODE)) ?>" inert>
        <div class="absolute inset-0 bg-[rgba(18,18,18,0)] backdrop-blur-none transition-[background-color,backdrop-filter] delay-[250ms] duration-[800ms] ease-out group-data-[abierto]/b:bg-[rgba(18,18,18,.5)] group-data-[abierto]/b:backdrop-blur-[12px] group-data-[abierto]/b:delay-0" data-buscar-cerrar></div>
        <div class="pointer-events-none relative flex flex-col items-center gap-2 px-[clamp(20px,4.17vw,80px)] pt-[clamp(16px,1.6vw,28px)]">
            <div class="pointer-events-auto w-[min(100%,760px)] overflow-hidden rounded-md">
                <form class="flex h-16 -translate-y-[110%] items-center gap-3 rounded-md bg-white pr-2 pl-6 transition-transform duration-[750ms] ease-out group-data-[abierto]/b:translate-y-0 group-data-[abierto]/b:delay-[220ms]" role="search" data-buscar-form>
                    <svg class="flex-none" width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true"><circle cx="8.5" cy="8.5" r="6" stroke="#2B2B2B" stroke-width="1.8"></circle><path d="M13 13l5 5" stroke="#2B2B2B" stroke-width="1.8"></path></svg>
                    <label class="sr-only" for="buscador-texto"><?= esc_html__('Buscar servicios, reglamentos, comunicados', 'copam-theme') ?></label>
                    <input class="h-full min-w-0 flex-1 border-0 bg-transparent text-[clamp(16px,1vw,18px)] text-ink outline-0 placeholder:text-gris-8a" id="buscador-texto" type="text" inputmode="search" enterkeyhint="search" autocomplete="off" placeholder="<?= esc_attr__('Buscar servicios, reglamentos, comunicados…', 'copam-theme') ?>" data-buscar-texto>
                    <button class="group/g flex h-12 flex-none cursor-pointer items-center rounded border-0 bg-brand px-[22px] text-[15px] font-medium tracking-[.02em] text-white uppercase transition-colors duration-[350ms] hover:bg-brand-hover" type="submit">
                        <span class="block h-[1.15em] overflow-hidden leading-[1.15em]"><span class="flex flex-col transition-transform duration-[550ms] ease-in-out group-hover/g:-translate-y-1/2"><span><?= esc_html__('Buscar', 'copam-theme') ?></span><span aria-hidden="true"><?= esc_html__('Buscar', 'copam-theme') ?></span></span></span>
                    </button>
                    <button class="grid size-12 flex-none cursor-pointer place-items-center rounded border-0 bg-gris-f2" type="button" data-buscar-cerrar aria-label="<?= esc_attr__('Cerrar búsqueda', 'copam-theme') ?>">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M2 2l10 10M12 2L2 12" stroke="#2B2B2B" stroke-width="1.6"></path></svg>
                    </button>
                </form>
            </div>
            <div class="pointer-events-auto w-[min(100%,760px)] overflow-hidden rounded-md">
                <div class="max-h-[min(62vh,540px)] -translate-y-[110%] overflow-y-auto overscroll-contain rounded-md bg-white p-2 transition-transform duration-[800ms] ease-out group-data-[abierto]/b:translate-y-0 group-data-[abierto]/b:delay-[340ms]" data-buscar-resultados data-native-scroll aria-live="polite">
                    <div class="flex justify-between gap-4 px-3.5 pt-2.5 pb-2 text-xs font-medium tracking-[.08em] text-gris-8a uppercase">
                        <span data-buscar-titulo><?= esc_html__('Sugerencias', 'copam-theme') ?></span>
                        <span class="flex-none whitespace-nowrap" data-buscar-cuenta></span>
                    </div>
                    <div data-buscar-lista></div>
                    <div class="hidden px-3.5 pt-[22px] pb-[26px] text-[15px] leading-normal text-gris-5a" data-buscar-vacio><?= esc_html__('No encontramos resultados para', 'copam-theme') ?> <strong class="text-ink" data-buscar-consulta></strong>. <?= esc_html__('Prueba con “tarifario”, “reglamento” o “documento 123”.', 'copam-theme') ?></div>
                </div>
            </div>
        </div>
    </div>
