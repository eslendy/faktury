<?PHP
class perfil extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
	}
	public function _perfil_sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM perfil".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	public function _permisos_sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM permisos per
		INNER JOIN perfil p".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	public function getallPerfiles(){
		return $this->consultar($this->_perfil_sql("*","","idperfil","descripcion ASC"));
	}

	public function getPerfil($idperfil){
		$rs = $this->consultar($this->_perfil_sql("*","idperfil=".$idperfil,"idperfil","descripcion ASC "));
		return $rs[0];
	}
	public function getPermisosXPerfil($idperfil, $modulo){
		$rs = $this->consultar($this->_permisos_sql("per.*","per.perfil_idperfil=".$idperfil." AND per.modulo_idmodulo=".$modulo,"","per.perfil_idperfil ASC "));
		return $rs[0];	
	}
}
?>