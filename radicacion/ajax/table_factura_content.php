<?
$i = 1;
if (!empty($dataFacturas)) {
    foreach ($dataFacturas as $fac) {
        ?>
        <tr class="elemetoBusqueda">
            <td><?= $fac['no_radicado'] ?></td>
            <td><?= $fac['fecha_radicacion'] ?></td>
            <td><?= (($fac['prefijo'] != "") ? $fac['prefijo'] . ' ' : '') . $fac['numero_factura'] ?></td>
            <td><?= $fac['valor'] ?></td>
            <td><?= $fac['proveedor_nombre'] ?></td>
            <td><?= $fac['paciente_nombre'] ?></td>
            <td><?= ($fac['estado_factura'] == 1) ? 'Activa' : 'Anulada' ?></td>
            <td width="61">
                <a>
                    <span class="editarBtn" data-record="<? echo $fac['idf']; ?>" data-section="radicacion" data-action="factura"><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
                </a>
            </td>
            <td width="61">
                <a>
                    <span class="anularBtn" data-record="<? echo $fac['idf']; ?>" data-section="radicacion" data-action="factura"><button class="btn btn-danger"><i class="icon-trash"></i></button></span>
                </a>
            </td>
        </tr>
        <?
    }
} else {
    ?>
    <tr class="elemetoBusqueda">
        <td colspan="9" align="center">
            <b><em>No hay registros para tu busqueda.</em></b>
        </td>
    </tr>
        <?
    }
    ?>
<script type="text/javascript" src="<? echo $SERVER_NAME?>js/jGeneral.js"></script>