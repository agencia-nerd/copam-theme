# Página: Compromiso Ambiental

- **Resumen:** Explica el compromiso ambiental de COPAM en el Terminal Portuario de Yurimaguas (política ambiental, prácticas operativas, instrumentos de gestión y cumplimiento normativo); el visitante lee la política y salta entre secciones con el índice lateral.
- **Fuente:** `compromiso-ambiental.html`
- **Plantilla:** `pages/template-compromiso-ambiental.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, indice, compromiso, politica, operacion, instrumentos, cumplimiento, galeria, acceso
- **Skills usadas:** wp-helper
- **Grupo ACF:** Compromiso Ambiental
- **Ubicación:** plantilla pages/template-compromiso-ambiental.php
- **Notas de página:**
  - `h1` "Compromiso Ambiental" en el hero (el diseño lo parte en dos líneas)
  - título SEO "Compromiso Ambiental · COPAM"
  - meta descripción del diseño: "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (genérica, conviene una propia
  - el diseño trae `noindex, nofollow`: se ignora, es solo de la maqueta)
  - Header, footer, menús, buscador y aviso de mantenimiento son del sitio (`opciones`) y no se repiten aquí
  - Las secciones `indice` a `acceso` van en una rejilla de dos columnas (índice lateral de `clamp(220px, 17vw, 320px)` + contenido) que arma la plantilla
  - bajo 1000 px el índice se oculta
  - El índice se genera con los títulos de `compromiso`, `politica`, `operacion`, `instrumentos` y `cumplimiento` (ids con esos nombres) y resalta el activo al desplazarse (JS, mismo módulo que `nosotros` y `sistema-integrado-de-gestion`)
  - Las 5 secciones de contenido usan `titulo-linea`
  - los enlaces con flecha, `enlace-flecha`
  - las migas, `migas`
  - el cierre, `bloque-acceso` en variante columna
  - Las imágenes se suben a la biblioteca de medios (el `alt` del diseño se guarda ahí)
  - Las animaciones del diseño (`data-rise`, `data-clip`, `data-sr`, parallax del hero) se reescriben en un módulo JS que respeta `prefers-reduced-motion`
- **Estado:** aplicado

## Sección: hero

- **Origen:** `compromiso-ambiental.html` líneas 158-182
- **Destino:** `template-parts/pages/compromiso-ambiental/hero.php`
- **Grupo:** `compromiso_ambiental_hero`
- **Skill:** ninguna
- **Comportamiento:** componente `migas` con "Inicio" (portada, ícono de casa) > "Nosotros" (página Nosotros) > "Compromiso Ambiental" (actual, `aria-current="page"`); son fijas, no campos. `h1` centrado en dos líneas ("Compromiso" / "Ambiental") y la bajada centrada debajo. Imagen a todo el ancho con el margen lateral de la página, `object-cover`; es la imagen principal: `'loading' => 'eager'`. Entrada por recorte lateral y parallax suave al desplazarse (JS). Mismo hero que `sistema-integrado-de-gestion`; el alto exacto de la imagen se toma del CSS (`styles.css`) al aplicar.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `compromiso_ambiental_hero_titulo` | text | Título principal de la página (h1). Se muestra en grande y centrado bajo las migas, partido en dos líneas. Recomendado: ~30 caracteres | Compromiso Ambiental | sí |
| `compromiso_ambiental_hero_bajada` | textarea | Texto de presentación bajo el título. Recomendado: ~230 caracteres | Operamos en la Amazonía peruana, a orillas del río Huallaga. Conoce la política ambiental y los instrumentos de gestión que orientan nuestra operación. | sí |
| `compromiso_ambiental_hero_imagen` | image | Imagen panorámica del hero (reach stacker cargando un contenedor en el patio, con vegetación amazónica). Se recorta para llenar el bloque. Recomendado: 2400 × 1100 px, mínimo 1280 px de ancho | — | sí |

Alt de la imagen en el diseño: "Reach stacker cargando un contenedor sobre un camión en el patio del terminal, con vegetación amazónica al fondo".

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Imagen del hero con `loading="eager"`
- [x] Migas dentro de `<nav aria-label="Ruta de navegación">` con enlaces a la portada y a Nosotros del tema

## Sección: indice

- **Origen:** `compromiso-ambiental.html` líneas 186-198 (ids en el `<script>`, línea 612)
- **Destino:** `template-parts/pages/compromiso-ambiental/indice.php`
- **Grupo:** `compromiso_ambiental_indice`
- **Skill:** ninguna
- **Comportamiento:** aside pegajoso en la columna izquierda, solo desde 1000 px (rejilla `clamp(220px, 17vw, 320px)` + contenido). Los enlaces (Nuestro compromiso, Política ambiental, Cómo lo aplicamos en la operación, Instrumentos de gestión ambiental, Cumplimiento normativo) salen de los títulos de las cinco secciones y apuntan a sus ids (`compromiso`, `politica`, `operacion`, `instrumentos`, `cumplimiento`) con desplazamiento suave; el activo va en `--color-ink` con barra `--color-brand`, los demás en gris #8C8C8C con barra #D6D6D6 (valores sueltos). Al final, componente `enlace-flecha` a Nosotros; se oculta si el campo está vacío. Mismo bloque que el índice de `sistema-integrado-de-gestion`.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `compromiso_ambiental_indice_titulo` | text | Rótulo sobre la lista de enlaces del índice lateral. Recomendado: ~25 caracteres | En esta página | sí |
| `compromiso_ambiental_indice_enlace` | link | Enlace con flecha al pie del índice: texto y destino (Nosotros) | Nosotros | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El índice es un `<nav>` con enlaces `<a href="#id">` y cada id existe en su sección
- [x] El enlace activo se marca con `aria-current` y el JS respeta `prefers-reduced-motion`
- [x] El enlace con flecha usa el componente `enlace-flecha` y apunta a la página del tema

## Sección: compromiso

- **Origen:** `compromiso-ambiental.html` líneas 200-207
- **Destino:** `template-parts/pages/compromiso-ambiental/compromiso.php`
- **Grupo:** `compromiso_ambiental_compromiso`
- **Skill:** ninguna
- **Comportamiento:** `section id="compromiso"`; `titulo-linea`, un párrafo y debajo una imagen ancha (radio 4px, fondo gris #EFEFEF mientras carga, `loading="lazy"`). Entrada por recorte en JS.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `compromiso_ambiental_compromiso_titulo` | text | Título de la sección (h2); también es el texto del índice lateral. Recomendado: ~30 caracteres | Nuestro compromiso | sí |
| `compromiso_ambiental_compromiso_texto` | textarea | Párrafo que explica el compromiso ambiental del terminal. Recomendado: ~600 caracteres | El Terminal Portuario de Yurimaguas – Nueva Reforma opera a orillas del río Huallaga, en un entorno amazónico de alto valor ecológico. Por eso integramos la prevención de impactos ambientales en la planificación de nuestras operaciones, cumplimos la normativa ambiental aplicable y promovemos prácticas responsables entre nuestros colaboradores, usuarios y proveedores. | sí |
| `compromiso_ambiental_compromiso_imagen` | image | Imagen bajo el párrafo (comunidad ribereña reflejada en un río amazónico). Se recorta para llenar el bloque. Recomendado: proporción del diseño (se confirma del CSS al aplicar), mínimo 1000 px de ancho | — | no |

Alt de la imagen en el diseño: "Comunidad ribereña reflejada en un río amazónico".

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Usa `titulo-linea` sin duplicar su marcado
- [x] Imagen con `loading="lazy"`

## Sección: politica

- **Origen:** `compromiso-ambiental.html` líneas 208-215
- **Destino:** `template-parts/pages/compromiso-ambiental/politica.php`
- **Grupo:** `compromiso_ambiental_politica`
- **Skill:** ninguna
- **Comportamiento:** `section id="politica"`; `titulo-linea`, un párrafo y una lista de compromisos con viñeta verde (`--color-brand`, círculo decorativo `aria-hidden`), 2 en el diseño. Al pie, `enlace-flecha` a Sistema Integrado de Gestión; se oculta si el campo está vacío. Entrada por recorte en JS.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `compromiso_ambiental_politica_titulo` | text | Título de la sección (h2); también es el texto del índice lateral. Recomendado: ~30 caracteres | Política ambiental | sí |
| `compromiso_ambiental_politica_intro` | textarea | Frase que introduce la política y menciona la certificación. Recomendado: ~270 caracteres | Nuestra política ambiental forma parte de la Política del Sistema Integrado de Gestión, con un sistema de gestión ambiental certificado en ISO 14001 (AENOR GA-2018/0324). | sí |
| `compromiso_ambiental_politica_compromisos` | repeater | Lista de compromisos ambientales, uno por viñeta. 2 en el diseño | — | sí |
| `compromiso_ambiental_politica_compromisos.texto` | textarea | Texto del compromiso. Recomendado: ~170 caracteres | Conservar el ambiente mediante el buen uso de nuestros recursos y la prevención de la contaminación. | sí |
| `compromiso_ambiental_politica_enlace` | link | Enlace con flecha al pie de la sección: texto y destino (Sistema Integrado de Gestión) | Ver Sistema Integrado de Gestión | no |

Compromisos actuales:
- Conservar el ambiente mediante el buen uso de nuestros recursos y la prevención de la contaminación.
- Contribuir a la mitigación (reducción de emisiones) y a la adaptación del terminal ante el cambio climático.

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Los compromisos son una lista `<ul>/<li>`; la viñeta es decorativa
- [x] Usa `titulo-linea` y `enlace-flecha` sin duplicar su marcado

## Sección: operacion

- **Origen:** `compromiso-ambiental.html` línea 216
- **Destino:** `template-parts/pages/compromiso-ambiental/operacion.php`
- **Grupo:** `compromiso_ambiental_operacion`
- **Skill:** ninguna
- **Comportamiento:** `section id="operacion"`; `titulo-linea` y una rejilla de tarjetas numeradas (4 en el diseño): número, h3 y párrafo. El número (01, 02...) lo calcula la plantilla por el orden, no es campo. El editor puede sumar o quitar tarjetas; las columnas por ancho se toman del CSS al aplicar. Entrada por recorte escalonada en JS.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `compromiso_ambiental_operacion_titulo` | text | Título de la sección (h2); también es el texto del índice lateral. Recomendado: ~50 caracteres | Cómo lo aplicamos en la operación | sí |
| `compromiso_ambiental_operacion_items` | repeater | Una tarjeta por práctica operativa. 4 tarjetas en el diseño; el número se genera solo | — | sí |
| `compromiso_ambiental_operacion_items.titulo` | text | Título de la tarjeta (h3). Recomendado: ~45 caracteres | Prevención de derrames | sí |
| `compromiso_ambiental_operacion_items.texto` | textarea | Descripción de la práctica. Recomendado: ~180 caracteres | Las áreas de trabajo cuentan con kits antiderrames para evitar la contaminación del suelo y del agua. | sí |

Tarjetas actuales (título: texto):
- Prevención de derrames: Las áreas de trabajo cuentan con kits antiderrames para evitar la contaminación del suelo y del agua.
- Gestión de residuos: Los residuos generados en cada actividad se disponen conforme al procedimiento de gestión de residuos del terminal.
- Recojo de residuos de naves: El recojo de residuos sólidos y líquidos lo realizan empresas con licencia de la APN, que entregan el Certificado de Descarga de Residuos.
- Reglas para usuarios y proveedores: Está prohibido generar vertimientos, emisiones, derrames o abandonar residuos dentro del terminal.

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Las tarjetas se imprimen con un bucle del repeater y el número sale del orden
- [x] Usa `titulo-linea` sin duplicar su marcado

## Sección: instrumentos

- **Origen:** `compromiso-ambiental.html` líneas 217-224
- **Destino:** `template-parts/pages/compromiso-ambiental/instrumentos.php`
- **Grupo:** `compromiso_ambiental_instrumentos`
- **Skill:** ninguna
- **Comportamiento:** `section id="instrumentos"`; `titulo-linea`, un párrafo y dos imágenes en fila (una grande y una más pequeña; proporciones del CSS al aplicar), `loading="lazy"`. Entrada por recorte escalonada en JS.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `compromiso_ambiental_instrumentos_titulo` | text | Título de la sección (h2); también es el texto del índice lateral. Recomendado: ~50 caracteres | Instrumentos de gestión ambiental | sí |
| `compromiso_ambiental_instrumentos_texto` | textarea | Frase sobre el Instrumento de Gestión Ambiental (IGA). Recomendado: ~110 caracteres | COPAM cuenta con un Instrumento de Gestión Ambiental (IGA) aprobado. | sí |
| `compromiso_ambiental_instrumentos_imagen_principal` | image | Imagen grande de la fila (mono tocón sobre una rama). Se recorta para llenar el bloque. Recomendado: proporción del diseño (se confirma del CSS al aplicar), mínimo 800 px de ancho | — | no |
| `compromiso_ambiental_instrumentos_imagen_secundaria` | image | Imagen pequeña de la fila (tucán sobre una rama). Se recorta para llenar el bloque. Recomendado: proporción del diseño (se confirma del CSS al aplicar), mínimo 500 px de ancho | — | no |

Alt en el diseño: "Mono tocón descansando sobre una rama en la Amazonía" y "Tucán posado sobre una rama en el bosque amazónico".

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Usa `titulo-linea` sin duplicar su marcado
- [x] Imágenes con `loading="lazy"`

## Sección: cumplimiento

- **Origen:** `compromiso-ambiental.html` líneas 225-233
- **Destino:** `template-parts/pages/compromiso-ambiental/cumplimiento.php`
- **Grupo:** `compromiso_ambiental_cumplimiento`
- **Skill:** ninguna
- **Comportamiento:** `section id="cumplimiento"`; `titulo-linea`, un párrafo, una imagen ancha (radio 4px, `loading="lazy"`) y `enlace-flecha` a Normativa OSITRAN; se oculta si el campo está vacío. Entrada por recorte en JS.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `compromiso_ambiental_cumplimiento_titulo` | text | Título de la sección (h2); también es el texto del índice lateral. Recomendado: ~35 caracteres | Cumplimiento normativo | sí |
| `compromiso_ambiental_cumplimiento_texto` | textarea | Párrafo sobre las normas que rigen la operación. Recomendado: ~310 caracteres | La operación del terminal se rige por el Contrato de Concesión, el Reglamento de Operaciones aprobado por la Autoridad Portuaria Nacional y la normativa ambiental aplicable a la actividad portuaria. | sí |
| `compromiso_ambiental_cumplimiento_imagen` | image | Imagen ancha bajo el párrafo (vista aérea de un río amazónico entre el bosque). Se recorta para llenar el bloque. Recomendado: proporción del diseño (se confirma del CSS al aplicar), mínimo 1000 px de ancho | — | no |
| `compromiso_ambiental_cumplimiento_enlace` | link | Enlace con flecha al pie: texto y destino (Normativa OSITRAN) | Ver Normativa OSITRAN | no |

Alt de la imagen en el diseño: "Vista aérea de un río amazónico entre el bosque tropical".

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Usa `titulo-linea` y `enlace-flecha` sin duplicar su marcado
- [x] El enlace usa el helper de enlaces y apunta a la página Normativa OSITRAN del tema

## Sección: galeria

- **Origen:** `compromiso-ambiental.html` línea 234
- **Destino:** `template-parts/pages/compromiso-ambiental/galeria.php`
- **Grupo:** `compromiso_ambiental_galeria`
- **Skill:** ninguna
- **Comportamiento:** franja de 3 imágenes en fila, sin título, al final de la columna de contenido, después de `cumplimiento` (no entra en el índice). Cada imagen con `object-cover` y `loading="lazy"`; entrada por recorte escalonada en JS. La plantilla no imprime la franja si el campo está vacío.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `compromiso_ambiental_galeria_imagenes` | gallery | Tres imágenes de cierre (bosque y casas ribereñas, guacamayos rojos, vista aérea del terminal). Se muestran en fila y se recortan para llenar cada bloque. Recomendado: 3 imágenes, mínimo 600 px de ancho cada una | — | no |

Alt en el diseño: "Bosque tropical y casas ribereñas reflejadas en un río amazónico"; "Pareja de guacamayos rojos posados en una rama del bosque amazónico"; "Vista aérea del terminal portuario rodeado de bosque amazónico junto al río".

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Cada imagen se imprime con `copam_theme_image`
- [x] Imágenes con `loading="lazy"`

## Sección: acceso

- **Origen:** `compromiso-ambiental.html` línea 235 (`bloque-acceso`, variante `acceso-columna`)
- **Destino:** `template-parts/pages/compromiso-ambiental/acceso.php`
- **Grupo:** `compromiso_ambiental_acceso`
- **Skill:** ninguna
- **Comportamiento:** componente compartido `bloque-acceso` con `variante` `columna` (ya definida en `_shared.md`), al pie de la columna de contenido, imagen de unos 320px de alto. Se incluye desde `pages/template-compromiso-ambiental.php` con los campos de este grupo en `$args`: `titulo`, `descripcion`, `boton` + `url` (del campo link), `imagen` y `alt`; `nota` va vacío. Mismo patrón que `acceso` de `sistema-integrado-de-gestion`.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `compromiso_ambiental_acceso_titulo` | text | Título del bloque de acceso al pie de la página. Recomendado: ~35 caracteres | Conoce más sobre COPAM | sí |
| `compromiso_ambiental_acceso_descripcion` | textarea | Frase breve bajo el título. Recomendado: ~90 caracteres | La concesión, nuestra misión y visión, y cómo operamos. | no |
| `compromiso_ambiental_acceso_boton` | link | Botón del bloque: texto y destino (Nosotros) | Ir a Nosotros | sí |
| `compromiso_ambiental_acceso_imagen` | image | Imagen del bloque (equipo de COPAM en el terminal). Se recorta para llenar el bloque. Recomendado: 2720 × 640 px, mínimo 1360 px de ancho | — | no |

Alt de la imagen en el diseño: "Equipo de COPAM en el terminal".

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Usa el componente `bloque-acceso` sin duplicar su marcado
