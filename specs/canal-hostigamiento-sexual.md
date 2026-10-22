# Página: Canal de hostigamiento sexual

- **Resumen:** Canal confidencial para reportar situaciones de hostigamiento sexual en el ámbito laboral de COPAM. El visitante lee cómo funciona el procedimiento, envía un reporte (también anónimo) al Delegado y puede descargar la política vigente.
- **Fuente:** `canal-hostigamiento-sexual.html`
- **Plantilla:** `pages/template-canal-hostigamiento-sexual.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, como_funciona, reporte, politica, otros_canales
- **Skills usadas:** wp-form (reporte), wp-helper
- **Grupo ACF:** Canal de hostigamiento sexual
- **Ubicación:** plantilla pages/template-canal-hostigamiento-sexual.php
- **Notas de página:**
  - `h1` "Canal de hostigamiento sexual" en el hero
  - título SEO "Canal de hostigamiento sexual · COPAM"
  - meta descripción del diseño "Canal confidencial de COPAM para reportar situaciones de hostigamiento sexual al Delegado de prevención y sanción del hostigamiento sexual." (se ignora el `noindex`, es solo de la maqueta)
  - Anclas `#como-funciona`, `#reporte`, `#politica`, `#otros-canales`, con `scroll-margin-top` que compensa el header fijo
  - Los títulos h2 de las secciones 2 a 5 usan `encabezado-seccion` (sin etiqueta ni bajada, con línea animada), los botones `boton`, las migas `migas` (Inicio > Contacto > Canal de hostigamiento sexual
  - "Contacto" enlaza a la página de contacto), la tarjeta de documento `documento-card` y los enlaces con flecha `enlace-flecha`
  - El hero no tiene imagen en el diseño
  - La página la enlazan `contacto` (Accesos directos) y el footer
  - Elementos fuera de la página: header, footer, buscador y aviso de mantenimiento (sitio)
  - El marcador `[PENDIENTE: ... reCAPTCHA o Cloudflare Turnstile]` del diseño no se imprime: lo reemplaza el anti-spam de `wp-form`
  - Sensibilidad: los reportes son confidenciales, ver `Comportamiento` de `reporte`
  - Al aplicar: los títulos h2 usan `titulo-linea`; el hero es `hero-servicio` sin imagen; la tarjeta de la política se arma en la sección (en el diseño es una fila con píldora y botón, no la tarjeta de `documento-card`)
  - Al aplicar: el anti-spam es el del motor de wp-form; el marcador `[PENDIENTE]` no se imprime
  - Al aplicar: la evidencia (hasta 5 archivos PDF/JPG/PNG, 10 MB en total) se sube por su propio endpoint a una carpeta temporal privada de uploads, viaja adjunta en el correo y se borra al enviar (o a las 2 h si no se envía); no pasa por la biblioteca de medios
- **Estado:** aplicado

## Sección: hero

- **Origen:** `canal-hostigamiento-sexual.html` líneas 158-206
- **Destino:** `template-parts/pages/canal-hostigamiento-sexual/hero.php`
- **Grupo:** `canal_hostigamiento_sexual_hero`
- **Skill:** ninguna
- **Comportamiento:** migas con el componente `migas`. Texto a la izquierda y tarjeta "Accesos directos" a la derecha en escritorio; en móvil la tarjeta pasa debajo en una columna. El `h1` va en dos líneas ("Canal de hostigamiento" / "sexual") con entrada animada por línea: es una sola cadena en el campo, el corte lo hace el ancho. El botón usa `boton` y baja a `#reporte`. La tarjeta lista 4 enlaces a las anclas de la propia página (Cómo funciona, Enviar un reporte, Política y procedimiento, Otros canales); sus textos salen de los títulos de las secciones y no son campos, solo el título de la tarjeta. Cada fila lleva texto y una flecha que se desliza al hover. Sin imagen.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `canal_hostigamiento_sexual_hero_titulo` | text | Título principal de la página (h1). Se muestra en grande a la izquierda. Recomendado: ~45 caracteres | Canal de hostigamiento sexual | sí |
| `canal_hostigamiento_sexual_hero_bajada` | textarea | Texto bajo el título que explica qué es el canal y quién recibe los reportes. Recomendado: ~290 caracteres | Un canal confidencial para reportar situaciones de hostigamiento sexual en el ámbito laboral de COPAM. Cada reporte lo recibe y atiende el Delegado de prevención y sanción del hostigamiento sexual. | sí |
| `canal_hostigamiento_sexual_hero_boton` | link | Botón principal: texto y destino. Baja al formulario (`#reporte`). | Enviar un reporte | no |
| `canal_hostigamiento_sexual_hero_accesos_titulo` | text | Título de la tarjeta lateral de accesos directos. Recomendado: ~25 caracteres | Accesos directos | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Las migas usan `migas` con el último ítem sin enlace y `aria-current="page"`
- [x] Los 4 accesos directos llevan a las anclas de la página y la tarjeta queda debajo del texto en móvil

## Sección: como_funciona

- **Origen:** `canal-hostigamiento-sexual.html` líneas 208-231
- **Destino:** `template-parts/pages/canal-hostigamiento-sexual/como-funciona.php`
- **Grupo:** `canal_hostigamiento_sexual_como_funciona`
- **Skill:** ninguna
- **Comportamiento:** `id="como-funciona"`. Título con `encabezado-seccion`. Tres tarjetas (`h3` y párrafo), una fila en escritorio y una columna en móvil; cada una se imprime con `tarjeta-servicio` (`titulo`, `descripcion`, nivel 3). Debajo, una nota legal en párrafo pequeño con la base normativa. Entrada animada por tarjeta en un módulo JS que respeta `prefers-reduced-motion`. La tercera tarjeta es mucho más larga que las otras: el contenedor no fija alturas.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `canal_hostigamiento_sexual_como_funciona_titulo` | text | Título de la sección (h2). Recomendado: ~25 caracteres | Cómo funciona | sí |
| `canal_hostigamiento_sexual_como_funciona_tarjetas` | repeater | Tarjetas con los principios y plazos del procedimiento. 3 tarjetas. | — | sí |
| `canal_hostigamiento_sexual_como_funciona_tarjetas.titulo` | text | Título de la tarjeta (h3). Recomendado: ~25 caracteres | Confidencial | sí |
| `canal_hostigamiento_sexual_como_funciona_tarjetas.descripcion` | textarea | Texto de la tarjeta. Recomendado: ~170 caracteres en las cortas y ~520 en la de seguimiento | Tu reporte llega solo al Delegado. Se guarda reserva de tu identidad frente a personas ajenas al procedimiento. | sí |
| `canal_hostigamiento_sexual_como_funciona_nota_legal` | textarea | Nota bajo las tarjetas con la base normativa. Recomendado: ~190 caracteres | Conforme a la Ley N.° 27942, Ley de Prevención y Sanción del Hostigamiento Sexual, y su Reglamento (D.S. N.° 014-2019-MIMP). | no |

Valores del repetidor: Confidencial (arriba); Tolerancia cero ("COPAM aplica una política de tolerancia cero contra cualquier forma de hostigamiento sexual."); Seguimiento ("Las medidas de protección se dictan en un plazo máximo de 3 días hábiles. La investigación concluye en un plazo no mayor de 15 días calendario, y el procedimiento no supera los 30 días calendario desde la presentación del reporte. La decisión la emite la Oficina de Administración y Finanzas y puede impugnarse ante la Gerencia General.").

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Las tarjetas usan `tarjeta-servicio` y pasan de 3 columnas a 1 sin desbordar
- [x] El JS de entrada vive en `src/js/modules/`, se activa por `data-` o clase y respeta `prefers-reduced-motion`

## Sección: reporte

- **Origen:** `canal-hostigamiento-sexual.html` líneas 233-352
- **Destino:** `template-parts/forms/reporte-hostigamiento.php`, `template-parts/pages/canal-hostigamiento-sexual/reporte.php`
- **Grupo:** `canal_hostigamiento_sexual_reporte`
- **Skill:** wp-form
- **Comportamiento:** `id="reporte"`. Título con `encabezado-seccion`. El formulario lo construye `wp-form`; sin marcado propio. Campos, en orden: "¿Quién reporta?" (radio: Trabajador de COPAM por defecto, Proveedor o contratista, Usuario o visitante, Otro); "¿Deseas identificarte?" (radio: Sí por defecto, Prefiero no identificarme) con la nota "Puedes presentar tu reporte de forma anónima. Si deseas recibir respuesta, deja un correo de contacto.". Con Sí: Nombre y apellidos (texto, requerido, mínimo 3, solo letras), Documento de identidad (numérico, requerido, 8 a 11 dígitos, placeholder "DNI o CE"), Correo electrónico (email, requerido, "nombre@correo.com"), Teléfono (opcional, tel, solo números, + ( ) espacio y guion, de 7 a 20). Con "Prefiero no identificarme": solo "Correo de contacto (opcional)" (email, "nombre@correo.com"); nombre, documento y teléfono se ocultan, dejan de ser requeridos y no se envían. Luego "¿Eres la persona afectada?" (radio: Sí por defecto, "No, soy testigo o tercero"), Fecha aproximada de los hechos (opcional, fecha), Lugar (opcional, texto), Descripción de los hechos (textarea, requerida, mínimo 10, 5 filas), Persona(s) involucrada(s) (opcional, texto) y Adjuntar evidencia (opcional, varios archivos .pdf, .jpg, .jpeg, .png, zona de arrastre con mensaje de estado). Casilla requerida "Declaro que la información es veraz y acepto que sea tratada de forma confidencial por el Delegado.". Verificación anti-robot "No soy un robot" ("Verificación de seguridad"): el diseño deja un marcador `[PENDIENTE]`, lo resuelve el anti-spam de `wp-form` y el marcador no se imprime. Botón "Enviar reporte"; al enviar muestra el mensaje de éxito con `role="status"`. Los errores se anuncian con `role="alert"`. Destinatario: solo `denuncia.hostigamiento.s@gmail.com` (Delegado); NO se envía al destinatario genérico del sitio ni con copia a otros. CONFIDENCIAL: por defecto NO guardar los envíos en la base de datos (sin entradas guardadas, sin registrar IP ni campos en logs); el correo es la única salida. Los adjuntos viajan solo en el correo y no quedan en la biblioteca de medios. Valores sueltos: fondo de la opción activa `#F0F8F3` y borde `#DADADA`. El correo de destino no es campo de esta página: sale de `opciones_correos_hostigamiento.correo` en Ajustes del sitio (se admite más de uno).
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `canal_hostigamiento_sexual_reporte_titulo` | text | Título de la sección (h2). Recomendado: ~25 caracteres | Enviar un reporte | sí |
| `canal_hostigamiento_sexual_reporte_nota_envio` | text | Aviso bajo el formulario que indica a quién llega el reporte. Va antes del correo, que se imprime aparte. Recomendado: ~110 caracteres | Llega únicamente al Delegado de prevención y sanción del hostigamiento sexual: | no |
| `canal_hostigamiento_sexual_reporte_mensaje_exito` | text | Mensaje que se muestra tras enviar el reporte. Recomendado: ~85 caracteres | Tu reporte fue enviado de forma confidencial al Delegado. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Pasa los criterios de `wp-form` (`references/acceptance.md` de esa skill)
- [x] Cada campo tiene `label`, validación igual en el front y en PHP, y el mensaje de error se anuncia con `role="alert"`
- [x] Los grupos de opciones son `radio` reales con `fieldset`/`legend` y se manejan con teclado
- [x] Con "Prefiero no identificarme" solo queda el correo opcional y el envío anónimo se acepta; nombre, documento y teléfono no se validan ni se envían
- [x] El envío llega solo a `denuncia.hostigamiento.s@gmail.com`, no al destinatario genérico del sitio
- [x] No se guardan envíos en la base de datos ni adjuntos en la biblioteca de medios
- [x] El anti-spam elegido reemplaza al marcador `[PENDIENTE]` y este texto no se imprime
- [x] La sección tiene `id="reporte"` y el título usa `encabezado-seccion`

## Sección: politica

- **Origen:** `canal-hostigamiento-sexual.html` líneas 354-370
- **Destino:** `template-parts/pages/canal-hostigamiento-sexual/politica.php`
- **Grupo:** `canal_hostigamiento_sexual_politica`
- **Skill:** ninguna
- **Comportamiento:** `id="politica"`. Título con `encabezado-seccion`. Bajada y una tarjeta de documento con `documento-card`: título, línea normativa, píldora "Vigente" y botón "Descargar PDF". El PDF está subido al sitio (en el diseño `politica-hostigamiento-sexual.pdf`, 20 KB), por eso `archivo` es un campo ACF `file` y `documento-card` arma el enlace de descarga (pestaña nueva con `rel` seguro). El texto del botón es un campo `text` aparte. Si el archivo está vacío, la tarjeta no muestra el botón. En móvil el texto y el botón se apilan.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `canal_hostigamiento_sexual_politica_titulo` | text | Título de la sección (h2). Recomendado: ~35 caracteres | Política y procedimiento | sí |
| `canal_hostigamiento_sexual_politica_bajada` | textarea | Texto bajo el título. Recomendado: ~110 caracteres | Conoce la política de prevención y el procedimiento de atención de COPAM. | no |
| `canal_hostigamiento_sexual_politica_documento_titulo` | text | Nombre del documento en la tarjeta. Recomendado: ~130 caracteres | Políticas y procedimiento aplicable a la prevención y sanción del hostigamiento sexual | sí |
| `canal_hostigamiento_sexual_politica_documento_detalle` | text | Línea bajo el nombre con la base normativa. Recomendado: ~100 caracteres | Conforme a la Ley N.° 27942 y su Reglamento (D.S. N.° 014-2019-MIMP) | no |
| `canal_hostigamiento_sexual_politica_documento_estado` | text | Píldora con el estado del documento. Recomendado: ~15 caracteres | Vigente | no |
| `canal_hostigamiento_sexual_politica_documento_archivo` | file | PDF de la política, subido a la biblioteca de medios. Se descarga con el botón. | — | sí |
| `canal_hostigamiento_sexual_politica_documento_boton_texto` | text | Texto del botón de descarga. Recomendado: ~20 caracteres | Descargar PDF | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Destinos reales; el enlace de descarga abre en pestaña nueva con `rel` seguro
- [x] El PDF es un campo `file` y la tarjeta usa `documento-card`

## Sección: otros_canales

- **Origen:** `canal-hostigamiento-sexual.html` líneas 372-380
- **Destino:** `template-parts/pages/canal-hostigamiento-sexual/otros-canales.php`
- **Grupo:** `canal_hostigamiento_sexual_otros_canales`
- **Skill:** ninguna
- **Comportamiento:** `id="otros-canales"`. Título con `encabezado-seccion`. Dos párrafos y dos enlaces con flecha (`enlace-flecha`, la flecha se desliza al hover) en fila, que pasan a columna en móvil. Destinos: "Buzón de sugerencias" lleva a `contacto` con ancla `#buzon` y "Reclamos" a `reclamos`; son páginas del tema, no los `.html` del diseño, y pasan por el helper de enlaces.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `canal_hostigamiento_sexual_otros_canales_titulo` | text | Título de la sección (h2). Recomendado: ~20 caracteres | Otros canales | sí |
| `canal_hostigamiento_sexual_otros_canales_bajada` | textarea | Texto que indica que también se puede presentar la queja de forma verbal o escrita. Recomendado: ~160 caracteres | También puedes presentar tu queja de forma verbal o escrita ante tu jefe inmediato o ante el Delegado. | sí |
| `canal_hostigamiento_sexual_otros_canales_aviso` | textarea | Aclaración de que el buzón y los reclamos son para otros temas. Recomendado: ~100 caracteres | El Buzón de sugerencias y Reclamos son canales para otros temas. | no |
| `canal_hostigamiento_sexual_otros_canales_enlaces` | repeater | Enlaces a otros canales, con flecha. 2 enlaces. | — | sí |
| `canal_hostigamiento_sexual_otros_canales_enlaces.enlace` | link | Texto y destino del enlace. El primero es "Buzón de sugerencias" (contacto, ancla `#buzon`); el segundo, "Reclamos" (página reclamos). Recomendado: ~30 caracteres | Buzón de sugerencias | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Destinos reales: los dos enlaces apuntan a páginas del tema (`contacto#buzon`, `reclamos`) y pasan por el helper de enlaces
- [x] Page level: los enlaces internos de toda la página apuntan a las páginas del tema y la plantilla no repite header ni footer
