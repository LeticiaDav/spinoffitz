<?php include_once("funciones/sesiones.php"); ?>
<?php include_once("funciones/funciones.php"); ?>
<?php include_once("templates/header.php"); ?>
<?php include_once("templates/navbar.php"); ?>
<?php include_once("templates/navigation.php"); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Eventos
			<small>Llena el formulario para crear un evento</small>
		</h1>
	</section>

	<div class="row">
		<div class="col-md-8">
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="box box-solid box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Crear evento</h3>
					</div>
					<div class="box-body">
						<!-- form start -->
						<form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo-evento.php" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label for="titulo_evento">Título</label>
									<input type="text" class="form-control" id="titulo_evento" name="titulo_evento" placeholder="Ingresa el titulo" required="required">
								</div>
								<div class="form-group">
									<label for="lugar_evento">Lugar</label>
									<input type="text" class="form-control" id="lugar_evento" name="lugar_evento" placeholder="Ingresa el lugar" required="required">
								</div>
								<div class="form-group">
									<label>Fecha de inicio</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar-alt"></i>
										</div>
										<input type="text" class="form-control pull-right" id="fecha" name="inicio_evento" required="required">
									</div>
								</div>
								<div class="form-group">
									<label>Fecha de finalización</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar-alt"></i>
										</div>
										<input type="text" class="form-control pull-right" id="fecha2" name="fin_evento" required="required">
									</div>
								</div>
								<div class="form-group">
									<label for="cuerpo_evento">Cuerpo</label>
									<textarea class="form-control" name="cuerpo_evento" id="cuerpo_evento" rows="10" placeholder="Ingresa el cuerpo del evento" required="required"></textarea>
								</div>
								<div class="form-group">
									<label for="imagen_evento">Imagen</label>
									<input type="file" id="imagen_evento" name="archivo_imagen" required="required">
									<p class="help-block">Añade la imagen del evento.</p>
								</div>
								<div class="form-group">
									<label for="contacto_evento">Contacto</label>
									<input type="text" class="form-control" id="contacto_evento" name="contacto_evento" placeholder="Ingresa el contacto" required="required">
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="hidden" name="registro" value="nuevo">
								<button type="submit" class="btn btn-warning" id="crear_registro">Crear</button>
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