<?php 
try {
	require_once('includes/funciones/bd_conexion.php');
	$sql = "SELECT * FROM spinoff"; 
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

<?php include_once('includes/templates/header.php'); ?>

<main class="container">

	<h2 class="text-light font-weight-light title">Spin-Offs</h2>

	<div class="row">
		<?php while($spinoffs = $result->fetch_assoc()): ?>
			<div class="col-sm-6">
				<div class="card">
					<div class="image d-flex justify-content-center align-items-center">
						<img class="image" src="img/spinoffs/<?php echo $spinoffs["imagenSpinoff"]; ?>" alt="Card image cap">
					</div>
					<div class="card-body">
						<h5 class="card-title"><?php echo $spinoffs['nombreSpinoff'];?></h5>
						<p class="card-text text-truncate"><?php echo $spinoffs['giroSpinoff'];?></p>
						<button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#<?php echo $spinoffs['idSpinoff']; ?>">
							Ver información
						</button>
					</div>
				</div>
			</div>
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
										<iframe class="video" src="<?php echo $spinoffs['videoSpinoff'] ?>" frameborder="0" allowfullscreen></iframe>
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

</main>

<?php include_once('includes/templates/footer.php'); ?>