<?php
include_once("includes/functions.php");

$entradasPorPagina = 2;
$pagina = (!empty($_GET["pagina"])) ? $_GET["pagina"] : "";
$offset = ($pagina > 1) ? (($pagina - 1) * $entradasPorPagina) : 0;
$entradasBlog = obtenerEntradasBlog("creado", "DESC", $offset, $entradasPorPagina);
$count = obtenerNumeroRegistros("posts");
?>

<div id="lista-entradas-blog">

  <?php foreach ($entradasBlog as $entrada):
    $rutaImg = "img/posts/" . $entrada["id"] . "/" . $entrada["imagen"];
    if (empty($entrada["imagen"]) || !file_exists($rutaImg)) $rutaImg = "img/posts/default.png";
  ?>

  <div class="row">
    <div class="col-md-12">
      <a href="blog.php?accion=ver&id=<?= $entrada["id"] ?>">
        <img src="<?= $rutaImg ?>" class="imagen-entrada-lista" alt="imagen"/>
      </a>
      <a href="blog.php?accion=ver&id=<?= $entrada["id"] ?>">
        <h3 class="titulo-entrada-lista"><?= $entrada["titulo"] ?></h3>
      </a>
      <p><small><?= date("j/n/Y H:i", strtotime($entrada["creado"])) ?> por Usuario</small></p>
      <p><?= nl2br(substr($entrada["contenido"], 0, 2000)) ?></p>
    </div>
  </div>
  <div class="acciones-entrada-blog">
    <a href="#" class="acciones-entrada-editar"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
    <a href="blog.php?accion=borrar&id=<?= $entrada["id"] ?>" class="acciones-entrada-eliminar"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>
  </div>
  <div class="clearfix"></div>
  <hr/>

  <?php
  endforeach;

  hacerPaginacion($count, $entradasPorPagina); // functions.php
  ?>

</div>
