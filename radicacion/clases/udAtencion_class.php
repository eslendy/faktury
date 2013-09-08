<?PHP

class undidad_atencion extends BD {

    public function __construct($conexion) {
        $this->BD($conexion);
    }

    public function _und_sql($campos = "*", $where = "", $groupby = "", $orderby = "") {
        $sql = "SELECT " . $campos . "
		FROM unidad_atencion" .
                (($where != "") ? " WHERE " . $where : "") .
                (($groupby != "") ? " GROUP BY " . $groupby : "") .
                (($orderby != "") ? " ORDER BY " . $orderby : "");

        return $sql;
    }

    public function getallUnidades() {
        $campos = "*";
        return $this->consultar($this->_und_sql("*", "", "", "descripcion ASC"));
    }

    public function getallUnidadesByPage($page = 1, $where = '') {
        if (empty($page)) {
            $page = 1;
        }
        $campos = "*";
        return $this->consultar_by_page($this->_und_sql("*", "", "", "descripcion ASC"), $page);
    }

    public function getallUndByTerm($Params) {
        $where = $Params['type'] . ' like "%' . $Params['term'] . '%"';
        return $this->consultar_by_page($this->_und_sql("*", $where, "", "descripcion ASC"), $Params['page']);
    }

    public function getUnidad($idunidad) {
        $rs = $this->consultar($this->_und_sql("*", "idunidad_atencion=" . $idunidad));
        return $rs[0];
    }

    public function getallUndAutoC($term, $where = "") {
        //echo $this->_und_sql("*","descripcion LIKE '%".$term."%' ".$where);
        $rs = $this->consultar($this->_und_sql("*, UPPER(descripcion) AS descripcion", "descripcion LIKE '%" . $term . "%' " . $where));
        //echo print_r($rs);
        $array = array();
        foreach ($rs as $u) {
            $array[] = '{"value":"' . $u['descripcion'] . '","id":"' . $u['idunidad_atencion'] . '"}';
        }
        return '[' . implode(",", $array) . ']';
    }

}

?>