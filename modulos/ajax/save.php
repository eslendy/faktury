<?
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');
include('../clases/modulo_class.php');
try{
	switch ($_GET['type']) {
		case 'addModulo':
			$bd->ejecutarInsertArray($_POST,"modulo");
			echo "1";
		break;
		case 'editModulo' : 
			
			$idmodulo=$_POST['idmodulo'];
			unset($_POST['idmodulo']);
			$bd->ejecutarUpdateArray($_POST,"modulo", "idmodulo=".$idmodulo);
			echo "1";
		break;
	}
}catch(Exception $e){
	echo $e->getMessage();
}
?>