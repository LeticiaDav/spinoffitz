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
			Administradores
			<small>Todos los campos son obligatorios</small>
		</h1>
	</section>

	<div class="row">
		<div class="col-md-8">
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="box box-solid box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Crear administrador</h3>
					</div>
					<div class="box-body">
						<!-- form start -->
						<form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-admin.php">
							<div class="box-body">
								<div class="form-group">
									<label for="usuario">Usuario</label>
									<small> (máx. 50 caracteres)</small>
									<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa un usuario" required="required">
								</div>
								<div class="form-group">
									<label for="nombre">Nombre</label>
									<small> (máx. 100 caracteres)</small>
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required="required">
								</div>
								<div class="form-group">
									<label for="password">Contraseña</label>
									<small> (máx. 20 caracteres)</small>
									<input type="password" class="form-control" id="password" name="password" placeholder="Ingresa una contraseña" required="required">
								</div>
								<div class="form-group">
									<label for="password">Repetir contraseña</label>
									<input type="password" class="form-control" id="repetir_password" name="repetir_password" placeholder="Ingresa la contraseña nuevamente" required="required">
									<span id="resultado_password" class="help-block"></span>
								</div>
								<div class="form-check">
									<label for="nivel">Alto nivel</label>
									<input type="checkbox" class="form-check-input" id="nivel" name="nivel" value="1">
									<p class="help-block">Permitir a este administrador ver, modificar y eliminar a otros administradores.</p>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="hidden" name="registro" value="nuevo">
								<button type="submit" class="btn btn-info" id="crear_registro_admin">Crear</button>
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