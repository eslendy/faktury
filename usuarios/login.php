<?
require("../libphp/config.inc.php");
require("../libphp/mysql.php");
require($_SERVER['DOCUMENT_ROOT'] . 'xng/lib/bootstrap.php');
?>
<html class=" js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" style=""><!--<![endif]--><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>
            Iniciar Sesion | Hospital Militar Regional de Bucaramanga
        </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700" rel="stylesheet" type="text/css">
        <link href="<? echo $SERVER_NAME; ?>templates/austra/assets/lib/bootstrap/css/bootstrap.css" media="all" rel="stylesheet" type="text/css" id="bootstrap-css">
        <link href="<? echo $SERVER_NAME; ?>usuarios/css/usuarios.css" media="all" rel="stylesheet" type="text/css">
        <script src="<? echo $SERVER_NAME; ?>templates/austra/assets/js/jquery-1.9.1.js"></script>

        <script src="<? echo $SERVER_NAME; ?>js/login/login.js" type="text/javascript"></script>
        <script src="<? echo $SERVER_NAME; ?>templates/austra/assets/js/parsley.js"></script>
        <!--[if lte IE 9]>
                <script src="/templates/austra/assets/js/jquery.placeholder.min.js" type="text/javascript"></script>
                <script type="text/javascript">
                        $(document).ready(function () {
                                $('input, textarea').placeholder();
                        });
                </script>
        <![endif]-->

        <style type="text/css">

        </style>

        <script type="text/javascript">

            $(document).ready(function() {


                var updateBoxPosition = function() {
                    $('.signin-container').css({
                        'margin-top': ($(window).height() - $('.signin-container').height()) / 2
                    });
                };
                $(window).resize(updateBoxPosition);
                setTimeout(updateBoxPosition, 50);
            });
        </script>
    <body>

        <!-- Page content
                ================================================== -->
        <section class="signin-container" style="margin-top: 31px;">
            <a href="dashboard.html" title="AdminFlare" class="header">
                <img src="/imagenes/disan.png" alt="Sign in to Admin Flare" class="pull-left">
                <span class="pull-left">
                    Hospital Militar<br>
                    <strong>Regional de Bucaramanga</strong>
                </span>
                <div class="clear"></div>
            </a>
            <form id="login_" method="post" accept-charset="utf-8" data-validate="parsley">
                <fieldset>
                    <div class="fields">
                        <input type="text" name="username" data-required="true" placeholder="Usuario" id="login" tabindex="1">

                        <input type="password" data-required="true" name="password" placeholder="Contraseña" id="pass" tabindex="2">
                    </div>
                    <a href="#" title="" tabindex="3" class="forgot-password">Olvido la contraseña?</a>

                    <button type="submit" class="btn btn-primary btn-block" id="btnacceso" name="btnacceso"  tabindex="4">Iniciar Sesion</button>
                </fieldset>
            </form>
            <div class="alert alert-error" style="display: none;">

                <button type="button" class="close" data-dismiss="alert">×</button>
                <div id="message"></div>
                
            </div>

            <div class="social">
                <p> . </p>

                <a href="dashboard.html" title="" tabindex="5" class="twitter">
                    <i class="icon-twitter"></i>
                </a>

                <a href="dashboard.html" title="" tabindex="6" class="facebook">
                    <i class="icon-facebook"></i>
                </a>

                <a href="dashboard.html" title="" tabindex="7" class="google">
                    <i class="icon-google-plus"></i>
                </a>
            </div>
        </section>

        <script type="text/javascript">var init =<?php echo json_encode(Page::loadVars()) ?></script> 
    </body>
</html>