<?php
	require_once '../model/post.class.php';
	$mdb = new post();

	$registro = $mdb->get( sprintf('%d', $_GET['p']) );

	$js_catego = '';
	if( !empty($registro[0]['pst_categoria']) ){
		$catego = explode( ',', $registro[0]['pst_categoria'] );
		foreach ($catego as $item) {
			$aux[] = "'" . $item .  "'";
		}
		$js_catego = implode( ',', $aux );
	}

	$js_label = '';
	if( !empty($registro[0]['pst_etiqueta']) ){
		$label = explode( ',', $registro[0]['pst_etiqueta'] );
		foreach ($label as $item) {
			$aux2[] = "'" . $item .  "'";
		}
		$js_label = implode( ',', $aux2 );
	}

	if( !empty($registro[0]['pst_imagen']) ){
		$template = '<img id="imgPortada" src="../../files/img/' . $registro[0]['pst_imagen'] . '" class="img-thumbnail" style="width:100%; " />
                    <div class="featured-image-selection" style="display:none;">
                        <i class="fa fa-picture-o"></i><br>
                    </div>
                    <center id="quitImg">
                    	<a class="btn btn-danger btn-xs" href="javascript:eliminarPortadaTem('. $registro[0]['pst_id'] .');"> 
                    		<i class="fa fa-times"></i> Eliminar 
                    	</a>
                    </center>';
	}
	else{
		$template = '<img id="imgPortada" src="" class="img-thumbnail" style="width:100%; display:none;" />
                    <div class="featured-image-selection">
                        <i class="fa fa-picture-o"></i><br>
                    </div>
                    <center id="quitImg"></center>';
	}

	switch ( $registro[0]['pst_estatus'] ) {
		case 1:
			$rb_Es_1 = 'checked=""';
			$rb_Es_2 = '';
			$rb_Es_3 = '';
			break;
		case 2:
			$rb_Es_1 = '';
			$rb_Es_2 = 'checked=""';
			$rb_Es_3 = '';
			break;
		case 3:
			$rb_Es_1 = '';
			$rb_Es_2 = '';
			$rb_Es_3 = 'checked=""';
			break;
		
		default:
			$rb_Es_1 = '';
			$rb_Es_2 = '';
			$rb_Es_3 = '';
			break;
	}
?>