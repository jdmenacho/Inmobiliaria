<?php
$hostDB = "localhost";
$userDB = "root";
$passDB = "";
$nombreDB = "inmobex";

function recuperarDatosDB($consulta, $parametros, $tipos) {
  $enlace = mysqli_connect($GLOBALS["hostDB"], $GLOBALS["userDB"], $GLOBALS["passDB"], $GLOBALS["nombreDB"]);
  if ($stmt = mysqli_prepare($enlace, $consulta)) {

  }
}

function obtenerNumeroRegistros($tabla) {
  $enlace = mysqli_connect($GLOBALS["hostDB"], $GLOBALS["userDB"], $GLOBALS["passDB"], $GLOBALS["nombreDB"]);
  if ($stmt = mysqli_prepare($enlace, "SELECT COUNT(*) AS total FROM $tabla")) {
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    return $resultado["total"];
  }
}

function obtenerEntradaBlogPorId($id) {
  $enlace = mysqli_connect($GLOBALS["hostDB"], $GLOBALS["userDB"], $GLOBALS["passDB"], $GLOBALS["nombreDB"]);
  if ($stmt = mysqli_prepare($enlace, "SELECT * FROM posts WHERE id=?")) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    return $resultado;
  }
}

function obtenerEntradasBlog($orden = "id", $sentido = "ASC", $inicio = "0", $cantidad = "18446744073709551615") {
  $enlace = mysqli_connect($GLOBALS["hostDB"], $GLOBALS["userDB"], $GLOBALS["passDB"], $GLOBALS["nombreDB"]);
  if ($stmt = mysqli_prepare($enlace, "SELECT * FROM posts ORDER BY $orden $sentido LIMIT ? OFFSET ?")) {
    mysqli_stmt_bind_param($stmt, "ii", $cantidad, $inicio);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
  }
}

/* function ejecutarConsulta($consulta) {
	$enlace = mysqli_connect($GLOBALS["hostDB"], $GLOBALS["userDB"], $GLOBALS["passDB"], $GLOBALS["nombreDB"]);
	if (mysqli_connect_errno()) {
		die("Error de conexión: " . mysqli_connect_error());
	}
	mysqli_set_charset($enlace, 'utf8');
	$resultado = mysqli_query($enlace, $consulta);
	mysqli_close($enlace);
	return $resultado;
} */

function guardarEntrada($datos, $imagen) {
  $claves = array_keys($datos);
  $valores = array_values($datos);
  $enlace = mysqli_connect($GLOBALS["hostDB"], $GLOBALS["userDB"], $GLOBALS["passDB"], $GLOBALS["nombreDB"]);
  if ($stmt = mysqli_prepare($enlace, "INSERT INTO posts (" . implode(",", $claves) . ",imagen) VALUES (?,?,?)")) {
    mysqli_stmt_bind_param($stmt, "sss", $valores[0], $valores[1], $imagen["imagen"]["name"]);
    mysqli_stmt_execute($stmt);
  }
}

function borrarEntrada($id) {
  $enlace = mysqli_connect($GLOBALS["hostDB"], $GLOBALS["userDB"], $GLOBALS["passDB"], $GLOBALS["nombreDB"]);
  if ($stmt = mysqli_prepare($enlace, "DELETE FROM posts WHERE id=?")) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
  }
}
?>
