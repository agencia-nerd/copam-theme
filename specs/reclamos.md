# Página: Reclamos

- **Resumen:** Explica cómo presentar un reclamo, una reconsideración o una apelación ante COPAM según el reglamento de OSITRAN, con el proceso de atención, el formulario, los documentos, los derechos del usuario y otros canales. El visitante elige el tipo de solicitud y la envía, o descarga los formatos.
- **Fuente:** `reclamos.html`
- **Plantilla:** `pages/template-reclamos.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, proceso, formulario, conforme, documentos, libro, derechos, otros_canales, faq
- **Skills usadas:** wp-form (formulario), wp-accordion (documentos, faq), wp-helper
- **Grupo ACF:** Reclamos
- **Ubicación:** plantilla pages/template-reclamos.php
- **Notas de página:**
  - `h1` "Reclamos" en el hero
  - título SEO "Reclamos · COPAM"
  - meta descripción del diseño "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (se ignora el `noindex`, es solo de la maqueta)
  - Los datos (pasos, instancias, documentos, preguntas) viven en el script de `reclamos.html` (líneas 955-1057), no en `copam-shared.js`
  - ya están volcados en las secciones
  - Anclas reales de la página: `#proceso`, `#formulario`, `#conforme`, `#queja` (contenedor de las tarjetas de `conforme`), `#documentos`, `#libro`, `#derechos`, `#otros-canales`, `#faq`
  - todas con `scroll-margin-top` que compense el header fijo
  - El menú principal (grupo Reclamos) enlaza: Cómo reclamar -> la página (sin ancla
  - podría ser `#proceso`, a confirmar), Presentar reclamo -> `#formulario`, Derechos del usuario -> `#derechos`, Libro de Reclamaciones -> la página `libro-de-reclamaciones`
  - el "Quejas y reclamos" del depósito y el "Presentar un reclamo" de `contacto` también apuntan aquí
  - Componentes compartidos usados: `migas` (hero), `boton`, `encabezado-seccion` (títulos de proceso, formulario, conforme, documentos, derechos y otros canales: h2 con línea animada), `documentos-por-anio` (documentos), `bloque-acceso` (libro), `faq-ayuda` (faq)
  - Las tres series de tarjetas (proceso, conforme, otros canales) comparten un mismo diseño de tarjeta (etiqueta pequeña, título, texto, botón con flecha)
  - se propone sumarlo a `_shared.md` como componente `tarjeta-paso` con `etiqueta`, `titulo`, `texto`, `nota`, `enlace` (ver "Sin decidir" en el informe)
  - Destinatario de todos los formularios del diseño según el README: `comercial@copam.com.pe` (el formulario lo imprime como "Se envía al área de Atención al Usuario")
  - la FAQ además menciona `servicioclientes@copam.com.pe` como correo para presentar el reclamo por escrito: son dos correos distintos y hay que confirmarlos
  - Elementos fuera de la página: header, footer, buscador y aviso de mantenimiento (sitio)
  - Pendiente del diseño: el reCAPTCHA/Turnstile aparece como `[PENDIENTE: ...]`
  - el texto no se imprime
- **Estado:** pendiente

## Sección: hero

- **Origen:** `reclamos.html` líneas 159-204
- **Destino:** `template-parts/pages/reclamos/hero.php`
- **Grupo:** `reclamos_hero`
- **Skill:** ninguna
- **Comportamiento:** migas "Inicio > Reclamos" con el componente `migas` (sin campos). Sin imagen: fondo liso. En escritorio el texto va a la izquierda y la tarjeta "Accesos directos" a la derecha (ancho 33.3vw); en móvil la tarjeta pasa debajo en una columna. El botón "Presentar reclamo" usa el componente `boton` y baja a `#formulario`. Cada fila de "Accesos directos" lleva el texto y una flecha de esquina que se desliza al hover; son anclas internas de la misma página. Animaciones de entrada (subida del título, clip del texto, tarjeta con retraso de 250 ms) en un módulo JS que respeta `prefers-reduced-motion`. Valor suelto: hover del botón `#07702F`.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `reclamos_hero_titulo` | text | Título principal de la página (h1). Se muestra en grande a la izquierda. Recomendado: ~15 caracteres | Reclamos | sí |
| `reclamos_hero_bajada` | textarea | Texto bajo el título que explica qué se puede presentar y con qué reglamento. Recomendado: ~300 caracteres | Presenta un reclamo sobre los servicios del terminal, o una reconsideración o apelación. Tu solicitud se atiende conforme al Reglamento de Atención de Reclamos y Solución de Controversias de OSITRAN. | sí |
| `reclamos_hero_boton` | link | Botón principal: texto y destino. Baja al formulario. | Presentar reclamo | sí |
| `reclamos_hero_accesos_titulo` | text | Título de la tarjeta lateral de accesos directos. Recomendado: ~25 caracteres | Accesos directos | sí |
| `reclamos_hero_accesos` | repeater | Lista de enlaces de la tarjeta lateral. 5 enlaces a secciones de la misma página. | — | sí |
| `reclamos_hero_accesos.enlace` | link | Texto y destino del acceso directo. El primero es "Formulario de reclamos" (`#formulario`). Recomendado: ~40 caracteres | Formulario de reclamos | sí |

Valores del repetidor (texto y ancla): Formulario de reclamos (`#formulario`), Documentos y formatos (`#documentos`), Libro de Reclamaciones (`#libro`), Derechos y deberes del usuario (`#derechos`), Preguntas frecuentes (`#faq`).

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Enlaces con destinos reales; los externos con `rel` seguro (helper de enlaces de `wp-helper`)
- [ ] Migas y botón usan los componentes `migas` y `boton`, sin duplicar su marcado
- [ ] La tarjeta de accesos directos se apila bajo el texto en móvil y es navegable con teclado

## Sección: proceso

- **Origen:** `reclamos.html` líneas 206-225 (datos en 991-992)
- **Destino:** `template-parts/pages/reclamos/proceso.php`
- **Grupo:** `reclamos_proceso`
- **Skill:** ninguna
- **Comportamiento:** `id="proceso"`. Título con `encabezado-seccion`. 5 pasos en rejilla de 5 columnas desde 1180 px, 2 desde 600 px y 1 en móvil, con una franja de fondo y aparición escalonada. Cada tarjeta: número ("01"..."05", lo genera la plantilla por posición, no es campo), título y descripción. En la descripción, las expresiones "N días" / "N días hábiles" salen en verde `--color-brand` y peso 600: se escriben con los marcadores de `copam_theme_highlight` (ver `inc/helpers/text-styles.php`). El diseño trae también una etiqueta por paso ("60 días", "Silencio positivo"…) que no se muestra; no se crea campo. Alto de tarjeta flexible.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `reclamos_proceso_titulo` | text | Título de la sección (h2). Recomendado: ~30 caracteres | Proceso de atención | sí |
| `reclamos_proceso_pasos` | repeater | Pasos del procedimiento, en orden. 5 pasos; el número lo pone la plantilla. | — | sí |
| `reclamos_proceso_pasos.titulo` | text | Título del paso. Recomendado: ~30 caracteres | Presenta tu reclamo | sí |
| `reclamos_proceso_pasos.descripcion` | textarea | Explicación del paso. Los plazos ("60 días", "15 días hábiles") se marcan en verde con los marcadores del helper de texto. Recomendado: ~120 caracteres | Ante COPAM, dentro de los 60 días de ocurrido el hecho o de conocido este. | sí |

Valores del repetidor (título: descripción): 1 Presenta tu reclamo: Ante COPAM, dentro de los 60 días de ocurrido el hecho o de conocido este. 2 Subsana, si falta un requisito: COPAM te pide subsanar en 2 días hábiles y tienes 2 días hábiles para hacerlo. 3 COPAM resuelve: En 15 días hábiles, ampliables hasta 30 días hábiles en casos complejos, por decisión motivada. 4 Te notificamos la resolución: A más tardar dentro de los 5 días hábiles posteriores a su emisión, en el domicilio o correo que indicaste (art. 29 del Reglamento de Reclamos de OSITRAN). 5 Si COPAM no responde: Si COPAM no responde dentro del plazo, se aplica el silencio administrativo positivo.

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Repeated block: las tarjetas usan un solo componente con `$args`, el mismo de `conforme` y `otros_canales`
- [ ] Los plazos salen en verde con `copam_theme_highlight`, sin `<span>` ni estilos escritos a mano
- [ ] La sección tiene `id="proceso"` y el título usa `encabezado-seccion`

## Sección: formulario

- **Origen:** `reclamos.html` líneas 227-401 (textos en 1005-1022)
- **Destino:** `template-parts/forms/reclamos.php`, `template-parts/pages/reclamos/formulario.php`
- **Grupo:** `reclamos_formulario`
- **Skill:** wp-form
- **Comportamiento:** `id="formulario"`. Título con `encabezado-seccion` y, debajo, la nota de campos obligatorios. El formulario lo construye `wp-form`; sin marcado propio. Estructura: (1) "Tipo de solicitud *": grupo de tres opciones tipo radio (Reclamo, Reconsideración, Apelación; por defecto Reclamo) y, debajo, una nota que cambia según la opción más el enlace al PDF del procedimiento. Los botones de `conforme` ("Solicitar reconsideración", "Presentar apelación") y las tarjetas del hero abren esta sección con el tipo preseleccionado (módulo JS por `data-`). (2) Solo con Reconsideración o Apelación: "N.° de reclamo *" (texto, solo dígitos, máximo 10; "Ej. 000123") y "N.° y fecha de la resolución que impugnas *" (texto; "Ej. Res. N.° 045-2026 · 12-08-2026"). (3) "Datos del solicitante": Nombre y apellidos * (mínimo 3; "Ingresa tu nombre completo"), DNI, CE o RUC * (solo dígitos, 8 a 11; "Ej.: 45678912 o 20543480291"), Domicilio * ("Dirección completa"), Domicilio para notificaciones * ("Dirección donde recibirás las notificaciones") con la casilla "Es el mismo que mi domicilio" que copia el domicilio y deja el campo de solo lectura, Teléfono (opcional; números, + ( ) espacio y guion, 7 a 20; "Ej. 987 654 321"), Correo electrónico * (formato válido; "nombre@empresa.com"). (4) Casilla "Presento esta solicitud en representación de otra persona o empresa"; al marcarla se despliega "Representante o apoderado (opcional)" con Nombre y apellidos del representante (mínimo 3, solo letras; "Solo si actúas mediante representante"), Documento de identidad del representante (8 a 11 dígitos; "DNI o CE") y Documento que acredita la representación (archivo PDF, JPG o PNG; "Adjunta poder o vigencia de poder · PDF, JPG o PNG"); al elegir razón social la representación pasa a obligatoria (el diseño no trae el control de empresa visible; a confirmar si se necesita). (5) "Detalle de la solicitud": Servicio relacionado * (selector con "Selecciona un servicio" deshabilitada y opciones Servicios a la nave, Servicios a la carga, Servicios especiales, Depósito Temporal, Atención al usuario), Referencia de la operación (opcional; "N.° de comprobante, B/L, contenedor o manifiesto"), Pretensión * (textarea 2 filas, mínimo 10; "Indica qué solicitas que COPAM resuelva"), Fundamentos * (textarea 4 filas, mínimo 10; "Describe lo ocurrido y los hechos que motivan tu solicitud") y Medios probatorios (opcional; zona de arrastre con varios archivos PDF, JPG o PNG, hasta 10 MB; texto "Arrastra tus archivos o haz clic para adjuntar · PDF, JPG o PNG, hasta 10 MB"). (6) Casillas: "Autorizo que COPAM me notifique la respuesta y los actos de este procedimiento al correo electrónico indicado." (opcional, con la nota "Si no autorizas, la notificación se realizará en tu domicilio para notificaciones."), "Declaro que la información proporcionada es veraz." (requerida), "Solicito informe oral." (opcional) y "Acepto la Política de privacidad y el tratamiento de mis datos personales." (requerida, enlaza a la página de privacidad del tema). (7) Anti-robot "No soy un robot": el diseño deja un marcador de reCAPTCHA o Turnstile; lo define el anti-spam de `wp-form` (a confirmar cuál) y el texto `[PENDIENTE]` no se imprime. (8) Botón "Enviar solicitud". Campos en 2 columnas desde 760 px, 1 en móvil; los de ancho completo son Domicilio para notificaciones con su casilla, Documento que acredita, Pretensión, Fundamentos y Medios probatorios. Validación al salir del campo y al escribir, mensaje bajo el campo con `role="alert"` y color `--color-danger`. Destinatario: `comercial@copam.com.pe` (README del diseño; confirmar). Envío: el diseño muestra "Recibimos tu solicitud. En la versión final recibirás un número de reclamo y una copia en tu correo." y esa frase habla de la "versión final", así que no se imprime tal cual: se propone "Recibimos tu solicitud. Te enviaremos una copia a tu correo." (a confirmar; el número de reclamo exige guardar los envíos). Bajo el formulario, un bloque con dos párrafos de plazo y un enlace con flecha que descarga el diagrama del procedimiento (PDF subido al sitio, campo `file`). Valores sueltos: hover del botón `#07702F`; borde punteado de la zona de adjuntos `#DADADA` (verde `--color-brand` al hover) y fondo `#F0F8F3`. El correo de destino no es campo de esta página: sale de `opciones_correos_reclamos.correo` en Ajustes del sitio (se admite más de uno).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `reclamos_formulario_titulo` | text | Título de la sección (h2). Recomendado: ~80 caracteres | Formulario de reclamos, reconsideraciones y apelaciones | sí |
| `reclamos_formulario_nota_obligatorios` | text | Aviso bajo el título sobre los campos obligatorios. Recomendado: ~55 caracteres | Los campos con * son obligatorios. | no |
| `reclamos_formulario_nota_reclamo` | textarea | Nota bajo el selector de tipo cuando está elegido "Reclamo". Recomendado: ~320 caracteres | Elige Reclamo si no estás conforme con un servicio del terminal: un cobro, la calidad o demora del servicio, daños a tu carga o información incorrecta. Tienes 60 días desde ocurrido el hecho o desde que lo conociste. | sí |
| `reclamos_formulario_nota_reconsideracion` | textarea | Nota bajo el selector cuando está elegida "Reconsideración". Recomendado: ~330 caracteres | Elige Reconsideración si ya recibiste la respuesta de COPAM a tu reclamo, no estás de acuerdo y tienes una nueva prueba. La revisa COPAM. Tienes 15 días hábiles desde que te notificaron la respuesta. | sí |
| `reclamos_formulario_nota_apelacion` | textarea | Nota bajo el selector cuando está elegida "Apelación". Recomendado: ~380 caracteres | Elige Apelación si no estás de acuerdo con la respuesta de COPAM y quieres que la revise OSITRAN. La presentas aquí y COPAM la envía al Tribunal de OSITRAN. Tienes 15 días hábiles desde que te notificaron la respuesta. | sí |
| `reclamos_formulario_procedimiento_texto` | text | Texto del enlace que abre el PDF del procedimiento, junto a la nota de tipo. Recomendado: ~55 caracteres | Ver el procedimiento completo (PDF) | no |
| `reclamos_formulario_procedimiento_archivo` | file | PDF de la guía del procedimiento. Se abre en pestaña nueva. | — | no |
| `reclamos_formulario_plazo_1` | text | Primer párrafo bajo el formulario sobre el plazo. Recomendado: ~120 caracteres | Tienes 60 días desde ocurrido el hecho, o desde que lo conociste, para presentar un reclamo. | no |
| `reclamos_formulario_plazo_2` | text | Segundo párrafo bajo el formulario sobre la presentación en físico o por correo. Recomendado: ~140 caracteres | Si lo presentas en físico o por correo, incluye los mismos datos del formulario, la fecha y tu firma o huella. | no |
| `reclamos_formulario_diagrama_texto` | text | Texto del enlace que descarga el diagrama del procedimiento. Recomendado: ~60 caracteres | Descargar diagrama del procedimiento (PDF) | no |
| `reclamos_formulario_diagrama_archivo` | file | PDF del diagrama (flujograma) del procedimiento. Se abre en pestaña nueva. | — | no |
| `reclamos_formulario_nota_envio` | text | Aviso bajo el formulario que indica a dónde se envía. Va antes del correo, que se imprime aparte. Recomendado: ~65 caracteres | Se envía al área de Atención al Usuario: | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-form` (`references/acceptance.md` de esa skill)
- [ ] Cada campo tiene `label`, validación igual en el front y en PHP, y el mensaje de error se anuncia con `role="alert"`
- [ ] El tipo de solicitud es un grupo de radios accesible (flechas y teclado); los campos N.° de reclamo y resolución solo aparecen y se exigen con Reconsideración o Apelación
- [ ] La nota bajo el selector cambia con el tipo elegido y los botones de `conforme` preseleccionan el tipo
- [ ] La casilla "Es el mismo que mi domicilio" copia el domicilio y bloquea el campo; la representación se despliega al marcarla
- [ ] Los adjuntos aceptan PDF, JPG y PNG (varios en medios probatorios) y se validan también en PHP
- [ ] El envío llega a los correos de `opciones_correos_reclamos` y muestra el estado de éxito
- [ ] El anti-spam elegido reemplaza al marcador `[PENDIENTE]` del diseño y este texto no se imprime
- [ ] Los PDF se descargan desde el campo `file`, con `rel` seguro y aviso de pestaña nueva
- [ ] La sección tiene `id="formulario"` y el título usa `encabezado-seccion`

## Sección: conforme

- **Origen:** `reclamos.html` líneas 403-425 (datos en 995-1004)
- **Destino:** `template-parts/pages/reclamos/conforme.php`
- **Grupo:** `reclamos_conforme`
- **Skill:** ninguna
- **Comportamiento:** `id="conforme"`; el contenedor de las tarjetas lleva `id="queja"` (ancla usada por el diseño). Título con `encabezado-seccion`, seguido de un párrafo introductorio y una nota. 3 tarjetas en rejilla de 3 columnas desde 1180 px, 2 desde 600 px y 1 en móvil, con aparición escalonada; mismo componente de tarjeta que `proceso` y `otros_canales`. Los plazos ("15 días hábiles") salen en verde y peso 600 con `copam_theme_highlight`. Los botones de Reconsideración y Apelación bajan a `#formulario` y preseleccionan el tipo en el formulario (módulo JS por `data-tipo`); su flecha apunta a la derecha. El botón de la queja es un enlace externo al portal de OSITRAN, con flecha de esquina, pestaña nueva y helper de enlaces. La tarjeta de la queja es solo informativa y aclara que no usa el formulario.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `reclamos_conforme_titulo` | text | Título de la sección (h2). Recomendado: ~60 caracteres | ¿No estás conforme con la respuesta a tu reclamo? | sí |
| `reclamos_conforme_texto` | textarea | Párrafo bajo el título que explica los dos caminos. Recomendado: ~450 caracteres | Si ya presentaste un reclamo y recibiste la resolución de COPAM, pero no estás de acuerdo con ella, puedes pedir que tu caso se revise. Tienes dos caminos: que COPAM lo vuelva a evaluar o que lo resuelva OSITRAN. Ten a mano el número de tu reclamo y la resolución que recibiste. | sí |
| `reclamos_conforme_nota` | text | Nota breve bajo el párrafo. Recomendado: ~85 caracteres | Si estás conforme con la resolución, el procedimiento termina. | no |
| `reclamos_conforme_instancias` | repeater | Tarjetas de las instancias posteriores. 3 tarjetas. | — | sí |
| `reclamos_conforme_instancias.etiqueta` | text | Etiqueta pequeña sobre el título de la tarjeta. Recomendado: ~35 caracteres | Opcional · ante COPAM | sí |
| `reclamos_conforme_instancias.titulo` | text | Título de la tarjeta. Recomendado: ~30 caracteres | Reconsideración | sí |
| `reclamos_conforme_instancias.descripcion` | textarea | Explicación de la instancia; los plazos se marcan en verde con los marcadores del helper de texto. Recomendado: ~260 caracteres | Si tienes una nueva prueba, pide a COPAM que revise su respuesta. Preséntala dentro de los 15 días hábiles de notificada la resolución. COPAM resuelve en 15 días hábiles. | sí |
| `reclamos_conforme_instancias.boton` | link | Botón de la tarjeta: texto y destino. Los dos primeros llevan a `#formulario` con el tipo preseleccionado; el tercero es externo. | Solicitar reconsideración | sí |

Valores del repetidor (etiqueta / título / botón -> destino): Opcional · ante COPAM / Reconsideración / Solicitar reconsideración -> `#formulario` (tipo reconsideración); Ante OSITRAN / Apelación / Presentar apelación -> `#formulario` (tipo apelación), descripción "Si quieres que tu caso lo resuelva OSITRAN. Preséntala ante COPAM dentro de los 15 días hábiles de notificada la resolución; COPAM eleva el expediente al Tribunal de OSITRAN."; Informativo · OSITRAN / Queja ante OSITRAN / Ir al portal de OSITRAN -> `https://www.gob.pe/ositran`, descripción "Procede si el trámite de tu reclamo se paraliza por demoras, o si se rechaza sin justificación tu reconsideración o apelación. Se presenta ante el Tribunal de OSITRAN, no con este formulario."

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Enlaces con destinos reales; los externos con `rel` seguro y aviso de pestaña nueva (helper de enlaces de `wp-helper`)
- [ ] Repeated block: las tarjetas usan el mismo componente que `proceso` y `otros_canales`
- [ ] Los botones de Reconsideración y Apelación bajan a `#formulario` y dejan el tipo elegido, y funcionan con teclado
- [ ] La sección tiene `id="conforme"`, el contenedor `id="queja"` y el título usa `encabezado-seccion`

## Sección: documentos

- **Origen:** `reclamos.html` líneas 427-476 (datos en 1023)
- **Destino:** `template-parts/pages/reclamos/documentos.php`
- **Grupo:** `reclamos_documentos`
- **Skill:** wp-accordion
- **Comportamiento:** `id="documentos"`. Título con `encabezado-seccion`. Acordeón de 4 grupos (Normativa OSITRAN, Procedimiento, Formatos, Registro) que construye `wp-accordion`; dentro de cada uno van las filas con el componente `documentos-por-anio`: título, subtítulo, etiqueta "Vigente" opcional y botón "Descargar PDF". Aquí los grupos no son años sino categorías. Cada cabecera muestra el nombre del grupo y el contador ("1 documento", "2 documentos") que calcula la plantilla, más el ícono +/-; líneas separadoras con aparición animada. Ninguna fila lleva hoy "Vigente". Los PDF están en el sitio: campo `file` (botón "Descargar PDF" es un texto aparte que recibe `documentos-por-anio`). Mensaje de grupo vacío: el diseño lo prevé pero no trae texto; la plantilla no imprime nada si no hay documentos. Los PDF "Guía de usuario" y "Diagrama del procedimiento" son los mismos archivos que el formulario enlaza; se cargan de nuevo aquí (a confirmar si se prefiere reutilizar). Valor suelto: hover del botón `#07702F`.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `reclamos_documentos_titulo` | text | Título de la sección (h2). Recomendado: ~35 caracteres | Documentos y formatos | sí |
| `reclamos_documentos_texto_boton` | text | Texto del botón de descarga de cada fila. Recomendado: ~20 caracteres | Descargar PDF | sí |
| `reclamos_documentos_grupos` | repeater | Grupos del acordeón. 4 grupos. | — | sí |
| `reclamos_documentos_grupos.nombre` | text | Nombre del grupo, visible en la cabecera del acordeón. Recomendado: ~25 caracteres | Normativa OSITRAN | sí |
| `reclamos_documentos_grupos.documentos` | repeater | Documentos del grupo (1 o 2 en el diseño). | — | sí |
| `reclamos_documentos_grupos.documentos.titulo` | text | Nombre del documento. Recomendado: ~120 caracteres | Reglamento de Atención de Reclamos y Solución de Controversias de OSITRAN | sí |
| `reclamos_documentos_grupos.documentos.subtitulo` | text | Línea bajo el título: resolución, versión o fecha. Recomendado: ~170 caracteres | Res. de Consejo Directivo N.° 019-2011-CD-OSITRAN y modificatorias (Res. 0042-2020-CD-OSITRAN y Res. de Presidencia 0040-2025-PD-OSITRAN) | no |
| `reclamos_documentos_grupos.documentos.vigente` | true_false | Muestra la etiqueta "Vigente" junto al documento. Apagado en todos los del diseño. | no | no |
| `reclamos_documentos_grupos.documentos.archivo` | file | PDF que se descarga con el botón. | — | sí |

Valores del repetidor (grupo: documento, subtítulo): Normativa OSITRAN: Reglamento de Atención de Reclamos y Solución de Controversias de OSITRAN (Res. de Consejo Directivo N.° 019-2011-CD-OSITRAN y modificatorias...); Procedimiento: Guía de usuario · Procedimiento de atención de reclamos (Versión vigente) y Diagrama del procedimiento de atención de reclamos (Versión vigente); Formatos: Formato de reclamo físico (Hoja de reclamación para presentación en físico); Registro: Registro de reclamos (Registro publicado por COPAM). Archivos de origen en `src/assets/docs/`: `reglamento-reclamos-ositran.pdf`, `guia-procedimiento-reclamos.pdf`, `flujograma-reclamos-2026.pdf`, `formato-reclamo-fisico.pdf`, `registro-reclamos.pdf`.

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-accordion` (`references/acceptance.md` de esa skill)
- [ ] Las filas de documento usan el componente `documentos-por-anio`, sin duplicar su marcado
- [ ] Cada PDF se descarga desde su campo `file` y el contador de la cabecera coincide con el número de filas
- [ ] La sección tiene `id="documentos"` y el título usa `encabezado-seccion`

## Sección: libro

- **Origen:** `reclamos.html` líneas 478-480
- **Destino:** `template-parts/pages/reclamos/libro.php`
- **Grupo:** `reclamos_libro`
- **Skill:** ninguna
- **Comportamiento:** `id="libro"`. Usa el componente compartido `bloque-acceso` (variante `fila`, por defecto) con título, descripción, botón e imagen; sin marcado propio. El botón lleva a la página `libro-de-reclamaciones` del tema. La imagen se recorta con `object-cover`; es una foto del equipo de COPAM en el muelle (alt del diseño "Equipo de COPAM en el muelle del terminal"). Alto del bloque en el diseño: 528 px en escritorio. Valor suelto: hover del botón `#07702F`.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `reclamos_libro_titulo` | text | Título del bloque. Recomendado: ~70 caracteres | Libro de Reclamaciones (reclamos de consumo) | sí |
| `reclamos_libro_descripcion` | textarea | Texto que aclara la diferencia con el procedimiento de OSITRAN y el plazo. Recomendado: ~230 caracteres | Canal de Indecopi para reclamos de consumo, distinto del procedimiento de reclamos de OSITRAN. Plazo de respuesta: 15 días hábiles improrrogables. | sí |
| `reclamos_libro_boton` | link | Botón del bloque: texto y destino (página del Libro de Reclamaciones). | Ir al Libro de Reclamaciones | sí |
| `reclamos_libro_imagen` | image | Foto junto al texto. Se recorta para llenar el bloque. Recomendado: 2400 × 1060 px (≈2,25:1), mínimo 1200 px de ancho | — | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Imagen con `width`/`height` o `aspect-ratio` y `loading="lazy"`
- [ ] Repeated block: usa el componente `bloque-acceso` con `$args`, sin copiar su marcado
- [ ] La sección tiene `id="libro"` y el botón lleva a la página real del Libro de Reclamaciones

## Sección: derechos

- **Origen:** `reclamos.html` líneas 482-503
- **Destino:** `template-parts/pages/reclamos/derechos.php`
- **Grupo:** `reclamos_derechos`
- **Skill:** ninguna
- **Comportamiento:** `id="derechos"` (ancla del menú "Derechos del usuario" y del acceso del hero). Título con `encabezado-seccion` y una bajada con la norma. Dos tarjetas en dos columnas desde 600 px y una en móvil, con una franja de fondo y aparición escalonada (0 y 110 ms). Cada tarjeta: etiqueta, título y lista con un punto verde decorativo (`aria-hidden`) antes de cada ítem; la lista de derechos es más larga y puede ocupar dos columnas de texto como en el diseño (a verificar al maquetar). Alto de tarjeta flexible.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `reclamos_derechos_titulo` | text | Título de la sección (h2). Recomendado: ~45 caracteres | Derechos y deberes del usuario | sí |
| `reclamos_derechos_bajada` | textarea | Norma en la que se basan los derechos y deberes. Recomendado: ~230 caracteres | Reglamento de Usuarios de las Infraestructuras de Transporte de Uso Público de OSITRAN (Res. de Consejo Directivo N.° 035-2017-CD-OSITRAN). | no |
| `reclamos_derechos_derechos_etiqueta` | text | Etiqueta pequeña de la tarjeta de derechos. Recomendado: ~25 caracteres | Derechos · art. 7 | sí |
| `reclamos_derechos_derechos_titulo` | text | Título de la tarjeta de derechos. Recomendado: ~40 caracteres | Tus derechos como usuario | sí |
| `reclamos_derechos_derechos_items` | repeater | Lista de derechos. 12 ítems. | — | sí |
| `reclamos_derechos_derechos_items.texto` | text | Un derecho. Recomendado: ~60 caracteres | A la información | sí |
| `reclamos_derechos_deberes_etiqueta` | text | Etiqueta pequeña de la tarjeta de deberes. Recomendado: ~25 caracteres | Deberes · art. 8 | sí |
| `reclamos_derechos_deberes_titulo` | text | Título de la tarjeta de deberes. Recomendado: ~40 caracteres | Tus deberes como usuario | sí |
| `reclamos_derechos_deberes_items` | repeater | Lista de deberes. 5 ítems. | — | sí |
| `reclamos_derechos_deberes_items.texto` | text | Un deber. Recomendado: ~100 caracteres | Pagar la tarifa o el precio del servicio | sí |

Derechos (12): A la información; A presentar reclamos; A presentar sugerencias; A presentar denuncias; A la atención adecuada; A la calidad y cobertura del servicio; A recibir comprobante de pago; A la no discriminación; A participar en los Consejos de Usuarios del OSITRAN; A la reparación de daños; A la seguridad; Al libre uso de la infraestructura. Deberes (5): Pagar la tarifa o el precio del servicio; Mantener una conducta debida y respetar las reglas de uso; Conservar la infraestructura y evitar daños; Contar con seguro por daños a terceros, cuando corresponda; Cumplir los requisitos de acceso a facilidades esenciales, cuando corresponda.

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Las listas son `<ul>` con `<li>` y los puntos verdes son decorativos (`aria-hidden`)
- [ ] La sección tiene `id="derechos"` y el título usa `encabezado-seccion`

## Sección: otros_canales

- **Origen:** `reclamos.html` líneas 505-536
- **Destino:** `template-parts/pages/reclamos/otros-canales.php`
- **Grupo:** `reclamos_otros_canales`
- **Skill:** ninguna
- **Comportamiento:** `id="otros-canales"`. Título con `encabezado-seccion`. 3 tarjetas en rejilla de 3 columnas desde 1180 px, 2 desde 600 px y 1 en móvil; mismo componente de tarjeta que `proceso` y `conforme`, con una nota opcional bajo el texto (solo Denuncias). Botones: Denuncias, enlace externo al portal de OSITRAN (flecha de esquina, pestaña nueva, helper de enlaces); Reglamento de Usuarios, descarga de un PDF subido al sitio (campo `file`, flecha a la derecha, texto del botón aparte); Sugerencias, enlace interno al buzón de la página `contacto` (`#buzon`). Cada tarjeta usa `enlace` si lo tiene y, si no, `archivo` con `texto_archivo`. Alto de tarjeta flexible.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `reclamos_otros_canales_titulo` | text | Título de la sección (h2). Recomendado: ~40 caracteres | Otros canales del usuario | sí |
| `reclamos_otros_canales_tarjetas` | repeater | Tarjetas de canales alternativos. 3 tarjetas. | — | sí |
| `reclamos_otros_canales_tarjetas.etiqueta` | text | Etiqueta pequeña sobre el título. Recomendado: ~40 caracteres | Ante OSITRAN · Arts. 48 a 51 | sí |
| `reclamos_otros_canales_tarjetas.titulo` | text | Título de la tarjeta. Recomendado: ~30 caracteres | Denuncias | sí |
| `reclamos_otros_canales_tarjetas.descripcion` | textarea | Explicación del canal. Recomendado: ~320 caracteres | Cualquier persona puede informar al OSITRAN un posible incumplimiento de COPAM, sin necesidad de demostrar un daño. Se presenta por mesa de partes, el Portal del Usuario o la central telefónica del OSITRAN. | sí |
| `reclamos_otros_canales_tarjetas.nota` | text | Nota breve bajo la descripción, solo si hace falta. Recomendado: ~130 caracteres | Incluye tus datos, la descripción de los hechos con lugar y fecha, y pruebas si las tienes. | no |
| `reclamos_otros_canales_tarjetas.enlace` | link | Botón cuando el destino es una página o un sitio externo: texto y destino. | Ir al portal de OSITRAN | no |
| `reclamos_otros_canales_tarjetas.archivo` | file | PDF que se descarga cuando la tarjeta ofrece un documento en lugar de un enlace. | — | no |
| `reclamos_otros_canales_tarjetas.texto_archivo` | text | Texto del botón que descarga el PDF. Solo se usa si hay archivo. Recomendado: ~30 caracteres | Ver documento (PDF) | no |

Valores del repetidor (etiqueta / título -> botón): Ante OSITRAN · Arts. 48 a 51 / Denuncias -> `enlace` "Ir al portal de OSITRAN" (`https://www.gob.pe/ositran`, externo), con nota; Normativa / Reglamento de Usuarios -> `archivo` `reglamento-usuarios-ositran.pdf` con `texto_archivo` "Ver documento (PDF)", descripción "Conoce todos tus derechos y deberes como usuario del terminal. Res. de Consejo Directivo N.° 035-2017-CD-OSITRAN."; Ante COPAM / Sugerencias -> `enlace` "Ir al Buzón de sugerencias" (página `contacto`, ancla `#buzon`), descripción "Tus comentarios nos ayudan a mejorar el servicio. Envíalos por el Buzón de sugerencias."

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Enlaces con destinos reales; los externos con `rel` seguro y aviso de pestaña nueva (helper de enlaces de `wp-helper`)
- [ ] Repeated block: las tarjetas usan el mismo componente que `proceso` y `conforme`
- [ ] El PDF se descarga desde el campo `file` y la tarjeta sin nota no deja hueco
- [ ] La sección tiene `id="otros-canales"` y el título usa `encabezado-seccion`

## Sección: faq

- **Origen:** `reclamos.html` líneas 541-572 (datos en 955-972)
- **Destino:** `template-parts/pages/reclamos/faq.php`
- **Grupo:** `reclamos_faq`
- **Skill:** wp-accordion
- **Comportamiento:** `id="faq"`. Usa el componente compartido `faq-ayuda` (etiqueta fija "Ayuda" con ícono, título en dos líneas, bajada y acordeón) con el acordeón de `wp-accordion`; sin marcado propio. 5 preguntas; la primera abierta al cargar. Esta sección va al final, fuera del bloque que se apila sobre el pie (efecto de apilado del diseño: módulo JS opcional, a decidir al aplicar). Valor suelto: ninguno.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `reclamos_faq_titulo` | text | Título de la sección (h2), se parte en dos líneas. Recomendado: ~30 caracteres | Preguntas frecuentes | sí |
| `reclamos_faq_bajada` | text | Texto bajo el título. Recomendado: ~90 caracteres | Respuestas a las consultas más comunes sobre reclamos y recursos. | no |
| `reclamos_faq_items` | repeater | Preguntas y respuestas. 5 ítems. | — | sí |
| `reclamos_faq_items.pregunta` | text | Pregunta, visible en la cabecera del acordeón. Recomendado: ~80 caracteres | ¿Qué es la queja ante OSITRAN? | sí |
| `reclamos_faq_items.respuesta` | textarea | Respuesta que se despliega. Recomendado: ~320 caracteres | Es un recurso ante el Tribunal de Solución de Controversias de OSITRAN por defectos en la tramitación del procedimiento. No es un reclamo sobre el servicio y no se presenta con el formulario de esta página. | sí |

Valores del repetidor (pregunta): ¿Qué es la queja ante OSITRAN?; ¿Dónde presento mi reclamo? (respuesta: "Con el formulario de esta página, en formato físico en el terminal o por correo electrónico a servicioclientes@copam.com.pe, dentro de los 60 días de ocurrido el hecho o de conocido este."); ¿Qué datos necesito para presentar un reclamo?; ¿El Libro de Reclamaciones es lo mismo que este formulario?; ¿Qué hago si no estoy de acuerdo con la respuesta?

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-accordion` (`references/acceptance.md` de esa skill)
- [ ] Repeated block: usa el componente `faq-ayuda` con `$args`, igual que las otras 8 páginas
- [ ] La primera pregunta abre al cargar y el resto con teclado; respeta `prefers-reduced-motion`
- [ ] La sección tiene `id="faq"`
