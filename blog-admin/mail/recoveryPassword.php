<?php
require_once '../functions/conexion.class.php';
require_once '../functions/conn.session.php';
require_once '../sc-user/model/login.class.php';
//require_once '../sc-customer/model/cliente.class.php';

if(isset($_POST['email'])  &&  !empty($_POST['email'])){
	$obj = new login;
	$password = $obj->new_password($_POST['email']);	
	if($password['return']){		
		$envia_mail = true;
		$data['para'] = $_POST['email'];
		$data['asunto'] = 'Nuevo Password';
		$data['template'] = 'templates/template-recovery.html';
		// ===============================================================================//
		$para = $data['para'];
		$titulo = $data['asunto'];

		echo $password['pass'];

		$mensaje = load_page($data['template']);
		$_REPLACE['CONTRASENA'] = $password['pass'];
		$mensaje = replace($mensaje,$_REPLACE);

		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$cabeceras .= 'From: GST Admin<recovery@cmsadmin.com.mx>' . "\r\n";
		// echo ' - ' . $para;
		if($envia_mail){
			if(mail($para, $titulo, $mensaje, $cabeceras)){
				$_retur['success'] = true;
				$_retur['msg'] = 'Se ha enviado un correo electronico con tu nueva contraseña.';				
			}else{		
				$_retur['success'] = false;
				$_retur['msg'] = 'Ha ocurrido un error y no hemos podido reestablecer tu contraseña, consulta con tu administrador';				
			}
		}
		
	}
	else{
		$_retur['success'] = false;
		$_retur['msg'] = 'Tu usuario no es valido';		
	}
}
else{
	$_retur['success'] = false;
	$_retur['msg'] = 'Proporciona tu cuanta de correo electrónico';	
}

echo json_encode($_retur);

function replace($template,$_DICTIONARY){
	foreach ($_DICTIONARY as $clave=>$valor) {
		$template = str_replace(':'.$clave.':', $valor, $template);
	}		
	return $template;
}

function load_page($page)
{
	return file_get_contents($page);
}

?>