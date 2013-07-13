<?
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');

try{
	switch ($_GET['type']) {
		case 'addAuditoria':
			$_POST['fecha_auditoria']=date('Y-m-d H:i:s');
			$bd->ejecutarInsertArray($_POST,"auditoria_financiera");
			echo "1";
		break;
		case 'editAuditoria' : 
			$id=$_POST['idauditoria_financiera'];
			//echo $_POST['concepto_auditoria'] .= htmlentities($_POST['concepto_auditoria']);
			//$_POST['concepto_auditoria'] = eregi_replace("[\n|\r|\n\r]", ' ', $_POST['concepto_auditoria']);
			unset($_POST['idauditoria_financiera']);
			$bd->ejecutarUpdateArray($_POST,"auditoria_financiera", "idauditoria_financiera=".$id);
			echo "1";
		break;
		case 'nullAuditoria':
			$bd->ejecutarUpdateArray(array("estado"=>0),"auditoria_financiera", "idauditoria_financiera=".$_POST['id']);
			echo "1";
		break;
		
	}
}catch(Exception $e){
	echo $e->getMessage();
}
?>