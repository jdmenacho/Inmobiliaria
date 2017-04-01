<?php
include_once("includes/login_snippet.php");
include_once('modelos/inmueble_modelo.php');

$tituloHtml = "Inmobex";
$claseBody = "pag-publicar";
$tituloPagina = "Publique su <strong>inmueble</strong>";

if ($_POST) {
  $mensajeError = comprobarErroresInmueble($_POST,$_FILES);
  if ($mensajeError == false) {
    $resultado = guardarInmueble($_POST);
    if ($resultado == false) {
      $mensajeError = "No se ha guardado el inmueble correctamente";
    } else {
      $ultimoInmueble=obtenerUltimoInmueble();
      $ruta = "img/inmuebles/" . $ultimoInmueble["id"] . "/";
      foreach ($_FILES as $file) {
        $ruta_archivo = $ruta . basename($file["name"]);
        if (!is_dir($ruta)) {
          mkdir($ruta);
        }
        move_uploaded_file($file["tmp_name"], $ruta_archivo);
      }
      foreach ($_FILES as $file) {
        if ($file["name"]!="") {
          consultaInsertarImagen($file["name"],$ultimoInmueble["id"],"imagenes_inmuebles");
        }
      }
      header("Location: producto.php?id=" . $ultimoInmueble["id"]);
    }
  } else {
    echo $mensajeError;
  }
}

$tiposInmueble = obtenerTiposInmueble();
$provincias = obtenerProvincias();
$tiposPago = obtenerTiposPago();
$tiposVia = obtenerTiposVia();

ob_start();

?>

<div class="container">
  <div class="contenido-main">
    <div id="div-formulario-publicar" class="col-md-8 col-formulario">
      <form method="POST" id="formulario-publicar" enctype="multipart/form-data">
        <div class="row">
          <div class="form-group col-md-12">
            <input type="text" name="titulo" class="form-control" placeholder="Titulo"/>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <select name="tipo_inmueble">

              <?php foreach ($tiposInmueble as $tipo): ?>

              <option value="<?= $tipo["id"] ?>"><?= $tipo["nombre"] ?></option>

              <?php endforeach; ?>

            </select>
          </div>
          <div class="form-group col-md-6">
            <input type="number" name="habitaciones" class="form-control" placeholder="Número de habitaciones"/>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <input type="number" name="banos" class="form-control" placeholder="Número de baños"/>
          </div>
          <div class="form-group col-md-6">
            <input type="number" name="superficie" class="form-control" placeholder="Metros cuadrados"/>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3 col-sm-6">
            <select name="provincia">

              <?php foreach ($provincias as $provincia): ?>

              <option value="<?= $provincia["id"] ?>"><?= $provincia["nombre"] ?></option>

              <?php endforeach; ?>

            </select>
          </div>
          <div class="form-group col-md-3 col-sm-6">
            <input type="text" name="localidad" class="form-control" placeholder="Localidad"/>
          </div>
          <div class="form-group col-md-3 col-sm-6">
            <select name="tipo_via">

              <?php foreach ($tiposVia as $tipo): ?>

              <option value="<?= $tipo["id"] ?>"><?= $tipo["nombre"] ?></option>

              <?php endforeach; ?>

            </select>
          </div>
          <div class="form-group col-md-3 col-sm-6">
            <input type="text" name="nombre_via" class="form-control" placeholder="Nombre de la via"/>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-3 col-sm-6">
            <input type="number" name="numero_via" class="form-control" placeholder="Número"/>
          </div>
          <div class="form-group col-md-3 col-sm-6">
            <input type="number" name="piso" class="form-control" placeholder="Piso"/>
          </div>
          <div class="form-group col-md-3 col-sm-6">
            <input type="text" name="letra" class="form-control" placeholder="Letra"/>
          </div>
          <div class="form-group col-md-3 col-sm-6">
            <input type="number" name="codigo" class="form-control" placeholder="Código Postal"/>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <input type="number" step="any" name="precio" placeholder="Precio"/>
          </div>
          <div class="form-group col-md-6">
            <select name="tipo_pago">

              <?php foreach ($tiposPago as $tipo): ?>

              <option value="<?= $tipo["id"] ?>"><?= $tipo["nombre"] ?></option>

              <?php endforeach; ?>

            </select>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div id="extras-publicar">
            <div class="col-md-3 col-sm-6 col-xs-6">
              <div class="checkbox">
                <label><input type="checkbox" name="amueblado" value="1"/>Amueblado</label>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
              <div class="checkbox">
                <label><input type="checkbox" name="trastero" value="1"/>Trastero</label>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
              <div class="checkbox">
                <label><input type="checkbox" name="aire_acondicionado" value="1"/>AA</label>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
              <div class="checkbox">
                <label><input type="checkbox" name="piscina" value="1"/>Piscina</label>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
              <div class="checkbox">
                <label><input type="checkbox" name="ascensor" value="1"/>Ascensor</label>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
              <div class="checkbox">
                <label><input type="checkbox" name="garaje" value="1"/>Garaje</label>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
              <div class="checkbox">
                <label><input type="checkbox" name="terraza" value="1"/>Terraza/Balcón</label>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
              <div class="checkbox">
                <label><input type="checkbox" name="calefaccion" value="1"/>Calefacción</label>
              </div>
            </div>

            <div class="clearfix"></div>

          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <textarea name="descripcion" placeholder="Descripción del inmueble" rows="3" id="descripcion-publicar"></textarea>
          </div>
        </div>
        <div class="row">
          <div id="imagenes-publicar" class="form-group">
            <div class="col-md-6">
              <input type="file" name="imagen1">
            </div>
            <div class="col-md-6">
              <input type="file" name="imagen2">
            </div>
            <div class="col-md-6">
              <input type="file" name="imagen3">
            </div>
            <div class="col-md-6">
              <input type="file" name="imagen4">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <input type="submit" value="Enviar" class="btn btn-primary"/>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-4 hidden-xs hidden-sm" id="logo-publicar">
      <img src="img/formulario_publicar.png">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<?php
$contenidoPagina = ob_get_clean();
include_once("master.php");
?>
