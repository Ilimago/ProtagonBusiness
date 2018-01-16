<?php
	require_once '../model/post.class.php';
	$mdb = new post();

	$_tabla['pst_imagen'] 		= '';

	if( $mdb->update($_tabla, 'pst_id = ' . sprintf('%d',$_POST['pst_id'] ) ) ){
		$_return['success'] = true;			      
		$_return['msg'] = msg(408);
		$imgn = $mdb->get( sprintf('%d', $_POST['pst_id']) );
		if (!empty($imgn[0]['pst_imagen'])) {
			$dir="../../files/img/".$imgn[0]['pst_imagen'];
			unlink($dir);
		}			
	}
	else{
		$_return['success'] = false;
		$_return['msg'] = msg(407);
	}

	echo json_encode($_return);

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

?>