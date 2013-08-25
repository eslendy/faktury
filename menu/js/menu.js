// JavaScript Document
var TreeFile="";
var id='1_0';
var valores='';

/*var cargar_contenido = function(e){
	switch(e.value){
		case 5 : 
			_agregar(e.id);
		break;
		case 6 : 
			_editar(e.id,0);
		break;
		case 8 :
			_ordenar(e.id, 0,0);
		break;
	}
}*/

var _agregar = function (url_contenido){
	_ajax(url_contenido, '', function(html_response){
		_llenarEtiqueta("#datosBasicos",html_response);
		_cargarFuncionesMenu();
		
	})
}
var _cargarFuncionesMenu = function(){
	_botones("#guardar",'',function(){
		guardar_menu();
	});
	_botones("#cleanFile",'',function(){
		$("#nameFile").html("");
		$('#enlace').val("");	
		$("#cleanFile").hide()
	});
	$("#clean").button();
	TreeFrile = $('#tdTreeFile').html();
}

var _editar = function(url_contenido, idmenu){
	_ajax(url_contenido+'?id='+idmenu, '', function(html_response){
		_llenarEtiqueta("#datosBasicos",html_response);
		_botones("#guardar",'',function(){
			editar_menu();
		});
		_botones("#cleanFile",'',function(){
			$("#nameFile").html("");
			$('#enlace').val("");	
			$("#cleanFile").hide()
		});
		TreeFrile = $('#tdTreeFile').html();
	})
}

var _ordenar = function(url_contenido, idmenu, idpadre){
	_ajax(url_contenido+'?id='+idmenu+'&pa='+idpadre, '', function(html_response){
		_llenarEtiqueta("#datosBasicos",html_response);
		_botones("#guardar",'',function(){
			guardar_orden();
		});
		$( "#sortable2" ).sortable({
			change: function(event,ui){
				id=$(".ui-sortable-helper").attr('id');
			},
			stop: function() {
				//var index = $("#sortable2 li" ).index( $("#"+id));
				//$("#"+id).val(index);
				valores="";
				$( ".ui-selectee", this ).each(function() {
					if(this.id!=""){
						var index = $( "#sortable2 li" ).index( $('#'+this.id) );
						valores+= this.id+"="+(index+1)+"&";
						$('#'+this.id).val(index+1);
					}
				});
				valores=valores.substr(0,valores.length-1);
			}
		}).selectable();
		$( "#sortable2" ).disableSelection();
	})
}


var guardar_menu = function(){
 	if(validar()){		
		_ajax(init.XNG_WEBSITE_URL+'menu/ajax/saveMenu.php?type=addmenu', $("#frm_add_menu").serialize(), function(html_response){
			if(html_response==1){
				_msgexito("Menú Guardado!!",'#mensaje');
			}else{
				_msgerror(html_response,'#mensaje');
			}
			
			//location.reload();
		})
	}
};
var editar_menu = function(){
 	if(validar()){	
 		//alert($("#frm_edit_menu").serialize());	
		_ajax(init.XNG_WEBSITE_URL+'menu/ajax/saveMenu.php?type=editmenu', $("#frm_edit_menu").serialize(), function(html_response){
			if(html_response==1){
				_msgexito("Menú Actualizado!!",'#mensaje');
			}else{
				_msgerror(html_response,'#mensaje');
			}
		})
	}
};

var guardar_orden = function(){
 	if(validar()){	
		_ajax(init.XNG_WEBSITE_URL+'menu/ajax/saveMenu.php?type=orden', valores, function(html_response){
			if(html_response==1){
				_msgexito("Menú Ordenado!!",'#mensaje');
			}else{
				_msgerror(html_response,'#mensaje');
			}
		})
	}
};

var validar = function(){
	if($("#descripcion").val()==""){
		_msgerror('El nombre del Menú esta vacio','#mensaje');
		$("#descripcion").focus();
		return false;
	}
	if($("#visible").val()=="-1"){
		_msgerror('Debe seleccionar si el menú es visible en la barra de menú principal','#mensaje');
		$("#visible").focus();
		return false;
	}
	/*if($("#modulos").val()=="-1"){
		_msgerror('Debe seleccionar al menos un modulo para este menú','#mensaje');
		$("#modulos").focus();
		return false;
	}*/
	return true;
};

var openF = function(i){
	$('#'+i+' > ul').removeClass( "directorioClose" );
	$('#'+i).addClass("directorioOpen");
	$('#'+i+' >a').removeAttr("onclick");
	$('#'+i+' >a').attr("onclick" ,"closeF('"+i+"')");
};

var closeF = function(i){
	$('#'+i+' > ul').addClass("directorioClose");
	$('#'+i).removeClass( "directorioOpen" );
	$('#'+i+' >a').removeAttr("onclick");
	$('#'+i+' >a').attr("onclick" ,"openF('"+i+"')");
};

var selectF = function(f,e){
	$("#cleanFile").show();
	$("#nameFile").html(f);
	$('#enlace').val(f);
};

$(function(){
	_agregar(init.XNG_WEBSITE_URL+'menu/ajax/form_add_menu.php');
        $('.block-icon.pull-right').hide();
});