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
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Faktury - Administracion</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">
            <!-- end: Meta -->

            <!-- start: CSS -->
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/lib/bootstrap/css/bootstrap.css">
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/lib/bootstrap/css/bootstrap-responsive.css">   
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/lib/font-awesome/font-awesome.html">
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/lib/fullcalendar/fullcalendar.css">
            <link rel="stylesheet" type="text/css" href='/templates/austra/assets/lib/fullcalendar/fullcalendar.print.css' media='print'>
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/lib/jasny/bootstrap-fileupload.css">
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/lib/pnotify/jquery.pnotify.default.css">
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/lib/pnotify/jquery.pnotify.default.icons.css">
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/lib/todo/css/base.css">
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/lib/todo/css/app.css">
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/css/icheckcss.css">
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/css/masonry.css">
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/css/wizard.css">
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/css/bootstrap-wysihtml5.css" >
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/css/jquery.spellchecker.css">
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/css/slider.css">
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/css/style.css">
            <link rel="stylesheet" type="text/css" href="/templates/austra/assets/css/polaris/polaris.css" rel="stylesheet">
            <link href="http://faktury.org/css/faktury/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css">
            
            <!-- end: CSS -->

            <!-- start: JS -->
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <script src="/templates/austra/assets/js/jquery-1.9.1.js"></script>
            <script src="/templates/austra/assets/lib/bootstrap/js/bootstrap.js"></script>
            <script src="/templates/austra/assets/lib/fullcalendar/fullcalendar.min.js"></script>
            <script src="/templates/austra/assets/lib/pnotify/jquery.pnotify.min.js"></script>
            <script src="/templates/austra/assets/lib/jasny/bootstrap-fileupload.js"></script>
            <script src="/templates/austra/assets/lib/jasny/bootstrap-inputmask.js"></script>
            <script src="/templates/austra/assets/lib/jasny/bootstrap-typeahead.js"></script>   
            <script src="/templates/austra/assets/lib/justgage/justgage.1.0.1.js"></script>
            <script src="/templates/austra/assets/lib/justgage/raphael.2.1.0.min.js"></script> 
            <script src="/templates/austra/assets/lib/flot/jquery.flot.js"></script>
            <script src="/templates/austra/assets/lib/flot/excanvas.js"></script>
            <script src="/templates/austra/assets/lib/flot/jquery.flot.pie.js"></script>
            <script src="/templates/austra/assets/lib/flot/jquery.flot.stack.js"></script>
            <script src="/templates/austra/assets/js/responsive-tables.js"></script>
            <script src="/templates/austra/assets/js/jquery.icheck.js"></script>
            <script src="/templates/austra/assets/js/jquery.sparkline.js"></script>
            <script src="/templates/austra/assets/js/bootstrap-slider.js"></script>
            <script src="/templates/austra/assets/js/icheckdemo.js"></script>
            <script src="/templates/austra/assets/js/charts.js"></script>
            <script src="/templates/austra/assets/js/date.js"></script>
            <script src="/templates/austra/assets/js/daterangepicker.js"></script>   
            <script src="/templates/austra/assets/js/jquery.icheck.js"></script>    
            <script src="/templates/austra/assets/js/wizard.js"></script>
            <script src="/templates/austra/assets/js/wysihtml5-0.3.0.js"></script>
            <script src="/templates/austra/assets/js/bootstrap-wysihtml5.js"></script>
            <script src="/templates/austra/assets/js/prettyprint.js"></script>
            <script src="/templates/austra/assets/js/jquery.spellchecker.js"></script>
            <script src="/templates/austra/assets/js/parsley.js"></script>
            <script src="/templates/austra/assets/js/jquery.masonry.min.js"></script>
            <script src="/templates/austra/assets/js/custom.js"></script>
            <script src="<? echo $SERVER_NAME; ?>js/jGeneral.js" type="text/javascript"></script>
             <script src="<? echo $SERVER_NAME; ?>js/jquery-ui-1.10.2.custom.js" type="text/javascript"></script>
           <script type="text/javascript" src="<? echo $SERVER_NAME; ?>js/jquery.validationEngine-es.js"></script>
           <script type="text/javascript" src="<? echo $SERVER_NAME; ?>js/jquery.validationEngine.js"></script>
           <link rel="stylesheet" type="text/css" href="<? echo $SERVER_NAME; ?>css/validationEngine.jquery.css">
            <!-- end: JS -->

            <!-- Le fav and touch icons -->
            <link rel="shortcut icon" href="http://www.mickael-girault.fr/preview/assets/ico/favicon.ico">
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.html">
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.html">
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.html">
            <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.html">

            <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
            <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
            <!--[if IE 8 ]> <body class="ie ie8 "> 
            <style type="text/css">
                .navbar form.search input,.sidebar-nav form.search input,.sidebar-label,.thumb-account{border: none;}
                .thumb-account span {width: 2px;}
                .sidebar-nav .form-inline { display: none;}
            </style>
            <![endif]-->

            <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->

            <!--[if gte IE 9]>
             <style type="text/css">.gradient {filter: none;}</style>
            <![endif]-->

        </head><!--end: head -->
        <?
        require("menu/clases/menu_class.php");
        $menu = new menu($conexion['local']);
        ?>
        <body> 

            <div class="navbar">
                <div class="navbar-inner">

                    <ul class="nav pull-right">

                        <li>
                            <form action="#" class="search form-inline">
                                <input type="text" placeholder="Search...">
                                <button class="search-submit btn-search" value="" type="submit"><i class="icon-search"></i></button>                        
                            </form>                        

                        </li>




                    </ul>
                    <a class="brand" href="/"><span class="title">Faktury</span> <span class="logo"></span></a>
                </div>
            </div><!-- navbar --> 


            <div data-offset-top="360" data-spy="affix" class="sidebar-nav affix">
                <form class="search form-inline">
                    <input type="text" placeholder="Search...">
                    <button class="search-submit btn-search" value="" type="submit"><i class="icon-search"></i></button>                        
                </form>    
<div class="sidebar-avatar">
	        <img src="<? echo $SERVER_NAME; ?>templates/austra/assets/images/team-1.jpg" alt="avatar" class="thumbnail-avatar">
	        <a href="#"><div class="sidebar-avatar-message"><div class="notify notify-message"><i class="icon-envelope"></i></div></div></a>
	        <a href="#"><div class="sidebar-avatar-notify"><div class="notify ">7</div></div></a>
	     </div>


                <a data-toggle="collapse" data-target=".nav-collapse" class="btn-sidebar">
                    <span class="notify navigation span12"><i class="icon-reorder"></i> Navigation <span class="pull-right label sidebar-label label-danger"><i class="icon-angle-down"></i> </span></span>
                </a>


                <div class="nav-collapse subnav-collapse collapse ">


                    <? echo $menu->make_menu($_SESSION['perfil'], 0); ?>


                </div>



            </div><!-- sidebar --> 

            <div class="content">

                <div class="header">
                    <h1 class="page-title title___"></h1>
                </div><!-- header --> 



                <div class="wrapper-content">
                    <div class="container-fluid">
                        <div class="row-fluid">

                            <? /* <div class="alert alert-info">
                              <button data-dismiss="alert" class="close" type="button"><i class="icon-remove"></i></button>
                              <strong>Note :</strong> Add <span class="label label-info">.responsive</span> table to small device.
                              </div> */ ?>    

                            <div id="menu_secundario" class="pull-left span11">
                                <?
                                if (isset($_GET['c']) && !$_REQUEST['isHome']) {
                                  
                                    echo $menu->menu_lateral($_SESSION['perfil'], ($_GET['c']));
                                }
                                ?>
                            </div>

                            <div class="row-fluid">
                                <div class="block  block-head-btn span12 unstyled-modal">
                                    <div id="collapse-table-search-dark">
                                        <div id="cuerpo">
                                            <div class="block-heading">
                                                <span class="block-icon pull-right">
                                                    <? if (isset($_REQUEST['action']) && $_REQUEST['action'] !== 'auditoria_medica' && $_REQUEST['action'] !== 'auditoria_financiera') {
                                                        ?>
                                                        <button class="btn btn-primary nuevo" onclick="$('#content_').collapse('hide');" >
                                                            <i>Cargando...</i>
                                                        </button>
                                                    <? }
                                                    ?>


                                                </span>
                                                <?
                                                $title = explode('_', $_REQUEST['action']);
                                                $tt = '';

                                                foreach ($title as $t) {
                                                    $tt .= ucfirst($t) . ' ';
                                                }
                                                ?>
                                                <script>
                                                    $(document).ready(function(){
                                                        $('.title___').text('<? echo $tt ?>');
                                                    })
                                                    </script>
                                                <a href="#content_" data-toggle="collapse" class="title_related"> <? echo $tt; ?> </a>
                                            </div>
                                            <?php
                                            if (isset($_GET['c']) && !empty($_GET['c']) && ($_GET['c']) != 'index.php') {

                                                include(($_GET['c']));
                                            }
                                            ?>
                                            <div class="clear"></div>
                                            <div class="block span12 add" style="display: none">
                                                <p class="block-heading">
                                                    <span class="pull-right">

                                                        <button class="btn btn-danger close-edit" onclick="$('.add').fadeOut();
                                                            $('#content_').collapse('show'); $('.block.span12.add .load_content').empty()"><i class="icon-remove"></i> Cerrar Edicion </button>
                                                    </span>

                                                    <span class="add_form">Cargando...</span>
                                                </p>                  
                                                <div class="block-body">
                                                    <div class="load_content"></div>
                                                </div>

                                            </div>
                                        </div>



                                    </div>
                                </div>


                            </div>  


                        </div>
                    </div>
                </div><!-- wrapper-content -->     


            </div><!-- content -->   

            <div class="clearfix">  </div> 


            <div aria-hidden="false" aria-labelledby="myModalLabel1" role="dialog" tabindex="-1" class="modal hide fade" id="loadContentAjaxForms">
                <div class="modal-header modal-default">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    <h3 id="myModalLabel1" class="title_modal"></h3>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button aria-hidden="true" data-dismiss="modal" class="btn" >Close</button>
                    <button class="btn btn-primary guardar-formulario" onclick="$('.modal').modal('hide')">Save</button>
                </div>
            </div>




            <footer>
                <div class="clearfix">
                    <p class="pull-left"><a class="notify-disabled" href="#"><i class="icon-chevron-up"></i></a></p>
                </div>
            </footer><!-- footer -->     


            <script type="text/javascript">
                                                        //tooltip
                                                        $("[rel=tooltip]").tooltip();
                                                        $(function() {
                                                            $('.demo-cancel-click').click(function() {
                                                                return false;
                                                            });
                                                        });
            </script>	 

            <script type="text/javascript">
                //tab
                $('#myTab a').click(function(e) {
                    e.preventDefault();
                    $(this).tab('show');
                })
                 $(function() {
                    $('input').iCheck({
                        checkboxClass: 'icheckbox_flat-blue',
                        radioClass: 'iradio_flat-blue',
                        increaseArea: '-10' // optionaliradio_flat-red
                    });
                });

            </script> 	


        </body>
        <?PHP
    } catch (Exception $e) {
        //impresion de excepciones
        echo $e->getMessage();
    }
    ?>
    <script type="text/javascript">var init =<?php echo json_encode(Page::loadVars()) ?></script>   
</html>