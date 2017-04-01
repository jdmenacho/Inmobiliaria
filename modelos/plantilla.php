<?php
$tituloHtml = "Inmobex";
$tituloPagina = "Encuentra tu <strong>hogar</strong>";

ob_start();
?>

<div class="container">

</div>

<?php
$contenido = ob_get_clean();
include_once("master.php");
?>
