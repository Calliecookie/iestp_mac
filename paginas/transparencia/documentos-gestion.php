<?php
$titulo = 'Documentos de gestión';
$activo = 'transparencia';
$pagina = 'gestion';
$raiz = '../../';
$lead = 'Instrumentos de planificación, gestión y normativa publicados por el instituto, separados entre documentos vigentes y no vigentes.';
$descripcion = 'Planes de trabajo, manuales institucionales y resoluciones del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<?php mac_documentos_mostrar('documentos-gestion', $raiz); ?>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
