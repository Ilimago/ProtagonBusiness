/*
 * Administrador de Contenidos
 * Diciembre 2015
 * Alejandro Grijalva Antonio @HiProgrammer
 * Derechos Reservados
 */

;(function($){
    var redir = 'sc-user/view';
    $("#submit").click(function(){
        logIn();
    });

    $("#recovery-pass").click(function(){
        recoveryPass();
    });

    $("#clave, #userid").keypress(function(key){
        switch(key.which)
        {       
            case 13:  logIn();   break;            
        }
    });

    // Validamos logeo
    var url = 'functions/user.json.php';
    $.getJSON(url, function(data){
        if(data.success){
            //location.href = redir;
        }
    }); 

    var error = '<div class="alert alert-danger alert-dismissable">'
                    +'<i class="fa fa-times-circle"></i>'
                    +'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                    +'<b>Error !</b> #error#'
                +'</div>';

    function logIn(){
        try{
            var mail = $("#userid").val();
            var pass = $("#clave").val();
            // alert(pass);

            
            // if(mail == ''){
            //     $("#msgBox").html(msgError('Introduce tu e-mail'));
            // }
            // else{
                var valores = 'mail=' + mail + '&pass=' + pass
                $.ajax({
                    url: 'sc-user/control/login.ctrl.php',
                    data: valores,
                    type: "POST",
                    success: function(data){
                        try{
                            var array = eval("(" + data + ")");
                            if(array.success == true){  
                                location.href = redir;
                            }
                            else{
                                $("#msgBox").html(msgError(array.msg));
                                $("#clave").val('');
                            }   
                        }    
                        catch(e){
                            $("#msgBox").html(msgError(e));
                            $("#clave").val('');
                        }                                                      
                    }
                }); // Termina ajax
            // }
        }
        catch(e){            
            $("#msgBox").html(msgError(e));
        }
    }

    function recoveryPass(){
        try{
            var mail = $("#rec-mail").val();
            // alert(mail);

            
            if(mail == ''){
                $("#rec-msgBox").html(msgError('Introduce tu e-mail'));
            }
            else{
                var valores = 'email=' + mail;
                $.ajax({
                    url: 'sc-store/mail/recoveryPassword.php',
                    data: valores,
                    type: "POST",
                    success: function(data){
                        try{
                            var array = eval("(" + data + ")");
                            if(array.success == true){  
                                //location.href = "app/index.html";
                                $("#rec-msgBox").html(msgInfo(array.msg));
                            }
                            else{
                                $("#rec-msgBox").html(msgError(array.msg));
                            }   
                        }    
                        catch(e){
                            $("#rec-msgBox").html(msgError(e));
                        }                                                      
                    }
                }); // Termina ajax
            }
        }
        catch(e){            
            $("#rec-msgBox").html(msgError(e));
        }
    }

    function msgError(msg){
        return '<div class="alert alert-danger alert-dismissable">'
                    +'<i class="fa fa-times-circle"></i>'
                    +'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                    +'<b>Error !</b> ' + msg
                +'</div>';
    }

    function msgInfo(msg){
        return '<div class="alert alert-info alert-dismissable">'
                    +'<i class="fa fa-info"></i>'
                    +'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                    +'<b>Info !</b> ' + msg
                +'</div>';
    }

}(jQuery));