<?php date_default_timezone_set('America/Mexico_City');?>
<?php
    $estatus = 1;
    $html = '            
            <div class="post-cont">
                <br>
                <div class="row no-padding">
                    <div class="col-sm-1 col-xs-2">
                        <div class="iconpost">
                            <i class="flaticon-dots16"></i>
                        </div>
                    </div>
                    <div class="col-sm-11 col-xs-10">
                        <div class="style-post paddgral">
                            <h2><a href="#DETALLE#">#TITULO#</a></h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row no-padding">
                    <div class="col-sm-5">
                        <div style="overflow:hidden;">
                            <a href="#DETALLE#">#IMAGEN#</a>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="space2 visible-xs"></div>
                        <div class="row">
                            <div class="col-xs-2">
                                <div class="iconpost">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="col-xs-10">
                                <div class="space1"></div>
                                <div class="creditos">
                                    #OPCIONES#
                                </div>
                            </div>
                        </div>
                        <div class="space1"></div>
                        <hr>
                        <div class="space1"></div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="style-post paddgral">
                                    <p>#CONTENIDO#</p>
                                    <div class="space2"></div>
                                    <hr>
                                    <a href="#DETALLE#" class="btngo"><i class="flaticon-plus81"></i>   Ver artículo completo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            ';
    // include '../control/post.publicadas.php';
    require_once '../blog-admin/functions/conexion.class.php';
    require_once '../blog-admin/sc-post/model_aux/post.class.php';
    require_once '../blog-admin/sc-post/model_aux/usuario.class.php';
    include '../blog-admin/sc-post/model_aux/post.publicadas.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Protagon Business | La manera natural de conectar negocios</title>
        
        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet"> 
        <link href="css/responsive.css" rel="stylesheet"> 
        <link href="css/blog.css" rel="stylesheet">  
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet"> 

        <link href="fonts/flaticon.css" rel="stylesheet"> 
        <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Quicksand|Maven+Pro' rel='stylesheet' type='text/css'>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body> 
    <div class="blogs">
        <div class="tvacia hidden-sm hidden-xs">
            Protagon Business
        </div>
        <div class="creditoss">
            Todos los derechos reservados a <a href="http://www.protagonbusiness.com">Protagon Business</a>
        </div>
        <div class="col-full">
            <div class="space2"></div>
            <div class="row no-padding">
                <div class="col-sm-10 col-xs-10">
                    <div class="logo-protagon">
                        <img src="img/logo-protagon-business-w.png">
                    </div>
                </div>

                <div class="col-sm-2 col-xs-2">
                    <div class="menu-bars">
                        <a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="space2"></div>
            <div class="row no-padding hidden-xs">
                <div class="col-sm-12">
                    <div class="titulo-prot">
                        <h1>La manera natural de conectar negocios.</h1>
                    </div>
                </div>
            </div>
            <div class="space10 hidden-xs hidden-sm"></div>
            <div class="row no-padding">
                <div class="col-sm-12 encuentra">
                    <h4>Encuentra el contenido de tu interés</h4>
                    <div class="widget search">
                        <form role="form">
                            <div class="input-group">
                                <input name="search" type="text" class="form-control" autocomplete="off" placeholder="Buscar contenido">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Buscar</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="space2 visible-xs"></div>
                </div>
            </div>
        </div>
        <div class="col-cont">
            <div class="blog">
                <div id="device">
                    <?php                        
                        print $blog_item;
                    ?>
                </div>
                <?php                        
                    print $paginador;
                ?>
                <br><br><br>
            </div>
        </div>
        <div class="col-tags">
            <div class="contenidos-right bg-wite">
                <br>
                <div style="height:9px; background-image: url(img/arroucito.png);  margin:10px;"></div>
                <!--Buscador y más...-->
                <div class="more-cont">
                    <hr>
                    <h4><i class="fa fa-rss" aria-hidden="true"></i>&ensp; Categorias del blog</h4>
                    <ul class="categ list-inline">
                        <?=$_categorias?>
                    </ul>
                    <hr>
                    <h4><i class="fa fa-tags" aria-hidden="true"></i>&ensp; Nube de etiquetas</h4>
                    <ul class="etique list-inline">
                        <?=$labels?>
                    </ul>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="scrollup">Scroll</a>
    <script src="js/icontop.js"></script>
    <!-- Bootrap -->
    <script src="js/bootstrap.js"></script>
</body>
</html>