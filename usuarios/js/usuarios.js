var _buscar = function(){
	if($("#trBuscar").attr('class')=='oculto'){
		$("#trBuscar").removeClass('oculto');
	}else{
		$("#trBuscar").addClass('oculto');
	}
	_filtrar("#nombre_search", "#reporte", "NOMBRES", _cargarPaginacion);
	_filtrar("#apellido_search", "#reporte", "APELLIDOS", _cargarPaginacion);
};
var _nuevoReg = function(){
	_ajax("usuarios/ajax/form_add_usuario.php", "", function(html_response){
		botones = [{
			text : "Guardar",
			click : function(){ 
				_guardarUsuario('addUsuario');				
			}
		},{
			text : "Cancelar",
			click : function(){ $("#dialog_addUser").remove();}
		}];
		_dialogo("dialog_addUser", "50%", "Nuevo Usuario", botones, html_response)
		$("#frmUsuario").validationEngine();
	});
};
var _addPerfil =function(idusuario){
	_ajax("usuarios/ajax/form_add_perfil.php", "idusuarios="+idusuario, function(html_response){
		botones = [{
			text : "Guardar",
			click : function(){ 
				_guardarUsuario('addPerfil');				
			}
		},{
			text : "Cancelar",
			click : function(){ $("#dialog_addUser").remove();}
		}];
		_dialogo("dialog_addUser", "50%", "Asignar Perfil a Usuario", botones, html_response)
		$("#frmUsuario").validationEngine();
	});
};

var _editarReg = function(idusuario){
	_ajax("usuarios/ajax/form_edit_usuario.php", "idusuarios="+idusuario, function(html_response){
		botones = [{
			text : "Guardar",
			click : function(){ 
				_guardarUsuario('editUsuario');				
			}
		},{
			text : "Cancelar",
			click : function(){ $("#dialog_addUser").remove();}
		}];
		_dialogo("dialog_addUser", "50%", "Nuevo Usuario", botones, html_response)
		$("#frmUsuario").validationEngine();
	});
};

var _cargarPaginacion = function(){
	_paginacion("#pager", "lista", 10,1);
	//alert('cargarPag');
};

var _guardarUsuario = function(tipo){
	if($("#frmUsuario").validationEngine('validate') ==true){				
		_guardar("usuarios/ajax/save.php?type="+tipo, $("#frmUsuario").serialize(), function(html_response){
			switch(html_response){
				case '1':
					alert("Usuario Guardado con Éxito!!");
					$("#dialog_addUser").remove();
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
     var headersArray={0: {sorter: false},3: {sorter: false}, 4: {sorter: false},5: {sorter: false},6: {sorter: false}};
     _dataGriD("#reporte",headersArray,"#pager",1);
     //$("#pager").removeAttr('style');
     _cargarPaginacion();
});