<?php
	//session_name("pos_sede");
	session_start();
	session_set_cookie_params(0,"/",$_SERVER['HTTP_HOST'],0);
	try{
		if (isset($_POST["ps"]) && trim($_POST["ps"])!=""){
			require("../libphp/config.inc.php");
			require("../libphp/mysql.php");
			require("clases/usuarios_class.php");
			$oUsuario = new usuarios($conexion['local']);	
			$dataUsuario=$oUsuario->getAcceso($_POST["ps"], $_POST['lg']);	
		
			$_SESSION['timeStart']=date('y-m-d h:i:s');
			$_SESSION['login']=1;
			$_SESSION['usrid']=$dataUsuario['idusuarios'];
			$_SESSION['nombre_usr']=$dataUsuario['nombres']." ".$dataUsuario['apellidos'];
			$_SESSION['admin']=0;
			$_SESSION['perfil']=$dataUsuario['idperfil'];
			if($dataUsuario['idperfil']==1){
				$_SESSION['admin']=1;
				$_SESSION['relogin']['timeStart']=$_SESSION['timeStart'];
				$_SESSION['relogin']['login']=$_SESSION['login'];
				$_SESSION['relogin']['usrid']=$_SESSION['usrid'];
				$_SESSION['relogin']['nombre_usr']=$_SESSION['nombre_usr'];
				$_SESSION['relogin']['perfil']=$dataUsuario['idperfil'];
			}
			echo 1;
		}else{
			throw new Exception("Usuario o Contraseña Invalidos Intente de Nuevo.");
		}
	}catch(Exception $e){
		echo '<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
		<strong>Alert:</strong> '.$e->getMessage().'</p>
	</div>';
	}
?>