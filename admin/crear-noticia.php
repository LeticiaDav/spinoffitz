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
			Noticias
			<small>Llena el formulario para crear una noticia</small>
		</h1>
	</section>

	<div class="row">
		<div class="col-md-8">
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="box box-solid box-warning">
					<div class="box-header with-border">
						<h3 class="box-title">Crear noticia</h3>
					</div>
					<div class="box-body">
						<!-- form start -->
						<form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo-noticia.php" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label for="titulo_noticia">Título</label>
									<input type="text" class="form-control" id="titulo_noticia" name="titulo_noticia" placeholder="Ingresa la noticia" required="required">
								</div>
								<div class="form-group">
									<label for="cuerpo_noticia">Cuerpo</label>
									<textarea class="form-control" name="cuerpo_noticia" id="cuerpo_noticia" rows="10" placeholder="Ingresa el cuerpo de la noticia" required="required"></textarea>
								</div>
								<div class="form-group">
									<label>Fecha</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar-alt"></i>
										</div>
										<input type="text" class="form-control pull-right" id="fecha" name="fecha_noticia" required="required">
									</div>
								</div>
								<div class="form-group">
									<label for="fuente_noticia">Fuente</label>
									<input type="text" class="form-control" id="fuente_noticia" name="fuente_noticia" placeholder="Ingresa la fuente" required="required">
								</div>
								<div class="form-group">
									<label for="imagen_noticia">Imagen</label>
									<input type="file" id="imagen_noticia" name="archivo_imagen" required="required">
									<p class="help-block">Añade la imagen de la noticia.</p>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<input type="hidden" name="registro" value="nuevo">
								<button type="submit" class="btn btn-warning" id="crear_registro">Crear</button>
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