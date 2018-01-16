/*
 * Administrador de Contenidos
 * Enero 2015
 * Alejandro Grijalva Antonio @HiProgrammer
 * Derechos Reservados
 */

// Variable glogal del proyecto para los archivos js
var url_proyect = 'http://127.0.0.1/mcq/';


function number_format(number, decimals, dec_point, thousands_sep) {
  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}

function param(a){
	var parametros = '';
	$.each(a, function(key, val){
		parametros = parametros + key + '=' + val + '&';
	});
	return parametros;
}


function msgError(msg, titulo) {
	var tit = ( titulo == '' )? '' : ' ';
    return '<div class="alert alert-danger alert-dismissable">'+
    			'<i class="fa fa-exclamation-triangle"></i>'+
    			'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
    			'<b>' + tit + '</b> '+ 
    			msg + 
    		'</div>';
}

function msgInfo(msg, titulo) {
	var tit = ( titulo == '' )? '' : ' ';
    return '<div class="alert alert-info alert-dismissable">'+
    			'<i class="fa fa-info"></i>'+
    			'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
    			'<b>' + tit + '</b> '+ 
    			msg + 
    		'</div>';
}

function msgLoad( leyenda ) {
	var text = '';
	if( leyenda != '' ) {text = '<p style="font-size:10px;">' + leyenda + '</p>';}
	else {text = '';}
    return '<center>' + text + '<img src="../../sources/img/loaders/17.gif" id="msgLoad" /></center>';
}

function loadRemove(){
	$("#msgLoad").remove();
}

var loadPerfil = function(file){
	var imagen = file.files[0]; 
	var reader = new FileReader(); 
	
	reader.onload = (function(theFile) {
        return function(e) {
			var kb = escape(theFile.size) / 1024;
			
			if( kb <= 1500 ){
				if(kb < 1024){
					var tamano = number_format(kb,2,'.',',') + ' Kb';
				}else{
					var mb = (kb / 1024)				
					var tamano = number_format(mb,2,'.',',') + ' Mb';
				}
				
				var nombre = escape(theFile.name).split('.');
				var extencion = (nombre.length) - 1;
				var s = nombre[extencion];
				
				if (s == 'jpg' | s == 'jpeg' | s == 'gif' | s == 'png' | s == 'PNG' | s == 'psd' | s == 'JPG' | s == 'JPEG'){
					$("#imgPortada").show();
					$(".featured-image-selection").hide();
					document.getElementById("imgPortada").src = e.target.result;

					$("#quitImg").html('<button class="btn btn-danger btn-xs" onclick="cancelPortada(\''+ imgen_portal +'\');"> <i class="fa fa-times"></i> Quitar </button>');
				}
				else{
					alert("El archivo seleccionado no es una imagen");
				}
			}
			else{
				alert("Se ha superado los 1.5Mb permitidos.");
			}
        };
      })(imagen);
	reader.readAsDataURL(imagen);
}

var loadPortada = function(file){
	// document.getElementById("nombre_img_3").innerHTML = '<img src="img/loaders/17.gif">';
	
	var imagen = file.files[0]; 
	var reader = new FileReader(); 
	
	reader.onload = (function(theFile) {
        return function(e) {
			var kb = escape(theFile.size) / 1024;
			
			if( kb <= 1500 ){
				if(kb < 1024){
					var tamano = number_format(kb,2,'.',',') + ' Kb';
				}else{
					var mb = (kb / 1024)				
					var tamano = number_format(mb,2,'.',',') + ' Mb';
				}
				
				var nombre = escape(theFile.name).split('.');
				var extencion = (nombre.length) - 1;
				var s = nombre[extencion];
				
				if (s == 'jpg' | s == 'jpeg' | s == 'gif' | s == 'png' | s == 'PNG' | s == 'psd' | s == 'JPG' | s == 'JPEG'){
					$("#imgPortada").show();
					$(".featured-image-selection").hide();
					document.getElementById("imgPortada").src = e.target.result;

					$("#quitImg").html('<button class="btn btn-danger btn-xs" onclick="cancelPortada(\''+ imgen_portal +'\');"> <i class="fa fa-times"></i> Quitar </button>');
				}
				else{
					alert("El archivo seleccionado no es una imagen");
				}
			}
			else{
				alert("Se ha superado los 1.5Mb permitidos.");
			}
        };
      })(imagen);
	reader.readAsDataURL(imagen);
}

var cancelPortada = function( imagen ){
	console.log( imagen );
	if( imagen != "" ){
		$("#imgPortada").attr( "src", "../../files/img/" + imagen );
		$("#quitImg").html(boton_elimar);			
	}
	else{
		$("#imgPortada").hide();
		$("#imgPortada").attr( "src", "" );
		$(".featured-image-selection").show();
		$("#quitImg").html('');	
	}
	
	$("#img_croquis").val('');
}

var cancel_galeria_id = function(id){
	document.getElementById("imgPerfil").src = 'img/click.png';
	document.getElementById("nombre_img_" + id).innerHTML = '';
	document.getElementById("peso_img_" + id).innerHTML = '';
	document.getElementById("controles_img_" + id).innerHTML = '';
	$("#btnLoad").show();
	
	if(perfil[0].sexo == 'm'){
		if(perfil[0].foto == ''){
			$("#imgPerfil").attr( 'src', 'img/' + defFoto[1] );

		}else{
			$("#imgPerfil").attr( 'src', '../files/img/' + perfil[0].foto );

		}
	}
	else{
		if(perfil[0].foto == ''){
			$("#imgPerfil").attr( 'src', 'img/' + defFoto[0] );

		}else{
			$("#imgPerfil").attr( 'src', '../files/img/' + perfil[0].foto );

		}
	}
}

$(".limit").keyup(function(){
	var text  = $(this).val();
	var limit = $(this).data( 'limit' );
	var count = text.length;
	var valid = text.substring(0, limit);
	var rest  = limit - count;
	$(".limit-text").text( rest + ' caracteres disponibles.' );

	if( rest > 10 ){
		$(".limit-text").css( 'color','#333' );
	}
	else{
		$(".limit-text").css( 'color','#F00' );
	}

	if( count >= limit ){
		$(this).val( valid );		
	}
});

//$(".file-img").change(function(){
	
//});

function cambio( file, group ){
	// var file = $(this);
	var maxKb  = 1500;
	var imagen = file.files[0]; 
	var reader = new FileReader(); 
	var fileId = $(this).data( 'id' );
	console.log(fileId);
	
	reader.onload = (function(theFile) {
        return function(e) {
			var kb = escape(theFile.size) / 1024;
			
			if( kb <= maxKb ){
				if(kb < 1024){
					var tamano = number_format(kb,2,'.',',') + ' Kb';
				}else{
					var mb = (kb / 1024)				
					var tamano = number_format(mb,2,'.',',') + ' Mb';
				}
				
				var nombre = escape(theFile.name).split('.');
				var extencion = (nombre.length) - 1;
				var s = nombre[extencion];
				
				if (s == 'jpg' | s == 'jpeg' | s == 'gif' | s == 'png' | s == 'PNG' | s == 'JPG' | s == 'JPEG'){
					$("#" + group + " img").attr( 'src' , e.target.result );
					$("#" + group + " + span").html( '<br><a class="btn btn-danger btn-xs" onclick="cancel_load(\'' + group + '\');">Cancelar</a>' );
				}
				else{
					alert("El archivo seleccionado no es una imagen");
					
				}
			}
			else{
				alert("Se ha superado los " + maxKb + "Kb permitidos.");				
			}
        };
      })(imagen);
	reader.readAsDataURL(imagen);
}

function cancel_load( group ){
	$("#" + group + ' img').attr( 'src','img/click.png' );
	$("#" + group + " + span").html( '' );
}


$('.type_float').keyup(function (){
    this.value = (this.value + '').replace(/[^0-9\.]/g, '');
});

$('.type_int').keyup(function (){
    this.value = (this.value + '').replace(/[^0-9 ]/g, '');
});



var searBool = true;
$("#search").click(function(){
	if( searBool ){
		searBool = false;
		$(".item").hide();
		$(".search").show();
		$(this).html( '<i class="fa fa-times"></i>' );
		$(".txt-search").focus();
	}
	else{
		searBool = true;
		$(".item").show();
		$(".search").hide();
		$(this).html( '<i class="fa fa-search"></i>' );
	}
});

function createURL(element){
	var titulo = element.value;
	var url = urlify(titulo);
	$("#txt-titulo").text( url );
	$("#friendly").val( url );
}

/* function to urlify a string */
var urlify = function(a){return a.toLowerCase().replace(/ /g, "-").replace(/ñ/g, 'n').replace(/Ñ/g, 'N').replace(/á/g, 'a').replace(/é/g, 'e').replace(/í/g, 'i').replace(/ó/g, 'o').replace(/ú/g, 'u').replace(/!/g, '').replace(/¡/g, '').replace(/¿/g, '').replace(/\?/g, '')};
/*var urlify = function(a){return a.toLowerCase().replace(/[^a-z0-9]+/g, "-").replace(/^-+|-+$/g, "-").replace(/^-+|-+$/g, '')};*/

function NumCheck(e, field) {
    key = e.keyCode ? e.keyCode : e.which;
    if (key === 8)
        return true;
    if (field.value !== "") {
        if ((field.value.indexOf(",")) > 0) {
            if (key > 47 && key < 58) {
                if (field.value === "")
                    return true;
                regexp = /[0-9]{1,10}[,][0-9]{1,3}$/;
                regexp = /[0-9]{2}$/;
                return !(regexp.test(field.value))
            }
        }
    }
    if (key > 47 && key < 58) {
        if (field.value === "")
            return true;
        regexp = /[0-9]{10}/;
        return !(regexp.test(field.value));
    }
    if (key === 46) {
        if (field.value === "")
            return false;
        regexp = /^[0-9]+$/;
        return regexp.test(field.value);
    }
    if( key === 9 ){
        return true;
    }
    if( key === 11 ){
        return true;
    }
    return false;
}

var session = {
	url: '../../functions/variables.session.php',
	info: 'Este es un objeto de creacion de sessiones',
	str_JSON: '',
	init: function(){
		session.load();
	},
	load: function( name )
	{
		var valores = 'get=' + name;
		$.ajax({
			url: session.url,  
			type: 'POST',
			data: valores,
			success: function( data ){
				session.str_JSON = data ;
			}
		});	
	},
	set: function( name, value )
	{
		var valores = 'SESSION-NAME=' + name;
			valores += '&SESSION-VALUE' + '=' + value;
		$.ajax({
			url: session.url,  
			type: 'POST',
			data: valores,
			success: function( data ){
				session.load();
			}
		});	
	},
	get: function( name ){
		if( name === undefined | name == ''){
			console.log('Ups!, El metodo GET necesita el nombre de la variable a obtener.');
		}
		else{
			var valor = '';
			if( session.JSON() == null ){
				valor = false;
				console.log('Ups!, No hay nada almacenado en las variables de sesion.');
			}
			else{
				$.each( session.JSON(), function( key, value ){
					if( key == name ){
						valor = value;
					}
				});				
			}

			if( valor == '' ){
				valor = false;
				console.log('Ups!, No se encontro ' + name + ' en la colección de datos.');
			}

			return valor;
		}
	},
	unset: function( name ){
		if( name === undefined | name == ''){
			console.log('Ups!, El metodo UNSET necesita el nombre de la variable a eliminar.');
			return false;
		}
		else{
			var valores = 'unset=' + name;
			$.ajax({
				url: session.url,  
				type: 'POST',
				data: valores,
				success: function( data ){
					var array = eval("(" + data + ")");
					session.load();
					return array.success;
				}
			});	
		}
	},
	reset: function(){
		var valores = 'reset=true';
		$.ajax({
			url: session.url,  
			type: 'POST',
			data: valores,
			success: function( data ){
				var array = eval("(" + data + ")");
				session.load();
				return array.success;
			}
		});			
	},
	print: function(){
		console.log(session.str_JSON);
	},
	JSON: function(){
		if( session.str_JSON == '' ){
			var array = false;
		}
		else{
			var array = eval( "(" + session.str_JSON + ")" );			
		}
		return array;
	}
};
session.init();