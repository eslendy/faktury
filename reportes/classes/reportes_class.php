<?php

class reportes extends BD {

    public function __construct($conexion) {
        $this->BD($conexion);
    }
    public function getTotalDineroByDaySelected($date){
        $sql = 'SELECT CONCAT( "Dia ", DAY( fecha_radicacion ) ) AS DAY_NUMBER, SUM( `valor` ) AS total FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "'.$date.'%" GROUP BY DAY( fecha_radicacion ) ';
        $rs = $this->consultar_by_page($sql, 1);
        return $rs;
    }
    
    public function getTotalDineroByDaysMonthSelected($date){
        $sql = 'SELECT CONCAT( "Dia ", DAY( fecha_radicacion ) ) AS DAY_NAME, DAY( fecha_radicacion ) as DAY_NUMBER, MONTH( fecha_radicacion ) as MONTH_NUMBER, SUM( `valor` ) AS total FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "'.$date.'%" GROUP BY DAY( fecha_radicacion ) ';
        $rs = $this->consultar_by_page($sql, 1);
        return $rs;
    }
    
     public function getTotalDineroByMonthYearsSelected($date){
         
        $sql = 'SELECT CONCAT( "Mes ", MONTH( fecha_radicacion ) ) AS MONTH_NAME, MONTH( fecha_radicacion ) as MONTH_NUMBER, YEAR( fecha_radicacion ) as YEAR_NUMBER, SUM( `valor` ) AS total FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "'.$date.'%" GROUP BY MONTH( fecha_radicacion ) ';
        $rs = $this->consultar_by_page($sql, 1);
        return $rs;
    }
    
    
    public function getTotalDineroByMonthSelected($date){
        $sql = 'SELECT CONCAT( "Mes ", MONTH( fecha_radicacion ) ) AS MONTH_NUMBER, SUM( `valor` ) AS total FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "'.$date.'%" GROUP BY MONTH( fecha_radicacion ) ';
        $rs = $this->consultar_by_page($sql,1);
        return $rs;
    }
    
    public function getTotalFacturasByMonthSelected($date){
        $sql = 'SELECT count(*) as  total, CONCAT( "Dia ", DAY( fecha_radicacion ) ) AS DAY_NUMBER FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "'.$date.'%"  GROUP BY DAY( fecha_radicacion )';
        $rs = $this->consultar_by_page($sql,1, 31);
        return $rs;
    }
    
    public function getTotalFacturasByYearSelected($date){
        $sql = 'SELECT count(*) as  total, CONCAT( "Mes ", MONTH( fecha_radicacion ) ) AS MONTH_NUMBER FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "'.$date.'%" GROUP BY MONTH( fecha_radicacion ) ';
        $rs = $this->consultar_by_page($sql,1, 12);
        return $rs;
    }
    
    public function getTotalFacturasByDaySelected($date){
        $sql = 'SELECT count(*) as  total, CONCAT( "Dia ", DAY( fecha_radicacion ) ) AS DAY_NUMBER FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "'.$date.'%" ';
        $rs = $this->consultar_by_page($sql,1);
        return $rs;
    }
    
    public function getTotalAuditors(){
        $sql = 'SELECT * FROM  `usuarios` AS u 
            INNER JOIN usuarios_perfil AS up ON ( u.idusuarios = up.idusuarios ) 
            INNER JOIN perfil AS p ON ( p.idperfil = up.idperfil ) 
            WHERE up.idperfil =4';
        $rs = $this->consultar_by_page($sql,1,100);
        return $rs;
    }
    
    public function getTotalFacturasByAuditors($ids){
     $sql = "SELECT *, UPPER(CONCAT_WS(' ',pa.nombre, pa.apellidos)) AS paciente_nombre, UPPER(pro.nombre) AS proveedor_nombre, 
         f.estado AS estado_factura, IFNULL(COUNT(auf.idauditoria_financiera), 0) AS audFinanciera, 
         f.idFactura as idFactura FROM factura f 
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
         LEFT JOIN auditoria_financiera auf ON (auf.idFactura = f.idFactura) 
         WHERE f.idFactura IN (SELECT idFactura FROM auditoria_financiera WHERE id_auditor IN (".$ids.")) 
         and f.estado=1 
         GROUP BY f.idFactura 
         ORDER BY f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC";   
      $rs = $this->consultar_by_page($sql,1,100);
        return $rs;
    }

    public function getTotalDineroByYearSelected($date){
        $sql = 'SELECT CONCAT( "AÑO ", YEAR( fecha_radicacion ) ) AS YEAR_NUMBER, SUM( `valor` ) AS total FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "'.$date.'%" GROUP BY YEAR( fecha_radicacion ) ';
        $rs = $this->consultar_by_page($sql,1);
        return $rs;
    }

}

?>
