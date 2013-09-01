<?php
include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");
?>
<form id="frmaddTeso" class='addTesoreria' method="post" >
    <input type="hidden" value="<?php echo $_REQUEST['idFactura'];?>" name='idFactura' class='idFactura' />
    <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $_SESSION['usrid'] ?>" />
    <fieldset>
        <table width="100%" class="responsive" style="margin-top: 15px">
            <tbody>
                <tr>
                    <td width='200'>Número trámite interno de pago</td>
                    <td>
                        <input type="number" name="no_tramite_pago" id="no_tramite_pago" value="" class="validate[required,condRequired[chk_2],custom[numberP]]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
              
                <tr>
                    <td>Fecha del trámite interno de pago</td>
                    <td>
                        <input type="text" name="fecha_tramite_pago"  class="fecha validate[required]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Número orden de pago</td>
                    <td>
                        <input type="number" name="no_orden_pago" id="no_orden_pago" class="validate[required,condRequired[chk_2],custom[numberP]]" data-prompt-position="centerRight:1,-5" />
                    </td>
                </tr>
                 <tr>
                    <td>Fecha orden de pago</td>
                    <td>
                        <input type="text" name="fecha_orden_pago"  class="fecha validate[required]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>

            </tbody>
        </table>
    </fieldset>
</form>
<button class="btn btn-primary guardarNuevaTesoreria btn-large">Guardar Nueva Tesoreria</button>


<script>
    $('.guardarNuevaTesoreria').click(function() {
        if ($("#frmaddTeso").validationEngine('validate')) {
            $.post(init.XNG_WEBSITE_URL + 'tesoreria/ajax/save.php?type=addTesoreria', $('.addTesoreria').serialize(), function(data) {
                console.log(data);
                if (data == 1) {
                    _loadContenido($('#nombre_archivo').val());
                    alert('Tesoreria agregada.');
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