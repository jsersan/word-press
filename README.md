# word-press

Instalación de **WordPress** de Txema Serrano, con algunos scripts PHP auxiliares para administración y pruebas.

> ⚠️ Los apartados marcados con `[completar]` dependen de datos que no constan en el repositorio (finalidad del sitio, versión de WordPress, tema y plugins, hosting). Revísalos antes de publicar el README.

## Descripción

`[completar: qué sitio es, para qué se usa y dónde está desplegado]`

## Estructura del repositorio

```
word-press/
├── wp-admin/               # Núcleo de WordPress: panel de administración
├── wp-content/             # Temas, plugins y subidas (contenido propio)
├── wp-includes/            # Núcleo de WordPress: librerías internas
├── .htaccess               # Reglas de Apache (permalinks, redirecciones)
├── index.php               # Punto de entrada de WordPress
├── home.html               # Página de inicio estática
├── wp-config-sample.php    # Plantilla de configuración
├── wp-config.php           # Configuración local (ver "Seguridad")
├── wp-*.php                # Ficheros estándar del núcleo (login, cron, signup, etc.)
├── xmlrpc.php              # Endpoint XML-RPC
├── readme.html, license.txt
│
├── acceso-directo.php      # Scripts auxiliares propios
├── check-user.php          #   (ver "Scripts auxiliares")
├── crear-admin.php
├── desactivar-plugin.php
├── force-login.php
├── reset.php
├── send-email.php
│
└── *.png, *.jpeg           # Imágenes sueltas (jquery-badge, js, etc.)
```

## Requisitos

- PHP `[completar: versión]`
- MySQL o MariaDB `[completar: versión]`
- Servidor web con Apache (`mod_rewrite` activo) o Nginx equivalente

Los requisitos oficiales vigentes de WordPress están en <https://wordpress.org/about/requirements/>.

## Instalación

1. Clona el repositorio en la raíz web de tu servidor:

   ```bash
   git clone https://github.com/jsersan/word-press.git
   cd word-press
   ```

2. Crea una base de datos vacía y un usuario con permisos sobre ella.

3. Copia la plantilla de configuración y edítala con tus datos:

   ```bash
   cp wp-config-sample.php wp-config.php
   ```

   Rellena `DB_NAME`, `DB_USER`, `DB_PASSWORD`, `DB_HOST` y genera claves nuevas en <https://api.wordpress.org/secret-key/1.1/salt/>.

4. Abre el sitio en el navegador y completa el asistente de instalación.

5. Activa el tema y los plugins en `wp-content/` `[completar: nombres]`.

## Scripts auxiliares

El repositorio incluye scripts PHP propios en la raíz. Su función, según el nombre del fichero:

| Script | Función |
|---|---|
| `crear-admin.php` | Crear un usuario administrador |
| `check-user.php` | Comprobar un usuario |
| `reset.php` | Restablecer datos o contraseña |
| `force-login.php` | Forzar el inicio de sesión |
| `acceso-directo.php` | Acceso directo al panel |
| `desactivar-plugin.php` | Desactivar un plugin que bloquea el sitio |
| `send-email.php` | Probar el envío de correo |

`[completar: confirmar el uso real de cada script]`

**Usa estos scripts solo en local o de forma temporal, y bórralos del servidor en cuanto termines.** Dejarlos accesibles públicamente permite que cualquiera cree administradores o inicie sesión sin credenciales.

## Seguridad

- **No subas `wp-config.php` a un repositorio público.** Contiene credenciales de la base de datos y las claves de seguridad. Añádelo a `.gitignore` y, si ya se ha publicado, cambia la contraseña de la base de datos y regenera las claves.
- Elimina del servidor de producción los scripts auxiliares de la sección anterior.
- Mantén WordPress, el tema y los plugins actualizados.

## Licencia

WordPress se distribuye bajo licencia GPL v2 o posterior. Consulta [`license.txt`](license.txt).

## Autor

Txema Serrano — [@jsersan](https://github.com/jsersan)
