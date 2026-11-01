<?php
http_response_code(404);
$titulo = 'Página no encontrada';
$activo = '';
$pagina = '';
$raiz = '/';
$lead = 'La dirección que consultaste no existe o cambió de ubicación dentro del portal institucional.';
$descripcion = 'Página no encontrada en el portal del IESTP Manuel Arévalo Cáceres.';
$macNoIndex = true;
require __DIR__ . '/plantillas/cabecera.php';
mac_pagina_abrir();
?>
<?= mac_vacio('No encontramos el recurso solicitado', 'Comprueba que la dirección esté bien escrita o utiliza los enlaces siguientes para ir a las secciones principales del instituto.', [
    ['Ir a la página de inicio', 'index.php'],
    ['Ver documentos oficiales', 'paginas/otros/archivos-oficiales.php'],
    ['Ir a contacto', 'paginas/contacto/contacto.php'],
]) ?>
<h2>¿Qué necesitas hacer?</h2>
<ul class="lista-enlaces">
<?php foreach ($GLOBALS['MAC_PERFILES'] as $macClave => [$macEtiqueta, $macEnlaces]): ?>
  <li><span><span class="lista-enlaces-nombre"><?= mac_e($macEtiqueta) ?></span><span class="lista-enlaces-detalle"><?= mac_e(implode(', ', array_map(static fn ($e) => $e[1], array_slice($macEnlaces, 0, 3)))) ?></span></span><a class="boton boton-contorno boton-pequeno" href="<?= mac_url('index.php') ?>#perfil-<?= mac_e((string) $macClave) ?>">Ver accesos<span class="sr"> para <?= mac_e($macEtiqueta) ?></span></a></li>
<?php endforeach; ?>
</ul>
<?php mac_pagina_cerrar(); require __DIR__ . '/plantillas/pie.php'; ?>

