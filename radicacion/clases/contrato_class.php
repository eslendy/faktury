<?PHP
class contrato extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
	}
	public function _sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM contrato c
		INNER JOIN proveedor p ON (c.idproveedor=p.idproveedor)".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	public function getall(){
		$campos="*, c.estado AS estadoContrato, UPPER(p.nombre) AS proveedor";
		return $this->consultar($this->_sql($campos,"","","c.numero_contrato ASC"));
	}
        
         public function getAllContratoByTerm($Params){
            $where = $Params['type'].' like "%'.$Params['term'].'%"';
            $campos="*, c.estado AS estadoContrato, UPPER(p.nombre) AS proveedor";
            
            //echo $this->_sql($campos,$where,"","c.numero_contrato ASC");
            
            return $this->consultar($this->_sql($campos,$where,"","c.numero_contrato ASC")); 
            
        }
        

	public function getOne($id){
		if($id==0){
			return array("numero_contrato"=>"RG", "idcontrato"=>0);
		}else{
			$rs = $this->consultar($this->_sql("*, c.estado AS estadoContrato, UPPER(p.nombre) AS proveedor","idcontrato=".$id));
			return $rs[0];
		}
	}
	public function getallAutoC($term){
		$rs =  $this->consultar($this->_sql("*, c.estado AS estadoContrato, UPPER(p.nombre) AS proveedor","c.numero_contrato LIKE '%".$term."%' OR p.nombre LIKE '%".$term."%' OR p.nodocumento LIKE '%".$term."%'"));
		$array=array();
		foreach($rs as $g){
			$array[] = '{"value":"'.$g['numero_contrato'].' - '.$g['proveedor'].'","id":"'.$g['idcontrato'].'"}';
		}
		return  '['.implode(",",$array).']';
	}

	public function _select($where, $name, $id, $select=""){
		$campos="*, c.estado AS estadoContrato, UPPER(p.nombre) AS proveedor";
		$rs = $this->consultar($this->_sql($campos, $where,"","c.numero_contrato ASC"));
		$html='<select name="'.$name.'" id="'.$id.'" class="validate[required]" >';
			$html.='<option value="">SELECCIONE</option>';
			$html.='<option value="0" '.(($select==0)?'selected="selected"':'').'>RG</option>';
			foreach($rs as $r){
				$html.='<option value="'.$r['idcontrato'].'" '.(($select==$r['idcontrato'])?'selected="selected"':'').'>'.$r['numero_contrato'].'</option>';
			}
		$html.='</select>';
		return $html;
	}
}
?>