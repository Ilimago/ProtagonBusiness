<?php date_default_timezone_set('America/Mexico_City');?>
<?php 
    session_start();
    require_once '../../blog-admin/functions/conexion.class.php';
    require_once '../../blog-admin/sc-post/model_aux/post.class.php';
    require_once '../../blog-admin/sc-post/model_aux/usuario.class.php';
    include '../../blog-admin/sc-post/model_aux/post.detalle.php'; 
?>
<?php $url_actual = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pst_titulo?></title>
    
    <!--Metas SEO-->
    <meta name="keywords" CONTENT="<?=$key_cat?>,<?=$key_label?>">
    <meta name="title" content="<?=$pst_titulo?>">
    <meta name="description" CONTENT="<?=$decripcion_facebook?>">
    <meta name="robots" content="index,follow">
    <meta name="revisit-after" content="5 day">
    <meta name="distribution" content="Global">
    <meta name="language" content="es">
    <meta name="identifier-url" content="<?=$url_actual?>">  
    <link rel="canonical" href="<?=$url_actual?>" />      
    <!-- Google Plus -->
    <meta itemprop="name" content="<?=$pst_titulo?>">
    <meta itemprop="description" content="<?=$decripcion_facebook?>">
    <meta itemprop="image" content="<?=$imagen_url?>">
   
    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@protagonbusines">
    <meta name="twitter:title" content="<?=$pst_titulo?>">
    <meta name="twitter:description" content="<?=$decripcion_facebook?>">
    <meta name="twitter:creator" content="@protagonbusines">
    <meta name="twitter:image" content="<?=$imagen_url?>">

    
    <meta property="og:url" content="<?=$url_actual?>" />
    <meta property="og:title" content="<?=$pst_titulo?>" />
    <meta property="og:description" content="<?=$decripcion_facebook?>" />
    <meta property="og:image" content="<?=$imagen_url?>" />
    <meta property="og:site_name" content="Protagon Business"/>  

    <!--Metas SEO-->
    <!--Comentarios de facebook-->
    <meta content='Protagon Business' property='og:site_name'/>
    <meta content='1177322922396720' property='fb:app_id'/>
    <meta content='https://www.facebook.com/protagon.oficial/' property='fb:admins'/>
    <!--/ Comentarios de facebook-->
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet"> 
    <link href="../css/responsive.css" rel="stylesheet"> 
    <link href="../css/blog.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
   
    <link href="../fonts/flaticon.css" rel="stylesheet"> 
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Quicksand|Maven+Pro' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <style>
        .fb_reset {
            font-family: "Maven Pro",sans-serif !important;
            font-size: 1em !important;
            line-height:normal !important;
        }
    </style>
    
</head>
<body>            
    <div id='fb-root'></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '1177322922396720',
          xfbml      : true,
          version    : 'v2.11'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/es_LA/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
        
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.11&appId=1177322922396720";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    
    <div class="blogs">
        <div class="tvacia hidden-xs hidden-sm">
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
                        <a href="../index.php"><img src="../img/logo-protagon-business-w.png"></a>
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
                </div>
            </div>
        </div>

        <div class="col-cont">
            <div class="blog">
                <div class="post-cont space-themore">
                    <div class="style-post">
                        <div class="row">
                            <div class="col-sm-1 col-xs-2">
                                <h2><a href="../index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></h2>
                            </div>
                            <div class="col-sm-11 col-xs-10">
                                <h2 class="tituespecial"><?=$pst_titulo?></h2>
                                <br>
                                <div class="creditos">
                                    <?=$opciones?>
                                    <?=$pst_fecha?>
                                    <?=$comentarios?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<?=$pst_imagen?>-->
                    <div class="style-post" style="margin-right: 0px; !important">

                        <div style="height:9px; background-image: url(../img/arroucito.png); margin-top:15px; margin-bottom:15px;"></div>
                        <p><?=$pst_post;?></p>
                        <hr>
                        <div class="tags">
                            <strong><i class="flaticon-label49"></i></strong> Tags 
                            <?=$etiquetas?>
                        </div>
                        <div style="height:9px; background-image: url(../img/arroucito.png); margin-top:15px; margin-bottom:15px;"></div>
                        <br>
                        <div>
                            <?php
                                //echo 'hola mundo' . $valida_social_media;

                                if( $valida_social_media == 1 ){
                                ?>
                            <div style="overflow:hidden">
                                <div style="float:left; margin-left:10px; margin-top:-3px;">
                                    <a href="javascript:" onClick="postToFeed('Text');"><img src="../img/compartir-facebook.png"></a> 
                                    <!-- Shared Facebook-->
                                    <!--<div class="fb-share-button" data-href="<?=$url_actual?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.ilimago.com.mx%2Fideas%2Fconsejos-efectivos-a-la-hora-de-crear-una-idea-y-llevarla-a-cabo%2F&amp;src=sdkpreparse">Compartir</a></div>-->
                                </div>
                                <div style="float:left; margin-left:10px;">
                                    <!-- Shared Twitter -->
                                    <a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                                </div>
                                <div style="float:left; margin-left:10px;">
                                    <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: es_ES</script><script type="IN/Share" data-counter="right"></script>
                                </div>
                                <div style="float:left; margin-left:10px;">
                                    <div class="g-plus" data-action="share" data-height="24"></div>
                                </div>
                            </div>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                            <?php }?>
                        </div>
                        <br>
                    </div>
                    <!--/#comments-->
                </div>
            </div>

            <div class="bg-wite espext">
                <div class="fb-comments" data-href="<?=$url_actual?>" data-numposts="5" width="100%"></div>
                <script src='http://connect.facebook.net/es_LA/all.js#xfbml=1'></script> 
                <div class="space2"></div>
            </div>
        </div>
        <div class="col-tags">
             <div class="contenidos-right bg-wite">
                <br>
                <div style="height:9px; background-image: url(../img/arroucito.png);  margin:10px;"></div>
                <!--Buscador y más...-->
                <div class="more-cont">
                    <h4><i class="fa fa-search" aria-hidden="true"></i>&ensp; Búsqueda en el blog</h4>
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
                    <hr>
                    <h4><i class="fa fa-rss" aria-hidden="true"></i>&ensp; Blog Categories</h4>
                    <ul class="categ list-inline">
                        <?=$_categorias?>
                    </ul>
                    <hr>
                    <h4><i class="fa fa-tags" aria-hidden="true"></i>&ensp; Tag Cloud</h4>
                    <ul class="etique list-inline">
                        <?=$labels?>
                    </ul>
                    <hr>
                </div>
            </div>
            <div class="space1"></div>
            <div class="contenidos-right bg-wite">
                <br>
                <div class="row no-padding">
                    <div class="col-xs-2">
                        <div class="iconpost">
                            <i class="flaticon-dots16"></i>
                        </div> 
                    </div>
                    <div class="col-xs-10">
                        <div class="space1"></div>
                        <h3 style="margin:0px;">Post Relacionados</h3>
                    </div>
                </div>
                <div class="space1"></div>
                <div id="owl-demo-blog" class="owl-carousel">
                    <?=$_relacionados?>
                </div>
                <br>
                <div class="space2"></div>
            </div>
        </div>
    </div>

    <script>
        window.fbAsyncInit = function() {
            // init the FB JS SDK
            FB.init({
                appId: '1177322922396720', // App ID from the App Dashboard
                channelUrl: '<?=$url_actual?>', // Channel File for x-domain communication
                status: true, // check the login status upon init?
                cookie: false, // set sessions cookies to allow your server to access the session?
                xfbml: true // parse XFBML tags on this page?
            });

            // Additional initialization code such as adding Event Listeners goes here

        };
        //Publicación 1
        function postToFeed() {

            FB.ui({
                    method: 'share',
                    href: '<?=$url_actual?>',
                    name: '<?=$pst_titulo?>',

                    description: (
                        '<?=$decripcion_facebook?>'
                    ),

                    caption: 'Marketing For Dummies',
                    link: '<?=$url_actual?>',
                    picture: '<?=$imagen_url?>'
                },
                function(response) {
                    if (response && response.post_id) {
                        //alert('Post was published.');
                    } else {
                        //alert('Post was not published.');
                    }
                }
            );

        };

        // Load the SDK's source Asynchronously
        (function(d) {
            var js, id = 'facebook-jssdk',
                ref = d.getElementsByTagName('script')[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement('script');
            js.id = id;
            js.async = true;
            js.src = "//connect.facebook.net/en_US/all.js";
            ref.parentNode.insertBefore(js, ref);
        }(document));
    </script>                                         

    <a href="#" class="scrollup">Scroll</a>
    <script src="../js/icontop.js"></script>
    <script src="../js/bootstrap.js"></script>
    <!---- CARRUSEL ---->
    <link href="../owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="../owl-carousel/owl.theme.css" rel="stylesheet">
    <script src="../owl-carousel/owl.carousel.js"></script>
    <script src="../owl-carousel/custom.js"></script>
    <!---- / CARRUSEL ---->
</body>
</html>