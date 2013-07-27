<?
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');

try{
	switch ($_REQUEST['type']) {
		case 'addunidadAtencion':
			$bd->ejecutarInsertArray($_POST,"unidad_atencion");
			echo "1";
		break;
		case 'editunidadAtencion' : 
			$idunidad_atencion=$_POST['idunidad_atencion'];
			unset($_POST['idunidad_atencion']);
			$bd->ejecutarUpdateArray($_POST,"unidad_atencion", "idunidad_atencion=".$idunidad_atencion);
			echo "1";
		break;
		case 'nullunidadAtencion':
			$bd->ejecutarUpdateArray(array("estado"=>0),"unidad_atencion", "idunidad_atencion=".$_REQUEST['id']);
			echo "1";
		break;
		/* Unidades*/
		case 'addUnidad':
			$bd->ejecutarInsertArray($_POST,"unidad_paciente");
			echo "1";
		break;
		case 'editunidad' : 
			$idunidad_atencion=$_POST['idunidad'];
			unset($_POST['idunidad']);
			$bd->ejecutarUpdateArray($_POST,"unidad_paciente", "idunidad=".$idunidad_atencion);
			echo "1";
		break;
		case 'nullunidades':
			$bd->ejecutarUpdateArray(array("estado"=>0),"unidad_paciente", "idunidad=".$_REQUEST['id']);
			echo "1";
		break;
		/* Fin Unidades*/
		/*Grados */
		case 'addgrados':
			$bd->ejecutarInsertArray($_POST,"grado");
			echo "1";
		break;
		case 'editgrados' : 
			$idgrado=$_POST['idgrado'];
			unset($_POST['idgrado']);
			$bd->ejecutarUpdateArray($_POST,"grado", "idgrado=".$idgrado);
			echo "1";
		break;
		case 'nullgrados':
			$bd->ejecutarUpdateArray(array("estado"=>0),"grado", "idgrado=".$_REQUEST['id']);
			echo "1";
		break;
		/*Fin Grados*/
		/* Fuerzas*/
		case 'addfuerza':
			$bd->ejecutarInsertArray($_POST,"fuerza");
			echo "1";
		break;
		case 'editfuerza' : 
			$idgrado=$_POST['idfuerza'];
			unset($_POST['idfuerza']);
			$bd->ejecutarUpdateArray($_POST,"fuerza", "idfuerza=".$idgrado);
			echo "1";
		break;
		case 'nullfuerza':
			$bd->ejecutarUpdateArray(array("estado"=>0),"fuerza", "idfuerza=".$_REQUEST['id']);
			echo "1";
		break;
		/* Fin Fuerzas*/
		/* Paciente*/
		case 'addpacientes':
			$bd->ejecutarInsertArray($_POST,"paciente");
			echo "1";
		break;
		case 'editpacientes' : 
			$id=$_POST['idpaciente'];
			unset($_POST['idpaciente']);
			$bd->ejecutarUpdateArray($_POST,"paciente", "idpaciente=".$id);
			echo "1";
		break;
		case 'nullpacientes':
			$bd->ejecutarUpdateArray(array("estado"=>0),"paciente", "idpaciente=".$_REQUEST['id']);
			echo "1";
		break;
		/* Fin Paciente*/
		/* Proveedor*/
		case 'addproveedor':
			$bd->ejecutarInsertArray($_POST,"proveedor");
			echo "1";
		break;
		case 'editproveedor' : 
			$id=$_POST['idproveedor'];
			unset($_POST['idproveedor']);
			$bd->ejecutarUpdateArray($_POST,"proveedor", "idproveedor=".$id);
			echo "1";
		break;
		case 'nullproveedor':
			$bd->ejecutarUpdateArray(array("estado"=>0),"proveedor", "idproveedor=".$_REQUEST['id']);
			echo "1";
		break;
		/* Fin Proveedor*/
		/* facturas*/
		case 'addfactura':
			$bd->ejecutarInsertArray($_POST,"factura");
			echo "1";
		break;
		case 'editfactura' : 
			$id=$_POST['idFactura'];
			unset($_POST['idFactura']);
			$bd->ejecutarUpdateArray($_POST,"factura", "idFactura=".$id);
			echo "1";
		break;
		case 'nullfactura':
                        echo 'das';
			$bd->ejecutarUpdateArray(array("estado"=>0),"factura", "idFactura=".$_REQUEST['id']);
			echo "1";
		break;
		/* Fin Proveedor*/
		/* contrato*/
		case 'addcontrato':
			$bd->ejecutarInsertArray($_POST,"contrato");
			echo "1";
		break;
		case 'editcontrato' : 
			$id=$_POST['idcontrato'];
			unset($_POST['idcontrato']);
			$bd->ejecutarUpdateArray($_POST,"contrato", "idcontrato=".$id);
			echo "1";
		break;
		case 'nullcontrato':
			$bd->ejecutarUpdateArray(array("estado"=>0),"contrato", "idcontrato=".$_REQUEST['id']);
			echo "1";
		break;
		/* Fin Contrato*/
		/* parentesco*/
		case 'addparentesco':
			$bd->ejecutarInsertArray($_POST,"parentesco");
			echo "1";
		break;
		case 'editparentesco' : 
			$id=$_POST['idparentesco'];
			unset($_POST['idparentesco']);
			$bd->ejecutarUpdateArray($_POST,"parentesco", "idparentesco=".$id);
			echo "1";
		break;
		case 'nullparentesco':
			$bd->ejecutarUpdateArray(array("estado"=>0),"parentesco", "idparentesco=".$_REQUEST['id']);
			echo "1";
		break;
		/* Fin parentesco*/
	}
}catch(Exception $e){
	echo $e->getMessage();
}
?>