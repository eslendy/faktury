<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="excanvas.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.pointLabels.min.js"></script>

<link rel="stylesheet" type="text/css" href="js/jquery.jqplot.css" />

<script>
    $(function() {

        $("#calendar-by-year").datepicker({
            format: " yyyy",
            viewMode: "years",
            minViewMode: "years"
        }).on('changeDate', function(ev) {

            if (ev.viewMode === 'years') {
                var d = new Date(ev.date);
                var dateToSearch = d.getFullYear();
                $.post(init.XNG_WEBSITE_URL + 'reportes/ajax/load_stats', {dateToSearch: dateToSearch, mode: ev.viewMode}, function(data) {
                    console.log(data);
                })
            }

        });

        $("#calendar-by-month").datepicker({
            format: " mm",
            viewMode: "months",
            minViewMode: "months"
        }).on('changeDate', function(ev) {

            if (ev.viewMode === 'months') {
                var d = new Date(ev.date);
                var mes = d.getMonth() + 1;

                if (mes.length === 1) {
                    var mes = 0 + d.getMonth();
                }

                var dateToSearch = (d.getFullYear() + '-' + mes);

                $.post(init.XNG_WEBSITE_URL + 'reportes/ajax/load_stats', {dateToSearch: dateToSearch, mode: ev.viewMode}, function(data) {
                    console.log(data);
                })
            }


        });

        $("#calendar-by-day").datepicker({
            format: " dd",
            viewMode: "days",
            minViewMode: "days"
        }).on('changeDate', function(ev) {
            if (ev.viewMode === 'days') {
                var d = new Date(ev.date);
                var mes = d.getMonth() + 1;
                var dia = d.getDate();
                var dateToSearch = d.getFullYear() + '-' + mes + '-' + dia;
                $.post(init.XNG_WEBSITE_URL + 'reportes/ajax/load_stats', {dateToSearch: dateToSearch, mode: ev.viewMode}, function(data) {
                    var result = $.parseJSON(data);
                    console.log(result);
                    if(result.result === true){
                         //load_gage('gage-3', result.total, result.DAY_NUMBER);
                    load_graph('gage-3', result, dateToSearch);
                    }
                    else{
                        $('.detail-char').empty();
                        $('#gage-3').html('<b>El dia '+dia+' ('+dateToSearch+') no tiene ninguna factura</b>');
                    }
                   
                })
            }
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
                    </li>
                </ul>
            </div>

            <h3>Reporte por Mes</h3>
            <div>
                <div id="calendar-by-month" class="date-picker"  data-date="<?php echo date('Y-m-d'); ?>"></div>
                <div class="clear"></div>
                <ul class="gage unstyled">
                    <li>
                        <div id="gage-2" style="width:180px; height:140px"></div>
                    </li>
                </ul>
            </div>

            <h3>Reporte por Dia</h3>
            <div>
                <div id="calendar-by-day" class="date-picker"  data-date="<?php echo date('Y-m-d'); ?>"></div>
                <div class="clear"></div>
               
                        <div id="gage-3" style="width:180px; height:140px; margin-left: auto; margin-right: auto;"></div>
                        
                        <div class="detail-char"></div>
                 
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



    function load_graph(id, result) {
        $('#'+id).empty();
        $('.detail-char').html('<div class=span12><b>'+result.DAY_NUMBER+'</b>'+' Total: $'+result.total+'</div>');
        console.log(result.DAY_NUMBER+' '+result.total)
        
        var s1 = [parseInt(result.total)];
      
        plot3 = $.jqplot(id, [s1], {
            // Tell the plot to stack the bars.
            stackSeries: true,
            captureRightClick: true,
            seriesDefaults: {
                renderer: $.jqplot.BarRenderer,
                rendererOptions: {
                    // Put a 30 pixel margin between bars.
                    barMargin: 30,
                    // Highlight bars when mouse button pressed.
                    // Disables default highlighting on mouse over.
                    highlightMouseDown: true
                },
                pointLabels: {show: true}
            },
            series: [
                {label: result.DAY_NUMBER}
            ],
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer
                },
                yaxis: {
                    // Don't pad out the bottom of the data range.  By default,
                    // axes scaled as if data extended 10% above and below the
                    // actual range to prevent data points right on grid boundaries.
                    // Don't want to do that here.
                    padMin: 0,
                    tickOptions: {formatString: '$%d'}
                }
            },
            legend: {
                show: true,
                location: 'e',
                placement: 'outside'
            }
        });
        /*/ Bind a listener to the "jqplotDataClick" event.  Here, simply change
        // the text of the info3 element to show what series and ponit were
        // clicked along with the data for that point.
        $('#chart3').bind('jqplotDataClick',
                function(ev, seriesIndex, pointIndex, data) {
                    $('#info3').html('series: ' + seriesIndex + ', point: ' + pointIndex + ', data: ' + data);
                }
        );*/
    }








    //gage
    function load_gage(id, value, title) {
        $('#' + id).empty();
        console.log(id + ' ' + value + ' ' + title);
        var g = new JustGage({
            id: id,
            value: value,
            min: 0,
            max: 100000000,
            showInnerShadow: true,
            shadowOpacity: 0.3,
            valueFontColor: ['#4A98BE'],
            levelColors: ['#4A98BE', '#3d86a9', '#347290'],
            title: title
        });
    }

</script>
