<?php
defined('ABSPATH') || exit;

/**
 * Reclamos · ¿no estás conforme?: título, párrafo, nota y las tarjetas de las instancias (reconsideración,
 * apelación y queja ante OSITRAN) sobre una banda gris. Un botón que lleva a #formulario lleva el tipo según el
 * título de su tarjeta y lo deja elegido en el formulario (reclamos.js).
 * Lee el grupo `reclamos_conforme` (ACF).
 */
$grupo      = get_field('reclamos_conforme') ?: [];
$texto      = (string) ($grupo['texto'] ?? '');
$nota       = (string) ($grupo['nota'] ?? '');
$instancias = array_values(array_filter((array) ($grupo['instancias'] ?? []), static fn($i): bool => trim((string) ($i['titulo'] ?? '')) !== ''));

// Tipo de solicitud que elige el botón, según el título de la tarjeta.
$tipo_de = static function (string $titulo): string {
    $titulo = remove_accents(strtolower($titulo));
    if (strpos($titulo, 'reconsideracion') !== false) {
        return 'reconsideracion';
    }
    return strpos($titulo, 'apelacion') !== false ? 'apelacion' : '';
};
?>
<section class="relative z-[1] bg-white pt-[clamp(72px,6vw,116px)] pb-[clamp(88px,7.3vw,140px)]" id="conforme">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => (string) ($grupo['titulo'] ?? '')]); ?>
        <?php if ($texto !== '') : ?>
            <p class="mt-[clamp(16px,1.3vw,24px)] mb-0 max-w-[720px] text-[15px] leading-[1.6] text-pretty text-ink-muted" data-sr="clip" data-sr-delay="200"><?= esc_html($texto) ?></p>
        <?php endif; ?>
        <?php if ($nota !== '') : ?>
            <p class="mt-3 mb-0 max-w-[720px] text-[15px] leading-[1.6] font-medium text-pretty text-ink" data-sr="clip" data-sr-delay="240"><?= esc_html($nota) ?></p>
        <?php endif; ?>
    </div>
    <?php if ($instancias) : ?>
        <div class="relative mt-[clamp(26px,2.1vw,40px)]" id="queja">
            <div class="absolute inset-0 bg-[linear-gradient(90deg,var(--color-gris-e4),var(--color-gris-ee)_60%,var(--color-gris-e9))]" data-sr="band" aria-hidden="true"></div>
            <div class="relative grid grid-cols-[minmax(0,1fr)] gap-1 px-[clamp(20px,4.17vw,80px)] py-1 sm:grid-cols-[repeat(2,minmax(0,1fr))] xl:grid-cols-[repeat(3,minmax(0,1fr))]">
                <?php foreach ($instancias as $i => $instancia) {
                    $boton = $instancia['boton'] ?? null;
                    $url   = (string) (copam_theme_link_data($boton)['url'] ?? '');
                    $tipo  = substr($url, -strlen('#formulario')) === '#formulario' ? $tipo_de((string) $instancia['titulo']) : '';
                    get_template_part('template-parts/components/tarjeta-paso', null, [
                        'etiqueta' => (string) ($instancia['etiqueta'] ?? ''),
                        'titulo'   => (string) $instancia['titulo'],
                        'texto'    => (string) ($instancia['descripcion'] ?? ''),
                        'enlace'   => $boton,
                        'datos'    => $tipo !== '' ? ['tipo' => $tipo] : [],
                        'retardo'  => ($i % 3) * 110,
                    ]);
                } ?>
            </div>
        </div>
    <?php endif; ?>
</section>
