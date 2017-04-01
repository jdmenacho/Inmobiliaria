<?php
include_once("includes/login_snippet.php");
include_once("modelos/inmueble_modelo.php");

$tituloHtml = "Inmobex";
$claseBody = "pag-contacto";
$tituloPagina = "Contacto";

ob_start();
?>

<div class="container">
  <div class="contenido-main">
    <div class="col-md-8 col-formulario">
      <div id="formulario-contacto">
        <form action="">
          <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" placeholder="Escriba su nombre y apellidos" required="true">
          </div>
          <div class="form-group">
            <label for="correo" >E-mail:</label>
            <input type="email" class="form-control" id="correo" placeholder="Escriba su correo" required="true">
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="tel" class="form-control" name="telefono" placeholder="Introduzca su teléfono">
          </div>
          <div class="form-group">
            <label for="departamento">Departamento</label>
            <select name="departamento" id="departamento" class="form-control">
              <option value="1">Atención al cliente</option>
              <option value="2">Post-venta</option>
              <option value="3">Recursos humanos</option>
            </select>
          </div>
          <div class="form-group">
            <label for="comentario">Mensaje</label>
            <textarea class="form-control" id="comentario" placeholder="Escriba su mensaje"></textarea>
          </div>
          <input type="submit" class="btn btn-primary btn-block" value="Enviar">
        </form>
      </div>
    </div>
    <div class="col-md-4 hidden-xs hidden-sm">
      <h1 class="titulo-contacto">Como localizarnos</h1>
      <p><strong>Email:</strong> <a href="mailto:inmobex@inmobex.xyz">inmobex@inmobex.xyz</a></p>
      <p><strong>Teléfono:</strong> 924112233</p>
      <p><strong>Móvil:</strong> 666666666</p>
      <p><strong>Skype:</strong> inmobex</p>
      <p><strong>Dirección:</strong> C/ Ronda Pilar 20 06002 Badajoz España</p>
      <img src="img/logos/logo_vertical.png" id="logo-contacto">
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<?php
$contenidoPagina = ob_get_clean();
include_once("master.php");
?>
