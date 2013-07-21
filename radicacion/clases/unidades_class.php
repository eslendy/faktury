<?PHP
class undidad extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
	}
	public function _sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM unidad_paciente".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	public function getall(){
		$campos="*";
		return $this->consultar($this->_sql("*","","","descripcion ASC"));
	}

	public function getOne($idunidad){
		$rs = $this->consultar($this->_sql("*","idunidad=".$idunidad));
		return $rs[0];
	}
	public function getallAutoC($term){
		$rs = $this->consultar($this->_sql("*","descripcion LIKE '%".$term."%'"));
		$array=array();
		foreach($rs as $u){
			$array[] = '{"value":"'.$u['descripcion'].'","id":"'.$u['idunidad'].'"}';
		}
		return  '['.implode(",",$array).']';
	}
}
?>