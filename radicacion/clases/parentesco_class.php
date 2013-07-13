<?PHP
class parentesco extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
	}
	public function _sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM parentesco".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	public function getall($where=""){
		return $this->consultar($this->_sql("*",$where,"idparentesco","descripcion ASC"));
	}

	public function getOne($id){
		$rs = $this->consultar($this->_sql("*","idparentesco=".$id,"idparentesco","descripcion ASC"));
		return $rs[0];
	}
	public function getallAutoC($term){
		//$term=strtoupper($term);
		$rs =  $this->consultar($this->_sql("*","UPPER(descripcion) LIKE UPPER('%".$term."%') ","idparentesco", "descripcion ASC"));
		$array=array();
		foreach($rs as $g){
			$array[] = '{"value":"'.$g['descripcion'].'","id":"'.$g['idparentesco'].'"}';
		}
		return  '['.implode(",",$array).']';
	}
}
?>