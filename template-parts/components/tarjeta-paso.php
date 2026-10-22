<?php
defined('ABSPATH') || exit;

/**
 * Tarjeta de paso (Reclamos: proceso, instancias y otros canales): número o etiqueta, título, texto con los plazos
 * en verde (marcador ~ de copam_theme_highlight), nota opcional y un enlace con flecha al pie.
 * Las columnas las decide el contenedor.
 *
 * $args:
 *  - numero   (string)  número grande sobre el título ("01")
 *  - etiqueta (string)  texto pequeño en mayúsculas sobre el título
 *  - titulo   (string, requerido)
 *  - texto    (string)  admite los marcadores de inc/helpers/text-styles.php
 *  - nota     (string)  línea pequeña bajo el texto
 *  - enlace   (array)   campo Link de ACF; sin destino válido no se imprime
 *  - archivo  (array)   campo File de ACF, se usa si no hay enlace (se abre en pestaña nueva)
 *  - texto_archivo (string) texto del enlace al archivo
 *  - datos    (array)   atributos data-* del enlace: ['tipo' => 'apelacion']
 *  - retardo  (int)     milisegundos de espera de la entrada
 */
$numero   = (string) ($args['numero'] ?? '');
$etiqueta = (string) ($args['etiqueta'] ?? '');
$titulo   = (string) ($args['titulo'] ?? '');
$texto    = (string) ($args['texto'] ?? '');
$nota     = (string) ($args['nota'] ?? '');
$enlace   = $args['enlace'] ?? null;
$archivo  = $args['archivo'] ?? null;
$datos    = (array) ($args['datos'] ?? []);
$retardo  = (int) ($args['retardo'] ?? 0);
if ($titulo === '') {
    return;
}

$texto_enlace = '';
$peso         = '';
if (copam_theme_link_data($enlace)) {
    $texto_enlace = trim((string) ($enlace['title'] ?? ''));
} elseif (is_array($archivo) && !empty($archivo['url'])) {
    $enlace       = ['url' => $archivo['url'], 'target' => '_blank'];
    $texto_enlace = trim((string) ($args['texto_archivo'] ?? ''));
    $peso         = 'PDF' . (!empty($archivo['filesize']) ? ' · ' . size_format((int) $archivo['filesize'], 0) : '');
} else {
    $enlace = null;
}
$link       = $enlace && $texto_enlace !== '' ? copam_theme_link_data($enlace) : null;
$abre_nueva = $link ? copam_theme_link_resolve($link, [])['blank'] : false;
// Flecha de esquina para lo que sale del sitio; flecha a la derecha para anclas, páginas y archivos propios.
$externo = $link && !$peso && preg_match('#^https?://#i', $link['url']) && strpos($link['url'], home_url()) !== 0;

$atributos = '';
foreach ($datos as $clave => $valor) {
    $atributos .= ' data-' . esc_attr((string) $clave) . '="' . esc_attr((string) $valor) . '"';
}
?>
<article class="flex min-w-0 flex-col items-start rounded bg-white px-[clamp(22px,1.7vw,32px)] pt-[clamp(28px,2.2vw,42px)] pb-[clamp(32px,2.6vw,50px)]" data-sr="card" data-sr-delay="<?= esc_attr((string) $retardo) ?>">
    <?php if ($numero !== '') : ?>
        <span class="block text-[clamp(30px,2.1vw,40px)] leading-none font-bold tracking-[-.01em] text-brand"><?= esc_html($numero) ?></span>
    <?php elseif ($etiqueta !== '') : ?>
        <span class="text-xs leading-[1.3] font-semibold tracking-[.14em] text-brand uppercase"><?= esc_html($etiqueta) ?></span>
    <?php endif; ?>
    <h3 class="mt-[clamp(18px,1.5vw,28px)] mb-0 text-[clamp(17px,1.05vw,20px)] leading-[1.3] font-semibold text-ink"><?= esc_html($titulo) ?></h3>
    <?php if ($texto !== '') : ?>
        <p class="mt-3 mb-0 text-[15px] leading-[1.6] text-pretty text-gris-7a"><?= copam_theme_highlight($texto) ?></p>
    <?php endif; ?>
    <?php if ($nota !== '') : ?>
        <p class="mt-3 mb-0 text-[13px] leading-normal text-pretty text-ink-muted"><?= esc_html($nota) ?></p>
    <?php endif; ?>
    <?php if ($link) : ?>
        <a<?= copam_theme_link_attrs($enlace, ['class' => 'mt-auto inline-flex items-center gap-2 pt-[clamp(22px,1.7vw,32px)] text-[15px] font-medium text-brand transition-colors duration-[250ms] hover:text-brand-hover']) ?><?= $peso !== '' ? ' title="' . esc_attr($peso) . '"' : '' ?><?= $atributos // phpcs:ignore WordPress.Security.EscapeOutput -- escapado arriba ?>>
            <?= esc_html($texto_enlace) ?>
            <svg width="12" height="12" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="<?= $externo ? 'M3 11L11 3M4.5 3H11v6.5' : 'M2 7h10M8 3l4 4-4 4' ?>" stroke="currentColor" stroke-width="1.6"></path></svg>
            <?php if ($abre_nueva) : ?><span class="sr-only">(<?= esc_html__('se abre en una pestaña nueva', 'copam-theme') ?>)</span><?php endif; ?>
        </a>
    <?php endif; ?>
</article>
