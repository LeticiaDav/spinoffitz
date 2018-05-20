<?php 
session_start();
if (isset($_GET['cerrar_sesion'])) {
	$cerrar_sesion = $_GET['cerrar_sesion'];
	if ($cerrar_sesion) {
		session_destroy();
	}
}
?>

<?php include_once("funciones/funciones.php"); ?>
<?php include_once("templates/header.php"); ?>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="../index.php">
				<img src="../img/logo-l-negro.png" class="img-responsive pull-center" style="padding: 10px;">
			</a>
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<h4 class="login-box-msg">Iniciar sesión</h4>

			<form name="login-admin-form" id="login-admin" method="post" action="login-admin.php">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="usuario" placeholder="Usuario">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="password" placeholder="Contraseña">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<input type="hidden" name="login-admin" value="1">
						<button type="submit" class="btn btn-dark btn-block btn-flat">Acceder</button>
					</div>
				</div>
			</form>
		</div>
		<!-- /.login-box-body -->
	</div>

	<?php include_once("templates/footer.php"); ?>