var _guardarRadicacionMods = function(tipo, frm, mod){
	if($(frm).validationEngine('validate') ==true){				
		_guardar(init.XNG_WEBSITE_URL+"radicacion/ajax/save.php?type="+tipo, $(frm).serialize(), function(html_response){
			switch(html_response){
				case '1':
					alert(mod+" Guardado con Éxito!!");
					$("#dialog-addModRad").remove();
					_loadContenido($('#nombre_archivo').val());
				break;
				default:
					_msgerror(html_response,"#mensaje");
				break;
			}
		});
	}
};

var _loadFormulariosAdd = function(caso, tipo, frm, mod){
	_ajax(init.XNG_WEBSITE_URL+"radicacion/ajax/form_add_radicacion.php?case="+caso, "", function(html_response){
		botones = [{
			text : "Guardar",
			click : function(){ 
				_guardarRadicacionMods(tipo, frm, mod);				
			}
		},{
			text : "Cancelar",
			click : function(){ $("#dialog-addModRad").remove();}
		}];
		_dialogo("dialog-addModRad", "50%", "Agregar "+mod, botones, html_response)
		$(frm).validationEngine();
	});
};

var _loadFormulariosEdit = function(caso, tipo, frm, mod, datosPost){
	_ajax(init.XNG_WEBSITE_URL+"radicacion/ajax/form_edit_radicacion.php?case="+caso, datosPost, function(html_response){
		botones = [{
			text : "Guardar",
			click : function(){ 
				_guardarRadicacionMods(tipo, frm, mod);				
			}
		},{
			text : "Cancelar",
			click : function(){ $("#dialog-addModRad").remove();}
		}];
		_dialogo("dialog-addModRad", "50%", "Editar "+mod, botones, html_response)
		$(frm).validationEngine();
	});
};
 var _anularRegRad =function(tipo,datosPost, mod){
 	if(confirm('¿Esta seguro de desactivar este registro?')){
 		_guardar(init.XNG_WEBSITE_URL+"radicacion/ajax/save.php?type="+tipo, datosPost, function(html_response){
			switch(html_response){
				case '1':
					alert(mod+" Desactivado con Éxito!!");
					$("#dialog-addModRad").remove();
					_loadContenido($('#nombre_archivo').val());
				break;
				default:
					_msgerror(html_response,"#mensaje");
				break;
			}
		});
 	}
 };

$(function(){
     _loadContenido(init.XNG_WEBSITE_URL+'radicacion/index_factura.php');
});
