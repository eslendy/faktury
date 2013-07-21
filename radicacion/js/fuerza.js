var _nuevoReg = function(){
	_loadFormulariosAdd("fuerza", 'addfuerza', "#frmFuerza", "Fuerza");
};
var _buscar = function(){
	_verOcultarElemento("#trBuscar");
	_filtrar("#descripcion_search", "#reporte", "DESCRIPCION", _cargarPaginacion);
	_filtrar("#abreviatura_search", "#reporte", "ABREVIATURA", _cargarPaginacion);
}
var _editarReg = function(id){
	_loadFormulariosEdit("fuerza", 'editfuerza', "#frmFuerza", "Fuerza", "idfuerza="+id);	
};
var _cargarPaginacion = function(){
	_paginacion("#pager", "lista", 10,1);
	//alert('cargarPag');
};
var _anularReg = function(id) {
	_anularRegRad('nullFuerza', "idfuerza="+id, "Fuerza");	
}

$(function(){
     _loadBotones();
     var headersArray={0: {sorter: false},3: {sorter: false}, 4: {sorter: false},5: {sorter: false}};
     _dataGriD("#reporte",headersArray,"#pager",1);
     _cargarPaginacion();
});
