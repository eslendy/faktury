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
    
    public function saveGlosaValue($data){
        $sql = "insert into ValoresGlosas (valor, descripcion, id_factura, step, userid) values($data[valor], '".$data[description]."', $data[id_factura],$data[step], $_SESSION[usrid])";
        return $this->ejecutar($sql);
    }

    public function getAllListsGlosasByFacturaId($id){
        $sql = "SELECT * FROM ValoresGlosas vg WHERE vg.id_factura = $id and userid = $_SESSION[usrid] ";
        return $this->consultar($sql);
    }
    
    public function getAllListsGlosas($id){
        $sql = "SELECT * FROM auditoria_medica am, ValoresGlosas vg WHERE am.idFactura = vg.id_factura and vg.id_factura = $id";
        return $this->consultar($sql);
    }
    public function getAllGlosasAuditoria($campos = "*", $where = "", $groupby = "", $orderby = "") {
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

    public function getLastGlosaByIdAuditoria($id_auditoria) {
        if (isset($id_auditoria)) {
            $sql = "SELECT * FROM glosa_auditoria where auditoria_glosa = $id_auditoria order by step_glosa DESC limit 1";
            $rs = $this->consultar($sql);
            return $rs[0];
        } else {
            return false;
        }
    }
    
    public function getAllGlosaByIdAuditoria($id_auditoria) {
        if (isset($id_auditoria)) {
            $sql = "SELECT * FROM glosa_auditoria where auditoria_glosa = $id_auditoria order by step_glosa DESC limit 1";
            $rs = $this->consultar($sql);
            return $rs[0];
        } else {
            return false;
        }
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

    public function getAuditoriaMedicabyIdFactura($idFactura = 0) {
        if (!empty($idFactura)) {
            $where = "me.idFactura = " . $idFactura;
            //echo $this->_sql("*, me.estado AS estado_au",$where,"me.idauditoria_medica","me.fecha_auditoria DESC");
            $rs = $this->consultar($this->_sql("*, me.estado AS estado_au", $where, "me.idauditoria_medica", "me.fecha_auditoria DESC"));
            return $rs[0];
        } else {
            return false;
        }
    }

}

?>