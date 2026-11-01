<?php
$titulo = 'Archivos oficiales';
$activo = 'transparencia';
$pagina = 'archivos';
$raiz = '../../';
$lead = 'Índice de todos los documentos oficiales publicados en este portal. Busca por título, periodo o número de resolución, o filtra por tipo.';
$descripcion = 'Índice de documentos oficiales del IESTP Manuel Arévalo Cáceres: resoluciones, planes, manuales, convenios y formatos.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<?php mac_documentos_mostrar('*', $raiz); ?>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
