<?PHP
class cie10 extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
	}
	public function _sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM cie10".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	public function getall(){
		$campos="*";
		return $this->consultar($this->_sql($campos,"","idcie10","descripcion ASC"));
	}

	public function getOne($id){
			$rs = $this->consultar($this->_sql("*","idcie10=".$id));
			return $rs[0];
	}
	public function getallAutoC($term){
		$rs =  $this->consultar($this->_sql("*"," UPPER(codigo) LIKE UPPER('%".$term."%') OR UPPER(descripcion) LIKE UPPER('%".$term."%')"));
		$array=array();
		foreach($rs as $g){
			$array[] = '{"value":"'.$g['codigo'].' - '.$g['descripcion'].'","id":"'.$g['idcie10'].'"}';
		}
		return  '['.implode(",",$array).']';
	}

	public function _select($where, $name, $id, $select=""){
		$campos="idcie10, codigo, UPPER(descripcion) AS descripcion";
		$rs = $this->consultar($this->_sql($campos, $where,"","descripcion ASC"));
		$html='<select name="'.$name.'" id="'.$id.'" class="validate[required]" >';
			$html.='<option value="">SELECCIONE</option>';
			foreach($rs as $r){
				$html.='<option value="'.$r['idcie10'].'" '.(($select==$r['idcie10'])?'selected="selected"':'').'>'.$r['codigo'].' - '.$r['descripcion'].'</option>';
			}
		$html.='</select>';
		return $html;
	}
}
?>