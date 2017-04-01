<?php
include_once("modelos/conexion.php");

function comprobarUsuario($nombre_usuario, $contrasena) {
  $consulta = "SELECT * FROM usuarios WHERE nombre_usuario='$nombre_usuario' AND contrasena='$contrasena'";
  $listado = hacerListado($consulta);
  if (count($listado) == 0) {
    return false;
  } else {
    return $listado[0];
  }

  return $listado;
}

function cifrarContrasena($contrasena) {
  return sha1($contrasena);
}

function comprobarErroresUsuario($datos) {

  if (empty($datos["nombre_usuario"])) {
    return "Debe completar el nombre de usuario";
  }
  if($datos['modificar_contrasena']==1){
      if(empty($datos['contrasena'])) {
        return "Debe introducir una contraseña.";
      }

      if(empty($datos['contrasena2'])) {
        return "Debe introducir una contraseña.";
      }

      if($datos['contrasena'] != $datos['contrasena2']){
        return "Las contraseñas no coinciden.";
      }
}

  if (empty($datos["nombre"])) {
    return "Debe completar el nombre";
  }

  if (empty($datos["apellidos"])) {
    return "Debe completar los apellidos";
  }

  if (empty($datos["email"])) {
    return "Debe proporcionar una dirección e-mail.";
  }

  if (empty($datos["telefono"])) {
    return "Debe proporcionar un número de teléfono.";
  }

  return false;
}

function consultaInsertUsuario ($datos, $tabla) {
	unset($datos["enviar_registro"]);
  	unset($datos["contrasena2"]);
  $datos["contrasena"] = cifrarContrasena($datos["contrasena"]);
  $indices = array_keys($datos);
  $valores = array_values($datos);

  $consulta = "INSERT INTO $tabla (" . implode(", " , $indices) . ") VALUES ('" . implode("' , '", $valores) . "')";
  return $consulta;
}

function guardarUsuario($datos) {
  $consulta = consultaInsertUsuario($datos,"usuarios");
  return ejecutarConsulta($consulta);
}

// ALBERTOS

function obtenerTodosLosUsuarios() {
  $consulta = "SELECT * FROM usuarios";
  $usuarios = hacerListado($consulta);
  return $usuarios;
}

function obtenerUsuariosPorPagina($limit = 10, $offset = 0) {
  $consulta = "SELECT * FROM usuarios ORDER BY id DESC LIMIT $limit OFFSET $offset";
  $usuarios = hacerListado($consulta);
  return $usuarios;
}

function obtenerUsuarioPorId($id) {
  $consulta = "SELECT * FROM usuarios WHERE id='$id'";
  $usuarios = hacerListado($consulta);
  if (count($usuarios) <= 0) {
    return false;
  } else {
    return $usuarios[0];
  }
}

  /* function comprobarErroresUsuario($datos) {

  if (empty($datos["telefono"])) {
    return "Debe completar el teléfono";
  } elseif (!is_numeric($datos["telefono"])) {
    return "El teléfono debe ser un número";
  }


  if (empty($datos["nombre"])) {
    return "Debe completar el nombre";
  } elseif (!is_string($datos["nombre"])) {
    return "Error: el nombre debe ser una cadena de caracteres";
  } elseif (strlen($datos["nombre"])>2000) {
    return "Error:demasiados caracteres en el nombre";
  }

  if (empty($datos["apellidos"])) {
    return "Debe completar los apellidos";
  } elseif (!is_string($datos["apellidos"])) {
    return "Error: los apellidos deben ser una cadena de caracteres";
  } elseif (strlen($datos["apellidos"])>2000) {
    return "Error:demasiados caracteres en los apellidos";
  }

if (empty($datos["email"])) {
    return "Debe completar el correo electrónico";
  } elseif (!is_string($datos["email"])) {
    return "Error: el correo electrónico debe ser una cadena de caracteres";
  } elseif (strlen($datos["email"])>2000) {
    return "Error:demasiados caracteres en el correo electrónico";
  }

  if (empty($datos["nombre_usuario"])) {
    return "Debe completar el nombre de usuario";
  } elseif (!is_string($datos["nombre_usuario"])) {
    return "Error: el nombre de usuario debe ser una cadena de caracteres";
  } elseif (strlen($datos["nombre_usuario"])>2000) {
    return "Error:demasiados caracteres en el nombre de usuario";
  }
  return false;
} */

/* function guardarUsuario($datos) {
  $consulta = consultaInsert($datos, "usuario");
  $resultado = ejecutarConsulta($consulta);
  return $resultado;
} */

function editarUsuario($datos, $tabla) {
  $consulta = consultaUpdate($_POST, $tabla);
  return ejecutarConsulta($consulta);

}
function eliminarUsuarioPorId($id) {
  $consulta = "DELETE FROM usuarios WHERE id='$id'";
  $resultado = ejecutarConsulta($consulta);
  return $resultado;
}
?>
