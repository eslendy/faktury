<?php

include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");

include("../../radicacion/clases/facturas_class.php");
include("../../presupuesto/classes/presupuesto_class.php");
include("../../auditoria_medica/clases/auMedica_class.php");
$facturas = new facturas($conexion['local']);
$auMedica = new auMedica($conexion['local']);


switch ($_REQUEST['case']) {
   
    case 'presupuesto':
        $dataFacturas = $facturas->getAllFacturasByTerm($_REQUEST, ' and f.estado=1 and f.idFactura IN (SELECT idFactura FROM auditoria_financiera WHERE id_auditor =  '. $_SESSION['usrid'] . ') ');
        include 'table_factura_content.php';
        include '../../requestFunctionsJavascript.php';
        break;
}
?>