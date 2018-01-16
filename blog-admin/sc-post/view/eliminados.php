<?php include '../../functions/autentic.php';
date_default_timezone_set('America/Mexico_City');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Blog | Eliminados</title>
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

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side strech">                
                <!-- Main content -->
                <section class="content">
                    <div class="container">
                        <div class="row">                            
                            <div class="col-sm-3">
                                <?php
                                    $estatus = 0;
                                    include '../control/post.entradas.php';
                                ?>  
                                <?php include 'nav.php'; ?>
                            </div>

                            <div class="col-sm-9">
                                <div class="col-sm-12 no-padding list-menu-top">
                                    <div class="col-sm-3 item">
                                        <a href="post.php">Publicados</a>
                                    </div>
                                    <div class="col-sm-3 item">
                                        <a href="borradores.php">Borradores</a>
                                    </div>
                                    <div class="col-sm-3 item">
                                        <a href="programado.php">Programados</a>
                                    </div>
                                    <div class="col-sm-2 item active">
                                        <a href="eliminados.php">Borrados</a>
                                    </div>
                                    <div class="col-sm-1 search">
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <div class="col-sm-10 search">
                                        <form>
                                            <input name="search" type="text" class="form-control txt-search">
                                        </form>
                                    </div>
                                    <div class="col-sm-1" id="search">
                                        <i class="fa fa-search"></i>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <!-- Post -->
                                    <?=$_content;?> 
                                    <!-- /Post -->                                 
                                </div>
                            </div>
                            <div class="col-sm-3">&nbsp;</div>
                        </div>
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
            $(function() {
                
            });
        </script>
        
    </body>
</html>
