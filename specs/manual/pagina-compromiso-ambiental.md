# Capítulo: Compromiso Ambiental

- **Tipo:** página
- **Dónde:** Páginas › Compromiso Ambiental
- **Páginas:** Compromiso Ambiental
- **Grupo ACF:** group_e8238f22ec951 (Compromiso Ambiental)
- **Estado:** pendiente

## Cómo llegar

1. En el menú de la izquierda entra a **Páginas**.
2. Busca **Compromiso Ambiental** en la lista y haz clic en **Editar** (aparece al pasar el mouse sobre el nombre).
3. Baja: debajo del editor está cada sección, en el mismo orden que en la web.

## Sección: compromiso_ambiental_hero · Portada de la página

- **Resumen:** Lo primero que se ve: el título grande, un texto de presentación y una foto panorámica a todo el ancho. La foto se mueve suavemente al bajar por la página.

- **1** Título * — Título grande de la página. Si es largo, pasa solo a dos líneas.
- **2** Bajada * — Texto de presentación bajo el título.
- **3** Imagen * — Foto panorámica bajo el título. Se recorta sola para llenar el espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.

## Sección: compromiso_ambiental_indice · Índice lateral

- **Resumen:** Recuadro a la izquierda con los enlaces a cada sección de la página. Se arma solo con los títulos de Nuestro compromiso, Política ambiental, Cómo lo aplicamos en la operación, Instrumentos de gestión ambiental y Cumplimiento normativo, y marca la sección que estás leyendo. Solo se ve en pantallas grandes.
- **Web:** [data-indice]

- **1** Título * — Texto pequeño sobre la lista de enlaces, por ejemplo "En esta página".
- **2** Enlace — Botón: su texto y a dónde lleva. Va al pie del índice con una flecha; hoy lleva a Nosotros. Si lo dejas vacío, no se muestra.

## Sección: compromiso_ambiental_compromiso · Nuestro compromiso

- **Resumen:** Título con una línea a su derecha, un párrafo sobre el compromiso ambiental del terminal y una foto ancha debajo.
- **Web:** #compromiso

- **1** Título * — Título de la sección. También es el texto de su enlace en el índice lateral.
- **2** Texto * — Párrafo que explica el compromiso ambiental.
- **3** Imagen — Foto ancha bajo el párrafo. Se recorta sola en una franja alargada. Si la dejas vacía, no se muestra. Recomendado: hasta 2000 px en el lado más largo, horizontal.

## Sección: compromiso_ambiental_politica · Política ambiental

- **Resumen:** Título, una frase de introducción, una lista de compromisos con viñeta verde y un enlace con flecha a la página Sistema Integrado de Gestión.
- **Web:** #politica

- **1** Título * — Título de la sección. También es el texto de su enlace en el índice lateral.
- **2** Intro * — Frase que presenta la política ambiental.
- **3** Compromisos * — Una fila por compromiso. Agrega, quita u ordena filas: la lista se ajusta sola.
- **3.1** Texto * — Texto del compromiso.
- **4** Enlace — Botón: su texto y a dónde lleva. Hoy lleva a Sistema Integrado de Gestión. Si lo dejas vacío, no se muestra.

## Sección: compromiso_ambiental_operacion · Cómo lo aplicamos en la operación

- **Resumen:** Título y una tarjeta por cada práctica ambiental del terminal. Cada tarjeta lleva un número (01, 02…) que se pone solo según el orden.
- **Web:** #operacion

- **1** Título * — Título de la sección. También es el texto de su enlace en el índice lateral.
- **2** Items * — Una fila por tarjeta. Agrega, quita u ordena filas: los números y la rejilla se ajustan solos.
- **2.1** Título * — Título de la tarjeta, por ejemplo "Prevención de derrames".
- **2.2** Texto * — Descripción de la práctica.

## Sección: compromiso_ambiental_instrumentos · Instrumentos de gestión ambiental

- **Resumen:** Título, una frase sobre el Instrumento de Gestión Ambiental y dos fotos en fila, una más grande que la otra.
- **Web:** #instrumentos

- **1** Título * — Título de la sección. También es el texto de su enlace en el índice lateral.
- **2** Texto * — Frase sobre el instrumento de gestión ambiental.
- **3** Imagen principal — Foto de la izquierda. Se recorta sola para llenar el espacio. Si la dejas vacía, no se muestra. Recomendado: hasta 2000 px en el lado más largo, horizontal.
- **4** Imagen secundaria — Foto de la derecha. Se recorta sola para llenar el espacio. Si la dejas vacía, no se muestra. Recomendado: hasta 2000 px en el lado más largo, horizontal.

## Sección: compromiso_ambiental_cumplimiento · Cumplimiento normativo

- **Resumen:** Título, un párrafo sobre las normas que rigen la operación, una foto ancha y un enlace con flecha a la página Normativa OSITRAN.
- **Web:** #cumplimiento

- **1** Título * — Título de la sección. También es el texto de su enlace en el índice lateral.
- **2** Texto * — Párrafo sobre las normas que rigen la operación.
- **3** Imagen — Foto ancha bajo el párrafo. Se recorta sola en una franja alargada. Si la dejas vacía, no se muestra. Recomendado: hasta 2000 px en el lado más largo, horizontal.
- **4** Enlace — Botón: su texto y a dónde lleva. Hoy lleva a Normativa OSITRAN. Si lo dejas vacío, no se muestra.

## Sección: compromiso_ambiental_galeria · Franja de fotos

- **Resumen:** Una franja de fotos en fila, sin título, al final del contenido. No aparece en el índice lateral. Si no hay fotos, la franja no se muestra.
- **Web:** #cumplimiento + div

- **1** Imágenes — Las fotos de la franja. Se muestran de a tres por fila y cada una se recorta sola para llenar su espacio. Puedes agregar, quitar u ordenar fotos. Recomendado: hasta 2000 px en el lado más largo, horizontal.

## Sección: compromiso_ambiental_acceso · Bloque de cierre

- **Resumen:** Al final de la página: una tarjeta oscura con título, una frase y un botón, junto a una foto. Hoy invita a visitar Nosotros. Si el título está vacío, el bloque no se muestra.
- **Web:** [data-indice] + div > :last-child

- **1** Título * — Título de la tarjeta.
- **2** Descripción — Frase corta bajo el título. Si la dejas vacía, no se muestra.
- **3** Botón * — Botón: su texto y a dónde lleva.
- **4** Imagen — Foto junto a la tarjeta. Se recorta sola para llenar el espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.
