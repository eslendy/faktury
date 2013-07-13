<?php
	session_start();
	//verificación de q esxitan las variables de session y q el usuario se haya loegeado
	if(isset($_SESSION['login']) && $_SESSION['login']==1){
		//verificacion del tiempo de inactividad trascurrido 
		if((strtotime(date('y-m-d h:i:s'))-strtotime($_SESSION['timeStart']))>3600){
			//tiempo inactividad superior a 10 minutos se liberan las variables de session, se destruye y vuelve al login
			session_unset();
			session_destroy();
			header("Location: usuarios/login.php");
		}else{
			//actualizo el tiempo en la variable de session para continuar trabajando 
			$_SESSION['timeStart']=date('y-m-d h:i:s');
			//$idventa=$_SESSION['ptoventa'];
		}
	}else{
		//si no exite la session o existe pero no esta logeado se liberan las variables de session, se destruye y vuelve al login
		session_unset();
		session_destroy();
		header("Location: usuarios/login.php");
	}


?>
