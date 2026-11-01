<?php
$titulo = 'Contacto';
$activo = 'contacto';
$pagina = 'contacto';
$raiz = '../../';
$anchoCompleto = true;
$lead = 'Escríbenos, llámanos o visítanos en Los Olivos. Atendemos de lunes a viernes, de 08:00 a. m. a 10:00 p. m.';
$descripcion = 'Dirección, teléfono, correo, horario y formulario de contacto del IESTP Manuel Arévalo Cáceres.';
require_once dirname(__DIR__, 2) . '/configuracion/arranque.php';
$csrfToken = mac_csrf_token();
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<div class="contacto-grid">
<div>
<h2 class="titulo-bloque">Canales de atención</h2>
<div class="contacto-canales contacto-canales-columna">
  <div class="contacto-canal"><?= mac_icono('correo') ?><div><h3>Correo electrónico</h3><p><a href="mailto:<?= mac_e(mac_dato('correo')) ?>"><?= mac_e(mac_dato('correo')) ?></a></p></div></div>
  <div class="contacto-canal"><?= mac_icono('telefono') ?><div><h3>Teléfonos</h3><p><?php foreach ($GLOBALS['MAC_SITIO']['telefonos_atencion'] as $i => [$numero, $enlace]): ?><?= $i > 0 ? '<br>' : '' ?><a href="tel:<?= mac_e($enlace) ?>"><?= mac_e($numero) ?></a><?php endforeach; ?></p></div></div>
  <div class="contacto-canal"><?= mac_icono('reloj') ?><div><h3>Horario de atención</h3><p><?= mac_e(mac_dato('horario')) ?></p></div></div>
  <div class="contacto-canal"><?= mac_icono('reloj') ?><div><h3>Refrigerio</h3><p><?= mac_e(mac_dato('refrigerio')) ?></p></div></div>
  <div class="contacto-canal"><?= mac_icono('ubicacion') ?><div><h3>Dirección</h3><p><?= mac_e(mac_dato('direccion')) ?>, <?= mac_e(mac_dato('distrito')) ?>.<br><?= mac_e(mac_dato('referencia')) ?>.</p></div></div>
  <div class="contacto-canal"><?= mac_icono('usuarios') ?><div><h3>Redes oficiales</h3><p><a href="<?= mac_e((string) mac_config('facebook_page_url')) ?>" target="_blank" rel="noopener noreferrer">Facebook<?= mac_externo() ?></a><br><a href="<?= mac_e((string) mac_config('youtube_channel_url')) ?>" target="_blank" rel="noopener noreferrer">YouTube<?= mac_externo() ?></a></p></div></div>
</div>
</div>
<div>
<h2 class="titulo-bloque">Déjanos tu mensaje</h2>
<form class="formulario" id="form-contacto" action="contacto-envio.php" method="post" data-formulario>
  <div class="form-trampa" aria-hidden="true"><label>No completar este campo<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
  <input type="hidden" name="origen" value="contacto">
  <input type="hidden" name="csrf_token" value="<?= mac_e($csrfToken) ?>">
  <div class="formulario-fila">
    <div class="campo"><label for="contacto-nombre">Nombre y apellidos</label><input id="contacto-nombre" name="nombre" autocomplete="name" required maxlength="120"></div>
    <div class="campo"><label for="contacto-correo">Correo electrónico</label><input id="contacto-correo" name="correo" type="email" autocomplete="email" required maxlength="180" inputmode="email"></div>
  </div>
  <div class="campo"><label for="contacto-mensaje">Mensaje</label><textarea id="contacto-mensaje" name="mensaje" rows="6" required maxlength="3000"></textarea><span class="campo-ayuda">Hasta 3000 caracteres. No incluyas datos sensibles que no sean necesarios para tu consulta.</span></div>
  <label class="form-consentimiento"><input type="checkbox" name="acepta" value="1" required><span>Autorizo el uso de mis datos solo para responder esta consulta, según la <a href="../privacidad/politica-de-privacidad.php">política de privacidad</a>.</span></label>
  <div class="form-pie"><button class="boton" type="submit">Enviar mensaje</button></div>
  <p class="form-estado" role="status" aria-live="polite" data-form-estado></p>
</form>
</div>
</div>
<h2>Cómo llegar</h2>
<p>El local se ubica en la Av. Los Alisos N.º 858, a la altura de la cuadra 43 de la Av. Las Palmeras.</p>
<div class="acciones"><a class="boton" href="<?= mac_url(mac_dato('mapa')) ?>" target="_blank" rel="noopener noreferrer"><?= mac_icono('ubicacion') ?>Abrir en Google Maps<?= mac_externo() ?></a></div>
<?php mac_pagina_cerrar(false); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
