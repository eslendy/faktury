var _buscar = function() {
    if ($("#trBuscar").attr('class') == 'oculto') {
        $("#trBuscar").removeClass('oculto');
    } else {
        $("#trBuscar").addClass('oculto');
    }
    _filtrar("#descripcion_search", "#reporte", "DESCRIPCIÓN", _cargarPaginacion);
};


$('.nuevoReg').click(function() {
    $('.guardar-formulario').addClass('nuevo');
    $('.guardar-formulario').unbind('click');
    $('.modal-body').empty()
    $('.title_modal').text('Nuevo Perfil');
    $.post(init.XNG_WEBSITE_URL + "perfiles/ajax/form_add_perfil.php", function(data) {

        $('#loadContentAjaxForms').modal({show: true});
        console.log('add neuw')
        $('.modal-body').html(data)
        loadStylesCheckRadio();
        $("#frmPerfil").validationEngine();

    });
})




var _editarReg = function(idperfil) {
    $('.guardar-formulario').addClass('editar');
    $('.guardar-formulario').unbind('click');
    $('.modal-body').empty()
    $('.title_modal').text('Editar Perfil');
    $.post(init.XNG_WEBSITE_URL + "perfiles/ajax/form_edit_perfil.php", {idperfil: idperfil}, function(data) {

        $('#loadContentAjaxForms').modal({show: true});
        $('.modal-body').html(data)
        loadStylesCheckRadio();
        $("#frmPerfil").validationEngine();

    })
};
var _asigPermisos = function(idperfil) {
    $('.guardar-formulario').addClass('permisos');
    $('.guardar-formulario').unbind('click');
    $('.modal-body').empty()
    $('.title_modal').text('Asignar Permisos');
    $.post(init.XNG_WEBSITE_URL + "perfiles/ajax/form_perfil_permisos.php", {idperfil: idperfil}, function(data) {

        $('#loadContentAjaxForms').modal({show: true});
        $('.modal-body').html(data)
        loadStylesCheckRadio();
        $("#frmPerfil").validationEngine();

    })

    /*_ajax(init.XNG_WEBSITE_URL+"perfiles/ajax/form_perfil_permisos.php", "idperfil="+idperfil, function(html_response){
     botones = [{
     text : "Guardar",
     click : function(){ 
     _guardarPerfil('addPermisos');				
     }
     },{
     text : "Cancelar",
     click : function(){ $("#dialog-addPerfil").remove();}
     }];
     _dialogo("dialog-addPerfil", "50%", "Asignar Permisos al Perfil", botones, html_response)
     $("#frmPerfil").validationEngine();
     });*/
};

var _cargarPaginacion = function() {
    _paginacion("#pager", "lista", 15, 1);
    //alert('cargarPag');
};
var _verPermisos = function(e) {
    if ($(e).is(":checked")) {
        //alert('hola');
        $(".td_" + $(e).val()).show();
    } else {
        $(".td_" + $(e).val()).hide();
    }
}
var _guardarPerfil = function(tipo) {
    if ($("#frmPerfil").validationEngine('validate') == true) {
        _guardar(init.XNG_WEBSITE_URL + "perfiles/ajax/save.php?type=" + tipo, $("#frmPerfil").serialize(), function(html_response) {
            switch (html_response) {
                case '1':
                    alert("Perfil Guardado con Éxito!!");
                    $("#dialog-addPerfil").remove();
                    location.reload();
                    break;
                default:
                    _msgerror(html_response, "#mensaje");
                    break;
            }
        });
    }
};


$(function() {
    var headersArray = {0: {sorter: false}, 3: {sorter: false}, 4: {sorter: false}, 5: {sorter: false}};
    _dataGriD("#reporte", headersArray, "#pager", 1);
    //$("#pager").removeAttr('style');
    _cargarPaginacion();
});