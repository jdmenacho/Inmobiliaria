<?php
include_once("includes/login_snippet.php");
include_once("includes/functions.php");
include_once("modelos/inmueble_modelo.php");
  //conttol de acceso
  if(empty($_SESSION['usuario']) || $_SESSION['usuario']['administrador']!=1){
    header('location:index.php');
  }
$claseBody = "admin-usuarios";
$tituloPagina = "Listado de <strong>usuarios</strong>";
$limit = 10;

$count = hacerListado("SELECT COUNT(id) AS total FROM usuarios")[0]["total"];
$paginas = ceil($count / $limit);
$paginaActual = (!empty($_GET["pagina"])) ? $_GET["pagina"] : 1;
if ($paginaActual > 1) {
  $offset = (($paginaActual - 1) * $limit);
} else {
  $offset = 0;
}
$usuarios = obtenerUsuariosPorPagina($limit, $offset);

ob_start();
?>

<div class="container contenido-main">
  <div class="row">
    <div class="col-md-12 text-center">
      <h1>Lista de usuarios</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nombre Usuario</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Correo Electrónico</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          foreach ($usuarios as $usuario):
            ?>

            <tr>
              <td><?= $usuario['nombre_usuario'] ?></td>
              <td><?= $usuario['nombre'] ?></td>
              <td><?= $usuario['apellidos'] ?></td>
              <td><?= $usuario['telefono'] ?></td>
              <td><?= $usuario['email'] ?></td>
              <td>
                <a href="ver_usuario.php?id=<?=$usuario['id']?>" class="btn btn-info btn-xs">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver
                </a>
                <a href="editar_usuario.php?id=<?=$usuario['id']?>" class="btn btn-success btn-xs">
                  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar
                </a>
                <a href="eliminar_usuario.php?id=<?= $usuario['id'] ?>" class="btn btn-danger btn-xs">
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
  <div class="row">
    <?php hacerPaginacion($count, $limit); ?>
  </div>
</div>

<?php
$contenidoPagina = ob_get_clean();
include_once("master.php");
?>
