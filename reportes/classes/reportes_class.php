<?php

class reportes extends BD {

    public function __construct($conexion) {
        $this->BD($conexion);
    }

    public function getAuditorById($id) {
        $sql = 'SELECT * FROM usuarios u, usuarios_perfil up, perfil p where up.idusuarios = u.idusuarios and p.idperfil = up.idperfil and u.idusuarios = ' . $id;
        $rs = $this->consultar($sql);
        return $rs[0];
    }

    public function getAuditoresIds() {
        $sql = 'SELECT * FROM usuarios u, usuarios_perfil up, perfil p where up.idusuarios = u.idusuarios and p.idperfil = up.idperfil and p.idperfil in(4)';
        $rs = $this->consultar($sql);
        return $rs;
    }
    
    public function getTotalValorFacturasbyAuditor($id) {
        $sql = 'SELECT sum(f.valor) as total FROM `auditoria_financiera` af, factura f where af.idFactura = f.idFactura and id_auditor = ' . $id;
        $rs = $this->consultar($sql);
        return $rs[0];
    }
    
    public function getTotalFacturasbyAuditor($id) {
        $sql = 'SELECT count(*) as total FROM `auditoria_financiera` where id_auditor = ' . $id;
        $rs = $this->consultar($sql);
        return $rs[0];
    }

    public function getTotalFacturasRG() {
        $sql = 'SELECT count(*) as total FROM `factura` where contrato = 0';
        $rs = $this->consultar($sql);
        return $rs[0]['total'];
    }

    public function getTotalFacturasConContrato() {
        $sql = 'SELECT count(*) as total FROM `factura` where contrato > 0';
        $rs = $this->consultar($sql);
        return $rs[0]['total'];
    }

    public function getSumatoriaTotalValorFacturasXContrato() {
        $sql = 'SELECT sum(valor) as TotalValor, contrato FROM `factura` where 1=1 group by contrato ';
        $rs = $this->consultar($sql);
        return $rs;
    }

    public function getContratoById($id) {
        $sql = 'SELECT * FROM `contrato` where idcontrato = ' . $id;
        $rs = $this->consultar($sql);
        return $rs[0];
    }

    public function getAllProveedores() {
        $sql = 'SELECT * FROM `proveedor` where estado = 1';
        $rs = $this->consultar($sql);
        return $rs;
    }
    
    public function getProveedorById($id){
        $sql = 'SELECT * FROM `proveedor` where estado = 1 and idproveedor = '.$id;
        $rs = $this->consultar($sql);
        return $rs[0];
    }

    public function getTotalFacturadoXCadaProveedor() {
        $sql = 'SELECT count(*) as total, idproveedor FROM `factura` where 1=1 group by idproveedor ';
        $rs = $this->consultar($sql);
        return $rs;
    }
    
    public function getSumatoriaTotalFacturadoXCadaProveedor() {
        $sql = 'SELECT sum(valor) as TotalValor, idproveedor FROM `factura` where 1=1 group by idproveedor ';
        $rs = $this->consultar($sql);
        return $rs;
    }

    public function getGlosaById($id) {
        $sql = 'SELECT * FROM glosas where idglosas_devoluciones = ' . $id;
        $rs = $this->consultar($sql);
        return $rs;
    }

    public function getTotalValorGlosas() {
        $sql = 'SELECT SUM(glosa_valor_glosa) as TotalValor, glosa_idglosa FROM `auditoria_medica` where glosa_idglosa>0';
        $rs = $this->consultar($sql);
        return $rs[0]['TotalValor'];
    }
    
     public function getTotalGlosas() {
        $sql = 'SELECT count(*) as TotalValor, glosa_idglosa FROM `auditoria_medica` where glosa_idglosa>0';
        $rs = $this->consultar($sql);
        return $rs[0]['TotalValor'];
    }

    public function getTotalValorGlosasPorAuditor() {
        $sql = 'SELECT SUM(glosa_valor_glosa) as TotalValor, id_auditor FROM `auditoria_medica` where glosa_idglosa > 0 group by id_auditor';
        $rs = $this->consultar($sql);
        return $rs;
    }

    public function getTotalPrimeraAuditoriaPorCadaAuditor() {
        $sql = 'SELECT sum(glosa_valor_glosa) as TotalValor, id_auditor FROM `auditoria_medica` where glosa_idglosa > 0 group by id_auditor';
        $rs = $this->consultar($sql);
        return $rs;
    }

    public function getTotalPrimeraAuditoria() {
        $sql = 'SELECT count(*) as total FROM `auditoria_medica` where glosa_idglosa > 0';
        $rs = $this->consultar($sql);
        return $rs[0]['total'];
    }
    
    public function getTotalPagosPrimeraAuditoria() {
        $sql = 'SELECT count(*) as total FROM `auditoria_medica` where glosa_idglosa > 0';
        $rs = $this->consultar($sql);
        return $rs[0]['total'];
    }

    public function getTotalValorPagosPrimeraAuditoria() {
        $sql = 'SELECT sum(glosa_valor_pagar_primera_glosa) as TotalValor FROM `auditoria_medica` where glosa_idglosa > 0';
        $rs = $this->consultar($sql);
        return $rs[0]['TotalValor'];
    }

    public function getTotalValorPrimeraAuditoriaPorCadaAuditor() {
        $sql = 'SELECT sum(glosa_valor_pagar_primera_glosa) as TotalValor, id_auditor FROM `auditoria_medica` where glosa_idglosa > 0 group by id_auditor';
        $rs = $this->consultar($sql);
        return $rs;
    }

    public function getTotalGlosasLevantadasPorAuditor() {
        $sql = 'SELECT count(*) as TotalValor, am.id_auditor as id_auditor FROM `auditoria_medica` am, glosa_auditoria ga where am.glosa_idglosa > 0 and ga.step_glosa = 1 and ga.auditoria_glosa = am.idauditoria_medica group by am.id_auditor';
        $rs = $this->consultar($sql);
        return $rs;
    }

    public function getTotalGlosasLevantadas() {
        $sql = 'SELECT count(*) as total FROM `auditoria_medica` am, glosa_auditoria ga where am.glosa_idglosa > 0 and ga.step_glosa = 1 and ga.auditoria_glosa = am.idauditoria_medica ';
        $rs = $this->consultar($sql);
        return $rs[0]['total'];
    }

    public function getTotalValorGlosasLevantadas() {
        $sql = 'SELECT sum(ga.glosa_valor_glosa_levantado_1) as TotalValor FROM `auditoria_medica` am, glosa_auditoria ga where am.glosa_idglosa > 0 and ga.step_glosa = 1 and ga.auditoria_glosa = am.idauditoria_medica ';
        $rs = $this->consultar($sql);
        return $rs[0]['TotalValor'];
    }

    public function getTotalValorGlosasLevantadasPorCadaAuditor() {
        $sql = 'SELECT sum(ga.glosa_valor_glosa_levantado_1) as TotalValor, am.id_auditor FROM `auditoria_medica` am, glosa_auditoria ga where am.glosa_idglosa > 0 and ga.step_glosa = 1 and ga.auditoria_glosa = am.idauditoria_medica group by am.id_auditor';
        $rs = $this->consultar($sql);
        return $rs;
    }

    public function getTotalValorGlosasPendientes() {
        $sql = 'SELECT sum(ga.glosa_valor_glosa_2) as TotalValor, am.id_auditor FROM `auditoria_medica` am, glosa_auditoria ga where am.glosa_idglosa > 0 and ga.step_glosa = 2 and ga.auditoria_glosa = am.idauditoria_medica ';
        $rs = $this->consultar($sql);
        return $rs[0]['TotalValor'];
    }

    public function getTotalValorGlosasPendientesPorCadaAuditor() {
        $sql = 'SELECT sum(ga.glosa_valor_glosa_2) as TotalValor, am.id_auditor FROM `auditoria_medica` am, glosa_auditoria ga where am.glosa_idglosa > 0 and ga.step_glosa = 2 and ga.auditoria_glosa = am.idauditoria_medica group by am.id_auditor';
        $rs = $this->consultar($sql);
        return $rs;
    }

    public function getTotalGlosasPendientesPorAuditor() {
        $sql = 'SELECT count(*) as TotalValor, am.id_auditor FROM `auditoria_medica` am, glosa_auditoria ga where am.glosa_idglosa > 0 and ga.step_glosa = 2 and ga.auditoria_glosa = am.idauditoria_medica group by am.id_auditor';
        $rs = $this->consultar($sql);
        return $rs;
    }

    public function getTotalGlosasPendientes() {
        $sql = 'SELECT count(*) as total, am.id_auditor FROM `auditoria_medica` am, glosa_auditoria ga where am.glosa_idglosa > 0 and ga.step_glosa = 2 and ga.auditoria_glosa = am.idauditoria_medica ';
        $rs = $this->consultar($sql);
        return $rs[0]['total'];
    }

    public function getTotalGlosasDefinitivas() {
        $sql = 'SELECT count(*) as total, am.id_auditor FROM `auditoria_medica` am, glosa_auditoria ga where am.glosa_idglosa > 0 and ga.step_glosa = 3 and ga.auditoria_glosa = am.idauditoria_medica';
        $rs = $this->consultar($sql);
        return $rs[0]['total'];
    }

    public function getTotalGlosasDefinitivasPorCadaAuditor() {
        $sql = 'SELECT count(*) as TotalValor, am.id_auditor FROM `auditoria_medica` am, glosa_auditoria ga where am.glosa_idglosa > 0 and ga.step_glosa = 3 and ga.auditoria_glosa = am.idauditoria_medica group by am.id_auditor';
        $rs = $this->consultar($sql);
        return $rs;
    }

    public function getTotalValorGlosasDefinitivas() {
        $sql = 'SELECT sum(ga.glosa_valor_glosa_3) as TotalValor, am.id_auditor FROM `auditoria_medica` am, glosa_auditoria ga where am.glosa_idglosa > 0 and ga.step_glosa = 3 and ga.auditoria_glosa = am.idauditoria_medica';
        $rs = $this->consultar($sql);
        return $rs[0]['TotalValor'];
    }

    public function getTotalValorGlosasDefinitivasPorCadaAuditor() {
        $sql = 'SELECT sum(ga.glosa_valor_glosa_3) as TotalValor, am.id_auditor FROM `auditoria_medica` am, glosa_auditoria ga where am.glosa_idglosa > 0 and ga.step_glosa = 3 and ga.auditoria_glosa = am.idauditoria_medica group by am.id_auditor';
        $rs = $this->consultar($sql);
        return $rs;
    }

    public function getTotalAuditadoAuditoriaMedica() {
        $sql = 'SELECT count(*) as total FROM `auditoria_medica` am, factura f where f.idFactura = am.idFactura';
        $rs = $this->consultar($sql);
        return $rs[0]['total'];
    }
    
     public function getTotalValorAuditadoAuditoriaMedica() {
        $sql = 'SELECT sum(f.valor) as TotalValor FROM `auditoria_medica` am, factura f where f.idFactura = am.idFactura';
        $rs = $this->consultar($sql);
        return $rs[0]['TotalValor'];
    }

    public function getTotalAuditadoAuditoriaMedicaPorCadaAuditor() {
        $sql = 'SELECT sum(f.valor) as TotalValor, id_auditor FROM `auditoria_medica` am, factura f where f.idFactura = am.idFactura and am.id_auditor = 1';
        $rs = $this->consultar($sql);
        return $rs;
    }

    public function getConsumoMensualUnidadesCentralizadas() {
        
    }

    public function getConsumoMensualUnidadesCentralizadoras() {
        
    }

    public function getTotalDineroByDaySelected($date) {
        $sql = 'SELECT CONCAT( "Dia ", DAY( fecha_radicacion ) ) AS DAY_NUMBER, SUM( `valor` ) AS total FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "' . $date . '%" GROUP BY DAY( fecha_radicacion ) ';
        $rs = $this->consultar_by_page($sql, 1);
        return $rs;
    }

    public function getTotalDineroByDaysMonthSelected($date) {
        $sql = 'SELECT CONCAT( "Dia ", DAY( fecha_radicacion ) ) AS DAY_NAME, DAY( fecha_radicacion ) as DAY_NUMBER, MONTH( fecha_radicacion ) as MONTH_NUMBER, SUM( `valor` ) AS total FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "' . $date . '%" GROUP BY DAY( fecha_radicacion ) ';
        $rs = $this->consultar_by_page($sql, 1);
        return $rs;
    }

    public function getTotalDineroByMonthYearsSelected($date) {

        $sql = 'SELECT CONCAT( "Mes ", MONTH( fecha_radicacion ) ) AS MONTH_NAME, MONTH( fecha_radicacion ) as MONTH_NUMBER, YEAR( fecha_radicacion ) as YEAR_NUMBER, SUM( `valor` ) AS total FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "' . $date . '%" GROUP BY MONTH( fecha_radicacion ) ';
        $rs = $this->consultar_by_page($sql, 1);
        return $rs;
    }

    public function getTotalDineroByMonthSelected($date) {
        $sql = 'SELECT CONCAT( "Mes ", MONTH( fecha_radicacion ) ) AS MONTH_NUMBER, SUM( `valor` ) AS total FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "' . $date . '%" GROUP BY MONTH( fecha_radicacion ) ';
        $rs = $this->consultar_by_page($sql, 1);
        return $rs;
    }

    public function getTotalFacturasByMonthSelected($date) {
        $sql = 'SELECT count(*) as  total, CONCAT( "Dia ", DAY( fecha_radicacion ) ) AS DAY_NUMBER FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "' . $date . '%"  GROUP BY DAY( fecha_radicacion )';
        $rs = $this->consultar_by_page($sql, 1, 31);
        return $rs;
    }

    public function getTotalFacturasByYearSelected($date) {
        $sql = 'SELECT count(*) as  total, CONCAT( "Mes ", MONTH( fecha_radicacion ) ) AS MONTH_NUMBER FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "' . $date . '%" GROUP BY MONTH( fecha_radicacion ) ';
        $rs = $this->consultar_by_page($sql, 1, 12);
        return $rs;
    }

    public function getTotalFacturasByDaySelected($date) {
        $sql = 'SELECT count(*) as  total, CONCAT( "Dia ", DAY( fecha_radicacion ) ) AS DAY_NUMBER FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "' . $date . '%" ';
        $rs = $this->consultar_by_page($sql, 1);
        return $rs;
    }

    public function getTotalAuditors() {
        $sql = 'SELECT * FROM  `usuarios` AS u 
            INNER JOIN usuarios_perfil AS up ON ( u.idusuarios = up.idusuarios ) 
            INNER JOIN perfil AS p ON ( p.idperfil = up.idperfil ) 
            WHERE up.idperfil =4';
        $rs = $this->consultar_by_page($sql, 1, 100);
        return $rs;
    }

    public function getTotalFacturasByAuditors($ids) {
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
         WHERE f.idFactura IN (SELECT idFactura FROM auditoria_financiera WHERE id_auditor IN (" . $ids . ")) 
         and f.estado=1 
         GROUP BY f.idFactura 
         ORDER BY f.fecha_radicacion DESC, f.prefijo ASC, f.numero_factura DESC";
        $rs = $this->consultar_by_page($sql, 1, 100);
        return $rs;
    }

    public function getTotalDineroByYearSelected($date) {
        $sql = 'SELECT CONCAT( "AÑO ", YEAR( fecha_radicacion ) ) AS YEAR_NUMBER, SUM( `valor` ) AS total FROM `factura` 
            WHERE `estado` = 1 and fecha_radicacion like "' . $date . '%" GROUP BY YEAR( fecha_radicacion ) ';
        $rs = $this->consultar_by_page($sql, 1);
        return $rs;
    }

}

?>
