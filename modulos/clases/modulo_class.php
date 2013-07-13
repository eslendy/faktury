<?PHP
class modulo extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
	}
	public function _modulo_sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM modulo".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	public function getallModulos(){
		return $this->consultar($this->_modulo_sql("*","","idmodulo","descripcion ASC"));
	}

	public function getModulo($idmodulo){
		$rs = $this->consultar($this->_modulo_sql("*","idmodulo=".$idmodulo,"idmodulo","descripcion ASC "));
		return $rs[0];
	}
}
?>