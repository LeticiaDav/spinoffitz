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
						<h3 class="box-title">Listado de los noticias</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="registros" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Título</th>
									<th>Fecha</th>
									<th>Fuente</th>
									<th>Imagen</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								try {
									$sql = "SELECT * FROM noticia;";
									$resultado = $conn->query($sql);
								} catch (Exception $e) {
									$error = $e->getMessage();
									echo $error;
								}
								while ($noticias = $resultado->fetch_assoc()) { ?>
								<tr>
									<td><?php echo $noticias['tituloNoticia']; ?></td>
									<td><?php echo $noticias['fechaNoticia']; ?></td>
									<td><?php echo $noticias['fuenteNoticia']; ?></td>
									<td>
										<img src="../img/noticias/<?php echo $noticias['imagenNoticia']; ?>" width="80">
									</td> 
									<td>
										<a href="editar-noticia.php?id=<?php echo $noticias['idNoticia']; ?>" class="btn bg-orange btn-flat margin">
											<i class="fa fa-pencil-alt"></i>
										</a>
										<a href="#" data-id="<?php echo $noticias['idNoticia']; ?>" data-tipo="noticia" class="btn bg-maroon btn-flat margin borrar_registro">
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
									<th>Fuente</th>
									<th>Imagen</th>
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