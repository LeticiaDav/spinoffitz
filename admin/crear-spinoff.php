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
			Crear un invitado
			<small>Llena el formulario para crear un invitado</small>
		</h1>
	</section>

	<div class="row">
		<div class="col-md-8">
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Crear un invitado</h3>
					</div>
					<div class="box-body">
						<!-- form start -->
						<form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo-spinoff.php" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label for="nombre_spinoff">Nombre</label>
									<input type="text" class="form-control" id="nombre_spinoff" name="nombre_spinoff" placeholder="Ingresa el nombre del spin-off">
								</div>
								<div class="form-group">
									<label for="giro_spinoff">Giro</label>
									<input type="text" class="form-control" id="giro_spinoff" name="giro_spinoff" placeholder="Ingresa el giro del spin-off">
								</div>
								<div class="form-group">
									<label for="descripcion_spinoff">Descripción</label>
									<textarea class="form-control" name="descripcion_spinoff" id="descripcion_spinoff" rows="10" placeholder="Ingresa la descripción"></textarea>
								</div>
								<div class="form-group">
									<label for="servicios_spinoff">Servicios</label>
									<textarea class="form-control" name="servicios_spinoff" id="servicios_spinoff" rows="10" placeholder="Ingresa los servicios"></textarea>
								</div>
								<div class="form-group">
									<label for="proyectos_spinoff">Descripción</label>
									<textarea class="form-control" name="proyectos_spinoff" id="proyectos_spinoff" rows="10" placeholder="Ingresa los proyectos"></textarea>
								</div>
								<div class="form-group">
									<label for="integrantes_spinoff">Descripción</label>
									<textarea class="form-control" name="integrantes_spinoff" id="integrantes_spinoff" rows="10" placeholder="Ingresa los integrantes"></textarea>
								</div>
								<div class="form-group">
									<label for="imagen_spinoff">Imagen</label>
									<input type="file" id="imagen_spinoff" name="archivo_imagen">
									<p class="help-block">Añade la imagen del spin-off.</p>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="hidden" name="registro" value="nuevo">
								<button type="submit" class="btn btn-primary" id="crear_registro">Añadir</button>
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