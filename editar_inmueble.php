<?php
include_once("includes/login_snippet.php");
include_once('modelos/inmueble_modelo.php');

$claseBody = "pag-editar-inmueble";
//control de acceso
  if(empty($_SESSION['usuario']) || ($_SESSION['usuario']['id']!=$_GET["id"] && $_SESSION['usuario']['administrador']!=1)){
    header('location:index.php');
  }

if ($_POST) {
  $mensajeError = comprobarErroresInmueble($_POST);
  if ($mensajeError == false) {
    $resultado = actualizarInmueble($_POST);
    if ($resultado == false) {
      $mensajeError = "No se ha guardado el inmueble correctamente";
    } else {
      header("Location: producto.php?id=" . $_GET["id"]);
    }
  }else{
    echo $mensajeError;
  }
}
$inmueble= obtenerInmueblePorId($_GET["id"]);
$tiposPago = obtenerTiposPago();
$provincias = obtenerProvincias();
$tiposInmueble = obtenerTiposInmueble();
$tiposVia = obtenerTiposVia();

ob_start();
?>

<div class="container contenido-main">
  <div id="formulario-publicar" class="col-md-8 col-formulario">
    <form method="POST" id="formulario-editar-inmueble" class="posicion">
      <input type="hidden" name="id" value="<?=$inmueble['id']?>">

      <h1>Datos del inmueble</h1>

      <div class="form-group col-md-12">
        <input type="text" name="titulo" class="form-control" placeholder="Titulo" value="<?=$inmueble['titulo']?>" />
      </div>
      <div class="form-group col-md-6">
        <select name="tipo_inmueble">

          <?php foreach ($tiposInmueble as $tipo):
          $selected = ($tipo["id"] == $inmueble["tipo_inmueble"]) ? "selected='selected'" : ""; ?>

          <option value="<?= $tipo["id"] ?>" <?= $selected ?>><?= $tipo["nombre"] ?></option>

          <?php endforeach; ?>

        </select>
      </div>
      <div class="form-group col-md-6">
        <input type="number" name="habitaciones" class="form-control" placeholder="Número de habitaciones" value="<?=$inmueble['habitaciones']?>"/>
      </div>
      <div class="form-group col-md-6">
        <input type="number" name="banos" class="form-control" placeholder="Número de baños" value="<?=$inmueble['banos']?>"/>
      </div>
      <div class="form-group col-md-6">
        <input type="number" name="superficie" class="form-control" placeholder="Metros cuadrados" value="<?=$inmueble['superficie']?>"/>
      </div>
      <div class="form-group col-md-3 col-sm-6">
        <select name="provincia">

          <?php foreach ($provincias as $provincia):
          $selected = ($provincia["id"] == $inmueble["provincia"]) ? "selected='selected'" : ""; ?>

          <option value="<?= $provincia["id"] ?>" <?= $selected ?>><?= $provincia["nombre"] ?></option>

          <?php endforeach; ?>

          <?php /*
          if ($inmueble["provincia"]=1){
            echo "<option value='1' selected='selected'>Badajoz</option>";
            echo  "<option value='2'>Cáceres</option>";
          } else{
            echo "<option value='1'>Badajoz</option>";
            echo  "<option value='2' selected='selected'>Cáceres</option>";
          }
          */ ?>

        </select>
      </div>
      <div class="form-group col-md-3 col-sm-6">
        <input type="text" name="localidad" class="form-control" placeholder="Localidad" value="<?=$inmueble['localidad']?>"/>
      </div>
      <div class="form-group col-md-3 col-sm-6">
        <select name="tipo_via">

          <?php foreach ($tiposVia as $tipo):
          $selected = ($tipo["id"] == $inmueble["tipo_via"]) ? "selected='selected'" : ""; ?>

          <option value="<?= $tipo["id"] ?>" <?= $selected ?>><?= $tipo["nombre"] ?></option>

          <?php endforeach; ?>

          <?php /*
          if ($inmueble["tipo_via"]=1){
            echo " <option value='1' selected='selected'>Calle</option>";
            echo  "<option value='2'>Avenida</option>";
            echo  "<option value='3'>Plaza</option>";
          } elseif ($inmueble["tipo_via"]=2) {
            echo " <option value='1' >Calle</option>";
            echo  "<option value='2' selected='selected'>Avenida</option>";
            echo  "<option value='3'>Plaza</option>";
          }else{
            echo " <option value='1' >Calle</option>";
            echo  "<option value='2' >Avenida</option>";
            echo  "<option value='3' selected='selected'>Plaza</option>";
          }
          */ ?>

        </select>
      </div>
      <div class="form-group col-md-3 col-sm-6">
        <input type="text" name="nombre_via" class="form-control" placeholder="Nombre de la via" value="<?=$inmueble['nombre_via']?>"/>
      </div>
      <div class="form-group col-md-3 col-sm-6">
        <input type="number" name="numero_via" class="form-control" placeholder="Número" value="<?=$inmueble['numero_via']?>"/>
      </div>
      <div class="form-group col-md-3 col-sm-6">
        <input type="number" name="piso" class="form-control" placeholder="Piso" value="<?=$inmueble['piso']?>"/>
      </div>
      <div class="form-group col-md-3 col-sm-6">
        <input type="text" name="letra" class="form-control" placeholder="Letra" value="<?=$inmueble['letra']?>"/>
      </div>
      <div class="form-group col-md-3">
        <input type="text" name="codigo" class="form-control" placeholder="Código Postal" value="<?=$inmueble['codigo']?>"/>
      </div>
      <div class="form-group col-md-6">
        <input type="number" step="any" name="precio" placeholder="Precio" value="<?=$inmueble['precio']?>"/>
      </div>
      <div class="form-group col-md-6">
        <select name="tipo_pago">

          <?php foreach ($tiposPago as $tipo):
          $selected = ($tipo["id"] == $inmueble["tipo_pago"]) ? "selected='selected'" : ""; ?>

          <option value="<?= $tipo["id"] ?>" <?= $selected ?>><?= $tipo["nombre"] ?></option>

          <?php endforeach; ?>

          <?php /*
          echo   "<option value='1' " . ($inmueble['tipo_pago'] == 1  ? "selected='selected'" : "") . ">Venta</option>";
          echo   "<option value='2' " . ($inmueble['tipo_pago'] == 2  ? "selected='selected'" : "") . ">Mensual</option>";
          echo   "<option value='3' " . ($inmueble['tipo_pago'] == 3  ? "selected='selected'" : "") . ">Trimestral</option>";
          echo   "<option value='4' " . ($inmueble['tipo_pago'] == 4  ? "selected='selected'" : "") . ">Anual</option>";
          */ ?>

        </select>
      </div>
      <div class="clearfix"></div>
      <div class="checkbox-well">
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="checkbox">

            <?php
            echo   "<label><input type='checkbox' name='amueblado' value='1' ". ($inmueble['amueblado'] == 1  ? "checked='checked'" : "") . ">Amueblado</label>";
            ?>

          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="checkbox">

            <?php
            echo   "<label><input type='checkbox' name='trastero' value='1' ". ($inmueble['trastero'] == 1  ? "checked='checked'" : "") . ">Trastero</label>";
            ?>

          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="checkbox">

            <?php
            echo   "<label><input type='checkbox' name='aire_acondicionado' value='1' ". ($inmueble['aire_acondicionado'] == 1  ? "checked='checked'" : "") . ">AA</label>";
            ?>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="checkbox">

            <?php
            echo   "<label><input type='checkbox' name='piscina' value='1' ". ($inmueble['piscina'] == 1  ? "checked='checked'" : "") . ">Piscina</label>";
            ?>

          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="checkbox">

            <?php
            echo   "<label><input type='checkbox' name='ascensor' value='1' ". ($inmueble['ascensor'] == 1  ? "checked='checked'" : "") . ">Ascensor</label>";
            ?>

          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="checkbox">

            <?php
            echo   "<label><input type='checkbox' name='garaje' value='1' ". ($inmueble['garaje'] == 1  ? "checked='checked'" : "") . ">Garaje</label>";
            ?>

          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="checkbox">

            <?php
            echo   "<label><input type='checkbox' name='terraza' value='1' ". ($inmueble['terraza'] == 1  ? "checked='checked'" : "") . ">Terraza/Balcón</label>";
            ?>

          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="checkbox">

            <?php
            echo   "<label><input type='checkbox' name='calefaccion' value='1' ". ($inmueble['calefaccion'] == 1  ? "checked='checked'" : "") . ">Calefacción</label>";
            ?>

          </div>
        </div>

        <div class="clearfix"></div>
      </div>

      <div class="form-group col-md-12">
        <textarea name="descripcion" placeholder="Descripción del inmueble" rows="3" id="desc-inm"> <?=$inmueble['descripcion']?></textarea>
      </div>
      <div class="col-sm-12">
        <input type="submit" value="Guardar" class="btn btn-primary"/>
      </div>
    </form>
  </div>
  <div class="col-md-4 hidden-xs hidden-sm" id="imagen-publicar">
    <img src="img/formulario_publicar.png">
  </div>
</div>

<?php
$contenidoPagina = ob_get_clean();
include_once("master.php");
?>
