<?php include_once("funciones/sesiones.php"); ?>
<?php include_once("funciones/funciones.php"); ?>
<?php 
$id = $_GET['id']; 
if (!filter_var($id, FILTER_VALIDATE_INT)) {
	die("Error");
}
?>
<?php include_once("templates/header.php"); ?>
<?php include_once("templates/navbar.php") ?>
<?php include_once("templates/navigation.php") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Editar administrador
			<small>Llena el formulario para editar un administrador</small>
		</h1>
	</section>

	<div class="row">
		<div class="col-md-8">
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="box box-solid box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Editar administrador</h3>
					</div>
					<div class="box-body">
						<?php 
						$sql = "SELECT * FROM admin WHERE idAdmin = $id";
						$resultado = $conn->query($sql);
						$admins = $resultado->fetch_assoc();					
						?>
						<!-- form start -->
						<form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-admin.php">
							<div class="box-body">
								<div class="form-group">
									<label for="usuario">Usuario</label>
									<small> (máx. 50 caracteres)</small>
									<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa un usuario" value="<?php echo $admins['usuarioAdmin'] ?>">
								</div>
								<div class="form-group">
									<label for="nombre">Nombre</label>
									<small> (máx. 100 caracteres)</small>
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre" value="<?php echo $admins['nombreAdmin'] ?>">
								</div>
								<div class="form-group">
									<label for="password">Contraseña</label>
									<small> (máx. 20 caracteres)</small>
									<input type="password" class="form-control" id="password" name="password" placeholder="Ingresa una contraseña">
								</div>
								<div class="form-check">
									<label for="nivel">Alto nivel</label>
									<?php if ($admins['nivelAdmin'] == 1): ?>
										<input checked type="checkbox" class="form-check-input" id="nivel" name="nivel" value="1">
									<?php else: ?>
										<input type="checkbox" class="form-check-input" id="nivel" name="nivel" value="1">
									<?php endif; ?>
									<p class="help-block">Permitir a este administrador ver, modificar y eliminar a otros administradores.</p>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="hidden" name="registro" value="actualizar">
								<input type="hidden" name="id_registro" value="<?php echo $id; ?>">
								<button type="submit" class="btn btn-warning" name="agregar-admin">Editar</button>
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