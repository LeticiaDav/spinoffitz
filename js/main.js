// jquery
$(function() {

	// agregar clase a menu
	$('body.index .navegacion-principal a:contains("Inicio")').addClass('activo');
	$('body.spinoffs .navegacion-principal a:contains("Spin-Offs del ITZ")').addClass('activo');
	$('body.noticias .navegacion-principal a:contains("Noticias")').addClass('activo');
	$('body.eventos .navegacion-principal a:contains("Eventos")').addClass('activo');
	$('body.buscar .navegacion-principal a:contains("Buscar")').addClass('activo');

	// menu fijo
	// var windowHeight = $(window).height();
	// var barraAltura = $('.barra').innerHeight();
	// $(window).scroll(function() {
	// 	var scroll = $(window).scrollTop();
	// 	if (scroll > windowHeight * .75) {  // Se hace la multiplicacion para sacar el 75% del resultado ya que se aplico un 75vh en el hero y no un 100vh
	// 		$('.barra').addClass('fixed');
	// 		$('body').css({'margin-top': barraAltura+'px'});
	// 	} else {
	// 		$('.barra').removeClass('fixed');
	// 		$('body').css({'margin-top': '0px'});
	// 	}
	// });

	// menu responsive
	// $('.menu-movil').on('click', function() {
	// 	$('.navegacion-principal').slideToggle();
	// });

	// colorbox
	$('.spinoff-info').colorbox({inline: true, width:"75%"});
	$('.noticia-info').colorbox({inline: true, width:"75%"});
	$('.evento-info').colorbox({inline: true, width:"75%"});
});