<?php
include_once("includes/login_snippet.php");
include_once('modelos/inmueble_modelo.php');

$tituloHtml = "Inmobex";
$claseBody = "pag-producto";

$id = $_GET["id"];
$inmueble = obtenerInmueblePorIdJoin($id);
$imagenesInmueble = obtenerImagenesPorIdInmueble($id);

$tituloPagina = "<strong>" . $inmueble["titulo"] . "</strong>";

ob_start();

?>

<div class="container contenido-main">

  <div class="row">
    <div class="col-md-12">
      <button type="button" class="btn btn-primary btn-block"><strong>Contactar propietario</strong></button>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="titulo-descripcion-producto">
        <h3><strong>INFORMACION</strong></h3>
      </div>
      <div class="precio-producto">
        <h2><strong><?= $inmueble["precio"] ?></strong> €</h2>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-5">
      <table class="table table-condensed table-hover">
        <tr>
          <th>Tipo:</th>
          <td class="text-right"><?= $inmueble["tipo_inmueble"] ?></td>
        </tr>
        <tr>
          <th>Operación:</th>
          <td class="text-right"><?= $inmueble["tipo_pago"] ?></td>
        </tr>
        <tr>
          <th>Superficie:</th>
          <td class="text-right"><?= $inmueble["superficie"] ?> m2</td>
        </tr>
        <tr>
          <th>Provincia:</th>
          <td class="text-right" id="provincia-inmueble"><?= $inmueble["provincia"] ?></td>
        </tr>
        <tr>
          <th>Localidad:</th>
          <td class="text-right" id="localidad-inmueble"><?= $inmueble["localidad"] ?></td>
        </tr>
        <tr>
          <th>Dirección:</th>
          <td class="text-right" id="direccion-inmueble"><?= $inmueble["tipo_via"] . ' ' . $inmueble["nombre_via"] . ' ' . $inmueble["numero_via"] . ' ' . $inmueble["piso"] . strtoupper($inmueble["letra"]) ?></td>
        </tr>
        <tr>
          <th>Habitaciones:</th>
          <td class="text-right"><?= $inmueble["habitaciones"] ?></td>
        </tr>
        <tr>
          <th>Baños:</th>
          <td class="text-right"><?= ($inmueble["banos"] > 0) ? $inmueble["banos"] : "Ninguno" ?></td>
        </tr>
      </table>
    </div>
    <div class="col-md-2">
      <table class="table table-condensed table-hover">
        <tr>
          <th>Garaje:</th>
          <td class="text-right"><?= ($inmueble["garaje"] == 0) ? "No" : "Sí" ?></td>
        </tr>
        <tr>
          <th>Trastero:</th>
          <td class="text-right"><?= ($inmueble["trastero"] == 0) ? "No" : "Sí" ?></td>
        </tr>
        <tr>
          <th>Amueblado:</th>
          <td class="text-right"><?= ($inmueble["amueblado"] == 0) ? "No" : "Sí" ?></td>
        </tr>
        <tr>
          <th>Ascensor:</th>
          <td class="text-right"><?= ($inmueble["ascensor"] == 0) ? "No" : "Sí" ?></td>
        </tr>
        <tr>
          <th>A/A:</th>
          <td class="text-right"><?= ($inmueble["aire_acondicionado"] == 0) ? "No" : "Sí" ?></td>
        </tr>
        <tr>
          <th>Calefacción:</th>
          <td class="text-right"><?= ($inmueble["calefaccion"] == 0) ? "No" : "Sí" ?></td>
        </tr>
        <tr>
          <th>Terraza:</th>
          <td class="text-right"><?= ($inmueble["terraza"] == 0) ? "No" : "Sí" ?></td>
        </tr>
        <tr>
          <th>Piscina:</th>
          <td class="text-right"><?= ($inmueble["piscina"] == 0) ? "No" : "Sí" ?></td>
        </tr>
      </table>
      </div>

    <div class="col-md-5">
      <div id="slider-producto">
        <div class="row carousel-holder">
          <div class="col-md-12">
            <div id="carousel-producto" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <?php
                foreach ($imagenesInmueble as $indice => $imagen) {
                  $active = ($indice == 0) ? "active" : "";
                  echo "<li data-target='#carousel-producto' data-slide-to='$indice' class='$active'></li>";
                }
                ?>
              </ol>
              <div class="carousel-inner contenedor">

                <?php
                foreach ($imagenesInmueble as $indice => $imagen):
                  $active = ($indice == 0) ? "active" : "";
                  ?>

                  <div class="item <?= $active ?>">
                    <img class="slide-image" src="img/inmuebles/<?=$id?>/<?=$imagen['nombre']?>" alt="<?=$imagen['nombre']?>">
                  </div>

                  <?php
                endforeach;
                ?>

                <a class="left carousel-control" href="#carousel-producto" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-producto" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="">
        <h3><strong>DESCRIPCION</strong></h3>
        <div class="descripcion-producto">
          <p><?= $inmueble["descripcion"] ?></p>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="col-md-6">
      <h3><strong>UBICACION</strong></h3>
      <!--<a target="_blank" href="https://www.google.es/maps/place/Ronda+Pilar,+20,+06002+Badajoz/@38.8760469,-6.9698058,17z/data=!3m1!4b1!4m5!3m4!1s0xd16e43249c3b8d3:0x325e98a0ff9ff393!8m2!3d38.8760469!4d-6.9676118?hl=es"><img src="img/mapa.png" alt="mapa" style="max-width: 100%"></a>-->
      <div id="mapa-inmueble"></div>
    </div>
  </div>
  <br>

</div>

<!--<div class="container contenido-main">
  <div class="titulo-descripcion-producto">
    <h3><strong>DESCRIPCION</strong></h3>
  </div>
  <div class="precio-producto">
    <h2><strong><?= $inmueble["precio"] ?></strong> €</h2>
  </div>

  <div class="clearfix"></div>

  <header id="cabecera-producto">
    <div class="descripcion-producto">
      <p><?= $inmueble["descripcion"] ?></p>
    </div>
    <div id="slider-producto">
      <div class="row carousel-holder">
        <div class="col-md-12">
          <div id="carousel-producto" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <?php
              foreach ($imagenesInmueble as $indice => $imagen) {
                $active = ($indice == 0) ? "active" : "";
                echo "<li data-target='#carousel-producto' data-slide-to='$indice' class='$active'></li>";
              }
              ?>
            </ol>
            <div class="carousel-inner contenedor">

              <?php
              foreach ($imagenesInmueble as $indice => $imagen):
                $active = ($indice == 0) ? "active" : "";
                ?>

                <div class="item <?= $active ?>">
                  <img class="slide-image" src="img/inmuebles/<?=$id?>/<?=$imagen['nombre']?>" alt="<?=$imagen['nombre']?>">
                </div>

                <?php
              endforeach;
              ?>

              <a class="left carousel-control" href="#carousel-producto" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
              </a>
              <a class="right carousel-control" href="#carousel-producto" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="clearfix"></div>

  <hr/>

  <div>
    <div class="caracteristicas-producto col-md-6">
      <h3><strong>CARACTERISTICAS</strong></h3>
      <ul>
        <li>Tipo de inmueble: <?= $inmueble["tipo_inmueble"] ?></li>
        <li>Tipo de operación: <?= $inmueble["tipo_pago"] ?></li>
        <li>Metros cuadrados: <?= $inmueble["superficie"] ?> m2</li>
        <li>Provincia: <?= $inmueble["provincia"] ?></li>
        <li>Localidad: <?= $inmueble["localidad"] ?></li>
        <li>Dirección: <?= $inmueble["tipo_via"] . ' ' . $inmueble["nombre_via"] . ' ' . $inmueble["numero_via"] . ' ' . $inmueble["piso"] . $inmueble["letra"] ?></li>
        <li>Habitaciones: <?= $inmueble["habitaciones"] ?></li>
        <li>Baños: <?= ($inmueble["banos"] > 0) ? $inmueble["banos"] : "Ninguno" ?></li>
        <li>Garaje: <?= ($inmueble["garaje"] == 0) ? "No" : "Sí" ?></li>
        <li>Trastero: <?= ($inmueble["trastero"] == 0) ? "No" : "Sí" ?></li>
        <li>Amueblado: <?= ($inmueble["amueblado"] == 0) ? "No" : "Sí" ?></li>
        <li>Ascensor: <?= ($inmueble["ascensor"] == 0) ? "No" : "Sí" ?></li>
        <li>Aire acondicionado: <?= ($inmueble["aire_acondicionado"] == 0) ? "No" : "Sí" ?></li>
        <li>Calefacción: <?= ($inmueble["calefaccion"] == 0) ? "No" : "Sí" ?></li>
        <li>Terraza: <?= ($inmueble["terraza"] == 0) ? "No" : "Sí" ?></li>
        <li>Piscina: <?= ($inmueble["piscina"] == 0) ? "No" : "Sí" ?></li>
      </ul>
    </div>
    <div class="ubicacion-producto ol-md-6">
      <h3><strong>UBICACION</strong></h3>
      <a target="_blank" href="https://www.google.es/maps/place/Ronda+Pilar,+20,+06002+Badajoz/@38.8760469,-6.9698058,17z/data=!3m1!4b1!4m5!3m4!1s0xd16e43249c3b8d3:0x325e98a0ff9ff393!8m2!3d38.8760469!4d-6.9676118?hl=es"><img src="img/mapa.png" alt="mapa"></a>
    </div>
  </div>

  <hr/>

  <div class="boton-producto">
    <a id="Reservar" class="btn btn-info" target="_blank" href="#">Reservar</a>
  </div>
</div> -->

<?php
$contenidoPagina = ob_get_clean();
include_once("master.php");
?>
