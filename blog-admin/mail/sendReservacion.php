<?php
$envia_mail = true;

$data['para'] = 'alex9abril@gmail.com';
$data['asunto'] = 'Hay una nueva reservación.';

$data['mensaje'] = '<h2>Datos del contacto via WebSite</h2><br>
					<br><strong>Nombre: </strong> '.utf8_decode($_POST['nombre']).'
					<br><strong>e-mail: </strong> '.utf8_decode($_POST['mail']).'
					<br><strong>Tel.: </strong> '.utf8_decode($_POST['tel']).'
					<br><strong>Asunto: </strong> Resrevación!
					<br>
					<strong>Mensaje: </strong><br>
					<pre style="text-align:left">'.utf8_decode($_POST['mensaje']).'</pre>
					';

$data['template'] = 'template-1.html';

// ===============================================================================//

$para = $data['para'];
// Asunto
$titulo = $data['asunto'];		 
// Cuerpo o mensaje
$mensaje = load_page($data['template']);
$_REPLACE['ENCABEZADO'] = 'Hay una nueva reservación!';
$_REPLACE['MENSAJE'] = $data['mensaje'];
$mensaje = replace($mensaje,$_REPLACE);

// Cabecera que especifica que es un HMTL
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
 
// Cabeceras adicionales
$cabeceras .= 'From: Resrevaciones Web <contacto@goandlive.com.mx>' . "\r\n";
$cabeceras .= 'Cc: alejandrog@netweb.com.mx' . "\r\n";
 
// enviamos el correo!
if($envia_mail){
	if(mail($para, $titulo, $mensaje, $cabeceras)){
		/*echo "<script>alert('Su mensaje se ha enviado a nuestros administradores');location.href = '../contacto.php';</script>";*/
		echo 'Exito';
	}else{
		/*echo "<script>location.href = '../contacto.php';</script>";*/
		echo 'Error';
	}
}


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