<?php 
include_once('funciones/funciones.php');

// CREAR

if ($_POST['registro'] == 'nuevo') {
	// $respuesta = array(
	// 	'post' => $_POST,
	// 	'file' => $_FILES
	// );
	// die(json_encode($respuesta));
	$nombre = $_POST['nombre_spinoff'];
	$giro = $_POST['giro_spinoff'];
	$descripcion = $_POST['descripcion_spinoff'];
	$servicios = $_POST['servicios_spinoff'];
	$proyectos = $_POST['proyectos_spinoff'];
	$integrantes = $_POST['integrantes_spinoff'];
	$video = $_POST['video_spinoff'];
	$telefono = $_POST['telefono_spinoff'];
	$email = $_POST['email_spinoff'];
	$directorio = "../img/spinoffs/";
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
		$stmt = $conn->prepare("INSERT INTO spinoff(nombreSpinoff, giroSpinoff, descripcionSpinoff, serviciosSpinoff, proyectosSpinoff, integrantesSpinoff, imagenSpinoff, videoSpinoff, telefonoSpinoff, emailSpinoff) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssssss", $nombre, $giro, $descripcion, $servicios, $proyectos, $integrantes, $imagen_url, $video, $telefono, $email);
		$stmt->execute();
		$id_insertado = $stmt->insert_id;
		if ($stmt->affected_rows) {
			$respuesta = array (
				'respuesta' => 'exito',
				'id_insertado' => $id_insertado,
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
	$nombre = $_POST['nombre_spinoff'];
	$giro = $_POST['giro_spinoff'];
	$descripcion = $_POST['descripcion_spinoff'];
	$servicios = $_POST['servicios_spinoff'];
	$proyectos = $_POST['proyectos_spinoff'];
	$integrantes = $_POST['integrantes_spinoff'];
	$video = $_POST['video_spinoff'];
	$telefono = $_POST['telefono_spinoff'];
	$email = $_POST['email_spinoff'];
	$directorio = "../img/spinoffs/";
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
			$stmt = $conn->prepare("UPDATE spinoff SET nombreSpinoff = ?, giroSpinoff = ?, descripcionSpinoff = ?, serviciosSpinoff = ?, proyectosSpinoff = ?, integrantesSpinoff = ?, imagenSpinoff = ?, videoSpinoff = ?, telefonoSpinoff = ?, emailSpinoff = ?, editadoSpinoff = NOW() WHERE idSpinoff = ?");
			$stmt->bind_param("ssssssssssi", $nombre, $giro, $descripcion, $servicios, $proyectos, $integrantes, $imagen_url, $video, $telefono, $email, $idActualizar);
		} else {
			$stmt = $conn->prepare("UPDATE spinoff SET nombreSpinoff = ?, giroSpinoff = ?, descripcionSpinoff = ?, serviciosSpinoff = ?, proyectosSpinoff = ?, integrantesSpinoff = ?, videoSpinoff = ?, telefonoSpinoff = ?, emailSpinoff = ?, editadoSpinoff = NOW() WHERE idSpinoff = ?");
			$stmt->bind_param("sssssssssi", $nombre, $giro, $descripcion, $servicios, $proyectos, $integrantes, $video, $telefono, $email, $idActualizar);
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
		$stmt = $conn->prepare("DELETE FROM spinoff WHERE idSpinoff = ? ");
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