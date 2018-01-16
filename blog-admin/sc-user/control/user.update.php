<?php
	session_start();
	require_once '../model/usuario.class.php';	
	$mdb = new usuario();

	if(empty($_POST['usu_nombre'])){
		$_return['success'] = false;
		$_return['msg'] = msg(400);
		echo json_encode($_return);
		die();
	}
	else{
		$_update['usu_nombre'] = $_POST['usu_nombre'];
	}

	if (!filter_var($_POST['usu_mail'], FILTER_VALIDATE_EMAIL)) {
	    $_return['success'] = false;
		$_return['msg'] = msg(401);
		echo json_encode($_return);
		die();
	}
	else{
		$_update['usu_mail'] = $_POST['usu_mail'];
	}

	if( !empty($_POST['pass-1']) ){
		if( empty($_POST['pass-2']) ){
			$_return['success'] = false;
			$_return['msg'] = msg(402);
			echo json_encode($_return);
			die();
		}
		else{
			if( $_POST['pass-1'] == $_POST['pass-2'] ){
				if(strlen($_POST['pass-2']) < 8){
					$_return['success'] = false;			      
					$_return['msg'] = msg(404);
					echo json_encode($_return);
					die();
			   	}
			   	else{
			   		if (preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST['pass-2'])){
			   			$_update['usu_password'] = md5($_POST['pass-2']);
			   		}
			   		else {
			   			$_return['success'] = false;			      
						$_return['msg'] = msg(406);
						echo json_encode($_return);
						die();
			   		}
			   	}
			}
			else{
				$_return['success'] = false;
				$_return['msg'] = msg(403);
				echo json_encode($_return);
				die();
			}
		}
	}

	$imagen = subeImagen( '../../files/user/', 'imagen' );
	if( $imagen != false ){
		$_update['usu_foto'] 	= $imagen['nombre'];
	}	

	$_update['usu_sexo'] 		= $_POST['usr_sexo'];
	$_update['usu_caduca'] 		= $_POST['twitter'];
	$_update['usu_facebook'] 	= $_POST['facebook'];

	if( $mdb->update($_update, 'usu_id = ' . $_SESSION['usu_id']) ){
		$mdb->updateNamePost( $_POST['usu_nombre'] , $_SESSION['usu_id']);
		$_return['success'] = true;			      
		$_return['msg'] = msg(408);

		$_SESSION['user_full'] 	= $_update['usu_nombre'];
		$_SESSION['mail'] 		= $_update['usu_mail'];
		$_SESSION['sexo'] 		= $_update['usu_sexo'];
		$_SESSION['usu_caduca'] = $_update['usu_caduca'];
		$_SESSION['facebook']   = $_update['usu_facebook'];
		echo json_encode($_return);
	}
	else{
		$_return['success'] = false;
		$_return['msg'] = msg(407);
		echo json_encode($_return);
		die();
	}

	function msg($c){
		include '../../functions/languaje.php';
		switch ($c) {
			case 400: $msg = $GLOBALS[$ln]['user'][400]; break;
			case 401: $msg = $GLOBALS[$ln]['user'][401]; break;
			case 402: $msg = $GLOBALS[$ln]['user'][402]; break;
			case 403: $msg = $GLOBALS[$ln]['user'][403]; break;
			case 404: $msg = $GLOBALS[$ln]['user'][404]; break;
			case 405: $msg = $GLOBALS[$ln]['user'][405]; break;
			case 406: $msg = $GLOBALS[$ln]['user'][406]; break;
			case 407: $msg = $GLOBALS[$ln]['user'][407]; break;
			case 408: $msg = $GLOBALS[$ln]['user'][408]; break;
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