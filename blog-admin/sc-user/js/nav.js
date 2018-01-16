/*
 * Administrador de Contenidos
 * Diciembre 2015
 * Alejandro Grijalva Antonio @HiProgrammer
 * Derechos Reservados
 */

// Generamos la inclusion del menu
(function($){
	// Obtenemos los datos del usuario
	var url = '../../functions/nav.json.php';
	$.getJSON(url, function( data ){
		$.each( data, function( key, item){
			var template = '<li>'+
	                            '<a href="' + item.href + '">'+
	                                item.ico + ' <span>' + item.nombre + '</span>'+
	                            '</a>'+
	                        '</li>';
	        $("#menuNav").append( template );
		});
	});	
}(jQuery));

