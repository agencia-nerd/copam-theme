# Capítulo: Nosotros

- **Tipo:** página
- **Dónde:** Páginas › Nosotros
- **Páginas:** Nosotros
- **Grupo ACF:** group_1d1883e966314 (Nosotros)
- **Estado:** pendiente

## Cómo llegar

1. En el menú de la izquierda entra a **Páginas**.
2. Busca **Nosotros** en la lista y haz clic en **Editar** (aparece al pasar el mouse sobre el nombre).
3. Baja: debajo del editor está cada sección, en el mismo orden que en la web.

## Sección: nosotros_hero · Portada de la página

- **Resumen:** Lo primero que se ve: el título grande, un texto de presentación y una foto panorámica a todo el ancho. La foto se mueve suavemente al bajar por la página.

- **1** Título * — Título grande de la página.
- **2** Bajada * — Texto de presentación bajo el título.
- **3** Imagen * — Foto panorámica bajo el título. Se recorta sola para llenar el espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.

## Sección: nosotros_indice · Índice lateral

- **Resumen:** Recuadro a la izquierda con los enlaces a cada sección de la página. Se arma solo con los títulos de Misión, Visión, La concesión, Sistema integrado de gestión y Cómo operamos, y marca la sección que estás leyendo. Solo se ve en pantallas grandes.
- **Web:** [data-indice]

- **1** Título * — Texto pequeño sobre la lista de enlaces, por ejemplo "En esta página".
- **2** Enlace — Botón: su texto y a dónde lleva. Va al pie del índice con una flecha; hoy lleva a Compromiso Ambiental. Si lo dejas vacío, no se muestra.

## Sección: nosotros_mision · Misión

- **Resumen:** Título con una línea a su derecha y un párrafo con la misión de la empresa.
- **Web:** #mision

- **1** Título * — Título de la sección. También es el texto de su enlace en el índice lateral.
- **2** Texto * — Párrafo con la misión.

## Sección: nosotros_vision · Visión

- **Resumen:** Título con una línea a su derecha y un párrafo con la visión de la empresa.
- **Web:** #vision

- **1** Título * — Título de la sección. También es el texto de su enlace en el índice lateral.
- **2** Texto * — Párrafo con la visión.

## Sección: nosotros_concesion · La concesión

- **Resumen:** Título, subtítulo, una frase de apoyo, un párrafo, una lista de datos clave (nombre a la izquierda y valor a la derecha) y una foto ancha al final.
- **Web:** #concesion

- **1** Título * — Título de la sección. También es el texto de su enlace en el índice lateral.
- **2** Subtitulo — Subtítulo bajo el título. Si lo dejas vacío, no se muestra.
- **3** Bajada — Frase corta de apoyo bajo el subtítulo. Si la dejas vacía, no se muestra.
- **4** Texto * — Párrafo principal sobre la concesión.
- **5** Datos — Una fila por dato clave (por ejemplo, Concesionario o Regulador). Agrega, quita u ordena filas: la lista se ajusta sola. Si no hay filas, la lista no se muestra.
- **5.1** Etiqueta * — Nombre del dato, a la izquierda.
- **5.2** Valor * — Valor del dato, a la derecha.
- **6** Imagen — Foto ancha bajo la lista. Se recorta sola en una franja alargada. Si la dejas vacía, no se muestra. Recomendado: hasta 2000 px en el lado más largo, horizontal.

## Sección: nosotros_sistema · Sistema integrado de gestión

- **Resumen:** Título, subtítulo con las normas, dos párrafos, una lista de certificados y datos (nombre a la izquierda y valor a la derecha) y un enlace con flecha a la página del sistema.
- **Web:** #sistema

- **1** Título * — Título de la sección. También es el texto de su enlace en el índice lateral.
- **2** Subtitulo — Subtítulo con las normas, bajo el título. Si lo dejas vacío, no se muestra.
- **3** Texto * — Párrafo principal sobre el sistema y su certificación.
- **4** Alcance — Segundo párrafo, sobre qué cubre la certificación. Si lo dejas vacío, no se muestra.
- **5** Datos — Una fila por certificado o dato (por ejemplo, ISO 9001 o Vigencia). Agrega, quita u ordena filas: la lista se ajusta sola. Si no hay filas, la lista no se muestra.
- **5.1** Etiqueta * — Nombre del dato, a la izquierda.
- **5.2** Valor * — Valor del dato, a la derecha.
- **6** Enlace — Botón: su texto y a dónde lleva. Va al final con una flecha; hoy lleva a Sistema Integrado de Gestión. Si lo dejas vacío, no se muestra.

## Sección: nosotros_operamos · Cómo operamos

- **Resumen:** Título, un párrafo sobre la operación del terminal, una foto ancha y un enlace con flecha a la página Operación del terminal.
- **Web:** #operamos

- **1** Título * — Título de la sección. También es el texto de su enlace en el índice lateral.
- **2** Texto * — Párrafo sobre cómo opera el terminal.
- **3** Imagen — Foto ancha bajo el párrafo. Se recorta sola en una franja alargada. Si la dejas vacía, no se muestra. Recomendado: hasta 2000 px en el lado más largo, horizontal.
- **4** Enlace — Botón: su texto y a dónde lleva. Hoy lleva a Operación del terminal. Si lo dejas vacío, no se muestra.

## Sección: nosotros_acceso · Bloque de cierre

- **Resumen:** Al final de la página: una tarjeta oscura con título, una frase y un botón, junto a una foto. Hoy invita a visitar Compromiso Ambiental. Si el título está vacío, el bloque no se muestra.
- **Web:** [data-indice] + div > :last-child

- **1** Título * — Título de la tarjeta.
- **2** Descripción — Frase corta bajo el título. Si la dejas vacía, no se muestra.
- **3** Botón * — Botón: su texto y a dónde lleva.
- **4** Imagen — Foto junto a la tarjeta. Se recorta sola para llenar el espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.
