<?php
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');

include("../../presupuesto/classes/presupuesto_class.php");

include '../requestFunctionsJavascript.php';

$presupuesto = new presupuesto($conexion['local']);
$data = $presupuesto->getPresupuesto($_POST['idPresupuesto']);
//var_dump($data);
?>

<form id="frmEditPre" class='frmEditPre' class="formulario" method="post" >


    <input type="hidden" value="<?php echo $data['idpresupuesto']?>" name='idpresupuesto' class='idpresupuesto' />
    <fieldset>
        <table width="100%" class="responsive" style="margin-top: 15px">
            <tbody>
                <tr>
                    <td width='200'>Numero CDP</td>
                    <td>
                        <input type="number" name="presupuesto_cdp" id="presupuesto_cdp" value="<?php echo $data['presupuesto_cdp']?>" class="validate[required,condRequired[chk_2],custom[numberP]]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Fecha CDP</td>
                    <td>
                        <input type="text" name="presupuesto_fecha_cdp"  class="fecha validate[required]" value="<?php echo $data['presupuesto_fecha_cdp']?>" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Numero RPC</td>
                    <td>
                        <input type="number" name="presupuesto_rpc" id="presupuesto_rpc" value="<?php echo $data['presupuesto_rpc']?>" class="validate[required,condRequired[chk_2],custom[numberP]]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Fecha RPC</td>
                    <td>
                        <input type="text" name="presupuesto_fecha_rpc"  class="fecha validate[required]"  value="<?php echo $data['presupuesto_fecha_rpc']?>" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Numero de Resolucion de r. del gasto</td>
                    <td>
                        <input type="number" name="presupuesto_numero_resolucion" id="presupuesto_numero_resolucion" class="validate[required,condRequired[chk_2],custom[numberP]]"  value="<?php echo $data['presupuesto_rpc']?>" data-prompt-position="centerRight:1,-5" />
                    </td>
                </tr>

                <tr>
                    <td>Fecha resolucion de r. del gasto</td>
                    <td>
                        <input type="text" name="presupuesto_fecha_rpc_gasto"  class="fecha validate[required]" data-prompt-position="centerRight:1,-5" value="<?php echo $data['presupuesto_fecha_rpc_gasto']?>"/>
                    </td>
                </tr>

            </tbody>
        </table>
    </fieldset>
</form>
<script>
    $(".fecha").datepicker({
        showOn: "button",
        buttonImage: "/imagenes/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "yy-mm-dd"
    });
    
   
</script>