<?php

include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");

include("../../radicacion/clases/facturas_class.php");
include("../../tesoreria/classes/tesoreria_class.php");
$facturas = new facturas($conexion['local']);
$tesoreria = new tesoreria($conexion['local']);


switch ($_REQUEST['case']) {

    case 'tesoreria':
        $where_ = (($_SESSION['perfil'] == 1)) ? " 1=1" : " id_auditor = " . $_SESSION["usrid"] . " ";

        $dataTesoreria = $facturas->getAllFacturasByTerm($_REQUEST, ' and f.estado=1 and f.idFactura IN (SELECT idFactura FROM auditoria_financiera WHERE '.$where_.') ', '  INNER JOIN presupuesto pres ON (pres.idFactura=f.idFactura)
            INNER JOIN contabilidad con ON (con.idFactura = f.idFactura) ');
        //var_dump($dataTesoreria);
        include 'table_factura_content.php';
        include '../../requestFunctionsJavascript.php';
        break;
}
?>