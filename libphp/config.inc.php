<?php
$x = explode("/",$_SERVER['PHP_SELF']);
$conexion=array(
	"local"=>array("host"=>"127.0.0.1","user"=>"faktury","password"=>"faktury","database"=>"faktury"),//conexion local
	"pruebas"=>array("host"=>"127.0.0.1","user"=>"faktury","password"=>"faktury","database"=>"faktury_prueba"),
        "domain"=>array("host"=>"faktury.test","user"=>"faktury","password"=>"faktury","database"=>"faktury")
);
$folders=array(
	"usr"=>"usuarios/",
	"main"=>'/'.$x[1].'/',
	"root"=>$_SERVER[''],
	"absoluta"=>$_SERVER['DOCUMENT_ROOTDOCUMENT_ROOT'].'/'.$x[1].'/',
	"img"=>"imagenes/"
);
//print_r($folders);
?>