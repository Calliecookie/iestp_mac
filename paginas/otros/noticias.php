<?php
$titulo = 'Noticias';
$activo = 'publicaciones';
$pagina = 'noticias';
$raiz = '../../';
$lead = 'Novedades del portal institucional y acceso a las publicaciones del instituto en sus redes oficiales.';
$descripcion = 'Noticias y últimas publicaciones del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
$macNoticias = mac_noticias_html(0, 'h3');
?>
<?php if ($macNoticias !== ''): ?>
<h2>Noticias del instituto</h2>
<?= $macNoticias ?>
<?php endif; ?>
<h2>Últimos documentos publicados</h2>
<?= mac_publicaciones_html(6) ?>
<div class="acciones"><a class="boton boton-contorno" href="archivos-oficiales.php">Ver todos los documentos</a></div>
<h2>Actividades y comunicados</h2>
<div class="panel">
  <p>El instituto difunde sus noticias, actividades y comunicados en su página oficial de Facebook. Este portal no reproduce noticias que no estén respaldadas por esa fuente.</p>
  <div class="acciones">
    <a class="boton" href="comunicados.php">Ver publicaciones recientes</a>
    <a class="boton boton-contorno" href="<?= mac_e((string) mac_config('facebook_page_url')) ?>" target="_blank" rel="noopener noreferrer">Abrir Facebook<?= mac_externo() ?></a>
  </div>
</div>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
