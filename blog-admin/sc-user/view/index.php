<?php 
    include '../../functions/languaje.php';
    include '../../functions/autentic.php';
    include '../control/user.list.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin | <?=$GLOBALS[$ln]['user'][0]?></title>
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
            <a href="index.php" class="logo">
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
                        <!-- Messages: style can be found in dropdown.less-->
                        <!-- <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                            </a>                            
                        </li> -->
                        <!-- Notifications: style can be found in dropdown.less -->
                        <!-- <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                            </a>                            
                        </li> -->
                        <!-- Tasks: style can be found in dropdown.less -->
                        <!-- <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                            </a>                            
                        </li> -->
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><span class="dUserName"><?=$_SESSION['user_full'];?></span> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="../../files/user/user.jpg" class="img-circle img-usr" alt="User Image" />
                                    <p>
                                        <span class="dUserName"><?=$_SESSION['user_full'];?></span>
                                        <!--<small class="dEmpresa">Netweb</small>-->
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
                                        <a href="index.php" class="btn btn-default btn-flat"><?=$GLOBALS[$ln]['user'][5]?></a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="../../functions/salir.php" class="btn btn-default btn-flat"><?=$GLOBALS[$ln]['user'][21]?></a>
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
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="../../files/user/user.jpg" class="img-circle img-usr" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p class="dSaludo_"><?=$GLOBALS[$ln]['msg'][0]?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <!-- <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form> -->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" id="menuNav"></ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?=$GLOBALS[$ln]['user'][0]?>
                        <input type="hidden" id="calve_id" value="1">
                    </h1>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-dashboard"></i> Home</li>
                        <li><?=$GLOBALS[$ln]['user'][5]?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="col-sm-10">
                        <div class="box box-primary">
                            <div class="box-header">                                
                                <i class="fa fa-user"></i>
                                <h3 class="box-title"> <?=$GLOBALS[$ln]['user'][1]?> </h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <form id="frm_perfil" name="frm_perfil">
                                            <label><?=$GLOBALS[$ln]['user'][22]?></label>
                                            <input type="text" class="form-control" id="usu_nombre" name="usu_nombre" value="<?=$_SESSION['user_full']; ?>">

                                            <br>
                                            <label>Breve Descripción</label>
                                            <textarea name="usr_sexo" class="form-control" rows="4"><?=$_SESSION['sexo']; ?></textarea>                                
                                            
                                            <br>
                                            <label>Twitter</label>
                                            <input type="text" name="twitter" class="form-control" placeholder="http://" value="<?=$_SESSION['usu_caduca']; ?>"> 

                                            <br>
                                            <label>Facebook</label>
                                            <input type="text" name="facebook" class="form-control" placeholder="http://" value="<?=$_SESSION['facebook']; ?>"> 

                                            <br><br>
                                            <label>Usuario (<?=$GLOBALS[$ln]['user'][4]?>)</label>
                                            <input type="email" class="form-control" id="usu_mail" name="usu_mail" value="<?=$_SESSION['mail']; ?>">

                                            <br><br>
                                            <label><b><?=$GLOBALS[$ln]['user'][6]?></b></label><br>
                                            <div class="row">
                                                <div class="col-md-7">

                                                    <label><?=$GLOBALS[$ln]['user'][7]?></label>
                                                    <input type="password" class="form-control" id="pass-1" name="pass-1">

                                                    <label><?=$GLOBALS[$ln]['user'][8]?></label>
                                                    <input type="password" class="form-control" id="pass-2" name="pass-2">
                                                </div>
                                                <div class="col-md-5" style="padding-top:24px;">
                                                    <div class="callout callout-info">
                                                        <h4 style="font-size:14px"><?=$GLOBALS[$ln]['user'][11]?></h4>
                                                        <p style="font-size:11px">
                                                            <?=$GLOBALS[$ln]['user'][12]?><br>
                                                            <?=$GLOBALS[$ln]['user'][13]?><br>
                                                            <?=$GLOBALS[$ln]['user'][14]?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>


                                            <br><br>
                                            <span id="msgBox"></span>
                                            <br>

                                            <a class="btn btn-primary" id="save-perfil">
                                                &ensp;&ensp; <?=$GLOBALS[$ln]['user'][10]?> &ensp;&ensp;
                                            </a>
                                            <? if ($_SESSION['perfil'] == 1) { ?>
                                                <a class="btn btn-danger" href="nuevo.php">
                                                &ensp;&ensp; Nuevo Usuario &ensp;&ensp;
                                            </a>
                                            <? } ?>
                                            
                                            <br><br><br>
                                        
                                    </div>

                                    <div class="col-sm-5 no-padding" style="text-align:center;">
                                        <div style="background-color:#f4f4f4; margin-right:10px;" class="img-rounded">
                                            <br><br>
                                            <?=$template?>
                                            
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>                    
                    <div class="col-sm-2">
                        
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

        <!-- Incluimos scripts de alimentacion -->        
        <script type="text/javascript" src="../../sources/js/functions.js"></script>
        <script type="text/javascript" src="../js/perfil.js"></script>
        <script type="text/javascript" src="../js/nav.js"></script>
        
    </body>
</html>