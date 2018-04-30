<?php include_once 'includes/templates/header.php'; ?>

<main class="container d-flex align-items-center">

	<div class="opciones">
		<div class="index-image">
			<img src="img/logo_blanco.png" class="logo" alt="Logo de Spin-Off ITZ"><br>
		</div>
		<!-- cards -->
		<div class="card-deck text-light">
			<div class="card bg-transparent">
				<div class="card-body">
					<h5 class="card-title">Spin-Offs</h5>
					<p class="card-text">Empresas creadas en el laboratorio de desarrollo de software del ITZ.</p>					
				</div>
				<div class="card-footer">
					<a href="spinoffs.php" class="btn btn-light btn-sm">Entrar</a>
				</div>
			</div>
			<div class="card bg-transparent">
				<div class="card-body">
					<h5 class="card-title">Noticias</h5>
					<p class="card-text">Últimas noticias de interes para los spin-offs.</p>
				</div>
				<div class="card-footer">
					<a href="noticias.php" class="btn btn-light btn-sm">Entrar</a>
				</div>
			</div>

			<div class="card bg-transparent">
				<div class="card-body">
					<h5 class="card-title">Eventos</h5>
					<p class="card-text">Fechas de eventos para los spin-offs.</p>
				</div>
				<div class="card-footer">
					<a href="eventos.php" class="btn btn-light btn-sm">Entrar</a>
				</div>
			</div>

		</div>
	</div>

</main>

<?php include_once 'includes/templates/footer.php'; ?>