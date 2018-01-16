<style type="text/css">
    ul.tag-cloud{
        list-style: outside none none; margin: 0; padding: 0; 
    }
    ul.tag-cloud li{
        display: inline-block; margin: 0 0 2px;
    }

    ul.arrow{
        list-style: outside none none; margin: 0; padding: 0;
    }

    ul.arrow li::before{
        content: "☻";
    }

    ul.arrow li a{
        color: black;
    }

    ul.arrow li a:hover{
        color: gray;
    }
    .colmen{
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        background-color: #fff;
        padding: 10px;
        box-shadow: 3px 5px 7px -5px rgba(0, 0, 0, 0.4);
    }
</style>

    <div class="col-sm-12">
        <div class="colmen">
        <ul class="ul-principal-menu">        
            <li class="menuso"><i class="fa fa-home" style="font-size: 1.2em;"></i> MENU<br><br>
                <ul>
                    <!--<li><a href="../blog" target="_blanc"><i class="fa fa-rocket"></i> Ver Blog</a></li>-->
                    <li><a href="post.php"><i class="fa fa-inbox"></i> Ver Entradas</a></li>
                </ul>
            </li>
        </ul>
        <br>

        <h5><i class="fa fa-flag"></i> Categorias</h5>
        <ul class="arrow">
            <?=$_categorias?>
        </ul>

        <br><br>

        <h5><i class="fa fa-tags"></i> Tags</h5>
        <ul class="tag-cloud">
            <?=$labels?>
        </ul>
        </div>
    </div>
