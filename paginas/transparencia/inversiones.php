<?php
$titulo = 'Inversiones';
$activo = 'transparencia';
$pagina = 'inversiones';
$raiz = '../../';
$lead = 'Información verificable sobre proyectos de inversión y ejecución institucional.';
$descripcion = 'Inversiones del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<?= mac_vacio('Aún no hay información de inversiones publicada', 'Los proyectos, presupuestos, estados y avances se publicarán con los documentos oficiales del periodo correspondiente.', [
    ['Ver documentos de gestión', 'paginas/transparencia/documentos-gestion.php'],
]) ?>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
