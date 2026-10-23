<?php
defined('ABSPATH') || exit;

/*
 * Correo HTML de los formularios (inc/correos-html.php). Tablas y estilos en línea para Gmail, Outlook y Apple Mail.
 *
 * $args:
 *  - tipo        'area' (lo recibe COPAM) | 'usuario' (copia para quien lo presentó)
 *  - asunto      asunto del correo
 *  - doc         texto ordenado por copam_theme_correo_ordenar()
 *  - formulario  nombre del formulario (area)
 *  - enviado     fecha y hora de recepción (area)
 *  - responder   correo de quien escribió (area, puede ir vacío)
 *  - nombre      nombre de quien escribió (area, puede ir vacío)
 */
$tipo   = ($args['tipo'] ?? '') === 'usuario' ? 'usuario' : 'area';
$doc    = (array) ($args['doc'] ?? []);
$asunto = (string) ($args['asunto'] ?? '');
$numero = (string) ($doc['numero'] ?? '');
$fecha  = (string) ($doc['fecha'] ?? '');
$pie    = function_exists('get_field') ? (get_field('opciones_pie', 'option') ?: []) : [];
$logo   = get_theme_file_uri('logo/logo-gmail.png');
$sitio  = wp_specialchars_decode(get_bloginfo('name'), ENT_QUOTES);
$inicio = home_url('/');

$fuente = "'Funnel Display', 'Helvetica Neue', Helvetica, Arial, sans-serif";
$mono   = "'SFMono-Regular', Menlo, Consolas, 'Liberation Mono', monospace";

if ($tipo === 'usuario') {
    $titulo   = preg_replace('/\s*·?\s*N\.° \S+$/u', '', $asunto);
    $titulo   = preg_replace('/^Copia de t/u', 'T', $titulo);
    $intro    = (array) ($doc['intro'] ?? []);
    $saludo   = ($intro[0] ?? '') !== '' && mb_strlen($intro[0]) < 30 ? array_shift($intro) : '';
    $previa   = $numero !== '' ? sprintf('N.° %s · registrada el %s. Guarda este correo como constancia.', $numero, $fecha) : $titulo;
} else {
    $titulo   = (string) ($args['formulario'] ?? '') ?: $asunto;
    $nombre   = (string) ($args['nombre'] ?? '');
    $previa   = trim(($nombre !== '' ? $nombre . ' · ' : '') . ($numero !== '' ? 'N.° ' . $numero . ' · ' : '') . (string) ($args['enviado'] ?? ''), ' ·');
}
?>
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="color-scheme" content="light only">
    <meta name="supported-color-schemes" content="light only">
    <title><?= esc_html($asunto) ?></title>
    <!--[if mso]><noscript><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml></noscript><![endif]-->
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; }
        a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; }
        @media only screen and (max-width: 620px) {
            .c-pad { padding-left: 22px !important; padding-right: 22px !important; }
            .c-fila td { display: block !important; width: 100% !important; box-sizing: border-box !important; }
            .c-fila .c-etq { padding: 11px 0 0 !important; border-bottom: 0 !important; }
            .c-fila .c-val { padding-top: 3px !important; }
            .c-h1 { font-size: 24px !important; }
            .c-talon td { display: block !important; width: 100% !important; box-sizing: border-box !important; border-left: 0 !important; }
            .c-talon .c-talon-b { border-top: 1px dashed #2B2B2B !important; }
        }
    </style>
</head>
<body style="margin:0; padding:0; background-color:#F2F2F2;">
    <div style="display:none; max-height:0; overflow:hidden; mso-hide:all; font-size:1px; line-height:1px; color:#F2F2F2;"><?= esc_html($previa) ?>&#8199;&#847;&#8199;&#847;&#8199;&#847;&#8199;&#847;&#8199;&#847;&#8199;&#847;</div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#F2F2F2" style="background-color:#F2F2F2;">
        <tr>
            <td align="center" style="padding:28px 12px 40px;">
                <!--[if mso]><table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0"><tr><td><![endif]-->
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; background-color:#FFFFFF;" bgcolor="#FFFFFF">

                    <!-- Franja con los colores del logo -->
                    <tr>
                        <td style="font-size:0; line-height:0;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td width="46%" height="5" bgcolor="#0B6A33" style="background-color:#0B6A33; font-size:0; line-height:0;">&nbsp;</td>
                                    <td width="16%" height="5" bgcolor="#C9502B" style="background-color:#C9502B; font-size:0; line-height:0;">&nbsp;</td>
                                    <td width="14%" height="5" bgcolor="#5B3A1C" style="background-color:#5B3A1C; font-size:0; line-height:0;">&nbsp;</td>
                                    <td width="12%" height="5" bgcolor="#E5B731" style="background-color:#E5B731; font-size:0; line-height:0;">&nbsp;</td>
                                    <td width="12%" height="5" bgcolor="#D98A1D" style="background-color:#D98A1D; font-size:0; line-height:0;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Cabecera -->
                    <tr>
                        <td class="c-pad" style="padding:26px 40px 0;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td valign="middle">
                                        <a href="<?= esc_url($inicio) ?>" style="text-decoration:none;"><img src="<?= esc_url($logo) ?>" width="<?= $tipo === 'usuario' ? 168 : 132 ?>" alt="<?= esc_attr($sitio) ?>" style="display:block; border:0; outline:none; height:auto; width:<?= $tipo === 'usuario' ? 168 : 132 ?>px; max-width:100%;"></a>
                                    </td>
                                    <td valign="middle" align="right" style="font-family:<?= esc_attr($mono) ?>; font-size:11px; line-height:16px; letter-spacing:.08em; color:#8A8A8A; text-transform:uppercase;">
                                        <?= $tipo === 'usuario' ? esc_html__('Constancia', 'copam-theme') : esc_html__('Nuevo envío', 'copam-theme') ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td class="c-pad" style="padding:<?= $tipo === 'usuario' ? '34px' : '26px' ?> 40px 0; font-family:<?= esc_attr($fuente) ?>; color:#2B2B2B;">
                            <?php if ($tipo === 'usuario') : ?>
                                <?php if ($saludo !== '') : ?>
                                    <p style="margin:0 0 6px; font-size:15px; line-height:22px; color:#5A5A5A;"><?= esc_html($saludo) ?></p>
                                <?php endif; ?>
                                <h1 class="c-h1" style="margin:0; font-size:30px; line-height:36px; font-weight:600; letter-spacing:-.01em; color:#10303B;"><?= esc_html($titulo) ?></h1>
                                <?php foreach ($intro as $parrafo) : ?>
                                    <p style="margin:12px 0 0; font-size:15px; line-height:23px; color:#4A4A4A;"><?= esc_html($parrafo) ?></p>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <h1 class="c-h1" style="margin:0; font-size:24px; line-height:30px; font-weight:600; color:#10303B;"><?= esc_html($titulo) ?></h1>
                                <p style="margin:8px 0 0; font-family:<?= esc_attr($mono) ?>; font-size:12px; line-height:18px; color:#6B6B6B;">
                                    <?= esc_html(sprintf(__('Recibido el %s', 'copam-theme'), (string) ($args['enviado'] ?? ''))) ?><?php if ($numero !== '') : ?> &nbsp;/&nbsp; <span style="color:#2B2B2B; font-weight:600;">N.° <?= esc_html($numero) ?></span><?php endif; ?>
                                </p>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <?php if ($tipo === 'usuario' && $numero !== '') : ?>
                        <!-- Talón con el número: lo que el usuario debe guardar -->
                        <tr>
                            <td class="c-pad" style="padding:26px 40px 0;">
                                <table role="presentation" class="c-talon" width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #2B2B2B;">
                                    <tr>
                                        <td width="62%" style="padding:16px 20px; font-family:<?= esc_attr($fuente) ?>;">
                                            <p style="margin:0; font-size:11px; line-height:16px; letter-spacing:.1em; text-transform:uppercase; color:#6B6B6B;"><?= esc_html__('Número de registro', 'copam-theme') ?></p>
                                            <p style="margin:4px 0 0; font-family:<?= esc_attr($mono) ?>; font-size:22px; line-height:28px; font-weight:700; color:#0B6A33; letter-spacing:.02em;"><?= esc_html($numero) ?></p>
                                        </td>
                                        <td class="c-talon-b" width="38%" style="padding:16px 20px; border-left:1px dashed #2B2B2B; font-family:<?= esc_attr($fuente) ?>;">
                                            <p style="margin:0; font-size:11px; line-height:16px; letter-spacing:.1em; text-transform:uppercase; color:#6B6B6B;"><?= esc_html__('Registrada el', 'copam-theme') ?></p>
                                            <p style="margin:4px 0 0; font-family:<?= esc_attr($mono) ?>; font-size:18px; line-height:28px; color:#2B2B2B;"><?= esc_html($fecha) ?></p>
                                        </td>
                                    </tr>
                                </table>
                                <p style="margin:10px 0 0; font-family:<?= esc_attr($fuente) ?>; font-size:13px; line-height:19px; color:#6B6B6B;"><?= esc_html__('Cita este número en cualquier consulta sobre tu registro.', 'copam-theme') ?></p>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php if ($tipo === 'area' && ($args['responder'] ?? '') !== '') : ?>
                        <tr>
                            <td class="c-pad" style="padding:22px 40px 0;">
                                <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td bgcolor="#0B8A3E" style="background-color:#0B8A3E; border-radius:3px;">
                                            <a href="<?= esc_url('mailto:' . $args['responder']) ?>" style="display:inline-block; padding:11px 20px; font-family:<?= esc_attr($fuente) ?>; font-size:14px; line-height:18px; font-weight:600; color:#FFFFFF; text-decoration:none;">
                                                <?= esc_html($nombre !== '' ? sprintf(__('Responder a %s', 'copam-theme'), $nombre) : __('Responder', 'copam-theme')) ?> &rarr;
                                            </a>
                                        </td>
                                        <td style="padding-left:14px; font-family:<?= esc_attr($mono) ?>; font-size:12px; line-height:18px; color:#6B6B6B;"><?= esc_html($args['responder']) ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <!-- Datos del envío -->
                    <?php foreach ((array) ($doc['secciones'] ?? []) as $i => $seccion) : ?>
                        <tr>
                            <td class="c-pad" style="padding:<?= $i === 0 ? '34px' : '30px' ?> 40px 0; font-family:<?= esc_attr($fuente) ?>;">
                                <?php if ($seccion['titulo'] !== '') : ?>
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-bottom:2px solid #10303B;">
                                        <tr>
                                            <?php if ($seccion['indice'] !== '') : ?>
                                                <td width="34" valign="bottom" style="padding:0 0 8px; font-family:<?= esc_attr($mono) ?>; font-size:12px; line-height:18px; font-weight:700; color:#0B8A3E;"><?= esc_html($seccion['indice']) ?></td>
                                            <?php endif; ?>
                                            <td valign="bottom" style="padding:0 0 8px; font-size:15px; line-height:20px; font-weight:600; color:#10303B;"><?= esc_html($seccion['titulo']) ?></td>
                                        </tr>
                                    </table>
                                <?php else : ?>
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-bottom:2px solid #10303B;"><tr><td style="font-size:0; line-height:0;">&nbsp;</td></tr></table>
                                <?php endif; ?>

                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <?php foreach ($seccion['filas'] as $fila) : ?>
                                        <?php if ($fila['largo']) : ?>
                                            <tr>
                                                <td colspan="2" style="padding:12px 0 14px; border-bottom:1px solid #E4E4E4;">
                                                    <p style="margin:0 0 8px; font-size:12px; line-height:17px; color:#6B6B6B;"><?= esc_html($fila['etiqueta']) ?></p>
                                                    <p style="margin:0; font-size:15px; line-height:23px; color:#2B2B2B;"><?= $fila['valor'] !== '' ? nl2br(esc_html($fila['valor'])) : '—' ?></p>
                                                </td>
                                            </tr>
                                        <?php else : ?>
                                            <tr class="c-fila">
                                                <td class="c-etq" width="38%" valign="top" style="padding:11px 16px 11px 0; border-bottom:1px solid #E4E4E4; font-size:12px; line-height:19px; color:#6B6B6B;"><?= esc_html($fila['etiqueta']) ?></td>
                                                <td class="c-val" valign="top" style="padding:11px 0; border-bottom:1px solid #E4E4E4; font-size:14px; line-height:20px; color:#2B2B2B; word-break:break-word;"><?= esc_html($fila['valor'] !== '' ? $fila['valor'] : '—') ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </table>

                                <?php foreach ($seccion['notas'] as $nota) : ?>
                                    <p style="margin:12px 0 0; font-size:13px; line-height:20px; color:#5A5A5A;"><?= esc_html($nota) ?></p>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if ($tipo === 'area' && ($doc['pagina'] ?? '') !== '') : ?>
                        <tr>
                            <td class="c-pad" style="padding:18px 40px 0; font-family:<?= esc_attr($mono) ?>; font-size:12px; line-height:18px; color:#8A8A8A; word-break:break-all;">
                                <?= esc_html__('Enviado desde', 'copam-theme') ?> <a href="<?= esc_url($doc['pagina']) ?>" style="color:#0B6A33;"><?= esc_html($doc['pagina']) ?></a>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <tr><td style="padding:36px 0 0; font-size:0; line-height:0;">&nbsp;</td></tr>

                    <!-- Pie -->
                    <?php if ($tipo === 'usuario') : ?>
                        <tr>
                            <td class="c-pad" bgcolor="#10303B" style="background-color:#10303B; padding:26px 40px 28px; font-family:<?= esc_attr($fuente) ?>;">
                                <p style="margin:0; font-size:14px; line-height:20px; font-weight:600; color:#FFFFFF;"><?= esc_html($sitio) ?></p>
                                <?php if (!empty($pie['descripcion'])) : ?>
                                    <p style="margin:4px 0 0; font-size:13px; line-height:19px; color:#B5B5B5;"><?= esc_html($pie['descripcion']) ?></p>
                                <?php endif; ?>
                                <?php if (!empty($pie['telefono']) || !empty($pie['correo'])) : ?>
                                    <p style="margin:14px 0 0; font-size:13px; line-height:20px; color:#FFFFFF;">
                                        <?php if (!empty($pie['telefono'])) : ?>
                                            <a href="<?= esc_url('tel:' . preg_replace('/[^\d+]/', '', (string) $pie['telefono'])) ?>" style="color:#FFFFFF; text-decoration:none;"><?= esc_html($pie['telefono']) ?></a>
                                        <?php endif; ?>
                                        <?php if (!empty($pie['telefono']) && !empty($pie['correo'])) : ?>
                                            <span style="color:#5A5A5A;">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                        <?php endif; ?>
                                        <?php if (!empty($pie['correo'])) : ?>
                                            <a href="<?= esc_url('mailto:' . $pie['correo']) ?>" style="color:#F6C744; text-decoration:none;"><?= esc_html($pie['correo']) ?></a>
                                        <?php endif; ?>
                                    </p>
                                <?php endif; ?>
                                <p style="margin:18px 0 0; padding-top:14px; border-top:1px solid #1F4552; font-size:11px; line-height:17px; color:#8A8A8A;">
                                    <?= esc_html__('Recibes este correo porque presentaste este registro en nuestra web. Es una copia automática: para consultas, escríbenos al correo de arriba.', 'copam-theme') ?>
                                    <?php if (!empty($pie['copyright'])) : ?><br><?= esc_html($pie['copyright']) ?><?php endif; ?>
                                </p>
                            </td>
                        </tr>
                    <?php else : ?>
                        <tr>
                            <td class="c-pad" style="padding:16px 40px 22px; border-top:1px solid #E4E4E4; font-family:<?= esc_attr($fuente) ?>; font-size:11px; line-height:17px; color:#8A8A8A;">
                                <?= esc_html(sprintf(__('Aviso automático del formulario de %s.', 'copam-theme'), wp_parse_url($inicio, PHP_URL_HOST))) ?>
                                <?php if (($args['responder'] ?? '') !== '') : ?>
                                    <?= esc_html__('Si respondes a este correo, le escribes directamente a quien lo envió.', 'copam-theme') ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </table>
                <!--[if mso]></td></tr></table><![endif]-->
            </td>
        </tr>
    </table>
</body>
</html>
