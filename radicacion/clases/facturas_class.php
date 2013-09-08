<?PHP

class facturas extends BD {

    public function __construct($conexion) {
        $this->BD($conexion);
    }

    public function _modulo_sql($campos = "*", $where = "", $groupby = "", $orderby = "", $other_join = FALSE) {
        $sql = "SELECT " . $campos . "
		FROM factura f
		INNER JOIN proveedor pro ON (f.idproveedor=pro.idproveedor)
		INNER JOIN paciente pa ON (f.idpaciente=pa.idpaciente)
		INNER JOIN unidad_atencion ua ON (f.idunidad_atencion=ua.idunidad_atencion)
		INNER JOIN unidad_atencion ua1 ON (f.idcentralizada=ua1.idunidad_atencion)
		INNER JOIN unidad_atencion ua2 ON (f.idcentralizadora=ua2.idunidad_atencion)
		INNER JOIN unidad_paciente up ON (f.idunidad=up.idunidad)
		INNER JOIN tipo_doc tdpro ON (pro.idtipo_doc=tdpro.idtipo_doc)
		INNER JOIN tipo_doc tdpa ON (pa.idtipo_doc=tdpa.idtipo_doc)
		INNER JOIN grado g ON (f.idgrado=g.idgrado)
		INNER JOIN fuerza fu ON (pa.idfuerza=fu.idfuerza)
		INNER JOIN parentesco par ON (f.idparentesco=par.idparentesco)
                " . $other_join . "
		LEFT JOIN auditoria_financiera auf ON (auf.idFactura = f.idFactura)" .
                (($where != "") ? " WHERE " . $where : "") .
                (($groupby != "") ? " GROUP BY " . $groupby : "") .
                (($orderby != "") ? " ORDER BY " . $orderby : "");

        return $sql;
    }

    public function getAllFacturasPaginated($page = 1, $where = "") {
        if (empty($page)) {
            $page = 1;
        }
        $campos = "*, UPPER(CONCAT_WS(' ',pa.nombre, pa.apellidos)) AS  paciente_nombre, UPPER(pro.nombre) AS proveedor_nombre, f.estado AS estado_factura, f.idFactura AS idf";
        return $this->consultar_by_page($this->_modulo_sql($campos, $where, "f.idFactura", "f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC"), $page);
    }

    public function getallFacturas($where = "", $page = 1) {

        $campos = "*, UPPER(CONCAT_WS(' ',pa.nombre, pa.apellidos)) AS  paciente_nombre, UPPER(pro.nombre) AS proveedor_nombre, f.estado AS estado_factura, f.idFactura AS idf";
        return $this->consultar_by_page($this->_modulo_sql($campos, $where, "f.idFactura", "f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC"), $page);
    }

    public function getAllFacturasByTerm($Params, $where = false, $inner_join = false) {
        //echo 'das';
        $where = $Params['type'] . ' like "%' . $Params['term'] . '%" ' . $where;
        $campos = "*, UPPER(CONCAT_WS(' ',pa.nombre, pa.apellidos)) AS  paciente_nombre, UPPER(pro.nombre) AS proveedor_nombre, f.estado AS estado_factura, f.idFactura AS idf,  IFNULL(COUNT(auf.idauditoria_financiera), 0) AS audFinanciera ";
        //echo $this->_modulo_sql($campos, $where, "f.idFactura", "f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC", $inner_join);

        return $this->consultar($this->_modulo_sql($campos, $where, "f.idFactura", "f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC", $inner_join));
    }

    public function getall($campos = "", $where = "", $other_join='') {
        $campos = ($campos == "") ? "*, UPPER(CONCAT_WS(' ',pa.nombre, pa.apellidos)) AS  paciente_nombre, UPPER(pro.nombre) AS proveedor_nombre, f.estado AS estado_factura, f.idFactura AS idf" : $campos;
        // echo $this->_modulo_sql($campos, $where, "f.idFactura", "f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC");
        return $result = $this->consultar($this->_modulo_sql($campos, $where, "f.idFactura", "f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC", $other_join));
    }

    public function getFactura($idFactura) {
        $campos = "*, UPPER(CONCAT_WS(' ',pa.nombre, pa.apellidos)) AS  paciente_nombre, UPPER(CONCAT('<b>',tdpro.descripcion,'</b> ',pro.nodocumento,'-',pro.dv)) AS doc_proveedor,
		UPPER(CONCAT('<b>',tdpa.descripcion,'</b> ',pa.documento)) AS doc_paciente, UPPER(CONCAT(fu.descripcion,' - ',fu.abreviatura)) AS fuerza,
		UPPER(pro.nombre) AS proveedor_nombre, f.estado AS estado_factura, UPPER(ua.descripcion) AS Uatencion, UPPER(ua1.descripcion) AS UatencionC, UPPER(ua2.descripcion) AS UatencionCe,
		up.descripcion AS Upaciente, CONCAT_WS(' - ',g.descripcion, g.abreviatura) AS grado, f.idunidad_atencion AS idunidad_at, UPPER(par.descripcion) AS desc_parentesco, f.idFactura AS idf";

        $rs = $this->consultar($this->_modulo_sql($campos, "f.idFactura=" . $idFactura, "f.idFactura", "f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC"));
        return $rs[0];
    }

}

?>