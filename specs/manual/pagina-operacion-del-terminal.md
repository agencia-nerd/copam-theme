# Capítulo: Operación del terminal

- **Tipo:** página
- **Dónde:** Páginas › Operación del terminal
- **Páginas:** Operación del terminal
- **Grupo ACF:** group_052d973036dcb (Operación del terminal)
- **Estado:** pendiente

## Cómo llegar

1. En el menú de la izquierda entra a **Páginas**.
2. Busca **Operación del terminal** en la lista y haz clic en **Editar** (aparece al pasar el mouse sobre el nombre).
3. Baja: debajo del editor está cada sección, en el mismo orden que en la web.
4. Cuando termines, pulsa **Actualizar** para guardar los cambios.

## Sección: operacion_del_terminal_hero · Portada de la página

- **Resumen:** Lo primero que se ve: una foto a todo el ancho que se acerca suavemente al bajar, el título grande, un texto de presentación, el botón para descargar el Reglamento de Operaciones y la tarjeta de accesos directos.
- **Web:** main > div:first-child > section:first-child

- **1** Título * — Título grande de la página. Si lo dejas vacío, se usa el nombre de la página.
- **2** Bajada * — Texto de presentación bajo el título.
- **3** Botón texto — Texto del botón de descarga (por ejemplo, «Descargar REOP»). Si lo dejas vacío, el botón no se muestra.
- **4** Botón archivo — El archivo (PDF) que descarga el botón. Para cambiarlo, quita el actual y sube el nuevo. Si lo dejas vacío, el botón no se muestra.
- **5** Imagen * — Foto de fondo a todo el ancho. Se recorta sola para llenar su espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.
- **6** Accesos título — Título de la tarjeta de accesos directos. Si lo dejas vacío, la tarjeta se muestra sin título.
- **7** Accesos — Una fila por acceso directo. La tarjeta crece o se achica sola. Si no hay ninguna fila, la tarjeta no se muestra.
- **7.1** Enlace * — Acceso: su texto y a dónde lleva. Para bajar a una sección de esta página usa su ancla: `#informacion`, `#infraestructura`, `#versiones` o `#faq`.

## Sección: operacion_del_terminal_informacion · Información operativa

- **Resumen:** Tarjetas con información del terminal sobre una banda gris. Cada tarjeta tiene un título, un texto y, si corresponde, un botón. La rejilla se ordena sola según cuántas tarjetas haya.
- **Web:** #informacion

- **1** Título * — Título de la sección.
- **2** Tarjetas * — Una fila por tarjeta. La rejilla se acomoda sola.
- **2.1** Título * — Título de la tarjeta.
- **2.2** Descripción * — Texto de la tarjeta. Usa Enter para pasar a otra línea.
- **2.3** Archivo — El archivo (PDF) que descarga el botón de la tarjeta. Para cambiarlo, quita el actual y sube el nuevo. Si subes un archivo, el botón lo descarga y no usa el enlace del campo **Botón**.
- **2.4** Botón texto — Texto del botón cuando descarga un archivo. Si hay archivo y este texto está vacío, el botón no se muestra.
- **2.5** Botón — Botón: su texto y a dónde lleva. Solo se usa si la tarjeta no tiene archivo. Sin archivo ni botón, la tarjeta se muestra sin botón.

## Sección: operacion_del_terminal_infraestructura · Infraestructura y equipamiento

- **Resumen:** Una tabla de dos columnas con la infraestructura y el equipo del terminal. Cada grupo empieza con una fila gris con su nombre y sigue con sus filas de datos.
- **Web:** #infraestructura

- **1** Título * — Título de la sección.
- **2** Columna elemento * — Encabezado de la columna izquierda (por ejemplo, «Elemento»).
- **3** Columna capacidad * — Encabezado de la columna derecha (por ejemplo, «Capacidad»).
- **4** Grupos * — Una fila por grupo de la tabla (por ejemplo, «Infraestructura» y «Equipamiento»). La tabla crece sola.
- **4.1** Nombre * — Nombre del grupo: es la fila gris que encabeza sus datos.
- **4.2** Filas * — Una fila por dato del grupo.
- **4.2.1** Elemento * — Nombre del elemento, en la columna izquierda.
- **4.2.2** Capacidad * — Capacidad o medida, con su unidad, en la columna derecha.

## Sección: operacion_del_terminal_versiones · Versiones del Reglamento de Operaciones

- **Resumen:** Lista desplegable por año con las versiones del Reglamento de Operaciones (REOP). Se abre y se cierra sola al tocarla; el primer año empieza abierto. Junto a cada año se cuenta solo cuántos documentos tiene. Cada documento tiene su botón de descarga.
- **Web:** #versiones

- **1** Título * — Título de la sección.
- **2** Botón texto — Texto del botón de cada documento. Si lo dejas vacío, dice «Descargar PDF».
- **3** Vigente texto — Texto de la etiqueta de la versión vigente. Si lo dejas vacío, dice «Vigente».
- **4** Vacio — Mensaje que se ve al abrir un año sin documentos. Si lo dejas vacío, el año se abre sin mensaje.
- **5** Anios * — Una fila por año. Ponlos del más reciente al más antiguo: el primero es el que empieza abierto. El contador se adapta solo.
- **5.1** Año * — El año que titula el grupo.
- **5.2** Documentos — Una fila por documento del año. El contador del año cambia solo.
- **5.2.1** Título * — Nombre del documento.
- **5.2.2** Subtitulo — Resolución que lo aprueba y fecha, bajo el título. Si lo dejas vacío, no se muestra.
- **5.2.3** Vigente — Activa o desactiva la etiqueta de versión vigente junto al documento.
- **5.2.4** Archivo * — El archivo (PDF) que descarga el botón. Para cambiarlo, quita el actual y sube el nuevo.

## Sección: operacion_del_terminal_faq · Preguntas frecuentes

- **Resumen:** Preguntas y respuestas sobre la operación del terminal. Cada pregunta se abre y se cierra sola al tocarla; la primera empieza abierta.
- **Web:** #faq

- **1** Etiqueta — Texto pequeño con ícono sobre el título (por ejemplo, «Ayuda»). Si la dejas vacía, no se muestra.
- **2** Título * — Título de la sección.
- **3** Descripción — Frase bajo el título. Si la dejas vacía, no se muestra.
- **4** Items * — Una fila por pregunta. La lista se acomoda sola.
- **4.1** Pregunta * — La pregunta: es el texto que se toca para abrir la respuesta.
- **4.2** Respuesta * — La respuesta, en texto simple.

## Sección: operacion_del_terminal_cta · Bloque de contacto

- **Resumen:** Bloque de cierre: un recuadro oscuro con título, una frase y un botón, junto a una foto. En el celular la foto va debajo.
- **Web:** #faq ~ section

- **1** Título * — Título grande del bloque. Si lo dejas vacío, el bloque completo no se muestra.
- **2** Bajada — Frase bajo el título. Si la dejas vacía, no se muestra.
- **3** Botón * — Botón: su texto y a dónde lleva. Hoy lleva al formulario de contacto.
- **4** Imagen * — Foto junto al recuadro. Se recorta sola para llenar su espacio. Recomendado: hasta 2000 px en el lado más largo, horizontal.
