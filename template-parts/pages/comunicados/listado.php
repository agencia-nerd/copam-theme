<?php
defined('ABSPATH') || exit;

/**
 * Comunicados · listado: contador y rejilla de tarjetas con las entradas de la consulta principal
 * (home.php, category.php o search.php; 9 por página según Ajustes › Lectura).
 */
global $wp_query;

$total  = (int) $wp_query->found_posts;
$en_pag = (int) $wp_query->post_count;
$desde  = ((max(1, (int) get_query_var('paged')) - 1) * (int) get_query_var('posts_per_page')) + 1;

$contador = (int) $wp_query->max_num_pages > 1
    /* translators: 1: primer comunicado de la página, 2: último, 3: total */
    ? sprintf(__('Mostrando %1$d–%2$d de %3$d comunicados', 'copam-theme'), $desde, $desde + $en_pag - 1, $total)
    /* translators: %d: cantidad de comunicados */
    : sprintf(_n('Mostrando %d comunicado', 'Mostrando %d comunicados', $total, 'copam-theme'), $total);
?>
<p class="mx-[clamp(20px,4.17vw,80px)] mt-[clamp(24px,2vw,38px)] mb-0 text-sm text-gris-7a" data-sr="clip" data-sr-delay="260"><?= esc_html($contador) ?></p>

<div class="relative mt-[clamp(18px,1.6vw,30px)] border-t border-line">
    <div class="rejilla-comunicados rejilla-comunicados--lista">
        <?php
        $i = 0;
        while (have_posts()) :
            the_post();
            // Entrada escalonada como en el diseño (calculada sobre 3 columnas).
            get_template_part('template-parts/components/comunicado-card', null, copam_theme_comunicado() + [
                'variante' => 'tarjeta',
                'retardo'  => ($i % 3) * 110 + intdiv($i, 3) * 90,
            ]);
            $i++;
        endwhile;
        ?>
    </div>
</div>
