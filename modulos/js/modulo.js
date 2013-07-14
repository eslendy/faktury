var _buscar = function(){
	if($("#trBuscar").attr('class')=='oculto'){
		$("#trBuscar").removeClass('oculto');
	}else{
		$("#trBuscar").addClass('oculto');
	}
	_filtrar("#descripcion_search", "#reporte", "DESCRIPCIÓN", _cargarPaginacion);
};
var _nuevoReg = function(){
	_ajax(init.XNG_WEBSITE_URL+"modulos/ajax/form_add_modulo.php", "", function(html_response){
		botones = [{
			text : "Guardar",
			click : function(){ 
				_guardarPerfil('addModulo');				
			}
		},{
			text : "Cancelar",
			click : function(){ $("#dialog-addModulo").remove();}
		}];
		_dialogo("dialog-addModulo", "50%", "Nuevo Modulo", botones, html_response)
		$("#frmModulo").validationEngine();
	});
};

var _editarReg = function(idmodulo){
	_ajax(init.XNG_WEBSITE_URL+"modulos/ajax/form_edit_modulo.php", "idmodulo="+idmodulo, function(html_response){
		botones = [{
			text : "Guardar",
			click : function(){ 
				_guardarPerfil('editModulo');				
			}
		},{
			text : "Cancelar",
			click : function(){ $("#dialog-addModulo").remove();}
		}];
		_dialogo("dialog-addModulo", "50%", "Nuevo Modulo", botones, html_response)
		$("#frmModulo").validationEngine();
	});
};

var _cargarPaginacion = function(){
	_paginacion("#pager", "lista", 15,1);
	//alert('cargarPag');
};

var _guardarPerfil = function(tipo){
	if($("#frmModulo").validationEngine('validate') ==true){				
		_guardar(init.XNG_WEBSITE_URL+"modulos/ajax/save.php?type="+tipo, $("#frmModulo").serialize(), function(html_response){
			switch(html_response){
				case '1':
					alert("Modulo Guardado con Éxito!!");
					$("#dialog-addModulo").remove();
					location.reload();
				break;
				default:
					_msgerror(html_response,"#mensaje");
				break;
			}
		});
	}
};


$(function(){
     var headersArray={0: {sorter: false},2: {sorter: false}, 3: {sorter: false}};
     _dataGriD("#reporte",headersArray,"#pager",1);
     //$("#pager").removeAttr('style');
     _cargarPaginacion();
});