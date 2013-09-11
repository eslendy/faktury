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
    
    
    public function getTotalDineroByYearSelected($date){
        $sql = 'SELECT CONCAT( "AÑO ", YEAR( fecha_radicacion ) ) AS YEAR_NUMBER, SUM( `valor` ) AS total FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "'.$date.'%" GROUP BY YEAR( fecha_radicacion ) ';
        $rs = $this->consultar_by_page($sql,1);
        return $rs;
    }

    /* SELECT CONCAT(  'day ', DAY( fecha_radicacion ) ) AS DAY_NUMBER, SUM(  `valor` ) AS total FROM  `factura` 
      WHERE  `estado` =  '1' GROUP BY DAY( fecha_radicacion ) LIMIT 0 , 30 */

    /* SELECT CONCAT(  'Week ', WEEK( fecha_radicacion ) ) AS WEEK_NUMBER, SUM(  `valor` ) AS total FROM  `factura` 
      WHERE  `estado` =  '1' GROUP BY WEEK( fecha_radicacion ) LIMIT 0 , 30 */

    /* SELECT CONCAT(  'Mes ', MONTH( fecha_radicacion ) ) AS MONTH_NUMBER, SUM(  `valor` ) AS total FROM  `factura` 
      WHERE  `estado` =  '1' GROUP BY MONTH( fecha_radicacion ) LIMIT 0 , 30 */
    
    /*  SELECT CONCAT(  'year ', YEAR( fecha_radicacion ) ) AS YEAR_NUMBER, SUM(  `valor` ) AS total FROM  `factura` 
      WHERE  `estado` =  '1' GROUP BY YEAR( fecha_radicacion ) LIMIT 0 , 30 */
}

?>