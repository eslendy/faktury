var _nuevoReg = function() {
    _loadFormulariosAdd("factura", 'addfactura', "#frmRadicacion", "Factura");
    setTimeout('nuevo_reg_load()', 2000);
}
var _buscar = function() {
    _verOcultarElemento("#trBuscar");
    _filtrar("#no_rad_search", "#reporte", "RAD", _cargarPaginacion);
    _filtrar("#fecha_rad_search", "#reporte", "FECHA RAD.", _cargarPaginacion);
    _filtrar("#factura_search", "#reporte", "NO. FACTURA", _cargarPaginacion);
    _filtrar("#proveedor_search", "#reporte", "PROVEEDOR", _cargarPaginacion);
    _filtrar("#paciente_search", "#reporte", "PACIENTE", _cargarPaginacion);
}
var _editarReg = function(id) {
    _loadFormulariosEdit("factura", 'editfactura', "#frmRadicacion", "Factura", "idFactura=" + id);
    setTimeout('nuevo_reg_load()', 2000);
};
var _anularReg = function(id) {
    _anularRegRad('nullfactura', "idFactura=" + id, "Factura");
}
var nuevo_reg_load = function() {
    _fechaFields();
    _autocompletar("#autoc-idunidad_atencion", init.XNG_WEBSITE_URL + "radicacion/ajax/busqueda.php?case=auto_und_atencion&where=", function(ui) {
        $("#idunidad_atencion").val(ui.item.id);
    }, '')
    _autocompletar("#autoc-idcentralizada", init.XNG_WEBSITE_URL + "radicacion/ajax/busqueda.php?case=auto_und_atencion&where= AND centralizada=0", function(ui) {
        $("#idcentralizada").val(ui.item.id);
    }, '')
    _autocompletar("#autoc-idcentralizadora", init.XNG_WEBSITE_URL + "radicacion/ajax/busqueda.php?case=auto_und_atencion&where= AND centralizada=1", function(ui) {
        $("#idcentralizadora").val(ui.item.id);
    }, '')

    _autocompletar("#autoc-idpaciente", init.XNG_WEBSITE_URL + "radicacion/ajax/busqueda.php?case=auto_paciente", function(ui) {
        $("#idpaciente").val(ui.item.id);
    }, '')
    _autocompletar("#autoc-idunidad", init.XNG_WEBSITE_URL + "radicacion/ajax/busqueda.php?case=auto_und", function(ui) {
        $("#idunidad").val(ui.item.id);
    }, '')
    _autocompletar("#autoc-idgrado", init.XNG_WEBSITE_URL + "radicacion/ajax/busqueda.php?case=auto_grado", function(ui) {
        $("#idgrado").val(ui.item.id);
    }, '')
    _autocompletar("#autoc-idproveedor", init.XNG_WEBSITE_URL + "radicacion/ajax/busqueda.php?case=auto_proveedor", function(ui) {
        $("#idproveedor").val(ui.item.id);
        _ajax(init.XNG_WEBSITE_URL + "radicacion/ajax/busqueda.php?case=select_contrato", "idproveedor=" + ui.item.id, function(html_response) {
            _llenarEtiqueta("#td_contrato", html_response);
        });
    }, '')
}
var _cargarPaginacion = function() {
    _paginacion("#pager", "lista", 10, 1);
    //alert('cargarPag');
};
$(function() {
    _loadBotones();
});

$(function() {
    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue',
        increaseArea: '-10' // optionaliradio_flat-red
    });
    $('.iradio_flat-blue, .busqueda-radio label').click(function(){
        $('.search-box').attr('placeholder', $('.iradio_flat-blue.checked .search-radio').attr('data-related'));
    })
    
    $('.search-btn').click(function(){
        var page = 1;
         window.location = '#pagina-1';
        $.post(init.XNG_WEBSITE_URL+'radicacion/ajax/busqueda.php', {page:page, case: $(this).attr('data-case'), type: $('.iradio_flat-blue.checked .search-radio').val(), term:$('.search-box').val()}, function(data){
            $('.loadContentFromSearch').html(data);
        });
    })
});
