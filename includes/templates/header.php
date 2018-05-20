<!doctype html>
<html class="no-js" lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="manifest" href="site.webmanifest">
	<link rel="apple-touch-icon" href="icon.png">
	<link rel="shortcut icon" href="favicon.ico">
	<!-- normalize -->
	<link rel="stylesheet" href="css/normalize.css">
	<!-- boostrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<?php 
	$archivo = basename($_SERVER['PHP_SELF']);
	$pagina = str_replace(".php", "", $archivo);
	?>

	<title><?php echo ucfirst($pagina); ?> • Spin-Off ITZ</title>

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
		<header>
			<nav class="navbar navbar-expand-md navbar-light fixed-top container">
				<a class="navbar-brand" href="index.php">
					<img src="img/logo_simple.png" alt="Logo de Spin-Off ITZ">
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarText">
					<ul class="navbar-nav w-100">
						<li class="nav-item p-2">
							<a class="nav-link" href="index.php">Inicio</a>
						</li>
						<li class="nav-item p-2">
							<a class="nav-link" href="spinoffs.php">Spin-Offs</a>
						</li>
						<li class="nav-item p-2">
							<a class="nav-link" href="noticias.php">Noticias</a>
						</li>
						<li class="nav-item p-2">
							<a class="nav-link" href="eventos.php">Eventos</a>
						</li>
						<li class="nav-item p-2">
							<a class="nav-link" href="buscar.php">Buscar</a>
						</li>
						<li class="nav-item p-2">
							<a class="nav-link" href="admin/login.php">Acceder</a>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<!-- <div class="barra" id="barra">
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
		</div> -->