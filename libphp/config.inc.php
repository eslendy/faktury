<?php
$x = explode("/",$_SERVER['PHP_SELF']);
$conexion=array(
	"local"=>array("host"=>"127.0.0.1","user"=>"faktury","password"=>"faktury","database"=>"faktury"),//conexion local
	"pruebas"=>array("host"=>"127.0.0.1","user"=>"faktury","password"=>"faktury","database"=>"faktury_prueba")
);
$folders=array(
	"usr"=>"usuarios/",
	"main"=>'/'.$x[1].'/',
	"root"=>$_SERVER['SERVER_NAME'],
	"absoluta"=>$_SERVER['DOCUMENT_ROOT'].'/'.$x[1].'/',
	"img"=>"imagenes/"
);

$site_dir = __DIR__."/";
if(isset($_SERVER) && isset($_SERVER['SERVER_NAME'])){
	$SERVER_NAME = 'http://'.$_SERVER['SERVER_NAME'].'/';
}
require("class.Page.php");
//print_r($folders);
?>