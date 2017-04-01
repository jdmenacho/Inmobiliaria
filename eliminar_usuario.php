<?php
include_once("includes/login_snippet.php");
if(empty($_SESSION['usuario'])){
    header('location:index.php');}
if (!empty($_GET["id"])) {
	$resultado = eliminarUsuarioPorId($_GET["id"]);
	if ($resultado == true) {
		header("Location: lista_usuarios.php");
	}
} else {
	header("Location: lista_usuarios.php");
}

ob_start();
?>

<div class="container contenido-main">

	<?php if ($resultado == false):	?>

		<p class="alert alert-danger">No se ha encontrado ese usuario.</p>

	<?php endif; ?>

</div>

<?php
$contenidoPagina = ob_get_clean();
include_once("master.php");
?>
