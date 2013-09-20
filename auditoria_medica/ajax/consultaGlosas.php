<?php
include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");
include("../../radicacion/clases/facturas_class.php");
include("../../radicacion/clases/contrato_class.php");
include("../../radicacion/clases/tipo_servicio.php");
include("../../radicacion/clases/glosas_class.php");
include("../../radicacion/clases/cie10_class.php");
include("../../auditoria_financiera/clases/auditoria_financiera.php");
include("../../auditoria_medica/clases/auMedica_class.php");
//include("../clases/auditoria_financiera.php");
$factura = new facturas($conexion['local']);

//se obtiene la informacion de la factura a auditar
$data = $factura->getFactura($_REQUEST['id']);
$contrato = new contrato($conexion['local']);
$contrat = $contrato->getOne($data['contrato']);

$tipo_servicio = new tipo_servicio($conexion['local']);
//aud financiera
$auFinanciera = new auditoria_financiera($conexion['local']);
$auMedica = new auMedica($conexion['local']);
$auditoriaMedica = $auMedica->getOne(0, $_REQUEST['id']);

$cie10 = new cie10($conexion['local']);
$idcie10 = $cie10->getOne($auditoriaMedica['idcie10']);

$glosa = new glosas_devoluciones($conexion['local']);
$glosas = $glosa->getOne($auditoriaMedica['devoluciones_iddevolucion']);
$glosa_inicial = $glosa->getOne($auditoriaMedica['glosa_idglosa']);

$AllGlosas = $auMedica->getAllGlosasAuditoria('*', ' auditoria_glosa= ' . $_REQUEST['auditoria_glosa']);
?>

<table class='responsive table table-hover'>
    <tr>
        <td>
            <h3>Glosa Inicial</h3>
            
            <p>
                <b>Codigo Glosa Inicial:</b> <? echo $glosa_inicial['codigo'] . '-' . $glosa_inicial['item'] . ' ' . $glosa_inicial['descripcion']; ?>
            </p>
            <p>
                <b>Fecha de Glosa:</b> <?php echo $auditoriaMedica['glosa_fecha_glosa'] ?>
            </p>
            <p>
                <b>Valor de la Glosa</b> <?php echo $auditoriaMedica['glosa_valor_glosa'] ?>
            </p>
            <p>
                <b>Observaciones</b> <?php echo $auditoriaMedica['glosa_observaciones'] ?>
            </p>
        </td>
    </tr>
    <?php
    
    foreach ($AllGlosas as $key => $value) {


        if ($value['step_glosa'] == $key + 1 && $key ==0) {
                    $glosas = $glosa->getOne($value['glosa_idglosa_1']);
            ?>
            <tr>
                <td>
                    <h3>Primera respuesta de Glosa </h3>
                   
                    <p>
                        <b>Codigo Glosa 1:</b> <? echo $glosas['codigo'] . '-' . $glosas['item'] . ' ' . $glosas['descripcion']; ?>
                    </p>
                    <p>
                        <b>Fecha de Glosa:</b> <?php echo $value['glosa_fecha_glosa_1'] ?>
                    </p>
                     <p>
                        <b>Fecha recepcion Glosa 1:</b> <?php echo $value['glosa_fecha_recepcion_glosa_1'] ?>
                    </p>
                    <p>
                        <b>Valor aceptado por la ips</b> <?php echo $value['glosa_valor_aceptado_ips_1'] ?>
                    </p>
                    <p>
                        <b>Valor Glosa levantado</b> <?php echo $value['glosa_valor_glosa_levantado_1'] ?>
                    </p>
                    <p>
                        <b>Observaciones</b> <?php echo $value['glosa_observaciones_1'] ?>
                    </p>
                </td>
            </tr>

            <?php
        }
        if ($value['step_glosa'] == $key + 1 && $key==1) {
                    $glosas = $glosa->getOne($value['glosa_idglosa_2']);
            ?>
            <tr>
                <td>
                    <h3>Segunda respuesta de Glosa</h3>
                  
                    <p>
                        <b>Codigo Glosa 2:</b> <? echo $glosas['codigo'] . '-' . $glosas['item'] . ' ' . $glosas['descripcion']; ?>
                    </p>
                    <p>
                        <b>Fecha de Glosa:</b> <?php echo $value['glosa_fecha_glosa_2'] ?>
                    </p>
                     <p>
                        <b>Fecha recepcion Glosa 2:</b> <?php echo $value['glosa_fecha_recepcion_glosa_2'] ?>
                    </p>
                    <p>
                        <b>Valor de la Glosa</b> <?php echo $value['glosa_valor_glosa_2'] ?>
                    </p>
                    <p>
                        <b>Observaciones</b> <?php echo $value['glosa_observaciones_2'] ?>
                    </p>
                </td>
            </tr>
            <?php
        }
        if ($value['step_glosa'] == $key + 1 && $key==2) {
                    $glosas = $glosa->getOne($value['glosa_idglosa_3']);
            ?>
            <tr>
                <td>
                    <h3>Glosa de conciliacion</h3>
                   
                    <p>
                        <b>Codigo Glosa 3:</b> <? echo $glosas['codigo'] . '-' . $glosas['item'] . ' ' . $glosas['descripcion']; ?>
                    </p>
                    <p>
                        <b>Fecha de Glosa:</b> <?php echo $value['glosa_fecha_glosa_3'] ?>
                    </p>
                     <p>
                        <b>Fecha recepcion Glosa 3:</b> <?php echo $value['glosa_fecha_recepcion_glosa_3'] ?>
                    </p>
                    <p>
                        <b>Valor definitivo Glosa</b> <?php echo $value['glosa_valor_glosa_3'] ?>
                    </p>
                    <p>
                        <b>Observaciones</b> <?php echo $value['glosa_observaciones_3'] ?>
                    </p>
                </td>
            </tr>
            <?php
        }
        ?>

    <? }
    ?>


</table>