<h1>{{modeDsc}}</h1>
<hr>

<section class="container-m">
    <form action="index.php?page=mnt.pagos.pago&mode={{mode}}&idPago={{idPago}}" method="post">
        <input type="hidden" name="crsxToken" value="{{crsxToken}}">
        {{ifnot isInsert}}
        <fieldset class="row flex-center">
            <label for="idPago" class="col-5">Código</label>
            <input class="col-7" type="text" name="idPago" id="idPago" value="{{idPago}}" placeholder="" >
        </fieldset>
        {{endifnot isInsert}}

        <fieldset class="row flex-center">
            <label for="pagoCliente" class="col-5">Nombre Cliente</label>
            <input class="col-7" type="text" name="pagoCliente" id="pagoCliente" value="{{pagoCliente}}" placeholder="" >
        </fieldset>

        <fieldset class="row flex-center">
            <label for="pagoMonto" class="col-5">Monto de Pago</label>
            <input class="col-7" type="text" name="pagoMonto" id="pagoMonto" value="{{pagoMonto}}" placeholder="" >
        </fieldset>

        <fieldset class="row flex-left">
                <label for="pagoFechaVen" class="col-5" >Fecha de vencimiento:</label>
                <input type="date" id="pagoFechaVen" name="pagoFechaVen" value="2022-02-25" 
                min="2022-01-01" max="2100-12-31">
        </fieldset>

        <fieldset class="row flex-center">
            <label class="col-5" for="pagoEst">Estado</label>
            <select class="col-7" name="pagoEst" id="pagoEst">
                {{foreach pagoOptions}}
                <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor pagoOptions}}
            </select>
        </fieldset>
        <fieldset class="row flex-center">
            <button type="submit" name="btnConfirmar" class="btn primary">Confirmar</button>&nbsp;&nbsp;&nbsp;
            <button type="submit" id="btnCancelar" class="btn danger">Cancelar</button>
        </fieldset>        
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", (e) => {
            document.getElementById("btnCancelar").addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation(); 
                location.assign("index.php?page=mnt.pagos.pagos");
            })
        })
    </script>
</section>