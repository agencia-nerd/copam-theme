# Página: Nosotros

- **Resumen:** Presenta a COPAM, su misión y visión, la concesión del terminal, el Sistema Integrado de Gestión y cómo opera el terminal; el visitante lee y salta entre secciones con el índice lateral o sigue a las páginas relacionadas.
- **Fuente:** `nosotros.html`
- **Plantilla:** `pages/template-nosotros.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, indice, mision, vision, concesion, sistema, operamos, acceso
- **Skills usadas:** ninguna
- **Grupo ACF:** Nosotros
- **Ubicación:** plantilla pages/template-nosotros.php
- **Notas de página:**
  - `h1` "Nosotros" en el hero
  - título SEO "Nosotros · COPAM"
  - meta descripción del diseño: "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (el diseño trae `noindex, nofollow`: decidir al aplicar)
  - Header, footer, menús, buscador y aviso de mantenimiento son del sitio (`opciones`) y no se repiten aquí
  - Las secciones `indice` a `acceso` van dentro de una rejilla de dos columnas (índice lateral a la izquierda, contenido a la derecha) que arma la plantilla
  - por debajo de 1000 px el índice se oculta y queda una columna
  - El índice se genera con los títulos de `mision`, `vision`, `concesion`, `sistema` y `operamos` (ids con esos mismos nombres, `scroll-margin-top` 96px) y resalta el activo al desplazarse (JS)
  - Las animaciones de entrada del diseño (`data-rise`, `data-clip`, `data-sr`, parallax del hero) se reescriben en un módulo JS que respeta `prefers-reduced-motion`
  - Las 5 secciones de contenido repiten el patrón título h2 + línea
  - la lista de datos (etiqueta/valor) y el enlace con flecha también se repiten
- **Estado:** aplicado

## Sección: hero

- **Origen:** `nosotros.html` líneas 158-179
- **Destino:** `template-parts/pages/nosotros/hero.php`
- **Grupo:** `nosotros_hero`
- **Skill:** ninguna
- **Comportamiento:** migas de pan "Inicio" (enlace a la portada, con ícono de casa) > "Nosotros" (página actual, `aria-current="page"`); son fijas, no campos. `h1` con el título y la bajada debajo. La imagen ocupa todo el ancho, con alto `clamp(310px, min(43vw, 100svh - 280px), 820px)`, `object-cover` con `object-position` 50% 55%, radio 4px y fondo gris #EFEFEF mientras carga; es la imagen principal: `'loading' => 'eager'`. Entrada por recorte y parallax suave al desplazarse (JS). Valores sueltos: radio 4px, gris #EFEFEF.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `nosotros_hero_titulo` | text | Título principal de la página (h1). Se muestra en grande bajo las migas. Recomendado: ~15 caracteres | Nosotros | sí |
| `nosotros_hero_bajada` | textarea | Texto de presentación bajo el título. Recomendado: ~260 caracteres | Concesionaria Puerto Amazonas S.A. diseña, financia, construye, opera y conserva el Terminal Portuario de Yurimaguas – Nueva Reforma, en concesión del Estado peruano. | sí |
| `nosotros_hero_imagen` | image | Imagen panorámica del hero. Se recorta para llenar el bloque (proporción variable, unos 2,1:1 en escritorio ancho). Recomendado: 2400 × 1100 px, mínimo 1280 px de ancho | — | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Imagen del hero con `loading="eager"`
- [x] Migas dentro de `<nav aria-label="Ruta de navegación">` con enlace a la portada del tema

## Sección: indice

- **Origen:** `nosotros.html` líneas 183-195 (lista en el `<script>`, línea 631)
- **Destino:** `template-parts/pages/nosotros/indice.php`
- **Grupo:** `nosotros_indice`
- **Skill:** ninguna
- **Comportamiento:** aside pegajoso en la columna izquierda (ancho `clamp(220px, 17vw, 320px)`), solo desde 1000 px. Los enlaces (Misión, Visión, La concesión, Sistema integrado de gestión, Cómo operamos) salen de los títulos de las secciones y apuntan a sus ids con desplazamiento suave; el activo va en `--color-ink` con barra `--color-brand`, los demás en gris #8C8C8C con barra #D6D6D6 (valores sueltos). Al final, enlace con flecha a Compromiso Ambiental; se oculta si el campo está vacío.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `nosotros_indice_titulo` | text | Rótulo sobre la lista de enlaces del índice lateral. Recomendado: ~25 caracteres | En esta página | sí |
| `nosotros_indice_enlace` | link | Enlace con flecha al pie del índice: texto y destino (Compromiso Ambiental) | Compromiso Ambiental | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El índice es un `<nav>` con enlaces `<a href="#id">` y cada id existe en su sección
- [x] El enlace activo se marca con `aria-current` y el JS respeta `prefers-reduced-motion`

## Sección: mision

- **Origen:** `nosotros.html` líneas 197-203
- **Destino:** `template-parts/pages/nosotros/mision.php`
- **Grupo:** `nosotros_mision`
- **Skill:** ninguna
- **Comportamiento:** `section id="mision"`; h2 con una línea horizontal a su derecha que se dibuja al entrar; debajo, un párrafo. Animación de entrada en módulo JS.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `nosotros_mision_titulo` | text | Título de la sección (h2); también es el texto del índice lateral. Recomendado: ~15 caracteres | Misión | sí |
| `nosotros_mision_texto` | textarea | Párrafo con la misión de la empresa. Recomendado: ~460 caracteres | Brindar servicios portuarios eficientes, seguros y confiables en el Terminal Portuario de Yurimaguas – Nueva Reforma, articulando la red vial del norte del Perú con la red fluvial amazónica, para impulsar el comercio de la región y contribuir al desarrollo sostenible de las comunidades en las que operamos. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`

## Sección: vision

- **Origen:** `nosotros.html` líneas 204-210
- **Destino:** `template-parts/pages/nosotros/vision.php`
- **Grupo:** `nosotros_vision`
- **Skill:** ninguna
- **Comportamiento:** igual que `mision` (`section id="vision"`, h2 con línea y un párrafo).
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `nosotros_vision_titulo` | text | Título de la sección (h2); también es el texto del índice lateral. Recomendado: ~15 caracteres | Visión | sí |
| `nosotros_vision_texto` | textarea | Párrafo con la visión de la empresa. Recomendado: ~400 caracteres | Ser el nodo logístico de referencia del Eje Multimodal Amazonas Norte, reconocido por la calidad de su servicio, su cumplimiento regulatorio y su compromiso con el medio ambiente, conectando la Amazonía peruana con los mercados del Pacífico y del Atlántico. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`

## Sección: concesion

- **Origen:** `nosotros.html` líneas 211-227
- **Destino:** `template-parts/pages/nosotros/concesion.php`
- **Grupo:** `nosotros_concesion`
- **Skill:** ninguna
- **Comportamiento:** `section id="concesion"`; h2 con línea, h3 de subtítulo, una frase de apoyo, un párrafo largo, lista de datos (cada fila con etiqueta a la izquierda y valor a la derecha, separadas por una línea fina; se apilan en móvil) y una imagen en banda 3:1 (`aspect-ratio` 600/200, radio 4px, `object-cover`, `loading="lazy"`). 5 filas de datos; el editor puede sumar o quitar filas. La plantilla oculta el subtítulo, la frase, la lista y la imagen si su campo está vacío. Animación de entrada en JS.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `nosotros_concesion_titulo` | text | Título de la sección (h2); también es el texto del índice lateral. Recomendado: ~20 caracteres | La concesión | sí |
| `nosotros_concesion_subtitulo` | text | Subtítulo (h3) bajo el título. Recomendado: ~75 caracteres | Terminal Portuario de Yurimaguas – Nueva Reforma | no |
| `nosotros_concesion_bajada` | textarea | Frase corta de apoyo bajo el subtítulo. Recomendado: ~120 caracteres | Operado por Concesionaria Puerto Amazonas S.A. (COPAM), concesionario del terminal | no |
| `nosotros_concesion_texto` | textarea | Párrafo principal sobre la concesión. Recomendado: ~590 caracteres | El Terminal Portuario de Yurimaguas – Nueva Reforma se encuentra en etapa de explotación desde el 15 de diciembre de 2016. Su diseño, financiamiento, construcción, explotación y conservación están a cargo de Concesionaria Puerto Amazonas S.A., persona jurídica de derecho privado constituida como sociedad anónima, conforme al Contrato de Concesión suscrito con el Estado peruano el 31 de mayo de 2011. | sí |
| `nosotros_concesion_datos` | repeater | Lista de datos clave en filas de etiqueta y valor. Se muestra bajo los párrafos. 5 filas en el diseño | — | no |
| `nosotros_concesion_datos.etiqueta` | text | Nombre del dato (columna izquierda). Recomendado: ~30 caracteres | Concesionario | sí |
| `nosotros_concesion_datos.valor` | text | Valor del dato (columna derecha). Recomendado: ~110 caracteres | Concesionaria Puerto Amazonas S.A. | sí |
| `nosotros_concesion_imagen` | image | Imagen en banda bajo la lista (vista aérea del terminal junto al río Huallaga). Se recorta a 3:1. Recomendado: 2720 × 907 px (3:1), mínimo 1360 px de ancho | — | no |

Filas actuales del repeater (etiqueta: valor): Concesionario: Concesionaria Puerto Amazonas S.A.; Concedente: Estado peruano, a través del Ministerio de Transportes y Comunicaciones; Regulador: OSITRAN; Autoridad portuaria: Autoridad Portuaria Nacional (APN); Gerencia General: Ing. Carmen Benítez Hernández. Alt de la imagen en el diseño: "Vista aérea del terminal junto al río Huallaga".

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] La lista de datos usa `<dl>` (etiqueta y valor asociados) y se apila en móvil
- [x] Imagen con `loading="lazy"`

## Sección: sistema

- **Origen:** `nosotros.html` líneas 228-244
- **Destino:** `template-parts/pages/nosotros/sistema.php`
- **Grupo:** `nosotros_sistema`
- **Skill:** ninguna
- **Comportamiento:** `section id="sistema"`; h2 con línea, h3, dos párrafos, lista de datos igual a la de `concesion` (5 filas) y un enlace con flecha a la página Sistema Integrado de Gestión. La plantilla oculta cada parte opcional si su campo está vacío.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `nosotros_sistema_titulo` | text | Título de la sección (h2); también es el texto del índice lateral. Recomendado: ~45 caracteres | Sistema integrado de gestión | sí |
| `nosotros_sistema_subtitulo` | text | Subtítulo (h3) con las normas. Recomendado: ~50 caracteres | ISO 9001 · ISO 14001 · ISO 45001 | no |
| `nosotros_sistema_texto` | textarea | Párrafo principal sobre el sistema y su certificación. Recomendado: ~510 caracteres | Gestionamos la operación y conservación del Terminal Portuario de Yurimaguas – Nueva Reforma bajo un Sistema Integrado de Gestión que reúne en un solo marco tres normas internacionales: calidad, gestión ambiental y seguridad y salud en el trabajo. Está certificado por AENOR y reconocido por la red internacional IQNet. | sí |
| `nosotros_sistema_alcance` | textarea | Párrafo sobre qué cubre la certificación. Recomendado: ~290 caracteres | La certificación cubre la operación portuaria —servicios a la nave, a la carga y a los pasajeros— y la conservación del terminal: mantenimiento rutinario, periódico y reparación por emergencia. | no |
| `nosotros_sistema_datos` | repeater | Lista de certificados y datos en filas de etiqueta y valor. 5 filas en el diseño | — | no |
| `nosotros_sistema_datos.etiqueta` | text | Nombre del dato (columna izquierda). Recomendado: ~25 caracteres | ISO 9001 | sí |
| `nosotros_sistema_datos.valor` | text | Valor del dato (columna derecha). Recomendado: ~100 caracteres | Gestión de la calidad · Certificado AENOR ER-0730/2018 | sí |
| `nosotros_sistema_enlace` | link | Enlace con flecha al detalle del sistema: texto y destino | Ver Sistema Integrado de Gestión | no |

Filas actuales del repeater (etiqueta: valor): ISO 9001: Gestión de la calidad · Certificado AENOR ER-0730/2018; ISO 14001: Gestión ambiental · Certificado AENOR GA-2018/0324; ISO 45001: Seguridad y salud en el trabajo · Certificado AENOR SST-0165/2018; Vigencia: Hasta el 10 de diciembre de 2027; Política del SIG: Aprobada por la Gerencia General el 21 de octubre de 2025.

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El enlace con flecha usa el helper de enlaces y apunta a la página del tema, no al `.html` del diseño

## Sección: operamos

- **Origen:** `nosotros.html` líneas 245-253
- **Destino:** `template-parts/pages/nosotros/operamos.php`
- **Grupo:** `nosotros_operamos`
- **Skill:** ninguna
- **Comportamiento:** `section id="operamos"`; h2 con línea, un párrafo, imagen en banda 3:1 (`object-position` 45% 62%, `loading="lazy"`) y enlace con flecha a la página Operación del terminal. La plantilla oculta la imagen y el enlace si su campo está vacío.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `nosotros_operamos_titulo` | text | Título de la sección (h2); también es el texto del índice lateral. Recomendado: ~20 caracteres | Cómo operamos | sí |
| `nosotros_operamos_texto` | textarea | Párrafo sobre el reglamento de operaciones, cifras del terminal y certificación PBIP. Recomendado: ~680 caracteres | El terminal opera bajo el Reglamento de Operaciones aprobado por la Autoridad Portuaria Nacional, cuya versión vigente (código REIN-TPY-001) fue aprobada el 15 de junio de 2026. Desde el inicio de sus operaciones en 2016 ha atendido 4,061 naves y movilizado 181,046.99 toneladas de carga. Además, opera bajo el Código Internacional para la Protección de los Buques y de las Instalaciones Portuarias (PBIP), con certificado vigente emitido por la DICAPI. | sí |
| `nosotros_operamos_imagen` | image | Imagen en banda bajo el párrafo (equipo de COPAM con la carga). Se recorta a 3:1. Recomendado: 2720 × 907 px (3:1), mínimo 1360 px de ancho | — | no |
| `nosotros_operamos_enlace` | link | Enlace con flecha a la operación del terminal: texto y destino | Ver Operación del terminal | no |

Alt de la imagen en el diseño: "Equipo de COPAM con la carga del primer piloto internacional hacia Brasil".

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El enlace con flecha usa el helper de enlaces y apunta a la página del tema

## Sección: acceso

- **Origen:** `nosotros.html` línea 254 (`bloque-acceso`, variante `acceso-columna`)
- **Destino:** `template-parts/pages/nosotros/acceso.php`
- **Grupo:** `nosotros_acceso`
- **Skill:** ninguna
- **Comportamiento:** componente compartido `bloque-acceso` en su variante en columna (al pie de la columna de contenido, imagen de unos 320px de alto). Se pasan `titulo`, `descripcion`, `boton` + `url` (del campo link), `imagen` y `alt`; `nota` va vacío. La variante en columna es un argumento nuevo del componente (`variante`) a sumar en `_shared.md`.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `nosotros_acceso_titulo` | text | Título del bloque de acceso al pie de la página. Recomendado: ~30 caracteres | Compromiso Ambiental | sí |
| `nosotros_acceso_descripcion` | textarea | Frase breve bajo el título. Recomendado: ~90 caracteres | Política ambiental e instrumentos de gestión del terminal. | no |
| `nosotros_acceso_boton` | link | Botón del bloque: texto y destino (Compromiso Ambiental) | Ver compromiso ambiental | sí |
| `nosotros_acceso_imagen` | image | Imagen del bloque (vista aérea del terminal rodeado de bosque amazónico). Se recorta para llenar el bloque. Recomendado: 2720 × 640 px, mínimo 1360 px de ancho | — | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Usa el componente `bloque-acceso` sin duplicar su marcado
