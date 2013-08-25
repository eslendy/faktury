var _buscar = function() {
    if ($("#trBuscar").attr('class') == 'oculto') {
        $("#trBuscar").removeClass('oculto');
    } else {
        $("#trBuscar").addClass('oculto');
    }
    _filtrar("#descripcion_search", "#reporte", "DESCRIPCIÓN", _cargarPaginacion);
};

$('.nuevo-modulo').click(function(){
    
            $('.add').fadeIn();
            $('#content_').collapse('hide');
            $.post(init.XNG_WEBSITE_URL + 'modulos/ajax/form_add_modulo.php', function(data) {
                $('.load_content').html(data);
                loadStylesCheckRadio();
                $('.add_form').text('Nueva Auditoria');
            })
        
})

var _editarReg = function(idmodulo) {

    $('.guardar-formulario').addClass('editar-modulo');
    $('.guardar-formulario').unbind('click');
    $('.modal-body').empty()
    $('.title_modal').text('Editar Perfil');
    $.post(init.XNG_WEBSITE_URL + "modulos/ajax/form_edit_modulo.php", {idmodulo: idmodulo}, function(data) {

        $('#loadContentAjaxForms').modal({show: true});
        $('.modal-body').html(data)
        loadStylesCheckRadio();
        $("#frmModulo").validationEngine();
    })
};

var _cargarPaginacion = function() {
    _paginacion("#pager", "lista", 15, 1);
    //alert('cargarPag');
};



$(function() {
    var headersArray = {0: {sorter: false}, 2: {sorter: false}, 3: {sorter: false}};
    _dataGriD("#reporte", headersArray, "#pager", 1);
    //$("#pager").removeAttr('style');
    _cargarPaginacion();
});