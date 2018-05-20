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
			Noticias
			<small>Llena el formulario para editar una noticia</small>
		</h1>
	</section>

	<div class="row">
		<div class="col-md-8">
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="box box-solid box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Editar noticia</h3>
					</div>
					<div class="box-body">
						<!-- form start -->
						<form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo-noticia.php" enctype="multipart/form-data">
							<div class="box-body">
								<?php 
								$sql = "SELECT * FROM noticia WHERE idNoticia = $id";
								$resultado = $conn->query($sql);
								$noticias = $resultado->fetch_assoc();
								?>
								<div class="form-group">
									<label for="titulo_noticia">Título</label>
									<small> (máx. 120 caracteres)</small>
									<input type="text" class="form-control" id="titulo_noticia" name="titulo_noticia" placeholder="Ingresa el titulo" value="<?php echo $noticias['tituloNoticia']; ?>">
								</div>
								<div class="form-group">
									<label for="cuerpo_noticia">Cuerpo</label>
									<small> (máx. 2000 caracteres)</small>
									<textarea class="form-control" name="cuerpo_noticia" id="cuerpo_noticia" rows="10" placeholder="Ingresa el cuerpo de la noticia"><?php echo $noticias['cuerpoNoticia']; ?></textarea>
								</div>
								<div class="form-group">
									<?php 
									$fecha = $noticias['fechaNoticia'];
									$fecha_f = date('m/d/Y', strtotime($fecha));
									?>
									<label>Fecha</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar-alt"></i>
										</div>
										<input type="text" class="form-control pull-right" id="fecha" name="fecha_noticia" value="<?php echo $fecha_f; ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="fuente_noticia">Fuente</label>
									<small> (máx. 80 caracteres)</small>
									<input type="text" class="form-control" id="fuente_noticia" name="fuente_noticia" placeholder="Ingresa la fuente" value="<?php echo $noticias['fuenteNoticia']; ?>">
								</div>
								<div class="form-group">
									<label for="imagen_actual">Imagen actual</label>
									<br>
									<img src="../img/noticias/<?php echo $noticias['imagenNoticia']; ?>" width="200">
								</div>
								<div class="form-group">
									<label for="imagen_noticia">Imagen</label>
									<small> (máx. 2 MB)</small>
									<input type="file" id="imagen_noticia" name="archivo_imagen">
									<p class="help-block">Añade la imagen de la noticia.</p>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="hidden" name="registro" value="actualizar">
								<input type="hidden" name="id_registro" value="<?php echo $id; ?>">
								<button type="submit" class="btn btn-warning">Editar</button>
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