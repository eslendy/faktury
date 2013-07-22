<?
var_dump($_REQUEST);
?>
<script>
    
   $('.load_content').html('');
   $('.block.span12.add').hide();
    var request = {action: '<? echo $_REQUEST['action'] ?>'};
    if (request.action == 'factura') {

        $('.btn.btn-primary.nuevo').text('Nueva ' + request.action).attr('data-related',request.action )
    }
    else {
        $('.btn.btn-primary.nuevo').text('Nuevo ' + request.action).attr('data-related',request.action )

    }


</script>