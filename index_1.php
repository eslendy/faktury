<?
/* * *******************************************************************************
 * El contenido de este archivo esta sujeto a la Public License Version 1.1.2
 * The Original Code is:  Eslendy Espinel Silva
 * The Initial Developer of the Original Code is Eslendy Espinel Silva.
 * Portions created by Eslendy Espinel Silva.
 * All Rights Reserved.
 * Contributor(s): ______________________________________.
 * ****************************************************************************** */
//Carga Archivo de vigilancia de las sessiones 
//error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);

//@ini_set('display_errors', 0);


require("vigia.php");
//var_dump($_REQUEST);
//error_reporting(E_ALL & ~E_NOTICE);

try {
    //carge de archivos de configuracion basicos
    require("libphp/config.inc.php");
    require("libphp/mysql.php");

    require($_SERVER['DOCUMENT_ROOT'] . 'xng/lib/bootstrap.php');
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>.·:Faktury:·.</title>        
            <link href="<? echo $SERVER_NAME; ?>css/faktury/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" type="text/css" href="<? echo $SERVER_NAME; ?>js/tablesorter/addons/pager/jquery.tablesorter.pager.css"  >
            <link rel="stylesheet" type="text/css" href="<? echo $SERVER_NAME; ?>css/jPages.css">
            <link rel="stylesheet" type="text/css" href="<? echo $SERVER_NAME; ?>css/validationEngine.jquery.css">
            <script src="<? echo $SERVER_NAME; ?>js/jquery-1.9.1.js" type="text/javascript"></script>
            <script src="<? echo $SERVER_NAME; ?>js/jquery-ui-1.10.2.custom.js" type="text/javascript"></script>
            <script src="<? echo $SERVER_NAME; ?>js/jGeneral.js" type="text/javascript"></script>
            <script type="text/javascript" src="<? echo $SERVER_NAME; ?>js/tablesorter/jquery.tablesorter.js"></script>
            <script type="text/javascript" src="<? echo $SERVER_NAME; ?>js/tablesorter/jquery.metadata.js"></script>
            <!--<script type="text/javascript" src="js/tablesorter/addons/pager/jquery.tablesorter.pager.js"></script>-->
            <script type="text/javascript" src="<? echo $SERVER_NAME; ?>js/jquery.uitablefilter.js"></script>
            <script type="text/javascript" src="<? echo $SERVER_NAME; ?>js/jPages.js"></script>
            <script type="text/javascript" src="<? echo $SERVER_NAME; ?>js/jquery.validationEngine-es.js"></script>
            <script type="text/javascript" src="<? echo $SERVER_NAME; ?>js/jquery.validationEngine.js"></script>
            <script type="text/javascript" src="<? echo $SERVER_NAME; ?>bootstrap/js/bootstrap.min.js"></script>            
            <link rel="stylesheet" type="text/css" href="<? echo $SERVER_NAME; ?>bootstrap/css/bootstrap.css">
            <link rel="stylesheet" type="text/css" href="<? echo $SERVER_NAME; ?>bootstrap/css/bootstrap-responsive.css">
        </head>


        <?
        require("menu/clases/menu_class.php");
        $menu = new menu($conexion['local']);
        ?>
        <body>

            <div  class="navbar navbar-inverse navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container">
                        <a class="brand" href="#">Faktury</a>
                        <? echo $menu->make_menu($_SESSION['perfil'], 0); ?>


                    </div>
                </div>
            </div>
            <div class="container">

                <header>
                    <div class="pull-right">Bienvenido, <?= $_SESSION['nombre_usr'] ?></div>
                </header>
                
                <div id="cuerpo">
                    <?
                    // var_dump($_REQUEST);
                    if (isset($_GET['c']) && !empty($_GET['c']) && ($_GET['c']) != 'index.php') {
                        include(($_GET['c']));
                    }
                    ?>
                </div>
                <footer>

                </footer>

            </div>

        </body>
        <?PHP
    } catch (Exception $e) {
        //impresion de excepciones
        echo $e->getMessage();
    }
    ?>
    <script type="text/javascript">var init =<?php echo json_encode(Page::loadVars()) ?></script>   
</html>

