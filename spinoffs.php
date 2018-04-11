<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
        <link rel="apple-touch-icon" href="icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      	rel="stylesheet">
      	<link href="https://fonts.googleapis.com/css?family=Abel|Hind|Roboto|Roboto+Condensed|Rajdhani:300,400,500,600,700|Khand:400,500,600,700|Barlow:100,100i,200,200i,300,300i,400,400i,500i,600,600i,700,700i,800,800i,900,900i|Barlow+Semi+Condensed:100,100i,200,200i,300,300i,400,400i,500i,600,600i,700,700i,800,800i,900,900i|Barlow+Condensed:100,100i,200,200i,300,300i,400,400i,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    	<link rel="stylesheet" href="css/colorbox.css">
    	<link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        
        <!-- Hero -->
		<div class="site-header">
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
		</div>

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
					<a class="activo" href="spinoffs.php">Spin-Offs del ITZ</a>
					<a href="noticias.html">Noticias</a>
					<a href="eventos.html">Eventos</a>
				</nav>
			</div>
		</div>
		
		<!-- Contenido principal -->
		<div class="clearfix">
			<div class="main">
				<section class="contenedor">
					<h2>Spin-offs del ITZ</h2>
					<?php 
					try {
						require_once('includes/funciones/bd_conexion.php');
						$sql = "SELECT idSpinoff, nombreSpinoff, giroSpinoff, descripcionSpinoff, serviciosSpinoff, proyectosSpinoff, integrantesSpinoff, emailSpinoff, telefonoSpinoff, imagenSpinoff, videoSpinoff "; 
						$sql .= "FROM spinoff ";
						if (!$resultado = $conn->query($sql)) {
							echo "Lo sentimos, este sitio web está experimentando problemas.";
							 // De nuevo, no hacer esto en un sitio público
							echo "Error: La ejecución de la consulta falló debido a: \n";
							echo "Query: " . $sql . "\n";
							echo "Errno: " . $mysqli->errno . "\n";
							echo "Error: " . $mysqli->error . "\n";
							exit;
						}
						$resultado = $conn->query($sql);
					} catch(Exception $e) {
						$error = $e->getMessaege();
					}
					?>

					
					<section class="spinoffs_contenedor">
						<?php while($spinoffs = $resultado->fetch_assoc()) { ?>
							<a class="spinoff-info" href="#spinoff<?php echo $spinoffs['idSpinoff']; ?>">
								<div class="tarjeta">
									<div class="tarjeta-info">
											<!-- Nombre -->
											<p class="nombre">
												<?php echo $spinoffs['nombreSpinoff']; ?>	
											</p>
									</div>
								</div>
							</a>
							<div style="display: none;">
								<div class="spinoff-info" id="spinoff<?php echo $spinoffs['idSpinoff']; ?>">
									<div class="tarjeta-info">
										<!-- Nombre -->
										<p class="nombre">
											<?php echo $spinoffs['nombreSpinoff']; ?>	
										</p>
										<!-- Giro -->
										<p class="giro">
											<?php echo $spinoffs['giroSpinoff']; ?>
										</p>
										<hr>
										<!-- Descripcion -->
										<h1>Descripción</h1>
										<p class="descripcion">
											<?php echo $spinoffs['descripcionSpinoff']; ?>
										</p>
										<!-- Servicios -->
										<h1>Servicios</h1>
										<p class="servicios">
											<?php echo str_replace("\n", "<br>", $spinoffs['serviciosSpinoff']); ?>
										</p>
										<!-- Proyectos -->
										<h1>Proyectos</h1>
										<p class="proyectos">
											<?php echo str_replace("\n", "<br>", $spinoffs['proyectosSpinoff']); ?>
										</p>
										<!-- Integrantes -->
										<h1>Integrantes</h1>
										<p class="integrantes">
											<?php echo str_replace("\n", "<br>", $spinoffs['integrantesSpinoff']); ?>
										</p>
										<!-- Video -->
										<?php if ($spinoffs['videoSpinoff']==null) { ?>
										<?php } else { ?>	
											<h1>Video</h1>
											<iframe class="video" src="<?php echo $spinoffs['videoSpinoff'] ?>" frameborder="0" allowfullscreen></iframe>
										<?php } ?>
										<hr>
										<!-- Email -->
										<p class="email"><span>Email: </span><?php echo $spinoffs['emailSpinoff']; ?>
										</p>
										<!-- Telefono -->
										<p class="telefono"><span>Teléfono: </span><?php echo $spinoffs['telefonoSpinoff']; ?>
										</p>
									</div>
								</div>
							</div>
						<?php } ?>
					</section>

						<?php  
						// El script automáticamente liberará el resultado y cerrará la conexión a MySQL
						$resultado->free();
						$conn->close();
						?>
					<!-- Otro spin-off -->
					<div class="tarjeta">
						<div class="tarjeta-info">
							<p class="giro">Más proximamente...</p>
						</div>
					</div>


				</section>
			</div>
			<div class="derecho">
			</div>
		</div>

 		<!-- Footer -->
		<footer class="site-footer">
			<div class="contenedor clearfix">
				<div class="footer-info">
					<img class="spo" src="img/logo_azul_chico.png" class="logo" alt="Logo de Spin-Off ITZ">
				</div>
				<div class="footer-logo">
					<a href="http://mapaches3.itz.edu.mx/itz_rg/" target="_blank">
						<img src="img/itz.png" class="itz" alt="Logo del ITZ">
					</a>
				</div>
			</div>
			<div class="copyright">
				<div class="contenedor">
					<p>
						<!-- <a href="https://icons8.com">Iconos por <span>Icons8</span></a><br> -->
						Todos los derechos reservados <span>~ Worktecs 2018</span>
					</p>
				</div>
			</div>
			
		</footer>


        <!-- Archivos JavaScript -->
        <script src="js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.2.1.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
        <script src="js/jquery.colorbox-min.js"></script>

        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    </body>
</html>