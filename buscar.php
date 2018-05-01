<?php
function conectar(){
	GLOBAL $conexion;
	$conexion = new mysqli('localhost', 'hperez', 'hperez123', 'spinoffitz');
	if ($conexion->connect_errno) {
		echo "Lo sentimos, este sitio web está experimentando problemas.";
		exit;
	}
	mysqli_set_charset($conexion, "utf8");
}
function desconectar(){
	$conexion->close();
}
if($_POST) {
	$seleccion = $_POST['seleccion'];
	$busqueda = trim($_POST['buscar']);
	conectar();
	switch ($seleccion) {
		case 1: $sql = "SELECT * FROM spinoff WHERE nombreSpinoff LIKE '%" .$busqueda. "%' ORDER BY nombreSpinoff;";
		break;
		case 2: $sql = "SELECT * FROM noticia WHERE tituloNoticia LIKE '%" .$busqueda. "%' ORDER BY tituloNoticia;";
		break;
		case 3: $sql = "SELECT * FROM evento WHERE tituloEvento LIKE '%" .$busqueda. "%' ORDER BY tituloEvento";
		break;
		default:
		desconectar();
		break;
	}
	$resultado = $conexion->query($sql);
	$conexion->close();
}
?>

<?php include_once('includes/templates/header.php'); ?>

<main class="container">

	<h2 class="text-light font-weight-light title">Buscar</h2>

	<div class="row search">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<form id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
						<div class="input-group">
							<div class="input-group-prepend">
								<select class="form-control form-control" name="seleccion">
									<?php if (isset($_POST['buscar'])): ?>
										<option value="1" <?php if ($_POST['seleccion'] == 1) echo 'selected="selected"'; ?>>Spin-Offs</option>
										<option value="2" <?php if ($_POST['seleccion'] == 2) echo 'selected="selected"'; ?>>Noticias</option>
										<option value="3" <?php if ($_POST['seleccion'] == 3) echo 'selected="selected"'; ?>>Eventos</option>
									<?php else: ?>
										<option value="1">Spin-Offs</option>
										<option value="2">Noticias</option>
										<option value="3">Eventos</option>
									<?php endif; ?>
								</select>
							</div>
							<input id="buscar" name="buscar" type="search" class="form-control" placeholder="Buscar..." aria-label="Buscar" aria-describedby="basic-addon2" autofocus required="required">
							<div class="input-group-append">
								<button type="submit" name="buscador" class="btn btn-outline-secondary" type="button">Buscar</button>
							</div>
						</div>
					</form>
				</div>
				<div class="card-body">
					<ul class="list-group list-group-flush">
						<?php if (isset($_POST['buscar'])): ?>
							<?php if ($seleccion == 1):  ?>
								<?php while ($resultados = $resultado->fetch_assoc()): ?>
									<li class="list-group-item">
										<a href="spinoffs.php"><?php echo $resultados['nombreSpinoff']; ?></a><br>
										<small><?php echo $resultados['descripcionSpinoff']; ?></small>
									</li>
								<?php endwhile; ?>
							<?php endif; ?>
							<?php if ($seleccion == 2):  ?>
								<?php while ($resultados = $resultado->fetch_assoc()): ?>
									<li class="list-group-item">
										<a href="noticias.php"><?php echo $resultados['tituloNoticia']; ?></a><br>
										<small><?php echo $resultados['cuerpoNoticia']; ?></small>
									</li>
								<?php endwhile; ?>
							<?php endif; ?>
							<?php if ($seleccion == 3):  ?>
								<?php while ($resultados = $resultado->fetch_assoc()): ?>
									<li class="list-group-item">
										<a href="eventos.php"><?php echo $resultados['tituloEvento']; ?></a><br>
										<small><?php echo $resultados['cuerpoEvento']; ?></small>
									</li>
								<?php endwhile; ?>
							<?php endif; ?>
							<?php $resultado->free(); ?>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

</main>

<?php include_once('includes/templates/footer.php'); ?>