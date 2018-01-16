<?php
	// Vaidacion de campos
	if( empty( $_POST['nombre'] ) ){
		$_asistent['msg'] = 'Inserta tu nombre';
		$_asistent['success'] = flase;
		echo json_encode($_asistent);
		die();
	}
	else if ( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
		$_asistent['msg'] = 'Proporciona un email válido';
		$_asistent['success'] = flase;
		echo json_encode($_asistent);
		die();
	}
	else if( empty( $_POST['comentarios'] ) ){
		$_asistent['msg'] = 'Nos interesa saber tus comentarios, favor de proporcionarlos';
		$_asistent['success'] = flase;
		echo json_encode($_asistent);
		die();
	}
	else{
		$captcha = md5(strtoupper($_POST['defaultReal']) . 'griant');
		if ($captcha == $_POST['realpersonhash']) {
			$_asistent['msg'] = 'Captcha Valido';
			$_asistent['success'] = true;
			// Envio de email
			$data['mensaje'] = '<h2>Datos del contacto</h2><br>
						<br><strong>Nombre: </strong> '.($_POST['nombre']).'
						<br><strong>E-mail: </strong> '.($_POST['email']).'	
                        <br><strong>Teléfono: </strong> '.($_POST['telphone']).'	
						<br>
						<strong>Comentario: </strong><br>
						<p style="text-align:left">'.($_POST['comentarios']).'</p>
						';
			$mensaje = load_page('templete/formato.html');
			$_REPLACE['MENSAJE'] = $data['mensaje'];
			$mensaje = replace($mensaje,$_REPLACE);

			require 'PHPMailer/PHPMailerAutoload.php';
			$mail = new PHPMailer;
            $mail->charSet = "UTF-8";
			$mail->isSMTP();
			$mail->Host = 'ilimago.com.mx';  			// Servidor SMTP
			$mail->SMTPAuth = true;
			$mail->Username = 'test@ilimago.com.mx';     // SMTP username
			$mail->Password = 'Iwey831127';              // SMTP password
			$mail->SMTPSecure = 'tls';
			$mail->Port = 25;
			$mail->isHTML(true);

			$mail->From = 'test@ilimago.com.mx';
            
			$mail->FromName = 'Alguien se ha contactado desde Ilimago';
			
            $mail->AddAddress('enlace@ilimago.com.mx');
            
            //$mail->AddBCC('leonardo.dejesus@netweb.com.mx');    
            //$mail->AddBCC('mbarraza@lola.io');

			$mail->Subject = 'Solicitud desde el formulario web';
			$mail->Body    = $mensaje;
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if(!$mail->send()) {
				$_asistent['msg'] = 'Message could not be sent: ' . $mail->ErrorInfo;
				$_asistent['success'] = flase;
				echo json_encode($_asistent);
				die();

			} else {
			    $_asistent['msg'] = 'Exito';
				$_asistent['success'] = true;
				echo json_encode($_asistent);
				die();
			}
			// Envio de email
		}
		else{			
			$_asistent['msg'] = 'Captcha incorrecto.';
			$_asistent['success'] = flase;
			echo json_encode($_asistent);
			die();
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