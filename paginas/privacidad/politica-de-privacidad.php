<?php
$titulo = 'Política de privacidad';
$activo = '';
$pagina = 'privacidad';
$raiz = '../../';
$lead = 'Uso de datos personales y preferencias de contenido externo en este sitio web.';
$descripcion = 'Política de privacidad del portal del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<article class="prosa privacidad-documento">
    <h2>1. Responsable y alcance</h2>
    <p>Este documento describe el tratamiento de datos a través del sitio web del Instituto de Educación Superior Tecnológico Público Manuel Arévalo Cáceres (IESTP MAC), con dirección institucional publicada en Av. Los Alisos N.º 858, Urb. Carlos Cueto Fernandini, Los Olivos, Lima. Para consultas sobre privacidad puedes escribir a <a href="mailto:informes@iestp-mac.edu.pe">informes@iestp-mac.edu.pe</a> con el asunto “Protección de datos personales”.</p>
    <p>Esta política cubre las consultas enviadas por los formularios de este portal y las preferencias de contenido externo. Los servicios, plataformas y trámites de terceros enlazados desde aquí pueden aplicar sus propios avisos de privacidad.</p>

    <h2>2. Datos que solicitamos</h2>
    <p>Para responder una consulta, el formulario puede solicitar únicamente nombre, correo electrónico, el mensaje y una confirmación de autorización. No solicitamos número de documento, domicilio ni teléfono para esta finalidad. Evita incluir en el mensaje información sensible que no sea necesaria para resolver tu consulta.</p>
    <p>El sitio utiliza una sesión técnica de PHP para proteger los formularios frente a solicitudes no autorizadas y limitar temporalmente los envíos repetidos (máximo 3 intentos cada 10 minutos por sesión). Adicionalmente, para prevenir el abuso automatizado del formulario, el servidor genera una huella criptográfica truncada y calculada con una clave secreta privada y rotación diaria (<code>HMAC-SHA256</code> de 16 caracteres) a partir de la dirección IP en <code>almacenamiento/temporal/</code> (directorio protegido sin acceso web público). Estos registros temporales contienen únicamente marcas de tiempo durante una ventana de 10 minutos (600 segundos), se depuran en solicitudes posteriores una vez transcurrido dicho plazo y no almacenan la dirección IP en texto plano ni crean perfiles publicitarios o analítica de visitantes.</p>

    <h2>3. Finalidad y base de uso</h2>
    <p>Los datos del formulario se utilizan para recibir, evaluar y responder la consulta que envías, así como para proteger la integridad del formulario. El envío es voluntario. Si no brindas los campos obligatorios, no podremos tramitar la consulta mediante el formulario. La institución deberá documentar y confirmar las bases jurídicas aplicables a cada procedimiento antes de publicar esta versión definitiva.</p>

    <h2>4. Destinatarios y servicios externos</h2>
    <p>El mensaje se dirige al correo institucional configurado para atención. El proveedor de alojamiento y el servicio de correo pueden tratar los datos técnicamente necesarios para operar el portal y entregar mensajes, conforme a sus condiciones y contratos.</p>
    <p>Las publicaciones incrustadas de Facebook y el contenido de YouTube se encuentran desactivados de forma predeterminada. Solo se cargan si aceptas expresamente “Contenido externo” en las preferencias. En ese caso, esos proveedores podrían recibir datos técnicos como la dirección IP, información del navegador y datos de conexión, y podrían utilizar cookies o tecnologías similares sujetas a sus propias políticas. Rechazar el contenido externo no impide visitar directamente sus páginas mediante los enlaces disponibles.</p>
    <p>Este sitio no incluye, en esta implementación, herramientas propias de analítica publicitaria ni publicidad comportamental. Los enlaces a otros sitios solo conectan con dichos servicios cuando decides abrirlos.</p>

    <h2>5. Cookies y almacenamiento del navegador</h2>
    <ul>
      <li><strong>Sesión técnica:</strong> cuando se usa un formulario protegido, PHP puede establecer una cookie de sesión llamada <code>MACSESSID</code>. Está configurada para no ser accesible desde JavaScript (<code>HttpOnly</code>), usar <code>SameSite=Lax</code> y marcarse como segura cuando la conexión está bajo HTTPS. Se utiliza para seguridad del formulario y no para publicidad.</li>
      <li><strong>Preferencia de privacidad:</strong> la elección se guarda en el almacenamiento local del navegador bajo la clave <code>mac_privacy_preferences_v1</code> para recordar si autorizaste contenido externo. Contiene solo la versión de preferencias, la opción elegida y la fecha de guardado; no es una cookie publicitaria.</li>
      <li><strong>Preferencia de navegación por perfil:</strong> cuando eliges una pestaña en el bloque «¿Qué necesitas hacer?» de la portada, el navegador guarda la clave <code>mac_perfil_v1</code> en el almacenamiento local con el identificador de esa pestaña (por ejemplo, <code>postular</code> o <code>tramite</code>) únicamente para mostrarla seleccionada en tu próxima visita. No contiene datos personales.</li>
      <li><strong>Contenido externo:</strong> al autorizar Facebook o YouTube, dichos proveedores pueden usar sus propias cookies o tecnologías de almacenamiento, según sus políticas.</li>
    </ul>
    <p>Puedes cambiar o retirar la autorización de contenido externo en cualquier momento desde el enlace “Preferencias de privacidad” del pie de página. Al retirar la autorización, se recarga la página para eliminar los contenidos incrustados de la sesión visible.</p>

    <h2>6. Conservación y seguridad</h2>
    <p>Las consultas deben conservarse solo durante el tiempo necesario para atenderlas y cumplir las obligaciones administrativas o archivísticas que resulten aplicables. Los plazos concretos deben ser definidos y documentados por la institución. El portal incorpora medidas técnicas como validación de campos, token de protección CSRF, límites básicos de intentos por sesión y cabeceras de seguridad; ninguna medida por sí sola elimina todos los riesgos.</p>

    <h2>7. Derechos sobre los datos personales</h2>
    <p>De acuerdo con la legislación peruana de protección de datos personales, puedes solicitar información o ejercer los derechos que te correspondan respecto de tus datos personales, sujeto a verificación de identidad y a las excepciones legales aplicables. Escribe a <a href="mailto:informes@iestp-mac.edu.pe?subject=Protecci%C3%B3n%20de%20datos%20personales">informes@iestp-mac.edu.pe</a>, con el asunto “Protección de datos personales”, y describe tu solicitud. La institución debe validar y publicar el canal formal, plazos de atención, responsable designado y demás información exigida que corresponda.</p>

    <h2>8. Marco normativo y revisión institucional</h2>
    <p>Como referencia general, este documento considera la Ley N.º 29733, Ley de Protección de Datos Personales, y su Reglamento aprobado por Decreto Supremo N.º 016-2024-JUS. Esta página es una implementación técnica inicial, no asesoría legal ni una certificación de cumplimiento. Antes de publicar, la institución debe revisar las finalidades y bases jurídicas, el inventario y registro de bancos de datos cuando corresponda, los plazos de conservación, contratos con proveedores, el canal de ejercicio de derechos y la exactitud de los datos de contacto.</p>
    <p>Referencias oficiales: <a href="https://www.gob.pe/institucion/anpd/normas-legales/6554453-n-016-2024-jus" target="_blank" rel="noopener noreferrer">Reglamento de la Ley de Protección de Datos Personales (D. S. N.º 016-2024-JUS)<?= mac_externo() ?></a> y <a href="https://www.gob.pe/institucion/anpd/normas-legales/243470-29733" target="_blank" rel="noopener noreferrer">Ley N.º 29733<?= mac_externo() ?></a>.</p>
    <p class="actualizacion"><strong>Fecha de actualización de esta versión técnica:</strong> 1 de noviembre de 2026.</p>
  <div class="acciones"><a class="boton" href="../contacto/contacto.php">Contactar al instituto</a><button class="boton boton-contorno" type="button" data-open-privacy-settings>Configurar privacidad</button></div>
</article>
<?php mac_pagina_cerrar(false); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
