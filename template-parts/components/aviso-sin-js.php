<?php
defined('ABSPATH') || exit;

/**
 * Aviso dentro de un form cuando el navegador no ejecuta JavaScript: el envío es por AJAX (wp-form), así que
 * sin JS el form no puede enviarse y se ofrece el correo del área como canal alternativo.
 *
 * $args:
 *  - correo (string)  correo del área; sin él solo se pide activar JavaScript
 */
$correo = sanitize_email((string) ($args['correo'] ?? ''));
?>
<noscript>
    <p class="mt-0 mb-[clamp(20px,1.6vw,30px)] rounded bg-[#FFF6DB] px-4 py-3.5 text-[15px] leading-normal text-ink">
        <?= esc_html__('Para enviar este formulario necesitas activar JavaScript en tu navegador.', 'copam-theme') ?>
        <?php if ($correo !== '') : ?>
            <?= esc_html__('También puedes escribirnos a', 'copam-theme') ?>
            <a class="font-medium text-ink underline underline-offset-[3px]" href="<?= esc_url('mailto:' . $correo) ?>"><?= esc_html($correo) ?></a>.
        <?php endif; ?>
    </p>
</noscript>
