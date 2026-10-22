<?php
defined('ABSPATH') || exit;

/**
 * Comunicado · otros: título fijo y los 2 comunicados más recientes distintos del actual.
 * Sin otros comunicados, la sección no se muestra.
 */
$titulo = __('Otros comunicados', 'copam-theme');
$otros  = get_posts([
    'numberposts'         => 2,
    'post__not_in'        => [get_the_ID()],
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
]);
if (!$otros) {
    return;
}
?>
<section class="relative z-[1] bg-white py-[clamp(88px,7.3vw,140px)]" id="otros" aria-label="<?= esc_attr($titulo) ?>">
    <div class="px-[clamp(20px,4.17vw,80px)]">
        <?php get_template_part('template-parts/components/titulo-linea', null, ['titulo' => $titulo]); ?>
    </div>
    <div class="relative mt-[clamp(26px,2.1vw,40px)] border-y border-line">
        <div class="rejilla-comunicados rejilla-comunicados--otros">
            <?php foreach ($otros as $i => $otro) :
                get_template_part('template-parts/components/comunicado-card', null, copam_theme_comunicado($otro) + [
                    'variante' => 'tarjeta',
                    'retardo'  => $i * 110,
                ]);
            endforeach; ?>
        </div>
    </div>
</section>
