# Página: Inicio

- **Resumen:** Portada del Terminal Portuario de Yurimaguas – Nueva Reforma (COPAM). Presenta el terminal, sus reglamentos, servicios, conectividad y comunicados, y lleva al visitante al tarifario, a los servicios y a contactar para cotizar.
- **Fuente:** `index.html`
- **Plantilla:** `front-page.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, reglamentos, conoce, conectividad, carga, caso_destacado, servicios, desarrollo_futuro, comunicados, cta
- **Skills usadas:** wp-helper
- **Grupo ACF:** Inicio
- **Ubicación:** página de inicio (front page)
- **Notas de página:**
  - un solo `h1` en el hero (tres líneas: "Terminal Portuario", "De Yurimaguas.", "(Nueva Reforma)")
  - título SEO "COPAM · Terminal Portuario de Yurimaguas – Nueva Reforma"
  - meta descripción del diseño "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma."
  - el diseño trae `noindex, nofollow` (decidir al publicar)
  - Header, menús, footer, aviso de mantenimiento, buscador, precarga y cursor son del sitio (`opciones`), no de esta página
  - Animaciones del diseño (revelado al scroll `data-sr`, hero apilado con blur/escala, secciones con scroll fijado "pin" en conoce, conectividad y carga, parallax en caso destacado, contadores) se reescriben como módulos JS en `src/js/modules/` activados por `data-`, con teclado y `prefers-reduced-motion`
  - Bloque repetido en 6 secciones (etiqueta con ícono + título + bajada): componente `encabezado-seccion` con `$args` `etiqueta`, `titulo`, `bajada`, `nivel` (ver `_shared.md`, propuesto)
  - Enlaces a `.html` del diseño se cambian por las páginas del tema
- **Estado:** aplicado

## Sección: hero

- **Origen:** `index.html` líneas 158-292 (textos y lista `slides` en 770-775)
- **Destino:** `template-parts/pages/home/hero.php`
- **Grupo:** `home_hero`
- **Skill:** wp-helper
- **Comportamiento:** slider de 4 imágenes a pantalla (panel principal y, en escritorio, panel lateral con la siguiente imagen) con transición de recorte lateral, flechas anterior/siguiente (`<button>` con `aria-label`), autoplay de 7 s, contador "01 / 04" y barra de progreso; la imagen se recorta con `object-cover`; las imágenes de móvil usan `object-position` propio (45% y 47% en las slides 2 y 3). El `h1` va en tres líneas con animación de subida. Las imágenes pasan por `copam_theme_image`; la primera con `'loading' => 'eager'`. Botones por `copam_theme_link`; "Ver servicios" ancla a `#servicios`. En la descripción "COPAM S.A." y el nombre del terminal van resaltados con `copam_theme_highlight`. Valores sueltos: viñeta oscura (`uc4`) y lavado (`ub5`) sobre las imágenes, opacidad animada por JS.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_hero_titulo_linea_1` | text | Primera línea del título principal (h1). Se muestra en grande sobre el slider. Recomendado: ~20 caracteres | Terminal Portuario | sí |
| `home_hero_titulo_linea_2` | text | Segunda línea del título principal. Recomendado: ~25 caracteres | De Yurimaguas. | sí |
| `home_hero_titulo_linea_3` | text | Tercera línea del título, entre paréntesis y más pequeña. Recomendado: ~20 caracteres | (Nueva Reforma) | no |
| `home_hero_descripcion` | textarea | Párrafo bajo el título. Marca en otro color las partes destacadas con los marcadores del tema. Recomendado: ~250 caracteres | COPAM S.A. opera el Terminal Portuario de Yurimaguas – Nueva Reforma bajo concesión del Estado peruano, articulando el Eje Multimodal Amazonas Norte con el resto del país. | sí |
| `home_hero_boton_tarifario` | link | Primer botón: texto y destino (página Tarifario) | Tarifario vigente | sí |
| `home_hero_boton_servicios` | link | Segundo botón: texto y destino (ancla a la sección Servicios) | Ver servicios | sí |
| `home_hero_slides` | repeater | Imágenes del slider, 4 en el diseño. La primera se carga de inmediato | — | sí |
| `home_hero_slides.imagen` | image | Foto a pantalla del slider. Se recorta para llenar el bloque. Recomendado: 2560 × 1440 px (16:9), mínimo 1280 px de ancho | — | sí |
| `home_hero_slides.alt` | text | Descripción de la foto para lectores de pantalla. Recomendado: ~100 caracteres | Vista aérea del Terminal Portuario de Yurimaguas – Nueva Reforma junto al río | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Imágenes con `width`/`height` o `aspect-ratio`; la primera slide `eager`, las demás `lazy`
- [x] Botones con destinos reales y `rel` seguro (helper de enlaces)
- [x] Slider: el JS vive en `src/js/modules/`, funciona con flechas y teclado, se pausa/respeta `prefers-reduced-motion` y anuncia la slide activa
- [x] El texto del `h1` es continuo para lectores de pantalla aunque se anime por líneas

## Sección: reglamentos

- **Origen:** `index.html` líneas 294-337 (lista `docs` en `copam-shared.js` 22-27)
- **Destino:** `template-parts/pages/home/reglamentos.php`
- **Grupo:** `home_reglamentos`
- **Skill:** ninguna
- **Comportamiento:** encabezado con `encabezado-seccion`; cuatro tarjetas en rejilla (4 columnas en escritorio ancho, 2 en tableta, 1 en móvil) con etiqueta, título, descripción y botón "Descargar" que abre el PDF en pestaña nueva (el diseño añade en el `title` el tipo y peso del archivo, p. ej. "PDF · 770 KB"; con `copam_theme_link` el aviso de pestaña nueva sale en `sr-only`). Botón con hover que desliza el texto y la flecha. Enlace final "Ver toda la normativa" a la página Normativa OSITRAN. Valor suelto: hover del botón `#07702F` (también en servicios).
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_reglamentos_etiqueta` | text | Etiqueta pequeña sobre el título. Recomendado: ~45 caracteres | Cumplimiento de la concesión | sí |
| `home_reglamentos_titulo` | text | Título de la sección (h2). Recomendado: ~15 caracteres | Reglamentos | sí |
| `home_reglamentos_bajada` | text | Frase bajo el título. Recomendado: ~85 caracteres | Documentos vigentes exigidos por la concesión y por OSITRAN. | no |
| `home_reglamentos_documentos` | repeater | Tarjetas de documentos, 4 en el diseño | — | sí |
| `home_reglamentos_documentos.etiqueta` | text | Categoría de la tarjeta (OSITRAN, Tarifa, Operaciones). Recomendado: ~15 caracteres | OSITRAN | sí |
| `home_reglamentos_documentos.titulo` | text | Nombre del documento (h3). Recomendado: ~55 caracteres | Reglamento de Reclamos | sí |
| `home_reglamentos_documentos.descripcion` | textarea | Qué es el documento. Recomendado: ~180 caracteres | Reglamento de Atención de Reclamos y Solución de Controversias de OSITRAN (Res. 019-2011-CD-OSITRAN y modificatorias). | sí |
| `home_reglamentos_documentos.archivo` | file | Documento a descargar (PDF o Excel) subido a la biblioteca de medios; el botón dice "Descargar" | — | sí |
| `home_reglamentos_enlace` | link | Enlace al final de la sección | Ver toda la normativa | sí |

Valores actuales de las otras tarjetas: 2) Tarifa, "Reglamento de Tarifas y Precios de COPAM", "Reglamento de Tarifas y Precios, versión 5.3, vigente desde junio de 2026."; 3) OSITRAN, "Reglamento de Usuarios", "Reglamento de Usuarios de las Infraestructuras de Transporte de Uso Público de OSITRAN, Res. N.° 035-2017-CD-OSITRAN."; 4) Operaciones, "REOP", "Reglamento de Operaciones del TPY-NR · Código REIN-TPY-001, aprobado el 15-06-2026."

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Enlaces con destinos reales; los de descarga abren en pestaña nueva con aviso `sr-only` (helper de enlaces)
- [x] Las tarjetas son un solo bloque repetido con `$args`; la rejilla se adapta a 4/2/1 columnas

## Sección: conoce

- **Origen:** `index.html` líneas 339-386 (lista `panels` en 776-783)
- **Destino:** `template-parts/pages/home/conoce.php`
- **Grupo:** `home_conoce`
- **Skill:** ninguna
- **Comportamiento:** sección con scroll fijado ("pin"): tres paneles a pantalla completa que se cubren uno a otro con recorte (`clip-path`) mientras se hace scroll; cada panel tiene foto de fondo con viñeta oscura, la etiqueta fija "[ Conoce COPAM ]", título, descripción y un bloque de datos: los paneles 1 y 2 muestran cifras (rejilla de 2 y 3 columnas) y el panel 3 una lista con viñetas en 2 columnas. En móvil se apilan sin fijar y se leen en orden. El texto debe existir en el HTML sin depender del JS. Valores sueltos: capa oscura (`udg`, `udh`) sobre la foto; nav del sitio pasa a modo oscuro mientras esta sección está bajo la barra.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_conoce_etiqueta` | text | Etiqueta fija sobre el título de cada panel. Recomendado: ~25 caracteres | [ Conoce COPAM ] | no |
| `home_conoce_paneles` | repeater | Paneles a pantalla completa, 3 en el diseño | — | sí |
| `home_conoce_paneles.imagen` | image | Foto de fondo del panel. Se recorta para llenar la pantalla. Recomendado: 2576 × 1450 px (16:9), mínimo 1440 px de ancho | — | sí |
| `home_conoce_paneles.alt` | text | Descripción de la foto. Recomendado: ~110 caracteres | Equipo de operaciones reunido en el muelle del terminal junto a una nave y carga de proyecto | sí |
| `home_conoce_paneles.titulo` | text | Título del panel (h2). Recomendado: ~30 caracteres | El terminal | sí |
| `home_conoce_paneles.descripcion` | textarea | Párrafo del panel. Recomendado: ~230 caracteres | Infraestructura fluvial multipropósito que articula la red vial del norte del Perú con la red fluvial amazónica, integrada al Eje Multimodal Amazonas Norte. | sí |
| `home_conoce_paneles.cifras` | repeater | Cifras del panel (4 en el panel 1, 6 en el 2; vacío en el 3) | — | no |
| `home_conoce_paneles.cifras.numero` | text | Cifra con su unidad. Recomendado: ~15 caracteres | 2016 | sí |
| `home_conoce_paneles.cifras.rotulo` | text | Qué mide la cifra. Recomendado: ~35 caracteres | Inicio de operaciones | sí |
| `home_conoce_paneles.lista` | repeater | Lista con viñetas (7 en el panel 3; vacío en los demás) | — | no |
| `home_conoce_paneles.lista.texto` | text | Elemento de la lista. Recomendado: ~55 caracteres | Servicio a la nave y uso de amarradero | sí |

Contenido de los otros paneles: 1) cifras 600 mil t "Capacidad instalada anual", 181,046.99 t "Carga movilizada", 4,061 "Naves atendidas". 2) "Infraestructura principal", "Almacenamiento techado y refrigerado, patio de contenedores, muelle marginal y equipamiento de maniobra."; cifras 6,092 m² Almacén techado, 10,000 m² Patio de contenedores, 600 m² Cámara de frío, 72 Tomas reefer, 120 × 47 m Muelle marginal, 130 t Grúa celosía principal; alt "Almacén techado del terminal con montacargas y carga de madera apilada". 3) "Servicios principales", "Operación integral a la nave y a la carga: desde el amarre hasta el despacho, con soporte logístico y aduanero en el mismo terminal."; lista: Embarque, descarga y transferencia; Almacenamiento y depósito; Contenedores secos y refrigerados; Carga fraccionada y de proyecto; Soporte logístico y aduanero; Carga rodante, granel sólido y líquido; alt "Grúa izando carga de proyecto en el muelle del terminal".

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Imágenes `loading="lazy"` con proporción fija
- [x] El efecto de paneles fijados vive en `src/js/modules/`, se activa por `data-`, no oculta texto sin JS y se desactiva con `prefers-reduced-motion`
- [x] En móvil los paneles se apilan y no hay scroll horizontal

## Sección: conectividad

- **Origen:** `index.html` líneas 388-451 (lista `conn` en 787-794)
- **Destino:** `template-parts/pages/home/conectividad.php`
- **Grupo:** `home_conectividad`
- **Skill:** ninguna
- **Comportamiento:** sección con scroll fijado: a la izquierda un escenario con la imagen del mapa que cambia por etapa (6 etapas, con zoom a una zona de la imagen en las dos primeras: `crop` Paita 80,390,880,620 e IIRSA 992,750,220,260 sobre 1920 × 1150); a la derecha contador "1 / 6", título de la etapa y lista de puntos con animación. En móvil el escenario va arriba y el texto debajo. Encabezado con `encabezado-seccion` (el título tiene 4 palabras animadas por separado: se imprime como un solo `h2`). Todas las etapas deben leerse sin JS.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_conectividad_etiqueta` | text | Etiqueta pequeña sobre el título. Recomendado: ~20 caracteres | Conectividad | sí |
| `home_conectividad_titulo` | text | Título de la sección (h2). Recomendado: ~40 caracteres | Eje Multimodal Amazonas Norte | sí |
| `home_conectividad_bajada` | textarea | Párrafo bajo el título. Recomendado: ~250 caracteres | El TPY-NR es el nodo estratégico que conecta la red vial del norte del Perú con la red fluvial amazónica, articulando el tránsito de carga entre el Pacífico y el Atlántico. | sí |
| `home_conectividad_etapas` | repeater | Etapas del recorrido, 6 en el diseño (Pacífico / Paita, IIRSA Norte, Yurimaguas, Iquitos, Manaos / Roraima, Amazonas / Atlántico) | — | sí |
| `home_conectividad_etapas.titulo` | text | Nombre de la etapa (h3); también es el texto alternativo de su imagen. Recomendado: ~30 caracteres | Pacífico / Paita | sí |
| `home_conectividad_etapas.imagen` | image | Imagen del mapa o de la zona de la etapa. Se recorta para llenar el escenario. Recomendado: 3840 × 2300 px (1920:1150), mínimo 1920 px de ancho | — | sí |
| `home_conectividad_etapas.puntos` | repeater | Puntos de la etapa (de 2 a 4 en el diseño) | — | sí |
| `home_conectividad_etapas.puntos.texto` | text | Un punto de la lista. Recomendado: ~60 caracteres | Puerto de salida al océano Pacífico | sí |

Puntos de las otras etapas: Paita (+ Conexión con el corredor IIRSA Norte; Transferencia marítimo–terrestre; Acceso a rutas de Asia–Pacífico). IIRSA Norte: Corredor vial costa – sierra – selva; Enlace carretero Paita – Yurimaguas; Tránsito de carga pesada todo el año. Yurimaguas: Nodo de transferencia vial – fluvial; Terminal Portuario de Yurimaguas Nueva Reforma; Almacenamiento y servicios a la carga. Iquitos: Principal ciudad de la Amazonía peruana; Abastecimiento regional por vía fluvial; Conexión fluvial con Yurimaguas. Manaos / Roraima: Conexión con Brasil por el Amazonas; Ruta del primer piloto internacional Roraima–Manaos–Iquitos–Yurimaguas; Flujos de intercambio Brasil–Perú. Amazonas / Atlántico: Red fluvial amazónica hacia el este; Proyección logística hacia el océano Atlántico.

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Imágenes con `width`/`height` o `aspect-ratio`; `loading="lazy"`
- [x] El cambio de etapa vive en `src/js/modules/`, se activa por `data-`, respeta `prefers-reduced-motion` y sin JS todas las etapas se leen en orden
- [x] El contador "n / total" se calcula con la cantidad de etapas, no es texto fijo

## Sección: carga

- **Origen:** `index.html` líneas 453-476 (lista `cargo` en `copam-shared.js` 28)
- **Destino:** `template-parts/pages/home/carga.php`
- **Grupo:** `home_carga`
- **Skill:** ninguna
- **Comportamiento:** sección con scroll fijado: foto a pantalla completa que se revela con recorte y se oscurece (capa de atenuación 0,55); encima el título en cuatro palabras animadas (un solo `h2`), una lista de 5 tipos de carga que suben una a una y un párrafo. La imagen es decorativa para el diseño pero lleva `alt` descriptivo. Valor suelto: atenuación de la foto controlada por JS.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_carga_titulo` | text | Título de la sección (h2). Recomendado: ~30 caracteres | Carga de la Amazonía | sí |
| `home_carga_imagen` | image | Foto de fondo a pantalla. Se recorta para llenar el bloque. Recomendado: 2400 × 1350 px (16:9), mínimo 1280 px de ancho | — | sí |
| `home_carga_alt` | text | Descripción de la foto. Recomendado: ~100 caracteres | Reach stacker descargando un generador desde un camión en el patio del terminal | sí |
| `home_carga_tipos` | repeater | Tipos de carga, 5 en el diseño | — | sí |
| `home_carga_tipos.nombre` | text | Nombre del tipo de carga. Recomendado: ~30 caracteres | Madera y triplay | sí |
| `home_carga_descripcion` | textarea | Párrafo bajo la lista. Recomendado: ~190 caracteres | Movemos la carga que abastece y conecta a la región: desde insumos para la construcción hasta productos de exportación. | sí |

Otros tipos: Estructuras de fierro; Carga fraccionada; Contenedores y reefer; Torta de soya Brasil.

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Imagen `loading="lazy"` con proporción fija; texto legible sobre la foto oscurecida
- [x] El efecto fijado vive en `src/js/modules/`, se activa por `data-` y respeta `prefers-reduced-motion`

## Sección: caso_destacado

- **Origen:** `index.html` líneas 478-530
- **Destino:** `template-parts/pages/home/caso-destacado.php`
- **Grupo:** `home_caso_destacado`
- **Skill:** ninguna
- **Comportamiento:** dos columnas (760 / 920 en escritorio; apiladas en móvil). A la izquierda una foto grande y otra pequeña superpuesta, ambas con revelado por recorte y parallax vertical en sentidos opuestos (factor 1). A la derecha, encabezado con `encabezado-seccion`, título en dos líneas, párrafo y tres cifras. Los títulos de dos líneas se imprimen como un solo `h2`.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_caso_destacado_imagen_grande` | image | Foto grande de la columna izquierda. Se recorta. Recomendado: 1520 × 1900 px (4:5), mínimo 760 px de ancho | — | sí |
| `home_caso_destacado_alt_grande` | text | Descripción de la foto grande. Recomendado: ~110 caracteres | Vista aérea de camiones con la carga del primer piloto internacional en el patio del terminal | sí |
| `home_caso_destacado_imagen_pequena` | image | Foto pequeña superpuesta. Se recorta. Recomendado: 800 × 600 px (4:3), mínimo 400 px de ancho | — | sí |
| `home_caso_destacado_alt_pequena` | text | Descripción de la foto pequeña. Recomendado: ~110 caracteres | Equipo del terminal junto a la carga del primer piloto internacional con bandera de Brasil | sí |
| `home_caso_destacado_etiqueta` | text | Etiqueta pequeña sobre el título. Recomendado: ~25 caracteres | Caso destacado | sí |
| `home_caso_destacado_titulo` | text | Título (h2), dos líneas. Recomendado: ~80 caracteres | Primer piloto internacional del corredor amazónico | sí |
| `home_caso_destacado_descripcion` | textarea | Párrafo del caso. Recomendado: ~300 caracteres | Torta de soya desde Roraima, Brasil, mediante la ruta Roraima–Manaos–Iquitos–Yurimaguas–Tarapoto. La operación validó en condiciones reales la viabilidad técnica y comercial del corredor multimodal. | sí |
| `home_caso_destacado_cifras` | repeater | Cifras del caso, 3 en el diseño | — | sí |
| `home_caso_destacado_cifras.numero` | text | Cifra con su unidad. Recomendado: ~20 caracteres | 2,000 t | sí |
| `home_caso_destacado_cifras.rotulo` | text | Qué mide la cifra. Recomendado: ~30 caracteres | Total movilizado | sí |

Otras cifras: "15 días" / "Recorrido fluvial"; "Brasil – Perú" / "Ruta internacional".

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Imágenes `loading="lazy"` con `aspect-ratio`
- [x] El parallax vive en `src/js/modules/`, se activa por `data-` y respeta `prefers-reduced-motion`

## Sección: servicios

- **Origen:** `index.html` líneas 532-575 (lista `srv` en `copam-shared.js` 29-35)
- **Destino:** `template-parts/pages/home/servicios.php`
- **Grupo:** `home_servicios`
- **Skill:** ninguna
- **Comportamiento:** ancla `#servicios` (con margen de scroll bajo el header). Rejilla de 6 columnas en escritorio ancho (las tarjetas ocupan 2 columnas; con 5 tarjetas, las dos últimas ocupan 3 cada una y quedan centradas en la fila), 2 columnas desde 600 px, 1 en móvil. Cada tarjeta: título, descripción y botón "Ver detalle" al servicio. Si una tarjeta no tiene enlace se muestra en su lugar "Más información con el área comercial" que lleva al ancla `#canales` de Contacto (variante prevista por el diseño). Hover del botón `#07702F`.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_servicios_etiqueta` | text | Etiqueta pequeña sobre el título. Recomendado: ~20 caracteres | Qué hacemos | sí |
| `home_servicios_titulo` | text | Título de la sección (h2). Recomendado: ~15 caracteres | Servicios | sí |
| `home_servicios_bajada` | text | Frase bajo el título. Recomendado: ~90 caracteres | Cada servicio está descrito con la misma denominación del tarifario vigente. | no |
| `home_servicios_items` | repeater | Tarjetas de servicio, 5 en el diseño | — | sí |
| `home_servicios_items.titulo` | text | Nombre del servicio (h3). Recomendado: ~30 caracteres | Servicios a la nave | sí |
| `home_servicios_items.descripcion` | textarea | Qué incluye el servicio. Recomendado: ~150 caracteres | Amarre y desamarre y uso de amarradero para las naves que recalan en el terminal. | sí |
| `home_servicios_items.enlace` | link | Página del detalle (botón "Ver detalle"). Si está vacío se muestra "Más información con el área comercial" | — | no |

Otras tarjetas: Servicios a la carga ("Embarque, descarga, transferencia y almacenamiento de carga general, contenedores y graneles."); Servicios especiales ("Almacenamiento prolongado, consolidación, pesaje, energía reefer, provisión de equipos y otros servicios del tarifario vigente."); Depósito temporal ("Recepción, almacenamiento y retiro de mercancía bajo control aduanero de SUNAT, con requisitos y plazos propios."); Servicios al pasajero ("Embarque, desembarque y tránsito de pasajeros en naves fluviales, con áreas de espera y control de acceso."). El texto "Ver detalle" es fijo del botón.

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Enlaces con destinos reales a las páginas de servicio del tema (helper de enlaces)
- [x] `id="servicios"` presente y el botón del hero baja hasta él con el header sin tapar el título (comprobado con el header definitivo: al bajar a #servicios el título queda 40 px bajo el header)
- [x] La rejilla con 5 tarjetas (3 + 2 centradas) coincide con el diseño en escritorio

## Sección: desarrollo_futuro

- **Origen:** `index.html` líneas 577-618
- **Destino:** `template-parts/pages/home/desarrollo-futuro.php`
- **Grupo:** `home_desarrollo_futuro`
- **Skill:** ninguna
- **Comportamiento:** ancla `#desarrollo-futuro`. Encabezado con `encabezado-seccion` (título en dos líneas, un solo `h2`). Dos tarjetas lado a lado (apiladas en móvil): la primera con etiqueta, titular, párrafo y nota de resolución; la segunda con etiqueta, dos cifras grandes con rótulo y nota. Las dos tarjetas tienen estructura distinta, por eso van como campos separados y no como repeater.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_desarrollo_futuro_etiqueta` | text | Etiqueta pequeña sobre el título. Recomendado: ~20 caracteres | Proyección | sí |
| `home_desarrollo_futuro_titulo` | text | Título de la sección (h2), dos líneas. Recomendado: ~25 caracteres | Desarrollo futuro | sí |
| `home_desarrollo_futuro_bajada` | textarea | Frase bajo el título. Recomendado: ~190 caracteres | Infraestructura con capacidad de expansión: un marco de planificación aprobado y una fase de crecimiento prevista en la concesión. | no |
| `home_desarrollo_futuro_plan_etiqueta` | text | Etiqueta de la tarjeta 1. Recomendado: ~30 caracteres | Plan Maestro · APN | sí |
| `home_desarrollo_futuro_plan_titulo` | text | Titular de la tarjeta 1 (h3). Recomendado: ~40 caracteres | Aprobado en mayo de 2025 | sí |
| `home_desarrollo_futuro_plan_descripcion` | textarea | Párrafo de la tarjeta 1. Recomendado: ~320 caracteres | La Autoridad Portuaria Nacional aprobó el Plan Maestro del Terminal Portuario de Yurimaguas Nueva Reforma. Es el marco técnico que orienta el desarrollo ordenado del terminal y las decisiones sobre su evolución. | sí |
| `home_desarrollo_futuro_plan_nota` | text | Nota al pie de la tarjeta 1. Recomendado: ~95 caracteres | Resolución de Acuerdo de Directorio N.° 0052-2025-APN-DIR | no |
| `home_desarrollo_futuro_fase_etiqueta` | text | Etiqueta de la tarjeta 2. Recomendado: ~30 caracteres | Fase II contractual | sí |
| `home_desarrollo_futuro_fase_cifras` | repeater | Cifras de la tarjeta 2, 2 en el diseño | — | sí |
| `home_desarrollo_futuro_fase_cifras.numero` | text | Cifra con su unidad. Recomendado: ~25 caracteres | +400,000 t | sí |
| `home_desarrollo_futuro_fase_cifras.rotulo` | text | Qué mide la cifra. Recomendado: ~45 caracteres | Capacidad instalada adicional | sí |
| `home_desarrollo_futuro_fase_nota` | text | Nota al pie de la tarjeta 2. Recomendado: ~130 caracteres | Referencia de la concesión y del Plan de Negocios COPAM 2026. No forma parte del Plan Maestro. | no |

Segunda cifra: "USD 13.8 M + IGV" / "Inversión referencial".

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] `id="desarrollo-futuro"` presente

## Sección: comunicados

- **Origen:** `index.html` líneas 620-682 (lista `newsData` en `copam-shared.js` 36-40)
- **Destino:** `template-parts/pages/home/comunicados.php`
- **Grupo:** `home_comunicados`
- **Skill:** ninguna
- **Comportamiento:** lista de los 3 comunicados más recientes (contenido dinámico "comunicado" de `_shared.md`: entradas de WordPress); no se escriben a mano. Cada fila es un enlace a su comunicado con pastilla de categoría (color según categoría), título, fecha y botón circular con flecha (hover desliza la flecha); filas separadas por líneas. Es una presentación en fila distinta de `tarjeta-comunicado` (`comunicado-card`): si se quiere reutilizar, que el componente admita una variante `fila`. Sin comunicados la lista se oculta. Botón final "Ver todos los comunicados" a la página de comunicados (`home.php`). Los datos de las filas no son campos ACF.
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_comunicados_etiqueta` | text | Etiqueta pequeña sobre el título. Recomendado: ~15 caracteres | Actualidad | sí |
| `home_comunicados_titulo` | text | Título de la sección (h2). Recomendado: ~20 caracteres | Comunicados | sí |
| `home_comunicados_bajada` | text | Frase bajo el título. Recomendado: ~105 caracteres | Avisos operativos, novedades y publicaciones regulatorias del terminal. | no |
| `home_comunicados_boton` | link | Botón al listado completo | Ver todos los comunicados | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Listado: la fila es un componente con `$args` (`titulo`, `fecha`, `categoria`, `url`); sin `WP_Query` en la vista salvo la consulta de los 3 últimos pasada por `$args`
- [x] Cada fila enlaza al comunicado real; la fecha usa el formato "18 jul 2026"

## Sección: cta

- **Origen:** `index.html` líneas 684-706
- **Destino:** `template-parts/pages/home/cta.php`
- **Grupo:** `home_cta`
- **Skill:** ninguna
- **Comportamiento:** dos columnas: a la izquierda título (un solo `h2`, palabras animadas), párrafo y botón "Contáctanos" a `contacto` ancla `#formulario`; a la derecha foto con revelado. En móvil se apilan. Es un bloque de llamada a la acción propio de la portada (no es `bloque-acceso`, que es "Seguimiento de carga").
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `home_cta_titulo` | text | Título de la llamada a la acción (h2). Recomendado: ~75 caracteres | ¿Necesitas cotizar un servicio o coordinar una operación? | sí |
| `home_cta_descripcion` | textarea | Frase bajo el título. Recomendado: ~105 caracteres | Te acompañamos desde la cotización hasta la operación en el terminal. | no |
| `home_cta_boton` | link | Botón principal: texto y destino (Contacto, formulario) | Contáctanos | sí |
| `home_cta_imagen` | image | Foto de la derecha. Se recorta para llenar el bloque. Recomendado: 1600 × 1200 px (4:3), mínimo 800 px de ancho | — | sí |
| `home_cta_alt` | text | Descripción de la foto. Recomendado: ~100 caracteres | Montacargas y tráiler con carga en sacos en el patio del terminal | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Imagen `loading="lazy"` con `aspect-ratio`; botón con destino real (helper de enlaces)
