<?php
try {
	require_once('includes/funciones/bd_conexion.php');
	// $sql = "SELECT * FROM noticia GROUP BY tituloNoticia ORDER BY fechaNoticia DESC LIMIT 6;";
	$sql = "SELECT * FROM noticia GROUP BY tituloNoticia ORDER BY fechaNoticia DESC;";
	if (!$result = $conn->query($sql)) {
		echo "Lo sentimos, este sitio esta experimentando problemas.";
		exit();
	}
	$result = $conn->query($sql);
	$conn->close();
} catch(Exception $e) {
	$error = $e->getMessaege();
}
?>

<?php include_once('includes/templates/header.php'); ?>

<main class="container">

	<h2 class="text-light font-weight-light title">Noticias</h2>

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

	<!-- <nav aria-label="Page navigation example">
		<ul class="pagination justify-content-center">
			<li class="page-item"><a class="page-link" href="#">Previous</a></li>
			<li class="page-item"><a class="page-link" href="#">1</a></li>
			<li class="page-item"><a class="page-link" href="#">2</a></li>
			<li class="page-item"><a class="page-link" href="#">3</a></li>
			<li class="page-item"><a class="page-link" href="#">Next</a></li>
		</ul>
	</nav> -->

</main>

<?php include_once('includes/templates/footer.php'); ?>
