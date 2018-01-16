/*
 * Administrador de Contenidos
 * Diciembre 2015
 * Alejandro Grijalva Antonio @HiProgrammer
 * Derechos Reservados
 */

// Generamos la inclusion del menu
(function($){
	// Obtenemos los datos del usuario
	var url = '../../functions/user.json.php';
	$.getJSON(url, function(data){
		if(!data.success){
			// location.href = '../index.html';
		}
		else{
			var firstName = data.userName.split(' ');
			$(".dUserName").html(data.userName);
			$(".dEmpresa").html(data.info.empresa);
			$(".dSistema").html(data.info.name);
			$(".dVersion").html('v' + data.info.version);
			$(".dSaludo").html('Hola, ' + firstName[0]);
			if(data.sexo == 'm'){
				if(data.foto == ''){
					$(".img-usr").attr( 'src', '../../files/user/user.jpg' );
				}else{
					$(".img-usr").attr( 'src', '../../files/user/user.jpg' );
				}
			}
			else{
				if(data.foto == ''){
					$(".img-usr").attr( 'src', '../../files/user/user.jpg' );
				}else{
					$(".img-usr").attr( 'src', '../../files/user/user.jpg');
				}
			}
			
		}
	});	
}(jQuery));

