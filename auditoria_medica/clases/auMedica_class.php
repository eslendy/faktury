<?PHP

class auMedica extends BD {

    public function __construct($conexion) {
        $this->BD($conexion);
    }

    

    public function _sql($campos = "*", $where = "", $groupby = "", $orderby = "") {
        $sql = "SELECT " . $campos . "
		FROM factura f
		INNER JOIN auditoria_medica me ON (f.idFactura=me.idFactura)
		" .
                (($where != "") ? " WHERE " . $where : "") .
                (($groupby != "") ? " GROUP BY " . $groupby : "") .
                (($orderby != "") ? " ORDER BY " . $orderby : "");

        return $sql;
    }

    public function getAllGlosasAuditoria($campos = "*", $where = "", $groupby = "", $orderby = ""){
        $sql = "SELECT " . $campos . "
		FROM glosa_auditoria ga " .
                (($where != "") ? " WHERE " . $where : "") .
                (($groupby != "") ? " GROUP BY " . $groupby : "") .
                (($orderby != "") ? " ORDER BY " . $orderby : "");
        return $this->consultar($sql);
    }
    public function getall($where = "") {
        $campos = "*, UPPER(CONCAT_WS(' ',pa.nombre, pa.apellidos)) AS  paciente_nombre, UPPER(pro.nombre) AS proveedor_nombre, f.estado AS estado_factura";
        return $this->consultar($this->_sql($campos, $where, "f.idFactura", "f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC"));
    }

    public function getOne($idAu, $idFactura = 0, $con = "") {
        $where = array();
        if ($idAu > 0) {
            $where[] = "me.idauditoria_medica = " . $idAu;
        }
        //var_dump($idFactura);
        if ($idFactura > 0) {
            $where[] = "me.idFactura = " . $idFactura;
        }if ($con != "") {
            $where[] = $con;
        }
        $where = implode(" AND ", $where);
        //echo $this->_sql("*, me.estado AS estado_au",$where,"me.idauditoria_medica","me.fecha_auditoria DESC");
        $rs = $this->consultar($this->_sql("*, me.estado AS estado_au", $where, "me.idauditoria_medica", "me.fecha_auditoria DESC"));
        return $rs[0];
    }

}

?>