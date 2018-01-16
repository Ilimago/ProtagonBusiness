<?php
	require_once '../functions/conexion.class.php';
	require_once '../sc-customer/model/cliente.class.php';
	$cliente = new cliente();
	
	$data = $cliente->get( $_GET['cliente'] );	

	$envia_mail = true;
	$data['para'] = $data[0]['cli_email'];
	$data['asunto'] = 'Bienvenido!';
	$data['template'] = 'templates/nuevoRegistro.html';
	// ===============================================================================//
	// $para = 'alejandrog@netweb.com.mx';
	$para = $data['para'];
	$titulo = $data['asunto'];

	$mensaje = load_page($data['template']);
	$_REPLACE['email'] 		= $data[0]['cli_email'];
	$_REPLACE['CONTRASENA'] = $data[0]['cli_password'];
	$mensaje = replace($mensaje,$_REPLACE);

	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$cabeceras .= 'From: GST Admin<clientes@cmsadmin.com.mx>' . "\r\n";
		 
	if($envia_mail){
		if(mail($para, $titulo, $mensaje, $cabeceras)){
			$_retur['success'] = true;
			$_retur['msg'] = 'Se ha enviado un correo electronico con tu nueva contraseña.';				
		}else{		
			$_retur['success'] = false;
			$_retur['msg'] = 'Ha ocurrido un error y no hemos podido reestablecer tu contraseña, consulta con tu administrador';				
		}
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