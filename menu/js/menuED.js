// JavaScript Document
var TreeFile="";
$(function(){
	TreeFrile = $('#tdTreeFile').html();
	$("#guardar").button().click(function(){
		if(validar()){		
			$.ajax({
				type:'POST',
				data: $("#frmmenu").serialize(),
				url:init.XNG_WEBSITE_URL+'menu/ajax/editMenu.php',
				success:function(msg){
							alert(msg);
							location.reload();
						}
			});
		}
	});
	$("#clean").button();
	$("#cleanFile").button().click(function(){
		$("#nameFile").html("");
		$('#enlace').val("");	
		$("#cleanFile").hide()
	});
});
function validar(){
	if($("#nombre").val()==""){
		$('#mensaje').html('<div class="ui-widget"><div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Alerta:</strong>El nombre del menú esta vacio!</p></div></div>')
		$('#mensaje').show('fold',{ to: { percent: 100  } });
		$("#nombre").focus();
		return false;
	}
	return true;
}
function openF(i){
	$('#'+i+' > ul').removeClass( "directorioClose" );
	$('#'+i).addClass("directorioOpen");
	$('#'+i+' >a').removeAttr("onclick");
	$('#'+i+' >a').attr("onclick" ,"closeF('"+i+"')");
}
function closeF(i){
	$('#'+i+' > ul').addClass("directorioClose");
	$('#'+i).removeClass( "directorioOpen" );
	$('#'+i+' >a').removeAttr("onclick");
	$('#'+i+' >a').attr("onclick" ,"openF('"+i+"')");
}

function selectF(f,e){
	$("#cleanFile").show();
	$("#nameFile").html(f);
	$('#enlace').val(f);
}