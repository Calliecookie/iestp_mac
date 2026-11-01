<?php
$titulo = 'Convenios';
$activo = 'transparencia';
$pagina = 'convenios';
$raiz = '../../';
$lead = 'Convenios de cooperación educativa e interinstitucional firmados por el instituto, separados entre vigentes y no vigentes.';
$descripcion = 'Convenios con empresas y universidades del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<?= mac_aviso('Vigencia', 'La vigencia se indica según la fecha de firma y el plazo que fija cada convenio. Para confirmar vacantes o renovaciones, consulta con el instituto.') ?>
<?php mac_documentos_mostrar('convenios', $raiz, ['titulo' => 'Convenios vigentes']); ?>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
