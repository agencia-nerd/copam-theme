<?php
defined('ABSPATH') || exit;

/*
 * Formulario de reclamos, reconsideraciones y apelaciones (wp-form). Definición y reglas: inc/forms/reclamos.php.
 * La muestra la sección formulario de Reclamos. Comportamiento propio (nota según el tipo, campos de la
 * resolución, mismo domicilio, representación y archivos): src/js/modules/reclamos.js.
 *
 * $args:
 *  - notas              (array)  ['reclamo' => texto, 'reconsideracion' => texto, 'apelacion' => texto]
 *  - procedimiento      (array)  ['texto' => string, 'archivo' => campo File de ACF]
 *  - nota_envio         (string) texto antes del correo de destino
 */
$form_id       = COPAM_THEME_FORM_RECLAMOS;
$notas         = array_filter((array) ($args['notas'] ?? []), static fn($nota): bool => trim((string) $nota) !== '');
$procedimiento = (array) ($args['procedimiento'] ?? []);
$proc_archivo  = $procedimiento['archivo'] ?? null;
$proc_texto    = trim((string) ($procedimiento['texto'] ?? ''));
$proc_enlace   = is_array($proc_archivo) && !empty($proc_archivo['url']) && $proc_texto !== '' ? ['url' => $proc_archivo['url'], 'target' => '_blank'] : null;
$nota_envio    = (string) ($args['nota_envio'] ?? '');
$destino       = copam_theme_correos('reclamos')[0] ?? '';
$privacy       = get_privacy_policy_url() ?: home_url('/privacidad/');
$ajax          = admin_url('admin-ajax.php');

$dos_col  = 'grid grid-cols-[minmax(0,1fr)] gap-x-[clamp(16px,1.25vw,24px)] gap-y-[clamp(18px,1.4vw,26px)] min-[760px]:grid-cols-[minmax(0,1fr)_minmax(0,1fr)]';
$campo    = 'flex min-w-0 flex-col gap-2.5';
$etiqueta = 'text-sm font-medium text-ink';
$control  = 'box-border w-full rounded-[3px] border border-[#DADADA] bg-white px-4 text-base text-ink outline-0 transition-[border-color] duration-300 hover:border-[#A6A6A6] focus:border-brand aria-invalid:shadow-[inset_0_0_0_1px_var(--color-danger)] disabled:bg-gris-f4';
$input    = $control . ' h-[52px]';
$area     = $control . ' resize-y py-3.5 leading-normal';
$error    = 'm-0 text-[13px] leading-[1.4] text-danger empty:hidden';
$titulo   = 'm-0 text-[clamp(16px,1vw,18px)] font-semibold text-ink';
$linea    = '<span class="my-[clamp(26px,2.1vw,40px)] block h-px bg-[#E6E6E6]" aria-hidden="true"></span>';
$req      = '<span class="text-brand" aria-hidden="true"> *</span>';
$opcional = '<span class="font-normal text-[#8C8C8C]"> (opcional)</span>';
$check    = 'm-0 size-4 flex-none accent-brand';

$label = static function (string $key, string $texto, bool $obligatorio = true) use ($form_id, $etiqueta, $req, $opcional): void {
    printf(
        '<label class="%s" for="%s">%s%s</label>',
        esc_attr($etiqueta),
        esc_attr(copam_theme_field_id($form_id, $key)),
        esc_html($texto),
        $obligatorio ? $req : $opcional // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo
    );
};
$caja_error = static function (string $key) use ($form_id, $error): void {
    printf('<p class="%s" ', esc_attr($error));
    copam_theme_error_attrs($form_id, $key);
    echo '></p>';
};
// Casilla con su etiqueta a la derecha.
$casilla = static function (string $key, string $html) use ($form_id, $check): void { ?>
    <div class="flex items-center gap-2.5">
        <input class="<?= esc_attr($check) ?>" <?php copam_theme_field_attrs($form_id, $key); ?>>
        <label class="cursor-pointer text-sm leading-[1.4] text-ink" for="<?= esc_attr(copam_theme_field_id($form_id, $key)) ?>"><?= $html // phpcs:ignore WordPress.Security.EscapeOutput -- marcado armado y escapado por quien llama ?></label>
    </div>
<?php };
?>
<form class="mt-[clamp(28px,2.4vw,46px)] rounded-md bg-white px-[clamp(20px,1.9vw,36px)] pt-[clamp(26px,2.5vw,48px)] pb-[clamp(26px,2.3vw,44px)] [&_[data-error-for]]:mt-0" data-reclamos data-sr="clip" method="post" <?php copam_theme_form_attrs($form_id); ?>>
    <?php get_template_part('template-parts/components/aviso-sin-js', null, ['correo' => $destino]); ?>
    <fieldset class="m-0 min-w-0 border-0 p-0">
        <legend class="p-0 <?= esc_attr($titulo) ?>">Tipo de solicitud<?= $req // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?></legend>
        <div class="mt-4 flex flex-wrap gap-2">
            <?php foreach (copam_theme_field_options($form_id, 'tipo') as $valor => $texto) : ?>
                <label class="group flex h-11 cursor-pointer items-center gap-2.5 rounded-[3px] border border-[#DADADA] bg-white px-[18px] text-[15px] text-ink transition-[background-color,border-color] duration-300 has-checked:border-brand has-checked:bg-[#F0F8F3] has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-brand has-aria-invalid:border-danger">
                    <input class="sr-only" <?php copam_theme_field_attrs($form_id, 'tipo', $valor); ?><?= $valor === 'reclamo' ? ' checked' : '' ?>>
                    <span class="relative block size-3.5 flex-none rounded-full border border-[#DADADA] bg-white transition-[border-color] duration-300 group-has-checked:border-brand" aria-hidden="true">
                        <span class="absolute inset-[3px] scale-0 rounded-full bg-brand transition-transform duration-[350ms] ease-in-out group-has-checked:scale-100"></span>
                    </span>
                    <?= esc_html((string) $texto) ?>
                </label>
            <?php endforeach; ?>
        </div>
        <?php $caja_error('tipo'); ?>
    </fieldset>
    <?php if ($notas || $proc_enlace) : ?>
        <div class="mt-3.5" aria-live="polite">
            <?php foreach ($notas as $tipo => $nota) : ?>
                <p class="m-0 max-w-[640px] text-[13px] leading-normal text-pretty text-ink-muted" data-reclamos-nota="<?= esc_attr((string) $tipo) ?>"<?= $tipo !== 'reclamo' ? ' hidden' : '' ?>><?= esc_html((string) $nota) ?></p>
            <?php endforeach; ?>
            <?php if ($proc_enlace) : ?>
                <a<?= copam_theme_link_attrs($proc_enlace, ['class' => 'mt-2 inline-block text-[13px] font-medium text-brand transition-colors duration-[250ms] hover:text-brand-hover']) ?> title="<?= esc_attr('PDF' . (!empty($proc_archivo['filesize']) ? ' · ' . size_format((int) $proc_archivo['filesize'], 0) : '')) ?>"><?= esc_html($proc_texto) ?><span class="sr-only"> (<?= esc_html__('se abre en una pestaña nueva', 'copam-theme') ?>)</span></a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php // Solo con Reconsideración o Apelación: la resolución que se impugna. ?>
    <div class="grid grid-rows-[0fr] opacity-0 transition-[grid-template-rows,opacity] duration-500 ease-out motion-reduce:transition-none data-abierto:grid-rows-[1fr] data-abierto:opacity-100" data-reclamos-recurso>
        <div class="min-h-0 overflow-hidden">
            <fieldset class="m-0 min-w-0 border-0 px-0 pt-[18px] pb-0.5" disabled>
                <legend class="sr-only">Resolución que impugnas</legend>
                <div class="<?= esc_attr($dos_col) ?>">
                    <div class="<?= esc_attr($campo) ?>">
                        <?php $label('nro_reclamo', 'N.° de reclamo'); ?>
                        <input class="<?= esc_attr($input) ?>" placeholder="Ej. 000123" <?php copam_theme_field_attrs($form_id, 'nro_reclamo'); ?>>
                        <?php $caja_error('nro_reclamo'); ?>
                    </div>
                    <div class="<?= esc_attr($campo) ?>">
                        <?php $label('resolucion', 'N.° y fecha de la resolución que impugnas'); ?>
                        <input class="<?= esc_attr($input) ?>" placeholder="Ej. Res. N.° 045-2026 · 12-08-2026" <?php copam_theme_field_attrs($form_id, 'resolucion'); ?>>
                        <?php $caja_error('resolucion'); ?>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

    <?= $linea // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
    <h3 class="<?= esc_attr($titulo) ?>">Datos del solicitante</h3>
    <div class="mt-[18px] <?= esc_attr($dos_col) ?>">
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('nombre', 'Nombre y apellidos'); ?>
            <input class="<?= esc_attr($input) ?>" placeholder="Ingresa tu nombre completo" <?php copam_theme_field_attrs($form_id, 'nombre'); ?>>
            <?php $caja_error('nombre'); ?>
        </div>
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('documento', 'DNI, CE o RUC'); ?>
            <input class="<?= esc_attr($input) ?>" placeholder="Ej.: 45678912 o 20543480291" <?php copam_theme_field_attrs($form_id, 'documento'); ?>>
            <?php $caja_error('documento'); ?>
        </div>
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('domicilio', 'Domicilio'); ?>
            <input class="<?= esc_attr($input) ?>" placeholder="Dirección completa" data-reclamos-domicilio <?php copam_theme_field_attrs($form_id, 'domicilio'); ?>>
            <?php $caja_error('domicilio'); ?>
        </div>
        <div class="flex min-w-0 flex-col gap-3">
            <div class="<?= esc_attr($campo) ?>">
                <?php $label('domicilio_notif', 'Domicilio para notificaciones'); ?>
                <input class="<?= esc_attr($input) ?> read-only:bg-gris-f4" placeholder="Dirección donde recibirás las notificaciones" data-reclamos-notificaciones <?php copam_theme_field_attrs($form_id, 'domicilio_notif'); ?>>
                <?php $caja_error('domicilio_notif'); ?>
            </div>
            <div class="flex items-center gap-2.5">
                <input class="<?= esc_attr($check) ?>" id="reclamos-mismo-domicilio" type="checkbox" data-reclamos-mismo>
                <label class="cursor-pointer text-sm leading-[1.4] text-ink" for="reclamos-mismo-domicilio">Es el mismo que mi domicilio</label>
            </div>
        </div>
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('telefono', 'Teléfono', false); ?>
            <input class="<?= esc_attr($input) ?>" placeholder="Ej. 987 654 321" <?php copam_theme_field_attrs($form_id, 'telefono'); ?>>
            <?php $caja_error('telefono'); ?>
        </div>
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('correo', 'Correo electrónico'); ?>
            <input class="<?= esc_attr($input) ?>" placeholder="nombre@empresa.com" <?php copam_theme_field_attrs($form_id, 'correo'); ?>>
            <?php $caja_error('correo'); ?>
        </div>
    </div>

    <?= $linea // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
    <?php $casilla('representacion', esc_html__('Presento esta solicitud en representación de otra persona o empresa', 'copam-theme')); ?>
    <div class="grid grid-rows-[0fr] opacity-0 transition-[grid-template-rows,opacity] duration-500 ease-out motion-reduce:transition-none data-abierto:grid-rows-[1fr] data-abierto:opacity-100" data-reclamos-representante>
        <div class="min-h-0 overflow-hidden">
            <fieldset class="m-0 min-w-0 border-0 px-0 pt-[22px] pb-0.5" disabled>
                <legend class="float-left w-full p-0 <?= esc_attr($titulo) ?>">Representante o apoderado<span class="font-normal text-[#8C8C8C]"> (opcional)</span></legend>
                <div class="clear-both pt-[18px] <?= esc_attr($dos_col) ?>">
                    <div class="<?= esc_attr($campo) ?>">
                        <?php $label('rep_nombre', 'Nombre y apellidos del representante', false); ?>
                        <input class="<?= esc_attr($input) ?>" placeholder="Solo si actúas mediante representante" <?php copam_theme_field_attrs($form_id, 'rep_nombre'); ?>>
                        <?php $caja_error('rep_nombre'); ?>
                    </div>
                    <div class="<?= esc_attr($campo) ?>">
                        <?php $label('rep_documento', 'Documento de identidad del representante', false); ?>
                        <input class="<?= esc_attr($input) ?>" placeholder="DNI o CE" <?php copam_theme_field_attrs($form_id, 'rep_documento'); ?>>
                        <?php $caja_error('rep_documento'); ?>
                    </div>
                    <div class="col-span-full <?= esc_attr($campo) ?>" data-reclamos-archivo="copam_theme_reclamos_acredita" data-max-archivos="1" data-ajax-url="<?= esc_url($ajax) ?>">
                        <label class="<?= esc_attr($etiqueta) ?>" for="reclamos-acredita">Documento que acredita la representación<?= $opcional // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?></label>
                        <div class="group relative flex h-[52px] cursor-pointer items-center gap-3 rounded-[3px] border border-dashed border-[#DADADA] bg-white px-4 transition-[border-color] duration-300 hover:border-brand has-focus-visible:border-brand has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-brand data-arrastre:border-brand" data-zona>
                            <input class="absolute inset-0 size-full cursor-pointer opacity-0" id="reclamos-acredita" type="file" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" aria-describedby="reclamos-acredita-estado" data-archivos>
                            <svg class="flex-none" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M7 9V1.5M4 4.5l3-3 3 3M1.5 9v3h11V9" stroke="#7A7A7A" stroke-width="1.3"></path></svg>
                            <span class="min-w-0 truncate text-sm text-[#8C8C8C] group-data-con-archivo:text-ink data-[state=error]:text-danger" id="reclamos-acredita-estado" aria-live="polite" data-estado>Adjunta poder o vigencia de poder · PDF, JPG o PNG</span>
                        </div>
                        <input hidden <?php copam_theme_field_attrs($form_id, 'rep_acredita'); ?> data-lote>
                        <?php $caja_error('rep_acredita'); ?>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

    <?= $linea // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
    <h3 class="<?= esc_attr($titulo) ?>">Detalle de la solicitud</h3>
    <div class="mt-[18px] grid grid-cols-[minmax(0,1fr)] gap-[clamp(18px,1.4vw,26px)]">
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('servicio', 'Servicio relacionado'); ?>
            <span class="relative block">
                <select class="<?= esc_attr($input) ?> cursor-pointer appearance-none pr-10" <?php copam_theme_field_attrs($form_id, 'servicio'); ?>>
                    <option value="">Selecciona un servicio</option>
                    <?php foreach (copam_theme_field_options($form_id, 'servicio') as $valor => $texto) : ?>
                        <option value="<?= esc_attr((string) $valor) ?>"><?= esc_html((string) $texto) ?></option>
                    <?php endforeach; ?>
                </select>
                <svg class="pointer-events-none absolute top-[23px] right-4" width="10" height="6" viewBox="0 0 10 6" fill="none" aria-hidden="true"><path d="M1 1l4 4 4-4" stroke="#7A7A7A" stroke-width="1.4"></path></svg>
            </span>
            <?php $caja_error('servicio'); ?>
        </div>
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('referencia', 'Referencia de la operación', false); ?>
            <input class="<?= esc_attr($input) ?>" placeholder="N.° de comprobante, B/L, contenedor o manifiesto" <?php copam_theme_field_attrs($form_id, 'referencia'); ?>>
            <?php $caja_error('referencia'); ?>
        </div>
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('pretension', 'Pretensión'); ?>
            <textarea class="<?= esc_attr($area) ?> min-h-[72px]" rows="2" placeholder="Indica qué solicitas que COPAM resuelva" <?php copam_theme_field_attrs($form_id, 'pretension'); ?>></textarea>
            <?php $caja_error('pretension'); ?>
        </div>
        <div class="<?= esc_attr($campo) ?>">
            <?php $label('fundamentos', 'Fundamentos'); ?>
            <textarea class="<?= esc_attr($area) ?> min-h-[120px]" rows="4" placeholder="Describe lo ocurrido y los hechos que motivan tu solicitud" <?php copam_theme_field_attrs($form_id, 'fundamentos'); ?>></textarea>
            <?php $caja_error('fundamentos'); ?>
        </div>
        <div class="<?= esc_attr($campo) ?>" data-reclamos-archivo="copam_theme_reclamos_adjuntos" data-max-archivos="10" data-ajax-url="<?= esc_url($ajax) ?>">
            <label class="<?= esc_attr($etiqueta) ?>" for="reclamos-adjuntos">Medios probatorios<?= $opcional // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?></label>
            <div class="group relative flex min-h-24 cursor-pointer flex-col items-center justify-center gap-3.5 rounded-[3px] border border-dashed border-[#DADADA] bg-white px-4 py-5 text-center transition-[border-color,background-color] duration-300 hover:border-brand hover:bg-[#F0F8F3] has-focus-visible:border-brand has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-brand data-arrastre:border-brand data-arrastre:bg-[#F0F8F3]" data-zona>
                <input class="absolute inset-0 size-full cursor-pointer opacity-0" id="reclamos-adjuntos" type="file" multiple accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" aria-describedby="reclamos-adjuntos-estado" data-archivos>
                <span class="grid size-9 place-items-center rounded-full bg-gris-ef text-[#7A7A7A] transition-[background-color,color,transform] duration-300 group-hover:scale-[1.08] group-hover:bg-brand group-hover:text-white group-data-arrastre:scale-[1.08] group-data-arrastre:bg-brand group-data-arrastre:text-white" aria-hidden="true">
                    <svg class="block overflow-visible" width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 9V1.5M4 4.5l3-3 3 3" stroke="currentColor" stroke-width="1.3"></path><path d="M1.5 9v3h11V9" stroke="currentColor" stroke-width="1.3"></path></svg>
                </span>
                <span class="text-[13px] leading-[1.45] text-[#8C8C8C] data-[state=error]:text-danger" id="reclamos-adjuntos-estado" aria-live="polite" data-estado>Arrastra tus archivos o haz clic para adjuntar · PDF, JPG o PNG, hasta 10 MB</span>
            </div>
            <input hidden <?php copam_theme_field_attrs($form_id, 'adjuntos'); ?> data-lote>
            <?php $caja_error('adjuntos'); ?>
        </div>
    </div>

    <?= $linea // phpcs:ignore WordPress.Security.EscapeOutput -- marcado fijo ?>
    <?php copam_theme_form_honeypot(); ?>
    <div class="flex flex-wrap items-center justify-between gap-5">
        <div class="flex max-w-[760px] flex-col gap-2.5 rounded bg-[#EBF4EE] px-4 py-3.5">
            <div class="flex flex-col gap-1.5">
                <?php $casilla('notif_correo', esc_html__('Autorizo que COPAM me notifique la respuesta y los actos de este procedimiento al correo electrónico indicado.', 'copam-theme') . $opcional); ?>
                <p class="m-0 ml-[26px] text-[13px] leading-normal text-ink-muted">Si no autorizas, la notificación se realizará en tu domicilio para notificaciones.</p>
            </div>
            <?php $casilla('veraz', esc_html__('Declaro que la información proporcionada es veraz.', 'copam-theme') . $req); ?>
            <?php $caja_error('veraz'); ?>
            <?php $casilla('informe_oral', esc_html__('Solicito informe oral.', 'copam-theme') . $opcional); ?>
            <?php $casilla('consentimiento', sprintf(
                'Acepto la <a class="text-ink underline underline-offset-[3px] hover:text-brand" href="%s" target="_blank" rel="noopener">Política de privacidad<span class="sr-only"> (se abre en una pestaña nueva)</span></a> y el tratamiento de mis datos personales.%s',
                esc_url($privacy),
                $req
            )); ?>
            <?php $caja_error('consentimiento'); ?>
        </div>
        <button class="group flex h-[52px] cursor-pointer items-center justify-center rounded border-0 bg-brand px-[clamp(24px,1.8vw,34px)] text-[clamp(16px,.95vw,18px)] font-medium tracking-[.02em] text-white uppercase transition-colors duration-[350ms] hover:bg-brand-hover disabled:cursor-wait data-loading:cursor-wait data-loading:opacity-70" type="submit" data-loading-label="Enviando...">
            <span class="block h-[1.15em] overflow-hidden leading-[1.15em]">
                <span class="flex flex-col transition-transform duration-[550ms] ease-in-out group-hover:-translate-y-1/2">
                    <span class="whitespace-nowrap" data-submit-label>Enviar solicitud</span>
                    <span class="whitespace-nowrap" aria-hidden="true">Enviar solicitud</span>
                </span>
            </span>
        </button>
    </div>
    <p class="mt-4 mb-0 rounded bg-[#EBF4EE] px-4 py-3.5 text-[15px] leading-normal text-[#0B7A38] empty:hidden data-[state=error]:bg-transparent data-[state=error]:p-0 data-[state=error]:text-[13px] data-[state=error]:text-danger" data-form-status role="status" aria-live="polite"></p>
    <?php if ($nota_envio !== '' && $destino !== '') : ?>
        <p class="mt-3.5 mb-0 text-[13px] leading-normal text-gris-7a"><?= esc_html($nota_envio) ?> <a class="font-medium text-brand underline underline-offset-[3px]" href="<?= esc_url('mailto:' . $destino) ?>"><?= esc_html($destino) ?></a></p>
    <?php endif; ?>
</form>
