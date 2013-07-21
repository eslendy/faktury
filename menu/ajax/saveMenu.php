<?
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');
include('../clases/menu_class.php');
try{
	switch ($_GET['type']) {
		case 'addmenu':
			$save['descripcion']=$_POST['descripcion'];
			$save['enlace']=$_POST['enlace'];
			$save['padre']=$_POST['padre'];
			$save['visible']=$_POST['visible'];

			$idmenu=$bd->ejecutarInsertArray($save,"menu");

			foreach ($_POST['modulos'] as $mod) {
				$save_mm['idmodulo']=$mod;
				$save_mm['idmenu']=$idmenu;
				$bd->ejecutarInsertArray($save_mm,"modulo_menu");
			}
			echo "1";
		break;
		case 'editmenu':
			$save['descripcion']=$_POST['descripcion'];
			$save['enlace']=$_POST['enlace'];
			$save['padre']=$_POST['padre'];
			$save['visible']=$_POST['visible'];
			$save['estado']=$_POST['estado'];
			$bd->ejecutarUpdateArray($save,"menu", "idmenu=".$_POST['idmenu']);
			echo "1";
		break;
		case 'orden':
			//echo print_r($_POST);
			foreach($_POST as $in=>$v){
				//echo $in;
				$i=explode("_",$in);
				//echo print_r(array("orden"=>$v));
				$bd->ejecutarUpdateArray(array("orden"=>$v),"menu","idmenu=".$i[1]);
			}
			echo "1";
		break;
	}
}catch(Exception $e){
	echo $e->getMessage();
}
?>