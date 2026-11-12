# Copam — tema WordPress

Tema a medida del sitio de Copam ([copam.com.pe](https://copam.com.pe/)), hecho con Vite, Tailwind y ACF Pro. Todo el contenido se administra desde el panel de WordPress.

## Requisitos

- WordPress 6.5 o superior y PHP 8.1 o superior
- ACF Pro 6.2 o superior
- Node 24 o superior y pnpm 12 (solo para desarrollo)
- [Local](https://localwp.com/) para el entorno local

## Instalación

1. Clona el repo en `wp-content/themes/copam-theme`.
2. Instala las dependencias:
   ```bash
   pnpm install
   ```
3. Activa el tema en **Apariencia › Temas**. Al activarse crea la página Inicio y sincroniza los campos de ACF.
4. Carga el contenido inicial desde **Herramientas › Cargar contenido inicial**. No pisa lo que ya esté cargado.

## Comandos

| Comando | Qué hace |
|---|---|
| `pnpm dev` | Inicia Vite con recarga en vivo. Crea el archivo `hot` y lo borra al detenerse. |
| `pnpm build` | Genera `dist/` con `manifest.json` para producción. |

Usa solo `pnpm`, nunca `npm` ni `yarn`.

## Estructura

| Carpeta | Contenido |
|---|---|
| `front-page.php`, `pages/` | La portada y las plantillas de cada página (`template-<nombre>.php`). |
| `template-parts/` | Secciones de página (`pages/`), piezas reutilizables (`components/`), formularios, acordeones y correos. |
| `inc/` | Lógica PHP: configuración, helpers, ACF (`inc/acf/`), formularios (`inc/forms/`) y buscador. |
| `acf-json/` | Campos, tipos de contenido y páginas de opciones de ACF. Se generan desde los specs; no se editan a mano. |
| `src/` | CSS (Tailwind) y JS fuente. |
| `specs/` | Documentación: diseño por página y borradores del manual del cliente. |

## Formularios y reCAPTCHA

Los formularios validan los datos en el navegador y en PHP, y están protegidos con reCAPTCHA v3. Las claves van en `wp-config.php` de cada entorno, **nunca en el repo**:

```php
define('COPAM_THEME_RECAPTCHA_SITE_KEY', '...');
define('COPAM_THEME_RECAPTCHA_SECRET_KEY', '...');
```

Si no están definidas, no se exige reCAPTCHA.

## Deploy

1. Detén `pnpm dev`, si está corriendo.
2. Corre `pnpm build`.
3. Sube al servidor `dist/` y los archivos PHP que cambiaron.

No subas `hot`, `node_modules/`, `src/`, `specs/` ni los archivos de configuración (`package.json`, `pnpm-*`, `vite.config.ts`, `CLAUDE.md` y `README.md`).

## Manual del cliente

El manual de administración en PDF se genera con la skill `wp-manual` a partir de los borradores de `specs/manual/`. Las capturas y el PDF no se versionan.

## Convenciones

Las reglas del proyecto (prefijo `copam_theme_`, dónde va cada archivo, helpers, motores de las skills que no se editan) están en [`CLAUDE.md`](CLAUDE.md).

---

Desarrollado por **Nerd**. Uso privado (sin licencia pública).
