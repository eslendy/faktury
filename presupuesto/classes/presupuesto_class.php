<?PHP
class presupuesto extends BD{
	public function __construct($conexion){
		$this->BD($conexion);
	}
	public function _presupuesto_sql($campos="*", $where="", $groupby="", $orderby=""){
		$sql= "SELECT ".$campos."
		FROM presupuesto as p".
		(($where!="")?" WHERE ".$where:"").
		(($groupby!="")?" GROUP BY ".$groupby:"").
		(($orderby!="")? " ORDER BY ".$orderby:"");
		
		return $sql;
	}
	
	public function getallPresupuestos(){
		return $this->consultar($this->_presupuesto_sql("*","","idpresupuesto","presupuesto_fecha_cdp ASC"));
	}

	public function getPresupuesto($idpresupuesto){
            //echo $this->_presupuesto_sql("*","idpresupuesto=".$idpresupuesto,"idpresupuesto","presupuesto_fecha_cdp ASC ");
		$rs = $this->consultar($this->_presupuesto_sql("*","idpresupuesto=".$idpresupuesto,"idpresupuesto","presupuesto_fecha_cdp ASC "));
		return $rs[0];
	}
        
        public function getPresupuestoByFactura($idfactura){
                if(!empty($idfactura)){
                 
                //echo $this->_presupuesto_sql("*","idFactura=".$idfactura,"idFactura","presupuesto_fecha_cdp ASC ");
		$rs = $this->consultar($this->_presupuesto_sql("*","idFactura=".$idfactura,"idFactura","presupuesto_fecha_cdp ASC "));
		return $rs[0];
                }
                
	}
}
?>