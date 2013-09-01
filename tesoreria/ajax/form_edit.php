<?php
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');
include("../../tesoreria/classes/tesoreria_class.php");
$tesoreria = new tesoreria($conexion['local']);
$data= $tesoreria->getTesoreriaById($_POST['idTesoreria']);
include '../requestFunctionsJavascript.php';

?>

<form id="frmEditTeso" class='frmEditTeso' method="post" >


    <input type="hidden" value="<?php echo $data['idtesoreria']?>" name='idtesoreria' class='idTesoreria' />
    <fieldset>
        <table width="100%" class="responsive" style="margin-top: 15px">
            <tbody>
                <tr>
                    <td width='200'>Número trámite interno de pago</td>
                    <td>
                        <input type="number" name="no_tramite_pago" id="no_tramite_pago" value="<?php echo $data['no_tramite_pago']?>" class="validate[required,condRequired[chk_2],custom[numberP]]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
              
                <tr>
                    <td>Fecha del trámite interno de pago</td>
                    <td>
                        <input type="text" name="fecha_tramite_pago"  class="fecha validate[required]"  value="<?php echo $data['fecha_tramite_pago']?>" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Número orden de pago</td>
                    <td>
                        <input type="number" name="no_orden_pago" id="no_orden_pago" class="validate[required,condRequired[chk_2],custom[numberP]]"  value="<?php echo $data['no_orden_pago']?>" data-prompt-position="centerRight:1,-5" />
                    </td>
                </tr>
                
                 <tr>
                    <td>Fecha orden de pago</td>
                    <td>
                        <input type="text" name="fecha_orden_pago"  value="<?php echo $data['fecha_orden_pago']?>" class="fecha validate[required]" data-prompt-position="centerRight:1,-5" value=""/>
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</form> 
<button class="btn btn-primary guardarEdicionTesoreria btn-large">Guardar</button>
<script>
    $(".fecha").datepicker({
        showOn: "button",
        buttonImage: "/imagenes/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "yy-mm-dd"
    });
    
     $('.guardarEdicionTesoreria').click(function() {
        if ($("#frmEditTeso").validationEngine('validate')) {
            $.post(init.XNG_WEBSITE_URL + 'tesoreria/ajax/save.php?type=editTesoreria', $('#frmEditTesoreria').serialize(), function(data) {

                if (data == 1) {
                    _loadContenido($('#nombre_archivo').val());

                    alert('Tesoreria editada.');
                    $('#content_').collapse('show');
                }
            })
        }
    })
   
</script>