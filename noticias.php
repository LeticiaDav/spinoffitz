<?php
try {
	require_once('includes/funciones/bd_conexion.php');
	$sql = "SELECT idNoticia FROM noticia;";
	if (!$result = $conn->query($sql)) {
		echo "Lo sentimos, este sitio esta experimentando problemas.";
		exit();
	}
	$result = $conn->query($sql);
	$total_items = mysqli_num_rows($result); // conseguir total de registros en la bd
	$result->free();
} catch(Exception $e) {
	$error = $e->getMessaege();
}
?>

<?php include_once('includes/templates/header.php'); ?>

<main class="container">

	<h2 class="text-light font-weight-light title">Noticias</h2>

	<?php if ($total_items > 0): ?>
		
		<?php
		// numero de elementos a mostrar por pagina
		$page_items = 6;
		// numero de pagina
		$page = false; 
		//examino la pagina a mostrar y el inicio del registro a mostrar
		if (isset($_GET["page"])) {
			$page = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT);
		}
		// verifica si aun no existe la variable page
		if (!$page) {
			$start_item = 0;
			$page = 1;
		} else {
			$start_item = ($page - 1) * $page_items;
		}
		// calcular el total de paginas (con redondeo)
		$total_pages = ceil($total_items / $page_items); 
		// extraer datos delimitados segun los elementos por pagina
		try {
			$sql = "SELECT * FROM noticia ORDER BY fechaNoticia DESC LIMIT " . $start_item . "," . $page_items;
			if (!$result = $conn->query($sql)) {
				echo "Lo sentimos, este sitio web está experimentando problemas.";
				exit;
			}
			$result = $conn->query($sql);
			$conn->close();
		} catch(Exception $e) {
			$error = $e->getMessaege();
		}
		?>

		<div class="row cards">
			<?php while($noticias = $result->fetch_assoc()): ?>
				<?php 
				setlocale(LC_TIME, 'es_ES.UTF-8');
				setlocale(LC_TIME, 'spanish');
				$fechaNoticia = utf8_encode(strftime("%d de %B del %Y", strtotime($noticias['fechaNoticia'])));
				?>
				<div class="col-sm-4">
					<div class="card mb-4">
						<?php if($noticias['imagenNoticia'] == null): ?>
							<?php else: ?>
								<div class="image d-flex justify-content-center align-items-center">
									<img class="image" src="img/noticias/<?php echo $noticias["imagenNoticia"]; ?>" alt="Card image cap">
								</div>
							<?php endif; ?>
							<div class="card-body">
								<h5 class="card-title"><?php echo $noticias['tituloNoticia']; ?></h5>
								<p class="card-text text-truncate"><?php echo $fechaNoticia; ?></p>
								<div class="buttons_3card">
									<button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#<?php echo $noticias['idNoticia']; ?>">
										Ver noticia
									</button>
									<a class="btn btn-outline-secondary btn-sm" href="img/noticias/<?php echo $noticias["imagenNoticia"]; ?>" target="_blank" >
										Ver imagen
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- modal -->
					<div class="modal fade" id="<?php echo $noticias['idNoticia']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel"><?php echo $noticias['tituloNoticia']; ?></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<ul class="list-group">
										<li class="list-group-item">
											<h6><?php echo $fechaNoticia; ?></h6>
											<p><?php echo str_replace("\n", "<br>", $noticias['cuerpoNoticia']); ?></p>
										</li>
										<li class="list-group-item">
											<h6>Fuente</h6>
											<p><?php echo $noticias['fuenteNoticia']; ?></p>
										</li>
									</ul>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<?php $result->free(); ?>
			</div>

			<!-- PAGINACION -->
			<?php if ($total_pages > 1): ?>
				<?php $url = "noticias.php"; ?>
				<nav aria-label="navigation" class="mt-4">
					<ul class="pagination justify-content-center">
						<!-- anterior -->
						<?php if ($page != 1): ?>
							<li class="page-item">
								<a class="page-link" href="<?= $url.'?page='.($page-1); ?>" tabindex="-1">Anterior</a>
							</li>
						<?php endif ?>
						<!-- indice -->
						<?php for ($i=1;$i<=$total_pages;$i++): ?> 
							<?php if ($page == $i): ?>
								<li class="page-item disabled"><a class="page-link" href="#"><?= $page ?></a></li>
								<?php else: ?>
									<li class="page-item"><a class="page-link" href="<?= $url.'?page='.$i ?>"><?= $i ?></a></li>
								<?php endif; ?>
							<?php endfor; ?>
							<!-- siguiente -->
							<?php if ($page != $total_pages): ?>
								<li class="page-item bg-transparent">
									<a class="page-link" href="<?= $url.'?page='.($page+1) ?>">Siguiente</a>
								</li>
							<?php endif ?>
						</ul>
					</nav>
				<?php endif; ?>

			<?php endif; ?>

		</main>

		<?php include_once('includes/templates/footer.php'); ?>
