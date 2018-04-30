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
						<form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo-invitado.php" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label for="nombre_invitado">Nombre</label>
									<input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Ingresa el nombre del invitado">
								</div>
								<div class="form-group">
									<label for="apellido_invitado">Apellido</label>
									<input type="text" class="form-control" id="apellido_invitado" name="apellido_invitado" placeholder="Ingresa el apellido del invitado">
								</div>
								<div class="form-group">
									<label for="biografia_invitado">Biografía</label>
									<textarea class="form-control" name="biografia_invitado" id="biografia_invitado" rows="10" placeholder="Ingresa la biografía"></textarea>
								</div>
								<div class="form-group">
									<label for="imagen_invitado">Imagen</label>
									<input type="file" id="imagen_invitado" name="archivo_imagen">
									<p class="help-block">Añada la imagen del invitado aquí.</p>
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