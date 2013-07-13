var _nuevoReg = function(){
	_loadFormulariosAdd("proveedor", 'addproveedor', "#frmProveedor", "Proveedor");
	setTimeout("_cargartipodoc()",2000);
};
var _buscar = function(){
	_verOcultarElemento("#trBuscar");
	_filtrar("#doc_proveedor_search", "#reporte", "DOCUMENTO", _cargarPaginacion);
	_filtrar("#nombre_proveedor_search", "#reporte", "NOMBRE", _cargarPaginacion);
}
var _editarReg = function(id){
	_loadFormulariosEdit("proveedor", 'editproveedor', "#frmProveedor", "Proveedor", "idproveedor="+id);
	setTimeout("_cargartipodoc()",2000);
};
var _cargarPaginacion = function(){
	_paginacion("#pager", "lista", 10,1);
	//alert('cargarPag');
};
var _anularReg = function(id) {
	_anularRegRad('nullProveedor', "idproveedor="+id, "Proveedor");	
}
var _cargartipodoc = function(){
	$("#idtipo_doc").change(function(){
		//alert($(this).val());
		if($(this).val()=='2'){
			$("#dv").show();
			
		}else{
			$("#dv").val("0");
			$("#dv").hide();
		}
	});
}

$(function(){
     _loadBotones();
     var headersArray={0: {sorter: false},3: {sorter: false}, 4: {sorter: false},5: {sorter: false}};
     _dataGriD("#reporte",headersArray,"#pager",1);
     _cargarPaginacion();
});
