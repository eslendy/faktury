<?php

include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");
include '../../radicacion/clases/glosas_class.php';
include("../../radicacion/clases/facturas_class.php");
include("../../radicacion/clases/auditoria_financiera.php");
include("../clases/auMedica_class.php");
$facturas = new facturas($conexion['local']);

$auMedica = new auMedica($conexion['local']);

switch ($_REQUEST['case']) {
    case 'cie10':
        $cie10 = new cie10($conexion['local']);
        echo $cie10->getallAutoC($_REQUEST['term']);
        break;
    case 'glosas':
        $cie10 = new glosas_devoluciones($conexion['local']);
        echo $cie10->getallAutoC($_REQUEST['term'], $_REQUEST['tipo']);
        break;
    case 'auditoria_medica':
        $where_ = (($_SESSION['perfil'] == 1)) ? " 1=1" : " id_auditor = " . $_SESSION["usrid"] . " ";

        $dataFacturas = $facturas->getAllFacturasByTerm($_REQUEST, ' and f.estado=1 and f.idFactura IN (SELECT idFactura FROM auditoria_financiera WHERE '.$where_.') ');
        include 'table_factura_content.php';
        include '../../requestFunctionsJavascript.php';
        break;
}
?>