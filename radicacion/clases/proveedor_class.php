<?PHP
class proveedor extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
	}
	public function _sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM proveedor p INNER JOIN tipo_doc t ON (p.idtipo_doc = t.idtipo_doc)".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	public function getall(){
		$campos="*";
		return $this->consultar($this->_sql("*,p.estado AS estadoProveedor, t.descripcion AS desTipod","","","idproveedor ASC"));
	}
        
        public function getAllProveedoresByTerm($Params){
            $where = $Params['type'].' like "%'.$Params['term'].'%"';
            $campos="*";
           // echo $this->_sql("*, p.estado AS estadoProveedor, t.descripcion AS desTipod ",$where,""," idproveedor ASC ");
            return $this->consultar($this->_sql("*,p.estado AS estadoProveedor, t.descripcion AS desTipod ",$where,""," idproveedor ASC"));
            
            
        }
	public function getOne($id){
		$rs = $this->consultar($this->_sql("*, p.estado AS estadoProveedor","idproveedor=".$id));
		return $rs[0];
	}
	public function getallAutoC($term){
		//$term=strtoupper($term);
		$rs =  $this->consultar($this->_sql("UPPER(p.nombre) AS proveedor, p.idproveedor","UPPER(p.nombre) LIKE UPPER('%".$term."%') OR nodocumento LIKE '%".$term."%'","p.idproveedor", "proveedor ASC"));
		$array=array();
		foreach($rs as $g){
			$array[] = '{"value":"'.$g['proveedor'].'","id":"'.$g['idproveedor'].'"}';
		}
		return  '['.implode(",",$array).']';
	}
}
?>