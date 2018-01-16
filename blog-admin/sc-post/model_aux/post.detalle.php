<?php
	// require_once '../model/post.class.php';
	// require_once '../model/comentario.class.php';
	$mdb = new post();
	$user = new usuario();

	$amigable= str_replace("/innovacion/protagon/","", $_SERVER["REQUEST_URI"] );
	$registro = $mdb->getFriendly( $amigable );
	$mas_recientes = $mdb->getRecientes( 1 );	
	$total1 = $mdb->getListWhereByGruop( 'pst_id='.$registro[0]['pst_id'], sprintf('%d', $grupo) );
	

	$pst_id = $registro[0]['pst_id'];
	$pst_post = $registro[0]['pst_post'];
	$pst_titulo = $registro[0]['pst_titulo'];
	//$pst_fecha = formatDate($registro[0]['pst_fecha']);
	//$pst_st_autor = $registro[0]['usu_autor'];
	$pst_st_comment = ($registro[0]['pst_st_comentarios'] == 1) ? '' : 'style="display:none;"';
	$valida_social_media = $registro[0]['pst_st_socialmedia'];

    $decripcion_facebook = strip_tags( $registro[0]['pst_post'] );
    $decripcion_facebook = preg_replace('/\r?\n|\r/','', $decripcion_facebook);
    $decripcion_facebook = substr( $decripcion_facebook, 0, 150 );

    $opciones = '<div class="entry-meta">
					<button class="btn-user-blog" type="button" data-toggle="modal" data-target="#usuario">'.$registro[0]['usu_autor'].'</button>
                    <span><i class="icon-calendar"></i> '.formatDate($registro[0]['pst_fecha']).'</span>
                </div>';
	// Validamos si mostramos el contenido
	$userData = $user->getUser($registro[0]['usu_id']);
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

        $opciones.= '<div id="usuario" class="modal fade" role="dialog">
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
					                    <img src="../../blog-admin/files/user/'.$userData[0]['usu_foto'].'" width="100%">
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
	//$pst_st_autor = ( $registro[0]['pst_st_autor'] == 1 )? '<span><i class="icon-user"></i> <a href="#">'.$pst_st_autor.'</a></span>' : '';

	// Remplasamos los codigos especiales
	// Video/Otros	
	$pst_post = str_replace("==VIDEO==", $registro[0]['pst_otro'], $pst_post);
	$pst_post = str_replace("==YT-VIDEO==", embedYoutube($registro[0]['pst_yt_url']), $pst_post);

	$js_catego = '';
	if( !empty($registro[0]['pst_categoria']) ){
		$catego = explode( ',', $registro[0]['pst_categoria'] );
		foreach ($catego as $item) {
			$aux[] = "'" . $item .  "'";
		}
		$js_catego = implode( ',', $aux );
		$key_cat = str_replace("'","", $js_catego );
	}

	$js_label = '';
	if( !empty($registro[0]['pst_etiqueta']) ){
		$label = explode( ',', $registro[0]['pst_etiqueta'] );
		foreach ($label as $item) {
			$etiquetas .= '<a class="btn btn-xs btn-primary" href="../index.php?label=' . $item . '">'.$item.'</a>&nbsp;';
			$aux2[] = "'" . $item .  "'";
		}
		$js_label = implode( ',', $aux2 );
		$key_label = str_replace("'","", $js_label );
	}

	if( !empty($registro[0]['pst_imagen']) ){
		$pst_imagen = '<img class="img-responsive img-blog" src="../../blog-admin/files/img/' . $registro[0]['pst_imagen'] . '" width="100%" alt="" />';
        $imagen_url = 'http://'.$_SERVER["SERVER_NAME"].'/blog-admin/files/img/' . $registro[0]['pst_imagen'];
        //$pst_imagen = '<img class="img-responsive img-blog" src="http://www.ilimago.com.mx/nw-admin/files/img/' . $registro[0]['pst_imagen'] . '" width="100%" alt="" />';
        //$imagen_url = 'http://www.ilimago.com.mx/nw-admin/files/img/' . $registro[0]['pst_imagen'];
	}
	else{
		$pst_imagen = '';
        $imagen_url = $registro[0]['pst_img_url'];
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


	// Enlistamos las etiquetas
	$lbl_array = array();
	foreach ($total1 as $key => $value) {
		if( !empty($value['pst_etiqueta']) )
			$lbl_array[] = $value['pst_etiqueta'];
	}
	$lbl_string = implode(',', $lbl_array);
	$label = explode(",", $lbl_string);
	$etiquetas2 = array_unique( $label );
	foreach ($etiquetas2 as $key => $value) {
		$labels .= '<li><a class="btn btn-xs btn-primary" href="../index.php?label=' . $value . '">' . $value . '</a>&nbsp;</li>';
		$relacionados = $mdb->getRelacionados( $value );
	}

	foreach ($relacionados as $key => $value2) {
		if (!empty($value2['pst_imagen'])) {
			$img_rel= '../../blog-admin/files/img/'.$value2['pst_imagen'];
		}else if (!empty($value2['pst_img_url'])){
			$img_rel= $value2['pst_img_url'];
		}else{
			$img_rel='';
		}		

		$_relacionados.='<a href="' . $value2['pst_friendly'].'" class="relacio">
							<div class="item" style="margin-left: 10px; margin-right: 10px;">
	                            <div style="width:100%; height:170px; background: url('.$img_rel.') no-repeat center center; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;"></div>
                                <div class="cont_slider">
	                                <div class="row">
	                                    <div class="col-sm-12" style="padding-top:20px;">
	                                    	'.$value2['pst_titulo'].'
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </a>';
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
		//$_value.=$value;
		$_categorias.= '<li><a href="../index.php?catego='.$value.'">'.$value.'</a></li>';
	}

	foreach ($mas_recientes as $key => $value) {
		if (!empty($value['pst_imagen'])) {
			$img_landing='<img src="nw-admin/files/img/'.$value['pst_imagen'].'" width="100%">';
		}else if (!empty($value['pst_img_url'])){
			$img_landing='<img src="'.$value['pst_img_url'].'" width="100%">';
		}else{
			$img_landing='';
		}

		$fecha = formatDate($value['pst_fecha']);
		$_recientes.='<div class="recientes"><a href="../destinos.php?destinos='.$value['pst_friendly'].'">'.$value['pst_titulo'].'</a> <span>'.$fecha.'</span></div>';
		$_recientes_landing.='<div class="col-sm-3">
			                    <div class="postblog">
			                        '.$img_landing.'
			                        <h2>'.$value['pst_titulo'].'</h2>
			                        <a href="networking/destinos.php?destinos='.$value['pst_friendly'].'">VER DETALLE</a>
			                    </div>
			                </div>';
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

	function embedYoutube($url, $embedType = 'iframe') {
        $search = '%
        (?:https?://)?
        (?:www\.)?
        (?:
          youtu\.be/
        | youtube\.com
          (?:
            /embed/
          | /v/
          | /watch\?v=
          )
        )
        ([\w\-]{10,12})
        \b
        %x';
        $objReplace = '<object width="700" height="394">
        <param name="movie" value="http://www.youtube.com/v/$1?fs=1"></param>
        <param name="allowFullScreen" value="true"></param>
        <param name="allowscriptaccess" value="always"></param>
        <embed src="http://www.youtube.com/v/$1?fs=1" type="application/x-shockwave-flash" 
        width="560" height="315" allowscriptaccess="always" allowfullscreen="true">
        </embed>
        </object>';
        $iframeReplace = '<iframe width="700" height="394" 
            src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen>
            </iframe>';
        $replace = ($embedType != 'iframe') ? $objReplace : $iframeReplace;
        return preg_replace($search, $replace, $url);
    }
?>