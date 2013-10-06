<?php

include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");

include("../../radicacion/clases/facturas_class.php");
include("../clases/auditoria_financiera.php");
$facturas = new facturas($conexion['local']);

$au = new auditoria_financiera($conexion['local']);
//$dataFacturas = $facturas->getallFacturas("f.estado=1");

try {
    switch ($_REQUEST['case']) {
        case 'auditoria_financiera':
            //die('das');
            $dataFacturas = $facturas->getAllFacturasByTerm($_REQUEST, ' and f.estado=1 ');
            
            include 'table_factura_content.php';
            include '../../requestFunctionsJavascript.php';
            break;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>