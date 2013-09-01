<?php
include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");
?>
<form id="frmaddCon" class='addContabilidad' method="post" >
    <input type="hidden" value="<?php echo $_REQUEST['idFactura'];?>" name='idFactura' class='idFactura' />
    <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $_SESSION['usrid'] ?>" />
    <fieldset>
        <table width="100%" class="responsive" style="margin-top: 15px">
            <tbody>
                <tr>
                    <td width='200'>Numero Obligacion</td>
                    <td>
                        <input type="number" name="no_obligacion" id="no_obligacion" value="" class="validate[required,condRequired[chk_2],custom[numberP]]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
              
                <tr>
                    <td>Fecha Obligacion</td>
                    <td>
                        <input type="text" name="fecha_obligacion"  class="fecha validate[required]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Tarifa contratada</td>
                    <td>
                        <input type="number" name="tarifa_contratada" id="tarifa_contratada" class="validate[required,condRequired[chk_2],custom[numberP]]" data-prompt-position="centerRight:1,-5" />
                    </td>
                </tr>


            </tbody>
        </table>
    </fieldset>
</form>
<button class="btn btn-primary guardarNuevaContabilidad btn-large">Guardar Nueva Contabilidad</button>


<script>
    $('.guardarNuevaContabilidad').click(function() {
        if ($("#frmaddCon").validationEngine('validate')) {
            $.post(init.XNG_WEBSITE_URL + 'contabilidad/ajax/save.php?type=addContabilidad', $('.addContabilidad').serialize(), function(data) {
                console.log(data);
                if (data == 1) {
                    _loadContenido($('#nombre_archivo').val());
                    alert('Contabilidad agregada.');
                    $('#content_').collapse('show');
                }
            })
        }
    })
    
    $(".fecha").datepicker({
        showOn: "button",
        buttonImage: "/imagenes/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "yy-mm-dd"
    });
</script>