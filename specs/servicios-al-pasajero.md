# Página: Servicios al pasajero

- **Resumen:** Explica el servicio de embarque y desembarque de pasajeros en el terminal: qué incluye, la infraestructura disponible, su tarifa y documentos. El visitante revisa el servicio y pide una cotización.
- **Fuente:** `servicios-al-pasajero.html`
- **Plantilla:** `pages/template-servicios-al-pasajero.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, que_incluye, infraestructura, tarifas, documentos, faq, cta
- **Skills usadas:** wp-accordion (faq), wp-helper
- **Grupo ACF:** Servicios al pasajero
- **Ubicación:** plantilla pages/template-servicios-al-pasajero.php
- **Notas de página:**
  - `h1` "Servicios al pasajero" en el hero
  - Título SEO "Servicios al pasajero · COPAM"
  - meta descripción del diseño genérica ("Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma."), conviene una propia
  - Se ignora el `noindex` del diseño
  - Header, footer, aviso de mantenimiento y buscador son del sitio, no de la página
  - Los enlaces `contacto.html#formulario` y `tarifario.html` pasan a las páginas del tema
  - Las secciones 2 a 5 usan el encabezado h2 con línea (componente `encabezado-seccion` sin etiqueta ni bajada)
  - Las migas ("Inicio > Zona Clientes > Servicios al pasajero") usan el componente `migas` y no llevan campos
  - Efectos del diseño (entrada con máscara, parallax del hero, pila hero/FAQ con escala y desenfoque, líneas que se dibujan) se reescriben como módulos JS en la etapa C y respetan `prefers-reduced-motion`
  - Esta página sigue la estructura de `servicios-a-la-nave` con una sección extra (`infraestructura`) y una nota bajo "Qué incluye"
  - El script del diseño trae también datos de otras páginas (`panels`, `conn`, `slides`, `relDocs`): no se usan aquí y se descartan
- **Estado:** pendiente

## Sección: hero

- **Origen:** `servicios-al-pasajero.html` líneas 159-214
- **Destino:** `template-parts/pages/servicios-al-pasajero/hero.php`
- **Grupo:** `servicios_al_pasajero_hero`
- **Skill:** ninguna
- **Comportamiento:** migas con el componente `migas`; imagen a todo el ancho con parallax y zoom al hacer scroll, `loading="eager"` (imagen principal); título `h1`, bajada y botón "Solicitar cotización" con el componente `boton` (variante primario) que lleva al formulario de contacto; tarjeta lateral "Accesos directos" (`h2`) con 5 enlaces ancla a las secciones de la página, flecha que se desplaza 2 px al hover y borde verde `--color-brand`; en escritorio la tarjeta va a la derecha en una columna de 33.3vw y en móvil debajo del texto. Valores sueltos: hover del botón `#07702F` (ya en el componente `boton`). Los destinos de los accesos son anclas fijas (`#que-incluye`, `#infraestructura`, `#tarifas`, `#documentos`, `#faq`).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_al_pasajero_hero_titulo` | text | Título principal de la página (`h1`). Se muestra en grande sobre la imagen. Recomendado: ~35 caracteres | Servicios al pasajero | sí |
| `servicios_al_pasajero_hero_bajada` | textarea | Resumen del servicio bajo el título. Recomendado: ~230 caracteres | Embarque y desembarque de pasajeros en el Terminal Portuario de Yurimaguas – Nueva Reforma, con control de acceso, de equipaje y atención preferente. | sí |
| `servicios_al_pasajero_hero_boton` | link | Botón principal: texto y destino (formulario de contacto) | Solicitar cotización | sí |
| `servicios_al_pasajero_hero_imagen` | image | Imagen del hero a todo el ancho; se recorta para llenar el bloque. Recomendado: 2880 × 1620 px (16:9, a confirmar en la etapa C), mínimo 1440 px de ancho | — | sí |
| `servicios_al_pasajero_hero_accesos_titulo` | text | Título de la tarjeta lateral de enlaces. Recomendado: ~25 caracteres | Accesos directos | no |
| `servicios_al_pasajero_hero_accesos` | repeater | Enlaces de la tarjeta lateral (5 en el diseño). Cada uno baja a una sección de la página | — | no |
| `servicios_al_pasajero_hero_accesos.enlace` | link | Texto y ancla del acceso. Recomendado: ~35 caracteres | Qué incluye | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Imagen con `width`/`height` o `aspect-ratio` y `loading="eager"` (primera pantalla); el `alt` viene del campo de imagen
- [ ] Imagen pasa por `copam_theme_image`; botón y accesos pasan por `copam_theme_link` (componente `boton` para el botón)
- [ ] Migas con el componente `migas` y `<nav aria-label="Migas de pan">`
- [ ] Los 5 accesos llevan a las secciones `#que-incluye`, `#infraestructura`, `#tarifas`, `#documentos` y `#faq` con scroll suave, funcionan con teclado y respetan `prefers-reduced-motion`

## Sección: que_incluye

- **Origen:** `servicios-al-pasajero.html` líneas 216-233 (datos en 728-733)
- **Destino:** `template-parts/pages/servicios-al-pasajero/que-incluye.php`
- **Grupo:** `servicios_al_pasajero_que_incluye`
- **Skill:** ninguna
- **Comportamiento:** `id="que-incluye"` como ancla; encabezado h2 con línea que se dibuja (componente `encabezado-seccion`, sin etiqueta ni bajada); tarjetas en rejilla de 2 columnas desde 600 px y 1 en móvil, con aparición escalonada; sin alturas fijas. Bajo la rejilla, una nota de párrafo (opcional: el template la oculta si el campo está vacío, en la etapa ACF).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_al_pasajero_que_incluye_titulo` | text | Título de la sección (`h2`). Recomendado: ~20 caracteres | Qué incluye | sí |
| `servicios_al_pasajero_que_incluye_items` | repeater | Prestaciones incluidas, una tarjeta por ítem (4 en el diseño) | — | sí |
| `servicios_al_pasajero_que_incluye_items.titulo` | text | Nombre de la prestación (`h3`). Recomendado: ~40 caracteres | Embarque y desembarque | sí |
| `servicios_al_pasajero_que_incluye_items.descripcion` | textarea | Explicación breve de la prestación. Recomendado: ~240 caracteres | Acceso seguro desde la nave hasta la salida del terminal y viceversa, con los equipos, recursos y ambientes preparados para recibir al pasajero. | sí |
| `servicios_al_pasajero_que_incluye_nota` | textarea | Nota bajo las tarjetas. Recomendado: ~190 caracteres | Se prioriza el embarque y desembarque de personas con discapacidad, adultos mayores, mujeres gestantes y menores de edad. | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Los ítems se recorren con un bucle (no hay una tarjeta por ítem escrita a mano) y la rejilla admite más o menos ítems
- [ ] El `id="que-incluye"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: infraestructura

- **Origen:** `servicios-al-pasajero.html` líneas 235-251 (datos en 734-739)
- **Destino:** `template-parts/pages/servicios-al-pasajero/infraestructura.php`
- **Grupo:** `servicios_al_pasajero_infraestructura`
- **Skill:** ninguna
- **Comportamiento:** `id="infraestructura"` como ancla; mismo encabezado y misma rejilla de tarjetas que "Qué incluye" (2 columnas desde 600 px, 1 en móvil, aparición escalonada, sin alturas fijas). Las tarjetas de esta sección y las de "Qué incluye" tienen el mismo marcado: ver aviso de componente compartido en el informe.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_al_pasajero_infraestructura_titulo` | text | Título de la sección (`h2`). Recomendado: ~45 caracteres | Infraestructura para pasajeros | sí |
| `servicios_al_pasajero_infraestructura_items` | repeater | Instalaciones para pasajeros, una tarjeta por ítem (4 en el diseño) | — | sí |
| `servicios_al_pasajero_infraestructura_items.titulo` | text | Nombre de la instalación (`h3`). Recomendado: ~30 caracteres | Muelle de pasajeros | sí |
| `servicios_al_pasajero_infraestructura_items.descripcion` | textarea | Descripción breve de la instalación. Recomendado: ~240 caracteres | Pontón flotante de 10 m x 5 m con pilotes deslizantes que se adaptan al nivel del río y pasarela basculante. | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Los ítems se recorren con un bucle y la rejilla admite más o menos ítems
- [ ] Reutiliza el mismo marcado de tarjeta que "Qué incluye" (sin duplicarlo)
- [ ] El `id="infraestructura"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: tarifas

- **Origen:** `servicios-al-pasajero.html` líneas 253-277 (datos en 698)
- **Destino:** `template-parts/pages/servicios-al-pasajero/tarifas.php`
- **Grupo:** `servicios_al_pasajero_tarifas`
- **Skill:** ninguna
- **Comportamiento:** `id="tarifas"`; tabla de dos columnas (Prestación, Unidad de cobro) con líneas que se dibujan entre filas (1 fila en el diseño, debe admitir más); sin montos, solo la unidad de cobro. Debajo, nota con un enlace a la página Tarifario (enlace interno del tema). Semántica: `<table>` con `<th scope>` o lista de definición (decisión de marcado en la etapa C).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_al_pasajero_tarifas_titulo` | text | Título de la sección (`h2`). Recomendado: ~15 caracteres | Tarifas | sí |
| `servicios_al_pasajero_tarifas_columna_prestacion` | text | Encabezado de la primera columna. Recomendado: ~15 caracteres | Prestación | sí |
| `servicios_al_pasajero_tarifas_columna_unidad` | text | Encabezado de la segunda columna. Recomendado: ~25 caracteres | Unidad de cobro | sí |
| `servicios_al_pasajero_tarifas_filas` | repeater | Filas de la tabla (1 en el diseño) | — | sí |
| `servicios_al_pasajero_tarifas_filas.prestacion` | text | Nombre del servicio cobrado. Recomendado: ~80 caracteres | Servicio al pasajero (servicio estándar, regulado) | sí |
| `servicios_al_pasajero_tarifas_filas.unidad` | text | Unidad con la que se cobra. Recomendado: ~50 caracteres | Pasajero embarcado o desembarcado | sí |
| `servicios_al_pasajero_tarifas_nota` | wysiwyg | Nota bajo la tabla, con un enlace a la página Tarifario. Recomendado: ~330 caracteres | Los montos se aplican según el Tarifario de Servicios Portuarios vigente, aprobado por OSITRAN. Consulta el documento oficial en la página de Tarifario. El pago se realiza antes de soltar amarre de la nave de transporte. | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] La tabla tiene encabezados de columna asociados (`<th>`) y se lee bien con lector de pantalla
- [ ] El enlace "Tarifario" apunta a la página del tema, no a `tarifario.html`
- [ ] El `id="tarifas"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: documentos

- **Origen:** `servicios-al-pasajero.html` líneas 279-306 (datos en 712-721)
- **Destino:** `template-parts/pages/servicios-al-pasajero/documentos.php`, `template-parts/components/documento-card.php`
- **Grupo:** `servicios_al_pasajero_documentos`
- **Skill:** ninguna
- **Comportamiento:** `id="documentos"`; tarjetas en rejilla de 3 columnas desde 1180 px, 2 desde 600 px y 1 en móvil (3 tarjetas en el diseño; en nave son 4 columnas); cada tarjeta usa el componente compartido `documento-card` (`etiqueta`, `titulo`, `fecha`, `archivo`): enlace que abre el PDF en pestaña nueva (`copam_theme_link` pone `rel` y el aviso `sr-only`), botón circular verde con flecha de esquina, hover `#07702F` (valor suelto); separadores entre filas y columnas. El diseño muestra "PDF · tamaño" como `title`; el tamaño sale del archivo (a confirmar). Las columnas de la rejilla son del contenedor, no del componente.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_al_pasajero_documentos_titulo` | text | Título de la sección (`h2`). Recomendado: ~35 caracteres | Documentos relacionados | sí |
| `servicios_al_pasajero_documentos_items` | repeater | Documentos relacionados, una tarjeta por documento (3 en el diseño) | — | sí |
| `servicios_al_pasajero_documentos_items.etiqueta` | text | Tipo de documento, sobre el título. Recomendado: ~15 caracteres | Tarifario | no |
| `servicios_al_pasajero_documentos_items.titulo` | text | Nombre del documento (`h3`). Recomendado: ~80 caracteres | Tarifario de Servicios Portuarios | sí |
| `servicios_al_pasajero_documentos_items.fecha` | text | Vigencia o fecha de aprobación, tal como se muestra. Recomendado: ~40 caracteres | Vigente desde el 16-06-2026 | no |
| `servicios_al_pasajero_documentos_items.archivo` | file | Archivo PDF subido a la biblioteca de medios | — | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Los enlaces a PDF pasan por `copam_theme_link`, con `rel` seguro y aviso de pestaña nueva
- [ ] La tarjeta usa el componente `documento-card` con `$args` y la rejilla admite más o menos tarjetas
- [ ] El hover y el foco con teclado muestran el mismo cambio (botón y flecha) y respetan `prefers-reduced-motion`
- [ ] El `id="documentos"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: faq

- **Origen:** `servicios-al-pasajero.html` líneas 311-342 (datos en 680-686)
- **Destino:** `template-parts/components/faq-ayuda.php`, `template-parts/accordions/` (acordeón de `wp-accordion`)
- **Grupo:** `servicios_al_pasajero_faq`
- **Skill:** wp-accordion
- **Comportamiento:** usa el componente compartido `faq-ayuda` (`titulo`, `descripcion`, `items`) y el encabezado `encabezado-seccion` con etiqueta "Ayuda". `id="faq"` como ancla. Acordeón con `<details>`/`<summary>`; la primera pregunta abre por defecto en el diseño; icono más/menos blanco sobre círculo verde. Esta sección no lleva marcado propio: `wp-accordion` lo construye. En el diseño la FAQ se desliza sobre el hero (pila con escala y desenfoque); se resuelve en la etapa C.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_al_pasajero_faq_etiqueta` | text | Etiqueta con ícono sobre el título. Recomendado: ~15 caracteres | Ayuda | no |
| `servicios_al_pasajero_faq_titulo` | text | Título de la sección (`h2`). Recomendado: ~30 caracteres | Preguntas frecuentes | sí |
| `servicios_al_pasajero_faq_descripcion` | textarea | Bajada bajo el título. Recomendado: ~110 caracteres | Respuestas a las consultas más comunes sobre los servicios al pasajero. | no |
| `servicios_al_pasajero_faq_items` | repeater | Preguntas y respuestas (5 en el diseño) | — | sí |
| `servicios_al_pasajero_faq_items.pregunta` | text | Pregunta; es el texto que se toca para abrir. Recomendado: ~80 caracteres | ¿Qué incluye el servicio al pasajero? | sí |
| `servicios_al_pasajero_faq_items.respuesta` | textarea | Respuesta, sin formato. Recomendado: ~320 caracteres | Las facilidades para el embarque y desembarque de pasajeros: acceso seguro entre la nave y la salida del terminal, control de boarding pass, control de equipaje y atención médica o de emergencias cuando sea necesaria. | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Pasa los criterios de `wp-accordion` (`references/acceptance.md` de la skill)
- [ ] Usa el componente `faq-ayuda` y no redefine su marcado
- [ ] El `id="faq"` existe y el scroll deja el encabezado visible bajo el header fijo

## Sección: cta

- **Origen:** `servicios-al-pasajero.html` líneas 344-366
- **Destino:** `template-parts/components/cta-cotizar.php`
- **Grupo:** `servicios_al_pasajero_cta`
- **Skill:** ninguna
- **Comportamiento:** usa el componente compartido `cta-cotizar` (`titulo`, `bajada`, `boton`, `imagen`); bloque a dos columnas (texto 886fr, imagen 1454fr) desde 1000 px y apilado en móvil; el título entra palabra por palabra; botón "Contáctanos" con el componente `boton` que lleva al formulario de contacto; la imagen se recorta con `object-cover`, alto mínimo `max(380px, 22.9vw)` en escritorio y `56vw` en móvil, `loading="lazy"`. Mismo contenido y diseño que en `servicios-a-la-nave`.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `servicios_al_pasajero_cta_titulo` | text | Título del bloque (`h2`). Se muestra en grande junto a la imagen. Recomendado: ~90 caracteres | ¿Necesitas cotizar un servicio o coordinar una operación? | sí |
| `servicios_al_pasajero_cta_bajada` | textarea | Frase de apoyo bajo el título. Recomendado: ~110 caracteres | Te acompañamos desde la cotización hasta la operación en el terminal. | no |
| `servicios_al_pasajero_cta_boton` | link | Botón del bloque: texto y destino (formulario de contacto) | Contáctanos | sí |
| `servicios_al_pasajero_cta_imagen` | image | Imagen del bloque; se recorta para llenar la columna. Recomendado: 1800 × 760 px (aprox. 2.35:1), mínimo 900 px de ancho | — | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Imagen con `width`/`height` o `aspect-ratio` y `loading="lazy"`; pasa por `copam_theme_image`
- [ ] El bloque usa el componente `cta-cotizar` y el botón el componente `boton` con `copam_theme_link`
- [ ] El bloque se apila en móvil sin alturas fijas que corten el texto
