<?php
include_once("includes/login_snippet.php");
include_once("modelos/inmueble_modelo.php");
include_once("modelos/posts_modelo.php");

$tituloHtml = "Blog - Inmobex";
$claseBody = "pag-blog";
$tituloPagina = "Encuentra tu <strong>hogar</strong>";
$scriptsPagina = "<script defer src='blog/js/blog.js'></script>";
$accion = (!empty($_GET["accion"])) ? $_GET["accion"] : "";
$idUsuario = (!empty($_SESSION["usuario"]["id"])) ? $_SESSION["usuario"]["id"] : null;
$esEmpleado = (!empty($_SESSION["usuario"]["administrador"])) ? $_SESSION["usuario"]["administrador"] : false;

if (!empty($_POST) && $esEmpleado) {
  guardarEntrada($_POST, $_FILES);
}

ob_start();
?>

<div class="container">
  <div class="contenido-main">

    <?php
    if ($accion == "ver" && !empty($_GET["id"])) {
      include_once("blog/entrada.php");
    } elseif ($accion == "publicar") {
      include_once("blog/nueva.php");
      if (!$esEmpleado) header("Location: blog.php");
    } elseif ($accion == "borrar" && !empty($_GET["id"])) {
      if (!$esEmpleado) {
         header("Location: blog.php");
         exit;
       }
      borrarEntrada($_GET["id"]);
      include_once("blog/lista.php");
    } else {
      include_once("blog/lista.php");
    }
    ?>

  </div>
</div>

<?php
$contenidoPagina = ob_get_clean();
include_once("master.php");
?>
