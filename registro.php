<?php
include_once("includes/login_snippet.php");
include_once("modelos/inmueble_modelo.php");

$claseBody = "pag-registro";

if (!empty($_SESSION["usuario"])) header("Location: index.php");

$nombre_usuario = "";
$contrasena = "";
$contrasena2 = "";
$nombre = "";
$apellidos = "";
$email = "";
$telefono = "";
$registro_correcto = "";
$registro_erroneo = "";
$sesion2_erronea = ""; //

$mensajeValidacion = "";

if (isset($_POST["enviar_registro"])) {
  $validacion = comprobarErroresUsuario($_POST);
  if ($validacion !== false) {
    $mensajeValidacion = "<p class='alert alert-danger'>" . $validacion . "</p>";
    $nombre_usuario = isset($_POST["nombre_usuario"]) ? $_POST["nombre_usuario"] : "";
    $contrasena = isset($_POST["contrasena"]) ? $_POST["contrasena"] : "";
    $contrasena2 = isset($_POST["contrasena2"]) ? $_POST["contrasena2"] : "";
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : "";
  } else {
    unset($_POST['modificar_contrasena']);
    $resultado = guardarUsuario($_POST);
    if ($resultado == true) {
      $registro_correcto = "<p class='alert alert-info'>Usuario registrado correctamente</p>";
    } else {
      $registro_erroneo = "<p class='alert alert-danger'>Ha ocurrido un fallo al guardar el usuario.</p>";
    }
  }
}

//inicio sesión con formulario incluido en registro.php, no navBar.php
if(isset($_POST["enviar_sesion2"])) {
  $usuario = comprobarUsuario($_POST['user'], cifrarContrasena($_POST['pass']));
  if ($usuario == false) {
    $sesion2_erronea = "<p class='alert alert-danger'>El usuario o contraseña no son correctos</p>";
  } else {
    $_SESSION["usuario"] = $usuario;
    header("Location: index.php");
  }
}

ob_start();
?>

<section>
  <div class="container">
    <div class="contenido-main">
      <div class="row">
        <div class="col-md-8 col-formulario">
          <div> <!-- Texto -->
            <h1 id="titulo_registro">Regístrate</h1>
          </div>
          <?= $mensajeValidacion; ?>
          <?= $registro_correcto; ?>
          <?= $registro_erroneo; ?>
          <div id="formulario-registro">
            <form id="registro_usuario" method="POST" action="registro.php">
            <input type="hidden" name="modificar_contrasena" value=1>
              <div class="form-group">
                <label for="newuser">Nombre de usuario:</label>
                <input type="text" class="form-control" id="newuser" name="nombre_usuario" placeholder="Escriba su nombre de usuario" required="true">
              </div>
              <div class="form-group">
                <label for="pass">Contraseña</label>
                <input type="password" class="form-control" id="pass" name="contrasena" placeholder="Escriba su contraseña" required="true">
              </div>
              <div class="form-group">
                <label for="pass">Verifique su contraseña</label>
                <input type="password" class="form-control" id="passVerification" name="contrasena2" placeholder="Verifique su contraseña" required="true">
              </div>
              <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escriba su nombre" required="true">
              </div>
              <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Escriba sus apellidos" required="true">
              </div>
              <div class="form-group">
                <label for="correo">E-mail:</label>
                <input type="email" class="form-control" id="correo" name="email" placeholder="Escriba su correo" required="true">
              </div>
              <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Escriba su número" required="true">
              </div>
              <div class="form-group">
                <input type="hidden" name="enviar_registro" value="true">
                <input type="submit" id="botonRegistro" class="btn btn-primary btn-block" value="Registrarse">
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-4 hidden-xs hidden-sm" id="formulario-registro-inicio">
          <div> <!-- Texto -->
            <?=  $sesion2_erronea; ?> <!-- -->
            <h1>Inicia sesión</h1>
          </div>
          <form method="POST">
            <div class="form-group">
              <label for="user">Nombre de usuario</label>
              <input type="text" name="user" class="form-control">
            </div>
            <div class="form-group">
              <label for="pass">Contraseña</label>
              <input type="password" name="pass" class="form-control">
            </div>
            <div class="form-group">
              <input type="hidden" name="enviar_sesion2" value="true"/>
              <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </div>
          </form>
          <div>
            <p></p>
          </div>
          <div> <!-- Imagenes -->
            <img src="img/edicios_registro.jpg" id="imagen-registro" alt="edificios registro">
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?php
$contenidoPagina = ob_get_clean();
include_once("master.php");
?>
