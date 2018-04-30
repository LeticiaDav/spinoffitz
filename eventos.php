<?php 
try {
	require_once('includes/funciones/bd_conexion.php');
	$sql = "SELECT * FROM evento GROUP BY tituloEvento ORDER BY inicioEvento DESC;";
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

	<h2 class="text-light font-weight-light title">Eventos</h2>

	<div class="row">
		<?php while($eventos = $result->fetch_assoc()): ?>
			<?php 
			setlocale(LC_TIME, 'es_ES.UTF-8');
			setlocale(LC_TIME, 'spanish');
			$inicioEvento = utf8_encode(strftime("%A, %d de %B del %Y", strtotime($eventos['inicioEvento'])));
			$finEvento = utf8_encode(strftime("%A, %d de %B del %Y", strtotime($eventos['finEvento'])));
			?>
			<div class="col-sm-6">
				<div class="card">
					<div class="image d-flex justify-content-center align-items-center">
						<img class="image" src="img/eventos/<?php echo $eventos["imagenEvento"]; ?>" alt="Card image cap">
					</div>
					<div class="card-body">
						<h5 class="card-title"><?php echo $eventos['tituloEvento'];?></h5>
						<p class="card-text text-truncate"><?php echo $inicioEvento; ?></p>
						<button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#<?php echo $eventos['idEvento']; ?>">
							Ver información
						</button>
					</div>
				</div>
			</div>
			<!-- modal -->
			<div class="modal fade" id="<?php echo $eventos['idEvento']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><?php echo $eventos['tituloEvento']; ?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<ul class="list-group">
								<li class="list-group-item">
									<h6>Fechas</h6>
									<p>Inicia: <?php echo $inicioEvento; ?></p>
									<p>Termina: <?php echo $finEvento; ?></p>
								</li>
								<li class="list-group-item">
									<h6>Evento</h6>
									<p><?php echo str_replace("\n", "<br>", $eventos['cuerpoEvento']); ?></p>
								</li>
								<li class="list-group-item">
									<h6>Lugar</h6>
									<p><?php echo $eventos['lugarEvento']; ?></p>
								</li>
								<li class="list-group-item">
									<h6>Contacto</h6>
									<p><?php echo $eventos['contactoEvento']; ?></p>
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