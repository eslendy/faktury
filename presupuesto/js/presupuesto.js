
$(document).ready(function() {
    $(".fecha").datepicker({
        showOn: "button",
        buttonImage: "/imagenes/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "yy-mm-dd"
    });

    $('.agregarNuevoPresupuesto').click(function() {
        resetForm('#frmaddPre');
        //$('.presupuesto_id').val($(this).attr('data-presupuesto'));
        $('.idFactura').val($(this).attr('data-record'));
        $('.auditoria_id').val($(this).attr('data-auditoria'));
        // $('#agregarPresupuesto .modal-body').html(data);

    })

    $('.quitarPresupuesto').click(function() {
        var idpresupuesto = $(this).attr('data-presupuesto');


        if (confirm(" Esta seguro de eliminar el presupuesto para esta factura?")) {
            $.post(init.XNG_WEBSITE_URL + 'presupuesto/ajax/save.php?type=removePresupuesto', {idpresupuesto: idpresupuesto}, function(data) {

                if (data == 1) {
                     _loadContenido($('#nombre_archivo').val());
                    alert('Presupuesto eliminado.');
                }
            })
        }





    })

    $('.guardarEdicionPresupuesto').click(function() {
        if ($("#frmEditPre").validationEngine('validate')) {
            $.post(init.XNG_WEBSITE_URL + 'presupuesto/ajax/save.php?type=editPresupuesto', $('#frmEditPre').serialize(), function(data) {

                if (data == 1) {
                    _loadContenido($('#nombre_archivo').val());
                    
                    alert('Presupuesto editado.');
                    $('#editarPresupuesto').modal('hide');
                }
            })
        }
    })

    $('.guardarNuevoPresupuesto').click(function() {
        if ($("#frmaddPre").validationEngine('validate')) {
            $.post(init.XNG_WEBSITE_URL + 'presupuesto/ajax/save.php?type=addPresupuesto', $('.addPresupuesto').serialize(), function(data) {
                console.log(data);
                if (data == 1) {
                     _loadContenido($('#nombre_archivo').val());
                    alert('Presupuesto agregado.');
                    $('#agregarPresupuesto').modal('hide');
                }
            })
        }
    })

    $('.editarPresupuesto').click(function() {
        var idPresupuesto = $(this).attr('data-presupuesto');
        // if ($("#frmaddPre").validationEngine('validate')) {
        $.post(init.XNG_WEBSITE_URL + 'presupuesto/ajax/form_edit.php', {idPresupuesto: idPresupuesto}, function(data) {
            $('#editarPresupuesto .modal-body').html(data);
        })
        // }
    })

})