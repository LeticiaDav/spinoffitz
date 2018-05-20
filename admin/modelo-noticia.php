<?php 
include_once('funciones/funciones.php');

// declaracion de variables
$titulo = $_POST['titulo_noticia'];
$fecha = $_POST['fecha_noticia'];
$fecha_f = date('Y-m-d', strtotime($fecha));
$cuerpo = $_POST['cuerpo_noticia'];
$fuente = $_POST['fuente_noticia'];
$directorio = "../img/noticias/";

// CREAR

if ($_POST['registro'] == 'nuevo') {
	// restriccion de caracteres maximos en los campos
	if ((strlen($titulo) > 120) || (strlen($cuerpo) > 2050) || (strlen($fuente) > 80)) {
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
		$stmt = $conn->prepare("INSERT INTO noticia(tituloNoticia, fechaNoticia, cuerpoNoticia, fuenteNoticia, imagenNoticia) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("sssss", $titulo, $fecha_f, $cuerpo, $fuente, $imagen_url);
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
	$idActualizar = $_POST['id_registro'];

	// restriccion de caracteres maximos en los campos
	if ((strlen($titulo) > 120) || (strlen($cuerpo) > 2050) || (strlen($fuente) > 80)) {
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
			$stmt = $conn->prepare("UPDATE noticia SET tituloNoticia = ?, fechaNoticia = ?, cuerpoNoticia = ?, fuenteNoticia = ?, imagenNoticia = ?, editadoNoticia = NOW() WHERE idNoticia = ?");
			$stmt->bind_param("sssssi", $titulo, $fecha_f, $cuerpo, $fuente, $imagen_url, $idActualizar);
		} else { // sin imagen
			$stmt = $conn->prepare("UPDATE noticia SET tituloNoticia = ?, fechaNoticia = ?, cuerpoNoticia = ?, fuenteNoticia = ?, editadoNoticia = NOW() WHERE idNoticia = ?");
			$stmt->bind_param("ssssi", $titulo, $fecha_f, $cuerpo, $fuente, $idActualizar);
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

	//base de datos
	try {
		$stmt = $conn->prepare("DELETE FROM noticia WHERE idNoticia = ? ");
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