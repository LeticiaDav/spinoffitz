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
			Spin-Offs
			<small>Llena el formulario para editar un spin-off</small>
		</h1>
	</section>

	<div class="row">
		<div class="col-md-8">
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="box box-solid box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Editar spin-off</h3>
					</div>
					<div class="box-body">
						<?php 
						$sql = "SELECT * FROM spinoff WHERE idSpinoff = $id;";
						$resultado = $conn->query($sql);
						$spinoffs = $resultado->fetch_assoc();
						?>
						<!-- form start -->
						<form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo-spinoff.php" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label for="nombre_spinoff">Nombre</label>
									<input type="text" class="form-control" id="nombre_spinoff" name="nombre_spinoff" placeholder="Ingresa el nombre del spin-off" value="<?php echo $spinoffs['nombreSpinoff']; ?>">
								</div>
								<div class="form-group">
									<label for="giro_spinoff">Giro</label>
									<input type="text" class="form-control" id="giro_spinoff" name="giro_spinoff" placeholder="Ingresa el giro del spin-off" value="<?php echo $spinoffs['giroSpinoff']; ?>">
								</div>
								<div class="form-group">
									<label for="descripcion_spinoff">Descripción</label>
									<textarea class="form-control" name="descripcion_spinoff" id="descripcion_spinoff" rows="10" placeholder="Ingresa la descripción"><?php echo $spinoffs['descripcionSpinoff']; ?></textarea>
								</div>
								<div class="form-group">
									<label for="servicios_spinoff">Servicios</label>
									<textarea class="form-control" name="servicios_spinoff" id="servicios_spinoff" rows="10" placeholder="Ingresa los servicios"><?php echo $spinoffs['serviciosSpinoff']; ?></textarea>
								</div>
								<div class="form-group">
									<label for="proyectos_spinoff">Proyectos</label>
									<textarea class="form-control" name="proyectos_spinoff" id="proyectos_spinoff" rows="10" placeholder="Ingresa los proyectos"><?php echo $spinoffs['proyectosSpinoff']; ?></textarea>
								</div>
								<div class="form-group">
									<label for="integrantes_spinoff">Integrantes</label>
									<textarea class="form-control" name="integrantes_spinoff" id="integrantes_spinoff" rows="10" placeholder="Ingresa los integrantes"><?php echo $spinoffs['integrantesSpinoff']; ?></textarea>
								</div>
								<div class="form-group">
									<label for="imagen_actual">Imagen actual</label>
									<br>
									<img src="../img/spinoffs/<?php echo $spinoffs['imagenSpinoff']; ?>" width="200">
								</div>
								<div class="form-group">
									<label for="imagen_spinoff">Imagen</label>
									<input type="file" id="imagen_spinoff" name="archivo_imagen">
									<p class="help-block">Añade la imagen del spin-off.</p>
								</div>
								<div class="form-group">
									<label for="video_spinoff">Enlace de video</label>
									<input type="text" class="form-control" id="video_spinoff" name="video_spinoff" placeholder="Ingresa el enlace de video" value="<?php echo $spinoffs['videoSpinoff']; ?>">
								</div>
								<div class="form-group">
									<label for="telefono_spinoff">Teléfono</label>
									<input type="text" class="form-control" id="telefono_spinoff" name="telefono_spinoff" placeholder="Ingresa el teléfono" value="<?php echo $spinoffs['telefonoSpinoff']; ?>">
								</div>
								<div class="form-group">
									<label for="email_spinoff">Email</label>
									<input type="text" class="form-control" id="email_spinoff" name="email_spinoff" placeholder="Ingresa el correo electrónico" value="<?php echo $spinoffs['emailSpinoff']; ?>">
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="hidden" name="registro" value="actualizar">
								<input type="hidden" name="id_registro" value="<?php echo $spinoffs['idSpinoff']; ?>">
								<button type="submit" class="btn btn-info" id="crear_registro">Editar</button>
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