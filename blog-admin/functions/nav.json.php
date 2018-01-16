<?php
	session_start();
	include 'languaje.php';
	//Validamos el tipo de usuario
	if( ($_SESSION['perfil'] == 1) ){
		// $_nav[0]['ico'] 	= '<i class="fa fa-th-large"></i>';
		// $_nav[0]['nombre'] 	= 'Productos';
		// $_nav[0]['href'] 	= $GLOBALS['url_proyect'] . 'nw-admin/sc-store/view';

		// $_nav[2]['ico'] 	= '<i class="fa fa-file-text"></i>';
		// $_nav[2]['nombre'] 	= 'Clientes';
		// $_nav[2]['href'] 	= $GLOBALS['url_proyect'] . 'nw-admin/sc-customer/view/';

		// $_nav[3]['ico'] 	= '<i class="fa fa-file-text"></i>';
		// $_nav[3]['nombre'] 	= 'Pedidos';
		// $_nav[3]['href'] 	= $GLOBALS['url_proyect'] . 'nw-admin/sc-order/view/';
		
		//$_nav[0]['ico'] 	= '<i class="fa fa-file-text"></i>';
		//$_nav[0]['nombre'] 	= 'Contenido';
		//$_nav[0]['href'] 	= $GLOBALS['url_proyect'] . 'nw-admin/sc-content/view/galeria.php?g=1&n=Galería Home';

		$_nav[1]['ico'] 	= '<i class="fa fa-file-text"></i>';
		$_nav[1]['nombre'] 	= 'Blog';
		$_nav[1]['href'] 	= $GLOBALS['url_proyect'] . 'blog-admin/sc-post/view/post.php';

	}else if( ($_SESSION['perfil'] == 2) ){

		$_nav[0]['ico'] 	= '<i class="fa fa-file-text"></i>';
		$_nav[0]['nombre'] 	= 'Blog';
		$_nav[0]['href'] 	= $GLOBALS['url_proyect'] . 'blog-admin/sc-post/view/post.php';

	}else{
		
		$_nav[0]['ico'] 	= '<i class="fa fa-dashboard"></i>';
		$_nav[0]['nombre'] 	= 'Productos SL';
		$_nav[0]['href'] 	= 'productos.html';

	}

	echo json_encode( $_nav );


?>