<?php
$tituloHtml = (empty($tituloHtml)) ? "Inmobex" : $tituloHtml;
$claseBody = (empty($claseBody)) ? "" : $claseBody;
$tituloPagina = (empty($tituloPagina)) ? "Encuentra tu <strong>hogar</strong>" : $tituloPagina;
$contenidoPagina = (empty($contenidoPagina)) ? "" : $contenidoPagina;
$scriptsPagina = (empty($scriptsPagina)) ? "" : $scriptsPagina;
$abrir = "";
$expandir = false;
$mensaje_error = "";
$nombre_usuario = (!empty($_SESSION["usuario"]["nombre_usuario"])) ? $_SESSION["usuario"]["nombre_usuario"] : false;
$usuario = (!empty($_SESSION["usuario"])) ? $_SESSION["usuario"] : false;
$tiposInmueble = obtenerTiposInmueble();
$provincias = obtenerProvincias();
$tiposPago = obtenerTiposPago();

if (isset($_POST["enviar_sesion"])) {
  $usuario = comprobarUsuario($_POST['user'], cifrarContrasena($_POST['pass']));
  if ($usuario == false) {
    $mensaje_error = "<p class='alert alert-danger'><strong>El usuario o contraseña no son correctos</strong></p>";
    $abrir = "open";
    $expandir = true;
  } else {
    $_SESSION['usuario'] = $usuario;
    header("Location: ver_usuario.php?id=" . $_SESSION["usuario"]["id"]);
    /* $nombre_usuario = $_SESSION["usuario"]["nombre_usuario"]; */
  }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title><?= $tituloHtml ?></title>
  <meta name="Description" content="Descripción para buscadores" />
  <link rel="icon" href="img/logos/favicon.png">
  <!--
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="robots" content="index, follow" />
  <meta name="google" content="nositelinkssearchbox" />
  <meta name="google" content="notranslate" />
-->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
</head>
<body class="<?= $claseBody ?>">
  <!-- NAVBAR -->
  <nav class="navbar navbar-default navbar-fixed-top" id="navbar-inm">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Desplegar navegación</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img src="img/logos/favicon.png" class="img-responsive logo"></a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="inmuebles.php">INMUEBLES</a>
        </li>
        <li>
          <a href="sobre.php">SOBRE NOSOTROS</a>
        </li>
        <li>
          <a href="contacto.php">CONTACTO</a>
        </li>
        <li>
          <a href="blog.php">BLOG</a>
        </li>
        <?php if(!$usuario): ?>
        <li class="dropdown <?= $abrir ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="<?= $expandir ?>">
            <img src="img/iconos/login.png" class="user-drop img-responsive">
          </a>
          <ul class="dropdown-menu">
            <li>
              <form id="sesion_usuario" method="POST">
                <div class="form-group">
                  <label for="user">Nombre de usuario</label>
                  <input type="text" name="user" class="form-control">
                </div>
                <div class="form-group">
                  <label for="pass">Contraseña</label>
                  <input type="password" name="pass" class="form-control">
                </div>
                <div>
                  <input type="hidden" name="direccion" value="<?= $_SERVER['PHP_SELF']; ?>">
                </div>
                <div class="form-group">
                  <button class="btn btn-primary btn-block" name="enviar_sesion"><strong>Entrar</strong></button>
                </div>
                <strong>¿Nuevo usuario? Registrate <a href="registro.php">aquí</a></strong>
                <?= $mensaje_error ?>
              </form>
            </li>
            <?php else: ?>
            <!-- EN CASO DE QUE EL USUARIO ESTÉ REGISTRADO -->
            <li class="dropdown <?= $abrir ?>">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="<?= $expandir ?>">
                <div style="font-size: 10pt;">
                  <img src="img/iconos/login.png" class="user-drop img-responsive" style="float:left">
                  <span style='line-height:30px'><?= $nombre_usuario ?></span>
                </div>
                <div class="clearfix"></div>
              </a>
              <ul class="dropdown-menu" id="navbar-user-dropdown">
                <!-- <li><h4><?= $nombre_usuario ?></h4></li> -->
                <li><a href="publicar.php">Publicar inmueble</a></li>
                <li><a href="ver_usuario.php?id=<?= $usuario["id"] ?>">Ver perfil</a></li>
                <li><a href="editar_usuario.php?id=<?= $usuario["id"] ?>">Editar perfil</a></li>
                <?php if($usuario['administrador']==1):?>
                <li><a href="lista_inmuebles.php">Gestion inmuebles</a></li>
                <li><a href="lista_usuarios.php">Gestion usuarios</a></li>
              <?php endif;?>
                <li class="divider"></li>
                <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>
              <?php endif; ?>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <!-- /NAVBAR -->
      <!-- SLIDER -->
      <?php if ($claseBody != "admin-usuarios" && $claseBody != "admin-inmuebles"): ?>
        <div class="slider-inm hidden-xs hidden-sm">
          <div class="row carousel-holder">
            <div class="col-md-12">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="item active">
                    <img class="slide-image" src="img/slider/slider1.jpg" alt="piso">
                  </div>
                  <div class="item">
                    <img class="slide-image" src="img/slider/slider2.jpg" alt="nave">
                  </div>
                  <div class="item">
                    <img class="slide-image" src="img/slider/slider3.jpg" alt="oficina">
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
              </div>
            </div>
          </div>
          <!-- BUSCADOR -->
          <div id="slider-search">
            <div class="col-md-5">
              <img src="img/logos/logo_vertical_oscuro.png" class="img-responsive" style="">
            </div>
            <div class="col-md-7">
              <form class="form" action="inmuebles.php" method="get">
                <div class="row">
                  <div id="campos-slider">
                    <input type="hidden" name="action" value="buscar">
                    <div class="col-md-12" id="slider-search-localizacion">
                      <select class="form-control" name="provincia">

                        <?php foreach ($provincias as $provincia): ?>

                        <option value="<?= $provincia["id"] ?>"><?= $provincia["nombre"] ?></option>

                        <?php endforeach; ?>

                      </select>
                    </div>
                    <div class="form-inline">
                      <div class="col-md-6">
                        <select name="tipo_inmueble" class="form-control">

                          <?php foreach ($tiposInmueble as $tipo): ?>

                          <option value="<?= $tipo["id"] ?>"><?= $tipo["nombre"] ?></option>

                          <?php endforeach; ?>

                        </select>
                      </div>
                      <div class="col-md-6">
                        <select name="tipo_pago" class="form-control">

                          <?php foreach ($tiposPago as $tipo): ?>

                          <option value="<?= $tipo["id"] ?>"><?= $tipo["nombre"] ?></option>

                          <?php endforeach; ?>

                        </select>
                      </div>
                      <div class="col-md-6">
                        <input class="form-control" type="number" name="preciomin" placeholder="€ Min"/>
                      </div>
                      <div class="col-md-6">
                        <input class="form-control" type="number" name="preciomax" placeholder="€ Max"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /BUSCADOR -->
        </div>
      <!-- /SLIDER -->
      <!-- TITULO DE PAGINA -->
      <div class="titulo-pagina">
        <div class="col-md-3 col-xs-6 col-sm-6">
          <a href="publicar.php" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Publicar inmueble</a>
        </div>
        <div class="col-md-6 hidden-xs hidden-sm">
          <h2><?= $tituloPagina ?></h2>
        </div>
        <div class="col-md-3 col-xs-6 col-sm-6">
          <div id="redes-sociales">
            <a href="https://es-es.facebook.com/TalentumEmpleo/" target="_blank"><img src="img/iconos/icono_facebook.png" class="img-responsive logo"></a>
            <a href="https://www.instagram.com/fundaciontef/" target="_blank"><img src="img/iconos/icono_instagram.png" class="img-responsive logo"></a>
            <a href="https://twitter.com/talentumempleo" target="_blank"><img src="img/iconos/icono_twitter.png" class="img-responsive logo"></a>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <!-- /TITULO DE PAGINA -->
      <!-- MAIN -->
      <div id="main">

        <?= $contenidoPagina ?>

      </div>
      <?= ($claseBody == "pag-contacto") ? "<div id='mapa-contacto'></div>" : "" ?>
      <!-- /MAIN -->
      <!-- FOOTER -->
      <footer class="foot">
        <div class="row">
          <div class="foot-col col-md-4 col-sm-4">
            <h3>Mapa Web</h3>
            <a href="inmuebles.php">Inmuebles</a>
            <div class="linea"></div>
            <a href="sobre.php">Sobre nosotros</a>
            <div class="linea"></div>
            <a href="contacto.php">Contacto</a>
            <div class="linea"></div>
            <a href="blog.php">Blog</a>
            <div class="linea"></div>
            <a href="publicar.php">Publique su inmueble</a>
            <div class="linea"></div>
          </div>
          <div class="foot-col map col-md-4 col-sm-4">
            <h3>INMOBEX</h3>
            <p><strong>Email:</strong> <a href="mailto:inmobex@inmobex.xyz">inmobex@inmobex.xyz</a></p>
            <p><strong>Dirección:</strong> C/Ronda del Pilar nº20</p>
            <p><strong>Web:</strong> http://www.inmobex.com</p>
            <p><strong>Teléfono:</strong> 666666666/924112233</p>
            <div class="foot-map" id="mapa"></div>
          </div>
          <div class="map foot-col col-md-4 col-sm-4">
            <h3>Síguenos en las redes</h3>
            <a class="sociales" href="https://es-es.facebook.com/TalentumEmpleo/" target="_blank"><img src="img/iconos/icono_facebook.png" class="sociales-img"></a>
            <a class="sociales" href="https://www.instagram.com/fundaciontef/" target="_blank"><img src="img/iconos/icono_instagram.png" class="sociales-img"></a>
            <a class="sociales" href="https://twitter.com/talentumempleo" target="_blank"><img src="img/iconos/icono_twitter.png" class="sociales-img"></a>
            <div class="linea"></div>
            <img class="foot-logo" src="img/logos/logo_horizontal.png" alt="logo"/>
          </div>
        </div>
        <div class="linea"></div>
        <div class="copy">
          <small><p>Copyright &copy; INMOBILIARIA INMOBEX BADAJOZ - Inmobiliaria. Pisos. Promociones. Inmobiliarias. Hipotecas. Reformas. Alquiler. 2016</p></small>
        </div>
      </footer>
      <!-- /FOOTER -->
      <script src="js/dondeestamos.js"></script>
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-LvOUwWewqqjzwEUhKKr1Ud2DsYxcvkI&callback=initMap"></script>
      <script src="js/jquery.js"></script>
      <script src="js/bootstrap.js"></script>
      <?= $scriptsPagina ?>
    </body>
    </html>

    <!-- <li><h4><?= $_SESSION["usuario"]["nombre_usuario"]; ?></h4></li>
    <li>Ver perfil</li>
    <li><a href="cerrar_sesion.php">Cerrar sesión</a></li> -->
