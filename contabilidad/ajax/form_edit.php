<?php
include('../../vigiaAjax.php');
include('../../libphp/config.inc.php');
include('../../libphp/mysql.php');
include("../../contabilidad/classes/contabilidad_class.php");
include '../requestFunctionsJavascript.php';
$contabilidad = new contabilidad($conexion['local']);
$data = $contabilidad->getContabilidadById($_POST['idContabilidad']);
?>

<form id="frmEditCon" class='frmEditCon' method="post" >


    <input type="hidden" value="<?php echo $data['idcontabilidad']?>" name='idcontabilidad' class='idContabilidad' />
    <fieldset>
        <table width="100%" class="responsive" style="margin-top: 15px">
            <tbody>
                <tr>
                    <td width='200'>Numero Obligacion</td>
                    <td>
                        <input type="number" name="no_obligacion" id="no_obligacion" value="<?php echo $data['no_obligacion']?>" class="validate[required,condRequired[chk_2],custom[numberP]]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
              
                <tr>
                    <td>Fecha Obligacion</td>
                    <td>
                        <input type="text" name="fecha_obligacion"  class="fecha validate[required]"  value="<?php echo $data['fecha_obligacion']?>" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Tarifa contratada</td>
                    <td>
                        <input type="number" name="tarifa_contratada" id="tarifa_contratada" class="validate[required,condRequired[chk_2],custom[numberP]]"  value="<?php echo $data['tarifa_contratada']?>" data-prompt-position="centerRight:1,-5" />
                    </td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</form> 
<button class="btn btn-primary guardarEdicionContabilidad btn-large">Guardar</button>
<script>
    $(".fecha").datepicker({
        showOn: "button",
        buttonImage: "/imagenes/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "yy-mm-dd"
    });
    
     $('.guardarEdicionContabilidad').click(function() {
        if ($("#frmEditCon").validationEngine('validate')) {
            $.post(init.XNG_WEBSITE_URL + 'contabilidad/ajax/save.php?type=editContabilidad', $('#frmEditCon').serialize(), function(data) {

                if (data == 1) {
                    _loadContenido($('#nombre_archivo').val());

                    alert('Contabilidad editada.');
                    $('#content_').collapse('show');
                }
            })
        }
    })
   
</script>