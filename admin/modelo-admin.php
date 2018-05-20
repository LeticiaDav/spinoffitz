<?php 
include_once('funciones/funciones.php');

// CREAR

if ($_POST['registro'] == 'nuevo') {

	// sanitizar el metodo post
	$formulario = filter_var_array($_POST, FILTER_SANITIZE_STRING);

	// declaracion de variables
	$usuario = $formulario['usuario'];
	$nombre = $formulario['nombre'];
	$clave = $formulario['password'];
	if (isset($_POST['nivel'])) {
		$nivel = $_POST['nivel'];
	} else {
		$nivel = 0;
	}

	// restriccion de caracteres maximos en los campos
	if ((strlen($usuario) > 50) || (strlen($nombre) > 100) || (strlen($clave) > 20)) {
		$respuesta = array (
			'respuesta' => 'exceso'
		);
		die(json_encode($respuesta));
	}

	// hashear la contraeña
	$opciones = array(
		'cost' => 12
	);
	$claveHash = password_hash($clave, PASSWORD_BCRYPT, $opciones);

	// base de datos
	try {
		$stmt = $conn->prepare("INSERT INTO admin(usuarioAdmin, nombreAdmin, claveAdmin, editadoAdmin, nivelAdmin) VALUES (?, ?, ?, NOW(), ?)");
		$stmt->bind_param("sssi", $usuario, $nombre, $claveHash, $nivel);
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

	// sanitizar el metodo post
	$formulario = filter_var_array($_POST, FILTER_SANITIZE_STRING);

	// declaracion de variables
	$usuario = $formulario['usuario'];
	$nombre = $formulario['nombre'];
	$clave = $formulario['password'];
	if (isset($_POST['nivel'])) {
		$nivel = $_POST['nivel'];
	} else {
		$nivel = 0;
	}
	$idActualizar = filter_var($_POST['id_registro'], FILTER_SANITIZE_NUMBER_INT);

	// restriccion de caracteres maximos en los campos
	if ((strlen($usuario) > 50) || (strlen($nombre) > 100) || (strlen($clave) > 20)) {
		$respuesta = array (
			'respuesta' => 'exceso'
		);
		die(json_encode($respuesta));
	}

	// base de datos
	try {
		if (empty($_POST['password'])) {
			$stmt = $conn->prepare("UPDATE admin SET usuarioAdmin = ?, nombreAdmin = ?, editadoAdmin = NOW(), nivelAdmin = ? WHERE idAdmin = ?");
			$stmt->bind_param("ssii", $usuario, $nombre, $nivel, $idActualizar);
		} else {
			$opciones = array(
				'cost' => 12
			);
			$hashClave = password_hash($clave, PASSWORD_BCRYPT, $opciones);
			$stmt = $conn->prepare("UPDATE admin SET usuarioAdmin = ?, nombreAdmin = ?, claveAdmin = ?, editadoAdmin = NOW(), nivelAdmin = ? WHERE idAdmin = ?");
			$stmt->bind_param("sssii", $usuario, $nombre, $hashClave, $nivel, $idActualizar);
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
	
	// declaracion de variables
	$idEliminar = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

	// base de datos
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