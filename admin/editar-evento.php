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
			Eventos
			<small>Llena el formulario para editar un evento</small>
		</h1>
	</section>

	<div class="row">
		<div class="col-md-8">
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="box box-solid box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Editar evento</h3>
					</div>
					<div class="box-body">
						<!-- form start -->
						<form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo-evento.php" enctype="multipart/form-data">
							<div class="box-body">
								<?php 
								$sql = "SELECT * FROM evento WHERE idEvento = $id";
								$resultado = $conn->query($sql);
								$eventos = $resultado->fetch_assoc();
								?>
								<div class="form-group">
									<label for="titulo_evento">Título</label>
									<small> (máx. 120 caracteres)</small>
									<input type="text" class="form-control" id="titulo_evento" name="titulo_evento" placeholder="Ingresa el titulo" value="<?php echo $eventos['tituloEvento']; ?>">
								</div>
								<div class="form-group">
									<label for="lugar_evento">Lugar</label>
									<small> (máx. 80 caracteres)</small>
									<input type="text" class="form-control" id="lugar_evento" name="lugar_evento" placeholder="Ingresa el lugar" value="<?php echo $eventos['lugarEvento']; ?>">
								</div>
								<div class="form-group">
									<?php 
									$inicio = $eventos['inicioEvento'];
									$inicio_f = date('m/d/Y', strtotime($inicio));
									?>
									<label>Fecha de inicio</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar-alt"></i>
										</div>
										<input type="text" class="form-control pull-right" id="fecha" name="inicio_evento" value="<?php echo $inicio_f; ?>">
									</div>
								</div>
								<div class="form-group">
									<?php 
									$fin = $eventos['finEvento'];
									$fin_f = date('m/d/Y', strtotime($fin));
									?>
									<label>Fecha de finalización</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar-alt"></i>
										</div>
										<input type="text" class="form-control pull-right" id="fecha2" name="fin_evento" value="<?php echo $fin_f; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="cuerpo_evento">Cuerpo</label>
									<small> (máx. 2000 caracteres)</small>
									<textarea class="form-control" name="cuerpo_evento" id="cuerpo_evento" rows="10" placeholder="Ingresa el cuerpo del evento"><?php echo $eventos['cuerpoEvento']; ?></textarea>
								</div>
								<div class="form-group">
									<label for="imagen_actual">Imagen actual</label>
									<br>
									<img src="../img/eventos/<?php echo $eventos['imagenEvento']; ?>" width="200">
								</div>
								<div class="form-group">
									<label for="imagen_evento">Imagen</label>
									<small> (máx. 2 MB)</small>
									<input type="file" id="imagen_evento" name="archivo_imagen">
									<p class="help-block">Añade la imagen del evento.</p>
								</div>
								<div class="form-group">
									<label for="contacto_evento">Contacto</label>
									<small> (máx. 50 caracteres)</small>
									<input type="text" class="form-control" id="contacto_evento" name="contacto_evento" placeholder="Ingresa el contacto" value="<?php echo $eventos['contactoEvento']; ?>">
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="hidden" name="registro" value="actualizar">
								<input type="hidden" name="id_registro" value="<?php echo $id; ?>">
								<button type="submit" class="btn btn-warning">Editar</button>
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