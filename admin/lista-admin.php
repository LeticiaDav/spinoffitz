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
			Listado de administradores
			<small></small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Maneja los usuarios en esta sección</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="registros" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Usuario</th>
									<th>Nombre</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								try {
									$sql = "SELECT idAdmin, usuarioAdmin, nombreAdmin FROM admin";
									$resultado = $conn->query($sql);
								} catch (Exception $e) {
									$error = $e->getMessage();
									echo $error;
								}
								while ($admins = $resultado->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $admins['usuarioAdmin']; ?></td>
									<td><?php echo $admins['nombreAdmin']; ?></td>
									<td>
										<a href="editar-admin.php?id=<?php echo $admins['idAdmin'] ?>" class="btn bg-orange btn-flat margin">
											<i class="fa fa-pencil-alt"></i>
										</a>
										<a href="#" data-id="<?php echo $admins['idAdmin'] ?>" data-tipo="admin" class="btn bg-maroon btn-flat margin borrar_registro">
											<i class="fa fa-trash"></i>
										</a>

									</td>
								</tr>
								<?php }	?>
							</tbody>
							<tfoot>
								<tr>
									<th>Usuario</th>
									<th>Nombre</th>
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