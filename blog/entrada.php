<?php
$id = (!empty($_GET["id"])) ? $_GET["id"] : "";
$entrada = obtenerEntradaBlogPorId($id);
$tituloHtml = $entrada["titulo"] . " - Inmobex";
$claseBody = "pag-entrada-blog";
?>

<div class="row">
  <div class="col-md-12">
    <img src="img/posts/<?= (!empty($entrada["imagen"])) ? $entrada["id"] . "/" . $entrada["imagen"] : "default.png" ?>" class="imagen-entrada-lista" alt="imagen"/>
    <h3 class="titulo-entrada-lista"><?= $entrada["titulo"] ?></h3>
    <p><small><?= $entrada["creado"] ?> por Usuario</small></p>
    <p><?= $entrada["contenido"] ?></p>
    <div class="acciones-entrada-blog">
      <a href="#" class="acciones-entrada-editar"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
      <a href="#" class="acciones-entrada-eliminar"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>
    </div>
  </div>
</div>
