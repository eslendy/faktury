<?PHP
class tipo_servicio extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
	}
	public function _sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM tipo_servicio".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	public function getall(){
		$campos="*";
		return $this->consultar($this->_sql($campos,"","idtipo_servicio","descripcion ASC"));
	}

	public function getOne($id){
			$rs = $this->consultar($this->_sql("*","idtipo_servicio=".$id));
			return $rs[0];
	}
	public function getallAutoC($term){
		$rs =  $this->consultar($this->_sql("*","descripcion LIKE '%".$term."%'"));
		$array=array();
		foreach($rs as $g){
			$array[] = '{"value":"'.$g['descripcion'].'","id":"'.$g['idtipo_servicio'].'"}';
		}
		return  '['.implode(",",$array).']';
	}

	public function _select($where, $name, $id, $select=""){
		$campos="idtipo_servicio, UPPER(descripcion) AS descripcion";
		$rs = $this->consultar($this->_sql($campos, $where,"","descripcion ASC"));
		$html='<select name="'.$name.'" id="'.$id.'" class="validate[required]" >';
			$html.='<option value="">SELECCIONE</option>';
			foreach($rs as $r){
				$html.='<option value="'.$r['idtipo_servicio'].'" '.(($select==$r['idtipo_servicio'])?'selected="selected"':'').'>'.$r['descripcion'].'</option>';
			}
		$html.='</select>';
		return $html;
	}
}
?>