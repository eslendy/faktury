<? $i = 1;
if (!empty($dataContratos)) {
foreach ($dataContratos as $d) {
    ?>
    <tr class="elemetoBusqueda">
        <td><?= $d['numero_contrato'] ?></td>
        <td><?= $d['fecha_contrato'] ?></td>
        <td><?= $d['valor_contrato'] ?></td>
        <td><?= $d['proveedor'] ?></td>
        <td><?= ($d['estadoContrato'] == 1) ? 'Activo' : 'Inactivo' ?></td>
        <td width="61">
            <a>
                <span class="editarBtn" data-record="<? echo $d['idcontrato']; ?>" data-section="radicacion" data-action="contrato"><button class="btn btn-warning"><i class="icon-pencil"></i></button></span>
            </a>
        </td>
        <td width="61">
            <a>
                <span class="anularBtn" data-record="<? echo $d['idcontrato']; ?>" data-section="radicacion" data-action="contrato"><button class="btn btn-danger"><i class="icon-trash"></i></button></span>
            </a>
        </td>
    </tr>
<?
} } else {
    ?>
    <tr class="elemetoBusqueda">
        <td colspan="9" align="center">
            <b><em>No hay registros para tu busqueda.</em></b>
        </td>
    </tr>
    <?
}?> 
    
<script type="text/javascript" src="<? echo $SERVER_NAME?>js/jGeneral.js"></script>