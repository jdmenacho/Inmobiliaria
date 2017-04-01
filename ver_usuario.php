<?php
include_once("includes/login_snippet.php");
include_once('modelos/inmueble_modelo.php');
include_once('modelos/usuarios_modelo.php');
//control de acceso
  if(empty($_SESSION['usuario']) || ($_SESSION['usuario']['id']!=$_GET["id"] && $_SESSION['usuario']['administrador']!=1)){
    header('location:index.php');
  }
$usuario = obtenerUsuarioPorId($_GET["id"]);
$inmuebles = obtenerInmueblesPorIdUsuario($_GET["id"]);

ob_start();
?>

<div class="container contenido-main">
  <div class="row ver_usuario">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
      <h3 class="titulo_usuario"><strong>DATOS DEL USUARIO</strong></h3>
      <img src="img/default_user.jpg" class="img-responsive foto_usuario">
      <ul>
        <li>Nombre: <?= $usuario["nombre"] ?></li>
        <li>Apellidos: <?= $usuario["apellidos"] ?></li>
        <li>Nombre de usuario: <?=$usuario["nombre_usuario"]?></li>
        <li>Teléfono: <?= $usuario["telefono"] ?></li>
        <li>Correo electrónico: <?= $usuario["email"] ?></li>
      </ul>
    </div>

    <div class="col-md-3"></div>

    <div class="col-md-12">
      <h3 class="datos_usuario"><strong>INMUEBLES</strong></h3>
    </div>

    <?php if (empty($inmuebles)): ?>

    <div class='col-md-12'><h1 class='titulo_usuario'>Este usuario no tiene ningún inmueble</h1></div>

    <?php else:
      foreach ($inmuebles as $inmueble):
        $imagen = obtenerImagenesPorIdInmueble($inmueble["id"])[0]["nombre"];
        ?>

    <div class="col-md-6">
      <table class="tabla_inmuebles">
        <thead>
          <tr>
            <th>FOTO</th>
            <th>TÍTULO</th>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><a href="producto.php?id=<?=$inmueble['id']?>" target = "_blank"><img src="img/inmuebles/<?= $inmueble['id'] ?>/<?= $imagen ?>" class="foto_casa"></td>
            <td><a class="titulo" href="producto.php?id=<?=$inmueble['id']?>"><?= $inmueble['titulo'] ?></a></td>
            </tr>
          </tbody>
        </table>
      </div>

      <?php endforeach; ?>
    <?php endif; ?>

  </div>
</div>

<?php
$contenidoPagina = ob_get_clean();
include_once("master.php");
?>
