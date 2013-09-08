var _nuevoReg = function(){
	_loadFormulariosAdd("grados", 'addgrados', "#frmGrados", "Grado");
};
var _buscar = function(){
	_verOcultarElemento("#trBuscar");
	_filtrar("#descripcion_search", "#reporte", "DESCRIPCION", _cargarPaginacion);
	_filtrar("#abreviatura_search", "#reporte", "ABREVIATURA", _cargarPaginacion);
}
var _editarReg = function(id){
	_loadFormulariosEdit("grados", 'editgrados', "#frmGrados", "Grado", "idgrado="+id);	
};
var _cargarPaginacion = function(){
	_paginacion("#pager", "lista", 10,1);
	//alert('cargarPag');
};
var _anularReg = function(id) {
	_anularRegRad('nullGrado', "idgrado="+id, "Grado");	
}

$(function(){
     _loadBotones();
     var headersArray={0: {sorter: false},3: {sorter: false}, 4: {sorter: false},5: {sorter: false}};
     _dataGriD("#reporte",headersArray,"#pager",1);
     _cargarPaginacion();
});


$(function() {
    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue',
        increaseArea: '-10' // optionaliradio_flat-red
    });
    $('.iradio_flat-blue, .busqueda-radio label').click(function(){
        $('.search-box').attr('placeholder', $('.iradio_flat-blue.checked .search-radio').attr('data-related'));
    })
    
    $('.search-btn').click(function(){
        var page = 1;
         window.location = '#pagina-1';
        $.post(init.XNG_WEBSITE_URL+'radicacion/ajax/busqueda.php', {page:page,case: $(this).attr('data-case'), type: $('.iradio_flat-blue.checked .search-radio').val(), term:$('.search-box').val()}, function(data){
           // console.log(data)
            
            $('.loadContentFromSearch').html(data);
        });
    })
});
