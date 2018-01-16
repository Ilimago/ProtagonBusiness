<?php
	@session_start();
	$mdb = new post();
	$user = new usuario();

	$mdb->actualizarprogramados();

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

	$id=1;
	foreach ($lista as $item) {
		$descripion = strip_tags( $item['pst_post'] );
		$descripion = substr( $descripion, 0, 500 );

		if( !empty($item['pst_imagen']) ){
			$img_blog = '<img class="piceff" src="../blog-admin/files/img/' . $item['pst_imagen'] . '" width="100%" alt="'.$item['pst_imagen_alt'].'" />';
		}
		else if( !empty($item['pst_img_url']) ){
			$img_blog = '<img class="piceff" src="' . $item['pst_img_url'] . '" width="100%" alt="'.$item['pst_img_url_alt'].'" />';
		}else{
			$img_blog = '';
		}

		$st_autor = ( $item['pst_st_autor'] == 1 )? '<span><i class="icon-user"></i> <a href="#">'.$item['usu_autor'].'</a></span>' : '';

		$opciones = '<div class="entry-meta">
						<button class="btn-user-blog" type="button" data-toggle="modal" data-target="#usuarios'.$id.'">'.$st_autor.'</button>
						
                        <span><i class="icon-calendar"></i> '.formatDate($item['pst_fecha']).'</span>
                    </div>';
        $userData = $user->getUser($item['usu_id']);

        if ( empty($userData[0]['usu_caduca']) ){
        	$Boton_twitter='';
        }else{
        	$Boton_twitter='<li><a href="'.$userData[0]['usu_caduca'].'" target="_blank" style="text-decoration:none"><i class="fa fa-twitter-square" aria-hidden="true"></i>&ensp;&ensp;Twitter</a></li>';
        }

        if ( empty($userData[0]['usu_facebook']) ){
        	$Boton_face='';
        }else{
        	$Boton_face='<li><a href="'.$userData[0]['usu_facebook'].'" target="_blank" style="text-decoration:none"><i class="fa fa-facebook-square" aria-hidden="true"></i>&ensp;&ensp;Facebook</a></li>';
        }

        $opciones.= '<div id="usuarios'.$id.'" class="modal fade" role="dialog">
					  <div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">PERFIL DEL BLOGGER</h4>
					      </div>
					      <div class="modal-body">
					        <div class="row">
					            <div class="col-sm-4">
					                <div class="pic-blgger">
					                    <img src="../blog-admin/files/user/'.$userData[0]['usu_foto'].'" width="100%">
					                </div>
					            </div>
					            <div class="col-sm-8">
					                <div class="style-post">
					                    <h2 style="margin:0px;">'.$userData[0]['usu_nombre'].'</h2>
					                    <br>
					                    <p>'.$userData[0]['usu_sexo'].'</p>
					                    <hr>
					                    <ul class="list-inline">
					                        '.$Boton_twitter.' '.$Boton_face.'
					                    </ul>
					                </div>
					            </div>
					        </div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      </div>
					    </div>

					  </div>
					</div>';
        


		$_REPLACE['IMAGEN'] 	= $img_blog;
		$_REPLACE['TITULO'] 	= $item['pst_titulo'];
		$_REPLACE['OPCIONES'] 	= $opciones;
		$_REPLACE['CONTENIDO'] 	= $descripion . '[...]';
		$_REPLACE['DETALLE'] 	= 'protagon/' . $item['pst_friendly'];

		$blog_item .= replace($html, $_REPLACE);
	$id++;	
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
		              <button class="btn btn-default btn-sm btn-flat pull-right" onclick="location.href = \''. $url . 2 .'\'">Entradas antiguas</button>
		          </div>';	
		}
	}
	else if( $pagina_actual == $paginas_totales ){
		// Final del paginado
		$paginador .= '<br><div class="col-sm-12 marging-top">
	              <button class="btn btn-default btn-sm btn-flat" onclick="location.href = \''. $url . ($pagina_actual - 1) .'\'">Entradas recientes</button>
	          </div>';	
	}
	else if( $pagina_actual > $paginas_totales ){
		// Sobrepasando el paginado
		$paginador .=  '';	
	}else{
		// En medio del paginado
		$paginador .=  '<br><div class="col-sm-12 marging-top">
              <button class="btn btn-default btn-sm btn-flat" onclick="location.href = \''. $url . ($pagina_actual - 1) .'\'">Entradas recientes</button>
              <button class="btn btn-default btn-sm btn-flat pull-right" onclick="location.href = \''. $url . ($pagina_actual + 1) .'\'">Entradas antiguas</button>
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