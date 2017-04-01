<?php
include_once("includes/login_snippet.php");
include_once('modelos/inmueble_modelo.php');
  //conttol de acceso
  if(empty($_SESSION['usuario']) || $_SESSION['usuario']['administrador']!=1){
    header('location:index.php');
  }

$inmuebles = obtenerTodosLosInmuebles();
$claseBody = "admin-inmuebles";
$tituloPagina = "Listado de <strong>inmuebles</strong>";

ob_start();
?>

<div class="container contenido-main">
  <div class="row">
    <div class="col-md-12">
      <!-- INMUEBLES -->
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Foto</th>
            <th>Título</th>
            <th>Dirección</th>
            <th>Fecha publicación</th>
          </tr>
        </thead>
        <tbody>

          <?php
          foreach ($inmuebles as $inmueble):
            $imagen = obtenerImagenesPorIdInmueble($inmueble["id"])[0]["nombre"];
            ?>

            <tr>
              <td><img src="img/inmuebles/<?= $inmueble['id'] ?>/<?= $imagen ?>" class="img-admin-inmuebles"></td>
              <td><?= $inmueble['titulo'] ?></td>
              <td><?= $inmueble['tipo_via']." ".$inmueble['nombre_via']." ".$inmueble['numero_via']." ".$inmueble['piso']." ".$inmueble['letra']?></td>
              <td>
                <a href="producto.php?id=<?=$inmueble['id']?>" class="btn btn-info btn-xs">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver
                </a>
                <a href="editar_inmueble.php?id=<?=$inmueble['id']?>" class="btn btn-success btn-xs">
                  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar
                </a>
                <a href="eliminar_inmueble.php?id=<?= $inmueble['id'] ?>" class="btn btn-danger btn-xs">
                  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar
                </a>
              </td>
            </tr>

            <?php
          endforeach;
          ?>

        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
$contenidoPagina = ob_get_clean();
include_once("master.php");
?>
