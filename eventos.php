<?php include_once 'includes/templates/header.php'; ?>
		
		<!-- Contenido principal -->
		<div class="clearfix">
			<div class="main">
				<section class="contenedor">
					<h2>Eventos</h2>
					<?php 
					try {
						require_once('includes/funciones/bd_conexion.php');
						$sql = "SELECT * "; 
						$sql .= "FROM `evento` ";
						$sql .= "GROUP BY `tituloEvento` ";
						$sql .= "ORDER BY `inicioEvento` DESC;";
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
						<?php while($eventos = $resultado->fetch_assoc()) { ?>
							<a class="evento-info" href="#evento<?php echo $eventos['idEvento']; ?>">
								<div class="tarjeta">
									<div class="tarjeta-info">
										<!-- Nombre -->
										<p class="nombre">
											<?php echo $eventos['tituloEvento']; ?>	
										</p>
										<p class="tarjeta-fecha">
											<?php echo $eventos['inicioEvento']; ?> ~ <?php echo $eventos['finEvento']; ?> 
										</p>
									</div>
								</div>
							</a>
							<div style="display: none;">
								<div class="evento-info" id="evento<?php echo $eventos['idEvento']; ?>">
									<div class="tarjeta-info">
										<!-- Nombre -->
										<p class="nombre">
											<?php echo $eventos['tituloEvento']; ?>	
										</p>
										<!-- Giro -->
										<p class="giro">
											<?php echo $eventos['inicioEvento']; ?> ~ <?php echo $eventos['finEvento']; ?><br>
											<?php echo $eventos['lugarEvento']; ?>
										</p>
										<hr>
										<!-- Descripcion -->
										<p class="descripcion">
											<?php echo $eventos['cuerpoEvento']; ?>
										</p>
										<hr>
										<!-- Email -->
										<p class="email">
											<span>Contacto: </span><?php echo $eventos['contactoEvento']; ?>
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
						Todos los derechos reservados ~ Worktecs 2018
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