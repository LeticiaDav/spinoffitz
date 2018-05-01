<?php 
include_once('funciones/funciones.php');

// CREAR

if ($_POST['registro'] == 'nuevo') {
	// $respuesta = array(
	// 	'post' => $_POST,
	// 	'file' => $_FILES
	// );
	// die(json_encode($respuesta));
	$titulo = $_POST['titulo_noticia'];
	$fecha = $_POST['fecha_noticia'];
	$fecha_f = date('Y-m-d', strtotime($fecha));
	$cuerpo = $_POST['cuerpo_noticia'];
	$fuente = $_POST['fuente_noticia'];
	$directorio = "../img/noticias/";
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
	$titulo = $_POST['titulo_noticia'];
	$fecha = $_POST['fecha_noticia'];
	$fecha_f = date('Y-m-d', strtotime($fecha));
	$cuerpo = $_POST['cuerpo_noticia'];
	$fuente = $_POST['fuente_noticia'];
	$directorio = "../img/noticias/";
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
			$stmt = $conn->prepare("UPDATE noticia SET tituloNoticia = ?, fechaNoticia = ?, cuerpoNoticia = ?, fuenteNoticia = ?, imagenNoticia = ?, editadoNoticia = NOW() WHERE idNoticia = ?");
			$stmt->bind_param("sssssi", $titulo, $fecha_f, $cuerpo, $fuente, $imagen_url, $idActualizar);
		} else {
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