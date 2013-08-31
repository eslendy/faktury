
$(document).ready(function() {
    $(".fecha").datepicker({
        showOn: "button",
        buttonImage: "/imagenes/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "yy-mm-dd"
    });

    /* $('.agregarNuevoPresupuesto').click(function() {
     resetForm('#frmaddPre');
     //$('.presupuesto_id').val($(this).attr('data-presupuesto'));
     $('.idFactura').val($(this).attr('data-record'));
     $('.auditoria_id').val($(this).attr('data-auditoria'));
     // $('#agregarPresupuesto .modal-body').html(data);
     
     })*/

    $('.agregarNuevoPresupuesto').click(function() {
        resetForm('#frmaddPre');
        var action = $(this).attr('data-action');
        var auditoria_id = $(this).attr('data-auditoria');
        var idFactura = $(this).attr('data-record')

        $('.add').fadeIn();
        $('#content_').collapse('hide');
        $.post(init.XNG_WEBSITE_URL + 'presupuesto/ajax/form_add.php', {idFactura: idFactura, auditoria_id: auditoria_id}, function(data) {
            $('.load_content').html(data);
            loadStylesCheckRadio();
            $('.add_form').text('Nuevo Presupuesto');
        })
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




    $('.editarPresupuesto').click(function() {


        var idPresupuesto = $(this).attr('data-presupuesto');

        $('.add').fadeIn();
        $('#content_').collapse('hide');
        $.post(init.XNG_WEBSITE_URL + 'presupuesto/ajax/form_edit.php', {idPresupuesto: idPresupuesto}, function(data) {
            $('.load_content').html(data);
            loadStylesCheckRadio();
            $('.add_form').text('Editar Presupuesto');
        })
    })


})