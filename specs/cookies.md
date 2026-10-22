# Página: Política de cookies

- **Resumen:** Explica qué son las cookies, cuáles usa el sitio y cómo gestionarlas; quien la visita la lee como documento legal (se llega desde la línea legal del pie). El texto del diseño es provisional.
- **Fuente:** `cookies.html`
- **Plantilla:** `pages/template-cookies.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, contenido
- **Skills usadas:** ninguna
- **Grupo ACF:** Política de cookies
- **Ubicación:** plantilla pages/template-cookies.php
- **Notas de página:**
  - `h1` "Cookies" en el hero
  - título SEO "Política de cookies · COPAM"
  - sin meta descripción en el diseño (se ignora su `noindex`)
  - El diseño no trae banner de consentimiento de cookies ni tabla de cookies: un banner, si se necesita, queda fuera de esta página y de esta etapa
  - El diseño no tiene índice lateral, así que no hay sección `indice` (si COPAM lo pide, se reutiliza `indice-lateral`)
  - Mismo enfoque que `privacidad` y `terminos`: hero + contenido con el cuerpo en un único campo WYSIWYG
  - Diferencia estructural: ninguna por ahora
  - si COPAM entrega una tabla de cookies (nombre, finalidad, duración), va dentro del WYSIWYG como tabla. "Inicio" y "Política de cookies" de las migas salen del componente `migas`, no son campos
- **Estado:** aplicado

## Sección: hero

- **Origen:** `cookies.html` líneas 158-180
- **Destino:** `template-parts/pages/cookies/hero.php`
- **Grupo:** `cookies_hero`
- **Skill:** ninguna
- **Comportamiento:** migas con el componente `migas` (Inicio > Política de cookies; el último sin enlace y con `aria-current="page"`); el `h1` lleva la animación de entrada `data-rise` del diseño (módulo JS de revelado compartido, respeta `prefers-reduced-motion`); la línea de actualización se oculta si el campo está vacío; no hay imagen ni tarjeta de accesos (el diseño reserva una columna vacía a la derecha, no se maqueta)
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `cookies_hero_titulo` | text | Título principal de la página (`h1`). Se muestra en grande bajo las migas. Recomendado: ~15 caracteres | Cookies | sí |
| `cookies_hero_actualizacion` | text | Línea con la fecha de última actualización de la política. Se muestra bajo el título. Recomendado: ~50 caracteres | Última actualización: por definir. | no |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] Las migas usan `<nav aria-label="Migas de pan">` y el `h1` es "Cookies"
- [x] El `h1` y la línea de actualización se ven y se animan igual que en el diseño

## Sección: contenido

- **Origen:** `cookies.html` líneas 182-192 (datos `legal` en el `<script>`, línea 558)
- **Destino:** `template-parts/pages/cookies/contenido.php`
- **Grupo:** `cookies_contenido`
- **Skill:** ninguna
- **Comportamiento:** el diseño repite 3 bloques (línea horizontal, `h2` numerado, párrafo) con los títulos "1. Qué son las cookies", "2. Cookies que utilizamos" y "3. Cómo gestionar las cookies"; en WordPress todo el cuerpo es un único campo WYSIWYG y los bloques se reproducen con estilos de contenido (`h2` con la línea horizontal encima, párrafos, listas, enlaces y tablas) aplicados al contenedor, sin clases por elemento; la numeración de los títulos la escribe el editor dentro del texto; el `h2` imita el estilo de `titulo-linea`, que no se invoca por bloque porque el contenido sale de un solo campo; columna de lectura con el ancho del diseño; las animaciones de entrada por bloque (`data-sr`) se omiten o se aplican al contenedor entero; el texto del diseño es provisional (cada bloque dice "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.") y COPAM lo reemplaza
- **Estado:** aplicado
- **ACF:** conectado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `cookies_contenido_texto` | wysiwyg | Texto completo de la política de cookies: títulos de sección (nivel 2), párrafos, listas, enlaces y, si hace falta, una tabla de cookies. Se muestra como columna de lectura bajo el hero. Recomendado: secciones numeradas como en el diseño (Qué son las cookies, Cookies que utilizamos, Cómo gestionar las cookies) | Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. | sí |

**Criterios de aceptación**

- [x] Cumple los criterios comunes de `_shared.md`
- [x] El `h2` de cada sección del WYSIWYG tiene la línea superior y el tamaño del diseño; `h3` y listas no rompen el orden de encabezados
- [x] El WYSIWYG se imprime con `wp_kses_post` y las tablas no desbordan en móvil
- [x] Sin clases ni estilos por elemento dentro del campo: el aspecto sale de los estilos del contenedor
