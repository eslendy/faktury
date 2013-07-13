// JavaScript Document
$(function(){
	_botones("#btnacceso",function(){
		_ajax("validar.php","ps="+$("#pass").val()+"&lg="+$("#login").val(),function(html_response){
			if(html_response==1){
				location.href="../index.php";
			}else{
				_llenarEtiqueta("#mensaje",html_response);
				_addClass("#mensaje","ui-widget");
			}
		});	
	});
});