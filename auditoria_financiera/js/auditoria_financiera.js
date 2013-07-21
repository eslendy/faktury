var _guardarMods = function(tipo, frm, mod){
	if($(frm).validationEngine('validate') ==true){				
		_guardar(init.XNG_WEBSITE_URL+"auditoria_financiera/ajax/save.php?type="+tipo, $(frm).serialize(), function(html_response){
			switch(html_response){
				case '1':
					alert(mod+" Guardado con Éxito!!");
					$("#dialog-addMod").remove();
					_loadContenido($('#nombre_archivo').val());
				break;
				default:
					_msgerror(html_response,"#mensaje");
				break;
			}
		});
	}
};



var _loadFormulariosEdit = function(caso, tipo, frm, mod, datosPost){
	_ajax(init.XNG_WEBSITE_URL+"auditoria_financiera/ajax/form_edit.php?case="+caso, datosPost, function(html_response){
		botones = [{
			text : "Guardar",
			click : function(){ 
				_guardarRadicacionMods(tipo, frm, mod);				
			}
		},{
			text : "Cancelar",
			click : function(){ $("#dialog-addModRad").remove();}
		}];
		_dialogo("dialog-addMod", "50%", "Editar "+mod, botones, html_response)
		$(frm).validationEngine();
	});
};
var _anularReg =function(tipo,datosPost, mod){
	if(confirm('¿Esta seguro de desactivar este registro?')){
 		_guardar(init.XNG_WEBSITE_URL+"auditoria_financiera/ajax/save.php?type="+tipo, datosPost, function(html_response){
			switch(html_response){
				case '1':
					alert(mod+" Desactivada con Éxito!!");
					//$("#dialog-addMod").remove();
					_loadContenido($('#nombre_archivo').val());
				break;
				default:
					_msgerror(html_response,"#mensaje");
				break;
			}
		});
 	}
};
var _addAuditoria = function(idFactura){
	_loadContenido(init.XNG_WEBSITE_URL+'auditoria_financiera/ajax/form_add.php?idfactura='+idFactura);
}
var _editAuditoria = function(idauditoria, idFactura){
	_loadContenido(init.XNG_WEBSITE_URL+'auditoria_financiera/ajax/form_edit.php?idauditoria='+idauditoria+'&idfactura='+idFactura);
}
var _verAuditorias = function( idFactura){
	_loadContenido(init.XNG_WEBSITE_URL+'auditoria_financiera/index_auditoria.php?idfactura='+idFactura);
}
var _anularAuditoria = function (id){
	_anularReg("nullAuditoria","id="+id, "Auditoría");
}
$(function(){
     _loadContenido(init.XNG_WEBSITE_URL+'auditoria_financiera/index_factura.php');
});
