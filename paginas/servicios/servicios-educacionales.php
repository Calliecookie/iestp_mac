<?php
$titulo = 'Servicios educacionales';
$activo = 'servicios';
$pagina = 'educacionales';
$raiz = '../../';
$lead = 'Servicios académicos y de apoyo al estudiante que el instituto ofrece o enlaza desde este portal.';
$descripcion = 'Servicios educacionales y de bienestar del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
$servicios = [
    ['Plataforma virtual', 'Acceso a la plataforma académica externa del instituto.', 'paginas/servicios/plataforma-virtual.php', false],
    ['Biblioteca institucional', 'Recursos bibliográficos y acceso a la biblioteca virtual.', 'paginas/servicios/biblioteca-institucional.php', false],
    ['Biblioteca virtual Digitalia', 'Plataforma de libros electrónicos Digitalia Hispánica.', mac_dato('digitalia'), true],
    ['Mesa de partes', 'Presentación de solicitudes y trámites académicos.', 'paginas/servicios/mesa-de-partes.php', false],
    ['Bolsa laboral', 'Planes de inserción laboral y seguimiento de egresados.', 'paginas/servicios/bolsa-laboral.php', false],
    ['Atención y orientación ciudadana', 'Canales de consulta, horarios y teléfonos de atención.', 'paginas/servicios/libro-reclamaciones.php', false],
];
?>
<h2>Servicios en este portal</h2>
<ul class="lista-enlaces">
<?php foreach ($servicios as [$nombre, $detalle, $destino, $externo]): ?>
  <li><span><span class="lista-enlaces-nombre"><?= mac_e($nombre) ?></span><span class="lista-enlaces-detalle"><?= mac_e($detalle) ?></span></span><a class="boton boton-contorno boton-pequeno" href="<?= mac_url($destino) ?>"<?= $externo ? ' target="_blank" rel="noopener noreferrer"' : '' ?>>Abrir<span class="sr"> <?= mac_e($nombre) ?></span><?= $externo ? mac_externo() : '' ?></a></li>
<?php endforeach; ?>
</ul>
<h2>Unidad de Bienestar y Empleabilidad</h2>
<p>Según la organización institucional, esta unidad comprende los siguientes servicios:</p>
<ul class="lista-marcada">
  <li>Bienestar y consejería.</li>
  <li>Seguimiento de egresados.</li>
  <li>Empleabilidad.</li>
  <li>Tópico.</li>
</ul>
<p class="fuente">Fuente: organigrama publicado en <a href="../nosotros/plana-jerarquica.php">Plana jerárquica</a>. Las actividades de la unidad para este año figuran en su plan de trabajo.</p>
<?php mac_documentos_mostrar('servicios-educacionales', $raiz, ['titulo' => 'Plan de trabajo de la unidad']); ?>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
