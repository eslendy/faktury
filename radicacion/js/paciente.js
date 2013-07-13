var _nuevoReg = function(){
	_loadFormulariosAdd("paciente", 'addpaciente', "#frmPaciente", "Paciente");
};
var _buscar = function(){
	_verOcultarElemento("#trBuscar");
	_filtrar("#doc_paciente_search", "#reporte", "DOCUMENTO", _cargarPaginacion);
	_filtrar("#nombre_paciente_search", "#reporte", "NOMBRE", _cargarPaginacion);
	_filtrar("#apellido_paciente_search", "#reporte", "APELLIDO", _cargarPaginacion);
}
var _editarReg = function(id){
	_loadFormulariosEdit("paciente", 'editpaciente', "#frmPaciente", "Paciente", "idpaciente="+id);	
};
var _cargarPaginacion = function(){
	_paginacion("#pager", "lista", 10,1);
	//alert('cargarPag');
};
var _anularReg = function(id) {
	_anularRegRad('nullPaciente', "idpaciente="+id, "Paciente");	
}

$(function(){
     _loadBotones();
     var headersArray={0: {sorter: false},5: {sorter: false}, 6: {sorter: false},7: {sorter: false}};
     _dataGriD("#reporte",headersArray,"#pager",1);
     _cargarPaginacion();
});
