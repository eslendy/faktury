<?PHP

class facturas extends BD {

    public function __construct($conexion) {
        $this->BD($conexion);
    }

    public function _modulo_sql($campos = "*", $where = "", $groupby = "", $orderby = "") {
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
		LEFT JOIN auditoria_financiera auf ON (auf.idFactura = f.idFactura)" .
                (($where != "") ? " WHERE " . $where : "") .
                (($groupby != "") ? " GROUP BY " . $groupby : "") .
                (($orderby != "") ? " ORDER BY " . $orderby : "");

        return $sql;
    }

    public function getallFacturas($where = "") {
        $campos = "*, UPPER(CONCAT_WS(' ',pa.nombre, pa.apellidos)) AS  paciente_nombre, UPPER(pro.nombre) AS proveedor_nombre, f.estado AS estado_factura, f.idFactura AS idf";
        return $this->consultar($this->_modulo_sql($campos, $where, "f.idFactura", "f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC"));
    }

    public function getAllFacturasByTerm($Params) {


        $where = $Params['type'] . ' like "%' . $Params['term'] . '%"';
        $campos = "*, UPPER(CONCAT_WS(' ',pa.nombre, pa.apellidos)) AS  paciente_nombre, UPPER(pro.nombre) AS proveedor_nombre, f.estado AS estado_factura, f.idFactura AS idf ";
        //	echo $this->_modulo_sql($campos,$where,"f.idFactura","f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC");
        return $this->consultar($this->_modulo_sql($campos, $where, "f.idFactura", "f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC"));
    }

    public function getall($campos = "", $where = "") {
        $campos = ($campos == "") ? "*, UPPER(CONCAT_WS(' ',pa.nombre, pa.apellidos)) AS  paciente_nombre, UPPER(pro.nombre) AS proveedor_nombre, f.estado AS estado_factura, f.idFactura AS idf" : $campos;
        $this->_modulo_sql($campos, $where, "f.idFactura", "f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC");
        return $result = $this->consultar($this->_modulo_sql($campos, $where, "f.idFactura", "f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC"));
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