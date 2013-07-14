// JavaScript Document
	var id='1_0';
	var valores='';
	$(function() {
		$( "#sortable2" ).sortable({
			change: function(event,ui){
				id=$(".ui-sortable-helper").attr('id');
			},
			stop: function() {
				//var index = $("#sortable2 li" ).index( $("#"+id));
				//$("#"+id).val(index);
				valores="";
				alert(valores);
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
		//$( "#sortable" ).disableSelection();
		//$( "#sortable2" ).sortable();
		$( "#sortable2" ).disableSelection();
		alert(valores);
		$('#guardar').click(function(){
			$.ajax({
				type:'POST',
				data: valores,
				url:init.XNG_WEBSITE_URL+'menu/ajax/saveOrdenMenu.php',
				success:function(msg){
					alert(msg);
					location.reload();
				}
			});
		});
	});