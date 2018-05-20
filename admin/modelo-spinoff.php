<?php
include_once('funciones/funciones.php');

// CREAR

if ($_POST['registro'] == 'nuevo') {
	// $respuesta = array(
	// 	'post' => $_POST,
	// 	'file' => $_FILES
	// );
	// die(json_encode($respuesta));

	// declaracion de variables
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
	if (isset($_POST['externo'])) { // revisar el checkbox del formulario
		$externo = $_POST['externo'];
	} else {
		$externo = 0;
	}

	// restriccion de caracteres maximos en los campos
	if ((strlen($nombre) > 25) || (strlen($giro) > 40) || (strlen($giro) > 40) || (strlen($descripcion) > 2050) || (strlen($servicios) > 2050) || (strlen($proyectos) > 2050) || (strlen($integrantes) > 2050) || (strlen($video) > 60) || (strlen($telefono) > 10) || (strlen($email) > 40)) {
		$respuesta = array (
			'respuesta' => 'exceso'
		);
		die(json_encode($respuesta));
	}

	// sanitizar y validar email
	$email_s = filter_var($email, FILTER_SANITIZE_EMAIL);
	if (filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
		echo("$email es una dirección de email válida");
	} else {
		echo("$email NO es una dirección de email válida");
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

	// subir informacion a la base de datos
	try {
		$stmt = $conn->prepare("INSERT INTO spinoff(nombreSpinoff, giroSpinoff, descripcionSpinoff, serviciosSpinoff, proyectosSpinoff, integrantesSpinoff, imagenSpinoff, videoSpinoff, telefonoSpinoff, emailSpinoff, externoSpinoff) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssssssi", $nombre, $giro, $descripcion, $servicios, $proyectos, $integrantes, $imagen_url, $video, $telefono, $email, $externo);
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
	
	// declaracion de variables
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
	if (isset($_POST['externo'])) { // revisar el checkbox del formulario
		$externo = $_POST['externo'];
	} else {
		$externo = 0;
	}
	$idActualizar = $_POST['id_registro'];

	// restriccion de caracteres maximos en los campos
	if ((strlen($nombre) > 25) || (strlen($giro) > 40) || (strlen($giro) > 40) || (strlen($descripcion) > 2050) || (strlen($servicios) > 2050) || (strlen($proyectos) > 2050) || (strlen($integrantes) > 2050) || (strlen($video) > 60) || (strlen($telefono) > 10) || (strlen($email) > 40)) {
		$respuesta = array (
			'respuesta' => 'exceso'
		);
		die(json_encode($respuesta));
	}

	// subir un archivo de imagen
	if (!is_dir($directorio)) {
		mkdir($directorio, 0755, true);
	}
	if ($_FILES['archivo_imagen']['size'] > 0) {
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
			$stmt = $conn->prepare("UPDATE spinoff SET nombreSpinoff = ?, giroSpinoff = ?, descripcionSpinoff = ?, serviciosSpinoff = ?, proyectosSpinoff = ?, integrantesSpinoff = ?, imagenSpinoff = ?, videoSpinoff = ?, telefonoSpinoff = ?, emailSpinoff = ?, editadoSpinoff = NOW(), externoSpinoff = ? WHERE idSpinoff = ?");
			$stmt->bind_param("ssssssssssii", $nombre, $giro, $descripcion, $servicios, $proyectos, $integrantes, $imagen_url, $video, $telefono, $email, $externo, $idActualizar);
		} else { // sin imagen
			$stmt = $conn->prepare("UPDATE spinoff SET nombreSpinoff = ?, giroSpinoff = ?, descripcionSpinoff = ?, serviciosSpinoff = ?, proyectosSpinoff = ?, integrantesSpinoff = ?, videoSpinoff = ?, telefonoSpinoff = ?, emailSpinoff = ?, editadoSpinoff = NOW(), externoSpinoff = ? WHERE idSpinoff = ?");
			$stmt->bind_param("sssssssssii", $nombre, $giro, $descripcion, $servicios, $proyectos, $integrantes, $video, $telefono, $email, $externo, $idActualizar);
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
	$idEliminar = $_POST['id'];

	// base de datos
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
