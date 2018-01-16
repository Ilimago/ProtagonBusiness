function savePost(){
	var formData = new FormData($("#frm-post")[0]);
		
		$.ajax({
			url: '../control/post.publicar.php',  
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

function deletePost( id ){
	var r = confirm('En verdad quieres mover esta entrada a eliminados?');
	if( r ){
		var valores = 'pst_id=' + id;
		$.ajax({
			url: '../control/post.papelera.php',  
			type: 'POST',
			data: valores,
			success: function( data ){				
				var array = eval("(" + data + ")");
				if(array.success == true)
				{
					$("#post-" + id ).remove();
					alert(array.msg);
				}
				else
				{
					alert(array.msg);
				}
			},
			error: function(){
				alert( 'Error inesperado de base de datos' ) ;
			}
		});
	}
}

function revertir( id ){
	var r = confirm('En verdad quieres mover esta entrada a publicados?');
	if( r ){
		var valores = 'pst_id=' + id;
		$.ajax({
			url: '../control/post.revertir.php',  
			type: 'POST',
			data: valores,
			success: function( data ){				
				var array = eval("(" + data + ")");
				if(array.success == true)
				{
					$("#post-" + id ).remove();
					alert(array.msg);
				}
				else
				{
					alert(array.msg);
				}
			},
			error: function(){
				alert( 'Error inesperado de base de datos' ) ;
			}
		});
	}
}

function eliminarPostDef( id ){
	var r = confirm('En verdad quieres eliminar esta entrada definitivamente?');
	if( r ){
		var valores = 'pst_id=' + id;
		$.ajax({
			url: '../control/post.delete.php',  
			type: 'POST',
			data: valores,
			success: function( data ){				
				var array = eval("(" + data + ")");
				if(array.success == true)
				{
					$("#post-" + id ).remove();
					alert(array.msg);
				}
				else
				{
					alert(array.msg);
				}
			},
			error: function(){
				alert( 'Error inesperado de base de datos' ) ;
			}
		});
	}
}

var eliminarPortadaTem = function( post ){
	var r = confirm('Estas seguro de elimiar esta foto?');
	if(r){
		$.ajax({
			url: '../control/post.imgdelete.php',  
			type: 'POST',
			data: 'pst_id=' + post,		
			success: function( data ){				
				var array = eval("(" + data + ")");
				if(array.success == true)
				{
					alert('Se elimino correctamente');
					imgen_portal = "";
					cancelPortada( imgen_portal );
				}
				else
				{
					alert( 'Ocurrio un error inesperado, favor de intentar mas tarde.' );
				}
			}
		});
		
	}
}

function yt_copy(){
	if(window.clipboardData){
    	window.clipboardData.setData("Text 1", "Texto 2");
    }
}

function deleteComent( coment ){
	var r = confirm('Estas seguro de eliminar este comentario?');
	if( r ){
		$.ajax({
			url: '../control/comentario.delete.php',  
			type: 'POST',
			data: 'coment=' + coment,		
			success: function( data ){				
				var array = eval("(" + data + ")");
				if(array.success == true)
				{
					$("#com-" + coment).remove();
				}
				else
				{
					alert( 'Ocurrio un error inesperado, favor de intentar mas tarde.' );
				}
			}
		});			
	}
}

function changeStattus( coment, esta ){
	var r = confirm('Estas seguro de hacer este cambio?');
	if( r ){
		$.ajax({
			url: '../control/comentario.estatus.php',  
			type: 'POST',
			data: 'coment=' + coment +'&esta=' + esta,
			success: function( data ){				
				var array = eval("(" + data + ")");
				if(array.success == true)
				{
					console.log( array.post );
					loadComentChange( array.post );
					// $("#com-" + coment +" .media-heading ").append( '<a class="btn btn-xs btn-'+array.btn+'" href="#">'+array.lbl+'</a>' );
				}
				else
				{
					alert( 'Ocurrio un error inesperado, favor de intentar mas tarde.' );
				}
			}
		});			
	}
}

function loadComentChange( post ){
	$.ajax({
		url: '../control/post.comentariosadmin.php',  
		type: 'POST',
		data: 'post=' + post,
		success: function( data ){			
			$("#coment-admin").html( data );
		}
	});	
}

function responderComentario( comen ){	
	$('#comentario-modal').modal({
        show: 'true'
    });
    $("#com_depende").val( comen );
}

function saveRespuesta(){
	if( $("#com-comentario").val() == '' ){
		alert('Escribe un comentario.');
	}
	else{
		var r = confirm('Estas seguro de hacer esta respuesta?');
		if( r ){
			var formData = new FormData($("#frm-comentario")[0]);
			
			$.ajax({
				url: '../control/comentario.insert.php',  
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
					loadComentChange( $("#pst_id").val() );
					$('#comentario-modal').modal('hide');
					$("#com-comentario").val( '' );
					$("#com_depende").val( 0 );
				},
				error: function(){
					$("#msgBox").html( msgError( 'Error inesperado de base de datos', '<i class="fa fa-code"></i> Ups! ' ) );
				}
			});			
		}		
	}
}