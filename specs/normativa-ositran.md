# Página: Normativa OSITRAN

- **Resumen:** Reúne las normas que rigen al terminal: reglamentos y resoluciones de OSITRAN, el Reglamento de Operaciones y el contrato de concesión con el Estado peruano. El visitante busca y descarga el documento que necesita o sigue al portal de OSITRAN.
- **Fuente:** `normativa-ositran.html`
- **Plantilla:** `pages/template-normativa-ositran.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, normativa, contrato, documentos
- **Skills usadas:** wp-accordion (normativa), wp-helper
- **Grupo ACF:** Normativa OSITRAN
- **Ubicación:** plantilla pages/template-normativa-ositran.php
- **Notas de página:**
  - `h1` "Normativa" en el hero
  - Título SEO "Normativa OSITRAN · COPAM"
  - meta descripción del diseño "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (genérica, igual en otras páginas
  - conviene una propia)
  - Se ignora el `noindex` del diseño
  - Header, footer, aviso de mantenimiento y buscador son del sitio, no de la página
  - Migas "Inicio > Reglamentos > Normativa OSITRAN" con el componente `migas`, sin campos
  - Las secciones 2 a 4 usan el encabezado `h2` con línea (componente `titulo-linea`)
  - Las tarjetas de contrato y de documentos relacionados son el mismo componente `documento-card`
  - El enlace "Ver Operación del terminal" y los accesos a Tarifario y Transparencia pasan a las páginas del tema, no a los `.html` del diseño
  - Las anclas `#normativa`, `#contrato` y `#documentos` las usan el menú y el pie del sitio (`normativa-ositran.html#contrato`): deben conservarse con esos ids
  - Parámetro de URL del diseño `?grupo=resoluciones` abre los grupos de resoluciones tarifarias (ver sección normativa)
  - Los PDF locales están en `src/assets/docs/` y pasan a la biblioteca de medios
  - hay 3 enlaces del contrato y 1 reglamento que apuntan a PDF externos de OSITRAN
  - Efectos del diseño (entrada con máscara, líneas que se dibujan, botón con texto deslizante) son comportamiento visual: se reescriben como módulos JS en la etapa C y respetan `prefers-reduced-motion`
  - Código del diseño sin uso en esta página (carrusel `slides`, `panels`, `conn`, `faqs`, `includes`, `tarifas`, `relDocs`, `docs`, `services`): se ignora
  - Componentes compartidos usados: `migas`, `boton`, `titulo-linea`, `documento-card`, `enlace-flecha`
- **Estado:** pendiente

## Sección: hero

- **Origen:** `normativa-ositran.html` líneas 158-205
- **Destino:** `template-parts/pages/normativa-ositran/hero.php`
- **Grupo:** `normativa_ositran_hero`
- **Skill:** ninguna
- **Comportamiento:** migas con el componente `migas`; título `h1`, bajada y botón "Ir al portal OSITRAN" con el componente `boton` (variante primario) que abre el portal externo en pestaña nueva (`copam_theme_link` pone `rel` y el aviso `sr-only`); no hay imagen en el hero del diseño; tarjeta lateral "Accesos directos" (`h2`) con 5 enlaces: 3 anclas a secciones de esta página y 2 a páginas del tema (Tarifario, Transparencia), flecha que se desplaza 2 px al hover y borde verde `--color-brand`; en escritorio la tarjeta va a la derecha en una columna de 33.3vw y en móvil debajo del texto. Valores sueltos: hover del botón `#07702F` (ya en el componente `boton`). Anclas fijas: `#normativa`, `#contrato`, `#documentos`.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `normativa_ositran_hero_titulo` | text | Título principal de la página (`h1`). Se muestra en grande. Recomendado: ~15 caracteres | Normativa | sí |
| `normativa_ositran_hero_bajada` | textarea | Resumen de la página bajo el título. Recomendado: ~180 caracteres | Reglamentos y resoluciones de OSITRAN aplicables al terminal, y el contrato de concesión suscrito con el Estado peruano. | sí |
| `normativa_ositran_hero_boton` | link | Botón principal: texto y destino (portal de OSITRAN, pestaña nueva) | Ir al portal OSITRAN | sí |
| `normativa_ositran_hero_accesos_titulo` | text | Título de la tarjeta lateral de enlaces. Recomendado: ~25 caracteres | Accesos directos | no |
| `normativa_ositran_hero_accesos` | repeater | Enlaces de la tarjeta lateral (5 en el diseño). Cada uno baja a una sección de la página o lleva a otra página | — | no |
| `normativa_ositran_hero_accesos.enlace` | link | Texto y destino del acceso. Recomendado: ~35 caracteres | Reglamentos de OSITRAN | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Botón con el componente `boton` y `copam_theme_link`; el enlace externo abre en pestaña nueva con `rel` seguro y aviso `sr-only`
- [ ] Migas con el componente `migas` y `<nav aria-label="Migas de pan">`
- [ ] Los 3 accesos ancla llevan a `#normativa`, `#contrato` y `#documentos` con scroll suave, funcionan con teclado y respetan `prefers-reduced-motion`; Tarifario y Transparencia apuntan a las páginas del tema
- [ ] La tarjeta lateral se apila bajo el texto en móvil sin alturas fijas

## Sección: normativa

- **Origen:** `normativa-ositran.html` líneas 207-259 (datos en `groups`, líneas 686-706 del script)
- **Destino:** `template-parts/pages/normativa-ositran/normativa.php`, `template-parts/accordions/` (acordeón de `wp-accordion`)
- **Grupo:** `normativa_ositran_normativa`
- **Skill:** wp-accordion
- **Comportamiento:** `id="normativa"` como ancla; encabezado con el componente `titulo-linea`. Lista de 5 grupos desplegables (acordeón de `wp-accordion` sobre `<details>`/`<summary>`; esta sección no lleva marcado propio): cada cabecera muestra el nombre del grupo, el contador y un ícono más/menos blanco sobre círculo verde. El contador es automático: "N documentos" (o "1 documento") según los documentos cargados; si el grupo no tiene documentos muestra el texto del campo `estado_vacio` ("Por confirmar") y, al abrirse, el mensaje fijo "Los documentos de esta sección se publicarán próximamente." Solo el primer grupo abre por defecto. El diseño abre además los grupos 3 y 4 (resoluciones tarifarias) cuando la URL trae `?grupo=resoluciones`; se conserva como comportamiento del acordeón (a confirmar en la etapa C). Cada documento es una fila con título, detalle, insignia fija "Vigente" cuando está marcado y botón "Descargar PDF" (texto fijo, con texto deslizante al hover, `#07702F` valor suelto) que abre el PDF en pestaña nueva (`copam_theme_link`, tipo `file` para PDF local). El grupo "Reglamento de Operaciones (APN)" lleva al final el enlace "Ver Operación del terminal" con el componente `enlace-flecha` hacia la página Operación del terminal. El título del PDF en el diseño muestra "PDF · tamaño" (a confirmar si el tamaño sale del archivo). Un documento (RETA) apunta a un PDF externo de OSITRAN. Decisión: los documentos son un repeater anidado dentro del repeater de grupos (la lista de 5 grupos y sus documentos es contenido editable por el cliente).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `normativa_ositran_normativa_titulo` | text | Título de la sección (`h2`). Recomendado: ~30 caracteres | Normativa aplicable | sí |
| `normativa_ositran_normativa_grupos` | repeater | Grupos de documentos desplegables (5 en el diseño) | — | sí |
| `normativa_ositran_normativa_grupos.titulo` | text | Nombre del grupo, visible en la cabecera del desplegable. Recomendado: ~70 caracteres | Reglamentos de OSITRAN | sí |
| `normativa_ositran_normativa_grupos.estado_vacio` | text | Texto del contador cuando el grupo no tiene documentos. Si hay documentos se ignora. Recomendado: ~20 caracteres | — | no |
| `normativa_ositran_normativa_grupos.enlace_extra` | link | Enlace opcional al final del grupo (en el diseño, "Ver Operación del terminal" en el grupo del Reglamento de Operaciones). Recomendado: ~35 caracteres | — | no |
| `normativa_ositran_normativa_grupos.documentos` | repeater | Documentos del grupo (5 en el primero; el último grupo no tiene) | — | no |
| `normativa_ositran_normativa_grupos.documentos.titulo` | text | Nombre del documento o norma. Recomendado: ~90 caracteres | Ley de creación del OSITRAN | sí |
| `normativa_ositran_normativa_grupos.documentos.detalle` | text | Número de resolución, fecha o descripción bajo el título. Recomendado: ~160 caracteres | Ley N.° 26917 · Ley de Supervisión de la Inversión Privada en Infraestructura de Transporte de Uso Público | no |
| `normativa_ositran_normativa_grupos.documentos.vigente` | true_false | Marca el documento con la insignia "Vigente" | — | no |
| `normativa_ositran_normativa_grupos.documentos.archivo` | file | PDF del documento (se sube a la biblioteca de medios). Si el documento está en otro sitio, usa el campo `enlace_externo` | — | no |
| `normativa_ositran_normativa_grupos.documentos.enlace_externo` | url | Dirección del documento cuando no se sube a la web (en el diseño, el RETA en el portal de OSITRAN). Solo se usa si no hay archivo | — | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-accordion` (`references/acceptance.md` de la skill)
- [ ] Encabezado con el componente `titulo-linea`; el `id="normativa"` existe y el scroll deja el encabezado visible bajo el header fijo
- [ ] Grupos y documentos se recorren con bucles (sin una fila escrita a mano por ítem); un grupo sin documentos muestra su `estado_vacio` y el mensaje de próximamente
- [ ] El contador dice "1 documento" o "N documentos" según los cargados, sin escribirlo a mano
- [ ] Los enlaces a PDF pasan por `copam_theme_link`, con `rel` seguro y aviso de pestaña nueva
- [ ] Solo el primer grupo abre por defecto; `?grupo=resoluciones` abre los grupos de resoluciones tarifarias (si se mantiene en la etapa C)
- [ ] El enlace "Ver Operación del terminal" apunta a la página del tema, no a `operacion-del-terminal.html`

## Sección: contrato

- **Origen:** `normativa-ositran.html` líneas 261-290 (datos en `contractCards`, líneas 681-685 del script)
- **Destino:** `template-parts/pages/normativa-ositran/contrato.php`, `template-parts/components/documento-card.php`
- **Grupo:** `normativa_ositran_contrato`
- **Skill:** ninguna
- **Comportamiento:** `id="contrato"` como ancla (la usan el menú y el pie del sitio); encabezado con el componente `titulo-linea`; párrafo introductorio; tarjetas con el componente compartido `documento-card` (etiqueta, `h3`, fecha y botón circular verde con flecha de esquina) en rejilla de 3 columnas desde 1180 px, 2 desde 600 px y 1 en móvil, con separadores entre filas y columnas; cada tarjeta es un enlace a un PDF externo de OSITRAN que abre en pestaña nueva (`copam_theme_link`); al hover el botón pasa a `#07702F` (valor suelto) y la flecha sale por una esquina y entra por otra. Al final, enlace con flecha (componente `enlace-flecha`) al portal de OSITRAN, en pestaña nueva.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `normativa_ositran_contrato_titulo` | text | Título de la sección (`h2`). Recomendado: ~35 caracteres | Contrato de concesión | sí |
| `normativa_ositran_contrato_descripcion` | textarea | Párrafo bajo el título que resume el contrato. Recomendado: ~320 caracteres | Suscrito con el Estado peruano el 31 de mayo de 2011 para el diseño, financiamiento, construcción, conservación y explotación del TPY-NR. El contrato, sus anexos y adendas se publican en el portal de OSITRAN. | no |
| `normativa_ositran_contrato_items` | repeater | Documentos del contrato, una tarjeta por documento (3 en el diseño) | — | sí |
| `normativa_ositran_contrato_items.etiqueta` | text | Tipo de documento, sobre el título. Recomendado: ~15 caracteres | Contrato | no |
| `normativa_ositran_contrato_items.titulo` | text | Nombre del documento (`h3`). Recomendado: ~60 caracteres | Contrato de concesión y anexos | sí |
| `normativa_ositran_contrato_items.fecha` | text | Fecha, vigencia o fuente, tal como se muestra. Recomendado: ~45 caracteres | Publicado por OSITRAN | no |
| `normativa_ositran_contrato_items.archivo` | link | Enlace al documento (PDF externo del portal de OSITRAN, pestaña nueva) | — | sí |
| `normativa_ositran_contrato_enlace` | link | Enlace final al portal de OSITRAN: texto y destino. Recomendado: ~80 caracteres | Ver anexos y más documentos en el portal de OSITRAN | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Los enlaces pasan por `copam_theme_link`, con `rel` seguro y aviso de pestaña nueva
- [ ] La tarjeta es el componente `documento-card` con `$args` y la rejilla admite más o menos tarjetas
- [ ] El hover y el foco con teclado muestran el mismo cambio (botón y flecha) y respetan `prefers-reduced-motion`
- [ ] Encabezado con `titulo-linea`; el `id="contrato"` existe (el menú del sitio enlaza a `normativa-ositran#contrato`) y el scroll deja el encabezado visible bajo el header fijo
- [ ] El enlace final usa el componente `enlace-flecha`

## Sección: documentos

- **Origen:** `normativa-ositran.html` líneas 292-319 (datos en `relCards`, líneas 676-680 del script)
- **Destino:** `template-parts/pages/normativa-ositran/documentos.php`, `template-parts/components/documento-card.php`
- **Grupo:** `normativa_ositran_documentos`
- **Skill:** ninguna
- **Comportamiento:** `id="documentos"` como ancla; encabezado con el componente `titulo-linea`; mismas tarjetas `documento-card` y misma rejilla que la sección contrato (3 columnas desde 1180 px, 2 desde 600 px, 1 en móvil), pero cada tarjeta abre un PDF local de COPAM u OSITRAN subido a la biblioteca de medios, en pestaña nueva (`copam_theme_link`). El diseño muestra "PDF · tamaño" como `title` de la tarjeta; el tamaño sale del archivo (a confirmar). Valor suelto: hover `#07702F`.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `normativa_ositran_documentos_titulo` | text | Título de la sección (`h2`). Recomendado: ~35 caracteres | Documentos relacionados | sí |
| `normativa_ositran_documentos_items` | repeater | Documentos relacionados, una tarjeta por documento (3 en el diseño) | — | sí |
| `normativa_ositran_documentos_items.etiqueta` | text | Tipo de documento, sobre el título. Recomendado: ~15 caracteres | Reglamento | no |
| `normativa_ositran_documentos_items.titulo` | text | Nombre del documento (`h3`). Recomendado: ~80 caracteres | Reglamento de Tarifas y Precios de COPAM · V 5.3 | sí |
| `normativa_ositran_documentos_items.fecha` | text | Vigencia, fecha de aprobación o resolución, tal como se muestra. Recomendado: ~70 caracteres | Vigente desde junio de 2026 | no |
| `normativa_ositran_documentos_items.archivo` | file | PDF del documento (se sube a la biblioteca de medios) | — | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Los enlaces a PDF pasan por `copam_theme_link`, con `rel` seguro y aviso de pestaña nueva
- [ ] La tarjeta es el componente `documento-card` con `$args` y la rejilla admite más o menos tarjetas
- [ ] El hover y el foco con teclado muestran el mismo cambio (botón y flecha) y respetan `prefers-reduced-motion`
- [ ] Encabezado con `titulo-linea`; el `id="documentos"` existe y el scroll deja el encabezado visible bajo el header fijo
