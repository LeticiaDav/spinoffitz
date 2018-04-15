<?php 
	$conn = new mysqli('localhost', 'hperez', 'hperez123', 'spinoffitz');
	if ($conn->connect_errno) {
	    // La conexión falló.
	    // No se debe revelar información delicada
		echo "Lo sentimos, este sitio web está experimentando problemas.";
	    // Algo que no se debería de hacer en un sitio público, de todas formas, es imprimir información relacionada con errores de MySQL 
		// echo "Error: Fallo al conectarse a MySQL debido a: \n";
		// echo "Errno: " . $mysqli->connect_errno . "\n";
		// echo "Error: " . $mysqli->connect_error . "\n";
	    // Podría ser conveniente mostrar algo interesante, aunque nosotros simplemente saldremos
		exit;
	}

	mysqli_set_charset($conn,"utf8");
?>