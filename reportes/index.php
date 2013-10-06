<?php
include("../vigiaAjax.php");
include("../libphp/config.inc.php");
include("../libphp/mysql.php");
include("classes/reportes_class.php");
$reportes = new reportes($conexion['local']);
?>


<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="excanvas.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.pointLabels.min.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.highlighter.js"></script>

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
                    var result = $.parseJSON(data);
                    //   console.log(result);
                    $('.detail-char-1').empty();
                    $('.detail-total-facturas-1').empty();
                    if (result.result === true) {
                        load_graph_multiple('gage-1', result, 'year');
                    }
                    else {
                        $('#gage-1').html('<b>El Año ' + dateToSearch + ' (' + dateToSearch + ') no tiene ninguna factura</b>');
                    }
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
                    var result = $.parseJSON(data);
                    //      console.log(result);
                    $('.detail-total-facturas-2').empty();
                    $('.detail-char-2').empty();
                    if (result.result === true) {
                        //load_gage('gage-3', result.total, result.DAY_NUMBER);
                        load_graph_multiple('gage-2', result, 'month');
                    }
                    else {
                        $('#gage-2').html('<b>El mes ' + mes + ' (' + dateToSearch + ') no tiene ninguna factura</b>');
                    }
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
                    //  console.log(result);
                    $('.detail-char-3').empty();
                    $('.detail-total-facturas-3').empty();
                    if (result.result === true) {
                        //load_gage('gage-3', result.total, result.DAY_NUMBER);
                        load_graph('gage-3', result, dateToSearch);
                    }
                    else {
                        $('#gage-3').html('<b>El dia ' + dia + ' (' + dateToSearch + ') no tiene ninguna factura</b>');
                    }

                })
            }
        });
    })

</script>


<div class="calendarios">

    <table class="table table-striped table-hover" style="margin-bottom: 15px !important;">
        <thead>
            <tr>
                <td colspan="4" class="text-center"><b>Reporte Facturas por Auditor</b></td>
            </tr>
            <tr>
                <td>
                    ID
                </td>
                <td>
                    Nombre
                </td>
                <td>
                    Total Facturas
                </td>
                <td>
                    Total Facturado
                </td>
            </tr>
        </thead>
        <?php
        $Auditores = $reportes->getAuditoresIds();

        foreach ($Auditores as $au) {
            ?>
            <tr>
                <td>
                    <?php echo $au['idusuarios']; ?>
                </td>
                <td>
                    <?php echo $au['nombres'] . ' ' . $au['apellidos']; ?>
                </td>
                <td>
                    <?php
                    $total = $reportes->getTotalFacturasbyAuditor($au['idusuarios']);
                    echo $total['total'];
                    ?> 
                </td>
                <td>
                    $ <?php
                    $total = $reportes->getTotalValorFacturasbyAuditor($au['idusuarios']);
                    echo $total['total'];
                    ?> 
                </td>

            </tr>
            <?php
        }
        ?>
    </table>


    <table class="table table-striped table-hover" style="margin-bottom: 15px !important;">

        <tr>
            <td colspan="4" class="text-center"><b> </b></td>
        </tr>
        <tr>
            <td>
                Total Facturas RG
            </td>
            <td>
                <?php
                echo $reportes->getTotalFacturasRG();
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Total Facturas Con Contrato
            </td>
            <td>
                <?php
                echo $reportes->getTotalFacturasConContrato();
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Total Facturado en Contratos
            </td>
            <td>
                <table class="table table-striped table-hover">
                    <?php
                    $FacContrato = $reportes->getSumatoriaTotalValorFacturasXContrato();

                    foreach ($FacContrato as $key => $value) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                $ContratoInfo = $reportes->getContratoById($value['contrato']);
                                echo 'Numero de Contrato ' . $ContratoInfo['numero_contrato'];
                                ?>
                            </td>
                            <td>
                                $ <?php echo $value['TotalValor']; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                </table>


            </td>
        </tr>
        <tr>
            <td>
                Total Facturado por Proveedores
            </td>
            <td>
                <table class="table table-striped table-hover">
                    <?php
                    $FacProveedor = $reportes->getSumatoriaTotalFacturadoXCadaProveedor();
                    $FacProveedorTotales = $reportes->getTotalFacturadoXCadaProveedor();
                    foreach ($FacProveedor as $key => $value) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                $ProovedorInfo = $reportes->getProveedorById($value['idproveedor']);
                                echo 'Nombre Proveedor: ' . $ProovedorInfo['nombre'];
                                ?>
                            </td>
                            <td>
                                <?php echo $FacProveedorTotales[$key]['total']; ?> facturas
                            </td>
                            <td>
                                $ <?php echo $value['TotalValor']; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                </table>
            </td>
        </tr>
        <tr>
            <td>
                Total Valor Glosas
            </td>
            <td>
                <?php echo $reportes->getTotalValorGlosas(); ?>
            </td>
        </tr>
        <tr>
            <td>
                Total Valor Glosas por Auditor
            </td>
            <td>

                <table class="table table-striped table-hover">
                    <?php
                    $GlosasPorAu = $reportes->getTotalValorGlosasPorAuditor();

                    foreach ($GlosasPorAu as $key => $value) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                $Au = $reportes->getAuditorById($value['id_auditor']);
                                echo 'Nombre Auditor: ' . $Au['nombres'] . ' ' . $Au['apellidos'];
                                ?>
                            </td>

                            <td>
                                $ <?php echo $value['TotalValor']; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                </table>

            </td>
        </tr>
        <tr>
            <td>
                Total Valor Glosas con primera respuesta
            </td>
            <td>
                <table class="table table-striped table-hover">
                    <tr>
                        <td>
                            <?php echo $reportes->getTotalPagosPrimeraAuditoria(); ?> facturas
                        </td>
                        <td>
                            $ <?php echo $reportes->getTotalValorPagosPrimeraAuditoria(); ?>
                        </td>
                    </tr>
                </table>
            </td>

        </tr>
        <tr>
            <td>
                Total Valor Glosas por Auditor con primera respuesta
            </td>
            <td>

                <table class="table table-striped table-hover">
                    <?php
                    $PrimAu = $reportes->getTotalValorPrimeraAuditoriaPorCadaAuditor();

                    foreach ($PrimAu as $key => $value) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                $Au = $reportes->getAuditorById($value['id_auditor']);
                                echo 'Nombre Auditor: ' . $Au['nombres'] . ' ' . $Au['apellidos'];
                                ?>
                            </td>

                            <td>
                                $ <?php echo $value['TotalValor']; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                </table>

            </td>
        </tr>
        <tr>
            <td>
                Total Valor Glosas Levantadas
            </td>
            <td>
                <table class="table table-striped table-hover">
                    <tr>
                        <td>
                            <?php echo $reportes->getTotalGlosasLevantadas(); ?> facturas
                        </td>
                        <td>
                            $ <?php echo (int) $reportes->getTotalValorGlosasLevantadas(); ?>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr>
            <td>
                Total Valor Glosas Levantadas por auditor
            </td>
            <td>
                <table class="table table-striped table-hover">
                    <?php
                    $GloLev = $reportes->getTotalGlosasLevantadasPorAuditor();
                    if (count($GloLev) > 0) {
                        foreach ($GloLev as $key => $value) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $Au = $reportes->getAuditorById($value['id_auditor']);
                                    echo 'Nombre Auditor: ' . $Au['nombres'] . ' ' . $Au['apellidos'];
                                    ?>
                                </td>

                                <td>
                                    $ <?php echo $value['TotalValor']; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<td colspan=2>no hay registros</td>';
                    }
                    ?>

                </table>

            </td>
        </tr>
        <tr>
            <td>
                Total Glosas Pendientes
            </td>
            <td>
                <table class="table table-striped table-hover">
                    <tr>
                        <td>
                            <?php echo $reportes->getTotalGlosasPendientes(); ?> facturas
                        </td>
                        <td>
                            $ <?php echo (int) $reportes->getTotalValorGlosasPendientes(); ?>
                        </td>
                    </tr>
                </table>

            </td>
        </tr> 
        <tr>
            <td>
                Total Glosas Pendientes por Auditor
            </td>
            <td>
                <table class="table table-striped table-hover">
                    <?php
                    $GloPen = $reportes->getTotalValorGlosasPendientesPorCadaAuditor();
                    if (count($GloPen) > 0) {
                        foreach ($GloPen as $key => $value) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $Au = $reportes->getAuditorById($value['id_auditor']);
                                    echo 'Nombre Auditor: ' . $Au['nombres'] . ' ' . $Au['apellidos'];
                                    ?>
                                </td>

                                <td>
                                    $ <?php echo $value['TotalValor']; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<td colspan=2>no hay registros</td>';
                    }
                    ?>

                </table>
            </td>
        </tr>
        
        
        
        
        <tr>
            <td>
                Total Glosas Definitivas
            </td>
            <td>
                <table class="table table-striped table-hover">
                    <tr>
                        <td>
                            <?php echo $reportes->getTotalGlosasDefinitivas(); ?> facturas
                        </td>
                        <td>
                            $ <?php echo (int) $reportes->getTotalValorGlosasDefinitivas(); ?>
                        </td>
                    </tr>
                </table>

            </td>
        </tr> 
        <tr>
            <td>
                Total Glosas Definitivas por Auditor
            </td>
            <td>
                <table class="table table-striped table-hover">
                    <?php
                    $GloDef = $reportes->getTotalValorGlosasDefinitivasPorCadaAuditor();
                    if (count($GloDef) > 0) {
                        foreach ($GloDef as $key => $value) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $Au = $reportes->getAuditorById($value['id_auditor']);
                                    echo 'Nombre Auditor: ' . $Au['nombres'] . ' ' . $Au['apellidos'];
                                    ?>
                                </td>

                                <td>
                                    $ <?php echo $value['TotalValor']; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<td colspan=2>no hay registros</td>';
                    }
                    ?>

                </table>
            </td>
        </tr>
        
        
        
        
        <tr>
            <td>
                Total Auditado (Auditoria Medica)
            </td>
            <td>
                <table class="table table-striped table-hover">
                    <tr>
                        <td>
                            <?php echo $reportes->getTotalAuditadoAuditoriaMedica(); ?> facturas
                        </td>
                        <td>
                            $ <?php echo (int) $reportes->getTotalValorAuditadoAuditoriaMedica(); ?>
                        </td>
                    </tr>
                </table>

            </td>
        </tr> 
        <tr>
            <td>
                Total Auditado por cada Auditor (Auditoria Medica)
            </td>
            <td>
                <table class="table table-striped table-hover">
                    <?php
                    $AuMe = $reportes->getTotalAuditadoAuditoriaMedicaPorCadaAuditor();
                    if (count($AuMe) > 0) {
                        foreach ($AuMe as $key => $value) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $Au = $reportes->getAuditorById($value['id_auditor']);
                                    echo 'Nombre Auditor: ' . $Au['nombres'] . ' ' . $Au['apellidos'];
                                    ?>
                                </td>

                                <td>
                                    $ <?php echo $value['TotalValor']; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<td colspan=2>no hay registros</td>';
                    }
                    ?>

                </table>
            </td>
        </tr>

        <?php /*
          $Auditores = $reportes->getAuditoresIds();

          foreach ($Auditores as $au) {
          ?>
          <tr>
          <td>
          <?php echo $au['idusuarios']; ?>
          </td>
          <td>
          <?php echo $au['nombres'].' '.$au['apellidos']; ?>
          </td>
          <td>
          <?php
          $total = $reportes->getTotalFacturasbyAuditor($au['idusuarios']);
          echo $total['total'];
          ?>
          </td>
          <td>
          $ <?php
          $total = $reportes->getTotalValorFacturasbyAuditor($au['idusuarios']);
          echo $total['total'];
          ?>
          </td>

          </tr>
          <?php
          } */
        ?>
    </table>



    <div class="partes">
        <div id="acordeon">
            <h3>Reporte por Año</h3>
            <div>
                <div id="calendar-by-year" class="date-picker" data-date="<?php echo date('Y-m-d'); ?>"></div>
                <div class="clear"></div>

                <div id="gage-1"></div>
                <div class="detail-char-1"></div>
                <div class="detail-total-facturas-1"></div>

            </div>

            <h3>Reporte por Mes</h3>
            <div>
                <div id="calendar-by-month" class="date-picker"  data-date="<?php echo date('Y-m-d'); ?>"></div>
                <div class="clear"></div>

                <div id="gage-2"></div>
                <div class="detail-char-2"></div>
                <div class="detail-total-facturas-2"></div>
            </div>

            <h3>Reporte por Dia</h3>
            <div>
                <div id="calendar-by-day" class="date-picker"  data-date="<?php echo date('Y-m-d'); ?>"></div>
                <div class="clear"></div>

                <div id="gage-3" style="width:180px; height:140px; margin-left: auto; margin-right: auto;"></div>

                <div class="detail-char-3"></div>
                <div class="detail-total-facturas-3"></div>
            </div>

        </div>
    </div>

</div>


<script>


    addCommas = function(input) {
        // If the regex doesn't match, `replace` returns the string unmodified
        return (input.toString()).replace(
                // Each parentheses group (or 'capture') in this regex becomes an argument 
                // to the function; in this case, every argument after 'match'
                /^([-+]?)(0?)(\d+)(.?)(\d+)$/g, function(match, sign, zeros, before, decimal, after) {

            // Less obtrusive than adding 'reverse' method on all strings
            var reverseString = function(string) {
                return string.split('').reverse().join('');
            };

            // Insert commas every three characters from the right
            var insertCommas = function(string) {

                // Reverse, because it's easier to do things from the left
                var reversed = reverseString(string);

                // Add commas every three characters
                var reversedWithCommas = reversed.match(/.{1,3}/g).join(',');

                // Reverse again (back to normal)
                return reverseString(reversedWithCommas);
            };

            // If there was no decimal, the last capture grabs the final digit, so
            // we have to put it back together with the 'before' substring
            return sign + (decimal ? insertCommas(before) + decimal + after : insertCommas(before + after));
        }
        );
    };


    $(function() {
        $("#acordeon").accordion({
            collapsible: true,
            active: false,
            heightStyle: "content"
        });
    })


    function load_graph_multiple(id, result, m) {
        $('#' + id).empty();
        var $s = [];
        var $label = [];


        if (m == 'month') {

            var array = $.map(result.TOTAL_MONTH_DEATAILED, function(k, v) {
                return [k];
            });

            var TOTAL_ = $.map(result.TOTAL_MONTH, function(k, v) {
                return [k];
            });

            var TOTAL_FACTURAS = $.map(result.TOTAL_FACTURAS_BY_MONTH, function(k, v) {
                return [k];
            });

        }
        if (m == 'year') {

            var array = $.map(result.TOTAL_YEAR_DEATAILED, function(k, v) {
                return [k];
            });

            var TOTAL_ = $.map(result.TOTAL_YEAR, function(k, v) {
                return [k];
            });

            var TOTAL_FACTURAS = $.map(result.TOTAL_FACTURAS_BY_YEAR, function(k, v) {
                return [k];
            });

        }

        if (array) {

            if (m == 'month') {
                $.each(array, function(i, j) {
                    // console.log(j)
                    $s[i] = parseInt(j.total);
                    $label[i] = j.DAY_NAME;
                })

                $.each(TOTAL_, function(i, j) {
                    $('.detail-char-2').html('<div class=span12><b>' + j.MONTH_NUMBER + '</b>' + ' Total: $' + addCommas(parseInt(j.total)) + '</div>');
                })
                var total_facturas = 0;
                $.each(TOTAL_FACTURAS, function(i, j) {
                    total_facturas += parseInt(j.total)
                    $('.detail-total-facturas-2').append('<p>Total de Facturas en el ' + j.DAY_NUMBER + ': <b>' + addCommas(parseInt(j.total)) + '</b></p>');
                })
                $('.detail-total-facturas-2').append('<p><em><b>Sumatoria total de facturas: ' + total_facturas + '</b></em></p>');


            }

            if (m == 'year') {
                $.each(array, function(i, j) {
                    // console.log(j)
                    $s[i] = parseInt(j.total);
                    $label[i] = j.MONTH_NAME;
                })

                $.each(TOTAL_, function(i, j) {
                    console.log(result);
                    $('.detail-char-1').html('<div class=span12><b>' + j.YEAR_NUMBER + '</b>' + ' Total: $' + addCommas(parseInt(j.total)) + '</div>');
                })
                var total_facturas = 0;
                $.each(TOTAL_FACTURAS, function(i, j) {
                    total_facturas += parseInt(j.total)
                    $('.detail-total-facturas-1').append('<p>Total de Facturas en el ' + j.MONTH_NUMBER + ': <b>' + addCommas(parseInt(j.total)) + '</b></p>');
                })

                $('.detail-total-facturas-1').append('<p><em><b>Sumatoria total de facturas: ' + total_facturas + '</b></em></p>');


            }



            $(document).ready(function() {

                var labels = $label;
                var ticks = $label;
                // Can specify a custom tick Array.
                // Ticks should match up one for each y value (category) in the series.

                var plot1 = $.jqplot(id, [$s], {
                    stackSeries: true,
                    animate: true,
                    captureRightClick: true,
                    // The "seriesDefaults" option is an options object that will
                    // be applied to all series in the chart.
                    seriesDefaults: {
                        renderer: $.jqplot.BarRenderer,
                        rendererOptions: {
                            showDataLabels: true,
                            dataLabels: 'value',
                            dataLabelFormatString: '%.2f'
                        },
                        pointLabels: {show: true /*, stackedValue: true*/, hideZeros: false},
                    },
                    axesDefaults: {
                        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                        tickOptions: {
                            fontSize: '8pt',
                            angle: -50
                        },
                        rendererOptions: {
                            alignTicks: true,
                        }
                    },
                    highlighter: {
                        show: true,
                        showMarker: true,
                        showTooltip: true,
                        tooltipLocation: 'n',
                        tooltipFadeSpeed: "fast",
                        tooltipAxes: 'y',
                        yvalues: 1,
                        formatString: '<table class="jqplot-highlighter"><tr><td>Total: </td><td>%s</td></tr></table>'
                    },
                    axes: {
                        xaxis: {
                            renderer: $.jqplot.CategoryAxisRenderer,
                            ticks: ticks,
                            rendererOptions: {
                                // Put a 30 pixel margin between bars.
                                barMargin: 200,
                                // Highlight bars when mouse button pressed.
                                // Disables default highlighting on mouse over.
                                highlightMouseDown: true
                            },
                        },
                        yaxis: {
                            labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                            min: 0,
                            tickOptions: {
                                formatString: '%d',
                            }

                        }

                    },
                    legend: {
                        show: true,
                        location: 'ne',
                        placement: 'outsideGrid',
                        labels: labels
                    },
                });
            })


            $('#' + id).bind('jqplotDataHighlight',
                    function(ev, seriesIndex, pointIndex, data) {
                        $.each($('.jqplot-highlighter tr td'), function() {
                            $(this).text(addCommas($(this).text()))
                        })
                    }
            );

        }

    }


    function load_graph(id, result) {
        $('#' + id).empty();
        $('.detail-total-facturas-3').empty();
        $('.detail-char-3').html('<div class=span12><b>' + result.DAY_NUMBER + '</b>' + ' Total: $' + result.total + '</div>');
        var TOTAL_FACTURAS = $.map(result.TOTAL_FACTURAS_BY_DAY, function(k, v) {
            return [k];
        });
        var total_facturas = 0;
        $.each(TOTAL_FACTURAS, function(i, j) {
            total_facturas += parseInt(j.total)
            $('.detail-total-facturas-3').append('<p>Total de Facturas en el ' + j.DAY_NUMBER + ': <b>' + addCommas(parseInt(j.total)) + '</b></p>');
        })
        $('.detail-total-facturas-3').append('<p><em><b>Sumatoria total de facturas: ' + total_facturas + '</b></em></p>');
        console.log(result.DAY_NUMBER + ' ' + result.total)

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
                pointLabels: {show: false, labels: result.DAY_NUMBER}
            },
            /*series: [
             {label: result.DAY_NUMBER}
             ],*/
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer
                },
                yaxis: {
                    // Don't pad out the bottom of the data range.  By default,
                    // axes scaled as if data extended 10% above and below the
                    // actual range to prevent data points right on grid boundaries.
                    // Don't want to do that here.
                    padMax: 1.3,
                    tickOptions: {formatString: '$%d'}
                }
            },
            legend: {
                show: true,
                location: 'e',
                placement: 'outside'
            }
        });

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

<style>
    .jqplot-point-label
    {
        display: none !important;
    }

</style>

<script>

    $(document).ready(function() {
        $('.btn.btn-primary.nuevo').hide();
    })

</script>