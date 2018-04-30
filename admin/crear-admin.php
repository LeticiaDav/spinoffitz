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
			Crear administrador
			<small>Llena el formulario para crear un administrador</small>
		</h1>
	</section>

	<div class="row">
		<div class="col-md-8">
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="box box-solid box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Crear administrador</h3>
					</div>
					<div class="box-body">
						<!-- form start -->
						<form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-admin.php">
							<div class="box-body">
								<div class="form-group">
									<label for="usuario">Usuario</label>
									<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa un usuario">
								</div>
								<div class="form-group">
									<label for="nombre">Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre">
								</div>
								<div class="form-group">
									<label for="password">Contraseña</label>
									<input type="password" class="form-control" id="password" name="password" placeholder="Ingresa una contraseña">
								</div>
								<div class="form-group">
									<label for="password">Repetir contraseña</label>
									<input type="password" class="form-control" id="repetir_password" name="repetir_password" placeholder="Ingresa la contraseña nuevamente">
									<span id="resultado_password" class="help-block"></span>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="hidden" name="registro" value="nuevo">
								<button type="submit" class="btn btn-warning" id="crear_registro_admin">Crear</button>
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