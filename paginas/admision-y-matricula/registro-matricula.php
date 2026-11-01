<?php
$titulo = 'Registro de matrícula';
$activo = 'admision';
$pagina = 'registro';
$raiz = '../../';
$lead = 'Orientación y pasos que debes revisar antes de realizar tu registro de matrícula en cada periodo académico.';
$descripcion = 'Pasos y requisitos para el registro de matrícula del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<?= mac_vacio('El sistema de matrícula en línea es independiente de este portal', 'Este portal informativo no procesa matrículas ni solicita contraseñas. Confirma con Secretaría Académica las fechas habilitadas y el canal correspondiente al periodo académico en curso.', [
    ['Ver procesos y calendario de matrícula', 'paginas/admision-y-matricula/matricula.php'],
    ['Ver procedimiento en el MPA (PDF)', 'recursos/documentos/' . mac_dato('mpa') . '#page=16', true],
]) ?>
<h2>Antes de registrarte</h2>
<ol class="pasos">
  <li><p>Revisa los <a href="matricula.php">requisitos de tu tipo de matrícula</a>: ingresante, ratificación, reincorporación o unidad de repitencia.</p></li>
  <li><p>Consulta las fechas en el <a href="matricula.php#calendario">calendario académico 2026</a> y confírmalas con Secretaría Académica.</p></li>
  <li><p>Realiza el pago por derecho de matrícula según las indicaciones del Área de Administración y conserva el comprobante.</p></li>
  <li><p>Presenta los documentos y completa tu registro dentro del plazo establecido en la convocatoria.</p></li>
</ol>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
