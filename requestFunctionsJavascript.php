<script>
     
                    
         
    $(document).ready(function() {
        $('.load_content').html('');
        $('.block.span12.add').hide();
        var request = {action: '<? echo $_REQUEST['action'] ?>'};
        var lastChar = request.action.substr(request.action.length - 1)
        var lastChar__ = request.action;
        if (lastChar == 's') {
            lastChar__ = request.action.substring(0, request.action.length - 1);
        }
        if (request.action == 'factura' || request.action == 'fuerza' || request.action == '') {
            $('.btn.btn-primary.nuevo, .add_form').html('<i class="icon-plus"></i> Nueva ' + lastChar__).attr('data-related', request.action)
        }
        else if (request.action == 'unidadAtencion') {
            $('.btn.btn-primary.nuevo, .add_form').html('<i class="icon-plus"></i> Nueva unidad de atencion').attr('data-related', request.action)
        }
        else {
            $('.btn.btn-primary.nuevo, .add_form').html('<i class="icon-plus"></i> Nuevo ' + lastChar__).attr('data-related', request.action)
        }

        $('.editarBtn').click(function() {
         
            var action = $(this).attr('data-action');
            var record = $(this).attr('data-record');
            $.post(init.XNG_WEBSITE_URL + 'radicacion/ajax/form_edit_radicacion.php', {case: action, id:record }, function(data) {
                    console.log(data)
                    $('#loadContentAjaxForms').modal({show:true});
                    $('.modal-body').html(data) 
                    loadStylesCheckRadio();
            })
        })
    })
</script>