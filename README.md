# Portal Web Institucional del IESTP Manuel Arévalo Cáceres

## 1. Descripción general del proyecto

Este repositorio contiene el portal web institucional oficial del **Instituto de Educación Superior Tecnológico Público Manuel Arévalo Cáceres (IESTP MAC)**, ubicado en el distrito de Los Olivos, Lima, Perú (código modular `1065655`, código de local `311276`).

El portal informa a postulantes, estudiantes, docentes, egresados, empresas y ciudadanía sobre los programas de estudio (**Desarrollo de Sistemas de Información**, **Enfermería Técnica** e **Industria de Alimentos y Bebidas**), los procesos de admisión y matrícula, los servicios educacionales y de empleabilidad, las autoridades, los documentos de gestión y el portal de transparencia institucional.

---

## 2. Arquitectura general y tecnologías utilizadas

El proyecto funciona sin base de datos relacional ni NoSQL, priorizando la velocidad de respuesta, la seguridad, el bajo consumo de recursos en alojamiento compartido y la facilidad de mantenimiento:

- **Backend:** PHP 8.1 o superior (`declare(strict_types=1)`), sin dependencias de gestores de paquetes externos. Versiones ejecutadas en pruebas: PHP 8.3 (8.3.36 en el equipo de desarrollo y 8.3.6 en la auditoría final). PHP 8.4 es la versión objetivo para cPanel, revisada solo con análisis estático; su ejecución real queda pendiente en el servidor de pruebas (ver sección 4).
- **Frontend:** HTML5 semántico (`lang="es-PE"`), CSS3 nativo con propiedades personalizadas y diseño adaptable, y JavaScript nativo (`ES2020+`) sin librerías.
- **Persistencia de datos:** archivos JSON en `recursos/datos/`, arreglos de configuración en `configuracion/`, caché temporal autodepurable en `almacenamiento/temporal/` y directorio reservado `almacenamiento/privado/` para archivos internos sin acceso HTTP público.
- **Tipografías autoalojadas:** Big Shoulders (títulos) y Work Sans (texto e interfaz), en formato `.woff2` dentro de `recursos/fuentes/`, con licencia SIL Open Font License.
- **Servidor previsto:** Apache o LiteSpeed en un alojamiento con cPanel.

---

## 3. Estructura de carpetas y archivos

```text
/
├── .htaccess
├── index.php
├── pagina_no_encontrada.php
├── robots.txt
├── sitemap.xml
├── README.md
├── .gitignore              solo para el repositorio, no se publica
├── almacenamiento/
│   ├── .htaccess
│   ├── privado/
│   │   └── .htaccess
│   └── temporal/
│       └── .htaccess
├── configuracion/
│   ├── .htaccess
│   ├── arranque.php
│   ├── documentos.php
│   ├── local.ejemplo.php
│   └── sitio.php
├── paginas/
│   ├── admision-y-matricula/   admision, becas, matricula, registro-matricula
│   ├── contacto/               contacto, contacto-envio
│   ├── nosotros/               historia, mision-vision-valores, personal-docente, plana-jerarquica
│   ├── otros/                  archivos-oficiales, comunicados, convocatoria-personal, noticias, otros-enlaces
│   ├── privacidad/             politica-de-privacidad
│   ├── programas-de-estudio/   desarrollo-sistemas, efsrt, enfermeria-tecnica, industria-alimentos
│   ├── servicios/              biblioteca-institucional, bolsa-laboral, libro-reclamaciones, mesa-de-partes, plataforma-virtual, servicios-educacionales
│   └── transparencia/          convenios, documentos-gestion, estadisticas, inversiones, licenciamiento, tupa
├── plantillas/
│   ├── .htaccess
│   ├── cabecera.php
│   └── pie.php
├── recursos/
│   ├── datos/
│   │   ├── .htaccess
│   │   ├── documentos.json
│   │   ├── noticias.json
│   ├── documentos/
│   ├── estilos/
│   │   └── sitio.css
│   ├── fuentes/
│   │   ├── rotulo_negrita.woff2
│   │   ├── texto_regular.woff2
│   │   ├── texto_negrita.woff2
│   │   ├── licencia_big_shoulders_ofl.txt
│   │   └── licencia_work_sans_ofl.txt
│   ├── imagenes/
│   │   ├── carreras/           fotos de cada programa
│   │   │   └── recortes/       fotos recortadas (PNG y WebP con transparencia)
│   │   ├── identidad/
│   │   ├── infraestructura/
│   │   ├── instituto/
│   │   └── noticias/
│   └── scripts/
│       ├── sitio.js
│       └── integraciones/
│           ├── facebook.js
│           └── youtube.js
└── redes-sociales/
    ├── fotos-facebook.php
    └── videos-youtube.php
```

### 3.1. Módulos y funciones principales

Cada página de `paginas/` define `$titulo`, `$activo`, `$pagina`, `$raiz` y `$lead`, incluye `plantillas/cabecera.php` (que carga `configuracion/arranque.php`) y llama a `mac_pagina_abrir()` y `mac_pagina_cerrar()`. `arranque.php` carga a su vez `sitio.php` (datos institucionales, menú y componentes) y `documentos.php` (documentos, noticias y autoridades).

| Función | Archivo | Qué hace |
|---|---|---|
| `mac_config($clave, $defecto)` | `arranque.php` | Lee la configuración: valores por defecto, `local.php` y variables de entorno (estas tienen prioridad). |
| `mac_base_url()` | `arranque.php` | Devuelve `site_url` validado (solo esquema, dominio y puerto); si no es válido, `https://iestp-mac.edu.pe`. Base de canonical, Open Graph y JSON-LD. |
| `mac_es_entorno_pruebas()` | `arranque.php` | Verdadero si `environment` no es de producción o el dominio es local o de pruebas; activa `noindex`. |
| `mac_storage_path($subruta)` | `arranque.php` | Ruta de almacenamiento: `STORAGE_PATH` si está definida; si no, `almacenamiento/`. |
| `mac_secret_key()` | `arranque.php` | Devuelve la clave para HMAC (`APP_SECRET` o `privado/secreto.key`) o `null` si no hay una válida. Ver el paso 7 de la sección 6. |
| `mac_rate_limit_contact($max, $ventana)` | `arranque.php` | Devuelve `'permitido'`, `'limitado'` o `'no_disponible'`. |
| `mac_limpiar_temporal($prefijo, $edad)` | `arranque.php` | Borra registros de envío vencidos y temporales abandonados. |
| `mac_cache_read()` / `mac_cache_write()` | `arranque.php` | Caché JSON de Facebook y YouTube en `temporal/`; la escritura es atómica y devuelve si tuvo éxito. |
| `mac_csrf_token()` / `mac_csrf_is_valid()` | `arranque.php` | Token CSRF de 256 bits en la sesión y comparación con `hash_equals`. |
| `mac_http_get()` | `arranque.php` | GET solo por HTTPS, con verificación de certificado y sin seguir redirecciones. |
| `mac_cargar_datos($nombre)` | `documentos.php` | Lee un JSON de `recursos/datos/` (con `basename`, sin rutas) y lo guarda en memoria durante la solicitud. |
| `mac_documento_url($doc)` | `documentos.php` | URL pública de un PDF de `recursos/documentos/`. |
| `mac_documentos_mostrar($pagina)` | `documentos.php` | Registro de documentos vigentes y no vigentes con buscador y filtros; descarta rutas con `..` y archivos inexistentes. |
| `mac_pagina_abrir()` / `mac_pagina_cerrar()` | `sitio.php` | Cabecera de página interna (migas, título, entrada, menú de sección) y cierre con el bloque de ayuda. |
| `mac_imagen()` / `mac_recorte()` / `mac_figura_zoom()` | `sitio.php` | `<picture>` con WebP y JPG o PNG de respaldo, dimensiones fijas y carga diferida. |
| `mac_e()` / `mac_url()` / `mac_recurso()` | `sitio.php` | Escape HTML, rutas relativas a la raíz y versión `?v=` por fecha de modificación. |

---

## 4. Requisitos del entorno

- **PHP:** versión `8.1` o superior (`declare(strict_types=1)`). En cPanel se recomienda PHP `8.4` si el alojamiento la ofrece **y** el portal supera la comprobación del paso 2 de la sección 6 en el servidor de pruebas; si no, PHP `8.3`, que es la versión con la que se ejecutaron todas las pruebas (8.3.36 en el equipo de desarrollo y 8.3.6 en la auditoría final).
- **Estado de PHP 8.4:** el análisis estático no encontró funciones, parámetros ni directivas obsoletas en 8.4. Para PHP 8.5 hay dos avisos previstos en `mac_http_get()`: `curl_close()` (sin efecto desde PHP 8.0) y la variable `$http_response_header`, que solo se usa si el servidor no tiene la extensión `curl`.
- **Extensiones PHP recomendadas:** `curl`, `json`, `mbstring`, `simplexml`, `libxml`.
- **Servidor web:** Apache `2.4+` o LiteSpeed con soporte para archivos `.htaccess` (`mod_rewrite`, `mod_headers`, `mod_expires`, `mod_deflate`, `mod_mime`, `mod_alias`).
- **Permisos de escritura:** PHP debe poder escribir en `almacenamiento/temporal/` (caché de redes sociales y registro de envíos del formulario) y en `almacenamiento/privado/` (clave secreta), o en las carpetas equivalentes de `STORAGE_PATH`. Si no puede, el formulario de contacto responde «no disponible» (503) en lugar de aceptar envíos sin límite.

---

## 5. Instalación en entorno local

1. Inicia el servidor integrado de PHP desde la raíz del proyecto:
   ```powershell
   php -S localhost:8080
   ```
2. Si quieres probar el correo, el entorno o las credenciales de redes sociales, copia `configuracion/local.ejemplo.php` como `configuracion/local.php` y completa los valores (`site_url`, `environment`, `contact_email_to`, `contact_email_from`, etc.).
3. Abre `http://localhost:8080/` en el navegador.

El servidor integrado de PHP no lee los archivos `.htaccess`; las restricciones de acceso, las redirecciones 301 y la página 404 personalizada solo se comprueban en Apache o LiteSpeed. En `localhost` o dominios de prueba (`prueba.*`), el portal añade automáticamente `noindex, nofollow` y la cabecera `X-Robots-Tag: noindex, nofollow`.

---

## 6. Procedimiento de despliegue en cPanel

Este procedimiento describe el paso a paso para la publicación oficial en un servidor compartido o VPS administrado con cPanel:

### 1. Requisitos del alojamiento
- Servidor web Apache 2.4+ o servidor web LiteSpeed Enterprise (100% compatible con directivas `.htaccess`).
- Directiva `AllowOverride All` (o al menos `FileInfo`, `AuthConfig`, `Limit`, `Indexes`, `Options`) habilitada en la configuración del VirtualHost.
- Acceso a cPanel con permisos para **Administrador de archivos**, **MultiPHP Manager**, **Enrutamiento de correo** y **SSL/TLS**.

### 2. Versión de PHP recomendada
- **Versión preferida:** PHP `8.4`, después de comprobar en el servidor de pruebas que no aparecen avisos en el registro de errores al recorrer todas las páginas y enviar el formulario. Si aparece algún aviso, usa PHP `8.3`, que es la versión probada.
- **Versión mínima soportada:** PHP `8.1` (con `declare(strict_types=1)`).
- **Extensiones obligatorias activas:** `curl`, `json`, `mbstring`, `simplexml`, `libxml`.
- **Extensiones opcionales recomendadas:** `fileinfo`, `zip`.

### 3. Selección de PHP en MultiPHP Manager
1. Ingresa a cPanel y busca la herramienta **MultiPHP Manager** (Administrador MultiPHP).
2. Localiza el dominio `iestp-mac.edu.pe` (o el subdominio asignado).
3. Selecciona en el menú desplegable la versión PHP `8.4` (o `8.3`).
4. Haz clic en **Aplicar**.
5. Ingresa a **Editor INI de MultiPHP** (MultiPHP INI Editor) en modo básico y verifica:
   - `memory_limit`: mínimo `128M` (recomendado `256M`).
   - `post_max_size`: `16M`.
   - `upload_max_filesize`: `10M`.
   - `display_errors`: `Off` (en producción nunca deben exponerse errores en pantalla).
   - `log_errors`: `On`.

### 4. Preparación de `public_html`
1. Ingresa al **Administrador de archivos** de cPanel.
2. Si el directorio `public_html` contiene archivos del sitio web antiguo, crea una copia de seguridad comprimiendo su contenido en `respaldo_antiguo_portal.zip` y muévelo fuera de `public_html` a tu carpeta personal (`/home/usuario/respaldos/`).
3. Limpia `public_html` dejando únicamente archivos indispensables del sistema cPanel (como `.well-known` para validación SSL de AutoSSL si existiera).
4. Sube el paquete de despliegue del portal institucional.
5. Extrae el paquete directamente en la raíz de `public_html` (o en el directorio raíz correspondiente al subdominio).
6. **Elimina de inmediato el archivo `.zip` subido** para no dejar instaladores en la raíz pública.
7. Activa «Mostrar archivos ocultos (dotfiles)» en la rueda dentada de configuración del Administrador de archivos para verificar que `.htaccess` se haya extraído correctamente.

### 5. Configuración de `local.php`
1. Dentro de `public_html/configuracion/`, localiza el archivo plantilla `local.ejemplo.php`.
2. Haz una copia del archivo y nómbrala `local.php`.
3. Edita `local.php` con los valores de producción del instituto:
   ```php
   return [
       'site_url' => 'https://iestp-mac.edu.pe',
       'environment' => 'production',
       'contact_email_to' => 'informes@iestp-mac.edu.pe',
       'contact_email_from' => 'informes@iestp-mac.edu.pe',
       'app_secret' => '', // Opcional: clave de 32 a 512 caracteres imprimibles (se recomienda 64 hexadecimales); vacía = se usa almacenamiento/privado/secreto.key
       'storage_path' => '', // Opcional: define la ruta absoluta fuera de public_html (ej. '/home/usuario/mac_almacenamiento')
       'facebook_page_url' => 'https://www.facebook.com/iestpmanuelarevalocaceres/',
       'facebook_page_id' => '',
       'facebook_page_access_token' => '',
       'meta_graph_api_version' => 'v26.0',
       'youtube_channel_url' => 'https://www.youtube.com/@manuelarevalocaceres9047',
       'youtube_channel_id' => 'UCBA-mup6OyVOdByyVFDueQw',
   ];
   ```
4. Guarda los cambios. Asigna permisos `0640` (o `0600`) al archivo `local.php`.

### 6. Configuración de `STORAGE_PATH`
Por defecto, el portal utiliza `public_html/almacenamiento/`. Para máxima seguridad institucional en cPanel, se recomienda ubicar los datos y la caché fuera de la carpeta pública `public_html`.
1. En el Administrador de archivos, crea la carpeta en el directorio principal de tu cuenta cPanel: `/home/usuario/mac_almacenamiento`.
2. Crea dentro las dos subcarpetas: `/home/usuario/mac_almacenamiento/privado` y `/home/usuario/mac_almacenamiento/temporal`.
3. En `configuracion/local.php`, define:
   ```php
   'storage_path' => '/home/usuario/mac_almacenamiento',
   ```
4. Con esta configuración, ninguna petición web podrá acceder a la carpeta de almacenamiento porque físicamente se encuentra un nivel por encima de la raíz pública.

### 7. Creación del directorio privado y clave secreta
1. Si mantienes el almacenamiento por defecto dentro de `public_html/almacenamiento/privado/`, comprueba que contenga el archivo `.htaccess` con directivas de denegación (`Require all denied` y `Deny from all`).
2. La clave se obtiene en este orden:
   - `APP_SECRET` (variable de entorno) o `'app_secret'` en `local.php`, si tiene de 32 a 512 caracteres imprimibles. Una clave más corta se ignora y se anota en el registro de errores.
   - El archivo persistente `privado/secreto.key`. Si no existe, el primer envío del formulario lo crea con `random_bytes(32)` (64 caracteres hexadecimales): bloquea `privado/secreto.lock` con `flock()` para que dos solicitudes simultáneas no generen claves distintas, escribe en un archivo temporal, lo mueve a su lugar, vuelve a leerlo para comprobarlo y le asigna permisos `0600`. Si encuentra el archivo con permisos más abiertos, intenta restringirlos a `0600`.
   - Si el archivo existe pero no se puede leer o su contenido no es válido, **no se regenera** (así no se pierde la clave anterior): el formulario queda «no disponible» y el motivo se anota en el registro de errores.
3. **Sin clave válida no hay envíos.** El portal ya no usa claves temporales en memoria: una clave distinta en cada solicitud cambiaba la huella de la IP y anulaba el límite de envíos. Si no hay clave o no se puede escribir el registro de intentos, el formulario responde `503 Service Unavailable` con un mensaje genérico, la cabecera `X-Formulario-Estado: no-disponible` y la causa solo en el registro de errores del servidor.
4. No copies el `secreto.key` del equipo de desarrollo al servidor: el servidor debe generar el suyo o usar `APP_SECRET`.
5. Para cambiar la clave, borra `secreto.key` (se crea una nueva en el siguiente envío) o cambia `APP_SECRET`. El único efecto es que los contadores de envíos de los últimos 10 minutos empiezan de cero.

### 8. Permisos de archivos y carpetas
Aplica la política estándar de privilegios mínimos en cPanel:
- Todas las carpetas estándar: permisos `0755`.
- Carpetas de almacenamiento (`almacenamiento/`, `almacenamiento/temporal/`, `almacenamiento/privado/`): permisos `0750` (o `0700`).
- Todos los archivos estándar (`.php`, `.css`, `.js`, `.json`, `.jpg`, `.png`, `.webp`, `.woff2`): permisos `0644`.
- `configuracion/local.php`: permisos `0640` (o `0600`).
- `almacenamiento/privado/secreto.key`: `0600` (el portal lo crea así y corrige permisos más abiertos).

### 9. Configuración HTTPS
1. Ingresa a **SSL/TLS Status** en cPanel y confirma que el dominio `iestp-mac.edu.pe` cuente con un certificado SSL válido y activo (emitido por AutoSSL / Let's Encrypt o certificado comercial).
2. Si no está activo, haz clic en **Run AutoSSL** y espera la emisión del certificado.
3. En el archivo `.htaccess` de la raíz del portal, la redirección forzada a HTTPS y la cabecera `Strict-Transport-Security` (HSTS) ya se encuentran programadas y operativas.

### 10. Verificación de `.htaccess`
1. Confirma que el archivo `.htaccess` esté presente en la raíz de `public_html`.
2. Prueba las siguientes protecciones desde el navegador o mediante `curl`:
   - Intentar abrir `https://iestp-mac.edu.pe/README.md` -> Debe responder `403 Forbidden`.
   - Intentar abrir `https://iestp-mac.edu.pe/configuracion/arranque.php` -> Debe responder `403 Forbidden`.
   - Intentar abrir `https://iestp-mac.edu.pe/recursos/datos/documentos.json` -> Debe responder `403 Forbidden`.
   - Intentar abrir una página inexistente `https://iestp-mac.edu.pe/ruta-de-prueba` -> Debe responder `404 Not Found` con la plantilla institucional personalizada.
   - Probar una URL antigua del portal previo, por ejemplo `https://iestp-mac.edu.pe/tra_tupa.php` -> Debe redirigir con código `301 Moved Permanently` a `https://iestp-mac.edu.pe/paginas/transparencia/tupa.php`.
   - `https://iestp-mac.edu.pe/almacenamiento/privado/secreto.key` -> `403 Forbidden`.
3. **Redirecciones del portal anterior (pendiente de ejecutar en el servidor).** El `.htaccess` tiene 27 reglas que cubren 31 URL antiguas. Sus destinos existen y se comprobaron con una simulación estática, pero todavía no con Apache. En el servidor de pruebas, ejecuta para cada URL antigua:
   ```bash
   curl -sI "https://iestp-mac.edu.pe/tra_tupa.php?x=1" | grep -iE "^HTTP|^location"
   ```
   Resultado esperado: `HTTP/2 301` y `location: https://iestp-mac.edu.pe/paginas/transparencia/tupa.php?x=1`. Las variantes con `http://` o `www.` hacen dos saltos (primero al dominio canónico con HTTPS y después a la página nueva); el destino final debe ser el mismo.

### 11. Configuración de correo electrónico
1. Ingresa a **Cuentas de correo electrónico** en cPanel y verifica que la cuenta institucional `informes@iestp-mac.edu.pe` exista y tenga espacio disponible.
2. Ingresa a **Enrutamiento de correo** (Email Routing) y asegúrate de que esté configurado en «Intercambiador de correo local» (Local Mail Exchanger).
3. Revisa la herramienta **Capacidad de entrega del correo electrónico** (Email Deliverability) y confirma que los registros SPF, DKIM y DMARC estén con estado «Válido».
4. Envía un mensaje de prueba desde el formulario de `paginas/contacto/contacto.php` y revisa la bandeja de entrada institucional para corroborar la recepción del correo.

### 12. Comprobación de SEO y presencia en buscadores
1. Verifica que `robots.txt` sea accesible en `https://iestp-mac.edu.pe/robots.txt` y contenga la directiva `Sitemap: https://iestp-mac.edu.pe/sitemap.xml`.
2. Verifica que `sitemap.xml` responda con código `200` y cargue el XML sin errores de marcado.
3. Vincula el dominio en **Google Search Console** utilizando el método de registro DNS TXT o subiendo el archivo HTML de verificación proporcionado por Google.
4. Envía la URL `https://iestp-mac.edu.pe/sitemap.xml` en Google Search Console para indexación de las 32 páginas públicas.

### 13. Verificación integral de páginas y navegación
1. Revisa la página de inicio comprobando el renderizado del banner principal de fondo, el selector por perfiles «¿Qué necesitas hacer?» y las tarjetas de carreras.
2. Visita cada una de las 3 carreras profesionales (Desarrollo de Sistemas de Información, Enfermería Técnica, Industria de Alimentos y Bebidas) y comprueba las fotografías de talleres y laboratorios.
3. Ingresa a Transparencia (`paginas/transparencia/documentos-gestion.php`) y comprueba la descarga de los documentos oficiales en PDF.
4. Prueba la navegación completa en un teléfono móvil (ancho 360–390 px) y en una computadora de escritorio (ancho 1440 px).

### 14. Procedimiento de actualización
Para actualizar contenidos o código en el futuro:
1. Genera siempre una copia de seguridad antes de intervenir (ver paso 15).
2. Si actualizas documentos de gestión: coloca los nuevos PDF en `recursos/documentos/` y actualiza la lista en `recursos/datos/documentos.json`.
3. Si publicas noticias: edita `recursos/datos/noticias.json` respetando el formato JSON.
4. Si actualizas estilos o scripts: sube los archivos a `recursos/estilos/` o `recursos/scripts/`. La función `mac_recurso()` agrega a la dirección el parámetro `?v=` con la fecha de modificación del archivo, así que los navegadores descargan la versión nueva sin cambiar ninguna plantilla. Si cambias el script en línea de `plantillas/cabecera.php`, actualiza también su hash `sha256-…` en la cabecera `Content-Security-Policy-Report-Only` del `.htaccess`.
5. Nunca sobrescribas `configuracion/local.php` durante una actualización.

### 15. Recuperación desde una copia de seguridad
1. En caso de incidencia, ingresa al Administrador de archivos de cPanel.
2. Renombra la carpeta `public_html` actual como `public_html_incidencia_[FECHA]`.
3. Crea una nueva carpeta limpia `public_html`.
4. Sube y extrae la copia de seguridad zip más reciente de tu carpeta de respaldos.
5. Restaura el archivo de configuración `configuracion/local.php`.
6. Verifica inmediatamente la carga del portal y sus permisos.
7. Una vez restablecido el servicio, elimina la carpeta de incidencia para liberar espacio en disco.

---

## 7. Sistema de diseño

### 7.1. Identidad

El diseño, llamado «El muro de Los Alisos», toma como referencia la fachada de la sede: el muro ocre con el nombre pintado en letras de rótulo y el zócalo verde. Cada página repite tres capas:

- **Muro:** campo ocre con el nombre o el título de la página en letra de rótulo (portada y cabecera de cada página interna).
- **Zócalo:** banda verde que contiene las acciones (selector por perfil, franja de matrícula y pie de página).
- **Aula:** fondo blanco o cal para leer, con una columna de texto de unos 70 caracteres.

El ocre se limita a la portada, la cabecera de cada página y un bloque destacado por sección; todo texto largo va sobre blanco.

### 7.2. Colores (variables de `recursos/estilos/sitio.css`)

| Variable | Valor | Uso |
|---|---|---|
| `--ocre` | `#e2be6a` | Portada, cabeceras, placas de programas, pestaña activa, bloque de requisitos |
| `--ocre-300` | `#efd69e` | Estados al pasar el cursor sobre ocre |
| `--ocre-100` | `#f8edd3` | Avisos de alerta |
| `--ocre-700` | `#7a5a12` | Iconos sobre ocre claro |
| `--verde-950` | `#0b2e26` | Texto principal (color real de las letras del muro), banda de admisión, pie |
| `--verde-900` | `#134a2c` | Zócalo, botones (verde del emblema) |
| `--verde-800` | `#1f5c38` | Enlaces |
| `--verde-700` | `#2c7a4e` | Anillo de foco sobre fondos claros, estados |
| `--verde-50` | `#f0f5f1` | Avisos informativos y paneles |
| `--cal` | `#f5f5f0` | Secciones alternas |
| `--oro` | `#d4a62a` | Anillo de foco sobre fondos verdes oscuros |
| `--tinta-2` | `#46564e` | Texto secundario sobre blanco (sobre ocre se usa `--verde-900`) |
| `--linea` / `--linea-campo` | `#d5dad2` / `#76857c` | Separadores / contorno de campos |
| `--error` | `#b42318` | Solo errores de formulario |

Todas las combinaciones de texto cumplen el nivel AA de WCAG 2.2: `#0b2e26` sobre ocre 8,2 : 1; `#134a2c` sobre ocre 5,8 : 1; ocre sobre `#134a2c` 5,8 : 1; blanco sobre `#134a2c` 10,3 : 1. Sobre ocre no se usa texto gris (4,4 : 1) ni el anillo de foco verde claro; el foco es verde oscuro.

### 7.3. Tipografía

- **Big Shoulders, negrita** (`--f-rotulo`): títulos, nombre institucional y fechas grandes.
- **Work Sans, regular y negrita** (`--f-texto`): texto, interfaz, datos y números de resolución.
- Los archivos están reducidos al alfabeto latino con todos los signos del español (14 a 19 KB cada uno) y se precargan desde `plantillas/cabecera.php`. Las fuentes de respaldo tienen métricas ajustadas para evitar saltos al cargar.

### 7.4. Espaciado, grilla y puntos de quiebre

- Contenedor de 76 rem como máximo, con márgenes laterales de 16 a 40 px.
- Separación entre secciones de 56 a 104 px según el ancho de pantalla.
- Puntos de quiebre: 680, 960 y 1180 px. Móvil hasta 679 px (foto de la portada a todo el ancho, pestañas de perfil en 2 × 2); tableta de 680 a 1179 px (menú en panel, programas en dos columnas con el tercero a lo ancho, menú de sección como pestañas desplazables); muro de la portada a dos columnas desde 960 px y menú completo con desplegables desde 1180 px.

### 7.5. Componentes principales

Portada con banner principal de fondo (nombre en letra de rótulo sobre la zona dorada del banner), selector «¿Qué necesitas hacer?» con indicador deslizante, placa de programa, banner de página interior, foto recortada integrada en bloques de información, galería de fotos, lista de publicaciones, tarjeta de noticia, registro de documentos (búsqueda, filtros, estados vigente y no vigente), ficha, aviso, acordeón, pasos, línea de tiempo, estado vacío, formulario con estados, botones con estados «Enviando…» y desactivado, consentimiento de redes, diálogos de privacidad y visor de imágenes, menú móvil y pie de página.

### 7.6. Movimiento

- Al cargar la portada, cada línea del nombre se descubre de izquierda a derecha como una pasada de pincel (máscara con `clip-path`, 650 ms y 120 ms entre líneas). El texto está en la página desde el primer instante.
- El selector por perfil desliza el indicador ocre hasta la pestaña elegida y cambia de panel con un fundido de 180 ms; se maneja con las flechas del teclado.
- **Entre páginas:** transición nativa (`@view-transition`): la cabecera queda quieta y el contenido sale hacia arriba y entra desde abajo. En navegadores sin esta función, el contenido entra con un fundido. Si la página siguiente tarda más de 180 ms, aparece una barra de carga verde y ocre arriba y un esqueleto del contenido (muro ocre, menú de sección y líneas); se retira solo al volver con «Atrás».
- **Entrada de cada página:** en la portada, el texto, los botones y la foto (que se descubre de abajo hacia arriba) entran en secuencia; en las páginas internas, el título se descubre como pincelada, crece el filete verde y el menú de sección entra escalonado.
- **Al desplazarse:** las tarjetas, fichas, listas y bloques que estaban fuera de la pantalla aparecen con un fundido ascendente y escalonado (clase `.revelar`, agregada por `sitio.js`; lo que ya se ve al cargar no se anima).
- **Carga en esqueleto:** cada foto muestra un brillo sobre fondo verde claro mientras se descarga y luego aparece con un fundido; lo mismo en el visor de imágenes, en el recuadro de Facebook y en las miniaturas de YouTube.
- **Botones:** se elevan al pasar el cursor, se hunden al pulsarlos y muestran una onda desde el punto pulsado (`.onda`). Filtros, pestañas, flechas de «¿Sabías que…?» y el botón de menú se reducen levemente al pulsarlos.
- **Navegación:** subrayado animado en el menú principal, elementos de los desplegables y del menú móvil que entran escalonados, y filete ocre de la sección activa que crece al cargar.
- **Detalles:** zoom suave en las fotos de programas y videos, flecha que avanza en «Conoce el programa», iconos que se mueven al pasar el cursor, diálogos y aviso de privacidad que aparecen y se retiran con fundido, campo incompleto que se sacude al intentar enviar el formulario y documentos filtrados que reaparecen escalonados.
- Con la preferencia de movimiento reducido del sistema no hay desplazamientos ni animaciones: la clase `anim` (que activa todo lo anterior) solo se agrega en `<head>` cuando el sistema permite movimiento.

---

## 8. Administración de contenidos sin base de datos

### 8.1. Documentos oficiales (`recursos/datos/documentos.json`)

1. Copia el PDF oficial en la subcarpeta correspondiente de `recursos/documentos/`.
2. Agrega o actualiza el objeto dentro del arreglo `"documentos"`:
   - `"titulo"`: nombre oficial del documento.
   - `"categoria"`: clave de categoría (por ejemplo `"normativa"`, `"planes"`, `"resoluciones"`, `"convenios"`, `"tramites"`).
   - `"estado"`: `"vigente"` o `"no_vigente"`.
   - `"periodo"`: año o rango de vigencia (por ejemplo `"2026"` o `"2026–2032"`).
   - `"fecha"`: fecha en formato `AAAA-MM-DD` (ordena las publicaciones recientes de la portada).
   - `"resolucion"`: número de la resolución o documento que lo aprueba.
   - `"paginas"`: cantidad de páginas del PDF.
   - `"archivo"`: ruta relativa dentro de `recursos/documentos/`.
   - `"destinos"`: páginas donde debe mostrarse el documento.

### 8.2. Noticias (`recursos/datos/noticias.json`)

La sección de noticias de la portada y de `paginas/otros/noticias.php` solo aparece cuando este archivo tiene noticias. Publica únicamente información verificada por el instituto.

```json
{
  "noticias": [
    {
      "titulo": "Título de la noticia",
      "fecha": "2026-11-15",
      "resumen": "Una o dos oraciones con lo esencial.",
      "imagen": "nombre-de-la-foto.jpg",
      "imagen_alt": "Descripción breve de la fotografía",
      "enlace": "https://www.facebook.com/iestpmanuelarevalocaceres/posts/...",
      "fuente": "Dirección General"
    }
  ]
}
```

- `titulo` y `fecha` son obligatorios; los demás campos son opcionales.
- Las imágenes se colocan en `recursos/imagenes/noticias/` (se recomiendan 1200 × 750 px en JPG o WebP).
- `enlace` puede ser una dirección `https://` o una ruta interna del portal, por ejemplo `paginas/admision-y-matricula/admision.php`.
- La portada muestra las tres noticias más recientes.

### 8.3. Organización institucional

La página `paginas/nosotros/plana-jerarquica.php` muestra el organigrama como lista HTML de cargos (arreglo `$unidades`). El repositorio no publica nombres de autoridades ni de personal: para mostrar quién ocupa cada cargo, hazlo solo en el servidor de producción y con autorización del instituto.

### 8.4. Datos generales, navegación y accesos por perfil (`configuracion/sitio.php`)

- `$GLOBALS['MAC_SITIO']`: teléfonos, correo, dirección, horario y enlaces externos (`intranet`, `digitalia`, `minedu`, `drelm`). Si el instituto cuenta con una plataforma de matrícula en línea, agrega la clave `'matricula'` con su dirección: la página de procesos de matrícula mostrará el botón correspondiente.
- `$GLOBALS['MAC_NAV']`: secciones del menú principal. El quinto valor opcional de cada enlace agrupa los enlaces dentro del desplegable (por ejemplo, «Postular» y «Matricularme»).
- `$GLOBALS['MAC_PERFILES']`: accesos del selector «¿Qué necesitas hacer?» de la portada y del menú móvil.

### 8.5. Imágenes

- **El repositorio no contiene fotografías.** Se retiraron todas las fotos y afiches con personas, la fachada, el organigrama, el calendario y los cronogramas en imagen. La portada es un bloque de color con el nombre del instituto, las tarjetas de programas muestran un ícono (`mac_imagen_o_ilustracion()` usa la ilustración cuando no existe la foto) y el calendario académico y los cronogramas de matrícula se muestran como tablas HTML en `paginas/admision-y-matricula/matricula.php`.
- **Si el instituto quiere agregar fotos en producción:** coloca la imagen en la ruta que espera cada función (`mac_imagen()`, `mac_recorte()`, la variable `$banner` de `mac_pagina_abrir()` o el cuarto valor del arreglo `$programas` de `index.php`) y súbela solo al servidor, nunca al repositorio. Usa únicamente fotos de personas que hayan autorizado el uso de su imagen.
- **Emblema:** `recursos/imagenes/identidad/` conserva el logo institucional, los favicons y el ícono para iPhone. El logo también es la imagen para compartir en redes sociales (`og:image`).

---

## 9. Seguridad y privacidad

- **Protección de directorios y archivos internos:** los archivos `.htaccess` de `configuracion/`, `plantillas/`, `almacenamiento/`, `almacenamiento/temporal/`, `almacenamiento/privado/` y `recursos/datos/` bloquean el acceso HTTP directo (`Require all denied`). El `.htaccess` raíz bloquea el acceso público a `README.md`, archivos ocultos (`.env`, `.git`, `.htaccess`, `.gitignore`), claves (`.key`, `.pem`), bloqueos (`.lock`), paquetes comprimidos (`.zip`, `.rar`, `.7z`, `.tar`, `.gz`), respaldos (`.bak`, `.old`, `.orig`, `.swp`, `.tmp`, `.sql`) y mapas de origen (`.map`).
- **Sin datos personales en el repositorio:** el repositorio público no incluye nombres de autoridades, docentes ni estudiantes, fotografías de personas ni documentos firmados. Solo se conservan dos PDF sin datos personales: el Formato Único de Trámite (en blanco) y la relación de tasas 2025. Los manuales, planes, resoluciones, horarios y convenios contienen nombres, firmas, DNI o datos de contacto, por eso no se versionan (`.gitignore` excluye todo `recursos/documentos/` salvo esos dos archivos). El portal funciona sin ellos: los documentos que faltan no se listan y las citas a esos documentos se muestran como texto, sin enlace (`mac_doc_enlace()` y `mac_doc_disponible()` en `configuracion/sitio.php`).
- **Respaldos y repositorio:** los respaldos se guardan fuera de `public_html` y fuera del paquete de producción. El `.gitignore` excluye `configuracion/local.php`, claves, el contenido de `almacenamiento/privado/` y `almacenamiento/temporal/`, temporales, registros, respaldos y ZIP. `.gitignore` no retira archivos que ya estaban versionados: compruébalo con `git ls-files configuracion/local.php almacenamiento` y, si aparece alguno, quítalo del índice con `git rm --cached <archivo>`.
- **Separación de documentos públicos y privados:** los documentos oficiales de transparencia y trámites se alojan en `recursos/documentos/` para consulta ciudadana, mientras que `almacenamiento/privado/` está bloqueado al acceso web directo para documentos administrativos internos.
- **URLs canónicas y control de indexación:** las URLs canónicas, Open Graph y JSON-LD se generan a partir de `site_url` (`https://iestp-mac.edu.pe`) en lugar de confiar en la cabecera HTTP `Host`. Los entornos locales o de prueba emiten automáticamente `noindex, nofollow`.
- **Protección de formularios y privacidad de IP:** token CSRF en sesión (`hash_equals`), campo trampa contra bots, saneamiento de cabeceras de correo contra inyección CRLF y límite de envíos (3 por sesión y 6 por dirección IP cada 10 minutos). La IP no se guarda: se guarda una huella `HMAC-SHA256` truncada, con la clave secreta y la fecha UTC como sal diaria, en `almacenamiento/temporal/rate-contact-*.json`. Cada registro se lee y actualiza bajo bloqueo exclusivo (`flock`), de modo que las solicitudes simultáneas no superan el límite. Los archivos vencidos se depuran solos. Si el límite no puede garantizarse, el formulario responde 503 (ver el paso 7 de la sección 6). Al cambiar de día UTC la huella cambia y el contador por IP empieza de cero.
- **Cabeceras HTTP:** `X-Content-Type-Options: nosniff`, `X-Frame-Options: SAMEORIGIN`, `Referrer-Policy: strict-origin-when-cross-origin`, `Permissions-Policy`, `Cross-Origin-Opener-Policy`, `Content-Security-Policy-Report-Only` y `Strict-Transport-Security` bajo HTTPS.
- **Privacidad de terceros:** las integraciones de Facebook y YouTube están bloqueadas hasta que la persona otorga su consentimiento desde el aviso o el diálogo de preferencias (`mac_privacy_preferences_v1`).
- **Almacenamiento del navegador:** además de la preferencia de privacidad, el portal recuerda en el navegador la última pestaña elegida en «¿Qué necesitas hacer?» (clave `mac_perfil_v1`), documentada en la política de privacidad. No contiene datos personales.

---

## 10. Registro de cambios del rediseño (noviembre de 2026)

- Nueva identidad visual «El muro de Los Alisos», inspirada en la fachada de la sede: muro ocre, letras de rótulo y zócalo verde en las cabeceras interiores, con la foto de la fachada junto al nombre en la portada.
- Nuevas tipografías Big Shoulders y Work Sans en lugar de las fuentes anteriores.
- Portada reorganizada: muro con el nombre y la foto de la fachada, selector de accesos por perfil, programas con foto, admisión, comunicados, historia, redes y consulta.
- Menú: «Nosotros» pasa a llamarse «Institución» y «Publicaciones» pasa a «Noticias»; «Archivos oficiales» se traslada a Transparencia y «Otros enlaces» a Servicios como «Enlaces institucionales». Las direcciones de las páginas no cambian.
- Accesos por perfil también en el menú móvil y en la página 404.
- Noticias administrables con `recursos/datos/noticias.json`.
- Corrección: el botón de la plataforma de matrícula enlazaba a una dirección no configurada; ahora solo aparece cuando existe la clave `'matricula'` en `configuracion/sitio.php`.
- Emblema y favicons regenerados desde el emblema en alta resolución.
- Nuevas fotos principales en las páginas de Enfermería Técnica e Industria de Alimentos y Bebidas, y galerías de clases y prácticas.
- Las tarjetas de programas de la portada muestran las miniaturas de cada carrera y las fotos recortadas acompañan los bloques de información en las páginas de cada programa.

### 10.1. Corrección de la portada y ajustes al plan

- La portada vuelve al diseño aprobado: el afiche rasterizado (`banner-hero-mac`), que se recortaba y mostraba texto incrustado, se reemplaza por la foto real de la fachada con su pie en HTML. La foto se apoya en el zócalo y en celulares ocupa todo el ancho.
- Puntos de quiebre del plan: 680, 960 y 1180 px (menú completo desde 1180 px).
- Barra superior: Mesa de partes e Intranet visibles en todos los anchos; la sigla IESTP se mantiene en celulares.
- «Ficha institucional» debajo de «¿Sabías que…?», bloque «Actividades y noticias» junto a los comunicados y redes en dos columnas iguales.
- Selector «¿Qué necesitas hacer?» con indicador ocre que se desliza a la pestaña elegida.
- Menú móvil con «Contacto» como botón y filete ocre en los submenús; botones con estados «Enviando…» y desactivado.
- Escala tipográfica y colores ajustados a los valores del plan.
- Nueva imagen para redes sociales de 1200 × 630 px; la referencia anterior apuntaba a un archivo que no existía.

### 10.2. Portada ampliada y limpieza del código

- La foto de la fachada ocupa toda la altura del muro desde 960 px: empieza a la altura del texto y se apoya en el zócalo. El encuadre conserva completo el muro rotulado de la izquierda.
- Se retiró la fuente cursiva (`texto_cursiva.woff2`), porque ningún texto del portal la usa; si algún día se escribe un texto en cursiva, el navegador la simula con la fuente regular.
- Se eliminaron reglas y variables CSS sin uso, una clase que el script agregaba sin que nada la leyera y un atributo `data-grupo` que ningún script consultaba.
- Los atributos `sizes` de las imágenes usan el nuevo punto de quiebre de 680 px.
- Las miniaturas de las tarjetas y los banners tienen versiones WebP: el navegador descarga la que corresponde al ancho de pantalla.

### 10.3. Movimiento e interacción

- Transiciones entre páginas, barra de carga y esqueleto del contenido mientras llega la página siguiente.
- Aparición escalonada de bloques al desplazarse y entrada animada de la portada y de las cabeceras internas.
- Esqueleto con brillo en fotos, visor, Facebook y YouTube.
- Botones con elevación, presión y onda; menús, pestañas, diálogos, filtros y formularios con micro-animaciones.
- Todo vive al final de `sitio.css` (desde `@keyframes sube`) y en las funciones `imagenes`, `ondas`, `cargaPagina` y `revelar` de `sitio.js`. Para que un enlace interno no muestre el esqueleto, agrégale el atributo `data-sin-carga`.

### 10.4. Fase final de estabilización (1 de noviembre de 2026)

- **Clave secreta y límite de envíos:** se eliminó la clave temporal en memoria, que cambiaba en cada solicitud cuando no se podía guardar `secreto.key` y permitía enviar sin límite. Ahora el formulario responde 503 si no hay clave o almacenamiento. La clave se crea una sola vez bajo bloqueo, se verifica después de escribirla, nunca se sobrescribe y se valida `APP_SECRET`. El registro de intentos por IP se actualiza bajo bloqueo exclusivo.
- **Historia:** la página mostraba una imagen rota (`infraestructura/institucion-fachada.jpg` no existe). Ahora el bloque solo aparece si el archivo existe; cuando el instituto entregue esa foto (1280 × 810 px con sus WebP de 800 y 1280 px), aparecerá sin tocar el código.
- **Limpieza:** se retiraron 13 comentarios de `sitio.css`, 5 de `sitio.js` y la regla `.esqueleto-foto`, que nada usaba. Ningún otro archivo se eliminó: todas las imágenes, fuentes y PDF tienen uso.
- **Seguridad de archivos:** `.lock` se agregó a las extensiones bloqueadas en el `.htaccess` raíz y se añadió `.gitignore`.
- **Formulario:** el script distingue el 503 «servicio no disponible» del 503 «correo sin configurar».

