<?php
$titulo = 'Convocatoria de personal';
$activo = 'publicaciones';
$pagina = 'convocatoria';
$raiz = '../../';
$lead = 'Proceso de convocatoria para contrato docente y de asistentes 2026.';
$descripcion = 'Convocatoria de personal docente y asistente 2026 del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<?= mac_vacio('Los resultados y anexos no están publicados en este portal', 'Los documentos del proceso no forman parte de esta versión del sitio. Consúltalos en la página oficial de Facebook del instituto o solicítalos por los canales de atención.', [
    ['Abrir Facebook', (string) mac_config('facebook_page_url'), true],
    ['Consultar al instituto', 'paginas/contacto/contacto.php'],
]) ?>
<h2>Documentos que comprende el proceso</h2>
<ul class="etapas">
  <li>Resultado final de docentes</li>
  <li>Reclamos de docentes</li>
  <li>Resultados parciales de docentes</li>
  <li>Resultados de asistentes</li>
  <li>Resultados parciales de asistentes</li>
  <li>Cronograma de asistentes</li>
  <li>Anexos 05, 05 A, 05 B y 05 C</li>
  <li>Anexos 07, 07 A y 07 B</li>
</ul>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
