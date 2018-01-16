<?php include '../../functions/autentic.php';
session_start(); 
date_default_timezone_set('America/Mexico_City');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Blog | Editar</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../sources/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../sources/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../sources/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../sources/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="../../sources/css/iCheck/all.css" rel="stylesheet" type="text/css">

        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../../sources/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap time Picker -->
        <link href="../../sources/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Bootstrap date Picker -->
        <link href="../../sources/css/datepicker/bootstrap-datepicker.min.css" rel="stylesheet"/>
        <!-- Magicsuggest -->
        <link href="../../sources/js/plugins/magicsuggest-master/magicsuggest-min.css" rel="stylesheet">
        <!-- Estilos personalizados -->
        <link rel="stylesheet" type="text/css" href="../../sources/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black fixed">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="../../sc-user/view/" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <img src="../../sources/img/logo.png">
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!--<li class="dropdown notifications-menu new-post">
                            <a href="post.php">
                                <i class="fa fa-reply"></i> Regresar
                            </a>                            
                        </li>-->
                        <?php include 'alert.php'; ?>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><span class="dUserName">Jane Doe</span> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/avatar3.png" class="img-circle img-usr" alt="User Image" />
                                    <p>
                                        <span class="dUserName">Jane Doe</span>
                                        <!--<small class="dEmpresa">Member since Nov. 2012</small>-->
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-8 text-center">
                                        <a href="#" class="dSistema">blog-admin</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#" class="dVersion">V3.1.0</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="../../sc-user/view/" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="../../functions/salir.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas collapse-left">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar3.png" class="img-circle img-usr" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p class="dSaludo">Hello</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>                    
                    <ul class="sidebar-menu" id="menuNav"></ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <?php                                        
                include '../control/post.unity.php';
            ?> 

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side strech">                
                <!-- Main content -->
                <section class="content">
                    <div class="container">
                        <form id="frm-post" name="frm-post" action="../control/post.editar.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="col-sm-12">
                                    <input type="hidden" name="pst_id" value="<?=$registro[0]['pst_id']?>">
                                    <input type="text" class="form-control in-titulo" value="<?=$registro[0]['pst_titulo']?>" name="titulo" required placeholder="Titulo" onblur="createURL(this);" onkeyup="createURL(this);">
                                    <input type="hidden" name="friendly" id="friendly" value="<?=$registro[0]['pst_friendly']?>">
                                    <label class="tx-friendly"><b>URL Friendly:</b> <span id="txt-titulo"><?=$registro[0]['pst_friendly']?></span></label>
                                </div>
                                <div class="col-sm-12">
                                    <textarea class="ckeditor" id="editorPost" name="post" style="width:500px;"><?=$registro[0]['pst_post']?></textarea>
                                    <div id="#msgBox"></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="col-sm-12 group-panel">
                                    <!-- Primary box -->
                                    <div class="box box-primary box-list collapsed-box">
                                        <div class="box-header" data-widget="collapse">
                                            <i class="fa fa-cog"></i>
                                            <h3 class="box-title">
                                                <span>Cambiar estatus</span><br>
                                                <!-- <span>Subtitulo extra</span> -->
                                            </h3>
                                            <div class="box-tools pull-right">
                                                <div><i class="fa pull-right fa-angle-down"></i></div>
                                            </div>
                                        </div>
                                        <div class="box-body no-padding" style="display: none;">
                                            <ul class="ul-rad">
                                                <li>
                                                    <label>
                                                        <input type="radio" name="status" <?=$rb_Es_1?> value="1">
                                                        <span>Publicar inmediatamente</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="radio" name="status" <?=$rb_Es_2?> value="2">
                                                        <span>Borrador</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="radio" name="status" <?=$rb_Es_3?> value="3">
                                                        <span>Programada</span>
                                                        <div style="margin-top:10px;">
                                                            <div class="col-xs-7">                                                        
                                                                <input id="datepicker" name="fecha" type="text" type="text" class="form-control" value="<?=$registro[0]['pst_fecha']?>" placeholder="<?=date("Y-m-d")?>">
                                                            </div>
                                                            <div class="col-xs-5">
                                                                <div class="bootstrap-timepicker pull-right">
                                                                    <input id="timepicker3" name="hora" type="text" value="<?=$registro[0]['pst_hora']?>" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </li>
                                            </ul>
                                        <br>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                    
                                    <!-- Primary box -->
                                    <div class="box box-primary box-list collapsed-box">
                                        <div class="box-header" data-widget="collapse">
                                            <i class="fa fa-tag"></i>
                                            <h3 class="box-title">
                                                <span>Categorias y Etiquetas</span><br>
                                            </h3>
                                            <div class="box-tools pull-right">
                                                <div><i class="fa pull-right fa-angle-down"></i></div>
                                            </div>
                                        </div>
                                        <div class="box-body" style="display: none;">
                                            <div class="tx-tit">CATEGORIAS</div>
                                            <div class="tx-label">Escribe tus categorias</div>
                                            <input name="categoria" id="magicsuggest-catego">
                                            <div class="tx-tit">ETIQUETAS</div>
                                            <div class="tx-label">Escribe tus etiquetas</div>   
                                            <input name="etiquetas" id="magicsuggest-label">                                         
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->

                                    <!-- Primary box -->
                                    <div class="box box-primary box-list collapsed-box">
                                        <div class="box-header" data-widget="collapse">
                                            <i class="fa fa-picture-o"></i>
                                            <h3 class="box-title">
                                                <span>IMAGEN DE PORTADA</span><br>
                                            </h3>
                                            <div class="box-tools pull-right">
                                                <div><i class="fa pull-right fa-angle-down"></i></div>
                                            </div>
                                        </div>
                                        <div class="box-body" style="display: none;">
                                            <?=$template?>
                                            <div class="custom-input-file cat_lbl" style="position:absolute; top:50%; left:22%;">
                                                <input type="file" size="1" id="img_croquis" name="imagen" class="input-file" onchange="loadPortada(this)" />
                                                <h5 id="nombre_img_3" style="display:none;"></h5>
                                                <p style="display:none;"><strong id="peso_img_3"></strong></p>
                                                <center>
                                                    <button class="btn btn-primary full-width" id="btnLoad">
                                                        <i class="fa fa-picture-o"></i> Cambiar imagen de perfil
                                                    </button>
                                                </center>
                                            </div>
                                            <br>
                                            <p class="tx-label">Nombre de la Imagen</p>
                                            <input type="text" name="pst_imagen_alt" class="form-control" value="<?=$registro[0]['pst_imagen_alt']?>">
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->

                                    <!-- Primary box -->
                                    <div class="box box-primary box-list collapsed-box">
                                        <div class="box-header" data-widget="collapse">
                                            <i class="fa fa-link"></i>
                                            <h3 class="box-title">
                                                <span>IMAGEN DE PORTADA LINK</span><br>
                                            </h3>
                                            <div class="box-tools pull-right">
                                                <div><i class="fa pull-right fa-angle-down"></i></div>
                                            </div>
                                        </div>
                                        <div class="box-body" style="display: none;">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <p class="tx-label">Pegar URL de la imagen</p>
                                                    <input type="text" name="pst_img_url" value="<?=$registro[0]['pst_img_url']?>" class="form-control" placeholder="https://">
                                                </div>
                                            </div>
                                            <br>
                                            <p class="tx-label">Nombre de la Imagen</p>
                                            <input type="text" name="pst_img_url_alt" class="form-control" value="<?=$registro[0]['pst_img_url_alt']?>">
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->

                                    <!-- Primary box -->
                                    <div class="box box-primary box-list collapsed-box">
                                        <div class="box-header" data-widget="collapse">
                                            <i class="fa fa-youtube-play"></i>
                                            <h3 class="box-title">
                                                <span>VIDEO DE YOUTUBE</span><br>
                                            </h3>
                                            <div class="box-tools pull-right">
                                                <div><i class="fa pull-right fa-angle-down"></i></div>
                                            </div>
                                        </div>
                                        <div class="box-body" style="display: none;">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <p class="tx-label">Pegar URL del video de YouTube</p>
                                                    <input type="text" name="yt-url-video" value="<?=$registro[0]['pst_yt_url']?>" class="form-control" placeholder="https://www.youtube.com/watch?v=nCkpzqqog4k">
                                                </div>
                                                <!-- <div class="col-xs-6">
                                                    <label>Ancho:</label>
                                                    <input type="text" name="yt-ancho" value="<?=$registro[0]['pst_yt_ancho']?>" class="form-control" placeholder="100 px/%">
                                                </div>
                                                <div class="col-xs-6">
                                                    <label>Alto:</label>
                                                    <input type="text" name="yt-alto" value="<?=$registro[0]['pst_yt_alto']?>" class="form-control" placeholder="100 px/%">
                                                </div> -->
                                                <!-- <div class="col-xs-4">
                                                    <label>Reproducir</label>
                                                    <select class="form-control" name="yt-autoplay">
                                                        <option value="0" <?=($registro[0]['pst_yt_autoplay'] == 0) ? 'selected=""' : ''; ?> >No</option>
                                                        <option value="1" <?=($registro[0]['pst_yt_autoplay'] == 1) ? 'selected=""' : ''; ?> >Si</option>
                                                    </select>
                                                </div> -->
                                                <div class="col-xs-12">
                                                    <p class="tx-label">Pega dentro del editor de texto ==YT-VIDEO== para colocar el video dentro del POST.</p>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->

                                    <!-- Primary box -->
                                    <div class="box box-primary box-list collapsed-box">
                                        <div class="box-header" data-widget="collapse">
                                            <i class="fa fa-vimeo-square"></i>
                                            <h3 class="box-title">
                                                <span>VIMEO / OTRO</span><br>
                                            </h3>
                                            <div class="box-tools pull-right">
                                                <div><i class="fa pull-right fa-angle-down"></i></div>
                                            </div>
                                        </div>
                                        <div class="box-body" style="display: none;">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <textarea name="video-otro" class="form-control" placeholder="Pegar iframe del video."><?=$registro[0]['pst_otro']?></textarea>
                                                </div>
                                                <div class="col-xs-12">
                                                    <p class="tx-label">Pega dentro del editor de texto ==VIDEO== para colocar el video dentro del POST.</p>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->

                                    <!-- Primary box -->
                                    <div class="box box-primary box-list collapsed-box">
                                        <div class="box-header" data-widget="collapse">
                                            <i class="fa fa-cogs"></i>
                                            <h3 class="box-title">
                                                <span>CONFIGURACION AVANZADA</span><br>
                                                <span>Caracteristicas generales</span>
                                            </h3>
                                            <div class="box-tools pull-right">
                                                <div><i class="fa pull-right fa-angle-down"></i></div>                                                
                                            </div>
                                        </div>
                                        <div class="box-body" style="display: none;">
                                            <ul class="ul-rad">
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="st-socialmedia" <?=($registro[0]['pst_st_socialmedia'] == 1) ? 'checked=""' : ''; ?> value="1">
                                                        <span>Permitir social media</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="stcomentarios" <?=($registro[0]['pst_st_comentarios'] == 1) ? 'checked=""' : ''; ?> value="1">
                                                        <span>Permitir comentarios</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="st-autor" <?=($registro[0]['pst_st_autor'] == 1) ? 'checked=""' : ''; ?> value="1">
                                                        <span>Mostrar Autor</span>                                                        
                                                    </label>
                                                </li>
                                                <li>
                                                    <label>
                                                        <span>Autor</span>                                                        
                                                        <input type="text" name="usu-autor" value="<?=$_SESSION['user_full']?>" class="form-control">                                                        
                                                        <input type="hidden" name="usu-id" value="<?=$_SESSION['usu_id']?>">
                                                    </label>
                                                </li>
                                            </ul>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->

                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="col-sm-12 marging-top">
                                    <!-- <span onclick="" class="btn btn-default btn-sm btn-flat">Vista Previa</span> -->
                                    <button onclick="" class="btn btn-primary btn-sm btn-flat pull-right">Guardar y publicar</button>
                                    <span onclick="location.href = 'post.php';" class="btn btn-default btn-sm btn-flat pull-right">Regresar al listado</span>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- jQuery 1.11.2 -->
        <script src="../../sources/js/jquery-1.11.2.js"></script>
        <!-- Bootstrap -->
        <script src="../../sources/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../sources/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- CKEDITOR -->
        <script type="text/javascript" src="../../sources/js/plugins/ckeditor/ckeditor.js"></script>
        <!-- CKFINDER -->
        <script type="text/javascript" src="../../sources/js/plugins/ckfinder/ckfinder.js"></script>
        <!-- bootstrap time picker -->
        <script src="../../sources/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- bootstrap date picker -->
        <script src="../../sources/js/plugins/datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>        
        <!-- Magicsuggest -->
        <script src="../../sources/js/plugins/magicsuggest-master/magicsuggest-min.js"></script>

        <!-- Incluimos scripts de alimentacion -->
        <script type="text/javascript" src="../../sc-user/js/user.js"></script>
        <script type="text/javascript" src="../../sc-user/js/nav.js"></script>
        <script type="text/javascript" src="../../sources/js/functions.js"></script>
        <script type="text/javascript" src="../js/productos.js"></script>
        <script type="text/javascript" src="../js/post.js"></script>
        <script type="text/javascript">
            var imgen_portal = "<?=$registro[0]['pst_imagen']?>";
            var boton_elimar = $("#quitImg").html();
            $(function() {
                //Timepicker
                $('#timepicker3').timepicker({
                    minuteStep: 2,
                    showInputs: false,
                    disableFocus: true,
                    showMeridian:false
                });

                //Datepicker
                $('#datepicker').datepicker({
                    format: "yyyy/mm/dd",
                    todayHighlight: true
                });

                // Magicsuggest
                $('#magicsuggest-catego').magicSuggest({
                    value: [<?=$js_catego?>]
                });


                $('#magicsuggest-label').magicSuggest({
                    value: [<?=$js_label?>]
                });

                var editorPost = CKEDITOR.replace('editorPost');
                CKFinder.setupCKEditor( editorPost, '../../sources/js/plugins/ckfinder/' ) ;
                var alto = $( window ).height() - 350;
                alto = ( alto < 350 ) ? 350 : alto;
                editorPost.config.height = alto + "px"                
                // CKFinder.setupCKEditor( editor1, 'app/view/js/ckfinder/' ) ;
            });
            $( window ).resize(function() {
                alto = $( window ).height() - 350;
                alto = ( alto < 350 ) ? 350 : alto;
                $("#cke_1_contents").css( "height", alto );
            });
        </script>
        
    </body>
</html>
