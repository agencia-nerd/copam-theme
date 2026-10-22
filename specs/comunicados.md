# Página: Comunicados

- **Resumen:** Lista los comunicados, avisos operativos y publicaciones de COPAM; el visitante los filtra por categoría, año o texto y abre el que le interesa.
- **Fuente:** `comunicados.html`
- **Plantilla:** `home.php`
- **Tipo:** listado
- **Contenido:** comunicado
- **Secciones (en orden):** encabezado, filtros, listado, paginacion, vacio
- **Skills usadas:** ninguna
- **Grupo ACF:** Comunicados
- **Ubicación:** página de opciones: archivo de comunicado
- **Notas de página:**
  - `h1` en el encabezado ("Comunicados")
  - título SEO "Comunicados · COPAM"
  - meta descripción del diseño "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma."
  - el `noindex, nofollow` del diseño es de maqueta y no se copia
  - `category.php` reutiliza estas secciones
  - los campos viven en la página de opciones "archivo de comunicado" porque un archivo no tiene pantalla de edición
  - header, footer y aviso superior son del sitio y no se repiten
  - sin `WP_Query` ni filtrado: el contenido de muestra son 4 comunicados fijos
  - los enlaces internos apuntan a las páginas del tema, no a los `.html` del diseño
  - criterios de página: `check.mjs` sale con `0` y `header.php`/`footer.php` no se repiten en la plantilla
- **Estado:** pendiente

## Sección: encabezado

- **Origen:** `comunicados.html` líneas 158-182
- **Destino:** `template-parts/pages/comunicados/encabezado.php`
- **Grupo:** `comunicados_encabezado`
- **Skill:** ninguna
- **Comportamiento:** migas de pan `Inicio > Zona Clientes > Comunicados` en `<nav aria-label="Ruta de navegación">` con lista ordenada (el último ítem con `aria-current="page"`; "Zona Clientes" es texto sin enlace; el ícono de casa y los chevrones son SVG decorativos con `aria-hidden`); debajo, el `h1` con el título y el párrafo de introducción; las animaciones de entrada `data-rise`/`data-clip` se reescriben como módulo JS que respeta `prefers-reduced-motion`; el motor `phCols` (columnas del encabezado) se resuelve con CSS responsive; gris suelto `#8A8A8A` de los chevrones se reporta
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `comunicados_encabezado_titulo` | text | Título principal de la página de comunicados (`h1`). Se muestra en grande bajo las migas de pan. Recomendado: ~20 caracteres. | Comunicados | sí |
| `comunicados_encabezado_bajada` | textarea | Texto de introducción bajo el título. Recomendado: ~170 caracteres. | Avisos operativos, novedades y publicaciones regulatorias del Terminal Portuario de Yurimaguas – Nueva Reforma. | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Las migas de pan son una `<nav aria-label="Ruta de navegación">` y el enlace de Inicio apunta a la portada del tema
- [ ] Los SVG (casa, chevrones) son decorativos (`aria-hidden="true"`)

## Sección: filtros

- **Origen:** `comunicados.html` líneas 185-206
- **Destino:** `template-parts/pages/comunicados/filtros.php`
- **Grupo:** `ninguno`
- **Skill:** ninguna
- **Comportamiento:** `<form method="get">` que solo se documenta, sin filtrar (nunca `wp-form`). Pastillas de categoría como enlaces (`Todos`, `Operativo`, `Noticias`, `Mantenimiento`); la activa lleva `aria-current="true"` con fondo `--color-brand` y texto blanco, las inactivas fondo blanco y borde `--color-line`. Buscador: `<label>` con `<input type="search" name="s" placeholder="Buscar comunicado">` y lupa SVG decorativa. Selector de año: `<label>` con `<select name="anio" aria-label="Año">` y opciones `Año: 2026` y `Año: 2025`. En escritorio las pastillas van a la izquierda y buscador + año a la derecha; en móvil se apilan y el bloque de búsqueda envuelve (`flex-wrap`). Textos fijos (categorías y años serán términos y fechas reales al conectar la consulta). Valor suelto `#7A7A7A` de los íconos se reporta
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Los filtros son un `<form method="get">` con `label` y `name` reales, usables con teclado; no usan `wp-form`
- [ ] El form tiene un botón de enviar (puede ser oculto visualmente) para enviarse con Enter

## Sección: listado

- **Origen:** `comunicados.html` líneas 207-232
- **Destino:** `template-parts/pages/comunicados/listado.php`
- **Grupo:** `ninguno`
- **Skill:** ninguna
- **Comportamiento:** contador de resultados ("Mostrando 4 comunicados"; con varias páginas "Mostrando 1–9 de N comunicados") y rejilla de tarjetas con líneas divisorias finas: 3 columnas desde 1180 px, 2 desde 600 px y 1 en móvil, 9 por página. Cada tarjeta es el componente `template-parts/components/comunicado-card.php` (`tarjeta-comunicado` en `_shared.md`) con `$args` `titulo`, `fecha`, `categoria`, `url`, llamado con arreglos fijos con los 4 comunicados de muestra: (Operativo, "Atención restringida en ventanilla durante los feriados del 28 y 29 de julio", "18 jul 2026"), (Noticias, "Publicación del tarifario vigente 2026 aprobado por OSITRAN", "02 jul 2026"), (Noticias, "Publicación del Plan Maestro APN 2025 para el TPY-NR", "03 jun 2026"), (Mantenimiento, "Mantenimiento programado de grúas — 20 de mayo", "15 may 2026"). Cada tarjeta enlaza a `comunicado.html` del diseño, que se cambia por el permalink del comunicado (`single.php`); sin botón de acción. Colores de la pastilla por categoría (valores sueltos que se reportan): Operativo `#E4F3EA`/`#0A7434`, Noticias `#E6ECF6`/`#2A4C80`, Mantenimiento `#FBE8E5`/`#A8362A`. Las líneas divisorias se hacen con bordes CSS, no con los `span` `data-sr`. Hover con flecha animada en el círculo de la esquina. Sin `WP_Query` ni bucle: al conectar, el arreglo se reemplaza por el loop de `home.php`. Título, fecha y categoría son nativos de WordPress, sin campos ACF. La sección lleva `id="lista"` (ancla al paginar)
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] La tarjeta es un solo componente con `$args`, reutilizado en `single.php` ("Otros comunicados") y documentado en `_shared.md`
- [ ] Cada tarjeta es un único `<a>` con `<h3>` para el título; la flecha SVG es decorativa
- [ ] Rejilla de 3, 2 y 1 columnas según el ancho, como el original
- [ ] Sin `WP_Query` ni lógica de consulta

## Sección: paginacion

- **Origen:** `comunicados.html` líneas 233-241
- **Destino:** `template-parts/pages/comunicados/paginacion.php`
- **Grupo:** `ninguno`
- **Skill:** ninguna
- **Comportamiento:** `<nav aria-label="Paginación de comunicados">` con enlaces reales (no `button`): anterior (flecha, `aria-label="Página anterior"`), números de página fijos del diseño (1, 2; la actual con `aria-current="page"`, fondo `--color-brand` y texto blanco) y siguiente (`aria-label="Página siguiente"`). Anterior/siguiente sin destino se muestran desactivados (`aria-disabled="true"`, opacidad reducida). En el diseño solo aparece con más de una página (9 comunicados por página). Sin lógica: después se conecta con `paginate_links`
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] La paginación es un `<nav aria-label="Paginación de comunicados">` con enlaces reales
- [ ] El estado desactivado de anterior/siguiente se ve y se anuncia a lectores de pantalla

## Sección: vacio

- **Origen:** `comunicados.html` líneas 243-245
- **Destino:** `template-parts/pages/comunicados/vacio.php`
- **Grupo:** `comunicados_vacio`
- **Skill:** ninguna
- **Comportamiento:** mensaje centrado en un recuadro que reemplaza la rejilla y la paginación cuando los filtros o la búsqueda no devuelven comunicados. En la maqueta va oculto (`hidden`) mientras la lista de muestra tenga elementos; al conectar la consulta se muestra cuando el loop no tiene entradas. Con `role="status"`
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `comunicados_vacio_mensaje` | text | Mensaje que se muestra cuando ningún comunicado coincide con la búsqueda o los filtros. Recomendado: ~80 caracteres. | No hay comunicados que coincidan con tu búsqueda. | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] El estado vacío no se muestra junto a la rejilla con elementos
