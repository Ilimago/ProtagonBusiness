<?php
	// En este archivo se almacenan todas las variables de session para el control de las interfaces
	session_start();
	// Se realiza la creacion de la variable de session solicitada.
	if( isset($_POST['SESSION-NAME']) )
	{
		if( !empty($_POST['SESSION-NAME']) )
		{
			$_SESSION['TEMP'][$_POST['SESSION-NAME']] = $_POST['SESSION-VALUE'];
		}
	}

	// Devuelve el arreglo de variables de session.
	if( isset($_POST['get']) )
	{
		if( !empty($_POST['get']) )
		{			
			echo json_encode( $_SESSION['TEMP'] );
		}
	}

	// Borra una bariable de session
	if( isset($_POST['unset']) )
	{
		if( !empty($_POST['unset']) )
		{	
			unset($_SESSION['TEMP'][$_POST['unset']]);
			$_result['success'] = true;
			echo json_encode( $_result );
		}
	}

	// Borra una bariable de session
	if( isset($_POST['reset']) )
	{
		if( !empty($_POST['reset']) )
		{	
			unset($_SESSION['TEMP']);
			$_result['success'] = true;
			echo json_encode( $_result );
		}
	}
?>