<?php
include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");

include("../../radicacion/clases/facturas_class.php");
include("../../contabilidad/classes/contabilidad_class.php");
$facturas = new facturas($conexion['local']);
$contabilidad = new contabilidad($conexion['local']);


switch ($_REQUEST['case']) {
   
    case 'contabilidad':
        $dataContabilidad = $facturas->getAllFacturasByTerm($_REQUEST, ' and f.estado=1 and f.idFactura IN (SELECT idFactura FROM auditoria_financiera WHERE id_auditor =  '. $_SESSION['usrid'] . ') ', ' INNER JOIN presupuesto pres ON (pres.idFactura=f.idFactura) ');
       // var_dump($dataContabilidad);
        include 'table_factura_content.php';
        include '../../requestFunctionsJavascript.php';
        break;
}
?>