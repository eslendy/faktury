var _buscar = function(){
	_verOcultarElemento("#trBuscar");
	_filtrar("#no_rad_search", "#reporte", "RAD", _cargarPaginacion);
	_filtrar("#fecha_rad_search", "#reporte", "FECHA RAD.", _cargarPaginacion);
	_filtrar("#factura_search", "#reporte", "NO. FACTURA", _cargarPaginacion);
	_filtrar("#proveedor_search", "#reporte", "PROVEEDOR", _cargarPaginacion);
	_filtrar("#paciente_search", "#reporte", "PACIENTE", _cargarPaginacion);
}

var _cargarPaginacion = function(){
	_paginacion("#pager", "lista", 10,1);
	//alert('cargarPag');
};
$(function(){
     _loadBotones();
     
});

 $(function() {
        $(".fecha").datepicker({
            showOn: "button",
            buttonImage: "/imagenes/calendar.gif",
            buttonImageOnly: true,
            dateFormat: "yy-mm-dd"
        });
    });

 $('.addAuditoriaMedica').click(function() {

            var action = $(this).attr('data-action');
            var record = $(this).attr('data-record');


            $('.add').fadeIn();
            $('#content_').collapse('hide');
            $.post(init.XNG_WEBSITE_URL + 'auditoria_medica/ajax/form_add.php', {case: action, id: record}, function(data) {
                $('.load_content').html(data);
                loadStylesCheckRadio();
                $('.add_form').text('Nueva Auditoria Medica');
            })
        })
        
        $('.verAuditoriaMedica').click(function() {

            
            var record = $(this).attr('data-record');
            
            $('.add').fadeIn();
            $('#content_').collapse('hide');

            $.post(init.XNG_WEBSITE_URL + 'auditoria_medica/ajax/form_edit.php', {id: record}, function(data) {
                $('.load_content').html(data);
                loadStylesCheckRadio();
                $('.add_form').text('Editar Auditoria');
            })
        })