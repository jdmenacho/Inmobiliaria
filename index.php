<?php
include_once("includes/login_snippet.php");
include_once('modelos/inmueble_modelo.php');
include_once("modelos/posts_modelo.php");

$tituloHtml = "Inmobex";
$claseBody = "pag-inicio";
$tituloPagina = "Encuentra tu <strong>hogar</strong>";

$inmuebles = obtenerInmueblesDestacadosEImagenes(8);
$entradasBlog = obtenerEntradasBlog("creado", "DESC", 0, 4);

ob_start();
?>

<div class="container">
  <h1 class="hidden-xs" style="margin-top:0;"><img src="img/iconos/casa_rosa.png" class="icono-titulo"/>INMUEBLES <strong>DESTACADOS</strong></h1>
  <div class="col-md-12">
    <!-- INMUEBLES -->
    <div class="contenido-main row" id="inmuebles-destacados">

      <?php
      foreach ($inmuebles as $inmueble):
        ?>

        <div class="resumen-inmueble col-sm-3 col-lg-3 col-md-3" style="margin-bottom: 20px;">
          <div class="precio-resumen-inmueble"><h4><?= $inmueble["precio"] ?> €</h4></div>
          <div class="imagen-resumen-inmueble thumbnail">
            <a href="producto.php?id=<?= $inmueble['id'] ?>"> <img src="img/inmuebles/<?= $inmueble['id'] ?>/<?= $inmueble['nombre'] ?>" alt="imagen"></a>
          </div>
          <div>
            <h4 class="titulo-resumen-inmueble"><a href="producto.php?id=<?= $inmueble['id'] ?>"> <?= $inmueble["titulo"] ?></a>
            </h4>
            <!-- <p><?= substr($inmueble["descripcion"], 0, 300) ?></p> -->
            <ul class="list-group">
              <li>Tipo: <strong><?= $inmueble["tipo_inmueble"] ?></strong></li>
              <li>Operación: <strong><?= ($inmueble["tipo_pago"] == "Venta") ? "Venta" : "Alquiler" ?></strong></li>
              <li>Localidad: <strong><?= $inmueble["localidad"] ?></strong></li>
              <li>Superficie: <strong><?= $inmueble["superficie"] ?> m2</strong></li>
            </ul>
          </div>
        </div>

        <?php
      endforeach;
      ?>

    </div>
  </div>
  <!-- /INMUEBLES -->
  <!-- ENTRADAS BLOG -->
  <h1><img src="img/iconos/icono_blog.png" class="icono-titulo"/>ENTRADAS DEL <strong>BLOG</strong></h1>
  <div class="col-md-12">
    <div class="contenido-main row hidden-xs" id="entradas-blog">
      <div class="row">

        <?php foreach ($entradasBlog as $entrada):
          $rutaImg = "img/posts/" . $entrada["id"] . "/" . $entrada["imagen"];
          if (empty($entrada["imagen"]) || !file_exists($rutaImg)) $rutaImg = "img/posts/default.png"; ?>

        <div class="entrada-blog col-md-3">
          <a href="#"><img src="<?= $rutaImg ?>" class="imagen-entrada-blog" alt="imagen"/></a>
          <a href="#"><h3 class="titulo-entrada-blog"><?= $entrada["titulo"] ?></h3></a>
          <p><small><?= $entrada["creado"] ?></small></p>
        </div>

        <?php endforeach; ?>

      </div>
    </div>
  </div>
    <!-- ENTRADAS BLOG -->
  <div class="clearfix"></div>
</div>

<?php
$contenidoPagina = ob_get_clean();
include_once("master.php");
?>
