<?PHP
class auditoria_financiera extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
	}
	public function _sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM auditoria_financiera au
		INNER JOIN factura f ON (au.idFactura = f.idFactura)".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	public function getAll($where=""){
		return $this->consultar($this->_sql("*, au.estado AS estado_au",$where,"au.idauditoria_financiera","au.estado DESC, au.fecha_auditoria DESC, f.numero_factura DESC"));
	}

	public function getOne($idAu, $idFactura=0, $con=""){
		$where = array();
		if($idAu>0){
			$where[]= "au.idauditoria_financiera = ".$idAu;
		}
		if($idFactura>0){
			$where[]= "au.idFactura = ".$idFactura;
		}if ($con!="") {
			$where[]=$con;
		}
		$where = implode(" AND ",$where);
                //echo $this->_sql("*, au.estado AS estado_au",$where,"au.idauditoria_financiera","au.fecha_auditoria DESC");
		$rs = $this->consultar($this->_sql("*, au.estado AS estado_au",$where,"au.idauditoria_financiera","au.fecha_auditoria DESC"));
		
                return $rs[0];
	}
}
?>