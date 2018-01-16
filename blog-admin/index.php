<?php include 'functions/languaje.php';?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Admin | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="sources/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="sources/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="sources/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header"><img src="sources/img/logo.jpg" width="150px"></div>
            <!--<h2 class="bigintro">GST Admin</h2>-->
            <form action="view/index.html" method="post">
                <div class="body">
                    <div>
                        <i class="fa fa-envelope"></i>
                        <label for="exampleInputEmail1">Email</label>
                        <input class="form-control" type="email" name="userid" id="userid" required>
                    </div><br>

                    <div>
                        <i class="fa fa-lock"></i>
                        <label for="exampleInputPassword1">Password</label>
                        <input class="form-control" type="password" name="password" id="clave" required>
                    </div>
                    
                    <div class="form-group" id="msgBox"></div>
                </div>
                <div class="footer">                                                               
                    <button type="button" id="submit" class="btn bg-light-blue btn-block"><?=$GLOBALS[$ln]['login'][0]?></button>  
                    
                    <p><a href="javascript:recovery();"><?=$GLOBALS[$ln]['login'][1]?></a></p>
                    
                    <!-- <a href="register.html" class="text-center">Registrate!</a> -->
                </div>
            </form>

        </div>


        <div class="form-box" id="recovery-box" style="display:none">
            <div class="header"><img src="sources/img/logo.jpg" width="150px"></div>
            <p class="bigintro"><?=$GLOBALS[$ln]['login'][2]?></p>
            <form action="view/index.html" method="post">
                <div class="body">
                    <div>
                        <i class="fa fa-envelope"></i>
                        <label for="exampleInputEmail1">Email</label>
                        <input class="form-control" type="email" name="rec-mail" id="rec-mail" required>
                    </div>
                    
                    <div class="form-group" id="rec-msgBox"></div>
                </div>
                <div class="footer">                                                               
                    <button type="button" id="recovery-pass" class="btn bg-red btn-block"><?=$GLOBALS[$ln]['login'][3]?></button>  
                    
                    <p><a href="javascript:login();"><?=$GLOBALS[$ln]['login'][0]?></a></p>
                    
                    <!-- <a href="register.html" class="text-center">Registrate!</a> -->
                </div>
            </form>

            <div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>
                <br><br>
            </div>
        </div>


        <!-- jQuery 1.11.2 -->
        <script src="sources/js/jquery-1.11.2.js"></script>
        <!-- Bootstrap -->
        <script src="sources/js/bootstrap.min.js" type="text/javascript"></script>        
        <script type="text/javascript" src="sc-user/js/login.js"></script>
        <script type="text/javascript">
            var recovery = function(){
                $("#recovery-box").fadeIn();
                $("#login-box").hide();                
            }

            var login = function(){
                $("#recovery-box").hide();
                $("#login-box").fadeIn();                
            }
        </script>
    </body>
</html>