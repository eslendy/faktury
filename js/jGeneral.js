// JavaScript Document
$(function() {
    _loadBotones();
    $(".autoc_txt").click(function() {
        alert(this.id)
        this.select();
    });
})

var _loadBotones = function() {
    $('.busqueda').click(function() {
        _buscar();
    })

    //$('.nuevoReg').click(function(){
    //  _nuevoReg()
    // })
}
var _autocompletar = function(id, file, funcion, lista) {
    $(id).click(function() {
        $(id).select();
    });
    if (lista == '') {
        $(id).autocomplete({
            source: file,
            minLength: 2,
            select: function(event, ui) {
                funcion(ui);
            }
        });
    }
    if (lista != '') {
        $(id).autocomplete({
            source: file,
            minLength: 2,
            select: function(event, ui) {
                funcion(ui);
            }
        }).data("ui-autocomplete")._renderItem = lista;
    }
};
var _fechaFields = function() {
    /*$('input[type="date"]').datepicker({
     'dateFormat':"yy-mm-dd"
     });*/
    /*$(".fecha").datepicker({
     'dateFormat':"yy-mm-dd"
     });*/
};

var _botonesIcons = function(id, primaryIcon, secundaryIcon, funcion) {
    $(id).addClass('btn-large').click(function() {
        funcion()
    });
};
var _botones = function(id, class_, funcion) {
    $(id).addClass('btn-large ' + class_).click(function() {
        funcion()
    });
};
var _dialogo = function(id, ancho, titulo, botones, html_content) {
    $("#" + id).remove();
    $("body").append('<div id="' + id + '"></div>');
    /*$("#"+id).dialog({
     autoOpen : true,
     width : ancho,
     buttons : botones,
     modal : true,
     title : titulo,
     position : "center top+50",
     closeText : "Cerrar",
     closeOnEscape : false
     });*/
    _llenarEtiqueta("#" + id, html_content);

}
var _ajax = function(dir, datos, funcion) {
    $.ajax({
        type: 'POST',
        url: dir,
        data: datos,
        success: function(msg, textStatus, jqXHR) {
            switch (msg) {
                case 'logout':
                    location.reload();
                    break;
                default:
                    funcion(msg);
            }
        }
    });
};

var _llenarEtiqueta = function(id, html_content) {
    $(id).html(html_content);
};

var _addClass = function(id, clase) {
    $(id).addClass(clase);
};

var _msgerror = function(msg, id) {
    var html_content = '<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">' +
            '<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>' +
            '<strong>Alert:</strong> ' + msg + '</p>' +
            '</div>';
    _llenarEtiqueta(id, html_content);
    $(id).show('fold', {to: {percent: 100}});
}
var _msgexito = function(msg, id) {
    var html_content = '<div class="ui-widget">' +
            '<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">' +
            '<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>' +
            '<strong>Éxito!</strong> ' + msg + ' </p>' +
            '</div></div>';
    _llenarEtiqueta(id, html_content);
    $(id).show('fold', {to: {percent: 100}});
}


var _dataGriD = function(id, headersArray, idpager, numFilas) {
    /*$(id).tablesorter({
     widthFixed: true,
     widgets: ['zebra'],
     headers: headersArray
     });*/
    //.tablesorterPager({container: $(idpager),size : numFilas});

    //$(id).datagrid({loadFilter:pagerFilter}).datagrid('loadData', data);
}
var _guardar = function(url, datos, funcion) {
    _ajax(url, datos, function(html_response) {
        funcion(html_response);
    })
};
var _filtrar = function(inputid, tableid, columna, ishiden) {
    $(inputid).keyup(function() {
        $.uiTableFilter($(tableid), this.value, columna, ishiden);
    })
};

var _paginacion = function(ContPaginas, idtbody, numFilas, pagina) {
    /*$(ContPaginas).jPages({
     containerID: idtbody,
     previous: "←",
     next: "→",
     perPage: numFilas,
     delay: 0,
     startPage: pagina
     });*/

}



var timeFormat = {
    "regex": /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/,
    "alertText": " errormessage in the locale chosen"}


var _validarOnlyNumberSpecialChars = function(field, rules, i, options) {
    var regEx = new RegExp("^[0-9!@#$%^&*()_+\-=\[\]{};':]+$");
    //regEx= /^[a-zA-Z\ \á]+$/;
    //var regEx = new RegExp("([\\W\\S]){1,}");
    if (!field.val().match(regEx)) {
        return options.allrules.validate2fields.alertText;
    }
    ;

}
var _validarOnlyText = function(field, rules, i, options) {
    var regEx = new RegExp("^[a-zA-Z\ \s\á\é\í\ó\ú\Á\É\Í\Ó\Ú\Ñ\ñ]+$");
    //regEx= /^[a-zA-Z\ \á]+$/;
    //var regEx = new RegExp("([\\W\\S]){1,}");
    if (!field.val().match(regEx)) {
        return options.allrules.validate2fields.alertText;
    }
    ;
}
var _validarHiddenAutoC = function(field, rules, i, options) {
    var id = field.attr("id").split('-');
    //alert(id[1]);
    if ($("#" + id[1]).val() == "") {
        return options.allrules.validarHiddenAutoC.alertText;
    }
    ;
}
var _validarGlosas = function(field, rules, i, options) {
    //alert(field)
    $.each(field, function(a, b) {
        //alert(a+' >>>>   '+b)
    }
    );

    var id = field.attr("id").split('-');
    if ($("#" + id[1]).is(":checked") == true) {
        switch (field.prop('tagName')) {
            case 'TEXTAREA':
                if (field.val() == "") {
                    //alert("aqui");
                    return options.allrules.validarHiddenAutoC.alertText;
                    //return options.allrules.required.alertText;
                }

                break;
        }
        //return options.allrules.validarHiddenAutoC.alertText;
    }
    ;
}
var _validarPermisos = function(field, rules, i, options) {
    var nombre = field.attr("name");
    //alert(nombre.split("_")[1]);
    if (field.is(":checked")) {
        return options.allrules.validate2fields.alertText;
    }
    ;
}


var cargar_contenido = function(e) {
    switch (e.value) {
        case 5 :
            _agregar(e.id);
            return;
            break;
        case 6 :
            _editar(e.id, 0);
            return;
            break;
        case 8 :
            _ordenar(e.id, 0, 0);
            return;
            break;
        default:
            _loadContenido(e.id);
    }
}

var _loadContenido = function(url_contenido) {
    _ajax(url_contenido, '', function(html_response) {
        _llenarEtiqueta("#contenedor", html_response);
    });
}

var _verOcultarElemento = function(id) {
    if ($(id).attr('class') == 'oculto') {
        $(id).removeClass('oculto');
    } else {
        $(id).addClass('oculto');
    }
};

$(document).ready(function() {
    $('.nuevo').click(function() {
        $('.add').fadeIn();
        var text = $(this).text();
        $.post(init.XNG_WEBSITE_URL + 'radicacion/ajax/form_add_radicacion.php', {case: $(this).attr('data-related')}, function(data) {
            console.log(text)
            $('.load_content').html(data);


        })
    })



    $('.guardar-formulario').submit(function(e) {
        e.preventDefault();
    })

})
function loadStylesCheckRadio() {
    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue',
        increaseArea: '-10' // optionaliradio_flat-red
    });
}



$(document).ready(function() {

    $('.anularBtn').click(function() {
        var action = $(this).attr('data-action');
        var record = $(this).attr('data-record');
        if (confirm('¿Esta seguro de desactivar este registro?')) {
            $.post(init.XNG_WEBSITE_URL + 'radicacion/ajax/save.php?type=null' + action, {id: record}, function(html_response) {
                switch (html_response) {
                    case '1':
                        alert(action + " Desactivado con Éxito!!");
                        $("#dialog-addModRad").remove();
                        _loadContenido($('#nombre_archivo').val());
                        break;
                    default:
                        _msgerror(html_response, "#mensaje");
                        break;
                }
            });
        }

    })

    $('.editarBtn').click(function() {

        var action = $(this).attr('data-action');
        var record = $(this).attr('data-record');
        $.post(init.XNG_WEBSITE_URL + 'radicacion/ajax/form_edit_radicacion.php', {case: action, id: record}, function(data) {
            console.log(data)
            $('#loadContentAjaxForms').modal({show: true});
            $('.modal-body').html(data)
            loadStylesCheckRadio();

        })
    })
})

function resetForm(idForm) {
    $(idForm).each(function() {
        this.reset();
    });
}