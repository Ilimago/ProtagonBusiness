<?php
	require_once '../functions/conexion.class.php';
	require_once '../functions/config.php';
	require_once '../sc-sales/model/pedido.class.php';
	$pedido = new pedido();
	
	$data = $pedido->get( $_GET['pedido'] );	

	$envia_mail = true;
	$data['para'] = $GLOBALS['mail_web'];
	$data['asunto'] = 'Nuevo pedido!';
	$data['template'] = 'templates/nuevoPedido-admin.html';
	// ===============================================================================//
	// $para = 'alejandrog@netweb.com.mx';
	$para = $data['para'];
	$titulo = $data['asunto'];

	$mensaje = load_page($data['template']);

	$_REPLACE['pedido'] = $data[0]['ped_id'];
	$_REPLACE['fecha'] 	= $data[0]['ped_fecha_orden'];
	$_REPLACE['nombre'] = $data[0]['ped_cliente'];
	$_REPLACE['metodo'] = $data[0]['ped_tipo_pago'];
	$_REPLACE['monto'] 	= number_format( $data[0]['ped_total'],2, '.', ',' );

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