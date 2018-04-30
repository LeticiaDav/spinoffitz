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
			Noticias
			<small>Tabla con acciones para editar o eliminar una noticia</small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				
				<div class="box box-solid box-success">
					<div class="box-header">
						<h3 class="box-title">Listado de los eventos</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="registros" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Título</th>
									<th>Fecha</th>
									<th>Lugar</th>
									<th>Imagen</th>
									<th>Contacto</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								try {
									$sql = "SELECT * FROM evento";
									$resultado = $conn->query($sql);
								} catch (Exception $e) {
									$error = $e->getMessage();
									echo $error;
								}
								while ($eventos = $resultado->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $eventos['tituloEvento']; ?></td>
									<td><?php echo $eventos['inicioEvento'] . " al " . $eventos['finEvento']; ?></td>
									<td><?php echo $eventos['lugarEvento']; ?></td>
									<td><img src="../img/eventos/<?php echo $eventos['imagenEvento']; ?>" width="80"></td>
									<td><?php echo $eventos['contactoEvento'] ?></td>
									<td>
										<a href="editar-evento.php?id=<?php echo $eventos['idEvento'] ?>" class="btn bg-orange btn-flat margin">
											<i class="fa fa-pencil-alt"></i>
										</a>
										<a href="#" data-id="<?php echo $eventos['idEvento']; ?>" data-tipo="evento" class="btn bg-maroon btn-flat margin borrar_registro">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
								<?php }	?>
							</tbody>
							<tfoot>
								<tr>
									<th>Título</th>
									<th>Fecha</th>
									<th>Lugar</th>
									<th>Imagen</th>
									<th>Contacto</th>
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