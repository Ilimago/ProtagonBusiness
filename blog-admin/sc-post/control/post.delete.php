<?php
	require_once '../model/post.class.php';
	$mdb = new post();

	if( $mdb->delete( $_POST['pst_id'] ) ){
		$_return['success'] = true;			      
		$_return['msg'] = 'El POST se ha eliminado de la BD.';			
		echo json_encode($_return);

		$imgn = $mdb->get( sprintf('%d', $_POST['pst_id']) );
		if (!empty($imgn[0]['pst_imagen'])) {
			$dir="../../files/img/".$imgn[0]['pst_imagen'];
			unlink($dir);
		}
		
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