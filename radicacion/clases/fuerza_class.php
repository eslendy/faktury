<?PHP
class fuerza extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
	}
	public function _sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM fuerza".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	public function getallFuerzas(){
		$campos="*";
		return $this->consultar($this->_sql("*","","","descripcion ASC"));
	}
        
        public function getallFuerzasByPage($page = 1, $where = ""){
		$campos="*";
		return $this->consultar_by_page($this->_sql("*","","","descripcion ASC"), $page);
	}

         public function getAllFuerzasByTerm($Params){
            $where = $Params['type'].' like "%'.$Params['term'].'%"';
            $campos="*";
            //echo $this->_sql("*",$where,"","descripcion ASC");
            return $this->consultar($this->_sql("*",$where,"","descripcion ASC")); 
            
        }
        
	public function getFuerza($id){
		$rs = $this->consultar($this->_sql("*","idfuerza=".$id));
		return $rs[0];
	}
	public function getallFuerzaAutoC($term){
		$rs = $this->consultar($this->_sql("*","descripcion LIKE '%".$term."%'"));
		$array=array();
		foreach($rs as $u){
			$array[] = '{"value":"'.$u['descripcion'].'","id":"'.$u['idfuerza'].'","abreviatura":"'.$u['abreviatura'].'"}';
		}
		return  '['.implode(",",$array).']';
	}
	public function combobox($name, $id, $class, $select=""){
		$data = $this->getallFuerzas();
		$html = '<select name="'.$name.'" id="'.$id.'" class="'.$class.'">';
			$html .= '<option value="">Seleccione</option>';
		foreach($data as $d){
			$html .= '<option value="'.$d['idfuerza'].'" '.(($d['idfuerza']==$select)?'selected="selected"':'').'>'.$d['descripcion'].'</option>';
		}
		return $html .='</select>';
	}
}
?>