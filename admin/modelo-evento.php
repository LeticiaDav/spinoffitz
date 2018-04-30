<?php 
include_once('funciones/funciones.php');

// CREAR

if ($_POST['registro'] == 'nuevo') {
	// $respuesta = array(
	// 	'post' => $_POST,
	// 	'file' => $_FILES
	// );
	// die(json_encode($respuesta));
	$titulo = $_POST['titulo_evento'];
	$lugar = $_POST['lugar_evento'];
	$inicio = $_POST['inicio_evento'];
	$inicio_f = date('Y-m-d', strtotime($inicio));
	$fin = $_POST['fin_evento'];
	$fin_f = date('Y-m-d', strtotime($fin));
	$cuerpo = $_POST['cuerpo_evento'];
	$contacto = $_POST['contacto_evento'];
	$directorio = "../img/eventos/";
	if (!is_dir($directorio)) {
		mkdir($directorio, 0755, true); // directorio, permisos, recursivo (mismo permiso a archivos)
	}
	if (move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $directorio . $_FILES['archivo_imagen']['name'])) {
		$imagen_url = $_FILES['archivo_imagen']['name'];
		$imagen_resultado = "Se subió correctamente";
	} else {
		$respuesta = array (
			'respuesta' => error_get_last()
		);
	}
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
	$titulo = $_POST['titulo_evento'];
	$lugar = $_POST['lugar_evento'];
	$inicio = $_POST['inicio_evento'];
	$inicio_f = date('Y-m-d', strtotime($inicio));
	$fin = $_POST['fin_evento'];
	$fin_f = date('Y-m-d', strtotime($fin));
	$cuerpo = $_POST['cuerpo_evento'];
	$contacto = $_POST['contacto_evento'];
	$directorio = "../img/eventos/";
	$idActualizar = $_POST['id_registro'];
	if (!is_dir($directorio)) {
		mkdir($directorio, 0755, true); // directorio, permisos, recursivo (mismo permiso a archivos)
	}
	if (move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $directorio . $_FILES['archivo_imagen']['name'])) {
		$imagen_url = $_FILES['archivo_imagen']['name'];
		$imagen_resultado = "Se subió correctamente";
	} else {
		$respuesta = array (
			'respuesta' => error_get_last()
		);
	}
	try {
		// con imagen
		if ($_FILES['archivo_imagen']['size'] > 0) {
			$stmt = $conn->prepare("UPDATE evento SET tituloEvento = ?, inicioEvento = ?, finEvento = ?, lugarEvento = ?, cuerpoEvento = ?, imagenEvento = ?, contactoEvento = ?, editadoEvento = NOW() WHERE idEvento = ?");
			$stmt->bind_param("sssssssi", $titulo, $inicio_f, $fin_f, $lugar, $cuerpo, $imagen_url, $contacto, $idActualizar);
		} else {
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
	$idEliminar = $_POST['id'];
	try {
		$stmt = $conn->prepare("DELETE FROM eventos WHERE idEvento = ? ");
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