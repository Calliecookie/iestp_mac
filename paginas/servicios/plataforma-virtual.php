<?php
$titulo = 'Plataforma virtual';
$activo = 'servicios';
$pagina = 'plataforma';
$raiz = '../../';
$lead = 'Acceso a los servicios y herramientas académicas que el instituto ofrece mediante plataformas externas.';
$descripcion = 'Acceso a la plataforma virtual académica del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<div class="columnas-dos">
  <div class="panel">
    <h2 class="panel-titulo">Plataforma académica (intranet)</h2>
    <p>Servicio externo del instituto para estudiantes y docentes.</p>
    <div class="acciones"><a class="boton" href="<?= mac_url(mac_dato('intranet')) ?>" target="_blank" rel="noopener noreferrer"><?= mac_icono('pantalla') ?>Abrir la plataforma<?= mac_externo() ?></a></div>
  </div>
  <div class="panel">
    <h2 class="panel-titulo">Biblioteca virtual Digitalia</h2>
    <p>Plataforma externa de libros electrónicos en español para la comunidad educativa.</p>
    <div class="acciones"><a class="boton boton-contorno" href="<?= mac_url(mac_dato('digitalia')) ?>" target="_blank" rel="noopener noreferrer"><?= mac_icono('libro') ?>Ir a Digitalia<?= mac_externo() ?></a></div>
  </div>
</div>
<?= mac_aviso('Protege tus credenciales', 'Antes de ingresar tu usuario y contraseña, comprueba que el dominio y el acceso sean los indicados por el instituto. Este portal informativo no recibe ni guarda contraseñas de las plataformas académicas.', 'alerta') ?>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
