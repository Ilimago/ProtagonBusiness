<?php
	require_once '../model/post.class.php';
	$mdb = new post();

	$_tabla['pst_estatus'] = 1;

	if( $mdb->update($_tabla, 'pst_id = ' . sprintf('%d',$_POST['pst_id'] ) ) ){
		$_return['success'] = true;			      
		$_return['msg'] = 'El POST ha sido publicado nuevamente.';			
		echo json_encode($_return);
		// echo '<script>location.href = "../../view/' . $url . '";</script>';
	}
	else{
		$_return['success'] = false;
		$_return['msg'] = 'Ocurrio un error inesperado!';
		// echo '<script>location.href = "../../view/' . $url . '";</script>';
		echo json_encode($_return);
		die();
	}
?>