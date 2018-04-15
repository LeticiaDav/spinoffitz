<?php include_once 'includes/templates/header.php'; ?>
		
		<!-- Contenido principal -->
		<div class="clearfix">
			<div class="main">
				<section class="contenedor">
					<h2>Noticias</h2>
					<?php 
					try {
						require_once('includes/funciones/bd_conexion.php');
						$sql = "SELECT * "; 
						$sql .= "FROM `noticia` ";
						$sql .= "GROUP BY `tituloNoticia` ";
						$sql .= "ORDER BY `fechaNoticia` DESC;";
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
						<?php while($noticias = $resultado->fetch_assoc()) { ?>
							<a class="noticia-info" href="#noticia<?php echo $noticias['idNoticia']; ?>">
								<div class="tarjeta">
									<div class="tarjeta-info">
										<!-- Nombre -->
										<p class="nombre">
											<?php echo $noticias['tituloNoticia']; ?>	
										</p>
										<p class="tarjeta-fecha">
											<?php echo $noticias['fechaNoticia']; ?>
										</p>
									</div>
								</div>
							</a>
							<div style="display: none;">
								<div class="noticia-info" id="noticia<?php echo $noticias['idNoticia']; ?>">
									<div class="tarjeta-info">
										<!-- Nombre -->
										<p class="nombre">
											<?php echo $noticias['tituloNoticia']; ?>	
										</p>
										<!-- Giro -->
										<p class="giro">
											<?php echo $noticias['fechaNoticia']; ?>
										</p>
										<hr>
										<!-- Descripcion -->
										<p class="descripcion">
											<?php echo $noticias['cuerpoNoticia']; ?>
										</p>
										<hr>
										<!-- Email -->
										<p class="email"><span>Fuente: </span><?php echo $noticias['fuenteNoticia']; ?>
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