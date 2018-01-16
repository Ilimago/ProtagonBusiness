<?php
	@session_start();
	require_once '../../functions/conexion.class.php';
	require_once '../model/post.class.php';
	$mdb = new post();

	$pagina_actual = sprintf('%d',$_GET['page']);
	$productos_por_pagina = 10;

	// Filtros de categorias y etiquetas
	$where1 = ( isset($_GET['catego']) )? " pst_categoria like '%". $_GET['catego'] ."%'" : "";
	$where2 = ( isset($_GET['label']) )? " pst_etiqueta like '%". $_GET['label'] ."%'" : "";
	$where3 = ( isset($_GET['search']) )? " pst_post like '%". $_GET['search'] ."%' OR pst_titulo like '%". $_GET['search'] ."%'" : "";
	$where = $where1 . $where2 . $where3;

	$total = $mdb->getListWhereByGruop( $where, sprintf('%d', $grupo) );
	$total1 = $mdb->getListWhereByGruop( '', sprintf('%d', $grupo) );
	$paginas_totales = ceil( count($total) / $productos_por_pagina );

	if ( $pagina_actual== 1 | $pagina_actual== 0){
		$limit['ini'] = 0;
		$limit['fin'] = $productos_por_pagina;		
	}
	else{
		$limit['ini'] = $productos_por_pagina * $pagina_actual  - $productos_por_pagina;
		$limit['fin'] = $productos_por_pagina;
	}

	$lista = $mdb->getListWhereByGruopLimit( $where, sprintf('%d', $grupo), $limit );

	foreach ($lista as $item) {
		$descripion = strip_tags( $item['pst_post'] );
		$descripion = substr( $descripion, 0, 500 );

		if( empty($item['pst_imagen']) ){
			$img_blog = '';
		}
		else {
			$img_blog = '<img class="img-responsive img-blog" src="../../files/img/' . $item['pst_imagen'] . '" width="100%" alt="" />';
		}
		$st_autor = ( $item['pst_st_autor'] == 1 )? '<span><i class="icon-user"></i> <a href="#">'.$item['usu_autor'].'</a></span>' : '';

		$opciones = '<div class="entry-meta">
                         '.$st_autor.'
                         <span><i class="icon-calendar"></i> '.formatDate($item['pst_fecha']).'</span>
                         '.$txt_coment.'
                     </div>';


		$_REPLACE['IMAGEN'] 	= $img_blog;
		$_REPLACE['TITULO'] 	= $item['pst_titulo'];
		$_REPLACE['OPCIONES'] 	= $opciones;
		$_REPLACE['CONTENIDO'] 	= $descripion . '[...]';
		$_REPLACE['DETALLE'] 	= 'post.php?p=' . $item['pst_friendly'];

		$blog_item .= replace($html, $_REPLACE);		
	}
	$empty = '<!-- Post -->
                    <div class="row post-item" style="background-color:#fff; padding:30px;">
                        <div class="post-body">
                            <h1>Vacio!</h1>                            
                            <p>No hay ni un post publicado.</p>
                        </div>                                      
                    </div>
                    <!-- /Post -->';
	if( count($lista) == 0 )
	{
		$blog_item = $empty;
	}

	// Botones de paginado  ?g=1&n=Noticias&page=1
	$url = $_SERVER['SCRIPT_NAME'] . '?';

	$url .= ( isset($_GET['label']) ) ? 'label=' . $_GET['label'] : '';
	$url .= ( isset($_GET['catego']) ) ? 'catego=' . $_GET['catego'] : '';
	$url .= ( isset($_GET['search']) ) ? 'search=' . $_GET['search'] : '';

	$url .= (isset($_GET['g']))? '&g=' . $_GET['g'] : '';
	$url .= (isset($_GET['n']))? '&n=' . $_GET['n'] : '';
	$url .= '&page=';


	if ( $pagina_actual== 1 | $pagina_actual== 0){
		if ( $paginas_totales > 1 ){
			$paginador = '<br><div class="col-sm-12 marging-top">              
		              <button class="btnentradas" onclick="location.href = \''. $url . 2 .'\'">Entradas antiguas</button>
		          </div>';	
		}
	}
	else if( $pagina_actual == $paginas_totales ){
		// Final del paginado
		$paginador .= '<br><div class="col-sm-12 marging-top">
	              <button class="btnentradas" onclick="location.href = \''. $url . ($pagina_actual - 1) .'\'">Entradas recientes</button>
	          </div>';	
	}
	else if( $pagina_actual > $paginas_totales ){
		// Sobrepasando el paginado
		$paginador .=  '';	
	}else{
		// En medio del paginado
		$paginador .=  '<br><div class="col-sm-12 marging-top">
              <button class="btnentradas" onclick="location.href = \''. $url . ($pagina_actual - 1) .'\'">Entradas recientes</button>
              <button class="btnentradas" onclick="location.href = \''. $url . ($pagina_actual + 1) .'\'">Entradas antiguas</button>
          </div>';	
	}

	// Enlistamos las etiquetas
	$lbl_array = array();
	foreach ($total1 as $key => $value) {
		if( !empty($value['pst_etiqueta']) )
			$lbl_array[] = $value['pst_etiqueta'];
	}
	$lbl_string = implode(',', $lbl_array);
	$label = explode(",", $lbl_string);
	$etiquetas = array_unique( $label );
	foreach ($etiquetas as $key => $value) {
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



	// echo '<pre>';
	// print_r($label);
	// print_r($etiquetas);
	// echo '</pre>';
	// print $lbl_string;
	
	function replace($template,$_DICTIONARY){
		foreach ($_DICTIONARY as $clave=>$valor) {
			$template = str_replace('#'.$clave.'#', $valor, $template);
		}		
		return $template;
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