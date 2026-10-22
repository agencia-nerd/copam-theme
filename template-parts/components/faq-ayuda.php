<?php
defined('ABSPATH') || exit;

/**
 * Sección de preguntas frecuentes de las páginas internas: fondo gris con esquinas superiores redondeadas, encabezado con etiqueta
 * y el acordeón de preguntas (wp-accordion, vista template-parts/accordions/faq-ayuda.php).
 *
 * $args:
 *  - id          (string)  id de la sección, para los accesos directos ('faq' por defecto)
 *  - etiqueta    (string)  texto pequeño sobre el título
 *  - titulo      (string)  título (h2)
 *  - descripcion (string)  bajada bajo el título
 *  - items       (array)   cada uno ['pregunta' => string, 'respuesta' => string]
 */
$id    = (string) ($args['id'] ?? 'faq');
$items = array_values(array_filter((array) ($args['items'] ?? []), static fn($item): bool => trim((string) ($item['pregunta'] ?? '')) !== ''));
if (!$items && trim((string) ($args['titulo'] ?? '')) === '') {
    return;
}
?>
<section class="relative z-[1] rounded-t-[clamp(20px,2vw,36px)] bg-gris-f4 px-[clamp(20px,4.17vw,80px)] pt-[clamp(80px,6.6vw,128px)] pb-[clamp(88px,7.3vw,140px)]" id="<?= esc_attr($id) ?>" data-pila-tope>
    <?php get_template_part('template-parts/components/encabezado-seccion', null, [
        'etiqueta' => (string) ($args['etiqueta'] ?? ''),
        'titulo'   => (string) ($args['titulo'] ?? ''),
        'bajada'   => (string) ($args['descripcion'] ?? ''),
        'variante' => 'izquierda',
    ]); ?>
    <?php get_template_part('template-parts/accordions/faq-ayuda', null, ['id' => $id . '-preguntas', 'items' => $items]); ?>
</section>
