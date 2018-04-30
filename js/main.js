// jquery
$(function() {

	// agregar clase a menu
	$('body.index .navbar-nav a.nav-link:contains("Inicio")').addClass('active');
	$('body.spinoffs .navbar-nav a.nav-link:contains("Spin-Offs")').addClass('active');
	$('body.noticias .navbar-nav a.nav-link:contains("Noticias")').addClass('active');
	$('body.eventos .navbar-nav a.nav-link:contains("Eventos")').addClass('active');
	$('body.buscar .navbar-nav a.nav-link:contains("Buscar")').addClass('active');

});