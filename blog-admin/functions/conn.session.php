<?php
class conn_session{
	function conn_session(){}
	
	function session_starter($valores){
		if (ini_set('session.use_only_cookies', 1) === FALSE) {			
			exit();
		}
		
		// Configura una session segura
		$session_name = 'cms-admin';		
		$cookieParams = session_get_cookie_params();		
		session_set_cookie_params($cookieParams["lifetime"],
			$cookieParams["path"], 
			$cookieParams["domain"], 
			true,
			true);
		
		session_name($session_name);
		session_start();            // Inicia la sesión PHP.
		// session_regenerate_id();
		
		
		
		$user = explode(' ',$valores[0]['usu_nombre']);
		$_SESSION['login'] 		= true;
		$_SESSION['user'] 		= $user[0];
		$_SESSION['iduser'] 	= $valores[0]['usu_id'];
		$_SESSION['user_full'] 	= $valores[0]['usu_nombre'];
		$_SESSION['mail'] 		= $valores[0]['usu_mail'];
		$_SESSION['perfil'] 	= $valores[0]['usu_perfil'];
		$_SESSION['sexo'] 		= $valores[0]['usu_sexo'];
		$_SESSION['usu_id'] 	= $valores[0]['usu_id'];
		$_SESSION['usu_caduca'] = $valores[0]['usu_caduca'];
		$_SESSION['facebook']   = $valores[0]['usu_facebook'];
		$_SESSION['foto']		= $valores[0]['usu_foto'];
	}
	
	function session_destroyer(){
		$_SESSION['login'] 		= false;
		session_destroy();
	}
}
?>