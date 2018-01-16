<?php
	require_once '../model/post.class.php';
	$mdb = new post();

	$_tabla['pst_titulo'] 			= $_POST['titulo'];
	$_tabla['pst_friendly'] 		= $_POST['friendly'];
	$_tabla['pst_post'] 			= $_POST['post'];
	$_tabla['pst_estatus'] 			= $_POST['status'];
	$_tabla['pst_fecha'] 			= $_POST['fecha'];
	$_tabla['pst_hora'] 			= $_POST['hora'];
	//$_tabla['pst_categoria'] 		= (empty($_POST['categoria'])) ? '' : htmlentities( implode( ',', $_POST['categoria'] ) );
    $_tabla['pst_categoria']        = (empty($_POST['categoria'])) ? '' : implode( ',', $_POST['categoria'] );
    //$_tabla['pst_etiqueta'] 		= (empty($_POST['etiquetas'])) ? '' : htmlentities( implode( ',', $_POST['etiquetas'] ) );
    $_tabla['pst_etiqueta']         = (empty($_POST['etiquetas'])) ? '' : implode( ',', $_POST['etiquetas'] );
    $_tabla['pst_imagen_alt'] 		= $_POST['pst_imagen_alt'];
    $_tabla['pst_img_url'] 			= $_POST['pst_img_url'];
    $_tabla['pst_img_url_alt'] 		= $_POST['pst_img_url_alt'];
	$_tabla['pst_yt_url'] 			= $_POST['yt-url-video'];
	$_tabla['pst_yt_ancho'] 		= $_POST['yt-ancho'];
	$_tabla['pst_yt_alto'] 			= $_POST['yt-alto'];
	$_tabla['pst_yt_autoplay'] 		= 0;
	$_tabla['pst_otro'] 			= $_POST['video-otro'];
	$_tabla['pst_st_socialmedia'] 	= $_POST['st-socialmedia'];
	$_tabla['pst_st_comentarios'] 	= $_POST['stcomentarios'];
	$_tabla['pst_st_autor'] 		= $_POST['st-autor'];
	$_tabla['usu_autor'] 			= $_POST['usu-autor'];
	$_tabla['usu_id'] 				= $_POST['usu-id'];

	$imagen = subeImagen( '../../files/img', 'imagen' );
	if( $imagen != false ){
		$_tabla['pst_imagen'] 		= $imagen['nombre'];
	}

	switch ($_tabla['pst_estatus']) {
		case 1: $url = 'post.php'; break;
		case 2: $url = 'borradores.php'; break;
		case 3: $url = 'programado.php'; break;
	}

	//print_r($_tabla);

	if( $mdb->insert($_tabla)){
		$_return['success'] = true;			      
		$_return['msg'] = msg(408);			
		
		echo '<script>location.href = "../view/' . $url . '";</script>';
	}
	else{
		$_return['success'] = false;
		$_return['msg'] = msg(407);
		echo '<script>location.href = "../view/nuevo.php?error";</script>';
		die();
	}

	function msg($c){
		switch ($c) {
			case 100: $msg = 'Mensaje de prueba.'; break;
			case 400: $msg = 'Debes proporcionar el nombre de la categoria.'; break;
			case 401: $msg = 'Debes proporcionar un email valido.'; break;
			case 402: $msg = 'Debes proporcionar la confirmación de tu contraseña.'; break;
			case 403: $msg = 'Las contraseñas no coinciden.'; break;
			case 404: $msg = 'La clave debe tener al menos 8 caracteres.'; break;
			case 405: $msg = 'Su password es seguro.'; break;
			case 406: $msg = 'Su password no es seguro.'; break;
			case 407: $msg = 'No se guardo en base de datos, revisar datos ingresados.'; break;
			case 408: $msg = 'Se ha guardado exitosamente.'; break;
			default: $msg  = 'Undefined'; break;
		}

		return $msg;
	}

	function subeImagen($destino,$elm= 'file'){		
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$cad = "";
		for($i=0;$i<12;$i++) {
			$cad .= substr($str,rand(0,62),1);
		}
		$tamano = $_FILES [$elm]['size'];
		
		$tamaño_max = "500000000000"; 
		 
		if( $tamano < $tamaño_max){ 
			$sep  = explode('image/',$_FILES[$elm]["type"]);
			$tipo = $sep[1]; 
			if($tipo == '')
				{ return false; }
			else{
				if($tipo == "gif" || $tipo == "pjpeg" || $tipo == "bmp" || $tipo =='jpeg' || $tipo =='jpg' || $tipo =='png' || $tipo =='PNG' || $tipo =='JPG' || $tipo =='JPEG'){ 
					$_archivo['nombre'] = $cad.'.'.$tipo;
					$_archivo['tipo'] = $_FILES[$elm]['type'];
					$_archivo['peso'] = $_FILES[$elm]['size'];
					$des = $destino . '/' .$cad.'.'.$tipo;
					copy($_FILES[$elm]['tmp_name'],$des);
					
					return $_archivo;  
				}
				else { return false; };  
			}
		}
		else { return false; };  
	} 

	//Función para remplazar cadena
	function seo_url($url){
		// Tranformamos todo a minusculas
		$url = strtolower($url);
		//Rememplazamos caracteres especiales latinos
		$find = array('&Aacute;', '&aacute;', '&Eacute;', '&eacute;','&Iacute;', '&iacute;','&Oacute;', '&oacute;','&Uacute;', '&uacute;','&Ntilde;', '&ntilde;');
		$repl = array('a', 'a', 'e', 'e', 'i', 'i', 'o', 'o', 'u', 'u', 'n', 'n');
		$url = str_replace ($find, $repl, $url);
		$url = html_entity_decode($url);
		// Añaadimos los guiones
		$find = array(' ', '&', '\r\n', '\n', '+'); 
		$url = str_replace ($find, '-', $url);
		// Eliminamos y Reemplazamos demás caracteres especiales
		$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
		$repl = array('', '-', '');
		$url = preg_replace ($find, $repl, $url);
		return $url;		
	}
?>