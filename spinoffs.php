<?php 
try {
	require_once('includes/funciones/bd_conexion.php');
	$sql = "SELECT idSpinoff FROM spinoff;"; 
	if (!$result = $conn->query($sql)) {
		echo "Lo sentimos, este sitio web está experimentando problemas.";
		exit;
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

	<h2 class="text-light font-weight-light title">Spin-Offs</h2>

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
			$sql = "SELECT * FROM spinoff ORDER BY externoSpinoff DESC LIMIT " . $start_item . "," . $page_items;
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
			<?php while($spinoffs = $result->fetch_assoc()): ?>
				<?php if ($spinoffs['externoSpinoff'] == 0): ?>
					<div class="col-sm-6">
						<div class="card mb-4" id="<?php echo $spinoffs['nombreSpinoff']; ?>">
							<div class="image d-flex justify-content-center align-items-center">
								<img class="image" src="img/spinoffs/<?php echo $spinoffs["imagenSpinoff"]; ?>" alt="Card image cap">
							</div>
							<div class="card-body border-0">
								<h5 class="card-title mb-0"><?php echo $spinoffs['nombreSpinoff'];?></h5>
								<p class="text-muted text-truncate mb-0"><?php echo $spinoffs['giroSpinoff'];?></p>
								<span class="badge badge-pill badge-light mb-3" style="background-color: #ECECEC; color: graylight;">Interno</span>
								<div class="buttons">
									<button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#<?php echo $spinoffs['idSpinoff']; ?>">
										Ver spin-off
									</button>
									<a class="btn btn-outline-dark btn-sm" href="img/spinoffs/<?php echo $spinoffs["imagenSpinoff"]; ?>" target="_blank">
										Ver imagen
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php elseif ($spinoffs['externoSpinoff'] == 1): ?>
						<div class="col-sm-6">
							<div class="card text-dark mb-4 b-salient">
								<div class="image d-flex justify-content-center align-items-center">
									<img class="image" src="img/spinoffs/<?php echo $spinoffs["imagenSpinoff"]; ?>" alt="Card image cap">
								</div>
								<div class="card-body bg-salient border-0">
									<h5 class="card-title mb-0"><?php echo $spinoffs['nombreSpinoff'];?></h5>
									<p class="text-truncate mb-0"><?php echo $spinoffs['giroSpinoff'];?></p>
									<span class="badge badge-pill badge-light mb-3" style="background-color: #004D57; color: #13F485;">Externo</span>
									<div class="buttons">
										<button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#<?php echo $spinoffs['idSpinoff']; ?>">
											Ver spin-off
										</button>
										<a class="btn btn-outline-dark btn-sm" href="img/spinoffs/<?php echo $spinoffs["imagenSpinoff"]; ?>" target="_blank" >
											Ver imagen
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<!-- modal -->
					<div class="modal fade" id="<?php echo $spinoffs['idSpinoff']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel"><?php echo $spinoffs['nombreSpinoff']; ?></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<ul class="list-group">
										<li class="list-group-item">
											<h6>Giro</h6>
											<p><?php echo $spinoffs['giroSpinoff']; ?></p>
										</li>
										<li class="list-group-item">
											<h6>Descripción</h6>
											<p><?php echo str_replace("\n", "<br>", $spinoffs['descripcionSpinoff']); ?></p>
										</li>
										<li class="list-group-item">
											<h6>Servicios</h6>
											<p><?php echo str_replace("\n", "<br>", $spinoffs['serviciosSpinoff']); ?></p>
										</li>
										<li class="list-group-item">
											<h6>Proyectos</h6>
											<p><?php echo str_replace("\n", "<br>", $spinoffs['proyectosSpinoff']); ?></p>
										</li>
										<li class="list-group-item">
											<h6>Integrantes</h6>
											<p><?php echo str_replace("\n", "<br>", $spinoffs['integrantesSpinoff']); ?></p>
										</li>
										<?php if($spinoffs['videoSpinoff'] == null): ?>
											<?php else: ?>	
												<li class="list-group-item">
													<h6>Video</h6>
													<p><?php echo $spinoffs['videoSpinoff']; ?></p>
												</li>
											<?php endif; ?>
											<li class="list-group-item">
												<h6>Email</h6>
												<p><?php echo $spinoffs['emailSpinoff']; ?></p>
											</li>
											<li class="list-group-item">
												<h6>Teléfono</h6>
												<p><?php echo $spinoffs['telefonoSpinoff']; ?></p>
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
					<?php $url = "spinoffs.php"; ?>
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