
var _buscar = function(){
	_verOcultarElemento("#trBuscar");
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
