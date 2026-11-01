<?php
$titulo = 'Biblioteca institucional';
$activo = 'servicios';
$pagina = 'biblioteca';
$raiz = '../../';
$lead = 'La biblioteca institucional orienta la consulta de los recursos bibliográficos disponibles para estudiantes y docentes.';
$descripcion = 'Biblioteca institucional y biblioteca virtual Digitalia del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<div class="panel">
  <h2 class="panel-titulo">Biblioteca virtual Digitalia</h2>
  <p>El instituto enlaza la plataforma de libros electrónicos Digitalia Hispánica. El acceso se realiza desde su página de inicio de sesión.</p>
  <div class="acciones"><a class="boton" href="<?= mac_url(mac_dato('digitalia')) ?>" target="_blank" rel="noopener noreferrer"><?= mac_icono('libro') ?>Ir a Digitalia<?= mac_externo() ?></a></div>
</div>
<?= mac_vacio('El catálogo de la biblioteca aún no está publicado', 'Los catálogos bibliográficos se publicarán aquí como archivos verificados. Mientras tanto, consulta la disponibilidad de un título directamente en el instituto.', [
    ['Consultar al instituto', 'paginas/contacto/contacto.php'],
]) ?>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
