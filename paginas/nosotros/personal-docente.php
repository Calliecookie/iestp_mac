<?php
$titulo = 'Personal docente';
$activo = 'nosotros';
$pagina = 'docentes';
$raiz = '../../';
$lead = 'Relación del personal docente de los programas de estudio.';
$descripcion = 'Personal docente del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<?= mac_vacio('El directorio docente aún no está publicado', 'Esta página no muestra nombres, especialidades ni hojas de vida hasta que el instituto publique un directorio verificado y autorice su difusión. Mientras tanto, puedes consultar las autoridades y la organización académica.', [
    ['Ver la plana jerárquica', 'paginas/nosotros/plana-jerarquica.php'],
    ['Consultar al instituto', 'paginas/contacto/contacto.php'],
]) ?>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
