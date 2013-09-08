<?PHP
class grados extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
	}
	public function _grado_sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM grado".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	public function getallGrados(){
		$campos="*";
		return $this->consultar($this->_grado_sql("*","","","descripcion ASC"));
	}
        
        public function getallGradosByPage($page = 1, $where = ''){
		$campos="*";
		return $this->consultar_by_page($this->_grado_sql("*","","","descripcion ASC"), $page);
	}
        
        public function getAllGradosByTerm($Params){
            $where = $Params['type'].' like "%'.$Params['term'].'%"';
            $campos="*";
            return $this->consultar_by_page($this->_grado_sql("*",$where,"","descripcion ASC"), $Params['page']); 
            
        }

	public function getGrado($idgrado){
		$rs = $this->consultar($this->_grado_sql("*","idgrado=".$idgrado));
		return $rs[0];
	}
	public function getallGradoAutoC($term){
		$rs =  $this->consultar($this->_grado_sql("*","descripcion LIKE '%".$term."%' OR abreviatura LIKE '%".$term."%'"));
		$array=array();
		foreach($rs as $g){
			$array[] = '{"value":"'.$g['descripcion'].' - '.$g['abreviatura'].'","id":"'.$g['idgrado'].'"}';
		}
		return  '['.implode(",",$array).']';
	}
}
?>