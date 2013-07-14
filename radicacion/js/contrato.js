var _nuevoReg = function(){
	_loadFormulariosAdd("contrato", 'addcontrato', "#frmcontrato", "Contrato");
	setTimeout('nuevo_reg_load()',2000);
};
var _buscar = function(){
	_verOcultarElemento("#trBuscar");
	_filtrar("#numero_contrato_search", "#reporte", "# CONTRATO", _cargarPaginacion);
	_filtrar("#fecha_contrato_search", "#reporte", "FECHA CONTRATO", _cargarPaginacion);
	_filtrar("#valor_contrato_search", "#reporte", "VALOR", _cargarPaginacion);
	_filtrar("#proveedor_search", "#reporte", "PROVEEDOR", _cargarPaginacion);
	_fechaFields();
}
var _editarReg = function(id){
	_loadFormulariosEdit("contrato", 'editcontrato', "#frmcontrato", "Contrato", "idcontrato="+id);	
};
var _cargarPaginacion = function(){
	_paginacion("#pager", "lista", 10,1);
	//alert('cargarPag');
};
var _anularReg = function(id) {
	_anularRegRad('nullcontrato', "idcontrato="+id, "Contrato");	
}
var nuevo_reg_load = function(){
	_fechaFields();
	_autocompletar("#autoc-idproveedor", init.XNG_WEBSITE_URL+"radicacion/ajax/busqueda.php?case=auto_proveedor", function(ui){
		$("#idproveedor").val(ui.item.id);
	}, '')
}
$(function(){
     _loadBotones();
     var headersArray={4: {sorter: false},5: {sorter: false}, 6: {sorter: false},7: {sorter: false}};
     _dataGriD("#reporte",headersArray,"#pager",1);
     _cargarPaginacion();
});
