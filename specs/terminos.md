# Página: Términos y condiciones

- **Resumen:** Página legal con los términos de uso del sitio web de COPAM. El visitante la lee de corrido o salta a una cláusula desde el índice lateral.
- **Fuente:** `terminos.html`
- **Plantilla:** `pages/template-terminos.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** hero, indice, contenido
- **Skills usadas:** ninguna
- **Grupo ACF:** Términos y condiciones
- **Ubicación:** plantilla pages/template-terminos.php
- **Notas de página:**
  - `h1` "Términos" en el hero (la miga y el título SEO dicen "Términos y condiciones")
  - título SEO "Términos y condiciones · COPAM"
  - meta descripción del diseño: "Concesionaria Puerto Amazonas S.A. · Terminal Portuario de Yurimaguas – Nueva Reforma." (la misma en todas las páginas, conviene una propia)
  - se ignora el `noindex` del diseño
  - Página estática legal: las 10 cláusulas numeradas NO son un repeater, son un único campo `wysiwyg` (`terminos_contenido_texto`), igual que en `privacidad` (su spec aún está sin rellenar
  - se aplica el mismo enfoque: hero, indice, contenido)
  - Diferencia con `privacidad`: solo el contenido (títulos y número de cláusulas)
  - Todo el texto de las cláusulas es provisional en el diseño ("[Aquí irá el texto de esta sección, a definir por COPAM.]") y la fecha también ("[PENDIENTE: fecha]")
  - COPAM debe entregarlos
  - Sin imágenes ni enlaces propios
  - El resaltado del ítem activo del índice es el módulo JS compartido de `indice-lateral`
- **Estado:** pendiente

## Sección: hero

- **Origen:** `terminos.html` líneas 158-180
- **Destino:** `template-parts/pages/terminos/hero.php`
- **Grupo:** `terminos_hero`
- **Skill:** ninguna
- **Comportamiento:** sin imagen. Miga "Inicio > Términos y condiciones" con el componente compartido `migas` (la miga no es campo). El `h1` es "Términos" y debajo va la línea de última actualización. Animaciones de entrada (`data-rise`, `data-clip`) son del JS compartido, no de la sección.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `terminos_hero_titulo` | text | Título principal de la página. Se muestra en grande en el hero. Recomendado: ~15 caracteres | Términos | sí |
| `terminos_hero_actualizacion` | text | Línea con la fecha de la última actualización, bajo el título. Recomendado: ~50 caracteres | Última actualización: por definir. | no |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] La miga usa el componente `migas` y el último ítem (página actual) no es enlace

## Sección: indice

- **Origen:** `terminos.html` líneas 184-193
- **Destino:** `template-parts/pages/terminos/indice.php`
- **Grupo:** `ninguno`
- **Skill:** ninguna
- **Comportamiento:** usa el componente compartido `indice-lateral` ("En esta página"), sin campos propios: los ítems se generan en PHP a partir de los `h2` del campo `terminos_contenido_texto` (texto = título de la cláusula, ancla = `id` que la plantilla agrega a cada `h2`; el diseño usa `aceptacion`, `uso`, `propiedad`, `informacion`, `enlaces`, `responsabilidad`, `datos`, `modificaciones`, `legislacion`, `contacto`). Es sticky en escritorio y el ítem activo se resalta con el módulo JS compartido. Este `aside` y el contenido comparten la grilla de la sección `contenido`, así que en la plantilla ambos van dentro del mismo contenedor.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Section with behavior: el JS vive en `src/js/modules/`, se activa por `data-` o clase, funciona con teclado y respeta `prefers-reduced-motion`
- [ ] Cada enlace del índice lleva al `id` de su cláusula y no queda ningún enlace roto si el editor cambia los títulos
- [ ] Repeated block: se usa el componente `indice-lateral` con `$args`, sin copiar su marcado

## Sección: contenido

- **Origen:** `terminos.html` líneas 194-246
- **Destino:** `template-parts/pages/terminos/contenido.php`
- **Grupo:** `terminos_contenido`
- **Skill:** ninguna
- **Comportamiento:** cuerpo legal en un solo campo `wysiwyg`. Cada cláusula del diseño es: línea separadora, `h2` numerado y párrafo; en el editor, cada cláusula se escribe con un `h2` ("1. Aceptación de los términos") seguido de sus párrafos o listas. La plantilla imprime el campo con `wp_kses_post` dentro de un contenedor con estilos tipográficos para `h2` (con la línea superior del diseño, componente `titulo-linea` como referencia visual), `p`, `ul`/`ol` y `a`, y agrega un `id` a cada `h2` para el índice. Mientras COPAM no entregue el texto, el valor actual es el provisional del diseño.
- **Estado:** pendiente

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|
| `terminos_contenido_texto` | wysiwyg | Texto completo de los términos y condiciones. Cada cláusula empieza con un título de nivel 2 (Encabezado 2), numerado, y alimenta el índice lateral. Se muestra en la columna derecha, junto al índice. Recomendado: un título de nivel 2 por cláusula | 1. Aceptación de los términos / 2. Uso del sitio web / 3. Propiedad intelectual / 4. Información y documentos publicados / 5. Enlaces a sitios de terceros / 6. Limitación de responsabilidad / 7. Protección de datos personales / 8. Modificaciones de los términos / 9. Legislación aplicable y jurisdicción / 10. Contacto; cada una con el párrafo "[Aquí irá el texto de esta sección, a definir por COPAM.]" | sí |

**Criterios de aceptación**

- [ ] Cumple los criterios comunes de `_shared.md`
- [ ] Con las 10 cláusulas provisionales, la página se ve igual que el diseño (separador, `h2` numerado, párrafo)
- [ ] Un `h2` nuevo en el editor recibe `id` y aparece solo en el índice lateral
- [ ] Los enlaces dentro del texto salen con `rel` seguro y las listas y negritas del editor conservan estilo
