<?php
$titulo = 'Licenciamiento';
$activo = 'transparencia';
$pagina = 'licenciamiento';
$raiz = '../../';
$lead = 'Información sobre el licenciamiento y las autorizaciones institucionales, sustentada en resoluciones o publicaciones oficiales.';
$descripcion = 'Licenciamiento del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<?= mac_vacio('Sin resoluciones de licenciamiento publicadas', 'Esta página no afirma un estado de licenciamiento porque el portal no incluye las resoluciones o registros oficiales que lo respaldan. Se publicarán aquí cuando estén disponibles.', [
    ['Consultar al instituto', 'paginas/contacto/contacto.php'],
]) ?>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
