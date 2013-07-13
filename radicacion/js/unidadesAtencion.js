var _nuevoReg = function(){
	_loadFormulariosAdd("undAtencion", 'addUndAtencion', "#frmUndAtencion", "Unidad de Atención");
};
var _buscar = function(){
	_verOcultarElemento("#trBuscar");
	_filtrar("#descripcion_search", "#reporte", "DESCRIPCION", _cargarPaginacion);
}
var _editarReg = function(id){
	_loadFormulariosEdit("undAtencion", 'editUndAtencion', "#frmUndAtencion", "Unidad de Atención", "idunidad_atencion="+id);	
};
var _cargarPaginacion = function(){
	_paginacion("#pager", "lista", 10,1);
	//alert('cargarPag');
};
var _anularReg = function(id) {
	_anularRegRad('nullUndAtencion', "idunidad_atencion="+id, "Unidad de Atención");	
}

$(function(){
     _loadBotones();
     var headersArray={0: {sorter: false},2: {sorter: false}, 3: {sorter: false},4: {sorter: false}};
     _dataGriD("#reporte",headersArray,"#pager",1);
     _cargarPaginacion();
});
