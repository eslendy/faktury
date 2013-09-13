
$(document).ready(function() {
    $(".fecha").datepicker({
        showOn: "button",
        buttonImage: "/imagenes/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "yy-mm-dd"
    });

    $('.agregarNuevaTesoreria').click(function() {
      
        var idFactura = $(this).attr('data-record')

        $('.add').fadeIn();
        $('#content_').collapse('hide');
        $.post(init.XNG_WEBSITE_URL + 'tesoreria/ajax/form_add.php', {idFactura: idFactura}, function(data) {
            $('.load_content').html(data);
            loadStylesCheckRadio();
            $('.add_form').text('Nueva Tesoreria');
        })
    })

    $('.quitarTesoreria').click(function() {
        var idtesoreria = $(this).attr('data-tesoreria');


        if (confirm(" Esta seguro de eliminar esta tesoreria para esta factura?")) {
            $.post(init.XNG_WEBSITE_URL + 'tesoreria/ajax/save.php?type=removeTesoreria', {idtesoreria: idtesoreria}, function(data) {

                if (data == 1) {
                    _loadContenido($('#nombre_archivo').val());
                    alert('Tesoreria eliminada.');
                }
            })
        }
    })




    $('.editarTesoreria').click(function() {

        var idTesoreria = $(this).attr('data-tesoreria');

        $('.add').fadeIn();
        $('#content_').collapse('hide');
        $.post(init.XNG_WEBSITE_URL + 'tesoreria/ajax/form_edit.php', {idTesoreria: idTesoreria}, function(data) {
            $('.load_content').html(data);
            loadStylesCheckRadio();
            $('.add_form').text('Editar Tesoreria');
        })
    })


})