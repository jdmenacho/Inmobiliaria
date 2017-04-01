<?php
include_once("includes/login_snippet.php");
include_once("modelos/inmueble_modelo.php");

$tituloHtml = "Inmobex";
$claseBody = "pag-sobre";
$tituloPagina = "Sobre <strong>nosotros</strong>";

ob_start();
?>

<div class="container">
  <div class="contenido-main">
    <div class="col-md-12">
      <img src="img/logos/logo_vertical_oscuro.png" alt="Sobre nosotros" id="logo-sobre"/>
      <h1>Lorem ipsum dolor sit amet</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
    <div class="imagen-nosotros col-md-3">
      <img src="img/sobre/nosotros1.jpg" class="img-responsive"/>
      <div class="datos-nosotros">
        <div class="texto-nosotros">
          <h4>CEO</h4>
          <h4>María Perez</h4>
          <h4><a href="mailto:mperez@inmobex.com">Enviar e-mail</a></h4>
        </div>
      </div>
    </div>
    <div class="imagen-nosotros col-md-3">
      <img src="img/sobre/nosotros2.jpg" class="img-responsive"/>
      <div class="datos-nosotros">
        <div class="texto-nosotros">
          <h4>CEO</h4>
          <h4>María Perez</h4>
          <h4><a href="mailto:mperez@inmobex.com">Enviar e-mail</a></h4>
        </div>
      </div>
    </div>
    <div class="imagen-nosotros col-md-3">
      <img src="img/sobre/nosotros3.jpg" class="img-responsive"/>
      <div class="datos-nosotros">
        <div class="texto-nosotros">
          <h4>CEO</h4>
          <h4>María Perez</h4>
          <h4><a href="mailto:mperez@inmobex.com">Enviar e-mail</a></h4>
        </div>
      </div>
    </div>
    <div class="imagen-nosotros col-md-3">
      <img src="img/sobre/nosotros4.jpeg" class="img-responsive"/>
      <div class="datos-nosotros">
        <div class="texto-nosotros">
          <h4>CEO</h4>
          <h4>María Perez</h4>
          <h4><a href="mailto:mperez@inmobex.com">Enviar e-mail</a></h4>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<?php
$contenidoPagina = ob_get_clean();
include_once("master.php");
?>
