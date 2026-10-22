# Página: Política de privacidad

- **Resumen:** Página legal con la política de privacidad y tratamiento de datos personales de COPAM. El visitante lee las cláusulas numeradas y revisa la fecha de la última actualización.
- **Fuente:** `privacidad.html`
- **Plantilla:** `pages/template-privacidad.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, contenido
- **Skills usadas:** ninguna
- **Grupo ACF:** Política de privacidad
- **Ubicación:** plantilla pages/template-privacidad.php
- **Notas de página:**
  - `h1` "Privacidad" en el hero (la miga final dice "Política de privacidad")
  - título SEO "Política de privacidad · COPAM"
  - meta descripción del diseño "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (es la genérica del sitio, a confirmar)
  - Migas con el componente `migas` (Inicio > Política de privacidad)
  - el texto de la miga sale del título de la página, no es campo
  - Se ignora el `noindex` del diseño
  - Header, footer, aviso de mantenimiento y buscador son del sitio y no se repiten aquí
  - El diseño trae cada cláusula con el texto provisorio "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.": en el cuerpo editable se carga como valor inicial
  - Los datos de las 8 cláusulas están en el `<script>` (`legal`), no en el HTML
  - los títulos son: 1
  - Responsable del tratamiento, 2
  - Datos personales que se recopilan, 3
  - Finalidades del tratamiento, 4
  - Destinatarios, 5
  - Plazo de conservación, 6
  - Transferencias, 7
  - Derechos del titular y cómo ejercerlos, 8
  - Banco de datos inscrito. **Réplica para `terminos` y `cookies`** (misma plantilla visual: hero + contenido
  - copiar secciones `hero` y `contenido` cambiando el prefijo): `cookies` es idéntica a esta (3 cláusulas: 1
  - Qué son las cookies, 2
  - Cookies que utilizamos, 3
  - Cómo gestionar las cookies
  - h1 "Política de cookies" según su `<title>`
  - fecha igual) y no tiene índice. `terminos` difiere: h1 "Términos", fecha "Última actualización: por definir.", 10 cláusulas con `id` ancla (aceptacion, uso, propiedad, informacion, enlaces, responsabilidad, datos, modificaciones, legislacion, contacto) y suma una sección `indice` (aside sticky "En esta página" en escritorio, columna de 220-320 px a la izquierda del contenido
  - en menos de 1000 px pasa arriba, sin sticky) con el componente compartido `indice-lateral` (textos tomados de los `h2` del cuerpo, no son campos
  - resaltado del ítem activo por módulo JS)
  - En `terminos` el contenido va dentro de esa rejilla de 2 columnas y cada cláusula es `section` con `id`
  - en privacidad y cookies el contenido ocupa un ancho máximo de 900 px alineado a la izquierda
  - Como `indice-lateral` necesita anclas, en `terminos` los `h2` del WYSIWYG deben generar `id` (se resuelve en la plantilla a partir del texto)
- **Estado:** pendiente

## Sección: hero

- **Origen:** `privacidad.html` líneas 158-180
- **Destino:** `template-parts/pages/privacidad/hero.php`
- **Grupo:** `privacidad_hero`
- **Skill:** ninguna
- **Comportamiento:** fila de migas (`migas`: Inicio con ícono de casa > Política de privacidad, fondo gris `--gray-ed` a todo el ancho) y debajo el bloque del título con padding superior `clamp(36px,5vw,96px)`; el `h1` va en mayúsculas, peso 700, `clamp(32px,3vw,58px)`, interlineado 1, tracking -.02em; la línea de actualización va debajo, 15px, ancho máximo 720px, color gris `--gray-4a` (valor suelto). La rejilla del diseño tiene dos columnas (`minmax(0,1fr) 33.3vw` en escritorio) pero la segunda está vacía (sin tarjeta ni imagen); se maqueta una sola columna. Las animaciones de entrada (`data-rise`, `data-clip`) se reescriben como módulo JS con `prefers-reduced-motion`. Si el campo de actualización queda vacío, la plantilla oculta la línea (se aplica en el paso ACF).
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `privacidad_hero_titulo` | text | Título principal de la página (`h1`). Se muestra en mayúsculas sobre fondo blanco. Recomendado: ~15 caracteres | Privacidad | sí |
| `privacidad_hero_actualizacion` | text | Línea bajo el título con la fecha de la última actualización. Recomendado: ~50 caracteres | Última actualización: por definir. | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Las migas usan el componente `migas` con `<nav aria-label="Migas de pan">` y la última con `aria-current="page"`
- [ ] La plantilla no deja una segunda columna vacía en el hero

## Sección: contenido

- **Origen:** `privacidad.html` líneas 182-192 (datos de las cláusulas en el `<script>`, propiedad `legal`)
- **Destino:** `template-parts/pages/privacidad/contenido.php`
- **Grupo:** `privacidad_contenido`
- **Skill:** ninguna
- **Comportamiento:** el cuerpo legal es un solo campo editable (WYSIWYG) en una columna de ancho máximo 900px, con padding lateral `clamp(20px,4.17vw,80px)` y padding inferior `clamp(88px,7.3vw,140px)`. Cada cláusula se escribe como `h2` seguido de uno o más párrafos; la numeración ("1. ", "2. ") va escrita en el texto del título. Los estilos del diseño se aplican a la caja del contenido (clase de texto largo): cada `h2` lleva una línea horizontal de 1px `--color-line` encima (como `titulo-linea`), padding vertical `clamp(28px,2.3vw,44px)`, tamaño `clamp(20px,1.3vw,25px)`, peso 600, interlineado 1.25; los párrafos, 15px, interlineado 1.6, color `--gray-7a` (valor suelto), margen superior 12px; también deben quedar estilizadas las listas, enlaces y negritas que el editor permita. Animación del diseño (línea que se dibuja, título que sube, párrafo que se revela) reescrita como módulo JS por `data-`, respetando `prefers-reduced-motion`. Los 8 títulos del diseño se cargan como valor inicial.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `privacidad_contenido_texto` | wysiwyg | Texto completo de la política. Usa Encabezado 2 para el título de cada cláusula (con su número) y párrafo para el texto; se muestra en una columna de lectura bajo el hero. Hay 8 cláusulas en el diseño. Recomendado: ~2000 caracteres por cláusula | 1. Responsable del tratamiento / 2. Datos personales que se recopilan / 3. Finalidades del tratamiento / 4. Destinatarios / 5. Plazo de conservación / 6. Transferencias / 7. Derechos del titular y cómo ejercerlos / 8. Banco de datos inscrito (cada título como Encabezado 2, seguido del párrafo "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.") | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] El HTML del WYSIWYG se imprime con `wp_kses_post`, y los `h2` van en orden bajo el `h1` del hero
- [ ] Los `h2`, párrafos, listas y enlaces del editor se ven con los estilos del diseño sin clases manuales
- [ ] Los enlaces del texto con destino externo llevan `rel` seguro
