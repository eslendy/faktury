<?php
error_reporting(E_ALL);
include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");
include("../clases/facturas_class.php");
include("../clases/udAtencion_class.php");
include("../clases/unidades_class.php");
include("../clases/paciente_class.php");
include("../clases/grados_class.php");
include("../clases/proveedor_class.php");
include("../clases/contrato_class.php");
require_once('../clases/parentesco_class.php');
require_once('../clases/cie10_class.php');
require_once('../clases/glosas_class.php');
$facturas = new facturas($conexion['local']);

try{
	switch($_GET['case']){
		case 'auto_und_atencion':
			$undAtencion = new undidad_atencion($conexion['local']);
			echo $undAtencion->getallUndAutoC($_GET['term'],$_GET['where']);;
		break;
		case 'auto_grado':
			$grados = new grados($conexion['local']);
			echo $grados->getallGradoAutoC($_GET['term']);
		break;
		case 'auto_paciente':
			$paciente = new paciente($conexion['local']);
			echo $paciente->getallPacienteAutoC($_GET['term']);
		break;
		case 'auto_und':
			$und = new undidad($conexion['local']);
			echo $und->getallAutoC($_GET['term']);
		break;
		case 'auto_proveedor':
			$proveedor = new proveedor($conexion['local']);
			echo $proveedor->getallAutoC($_GET['term']);
		break;
		case 'select_contrato':
			$contrato = new contrato($conexion['local']);
			echo $contrato->_select("c.idproveedor=".$_POST['idproveedor'],"contrato","contrato","");
		break;
		case 'auto_parentesco':
			$parentesco = new parentesco($conexion['local']);
			echo $parentesco->getallAutoC($_GET['term']);
		break;
		case 'cie10':
			$cie10 = new cie10($conexion['local']);
			echo $cie10->getallAutoC($_GET['term']);
		break;
		case 'glosas':
			$cie10 = new glosas_devoluciones($conexion['local']);
			echo $cie10->getallAutoC($_GET['term']);
		break;
	}
}catch(Exception $e){
	
}
?>