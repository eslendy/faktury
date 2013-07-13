<?
/*********************************************************************************
 * El contenido de este archivo esta sujeto a la Public License Version 1.1.2
 * The Original Code is:  Eslendy Espinel Silva
 * The Initial Developer of the Original Code is Eslendy Espinel Silva.
 * Portions created by Eslendy Espinel Silva.
 * All Rights Reserved.
 * Contributor(s): ______________________________________.
********************************************************************************/
//Carga Archivo de vigilancia de las sessiones 
error_reporting(E_ALL);
require("vigia.php");
//error_reporting(E_ALL & ~E_NOTICE);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>.·:Faktury:·.</title>        
        <link href="css/faktury/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
        <link href="css/main.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="js/tablesorter/themes/blue/style.css" media="print, projection, screen" >
        <link rel="stylesheet" type="text/css" href="js/tablesorter/addons/pager/jquery.tablesorter.pager.css" media="print, projection, screen" >
        <link rel="stylesheet" type="text/css" href="css/jPages.css">
        <link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css">
        <script src="js/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.10.2.custom.js" type="text/javascript"></script>
        <script src="js/jGeneral.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/tablesorter/jquery.tablesorter.js"></script>
        <script type="text/javascript" src="js/tablesorter/jquery.metadata.js"></script>
        <!--<script type="text/javascript" src="js/tablesorter/addons/pager/jquery.tablesorter.pager.js"></script>-->
        <script type="text/javascript" src="js/jquery.uitablefilter.js"></script>
        <script type="text/javascript" src="js/jPages.js"></script>
        <script type="text/javascript" src="js/jquery.validationEngine-es.js"></script>
        <script type="text/javascript" src="js/jquery.validationEngine.js"></script>
    </head>
    
    
    <?PHP
	try{
		//carge de archivos de configuracion basicos
		require("libphp/config.inc.php");
		require("libphp/mysql.php");
        require("menu/clases/menu_class.php");
        $menu = new menu($conexion['local']);
    ?>
    <body>
    	<header>
        	<div id="encabezado"></div>
            <div id="usuario"><?=$_SESSION['nombre_usr']?></div>
        	<nav id="barra_menu">
                <?=$menu->make_menu($_SESSION['perfil'],0);?>
            </nav>
        </header>
        <!--<div id="breadcrumbs">
        	<a href="index.php">INICIO</a><span></span>
        </div>-->
        <div id="cuerpo">
                <?
                    if(isset($_GET['c']) && !empty($_GET['c']) && base64_decode($_GET['c'])!='index.php'){
                        include(base64_decode($_GET['c']));
                    }
                ?>
        </div>
        <footer>
        	
        </footer>
     
    </body>
    <?PHP
	}catch(Exception $e){
		//impresion de excepciones
		echo $e->getMessage();
	}
    ?>

</html>

