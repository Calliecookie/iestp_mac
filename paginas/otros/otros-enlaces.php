<?php
$titulo = 'Enlaces institucionales';
$activo = 'servicios';
$pagina = 'enlaces';
$raiz = '../../';
$lead = 'Portales públicos y servicios institucionales externos.';
$descripcion = 'Enlaces a portales públicos y servicios del IESTP Manuel Arévalo Cáceres.';
require dirname(__DIR__, 2) . '/plantillas/cabecera.php';
mac_pagina_abrir();
$enlaces = [
    ['Ministerio de Educación', 'Portal oficial del Gobierno del Perú', mac_dato('minedu')],
    ['Dirección Regional de Educación de Lima Metropolitana', 'Portal institucional de la DRELM', mac_dato('drelm')],
    ['Plataforma académica', 'Servicio externo del instituto; verifica el dominio antes de ingresar credenciales', mac_dato('intranet')],
    ['Biblioteca virtual Digitalia', 'Plataforma de libros electrónicos', mac_dato('digitalia')],
];
?>
<ul class="lista-enlaces">
<?php foreach ($enlaces as [$nombre, $detalle, $url]): ?>
  <li><span><span class="lista-enlaces-nombre"><?= mac_e($nombre) ?></span><span class="lista-enlaces-detalle"><?= mac_e($detalle) ?></span></span><a class="boton boton-contorno boton-pequeno" href="<?= mac_e($url) ?>" target="_blank" rel="noopener noreferrer">Abrir<span class="sr"> <?= mac_e($nombre) ?></span><?= mac_externo() ?></a></li>
<?php endforeach; ?>
</ul>
<?php mac_pagina_cerrar(); require dirname(__DIR__, 2) . '/plantillas/pie.php'; ?>
