<?php
include("../../vigiaAjax.php");
include("../../libphp/config.inc.php");
include("../../libphp/mysql.php");
?>
<form id="frmaddPre" class='addPresupuesto' method="post" >


    <input type="hidden" value="<?php echo $_REQUEST['auditoria_id'];?>" name='auditoria_id' class='auditoria_id' />
    <input type="hidden" value="<?php echo $_REQUEST['idFactura'];?>" name='idFactura' class='idFactura' />
    <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $_SESSION['usrid'] ?>" />
    <fieldset>
        <table width="100%" class="responsive" style="margin-top: 15px">
            <tbody>
                <tr>
                    <td width='200'>Numero CDP</td>
                    <td>
                        <input type="number" name="presupuesto_cdp" id="presupuesto_cdp" value="" class="validate[required,condRequired[chk_2],custom[numberP]]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Fecha CDP</td>
                    <td>
                        <input type="text" name="presupuesto_fecha_cdp"  class="fecha validate[required]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Numero RPC</td>
                    <td>
                        <input type="number" name="presupuesto_rpc" id="presupuesto_rpc" value="" class="validate[required,condRequired[chk_2],custom[numberP]]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Fecha RPC</td>
                    <td>
                        <input type="text" name="presupuesto_fecha_rpc"  class="fecha validate[required]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>
                <tr>
                    <td>Numero de Resolucion de r. del gasto</td>
                    <td>
                        <input type="number" name="presupuesto_numero_resolucion" id="presupuesto_numero_resolucion" class="validate[required,condRequired[chk_2],custom[numberP]]" data-prompt-position="centerRight:1,-5" />
                    </td>
                </tr>

                <tr>
                    <td>Fecha resolucion de r. del gasto</td>
                    <td>
                        <input type="text" name="presupuesto_fecha_rpc_gasto"  class="fecha validate[required]" data-prompt-position="centerRight:1,-5"/>
                    </td>
                </tr>

            </tbody>
        </table>
    </fieldset>
</form>
<button class="btn btn-primary guardarNuevoPresupuesto btn-large">Guardar Nuevo Presupuesto</button>


<script>
    $('.guardarNuevoPresupuesto').click(function() {
        if ($("#frmaddPre").validationEngine('validate')) {
            $.post(init.XNG_WEBSITE_URL + 'presupuesto/ajax/save.php?type=addPresupuesto', $('.addPresupuesto').serialize(), function(data) {
                console.log(data);
                if (data == 1) {
                    _loadContenido($('#nombre_archivo').val());
                    alert('Presupuesto agregado.');
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