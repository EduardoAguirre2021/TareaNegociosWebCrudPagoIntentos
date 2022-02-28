<h1>Pagos</h1>
<hr>
<table>
    <thead>
        <tr>
            <td>Codigo</td>
            <td>Fecha Pago</td>
            <td>Cliente</td>
            <td>Monto</td>
            <td>Fecha Vencimiento</td>
            <td>Estado</td>
            <td><a href="index.php?page=mnt.pagos.pago&mode=INS&idPago=0">Nuevo</a></td>
        </tr>
    </thead>
    <tbody>
        {{foreach pagos}}
            <tr>
                <td>{{idPago}}</td>
                <td>{{pagoFecha}}</td>
                <td>
                    <a href="index.php?page=mnt.pagos.pago&mode=DSP&idPago={{idPago}}">{{pagoCliente}}</a>
                </td>
                <td>{{pagoMonto}}</td>
                <td>{{pagoFechaVen}}</td>
                <td>{{pagoEst}}</td>
                <td>
                    <a href="index.php?page=mnt.pagos.pago&mode=UPD&idPago={{idPago}}">Editar</a>
                    &nbsp; 
                    <a href="index.php?page=mnt.pagos.pago&mode=DEL&idPago={{idPago}}">Eliminar</a>
                </td>
            </tr>
        {{endfor pagos}}
    </tbody>
</table>