<?php include_once("funciones/sesiones.php"); ?>
<?php include_once("funciones/funciones.php"); ?>
<?php 
$id = $_GET['id']; 
if (!filter_var($id, FILTER_VALIDATE_INT)) {
	die("Error");
}
?>
<?php include_once("templates/header.php"); ?>
<?php include_once("templates/navbar.php"); ?>
<?php include_once("templates/navigation.php"); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Editar categoría de evento
			<small>Llena el formulario para editar una categoría de evento</small>
		</h1>
	</section>

	<div class="row">
		<div class="col-md-8">
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Editar categoría de eventos</h3>
					</div>
					<div class="box-body">
						<?php 
						$sql = "SELECT * FROM categoria_evento WHERE id_categoria = $id ";
						$resultado = $conn->query($sql);
						$categoria = $resultado->fetch_assoc();
						?>
						<!-- form start -->
						<form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-categoria.php">
							<div class="box-body">
								<div class="form-group">
									<label for="usuario">Nombre</label>
									<input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Ingresa un nombre de categoría" value="<?php echo $categoria['cat_evento']; ?>">
								</div>
								<div class="form-group">
									<label for="nombre">Icono</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-address-book"></i>
										</div>
										<input type="text" id="icono" name="icono" class="form-control pull-right" placeholder="fa-icon" value="<?php echo $categoria['icono']; ?>">
									</div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="hidden" name="registro" value="actualizar">
								<input type="hidden" name="id_registro" value="<?php echo $id; ?>">
								<button type="submit" class="btn btn-primary" id="crear_registro">Editar</button>
							</div>
						</form>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</section>
			<!-- /.content -->
		</div>
	</div>
</div>
<!-- /.content-wrapper -->

<?php include_once("templates/footer.php"); ?>