<?php 
include_once('funciones/funciones.php');

// CREAR

if ($_POST['registro'] == 'nuevo') {
	
	// sanitizar el metodo post
	$formulario = filter_var_array($_POST, FILTER_SANITIZE_STRING);

	// declaracion de variables
	$titulo = $formulario['titulo_evento'];
	$lugar = $formulario['lugar_evento'];
	$inicio = $formulario['inicio_evento'];
	$inicio_f = date('Y-m-d', strtotime($inicio));
	$fin = $formulario['fin_evento'];
	$fin_f = date('Y-m-d', strtotime($fin));
	$cuerpo = $formulario['cuerpo_evento'];
	$contacto = $formulario['contacto_evento'];
	$directorio = "../img/eventos/";
	
	// restriccion de caracteres maximos en los campos
	if ((strlen($titulo) > 120) || (strlen($cuerpo) > 2050) || (strlen($lugar) > 80) || (strlen($contacto) > 50)) {
		$respuesta = array (
			'respuesta' => 'exceso'
		);
		die(json_encode($respuesta));
	}

	// subir un archivo de imagen
	if (!is_dir($directorio)) {
		mkdir($directorio, 0755, true);
	}
	if ((($_FILES['archivo_imagen']['type'] == 'image/jpeg') || ($_FILES['archivo_imagen']['type'] == 'image/png')) && ($_FILES['archivo_imagen']['size'] < 2000000)) { // 2 MB
		$nuevo_nombre = time() . $_FILES['archivo_imagen']['name'];
		if (move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $directorio . $nuevo_nombre)) {
			$imagen_url = $nuevo_nombre;
			$imagen_resultado = "Se subió correctamente";
		} else {
			$respuesta = array (
				'respuesta' => error_get_last()
			);
			die(json_encode($respuesta));
		}
	} else {
		$respuesta = array (
			'respuesta' => 'imagen_exceso'
		);
		die(json_encode($respuesta));
	}

	// base de datos
	try {
		$stmt = $conn->prepare("INSERT INTO evento(tituloEvento, inicioEvento, finEvento, lugarEvento, cuerpoEvento, imagenEvento, contactoEvento) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssss", $titulo, $inicio_f, $fin_f, $lugar, $cuerpo, $imagen_url, $contacto);
		$stmt->execute();
		$idCrear = $stmt->insert_id;
		if ($stmt->affected_rows) {
			$respuesta = array (
				'respuesta' => 'exito',
				'id_insertado' => $idCrear,
				'resultado_imagen' => $imagen_resultado
			);
		} else {
			$respuesta = array (
				'respuesta' => 'error'
			);
		}
		$stmt->close();
		$conn->close();
	} catch(Exception $e) {
		$respuesta = array (
			'respuesta' => $e->getMessage()
		);
	}
	die(json_encode($respuesta));
}

// ACTUALIZAR

if ($_POST['registro'] == 'actualizar') {

	// sanitizar el metodo post
	$formulario = filter_var_array($_POST, FILTER_SANITIZE_STRING);

	// declaracion de variables
	$titulo = $formulario['titulo_evento'];
	$lugar = $formulario['lugar_evento'];
	$inicio = $formulario['inicio_evento'];
	$inicio_f = date('Y-m-d', strtotime($inicio));
	$fin = $formulario['fin_evento'];
	$fin_f = date('Y-m-d', strtotime($fin));
	$cuerpo = $formulario['cuerpo_evento'];
	$contacto = $formulario['contacto_evento'];
	$directorio = "../img/eventos/";
	$idActualizar = filter_var($_POST['id_registro'], FILTER_SANITIZE_NUMBER_INT);
	
	// restriccion de caracteres maximos en los campos
	if ((strlen($titulo) > 120) || (strlen($cuerpo) > 2050) || (strlen($lugar) > 80) || (strlen($contacto) > 50)) {
		$respuesta = array (
			'respuesta' => 'exceso'
		);
		die(json_encode($respuesta));
	}
	
	// subir un archivo de imagen
	if ($_FILES['archivo_imagen']['size'] > 0) {
		if (!is_dir($directorio)) {
			mkdir($directorio, 0755, true);
		}
		if (($_FILES['archivo_imagen']['type'] == 'image/jpeg' || $_FILES['archivo_imagen']['type'] == 'image/png') && ($_FILES['archivo_imagen']['size'] < 2000000)) { // 2 MB
			$nuevo_nombre = time() . $_FILES['archivo_imagen']['name'];
			if (move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $directorio . $nuevo_nombre)) {
				$imagen_url = $nuevo_nombre;
				$imagen_resultado = "Se subió correctamente";
			} else {
				$respuesta = array (
					'respuesta' => error_get_last()
				);
				die(json_encode($respuesta));
			}
		} else {
			$respuesta = array (
				'respuesta' => 'imagen_exceso'
			);
			die(json_encode($respuesta));
		}
	}

	// base de datos
	try {
		if ($_FILES['archivo_imagen']['size'] > 0) { // con imagen
			$stmt = $conn->prepare("UPDATE evento SET tituloEvento = ?, inicioEvento = ?, finEvento = ?, lugarEvento = ?, cuerpoEvento = ?, imagenEvento = ?, contactoEvento = ?, editadoEvento = NOW() WHERE idEvento = ?");
			$stmt->bind_param("sssssssi", $titulo, $inicio_f, $fin_f, $lugar, $cuerpo, $imagen_url, $contacto, $idActualizar);
		} else { // sin imagen
			$stmt = $conn->prepare("UPDATE evento SET tituloEvento = ?, inicioEvento = ?, finEvento = ?, lugarEvento = ?, cuerpoEvento = ?, contactoEvento = ?, editadoEvento = NOW() WHERE idEvento = ?");
			$stmt->bind_param("ssssssi", $titulo, $inicio_f, $fin_f, $lugar, $cuerpo, $contacto, $idActualizar);
		}
		$estado = $stmt->execute();
		if ($estado == true) {
			$respuesta = array(
				'respuesta' => 'exito',
				'id_actualizado' => $idActualizar
			);
		} else {
			$respuesta = array(
				'respuesta' => 'error'
			);
		}
		$stmt->close();
		$conn->close();
	} catch (Exception $e) {
		$respuesta = array(
			'respuesta' => $e->getMessage()
		);
	}
	die(json_encode($respuesta));
}

// ELIMINAR

if ($_POST['registro'] == 'eliminar') {

	// declaracion de variables
	$idEliminar = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

	// base de datos
	try {
		$stmt = $conn->prepare("DELETE FROM evento WHERE idEvento = ? ");
		$stmt->bind_param('i', $idEliminar);
		$stmt->execute();
		if ($stmt->affected_rows) {
			$respuesta = array(
				'respuesta' => 'exito',
				'id_eliminado' => $idEliminar
			);
		} else {
			$respuesta = array(
				'respuesta' => 'error'
			);
		}
	} catch (Exception $e) {
		$respuesta = array(
			'respuesta' => $e->getMessage()
		);
	}
	die(json_encode($respuesta));
}

?>