<?php
include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");
include("../clases/facturas_class.php");
include("../clases/udAtencion_class.php");
$facturas = new facturas($conexion['local']);
$undAtencion = new undidad_atencion($conexion['local']);
try{
	switch($_GET['case']){
		case 'auto_und_atencion':
			echo $undAtencion->getallUndAutoC($_GET['term']);;
		break;
		case 'auto_grado':
		break;
		case 'auto_paciente':
		break;
	}
}catch(Exception $e){
	
}
?>