<?PHP
class tipodoc extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
	}
	public function _sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM tipo_doc ".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	public function getall(){
		$campos="*";
		return $this->consultar($this->_sql("*","","","descripcion ASC"));
	}

	public function getOne($idgrado){
		$rs = $this->consultar($this->_sql("*","idtipo_doc=".$idgrado));
		return $rs[0];
	}
	public function getallAutoC($term){
		//$term=strtoupper($term);
		$rs =  $this->consultar($this->_paciente_sql("UPPER(descripcion)","UPPER(descripcion) LIKE UPPER('%".$term."%')","idtipo_doc", "descripcion ASC"));
		$array=array();
		foreach($rs as $g){
			$array[] = '{"value":"'.$g['descripcion'].'","id":"'.$g['idtipo_doc'].'"}';
		}
		return  '['.implode(",",$array).']';
	}
	public function combobox($name, $id, $class, $select=""){
		$data = $this->getall();
		$html = '<select name="'.$name.'" id="'.$id.'" class="'.$class.'">';
			$html .= '<option value="">Seleccione</option>';
		foreach($data as $d){
			$html .= '<option value="'.$d['idtipo_doc'].'" '.(($d['idtipo_doc']==$select)?'selected="selected"':'').'>'.$d['descripcion'].'</option>';
		}
		return $html .='</select>';
	}
}
?>