<script>
    $(function() {
        /*$("#datepicker").datepicker({
         onSelect: function(dateText, inst) { 
         console.log( dateText);
         }, 
         inline: true,  
         showOtherMonths: true,  
         dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
         maxDate: "0D",
         dateFormat: 'yy-mm-dd',
         yearRange: "2001:2012", 
         changeYear: true,
         viewMode: 'years'
         });*/

        $("#calendar-by-year").datepicker({
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"
        }).on('changeDate', function(ev){
        
        //var d = new Date(ev.date.valueOf() * 1000)
        /*var d = new Date();
        console.log(d.getFullYear(ev.date))*/
        var d = new Date(ev.date);
        //alert(d.getFullYear());
        console.log('has seleccionado: '+d.getFullYear())
  });

        $("#calendar-by-month").datepicker({
            format: " mm",
            viewMode: "months",
            minViewMode: "months"
        }).on('changeDate', function(ev){
        
        //var d = new Date(ev.date.valueOf() * 1000)
        /*var d = new Date();
        console.log(d.getFullYear(ev.date))*/
        var d = new Date(ev.date);
        //alert(d.getMonth()+1);
        console.log('has seleccionado: '+d.getMonth()+1)
  });

        $("#calendar-by-day").datepicker({
            format: " dd",
            viewMode: "days",
            minViewMode: "days"
        }).on('changeDate', function(ev){
        //console.log(ev);
        //console.log($('#calendar-by-day .day.active').text());
        var d = new Date(ev.date);
        var fullDate = (d.getFullYear())+'-'+(d.getMonth()+1)+'-'+d.getDate();
        console.log('has seleccionado: '+fullDate)
        $.post(init.XNG_WEBSITE_URL+'reportes/', {fecha: fullDate}, function(data){
            console.log(data);
        })
        
  });
    })

</script>


<div class="calendarios">
    <div class="partes">
        <div id="acordeon">
            <h3>Reporte por Año</h3>
            <div>
                <div id="calendar-by-year" class="date-picker" data-date="<?php echo date('Y-m-d'); ?>"></div>
                <div class="clear"></div>
                <ul class="gage unstyled">
                    <li>
                        <div id="gage-1" style="width:180px; height:140px"></div>
                        <button class="btn btn-primary">view new visitor</button>
                    </li>
                </ul>
            </div>

            <h3>Reporte por Mes</h3>
            <div>
                <div id="calendar-by-month" class="date-picker"  data-date="<?php echo date('Y-m-d'); ?>"></div>
            </div>

            <h3>Reporte por Dia</h3>
            <div>
                <div id="calendar-by-day" class="date-picker"  data-date="<?php echo date('Y-m-d'); ?>"></div>
            </div>

        </div>
    </div>

</div>


<script>


    


    $(function() {
        $("#acordeon").accordion({
            collapsible: true,
            active: false,
            heightStyle: "content"
        });
    })

    //gage
    var g = new JustGage({
        id: "gage-1",
        value: getRandomInt(0, 980),
        min: 0,
        max: 980,
        showInnerShadow: true,
        shadowOpacity: 0.3,
        valueFontColor: ['#4A98BE'],
        levelColors: ['#4A98BE', '#3d86a9', '#347290'],
        title: "Visitors"
    });
</script>
