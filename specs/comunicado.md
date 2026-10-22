# Página: Comunicado

- **Resumen:** Detalle de un comunicado del terminal: el visitante lee el aviso completo, vuelve al listado, copia el enlace o revisa otros comunicados.
- **Fuente:** `comunicado.html`
- **Plantilla:** `single.php`
- **Tipo:** detalle
- **Contenido:** comunicado
- **Secciones (en orden):** cabecera, cuerpo, otros
- **Skills usadas:** ninguna
- **Grupo ACF:** Comunicado
- **Ubicación:** tipo de contenido = comunicado
- **Notas de página:**
  - `h1` = título de la entrada (nativo)
  - Título SEO "Comunicado · COPAM" y meta descripción del diseño ("Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma."): en WordPress salen del título de la entrada y del extracto
  - Título, contenido, fecha, categoría e imagen destacada son nativos de las entradas (post): no se documentan como campos
  - el diseño no muestra imagen destacada ni PDF adjunto, así que no hay campos extra confirmados en el detalle (si luego se quiere un adjunto, se agrega un campo `file` en cuerpo, a confirmar con el usuario)
  - Las migas de pan (Inicio > Comunicados > título) se generan por código
  - No se repiten header, footer, buscador, aviso de mantenimiento, precarga ni cursor
  - Los efectos de entrada (`data-rise`, `data-clip`, `data-sr`) se reescriben como módulo JS
  - decisión del usuario (2026-10-22): "Otros comunicados" muestra las 2 entradas más recientes distintas de la actual (`get_posts`); sin otras entradas, la sección no se muestra
- **Estado:** aplicado

## Sección: cabecera

- **Origen:** `comunicado.html` líneas 158-189
- **Destino:** `template-parts/pages/comunicado/cabecera.php`
- **Grupo:** ninguno
- **Skill:** ninguna
- **Comportamiento:** migas de pan (`nav aria-label="Ruta de navegación"`): Inicio (ícono casa) > Comunicados (enlaza al listado) > título actual con `aria-current="page"`; la categoría es una pastilla de color según el término (Operativo `#E4F3EA`/`#0A7434`, Noticias `#E6ECF6`/`#2A4C80`, Mantenimiento `#FBE8E5`/`#A8362A`, otro `#F2F2F2`/`#2B2B2B`; valores sueltos, no tokens); fecha con "Publicado el " + fecha de la entrada (formato `18 jul 2026`); `h1` con el título de la entrada (la animación por palabra se hace en JS, no en el marcado); línea fina debajo. Todo el texto viene de WordPress: sin campos
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Migas de pan con `aria-current="page"` en el último elemento y enlace real al listado
- [x] La pastilla de categoría cambia de color según el término y lleva texto
- [x] Un solo `h1` (el título de la entrada)

## Sección: cuerpo

- **Origen:** `comunicado.html` líneas 190-201
- **Destino:** `template-parts/pages/comunicado/cuerpo.php`
- **Grupo:** ninguno
- **Skill:** ninguna
- **Comportamiento:** contenido de la entrada (`the_content()`): 4 párrafos y un párrafo final con enlace a Operaciones (`contacto.html#canales` pasa a la página Contacto del tema, ancla `#canales`), todo dentro del contenido editable; línea fina arriba y abajo. Debajo: enlace "Volver a comunicados" (flecha que se desliza al hover, `#2B2B2B` a `#0B8A3E`) al listado, y `<button type="button">` "Copiar enlace" que copia la URL con `navigator.clipboard` y cambia a "Enlace copiado" 2 s (módulo JS en `src/js/modules/`, `aria-live="polite"`). Textos fijos de la plantilla: "Volver a comunicados", "Copiar enlace", "Enlace copiado". Sin campos extra
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El contenido se imprime con `the_content()` y el enlace del párrafo final conserva su estilo
- [x] "Copiar enlace" es un `<button>`, funciona con teclado y anuncia "Enlace copiado"
- [x] "Volver a comunicados" es un `<a href>` real al listado
- [x] El JS vive en `src/js/modules/` y respeta `prefers-reduced-motion`

## Sección: otros

- **Origen:** `comunicado.html` líneas 206-233
- **Destino:** `template-parts/pages/comunicado/otros.php`, `template-parts/components/comunicado-card.php`
- **Grupo:** ninguno
- **Skill:** ninguna
- **Comportamiento:** `section id="otros"` con `h2` y línea fina; cuadrícula con líneas finas entre tarjetas: 3 columnas desde 1180 px, 2 desde 600 px, 1 en móvil. Usa el componente `comunicado-card` (args `titulo`, `fecha`, `categoria`, `url`) con 2 elementos fijos: (Noticias, "Publicación del tarifario vigente 2026 aprobado por OSITRAN", "02 jul 2026") y (Noticias, "Publicación del Plan Maestro APN 2025 para el TPY-NR", "03 jun 2026"), ambos con `url` al comunicado (en el diseño `comunicado.html`). La tarjeta es un `<a>` completo con pastilla de categoría, `h3`, fecha y botón circular `#0B8A3E` (hover `#07702F`) con flecha diagonal que se intercambia al hover. La consulta real (otras entradas distintas a la actual) se conecta después. El título "Otros comunicados" es texto fijo de la plantilla (decisión del usuario, 2026-10-22); las tarjetas son entradas
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Las tarjetas usan `get_template_part('template-parts/components/comunicado-card', null, $args)` sin repetir marcado
- [x] Cuadrícula de 3, 2 o 1 columnas según el ancho, igual que el diseño
- [x] Cada tarjeta es un solo enlace con `h3` y flecha decorativa con `aria-hidden`
