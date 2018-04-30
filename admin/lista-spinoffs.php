<?php include_once("funciones/sesiones.php") ?>
<?php include_once("funciones/funciones.php") ?>
<?php include_once("templates/header.php"); ?>
<?php include_once("templates/navbar.php") ?>
<?php include_once("templates/navigation.php") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Listado de invitados
			<small></small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Maneja a los invitados en esta sección</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="registros" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Giro</th>
									<!-- <th>Descripción</th> -->
									<!-- <th>Servicios</th> -->
									<!-- <th>Proyectos</th> -->
									<!-- <th>Integrantes</th> -->
									<th>Imagen</th>
									<!-- <th>URL Video</th> -->
									<th>Teléfono</th>
									<th>Email</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								try {
									$sql = "SELECT * FROM spinoff";
									$resultado = $conn->query($sql);
								} catch (Exception $e) {
									$error = $e->getMessage();
									echo $error;
								}
								while ($spinoffs = $resultado->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $spinoffs['nombreSpinoff']; ?></td>
									<td><?php echo $spinoffs['giroSpinoff']; ?></td>
									<!-- <td><?php echo $spinoffs['descripcionSpinoff']; ?></td> -->
									<!-- <td><?php echo $spinoffs['serviciosSpinoff']; ?></td> -->
									<!-- <td><?php echo $spinoffs['proyectosSpinoff']; ?></td> -->
									<!-- <td><?php echo $spinoffs['integrantesSpinoff']; ?></td> -->
									<!-- <td><img src="../img/spinoffs/<?php //echo $spinoffs['url_imagen']; ?>" width="50"></td> -->
									<td><?php echo $spinoffs['imagenSpinoff']; ?></td>
									<!-- <td><?php //echo $spinoffs['videoSpinoff']; ?></td> -->
									<td><?php echo $spinoffs['telefonoSpinoff']; ?></td>
									<td><?php echo $spinoffs['emailSpinoff']; ?></td>
									<td>
										<a href="editar-spinoff.php?id=<?php echo $spinoffs['idSpinoff'] ?>" class="btn bg-orange btn-flat margin">
											<i class="fa fa-pencil-alt"></i>
										</a>
										<a href="#" data-id="<?php echo $spinoffs['idSpinoff']; ?>" data-tipo="spinoff" class="btn bg-maroon btn-flat margin borrar_registro">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
								<?php }	?>
							</tbody>
							<tfoot>
								<tr>
									<th>Nombre</th>
									<th>Giro</th>
									<!-- <th>Descripción</th> -->
									<!-- <th>Servicios</th> -->
									<!-- <th>Proyectos</th> -->
									<!-- <th>Integrantes</th> -->
									<th>Imagen</th>
									<!-- <th>URL Video</th> -->
									<th>Teléfono</th>
									<th>Email</th>
									<th>Acciones</th>
								</tr>
							</tfoot>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once("templates/footer.php") ?>