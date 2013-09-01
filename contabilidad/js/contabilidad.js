
$(document).ready(function() {
    $(".fecha").datepicker({
        showOn: "button",
        buttonImage: "/imagenes/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "yy-mm-dd"
    });

    $('.agregarNuevaContabilidad').click(function() {
      
        var idFactura = $(this).attr('data-record')

        $('.add').fadeIn();
        $('#content_').collapse('hide');
        $.post(init.XNG_WEBSITE_URL + 'contabilidad/ajax/form_add.php', {idFactura: idFactura}, function(data) {
            $('.load_content').html(data);
            loadStylesCheckRadio();
            $('.add_form').text('Nueva Contabilidad');
        })
    })

    $('.quitarContabilidad').click(function() {
        var idcontabilidad = $(this).attr('data-contabilidad');


        if (confirm(" Esta seguro de eliminar esta contabilidad para esta factura?")) {
            $.post(init.XNG_WEBSITE_URL + 'contabilidad/ajax/save.php?type=removeContabilidad', {idcontabilidad: idcontabilidad}, function(data) {

                if (data == 1) {
                    _loadContenido($('#nombre_archivo').val());
                    alert('Contabilidad eliminada.');
                }
            })
        }
    })




    $('.editarContabilidad').click(function() {

        var idContabilidad = $(this).attr('data-contabilidad');

        $('.add').fadeIn();
        $('#content_').collapse('hide');
        $.post(init.XNG_WEBSITE_URL + 'contabilidad/ajax/form_edit.php', {idContabilidad: idContabilidad}, function(data) {
            $('.load_content').html(data);
            loadStylesCheckRadio();
            $('.add_form').text('Editar Contabilidad');
        })
    })


})