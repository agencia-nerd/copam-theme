<?php
defined('ABSPATH') || exit;

/*
 * Buzón de sugerencias (wp-form). Definición y reglas: inc/forms/buzon-sugerencias.php.
 * Lo muestra la sección buzon de Contacto. El campo Área (solo para trabajadores) y el placeholder del
 * mensaje según el tipo los maneja src/js/modules/buzon.js.
 *
 * El aviso del pie lleva el primer correo de Ajustes del sitio > Correos > Buzón de sugerencias.
 */
$form_id = COPAM_THEME_FORM_BUZON;
$destino = copam_theme_correos('buzon')[0] ?? '';
$privacy = get_privacy_policy_url() ?: home_url('/privacidad/');

$campo   = 'flex min-w-0 flex-col gap-2.5';
$control = 'box-border w-full rounded-[3px] border border-[#DADADA] bg-white px-4 text-[15px] text-ink outline-0 transition-[border-color] duration-300 hover:border-[#A6A6A6] focus:border-brand aria-invalid:shadow-[inset_0_0_0_1px_var(--color-danger)]';
$input   = $control . ' h-[52px]';
$error   = 'm-0 text-[13px] leading-[1.4] text-danger empty:hidden';
$opcional = '<span class="font-normal text-[#8C8C8C]"> (opcional)</span>';

$label = static function (string $key, string $texto, bool $obligatorio = true) use ($form_id, $opcional): void {
    printf(
        '<label class="text-sm font-medium text-ink" for="%s">%s%s</label>',
        esc_attr(copam_theme_field_id($form_id, $key)),
        esc_html($texto),
        $obligatorio ? '' : $opcional // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo
    );
};
$caja_error = static function (string $key) use ($form_id, $error): void {
    printf('<p class="%s" ', esc_attr($error));
    copam_theme_error_attrs($form_id, $key);
    echo '></p>';
};

// Opciones en píldora: radio real oculto a la vista; el punto y el borde siguen su estado.
// La opción por defecto va marcada en el HTML, así form.reset() vuelve a ella.
$radios = static function (string $key, string $leyenda, string $marcada, string $clase = '') use ($form_id, $caja_error): void { ?>
    <fieldset class="m-0 min-w-0 border-0 p-0 <?= esc_attr($clase) ?>">
        <legend class="p-0 text-sm font-medium text-ink"><?= esc_html($leyenda) ?></legend>
        <div class="mt-3.5 flex flex-wrap gap-2">
            <?php foreach (copam_theme_field_options($form_id, $key) as $valor => $texto) : ?>
                <label class="group flex h-11 cursor-pointer items-center gap-2.5 rounded-[3px] border border-[#DADADA] bg-white px-[18px] text-[15px] text-ink transition-[background-color,border-color] duration-300 has-checked:border-brand has-checked:bg-[#F0F8F3] has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-brand">
                    <input class="sr-only" <?php copam_theme_field_attrs($form_id, $key, $valor); ?><?php checked((string) $valor, $marcada); ?>>
                    <span class="relative block size-3.5 flex-none rounded-full border border-[#DADADA] bg-white transition-[border-color] duration-300 group-has-checked:border-brand" aria-hidden="true">
                        <span class="absolute inset-[3px] scale-0 rounded-full bg-brand transition-transform duration-[350ms] ease-in-out group-has-checked:scale-100"></span>
                    </span>
                    <span><?= esc_html((string) $texto) ?></span>
                </label>
            <?php endforeach; ?>
        </div>
        <?php $caja_error($key); ?>
    </fieldset>
<?php };
?>
<form class="min-w-0 rounded-md bg-[#F8F8F8] px-[clamp(20px,2.6vw,50px)] py-[clamp(24px,2.6vw,50px)]" data-sr="wipe" data-buzon <?php copam_theme_form_attrs($form_id); ?>>
    <?php $radios('quien', '¿Quién envía la sugerencia?', 'usuario'); ?>

    <div class="grid grid-rows-[0fr] opacity-0 transition-[grid-template-rows,opacity] duration-500 ease-out motion-reduce:transition-none data-abierto:grid-rows-[1fr] data-abierto:opacity-100" data-buzon-area>
        <div class="min-h-0 overflow-hidden">
            <fieldset class="m-0 min-w-0 border-0 px-0 pt-[18px] pb-0.5" disabled>
                <legend class="sr-only">Datos del trabajador</legend>
                <div class="<?= esc_attr($campo) ?>">
                    <?php $label('area', 'Área', false); ?>
                    <input class="<?= esc_attr($input) ?>" placeholder="Ej. Operaciones" <?php copam_theme_field_attrs($form_id, 'area'); ?>>
                    <?php $caja_error('area'); ?>
                </div>
                <p class="mt-3.5 mb-0 text-[13px] leading-normal text-gris-7a">Tu participación es parte de la consulta a los trabajadores de nuestro Sistema Integrado de Gestión.</p>
            </fieldset>
        </div>
    </div>

    <?php $radios('tipo', '¿Qué quieres compartir?', 'sugerencia', 'mt-[clamp(24px,1.9vw,36px)]'); ?>

    <div class="mt-[clamp(24px,1.9vw,36px)] <?= esc_attr($campo) ?>">
        <?php $label('mensaje', 'Mensaje'); ?>
        <textarea class="<?= esc_attr($control) ?> min-h-[150px] resize-y py-3.5 leading-normal" rows="5" placeholder="Escribe aquí tu sugerencia" data-buzon-mensaje
            data-placeholders="<?= esc_attr(wp_json_encode([
                'sugerencia'   => 'Escribe aquí tu sugerencia',
                'consulta'     => 'Escribe aquí tu consulta',
                'felicitacion' => 'Escribe aquí tu felicitación',
                'otro'         => 'Escribe aquí tu mensaje',
            ])) ?>" <?php copam_theme_field_attrs($form_id, 'mensaje'); ?>></textarea>
        <?php $caja_error('mensaje'); ?>
    </div>

    <div class="mt-[clamp(24px,1.9vw,36px)] grid grid-cols-[minmax(0,1fr)] gap-x-[clamp(16px,1.25vw,24px)] gap-y-[clamp(18px,1.4vw,26px)] min-[760px]:grid-cols-[minmax(0,1fr)_minmax(0,1fr)]">
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('nombre', 'Nombre', false); ?>
            <input class="<?= esc_attr($input) ?>" placeholder="Tu nombre" <?php copam_theme_field_attrs($form_id, 'nombre'); ?>>
            <?php $caja_error('nombre'); ?>
        </div>
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('correo', 'Correo electrónico', false); ?>
            <input class="<?= esc_attr($input) ?>" placeholder="nombre@empresa.com" <?php copam_theme_field_attrs($form_id, 'correo'); ?>>
            <?php $caja_error('correo'); ?>
        </div>
    </div>
    <p class="mt-3 mb-0 text-[13px] text-[#8C8C8C]">Déjalo en blanco si prefieres enviarla de forma anónima.</p>

    <?php copam_theme_form_honeypot(); ?>
    <div class="mt-[clamp(24px,1.9vw,36px)] flex flex-wrap items-center justify-between gap-5">
        <div class="flex flex-col gap-2.5 rounded bg-[#EBF4EE] px-4 py-3.5">
            <div class="flex items-center gap-2.5">
                <input class="m-0 size-4 flex-none accent-brand" <?php copam_theme_field_attrs($form_id, 'privacidad'); ?>>
                <label class="cursor-pointer text-sm leading-[1.4] text-ink" for="<?= esc_attr(copam_theme_field_id($form_id, 'privacidad')) ?>">
                    Acepto la <a class="text-ink underline underline-offset-[3px] hover:text-brand" href="<?= esc_url($privacy) ?>" target="_blank" rel="noopener">Política de privacidad<span class="sr-only"> (se abre en una pestaña nueva)</span></a> y el tratamiento de mis datos personales.
                </label>
            </div>
            <?php $caja_error('privacidad'); ?>
        </div>
        <button class="group flex h-[52px] cursor-pointer items-center justify-center rounded border-0 bg-brand px-[clamp(24px,1.8vw,34px)] text-[clamp(16px,.95vw,18px)] font-medium tracking-[.02em] text-white uppercase transition-colors duration-[350ms] hover:bg-brand-hover data-loading:cursor-wait data-loading:opacity-70" type="submit" data-loading-label="Enviando...">
            <span class="block h-[1.15em] overflow-hidden leading-[1.15em]">
                <span class="flex flex-col transition-transform duration-[550ms] ease-in-out group-hover:-translate-y-1/2">
                    <span class="whitespace-nowrap" data-submit-label>Enviar sugerencia</span>
                    <span class="whitespace-nowrap" aria-hidden="true">Enviar sugerencia</span>
                </span>
            </span>
        </button>
    </div>
    <p class="mt-4 mb-0 rounded bg-[#EBF4EE] px-4 py-3.5 text-[15px] leading-normal text-[#0B7A38] empty:hidden data-[state=error]:bg-transparent data-[state=error]:p-0 data-[state=error]:text-[13px] data-[state=error]:text-danger" data-form-status role="status" aria-live="polite"></p>
    <?php if ($destino !== '') : ?>
        <p class="mt-3.5 mb-0 text-[13px] leading-normal text-gris-7a">El buzón se envía a <a class="font-medium text-brand underline underline-offset-[3px]" href="<?= esc_url('mailto:' . $destino) ?>"><?= esc_html($destino) ?></a></p>
    <?php endif; ?>
</form>
