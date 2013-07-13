<?
//error_reporting(E_ALL);
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');
try{
	switch ($_GET['type']) {
		case 'addPerfil':
			$bd->ejecutarInsertArray($_POST,"perfil");
			echo "1";
		break;
		case 'editPerfil' : 
			$idperfil=$_POST['idperfil'];
			unset($_POST['idperfil']);
			$bd->ejecutarUpdateArray($_POST,"perfil", "idperfil=".$idperfil);
			echo "1";
		break;
		case 'addPermisos':
			foreach ($_POST['idmodulo'] as $value) {
				$ver=0; $add=0; $edi=0; $del=0;
				$sql = "DELETE FROM permisos WHERE perfil_idperfil=".$_POST['idperfil']." AND modulo_idmodulo=".$value;
				$bd->ejecutar($sql);
				//echo $_POST['per_'.$value];
				foreach ($_POST['per_'.$value] as $perm) {
					switch($perm){
						case 'ver':
							$ver=1;
						break;
						case 'edi':
							$edi=1;
						break;
						case 'add':
							$add=1;
						break;
						case 'del':
							$del=1;
						break;
					}
				}
				$sql = "INSERT INTO `faktury`.`permisos` (`perfil_idperfil`, `modulo_idmodulo`, `ver`, `add`, `editar`, `borrar`) VALUES ('".$_POST['idperfil']."','".$value."','".$ver."','".$add."','".$edi."','".$del."')";
				$bd->ejecutar($sql);
			}
			echo "1";
		break;
	}
}catch(Exception $e){
	echo $e->getMessage();
}
?>