<?php
	@session_start();
	require_once '../../functions/conexion.class.php';
	require_once '../model/post.class.php';
	$mdb = new post();

	$mdb->depurar();

	$pagina_actual = sprintf('%d',$_GET['page']);
	$productos_por_pagina = 10;

	$where = ( isset($_GET['search']) )? " (pst_post like '%". $_GET['search'] ."%' OR pst_titulo like '%". $_GET['search'] ."%')" : "";
	$where = ( isset($_GET['label']) )? " (pst_etiqueta like '%". $_GET['label'] ."%')" : "";	
	$where = ( isset($_GET['catego']) )? " (pst_categoria like '%". $_GET['catego'] ."%')" : "";	

	$total = $mdb->getListByGruop( $where, sprintf('%d', $estatus), sprintf('%d', $grupo) );
	$paginas_totales = ceil( count($total) / $productos_por_pagina );

	if ( $pagina_actual== 1 | $pagina_actual== 0){
		$limit['ini'] = 0;
		$limit['fin'] = $productos_por_pagina;		
	}
	else{
		$limit['ini'] = $productos_por_pagina * $pagina_actual  - $productos_por_pagina;
		$limit['fin'] = $productos_por_pagina;
	}

	if ($_SESSION['usu_id'] == 1) { 
		$lista = $mdb->getListByGruopLimitAll( $where, sprintf('%d', $estatus), sprintf('%d', $grupo), $limit );
	}else{
		$lista = $mdb->getListByGruopLimit( $_SESSION['usu_id'], $where, sprintf('%d', $estatus), sprintf('%d', $grupo), $limit );
	}

	$_content = '';

	foreach ($lista as $key => $item) {
		$descripion = strip_tags( $item['pst_post'] );
		$descripion = substr( $descripion, 0, 210 );

		if( !empty($item['pst_imagen']) ){
			$txt_descrip = '<div class="col-sm-4"><img src="../../files/img/' . $item['pst_imagen'] . '" width="100%"></div>
							<div class="col-sm-8"><p>' . $descripion . ' [...]</p></div>';
		}
		else if( !empty($item['pst_img_url']) ){
			$txt_descrip = '<div class="col-sm-4"><img src="' . $item['pst_img_url'] . '" width="100%"></div>
							<div class="col-sm-8"><p>' . $descripion . ' [...]</p></div>';
		}else {
			$txt_descrip = '<p>' . $descripion . ' [...]</p>';
		}

		if ($estatus==0) {
			$EliminarPost='<div class="">
                                <a href="javascript:revertir(' . $item['pst_id'] . ');"><i class="fa fa-reply"></i> Volver A Publicar</a>
                            </div>
                            <div class="">
                                <a href="javascript:eliminarPostDef(' . $item['pst_id'] . ');"><i class="fa fa-trash-o"></i> Eliminar De BD</a>
                            </div>';
		}else{
			$EliminarPost='<div class="">
                                <a href="editar.php?p=' . $item['pst_id'] . '"><i class="fa fa-pencil"></i> Editar</a>
                            </div>
							<div class="">
                                <a href="javascript:deletePost(' . $item['pst_id'] . ');"><i class="fa fa-trash-o"></i> Eliminar</a>
                            </div>';
		}



		$template = '<!-- Post -->
                    <div class="row post-item" style="background-color:#fff;" id="post-' . $item['pst_id'] . '">
                        <div class="post-body">
                            <h1>' . $item['pst_titulo'] . '</h1>
                            <a href="editar.php?p=' . $item['pst_id'] . '">
                                ' . $txt_descrip . '
                            </a>
                        </div>
                        <div class="post-controls">
                            <!--<div class="">
                                <a href="../../../telecomunicaciones/post.php?p=' . $item['pst_friendly'] . '" target="_blank"><i class="fa fa-eye"></i> Vista Previa</a>
                            </div>-->
                            '.$EliminarPost.'
                            <div class="pull-right">
                                <i class="fa fa-user"></i> '.$item['usu_autor'].' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <i class="fa fa-clock-o"></i> ' . formatDate($item['pst_fecha']) . '
                            </div>
                        </div>                                        
                    </div>
                    <!-- /Post -->';

        
		$_content .= $template;
	}
	$empty = '<!-- Post -->
                    <div class="row post-item" style="background-color:#fff;">
                        <div class="post-body">
                            <h1>Vacio!</h1>                            
                            <p>En esta sección no se tiene registros guardados.</p>                            
                        </div>                                      
                    </div>
                    <!-- /Post -->';
	if( count($lista) == 0 )
	{
		$_content .= $empty;
	}

	// Botones de paginado  ?g=1&n=Noticias&page=1
	$url = $_SERVER['SCRIPT_NAME'] . '?';
	$url .= ( isset($_GET['search']) ) ? 'search=' . $_GET['search'] : '';
	$url .= ( isset($_GET['label']) ) ? 'label=' . $_GET['label'] : '';
	$url .= ( isset($_GET['catego']) ) ? 'catego=' . $_GET['catego'] : '';
	$url .= (isset($_GET['g']))? '&g=' . $_GET['g'] : '';
	$url .= (isset($_GET['n']))? '&n=' . $_GET['n'] : '';
	$url .= '&page=';

	if ( $pagina_actual== 1 | $pagina_actual== 0){
		if ( $paginas_totales > 1 ){
			$_content .= '<div class="col-sm-12 marging-top">              
		              <button class="btn btn-default btn-sm btn-flat pull-right" onclick="location.href = \''. $url . 2 .'\'">Entradas antiguas</button>
		          </div>';	
		}
	}
	else if( $pagina_actual == $paginas_totales ){
		// Final del paginado
		$_content .= '<div class="col-sm-12 marging-top">
	              <button class="btn btn-default btn-sm btn-flat" onclick="location.href = \''. $url . ($pagina_actual - 1) .'\'">Entradas recientes</button>
	          </div>';	
	}
	else if( $pagina_actual > $paginas_totales ){
		// Sobrepasando el paginado
		$_content .= '';	
	}else{
		// En medio del paginado
		$_content .= '<div class="col-sm-12 marging-top">
              <button class="btn btn-default btn-sm btn-flat" onclick="location.href = \''. $url . ($pagina_actual - 1) .'\'">Entradas recientes</button>
              <button class="btn btn-default btn-sm btn-flat pull-right" onclick="location.href = \''. $url . ($pagina_actual + 1) .'\'">Entradas antiguas</button>
          </div>';	
	}

	// Etiquetas
	if ($_SESSION['usu_id'] == 1) {
		$total1 = $mdb->getListTagsAll( $estatus );
	}else{
		$total1 = $mdb->getListTags( $_SESSION['usu_id'], $estatus );
	}
	$lbl_array = array();
	foreach ($total1 as $key => $value) {
		if( !empty($value['pst_etiqueta']) )
			$lbl_array[] = $value['pst_etiqueta'];
	}
	$lbl_string = implode(',', $lbl_array);
	$label = explode(",", $lbl_string);
	$etiquetas2 = array_unique( $label );
	foreach ($etiquetas2 as $key => $value) {
		$labels .= '<li><a class="btn btn-xs btn-primary" href="?label=' . $value . '">' . $value . '</a>&nbsp;</li>';
	}

	// Enlistamos las categogrias
	$cat_array = array();
	foreach ($total1 as $key => $value) {
		if( !empty($value['pst_categoria']) )
			$cat_array[] = $value['pst_categoria'];
	}
	$cat_string = implode(',', $cat_array);
	$catego = explode(",", $cat_string);
	$categorias = array_unique( $catego );
	foreach ($categorias as $key => $value) {
		$_categorias .= '<li><a href="?catego='.$value.'">'.$value.'</a></li>';
	}

	function formatDate( $date ){
		$fecha = strtotime( $date );

		switch ( date("N", $fecha) ) {
			case 1: $dia1 = 'Lunes'; break;
			case 2: $dia1 = 'Martes'; break;
			case 3: $dia1 = 'Miercoles'; break;
			case 4: $dia1 = 'Jueves'; break;
			case 5: $dia1 = 'Viernes'; break;
			case 6: $dia1 = 'Sabado'; break;
			case 7: $dia1 = 'Domingos'; break;
		}

		switch (  date("m", $fecha) ) {
			case 1: $mes = 'Enero'; break;
			case 2: $mes = 'Febrero'; break;
			case 3: $mes = 'Marzo'; break;
			case 4: $mes = 'Abril'; break;
			case 5: $mes = 'Mayo'; break;
			case 6: $mes = 'Junio'; break;
			case 7: $mes = 'Julio'; break;
			case 8: $mes = 'Agosto'; break;
			case 9: $mes = 'Septiembre'; break;
			case 10: $mes = 'Octubre'; break;
			case 11: $mes = 'Noviembre'; break;
			case 12: $mes = 'Diciembre'; break;

		}

		return $dia1 . ', ' . date("d", $fecha) . ' de ' . $mes . ' ' . date("Y", $fecha);
		
		// echo date("l", $fecha);
	}
?>