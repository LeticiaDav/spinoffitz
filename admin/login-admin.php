<?php

if (isset($_POST['login-admin'])) {
	$usuario = $_POST['usuario'];
	$clave = $_POST['password'];
	try {
		include_once('funciones/funciones.php');
		$stmt = $conn->prepare("SELECT * FROM admin WHERE usuarioAdmin = ?;");
		$stmt->bind_param("s", $usuario);
		$stmt->execute();
		$stmt->bind_result($idAdmin, $usuarioAdmin, $nombreAdmin, $claveAdmin, $editadoAdmin, $nivelAdmin);
		if ($stmt->affected_rows) {
			$existe = $stmt->fetch();
			if ($existe) {
				if (password_verify($clave, $claveAdmin)) {
					session_start();
					$_SESSION['id'] = $idAdmin;
					$_SESSION['usuario'] = $usuarioAdmin;
					$_SESSION['nombre'] = $nombreAdmin;
					$_SESSION['nivel'] = $nivelAdmin;
					$respuesta = array(
						'respuesta' => 'exitoso',
						'usuario' => $nombreAdmin
					);
				} else {
					$respuesta = array(
						'respuesta' => 'error'
					);
				}
			} else {
				$respuesta = array(
					'respuesta' => 'error'
				);
			}
		}
		$stmt->close();
		$conn->close();
	} catch (Exception $e) {
		echo "Error: " . $e->getMessage();
	}
	die(json_encode($respuesta));
}

?>