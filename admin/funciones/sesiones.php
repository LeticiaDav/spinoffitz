<?php 
function autentificar_usuario() {
	if(!consigue_usuario()) {
		header('Location: login.php');
		exit();
	}
	$tiempo_inactivo = 900; // 15 minutos
	if (isset($_SESSION['tiempo_sesion'])) {
		$vida_sesion = time() - $_SESSION['tiempo_sesion'];
		if ($vida_sesion > $tiempo_inactivo) {
			session_destroy();
			header('Location: login.php');
		}
	}
	$_SESSION['tiempo_sesion'] = time();
}

function consigue_usuario() {
	return isset($_SESSION['usuario']);
}

session_start();
autentificar_usuario();
?>