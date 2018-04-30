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
			Bienvenido <?php echo $_SESSION["nombre"]; ?>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Esta área te ayudara a gestionar spin-offs, noticias y eventos</h3>

				<div class="box-tools pull-right">
					<!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
					</div>
				</div>
				<!-- <div class="box-body">
					
				</div> -->
				<!-- /.box-body -->
				<!-- <div class="box-footer">
					Footer
				</div> -->
				<!-- /.box-footer-->
			</div>
			<!-- /.box -->

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<?php include_once("templates/footer.php") ?>