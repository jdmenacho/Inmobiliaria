<?php
include_once("includes/login_snippet.php");
include_once("modelos/inmueble_modelo.php");
include_once('modelos/usuarios_modelo.php');
//control de acceso
  if(empty($_SESSION['usuario']) || ($_SESSION['usuario']['id']!=$_GET["id"] && $_SESSION['usuario']['administrador']!=1)){
    header('location:index.php');
  }
$claseBody = "pag-editar-inmueble";
$tituloPagina = "Editar Usuario";
$scriptsPagina="defer <script src='js/cambiar_contrasena.js'></script>";

if ($_POST) {
  $mensajeError = comprobarErroresUsuario($_POST);
  if ($mensajeError == false) {
    if($_POST['modificar_contrasena']==1){
       unset($_POST["contrasena2"]);
        }
        unset($_POST['modificar_contrasena']);
    $resultado = editarUsuario($_POST, "usuarios");
    if ($resultado == false) {
      $mensajeError = "No se ha guardado el usuario correctamente";
    } else {
      header("Location:ver_usuario.php?id=".$_GET['id']);
    }
  }else{
    echo $mensajeError;
  }
}
if(!empty($_GET["id"])){
$usuario = obtenerUsuarioPorId($_GET["id"]);
  }
  else{
    $usuario=false;
  }

//<div class='col-md-12'><h1 class='titulo_usuario'>Este usuario no tiene ningún inmueble</h1></div>
ob_start();
?>

<section>
  <div class="container contenido-main">
  <?php if($usuario!=false || !empty($_GET["id"])):?>
    <div class="row">
      <div class="col-md-8 col-formulario">
        <div id="formulario-editar-usuario">
          <form method="POST" >
            <input type="hidden" name="id" value="<?=$usuario["id"] ?>">
            <div class="form-group">
              <label for="nombre_usuario">Nombre de usuario:</label>
              <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" placeholder="Escriba su nombre de usuario" required="true" value="<?=$usuario["nombre_usuario"] ?>">
            </div>
            <div class="form-group">
              <label for="modificar_contrasena">Modificar contraseña: </label>
              <div class="radio">
                 <label><input type="radio" name="modificar_contrasena" value=1 id="opcionsi">SI</label>
              </div>
            <div class="radio">
               <label><input type="radio" name="modificar_contrasena" checked="checked" value=0 id="opcionno">NO</label>
          </div>
            </div>
            <div class="form-group" id="divContrasena">
                <!--aqui va el campo de contraseña que entra por javascript-->
            </div>
            <div class="form-group" id="divVerificacionContrasena">
            </div>
            <div class="form-group">
              <label for="nombre">Nombre:</label>
              <input type="text"  class="form-control" name="nombre" id="nombre" placeholder="Escriba su nombre" required="true" value="<?=$usuario["nombre"] ?>">
            </div>
            <div class="form-group">
              <label for="apellidos">Apellidos:</label>
              <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Escriba sus apellidos" required="true" value="<?=$usuario["apellidos"] ?>">
            </div>
            <div class="form-group">
              <label for="telefono">Teléfono:</label>
              <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Escriba su teléfono" required="true" value="<?=$usuario["telefono"] ?>">
            </div>
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Escriba su correo" required="true" value="<?=$usuario["email"] ?>">
            </div>
            <div class="form-group">
              <input type="submit" id="botonRegistro" class="btn btn-primary btn-block" value="Actualizar">
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-4 hidden-xs hidden-sm">
        <img src="img/logos/logo_horizontal.png" id="logo-registro"/>
        <img src="img/edicios_registro.jpg" id="imagen-registro" alt="edificios registro">
      </div>
         <?php else:?>
          <div class='col-md-12'>
          <h2 class='titulo_usuario'>Error de acceso a los datos de usuario</h2>
          </div>
        <?php endif;?>
    </div>
  </section>

  <?php
  $contenidoPagina = ob_get_clean();
  include_once("master.php");
  ?>
