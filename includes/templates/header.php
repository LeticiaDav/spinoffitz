<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Spin-Off ITZ</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
        <link rel="apple-touch-icon" href="icon.png">
        <link rel="shortcut icon" href="favicon.ico">

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      	rel="stylesheet">
      	<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Barlow:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Barlow+Semi+Condensed:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

      	<?php 
			$archivo = basename($_SERVER['PHP_SELF']);
			$pagina = str_replace(".php", "", $archivo);
			// if ($pagina == 'invitados' || $pagina == 'index') {
			// 	echo '<link rel="stylesheet" href="css/colorbox.css">';
			// } else if($pagina == 'conferencia') {
			// 	echo '<link rel="stylesheet" href="css/lightbox.css">';
			// }
		?>

    	<link rel="stylesheet" href="css/colorbox.css">
    	<link rel="stylesheet" href="css/main.css">
    </head>
    <body class="<?php echo $pagina ?>">
        
        <!-- Hero -->
		<!-- <div class="site-header">
			<div class="hero">
				<div class="contenido-header">
					<a href="http://mapaches3.itz.edu.mx/itz_rg/" target="_blank">
						<img src="img/itz_alt.png" class="itz" alt="Logo del ITZ">
					</a>
					<br><br>
					<img src="img/logo_blanco.png" class="logo" alt="Logo de Spin-Off ITZ">
					<br><br><i class="material-icons">keyboard_arrow_down</i>
				</div>
			</div>
		</div> -->

		<!-- Barra -->
		<div class="barra" id="barra">
			<div class="contenedor clearfix">
				<div class="logo">
					<img src="img/logo_simple.png" alt="Logo de Spin-Off ITZ">
				</div>
				<div class="menu-movil">
					<span></span>
					<span></span>
					<span></span>
				</div>
				<nav class="navegacion-principal clearfix">
					<a href="index.php">Inicio</a>
					<a href="spinoffs.php">Spin-Offs del ITZ</a>
					<a href="noticias.php">Noticias</a>
					<a href="eventos.php">Eventos</a>
					<a href="buscar.php">Buscar</a>
				</nav>
			</div>
		</div>