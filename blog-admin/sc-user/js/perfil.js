/*
 * Administrador de Contenidos
 * Diciembre 2015
 * Alejandro Grijalva Antonio @HiProgrammer
 * Derechos Reservados
 */

// Generamos la inclusion del menu

	$("#save-perfil").click(function(){
		var formData = new FormData($("#frm_perfil")[0]);
		
		$.ajax({
			url: '../control/user.update.php',  
			type: 'POST',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function(){
				$("#msgBox").html( msgLoad( 'Guardando ...' ) );
			},
			success: function( data ){				
				var array = eval("(" + data + ")");
				if(array.success == true)
				{
					$("#msgBox").html( msgInfo( array.msg ) );
					setTimeout(function(){
						location.reload();
					}, 1000);
					
				}
				else
				{
					$("#msgBox").html( msgError( array.msg ) );
				}
			},
			error: function(){
				$("#msgBox").html( msgError( 'Error inesperado de base de datos', '<i class="fa fa-code"></i> Ups! ' ) );
			}
		});		
	});

	$("#btnSubirImagen").click(function(){
		alert('ya se empieza a subir');
	});

function newRegistro(){
	var formData = new FormData($("#nw_frm_perfil")[0]);
		
	$.ajax({
		url: '../control/user.nuevo.php',  
		type: 'POST',
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function(){
			$("#msgBox").html( msgLoad( 'Guardando ...' ) );
		},
		success: function( data ){				
			var array = eval("(" + data + ")");
			if(array.success == true)
			{
				$("#msgBox").html( msgInfo( array.msg ) );
				setTimeout(function(){ location.href = "index.php" }, 1000);
			}
			else
			{
				$("#msgBox").html( msgError( array.msg ) );
			}
		},
		error: function(){
			$("#msgBox").html( msgError( 'Error inesperado de base de datos', '<i class="fa fa-code"></i> Ups! ' ) );
		}
	});		
}

function update(){
	var formData = new FormData($("#up_frm_perfil")[0]);
	$.ajax({
		url: '../control/update.php',  
		type: 'POST',
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function(){
			$("#msgBox").html( msgLoad( 'Guardando ...' ) );
		},
		success: function( data ){				
			var array = eval("(" + data + ")");
			if(array.success == true)
			{
				$("#msgBox").html( msgInfo( array.msg ) );
				setTimeout(function(){ location.href = "index.php" }, 1000);
			}
			else
			{
				$("#msgBox").html( msgError( array.msg ) );
			}
		},
		error: function(){
			$("#msgBox").html( msgError( 'Error inesperado de base de datos', '<i class="fa fa-code"></i> Ups! ' ) );
		}
	});	
}

function deleteUser( usu_id ){
	var r = confirm( 'Estas a punto de elimiar este registro, Aceptar para continuar!' );
	if (r){
		$.ajax({
			url: '../control/user.delete.php',
			type: 'POST',
			data: param({
					"usuario" : usu_id
				}),
			success: function( data ){	
				var array = eval("(" + data + ")");
				$("#user-" + usu_id).remove();
			}
		});
	}
}
