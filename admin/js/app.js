$(document).ready(function() {
	$('.sidebar-menu').tree()

	$('#registros').DataTable({
		'scrollX': true,
		'paging': true,
		'pageLength': 8,
		'lengthChange': false,
		'searching': true,
		'ordering': true,
		'info': true,
		'autoWidth': false,
		'language': {
			paginate: {
				next: 'Siguiente',
				previous: 'Anterior',
				last: 'Último',
				first: 'Primero',
			},
			info: 'Mostrando _START_-_END_ de _TOTAL_ resultados',
			emptyTable: 'No hay registros',
			infoEmpty: '0 resultados',
			search: 'Buscar:'
		}
	});

	$('#crear_registro_admin').attr('disabled', true);

	$('#repetir_password').on('input', function() {
		var password_nuevo = $('#password').val();
		if ($(this).val() == password_nuevo) {
			$('#resultado_password').text('Las contraseñas coinciden');
			$('#resultado_password').parents('.form-group').addClass('has-success').removeClass('has-error');
			$('input#password').parents('.form-group').addClass('has-success').removeClass('has-error');
			$('#crear_registro_admin').attr('disabled', false);
		} else {
			$('#resultado_password').text('Las contraseñas NO coinciden');
			$('#resultado_password').parents('.form-group').addClass('has-error').removeClass('has-success');
			$('input#password').parents('.form-group').addClass('has-error').removeClass('has-success');
			$('#crear_registro_admin').attr('disabled', true);
		}
	});

	//Date picker
    $('#fecha').datepicker({
      autoclose: true
    });

    //Date picker
    $('#fecha2').datepicker({
      autoclose: true
    });


    $('.seleccionar').select2();

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    });

    //IconPicker
    $('#icono').iconpicker();
})