<?
var_dump($_REQUEST);
?>
<script>
    $(document).ready(function() {
        $('.load_content').html('');
        $('.block.span12.add').hide();
       
        var request = {action: '<? echo $_REQUEST['action'] ?>'};
        var lastChar = request.action.substr(request.action.length - 1)
        console.log(lastChar)
        var lastChar__ = request.action;
        if(lastChar == 's'){
            console.log( request.action.substring(0, request.action.length-1));
            lastChar__ =   request.action.substring(0, request.action.length-1);
        }
        if (request.action == 'factura' || request.action == 'fuerza' || request.action == '') {
            $('.btn.btn-primary.nuevo, .add_form').text('Nueva ' + lastChar__).attr('data-related', request.action)
        }
        else if(request.action == 'unidadAtencion'){
            $('.btn.btn-primary.nuevo, .add_form').text('Nueva unidad de atencion').attr('data-related', request.action)
        }
        else {
            $('.btn.btn-primary.nuevo, .add_form').text('Nuevo ' + lastChar__).attr('data-related', request.action)

        }
    })
</script>