# Página: Servicios

- **Resumen:** Página padre de las cinco páginas de servicios, para que cuelguen de `/servicios/`. No está en el diseño (en el menú "Servicios" es un subtítulo sin enlace): quien entra a `/servicios/` va a Servicios a la nave.
- **Fuente:** ninguna (no está en el diseño)
- **Plantilla:** `pages/template-servicios.php`
- **Tipo:** estática
- **Contenido:** ninguno
- **Secciones (en orden):** redireccion
- **Skills usadas:** ninguna
- **Grupo ACF:** Servicios (sin campos)
- **Ubicación:** plantilla pages/template-servicios.php
- **Padre:** ninguno
- **Notas de página:**
  - Sin campos ACF: solo existe para la URL
  - `inc/redirecciones.php` la redirige con 301 a su primera página hija (Servicios a la nave)
  - Hijas: `servicios-a-la-nave`, `servicios-a-la-carga`, `servicios-al-pasajero`, `servicios-especiales`, `servicios-no-portuarios` (`/servicios/<slug>/`)
- **Estado:** aplicado

## Sección: redireccion

- **Origen:** ninguno (no está en el diseño)
- **Destino:** `inc/redirecciones.php`, `pages/template-servicios.php`
- **Grupo:** ninguno
- **Skill:** ninguna
- **Comportamiento:** al abrir `/servicios/` se redirige con 301 a la primera página hija publicada (orden del menú y luego fecha), hoy Servicios a la nave. La plantilla solo muestra el título si la página aún no tiene hijas.
- **Estado:** aplicado

**Campos ACF**

| Campo | Tipo | Descripción | Valor actual | Requerido |
|---|---|---|---|---|

**Criterios de aceptación**

- [x] `/servicios/` responde 301 a `/servicios/servicios-a-la-nave/`
- [x] Las cinco páginas de servicios cuelgan de esta página (`Padre: servicios` en sus specs)
