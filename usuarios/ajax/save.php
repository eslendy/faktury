<?
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');
include('../clases/usuarios_class.php');
try{
	switch ($_GET['type']) {
		case 'addUser':
			$_POST['password_md5']=md5($_POST['password']);
			$bd->ejecutarInsertArray($_POST,"usuarios");
			echo "1";
		break;
		case 'editUser' : 
			$_POST['password_md5']=md5($_POST['password']);
			$iduser=$_POST['idusuarios'];
			unset($_POST['idusuarios']);
			$bd->ejecutarUpdateArray($_POST,"usuarios", "idusuarios=".$iduser);
			echo "1";
		break;
		case 'addPerfil':
			$bd->ejecutar('DELETE FROM usuarios_perfil WHERE idusuarios='.$_POST['idusuarios']);
			$bd->ejecutarInsertArray($_POST,"usuarios_perfil");
			echo "1";
		break;
	}
}catch(Exception $e){
	echo $e->getMessage();
}
?>