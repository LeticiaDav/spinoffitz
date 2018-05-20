<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="info">
				<p><?php echo $_SESSION['nombre']; ?></p>
				<small>Administrador</small>
			</div>
		</div>
		<!-- search form -->
		<!-- <form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Buscar...">
				<span class="input-group-btn">
					<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form> --> <br>
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MENÚ DE ADMINISTRACIÓN</li>
			
			<!-- INICIO -->

			<li>
				<a href="admin-area.php">
					<i class="fa fa-home"></i>
					<span> &nbsp;Inicio</span>
				</a>
			</li>

			<!-- SPINOFFS -->

			<li class="treeview">
				<a href="#">
					<i class="fa fa-circle-notch"></i>
					<span> &nbsp;Spin-Offs</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="lista-spinoffs.php"><i class="fa fa-list-alt" aria-hidden="true"></i> &nbsp;Ver todos</a></li>
					<li><a href="crear-spinoff.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Agregar</a></li>
				</ul>
			</li>

			<!-- NOTICIAS -->

			<li class="treeview">
				<a href="#">
					<i class="fa fa-newspaper"></i>
					<span> &nbsp;Noticias</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="lista-noticias.php"><i class="fa fa-list-alt" aria-hidden="true"></i> &nbsp;Ver todos</a></li>
					<li><a href="crear-noticia.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Agregar</a></li>
				</ul>
			</li>

			<!-- EVENTOS -->

			<li class="treeview">
				<a href="#">
					<i class="fa fa-calendar-alt"></i>
					<span> &nbsp;Eventos</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="lista-eventos.php"><i class="fa fa-list-alt" aria-hidden="true"></i>  &nbsp;Ver todos</a></li>
					<li><a href="crear-evento.php"><i class="fa fa-plus-circle" aria-hidden="true"></i>  &nbsp;Agregar</a></li>
				</ul>
			</li>

			<!-- ADMINISTRADORES -->

			<?php if ($_SESSION['nivel'] == 1): ?>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-user-circle"></i>
						<span> &nbsp;Administradores</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="lista-admins.php"><i class="fa fa-list-alt" aria-hidden="true"></i> &nbsp;Ver todos</a></li>
						<li><a href="crear-admin.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbsp;Agregar</a></li>
					</ul>
				</li>
			<?php endif; ?>
			
		</ul>
	</section>
</aside>