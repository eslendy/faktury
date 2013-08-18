<?php

include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");
include '../../radicacion/clases/glosas_class.php';

    switch ($_GET['case']) {
        case 'cie10':
            $cie10 = new cie10($conexion['local']);
            echo $cie10->getallAutoC($_GET['term']);
            break;
        case 'glosas':
            $cie10 = new glosas_devoluciones($conexion['local']);
            echo $cie10->getallAutoC($_GET['term']);
            break;
    }

?>