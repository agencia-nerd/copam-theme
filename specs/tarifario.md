# Página: Tarifario

- **Resumen:** Reúne el tarifario vigente de servicios portuarios aprobado por OSITRAN, el histórico de versiones, el Reglamento de Tarifas y Precios y los documentos relacionados. El visitante descarga la versión que necesita o pide una cotización.
- **Fuente:** `tarifario.html`
- **Plantilla:** `pages/template-tarifario.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, versiones, reta, documentos, faq, cta
- **Skills usadas:** wp-accordion (versiones, reta, faq), wp-helper
- **Grupo ACF:** Tarifario
- **Ubicación:** plantilla pages/template-tarifario.php
- **Notas de página:**
  - `h1` "Tarifario" en el hero
  - Título SEO "Tarifario · COPAM"
  - meta descripción del diseño "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (genérica
  - conviene una propia)
  - Se ignora el `noindex` del diseño
  - Header, footer, aviso de mantenimiento y buscador son del sitio
  - Anclas de la página: `#versiones` (la piden `servicios-especiales` y las demás páginas de servicios), `#reta` (la piden el menú y el pie: "Reglamento de Tarifas y Precios"), `#documentos` y `#faq`
  - Los enlaces `contacto.html#formulario`, `deposito-temporal.html#tarifas` y `operacion-del-terminal.html` pasan a las páginas del tema
  - Todo PDF es un campo `file` (tarifarios, reglamentos, políticas)
  - Componentes compartidos: `migas`, `boton`, `encabezado-seccion`, `documento-card`, `faq-ayuda`, `cta-cotizar`
  - Se reutiliza el acordeón `documentos-grupos` (template-parts/accordions/) en `versiones` y `reta`; no se crea el componente `documentos-por-anio` que se había propuesto
  - El script del diseño trae datos sin uso en el HTML (`tarifas`, `includes`, `relDocs`, `slides`, `panels`, `conn`, `docs`, `srv`, `news`): se ignoran
  - El toast de mantenimiento queda fuera de la página (es del sitio)
- **Estado:** aplicado

## Sección: hero

- **Origen:** `tarifario.html` líneas 159-206
- **Destino:** `template-parts/pages/tarifario/hero.php`
- **Grupo:** `tarifario_hero`
- **Skill:** ninguna
- **Comportamiento:** migas con el componente `migas` (Inicio > Zona Clientes > Tarifario, el último sin enlace); `h1` y bajada; botón verde "Descargar tarifario" con el componente `boton` (variante primario) que abre el PDF vigente en pestaña nueva (el diseño lo muestra con `title` "PDF · 410 KB", que el tema puede calcular del archivo); tarjeta lateral "Accesos directos" (`h2`) con 5 enlaces: 2 anclas de la página (`#reta`, `#faq`), 2 páginas internas del tema y 1 externo (Seguimiento de carga, pestaña nueva); flecha de esquina que se desplaza al hover, borde verde `--color-brand`; en escritorio la tarjeta va a la derecha en una columna de 33.3vw y en móvil se apila bajo el texto. El diseño no muestra imagen en este hero (solo un bloque decorativo vacío con parallax), por eso no se pide campo de imagen. Hover del botón `#07702F` (valor suelto). Sin alturas fijas.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `tarifario_hero_titulo` | text | Título principal de la página (`h1`). Recomendado: ~15 caracteres | Tarifario | sí |
| `tarifario_hero_bajada` | textarea | Resumen de la página bajo el título. Recomendado: ~260 caracteres | Tarifas de los servicios estándar y especiales, aprobadas por OSITRAN. Consulta la versión vigente, el Reglamento de Tarifas y Precios de COPAM y el histórico de versiones. | sí |
| `tarifario_hero_archivo` | file | Tarifario vigente en PDF, para descargar (se sube a la biblioteca de medios) | — | sí |
| `tarifario_hero_boton_texto` | text | Texto del botón de descarga. Recomendado: ~30 caracteres | Descargar tarifario | sí |
| `tarifario_hero_accesos_titulo` | text | Título de la tarjeta lateral de enlaces. Recomendado: ~25 caracteres | Accesos directos | no |
| `tarifario_hero_accesos` | repeater | Enlaces de la tarjeta lateral (5 en el diseño). Pueden bajar a una sección, ir a otra página o a un sitio externo | — | no |
| `tarifario_hero_accesos.enlace` | link | Texto y destino del acceso. Recomendado: ~60 caracteres | Reglamento de Tarifas y Precios de COPAM | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Un solo `h1` en el hero; la tarjeta lateral usa `h2`
- [x] El botón pasa por el componente `boton`; el PDF abre con `rel` seguro y aviso de pestaña nueva
- [x] Los 5 accesos pasan por `copam_theme_link`; los internos apuntan a las páginas del tema (no a `.html`) y el externo abre en pestaña nueva
- [x] Migas con el componente `migas` y `<nav aria-label="Migas de pan">`
- [x] Los accesos ancla llevan a `#reta` y `#faq` con scroll suave, funcionan con teclado y respetan `prefers-reduced-motion`; el foco con teclado muestra el mismo cambio que el hover

## Sección: versiones

- **Origen:** `tarifario.html` líneas 208-257
- **Destino:** `template-parts/pages/tarifario/versiones.php, template-parts/accordions/documentos-grupos.php`
- **Grupo:** `tarifario_versiones`
- **Skill:** wp-accordion
- **Comportamiento:** `id="versiones"` como ancla (destino de los enlaces "Ver versiones anteriores" de las páginas de servicios); `h2` con línea que se dibuja (componente `titulo-linea`). Lista de años en acordeón: cada año es una fila con el año a la izquierda, el contador de documentos ("2 documentos", "1 documento"; el tema lo calcula) y un botón circular verde con más/menos; el primer año abre por defecto. Dentro, una fila por documento con título, subtítulo, etiqueta "Vigente" opcional y botón verde "Descargar PDF" (abre en pestaña nueva, `title` "PDF · 520 KB" calculado del archivo; hover `#07702F`, valor suelto). Si un año no tiene documentos, se muestra el mensaje de sección vacía. Esta sección no lleva marcado propio de acordeón: `wp-accordion` lo construye con `<details>`/`<summary>`; el contenido de cada fila lo pinta el acordeón `documentos-grupos` (template-parts/accordions/), compartido con la sección `reta`. Años del diseño: 2026 (2 documentos), 2023 (2), 2022 (1), 2021 (1), del más reciente al más antiguo. Separadores entre años; sin alturas fijas.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `tarifario_versiones_titulo` | text | Título de la sección (`h2`). Recomendado: ~35 caracteres | Versiones del tarifario | sí |
| `tarifario_versiones_anios` | repeater | Años con sus tarifarios, uno por fila del acordeón (4 en el diseño). El primero abre por defecto | — | sí |
| `tarifario_versiones_anios.anio` | text | Nombre del grupo, normalmente el año. Recomendado: ~10 caracteres | 2026 | sí |
| `tarifario_versiones_anios.documentos` | repeater | Documentos del año (2 en el primero). Si está vacío se muestra el mensaje de sección vacía | — | no |
| `tarifario_versiones_anios.documentos.titulo` | text | Nombre del documento. Recomendado: ~50 caracteres | Tarifario de Servicios Portuarios | sí |
| `tarifario_versiones_anios.documentos.subtitulo` | text | Vigencia, tal como se muestra bajo el título. Recomendado: ~45 caracteres | Vigente a partir del 16-06-2026 | no |
| `tarifario_versiones_anios.documentos.vigente` | true_false | Muestra la etiqueta "Vigente" junto al documento | Sí | no |
| `tarifario_versiones_anios.documentos.archivo` | file | PDF del tarifario (se sube a la biblioteca de medios) | — | sí |
| `tarifario_versiones_boton_texto` | text | Texto del botón de cada documento. Recomendado: ~20 caracteres | Descargar PDF | no |
| `tarifario_versiones_vacio` | text | Mensaje cuando un año no tiene documentos. Recomendado: ~90 caracteres | Los documentos de esta sección se publicarán próximamente. | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Usa `wp-accordion` (`<details>`/`<summary>`) y pasa sus criterios (`references/acceptance.md` de la skill)
- [x] Los años y documentos se recorren con bucles; el contador "N documento(s)" se calcula, no se escribe a mano
- [x] Los botones "Descargar PDF" abren con `rel` seguro y aviso de pestaña nueva
- [x] El `id="versiones"` existe y el scroll deja el encabezado visible bajo el header fijo; `servicios-especiales` y las demás páginas de servicios enlazan a `tarifario#versiones`
- [x] Reutiliza `documentos-grupos` (template-parts/accordions/documentos-grupos.php); no se crea `documentos-por-anio`

## Sección: reta

- **Origen:** `tarifario.html` líneas 259-308
- **Destino:** `template-parts/pages/tarifario/reta.php, template-parts/accordions/documentos-grupos.php`
- **Grupo:** `tarifario_reta`
- **Skill:** wp-accordion
- **Comportamiento:** `id="reta"` como ancla (la usan el acceso directo del hero, el menú y el pie: "Reglamento de Tarifas y Precios"); `h2` con línea (componente `titulo-linea`). Mismo acordeón `documentos-grupos` que `versiones`; aquí 2 grupos: "2026" (Reglamento V 5.3, con etiqueta "Vigente") y "Anterior" (V 5.2); el primero abre por defecto. El nombre del grupo no tiene que ser un año. Sin marcado propio de acordeón (lo construye `wp-accordion`).
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `tarifario_reta_titulo` | text | Título de la sección (`h2`). Recomendado: ~60 caracteres | Reglamento de Tarifas y Precios de COPAM | sí |
| `tarifario_reta_grupos` | repeater | Grupos de versiones del reglamento, uno por fila del acordeón (2 en el diseño). El primero abre por defecto | — | sí |
| `tarifario_reta_grupos.nombre` | text | Nombre del grupo (año o "Anterior"). Recomendado: ~15 caracteres | 2026 | sí |
| `tarifario_reta_grupos.documentos` | repeater | Documentos del grupo (1 en cada uno). Si está vacío se muestra el mensaje de sección vacía | — | no |
| `tarifario_reta_grupos.documentos.titulo` | text | Nombre del documento. Recomendado: ~95 caracteres | Reglamento de Tarifas y Precios de COPAM · V 5.3 · junio 2026 | sí |
| `tarifario_reta_grupos.documentos.subtitulo` | text | Estado o vigencia, bajo el título. Recomendado: ~25 caracteres | Vigente | no |
| `tarifario_reta_grupos.documentos.vigente` | true_false | Muestra la etiqueta "Vigente" junto al documento | Sí | no |
| `tarifario_reta_grupos.documentos.archivo` | file | PDF del reglamento (se sube a la biblioteca de medios) | — | sí |
| `tarifario_reta_boton_texto` | text | Texto del botón de cada documento. Recomendado: ~20 caracteres | Descargar PDF | no |
| `tarifario_reta_vacio` | text | Mensaje cuando un grupo no tiene documentos. Recomendado: ~90 caracteres | Los documentos de esta sección se publicarán próximamente. | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Usa `wp-accordion` y pasa sus criterios (`references/acceptance.md` de la skill)
- [x] Reutiliza `documentos-grupos`; no repite su marcado
- [x] Los botones "Descargar PDF" abren con `rel` seguro y aviso de pestaña nueva
- [x] El `id="reta"` existe, el scroll deja el encabezado visible bajo el header fijo y `tarifario#reta` funciona desde el menú y el pie

## Sección: documentos

- **Origen:** `tarifario.html` líneas 310-337
- **Destino:** `template-parts/pages/tarifario/documentos.php, template-parts/components/documento-card.php`
- **Grupo:** `tarifario_documentos`
- **Skill:** ninguna
- **Comportamiento:** `id="documentos"`; `h2` con línea (componente `encabezado-seccion`); tarjetas con el componente `documento-card` en rejilla de 3 columnas desde 1180 px, 2 desde 600 px y 1 en móvil; cada tarjeta es un enlace a un PDF en pestaña nueva con etiqueta, título, fecha y botón circular verde con flecha de esquina (hover `#07702F`, valor suelto); separadores entre filas y columnas. Mismo bloque que `servicios-especiales` (documentos). En el diseño las etiquetas (Tarifario, Política, Reglamento) salen en gris por defecto (`#F2F2F2` / `#2B2B2B`), porque el mapa de colores solo cubre las categorías de comunicados.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `tarifario_documentos_titulo` | text | Título de la sección (`h2`). Recomendado: ~35 caracteres | Documentos relacionados | sí |
| `tarifario_documentos_items` | repeater | Documentos relacionados, una tarjeta por documento (3 en el diseño) | — | sí |
| `tarifario_documentos_items.etiqueta` | text | Tipo de documento, sobre el título. Recomendado: ~15 caracteres | Tarifario | no |
| `tarifario_documentos_items.titulo` | text | Nombre del documento (`h3`). Recomendado: ~60 caracteres | Tarifario del Depósito Temporal | sí |
| `tarifario_documentos_items.fecha` | text | Vigencia o fecha de aprobación, tal como se muestra. Recomendado: ~45 caracteres | Vigente desde el 23-10-2025 | no |
| `tarifario_documentos_items.archivo` | file | PDF del documento (se sube a la biblioteca de medios) | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Los enlaces a PDF llevan `rel` seguro y aviso de pestaña nueva (lo arma el componente `documento-card`)
- [x] La tarjeta es el componente `documento-card` con `$args` y la rejilla admite más o menos tarjetas
- [x] El hover y el foco con teclado muestran el mismo cambio (botón y flecha) y respetan `prefers-reduced-motion`
- [x] El `id="documentos"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: faq

- **Origen:** `tarifario.html` líneas 342-373
- **Destino:** `template-parts/pages/tarifario/faq.php`, `template-parts/components/faq-ayuda.php`, `template-parts/accordions/faq-ayuda.php`
- **Grupo:** `tarifario_faq`
- **Skill:** wp-accordion
- **Comportamiento:** usa el componente compartido `faq-ayuda` (`titulo`, `descripcion`, `items`) y `encabezado-seccion` con etiqueta "Ayuda". `id="faq"` como ancla (la usa el acceso directo del hero). Acordeón con `<details>`/`<summary>`; la primera pregunta abre por defecto en el diseño; icono más/menos blanco sobre círculo verde. Esta sección no lleva marcado propio: `wp-accordion` lo construye. En el diseño la FAQ se desliza sobre la sección anterior (pila con escala y desenfoque, espacio `faqHold`); se resuelve en la etapa C. Mismo bloque que las otras páginas de servicios.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `tarifario_faq_etiqueta` | text | Etiqueta con ícono sobre el título. Recomendado: ~10 caracteres | Ayuda | no |
| `tarifario_faq_titulo` | text | Título de la sección (`h2`). Recomendado: ~30 caracteres | Preguntas frecuentes | sí |
| `tarifario_faq_descripcion` | textarea | Bajada bajo el título. Recomendado: ~110 caracteres | Respuestas a las consultas más comunes sobre la aplicación de las tarifas. | no |
| `tarifario_faq_items` | repeater | Preguntas y respuestas (5 en el diseño) | — | sí |
| `tarifario_faq_items.pregunta` | text | Pregunta; es el texto que se toca para abrir. Recomendado: ~60 caracteres | ¿En qué moneda se cobran los servicios? | sí |
| `tarifario_faq_items.respuesta` | textarea | Respuesta, sin formato. Recomendado: ~660 caracteres | Todas las tarifas del terminal se expresan en soles (S/) y no incluyen el IGV, salvo que el documento indique expresamente lo contrario. El impuesto se agrega al momento de la facturación, según la normativa tributaria vigente. En el caso de servicios prestados a usuarios del exterior, la moneda y el tratamiento tributario se confirman con el área comercial antes de emitir la cotización. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Pasa los criterios de `wp-accordion` (`references/acceptance.md` de la skill)
- [x] Usa el componente `faq-ayuda` y no redefine su marcado
- [x] El `id="faq"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: cta

- **Origen:** `tarifario.html` líneas 375-392
- **Destino:** `template-parts/pages/tarifario/cta.php`
- **Grupo:** `tarifario_cta`
- **Skill:** ninguna
- **Comportamiento:** usa el componente compartido `cta-cotizar` (`titulo`, `bajada`, `boton`, `imagen`). Bloque a dos columnas (texto 886fr, imagen 1454fr) desde 1000 px y apilado en móvil; el título entra palabra por palabra; botón "Solicitar cotización" con `boton` hacia el formulario de contacto; imagen con `object-cover`, alto mínimo `max(380px, 22.9vw)` en escritorio y `56vw` en móvil, `loading="lazy"`. Aquí el texto es propio ("¿Necesitas una cotización?"), distinto al de las otras páginas de servicios; el componente es el mismo.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `tarifario_cta_titulo` | text | Título del bloque (`h2`). Se muestra en grande junto a la imagen. Recomendado: ~40 caracteres | ¿Necesitas una cotización? | sí |
| `tarifario_cta_bajada` | textarea | Frase de apoyo bajo el título. Recomendado: ~130 caracteres | Nuestro equipo Comercial calcula el costo de tu operación según el tarifario vigente. | no |
| `tarifario_cta_boton` | link | Botón del bloque: texto y destino (formulario de contacto) | Solicitar cotización | sí |
| `tarifario_cta_imagen` | image | Imagen del bloque (camión en la báscula del terminal); se recorta para llenar la columna. Recomendado: 2400 × 900 px (aprox. 2.7:1), mínimo 1200 px de ancho | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Imagen con `width`/`height` o `aspect-ratio` y `loading="lazy"`; pasa por `copam_theme_image`
- [x] El bloque usa el componente `cta-cotizar` y su botón `boton` con `copam_theme_link`
- [x] El bloque se apila en móvil sin alturas fijas que corten el texto
