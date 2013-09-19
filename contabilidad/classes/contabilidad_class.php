<?PHP

class contabilidad extends BD {

    public function __construct($conexion) {
        $this->BD($conexion);
    }

    public function _modulo_sql($campos = "*", $orderby = "", $page = 1) {
        $where_ = (($_SESSION['perfil'] == 1))?" ) and ":" ) and ";

        $sql = "SELECT " . $campos . ", UPPER(CONCAT_WS(' ',pa.nombre, pa.apellidos)) AS paciente_nombre, UPPER(pro.nombre) AS proveedor_nombre, f.estado AS estado_factura, IFNULL(COUNT(auf.idauditoria_financiera), 0) AS audFinanciera, f.idFactura as idFactura FROM factura f 
            INNER JOIN proveedor pro ON (f.idproveedor=pro.idproveedor) 
            INNER JOIN paciente pa ON (f.idpaciente=pa.idpaciente) 
            INNER JOIN unidad_atencion ua ON (f.idunidad_atencion=ua.idunidad_atencion) 
            INNER JOIN unidad_atencion ua1 ON (f.idcentralizada=ua1.idunidad_atencion) 
            INNER JOIN unidad_atencion ua2 ON (f.idcentralizadora=ua2.idunidad_atencion) 
            INNER JOIN unidad_paciente up ON (f.idunidad=up.idunidad) 
            INNER JOIN tipo_doc tdpro ON (pro.idtipo_doc=tdpro.idtipo_doc)
            INNER JOIN tipo_doc tdpa ON (pa.idtipo_doc=tdpa.idtipo_doc) 
            INNER JOIN presupuesto pres ON (pres.idFactura=f.idFactura) 
            INNER JOIN grado g ON (f.idgrado=g.idgrado) 
            INNER JOIN fuerza fu ON (pa.idfuerza=fu.idfuerza) 
            INNER JOIN parentesco par ON (f.idparentesco=par.idparentesco) 
            LEFT JOIN auditoria_financiera auf ON (auf.idFactura = f.idFactura) 
            
            WHERE f.idFactura IN (SELECT idFactura FROM auditoria_financiera ".$where_."  f.estado=1 
            GROUP BY f.idFactura ORDER BY f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC";
        return $sql;
    }

    public function getContabilidadByPage($page = FALSE) {
        return $this->consultar($this->_modulo_sql('*', 'DESC', $page));
    }
    
    public function getContabilidadByPaged($page = FALSE) {
        return $this->consultar_by_page($this->_modulo_sql('*', 'DESC'),$page);
    }

    public function getContabilidadByFactura($id_factura) {
        if (!empty($id_factura)) {
            $sql = 'select * from contabilidad where idFactura = ' . $id_factura;
            $return = $this->consultar($sql);
            return $return[0];
        } else {
            return false;
        }
    }

    public function getContabilidadById($id_contabilidad) {

        $sql = 'select * from contabilidad where idcontabilidad = ' . $id_contabilidad;
        $return = $this->consultar($sql);
        return $return[0];
    }

}