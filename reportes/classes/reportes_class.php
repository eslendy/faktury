<?php

class reportes extends BD {

    public function __construct($conexion) {
        $this->BD($conexion);
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