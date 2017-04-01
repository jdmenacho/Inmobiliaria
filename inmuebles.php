<?php
include_once("includes/login_snippet.php");
include_once('modelos/inmueble_modelo.php');

$tituloHtml = "Inmobex";
$claseBody = "pag-inmuebles";
$tituloPagina = "Inmuebles";

$limit = 12;

if(!empty($_GET["action"]) && $_GET["action"] == "buscar"){

  $criterios = [];
  foreach ($_GET as $key => $value) {
    if ($key != "action") $criterios[$key] = $value;
  }
  $criteriosSQL = generarCriteriosBusqueda($criterios);
  $count = count(hacerListado("SELECT COUNT(inm.id) FROM inmuebles inm JOIN imagenes_inmuebles img ON inm.id=img.id_inmueble GROUP BY inm.id"));
  $paginas = ceil($count / $limit);
  $paginaActual = (!empty($_GET["pagina"])) ? $_GET["pagina"] : 1;
  if ($paginaActual > 1) {
    $offset = (($paginaActual - 1) * $limit);
  } else {
    $offset = 0;
  }
  $inmuebles = obtenerInmueblesEImagenesFiltrados($offset, $limit, $criteriosSQL);
} else{
  $count = count(hacerListado("SELECT COUNT(inm.id) FROM inmuebles inm JOIN imagenes_inmuebles img ON inm.id=img.id_inmueble GROUP BY inm.id"));
  $paginas = ceil($count / $limit);
  $paginaActual = (!empty($_GET["pagina"])) ? $_GET["pagina"] : 1;
  if ($paginaActual > 1) {
    $offset = (($paginaActual - 1) * $limit);
  } else {
    $offset = 0;
  }
  $inmuebles = obtenerInmueblesEImagenes($offset, $limit);
}

ob_start();
?>

<div class="container">
  <h1 class="hidden-xs" style="margin-top:0;"><img src="img/iconos/casa_rosa.png" class="icono-titulo"/>ENCUENTRE <strong>SU INMUEBLE</strong></h1>
  <div class="col-md-12">
    <div class="contenido-main row">

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
        <div class="clearfix"></div>
      <div id="paginacion">
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li<?= ($paginaActual == 1 || $count <= 1) ? " class='disabled'" : "" ?>>
              <a href="?pagina=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
            </li>

            <?php
            if ($paginas <= 11) {
              $inicio = 1;
              $final = $paginas;
            } elseif (($paginaActual > 6) && ($paginas - $paginaActual >= 5)) {
              $inicio = $paginaActual - 5;
              $final = $paginaActual + 5;
            } elseif ($paginas - $paginaActual < 5) {
              $inicio = $paginas - 11;
              $final = $paginas;
            } elseif ($paginaActual - 5 <= 0) {
              $inicio = 1;
              $final = 11;
            }
            for ($x = $inicio; $x <= $final; $x++) {
              $active = ($x == $paginaActual) ? " class='active'" : "";
              echo "<li$active><a href='?pagina=$x'>$x</a></li>";
            }
            ?>

            <li<?= ($paginaActual == $paginas || $count <= 1) ? " class='disabled'" : "" ?>>
              <a href="?pagina=<?= $paginas ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>

<?php
$contenidoPagina = ob_get_clean();
include_once("master.php");
?>
