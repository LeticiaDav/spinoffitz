<?php 
include_once('funciones/funciones.php');

// CREAR

if ($_POST['registro'] == 'nuevo') {
	$usuario = $_POST['usuario'];
	$nombre = $_POST['nombre'];
	$clave = $_POST['password'];
	$opciones = array(
		'cost' => 12
	);
	$claveHash = password_hash($clave, PASSWORD_BCRYPT, $opciones);
	try {
		$stmt = $conn->prepare("INSERT INTO admin(usuarioAdmin, nombreAdmin, claveAdmin, editadoAdmin) VALUES (?, ?, ?, NOW())");
		$stmt->bind_param("sss", $usuario, $nombre, $claveHash);
		$stmt->execute();
		$idCrear = $stmt->insert_id;
		if ($idCrear > 0) {
			$respuesta = array (
				'respuesta' => 'exito',
				'id_admin' => $idCrear
			);
		} else {
			$respuesta = array (
				'respuesta' => 'error'
			);
		}
		$stmt->close();
		$conn->close();
	} catch(Exception $e) {
		echo "Error: " . $e->getMessage();
	}
	die(json_encode($respuesta));
}

// ACTUALIZAR

if ($_POST['registro'] == 'actualizar') {
	$usuario = $_POST['usuario'];
	$nombre = $_POST['nombre'];
	$clave = $_POST['password'];
	$idActualizar = $_POST['id_registro'];
	try {
		if (empty($_POST['password'])) {
			$stmt = $conn->prepare("UPDATE admin SET usuarioAdmin = ?, nombreAdmin = ?, editadoAdmin = NOW() WHERE idAdmin = ?");
			$stmt->bind_param("ssi", $usuario, $nombre, $idActualizar);
		} else {
			$opciones = array(
				'cost' => 12
			);
			$hashClave = password_hash($clave, PASSWORD_BCRYPT, $opciones);
			$stmt = $conn->prepare("UPDATE admin SET usuarioAdmin = ?, nombreAdmin = ?, claveAdmin = ?, editadoAdmin = NOW() WHERE idAdmin = ?");
			$stmt->bind_param("sssi", $usuario, $nombre, $hashClave, $idActualizar);
		}
		$stmt->execute();
		if ($stmt->affected_rows) {
			$respuesta = array(
				'respuesta' => 'exito',
				'id_actualizado' => $stmt->insert_id
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
		$stmt = $conn->prepare("DELETE FROM admin WHERE idAdmin = ? ");
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