<?php
include_once("includes/login_snippet.php");
include ('modelos/inmueble_modelo.php');
//control de acceso
if(empty($_SESSION['usuario'])){
    header('location:index.php');}
if (!empty($_GET["id"])) {
	$resultado = eliminarInmueblePorId($_GET["id"]);
	if ($resultado == true) {
		header("Location: lista_inmuebles.php");
	}
} else {
	header("Location: lista_inmuebles.php");
}

ob_start();
?>

<div class="container contenido-main">

	<?php if ($resultado == false):	?>

		<p class="alert alert-danger">No se ha encontrado ese inmueble.</p>

	<?php endif; ?>

</div>

<?php
$contenidoPagina = ob_get_clean();
include_once("master.php");
?>
