<?php
$titulo = 'Comunicados';
$activo = 'publicaciones';
$pagina = 'comunicados';
$raiz = '../../';
$lead = 'Vista previa de las publicaciones más recientes de la página oficial de Facebook del instituto.';
$descripcion = 'Comunicados y publicaciones oficiales del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<section class="red" aria-labelledby="comunicados-fb">
  <div class="red-cabeza">
    <h2 class="red-titulo" id="comunicados-fb"><?= mac_icono('facebook') ?>Publicaciones en Facebook</h2>
    <a class="red-enlace" href="<?= mac_e((string) mac_config('facebook_page_url')) ?>" target="_blank" rel="noopener noreferrer">Abrir la página<?= mac_externo() ?></a>
  </div>
  <div class="consentimiento" data-consentimiento>
    <p>El contenido se muestra directamente desde Facebook. Al mostrarlo, Facebook puede recibir datos técnicos de tu navegador.</p>
    <div class="acciones"><button type="button" class="boton" data-consent-external>Mostrar publicaciones</button><button type="button" class="boton-texto" data-open-privacy-settings>Más opciones</button></div>
  </div>
  <div class="fb-marco" data-fb data-fb-alto="760"></div>
</section>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
