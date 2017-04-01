<?php
include_once('conexion.php');

function obtenerInmueblesOrdenadosPor($orden, $limit=8) {
	$consulta = "SELECT * FROM inmuebles ORDER BY $orden LIMIT $limit";
	$inmuebles = hacerListado($consulta);
	return $inmuebles;
}

function obtenerInmueblePorId($id) {
	$consulta = "SELECT * FROM inmuebles WHERE id='$id'";
	$inmuebles = hacerListado($consulta);
	if (count($inmuebles) <= 0) {
		return false;
	} else {
		return $inmuebles[0];
	}
}

function obtenerInmueblePorIdJoin($id) {
	$consulta = "SELECT inm.*,tv.abreviatura AS tipo_via,p.nombre AS provincia,ti.nombre AS tipo_inmueble,tp.nombre AS tipo_pago FROM inmuebles inm JOIN tipos_inmueble ti ON inm.tipo_inmueble=ti.id JOIN tipos_pago tp ON inm.tipo_pago=tp.id JOIN provincias p ON inm.provincia=p.id JOIN tipos_via tv ON inm.tipo_via=tp.id WHERE inm.id='$id'";
	$inmuebles = hacerListado($consulta);
	if (count($inmuebles) <= 0) {
		return false;
	} else {
		return $inmuebles[0];
	}
}

function obtenerInmueblesDestacadosEImagenes($limit=8) {
	$consulta = "SELECT inm.id,inm.precio,inm.localidad,inm.superficie,inm.titulo,inm.creado,img.nombre,ti.nombre AS tipo_inmueble,tp.nombre AS tipo_pago " .
							"FROM inmuebles inm JOIN imagenes_inmuebles img ON inm.id=img.id_inmueble JOIN tipos_inmueble ti ON inm.tipo_inmueble=ti.id " .
							"JOIN tipos_pago tp ON inm.tipo_pago=tp.id GROUP BY inm.id ORDER BY creado DESC LIMIT $limit";
	$inmuebles = hacerListado($consulta);
	return $inmuebles;
}

function obtenerInmueblesEImagenes($start=0, $limit=8) {
	$consulta = "SELECT inm.id,inm.precio,inm.localidad,inm.superficie,inm.titulo,inm.creado,img.nombre,ti.nombre AS tipo_inmueble,tp.nombre AS tipo_pago " .
							"FROM inmuebles inm JOIN imagenes_inmuebles img ON inm.id=img.id_inmueble JOIN tipos_inmueble ti ON inm.tipo_inmueble=ti.id " .
							"JOIN tipos_pago tp ON inm.tipo_pago=tp.id GROUP BY inm.id ORDER BY creado DESC LIMIT $start, $limit";
	$inmuebles = hacerListado($consulta);
	return $inmuebles;
}

function generarCriteriosBusqueda($criterios) {
	$precioPuesto = false;
	foreach ($criterios as $criterio => $value) {
		if (($criterio == "preciomin" || $criterio == "preciomax") && $precioPuesto == false){
			$min = !empty($criterios["preciomin"]) ? "precio BETWEEN " . $criterios["preciomin"] :"precio BETWEEN " . 0;
			$max = !empty($criterios["preciomax"]) ? " AND " . $criterios["preciomax"] :" AND " . 999999999999999999999;
			$criteriosSQL[] = " (" . $min . $max . ") ";
			$precioPuesto = true;
		} else {
			if ($criterio != "preciomin" && $criterio != "preciomax" && !empty($value)) $criteriosSQL[] = "$criterio='$value'";
		}
	}
	return implode(' AND ', $criteriosSQL);
}

function obtenerInmueblesEImagenesFiltrados($start=0, $limit=8, $criterios) {
	$consulta = "SELECT inm.id,inm.precio,inm.localidad,inm.superficie,inm.titulo,inm.creado,img.nombre,ti.nombre AS tipo_inmueble,tp.nombre AS tipo_pago " .
							"FROM inmuebles inm JOIN imagenes_inmuebles img ON inm.id=img.id_inmueble JOIN tipos_inmueble ti ON inm.tipo_inmueble=ti.id " .
							"JOIN tipos_pago tp ON inm.tipo_pago=tp.id WHERE $criterios GROUP BY inm.id ORDER BY creado DESC LIMIT $start, $limit";
	$inmuebles = hacerListado($consulta);
	return $inmuebles;
}


function comprobarErroresInmueble($datos, $archivos = "editar") {
	if (empty($datos["tipo_inmueble"])) {
		return "Debe completar el tipo de inmueble";
	} elseif (!is_numeric($datos["tipo_inmueble"])) {
		return "error valor no numerico en tipo inmueble";
	}

	if (empty($datos["superficie"])) {
		return "Debe completar la superficie";
	} elseif (!filter_var($datos["superficie"],FILTER_VALIDATE_INT)) {
		return "error valor no numerico superficie";
	}

	if (empty($datos["titulo"])) {
		return "Debe completar la descripcion";
	} elseif (!is_string($datos["titulo"])) {
		return "error el titulo debe ser una cadena de caracteres";
	} elseif (strlen($datos["titulo"])>2000) {
		return "error demasiados caracteres en el titulo";
	}

	if (empty($datos["descripcion"])) {
		return "Debe completar la descripcion";
	} elseif (!is_string($datos["descripcion"])) {
		return "error la descripcion debe ser una cadena de caracteres";
	} elseif (strlen($datos["descripcion"])>2000) {
		return "error demasiados caracteres en el titulo";
	}

	if (empty($datos["provincia"])) {
		return "Debe completar la provincia";
	}elseif (!filter_var($datos["provincia"],FILTER_VALIDATE_INT)) {
		return "error valor no numerico en la provincia";
	}

	if (empty($datos["localidad"])) {
		return "Debe completar la localidad";
	}elseif (!is_string($datos["localidad"])) {
		return "error la localidad debe ser una cadena de caracteres";
	} elseif (strlen($datos["localidad"])>255) {
		return "error demasiados caracteres en la localidad";
	}

	if (empty($datos["tipo_via"])) {
		return "Debe completar el tipo de via";
	}elseif (!filter_var($datos["tipo_via"],FILTER_VALIDATE_INT)) {
		return "error tipo_via valor no numerico";
	}

	if (empty($datos["nombre_via"])) {
		return "Debe completar el nombre de la via";
	}elseif (!is_string($datos["nombre_via"])) {
		return "error nombre_via debe ser una cadena de caracteres";
	} elseif (strlen($datos["nombre_via"])>255) {
		return "error nombre_via demasiados caracteres";
	}

	if (empty($datos["codigo"])) {
		return "Debe completar el codigo postal";
	}elseif (!is_numeric($datos["codigo"])) {
		return "error codigo postal valor no numerico";
	} elseif (strlen($datos["codigo"])!=5) {
		return "error el codigo postal debe tener 5 caracteres";
	}

	if (empty($datos["tipo_pago"])) {
		return "Debe completar si es venta o alquiler";
	}elseif (!filter_var($datos["tipo_pago"],FILTER_VALIDATE_INT)) {
		return "error tipo_ pago valor no numerico";
	}

	if (!filter_var($datos["numero_via"],FILTER_VALIDATE_INT)) {
		return "error numero_via valor no numerico";
	}

	if (!filter_var($datos["habitaciones"],FILTER_VALIDATE_INT)) {
		return "error habitaciones valor no numerico";
	} elseif ($datos["habitaciones"]>=1000) {
		return "demasidas habitaciones";
	}

	if (!filter_var($datos["banos"],FILTER_VALIDATE_INT)) {
		return "error baños valor no numerico";
	} elseif ($datos["banos"]>=1000) {
		return "demasidos baños";
	}

	if (!is_string($datos["letra"])) {
		return "error la letra debe ser cadena de caracteres";
	}

	if (!filter_var($datos["piso"],FILTER_VALIDATE_INT)) {
		return "error en piso valor no numerico";
	}elseif ($datos["piso"]>=150) {
		return "demasidos pisos";
	}

	if (!filter_var($datos["precio"],FILTER_VALIDATE_FLOAT)) {
		return "error en precio valor no numerico";
	}

	if ($archivos != "editar") {
		$numeroImagenes=0;
		foreach ($archivos as $archivo) {
			if ($archivo["type"]!="image/jpeg" && $archivo["type"]!="image/png" && $archivo["type"]!=null) {
				return "error en el tipo de imagen";
			}
			$tamano = getimagesize($archivo["tmp_name"]);
			if ($archivo["tmp_name"]!="" && $tamano!=false) {
				if ($tamano[0] < 800 || $tamano[1] < 600) {
					echo "error imagen demasiado pequeña";
				}
				$numeroImagenes++;
			}
		}
		if ($numeroImagenes<1) {
			return "error debe introducir alguna imagen";
		}
		return false;
	}
}

function guardarInmueble($datos) {
	$consulta = consultaInsert($datos, "inmuebles");
	$resultado = ejecutarConsulta($consulta);
	return $resultado;
}

function obtenerUltimoInmueble() {
	$consulta = "SELECT MAX(id) AS id FROM inmuebles";
	$inmuebles = hacerListado($consulta);
	if (count($inmuebles) <= 0) {
		return false;
	} else {
		return $inmuebles[0];
	}
}

function obtenerImagenesPorIdInmueble($id) {
	$consulta = "SELECT nombre FROM imagenes_inmuebles WHERE id_inmueble='$id'";
	$imagenes = hacerListado($consulta);
	if (count($imagenes) <= 0) {
		return false;
	} else {
		return $imagenes;
	}
}

function obtenerProvincias() {
	$consulta = "SELECT * FROM provincias";
	return hacerListado($consulta);
}

function obtenerTiposInmueble() {
	$consulta = "SELECT * FROM tipos_inmueble";
	return hacerListado($consulta);
}

function obtenerTiposPago() {
	$consulta = "SELECT * FROM tipos_pago";
	return hacerListado($consulta);
}

function obtenerTiposVia() {
	$consulta = "SELECT * FROM tipos_via";
	return hacerListado($consulta);
}

// ALBERTOS

function obtenerTodosLosInmuebles() {
	$consulta = "SELECT * FROM inmuebles";
	$inmuebles = hacerListado($consulta);
	return $inmuebles;
}

function eliminarInmueblePorId($id) {
	$consulta = "DELETE FROM inmuebles WHERE id='$id'";
	$resultado = ejecutarConsulta($consulta);
	return $resultado;
}

function obtenerInmueblesPorIdUsuario($id_usuario) {
	$consulta = "SELECT * FROM inmuebles WHERE id_usuario = '$id_usuario'";
	$inmuebles = hacerListado($consulta);
	if (count($inmuebles) <= 0) {
		return false;
	} else {
		return $inmuebles;
	}
}

function actualizarInmueble($datos) {
	$consulta = consultaUpdate($datos, "inmuebles");
	return ejecutarConsulta($consulta);
}

?>
