<?PHP

class paciente extends BD {

    public function __construct($conexion) {
        $this->BD($conexion);
    }

    public function _sql($campos = "*", $where = "", $groupby = "", $orderby = "") {
        $sql = "SELECT " . $campos . "
		FROM paciente p
		INNER JOIN fuerza f ON (p.idfuerza = f.idfuerza)
		INNER JOIN tipo_doc t ON (p.idtipo_doc = t.idtipo_doc)" .
                (($where != "") ? " WHERE " . $where : "") .
                (($groupby != "") ? " GROUP BY " . $groupby : "") .
                (($orderby != "") ? " ORDER BY " . $orderby : "");

        return $sql;
    }

    public function getallPacientes() {
        $campos = "*";
        return $this->consultar($this->_sql("*,p.estado AS estadoPaciente, f.descripcion AS desFuerza, t.descripcion AS desTipod", "", "", "nombre ASC, apellidos ASC"));
    }
    
    public function getallPacientesByPage($page = 1, $where = '') {
        if (empty($page)) {
            $page = 1;
        }
        $campos = "*";
        return $this->consultar_by_page($this->_sql("*,p.estado AS estadoPaciente, f.descripcion AS desFuerza, t.descripcion AS desTipod", "", "", "nombre ASC, apellidos ASC"),$page);
    }

    public function getAllPacientesByTerm($Params) {
        $campos = "*";
        $where = $Params['type'].' like "%'.$Params['term'].'%"';
// echo $this->_sql("*,p.estado AS estadoPaciente, f.descripcion AS desFuerza, t.descripcion AS desTipod", $where, "", "nombre ASC, apellidos ASC");
        return $this->consultar_by_page($this->_sql("*,p.estado AS estadoPaciente, f.descripcion AS desFuerza, t.descripcion AS desTipod", $where, "", "nombre ASC, apellidos ASC"),$Params['page']);
    }

    public function getOne($id) {
        $rs = $this->consultar($this->_sql("*, p.estado AS estadoPaciente", "idpaciente=" . $id));
        return $rs[0];
    }

    public function getallPacienteAutoC($term) {
        //$term=strtoupper($term);
        $rs = $this->consultar($this->_sql("UPPER(CONCAT_WS(' ',p.nombre,p.apellidos)) AS nombrePaciente, p.idpaciente", "UPPER(p.nombre) LIKE UPPER('%" . $term . "%') OR UPPER(p.apellidos) LIKE UPPER('%" . $term . "%') OR documento LIKE '%" . $term . "%' OR UPPER(CONCAT_WS(' ',p.nombre,p.apellidos)) LIKE UPPER('%" . $term . "%') OR UPPER(CONCAT_WS(' ',p.apellidos,p.nombre)) LIKE UPPER('%" . $term . "%')", "p.idpaciente", "nombrePaciente ASC"));
        $array = array();
        foreach ($rs as $g) {
            $array[] = '{"value":"' . $g['nombrePaciente'] . '","id":"' . $g['idpaciente'] . '"}';
        }
        return '[' . implode(",", $array) . ']';
    }

}

?>