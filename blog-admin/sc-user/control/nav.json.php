<?php
	session_start();
	//Validamos el tipo de usuario
	if( ($_SESSION['perfil'] == 1) || ($_SESSION['perfil'] == 2) || ($_SESSION['perfil'] == 3)){
		$_nav[0]['ico'] 	= '<i class="fa fa-th-large"></i>';
		$_nav[0]['nombre'] 	= 'Productos';
		$_nav[0]['href'] 	= '../../sc-store/view';

		$_nav[1]['ico'] 	= '<i class="fa fa-file-text"></i>';
		$_nav[1]['nombre'] 	= 'Contenido';
		$_nav[1]['href'] 	= '../../sc-content/view/';
		
	}

	if( $_SESSION['perfil'] == 5 ){
		$_nav[0]['ico'] 	= '<i class="fa fa-th-large"></i>';
		$_nav[0]['nombre'] 	= 'Productos';
		$_nav[0]['href'] 	= '../../sc-store/view';
		
	}
	
	if( ($_SESSION['perfil'] == 4) || ($_SESSION['perfil'] == 6) || ($_SESSION['perfil'] == 7) ){
		$_nav[1]['ico'] 	= '<i class="fa fa-file-text"></i>';
		$_nav[1]['nombre'] 	= 'Contenido';
		$_nav[1]['href'] 	= '../../sc-content/view/';
		
	}

	echo json_encode( $_nav );


?>