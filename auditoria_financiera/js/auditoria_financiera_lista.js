var _buscar = function(){
	_verOcultarElemento("#trBuscar");
	_filtrar("#fecha_rad_search", "#reporte", "FECHA AUDITORÍA.", _cargarPaginacion);
	_filtrar("#factura_search", "#reporte", "NO. FACTURA", _cargarPaginacion);
}
var _cargarPaginacion = function(){
	_paginacion("#pager", "lista", 10,1);
	//alert('cargarPag');
};

$(function(){
     _loadBotones();
});
