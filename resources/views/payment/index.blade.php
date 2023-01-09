@extends('adminlte::page')
@section('title', 'REGISTRO DE PAGOS')


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">
@endsection

@section('content')

    <div class="p-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white" style="background-color:#004173">
                        Registro de pagos
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-12">
                                        <form class="form-inline ml-3">
                                            <div class="d-flex">
                                                <div class="col-8">
                                                    <input type="search" class="form-control mr-2"
                                                        placeholder="Carné del socio" id="buscador" name="searchNuevo">
                                                </div>

                                                <div class="input-group-append col-5">
                                                    <button type="button" id="submit"
                                                        class="btn btn-success">Buscar</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        @if (isset($mensaje))
                            <div class="alert alert-success" role="alert" id="mensajeBoleta">
                                <h4 class="alert-heading">Pago registrado correctamente</h4>
                                <p> El reporte de pagos se actualizó y puede descargar la boleta</p>
                                <hr>
                                <a href="{{ route('boleta.payment') }}" target="_blank" class="btn btn-success"
                                    role="button">Descargar Boleta de pago</a>
                            </div>
                        @endif


                        <form action="{{ route('payments.store') }}" class="row g-3" method="POST">
                            @csrf
                            <div class="col-md-6 mt-2">
                                <label for="" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" value="" id="nombre">
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="" class="form-label">Apellidos:</label>
                                <input type="text" class="form-control" name="apellidos" value="" id="apellidos">
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="" class="form-label">Código:</label>
                                <input type="text" class="form-control" name="codigo" value="" id="codigo">
                            </div>


                            <div class="col-md-6 mt-2">
                                <label for="" class="form-label">Estado:</label>
                                <input type="text" class="form-control" name="" value="" id="estado">
                            </div>
                            <div id="agrega">

                            </div>

                    </div>
                    <div class="alert alert-danger" role="alert" id="alertaCastigo" style="display: none">
                        <span id="spanAlerta"></span>
                    </div>

                    <div class="container" id="seccionPagos">
                        <div class="row justify-content-md-center ">
                            <div class="col-sm-10">
                                <div class="card mt-5">
                                    <div class="card-header">
                                        Información de pagos
                                    </div>
                                    <div class="card-body">
                                        <div class="">
                                            <div class="row mb-3">
                                                <label for="" class="col-sm-4 col-form-label" id="labelMes">Último
                                                    pago:</label>
                                                <div class="col-sm-6">
                                                    <input type="" class="form-control" id="ultimo"
                                                        name="mesCorregido" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-sm-4 col-form-label">Cantidad de meses a
                                                    pagar:</label>
                                                <div class="col-sm-6">
                                                    <select class="custom-select" name='' id="monto">
                                                        <option value="0" selected>Seleccione cantidad</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="" class="col-sm-4 col-form-label">Monto a
                                                    pagar:</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="inputMonto"
                                                        class="monto" name="monto" readonly>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <label for="" class="col-sm-4 col-form-label">Fecha de
                                                    pago:</label>
                                                <div class="col-sm-6">
                                                    <input type="" class="form-control" id="fecha"
                                                        class="monto" name="fecha_de_pago" readonly>
                                                </div>


                                            </div>

                                            <button type="submit" class="btn btn-danger">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@section('js')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>

    <script>
        $('#buscador').autocomplete({
            select: function(event, ui) {
                //console.log('si');
            },
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('buscador.payment') }}",
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data)
                    }
                });
            }
        });

        $('#submit').on('click', function() {
            limpiar();
            var dniInput = document.getElementById('buscador');
            var dni = dniInput.value;
            $.ajax({
                type: "GET",
                url: "../../datosSocio" + dni,
                success: function(response) {

                    var arrays = JSON.parse(response);

                    var datos = arrays[0];

                    var datosConfig = arrays[2]; //datos de cuota mensual monto
                    var inscripcion = arrays[3]; //datos de inscripcion monto



                    document.getElementById('nombre').value = datos.nombre;
                    document.getElementById('apellidos').value = datos.apellido_paterno + ' ' + datos
                        .apellido_materno;
                    document.getElementById('codigo').value = datos.carne;
                    document.getElementById('estado').value = datos.estado;

                    var inputId = document.createElement("input");
                    inputId.setAttribute("type", "hidden");
                    inputId.setAttribute("name", "idNombre");
                    inputId.value = datos.id;

                    var inputDni = document.createElement("input");
                    inputDni.setAttribute("type", "hidden");
                    inputDni.setAttribute("name", "dni");
                    inputDni.value = datos.Dni;

                    var inputDomicilio = document.createElement("input");
                    inputDomicilio.setAttribute("type", "hidden");
                    inputDomicilio.setAttribute("name", "domicilio");
                    inputDomicilio.value = datos.domicilio;

                    var inputUnitario = document.createElement("input");
                    inputUnitario.setAttribute("type", "hidden");
                    inputUnitario.setAttribute("name", "monto_unitario");
                    inputUnitario.value = '20';

                    var holaNew = document.getElementById('agrega');
                    holaNew.appendChild(inputId);
                    holaNew.appendChild(inputDni);
                    holaNew.appendChild(inputUnitario);
                    holaNew.appendChild(inputDomicilio);


                    if (datos.estado == 'Retirado') {
                        $("#alertaCastigo").css("display", "Block");
                        var spanNuevo = document.getElementById('spanAlerta');
                        spanNuevo.innerHTML =
                            'El socio ha sido retirado del sistema por falta de pagos';
                    }

                    var mes = arrays[1];
                    var mesFun;
                    var añoFun;

                    var fechaActualInput = document.getElementById('fecha');
                    var actual = new Date();
                    var year = actual.getFullYear();
                    actual.setMonth(actual.getMonth() + 1);

                    var today = new Date();
                    
                    console.log(year);
                    

                    if(actual.getMonth() == 0){
                        var formatted_actual = year + "-" + '12' + "-" + actual
                        .getDate();

                    } else {
                        var formatted_actual = year + "-" + actual.getMonth() + "-" + actual
                        .getDate();
                    }

                    fechaActualInput.value = formatted_actual;



                    if (mes.length == 0) {
                        document.getElementById('labelMes').innerHTML = '';
                        document.getElementById('labelMes').innerHTML = 'Mes actual:';
                        const fecha = new Date();
                        const mesActual = fecha.getMonth();
                        const añoActual = fecha.getFullYear();


                        mesFun = mesActual;
                        añoFun = añoActual;

                        if (mesActual == 0) {
                            document.getElementById('ultimo').value = 'Enero' + ' ' + añoActual;
                        }
                        if (mesActual == 1) {
                            document.getElementById('ultimo').value = 'Febrero' + ' ' + añoActual;
                        }
                        if (mesActual == 2) {
                            document.getElementById('ultimo').value = 'Marzo' + ' ' + añoActual;
                        }
                        if (mesActual == 3) {
                            document.getElementById('ultimo').value = 'Abril' + ' ' + añoActual;
                        }
                        if (mesActual == 4) {
                            document.getElementById('ultimo').value = 'Mayo' + ' ' + añoActual;
                        }
                        if (mesActual == 5) {
                            document.getElementById('ultimo').value = 'Junio' + ' ' + añoActual;
                        }
                        if (mesActual == 6) {
                            document.getElementById('ultimo').value = 'Julio' + ' ' + añoActual;
                        }
                        if (mesActual == 7) {
                            document.getElementById('ultimo').value = 'Agosto' + ' ' + añoActual;
                        }
                        if (mesActual == 8) {
                            document.getElementById('ultimo').value = 'Setiembre' + ' ' + añoActual;
                        }
                        if (mesActual == 9) {
                            document.getElementById('ultimo').value = 'Octubre' + ' ' + añoActual;
                        }
                        if (mesActual == 10) {
                            document.getElementById('ultimo').value = 'Noviembre' + ' ' + añoActual;
                        }
                        if (mesActual == 11) {
                            document.getElementById('ultimo').value = 'Diciembre' + ' ' + añoActual;
                        }

                    }

                    if (mes.length > 0) {

                        document.getElementById('labelMes').innerHTML = 'Último pago:';
                        var recorrerMes = mes.map(function(m) {
                            document.getElementById('ultimo').value = m['mes'] + ' ' + m['año'];
                            var mesEstado = m['mes'];
                            añoFun = m['año'];

                            if (m['mes'] == 'Enero') {
                                mesFun = 0;
                                estado(mesFun, añoFun);
                            }
                            if (m['mes'] == 'Febrero') {
                                mesFun = 1;
                                estado(mesFun, añoFun);
                            }
                            if (m['mes'] == 'Marzo') {
                                mesFun = 2;
                                estado(mesFun, añoFun);
                            }
                            if (m['mes'] == 'Abril') {
                                mesFun = 3;
                                estado(mesFun, añoFun);
                            }
                            if (m['mes'] == 'Mayo') {
                                mesFun = 4;
                                estado(mesFun, añoFun);
                            }
                            if (m['mes'] == 'Junio') {
                                mesFun = 5;
                                estado(mesFun, añoFun);
                            }
                            if (m['mes'] == 'Julio') {
                                mesFun = 6;
                                estado(mesFun, añoFun);
                            }
                            if (m['mes'] == 'Agosto') {
                                mesFun = 7;
                                estado(mesFun, añoFun);
                            }
                            if (m['mes'] == 'Setiembre') {
                                mesFun = 8;
                                estado(mesFun, añoFun);
                            }
                            if (m['mes'] == 'Octubre') {
                                mesFun = 9;
                                estado(mesFun, añoFun);
                            }
                            if (m['mes'] == 'Noviembre') {
                                mesFun = 10;
                                estado(mesFun, añoFun);
                            }
                            if (m['mes'] == 'Diciembre') {
                                mesFun = 11;
                                estado(mesFun, añoFun);
                            }
                        });
                    }



                    $('#monto').on('click', function() {
                        var select = document.getElementById('monto');
                        var valor = select.options[select.selectedIndex].text;
                        var labelValidacion = document.getElementById('labelMes');
                        var monto = document.getElementById('inputMonto');

                        var montoInscripcion = inscripcion.monto;

                        if (valor === "1") {
                            if (labelValidacion.innerHTML == 'Mes actual:') {
                                monto.value = datosConfig.monto * 1 + parseInt(
                                    montoInscripcion);
                                unMesSinPagos(1, mesFun, añoFun)
                            }
                            if (labelValidacion.innerHTML == 'Último pago:') {
                                monto.value = datosConfig.monto * 1;
                                unMesConPagos(1, mesFun, añoFun);
                            }

                        }
                        if (valor === "2") {

                            if (labelValidacion.innerHTML == 'Mes actual:') {
                                monto.value = datosConfig.monto * 2 + parseInt(
                                    montoInscripcion);
                                unMesSinPagos(2, mesFun, añoFun)
                            }
                            if (labelValidacion.innerHTML == 'Último pago:') {
                                monto.value = datosConfig.monto * 2;
                                unMesConPagos(2, mesFun, añoFun);
                            }
                        }
                        if (valor === "3") {

                            if (labelValidacion.innerHTML == 'Mes actual:') {
                                monto.value = datosConfig.monto * 3 + parseInt(
                                    montoInscripcion);
                                unMesSinPagos(3, mesFun, añoFun)
                            }
                            if (labelValidacion.innerHTML == 'Último pago:') {
                                monto.value = datosConfig.monto * 3;
                                unMesConPagos(3, mesFun, añoFun);
                            }
                        }
                        if (valor === "4") {

                            if (labelValidacion.innerHTML == 'Mes actual:') {
                                monto.value = datosConfig.monto * 4 + parseInt(
                                    montoInscripcion);
                                unMesSinPagos(4, mesFun, añoFun)
                            }
                            if (labelValidacion.innerHTML == 'Último pago:') {
                                monto.value = datosConfig.monto * 4;
                                unMesConPagos(4, mesFun, añoFun);
                            }
                        }
                        if (valor === "5") {

                            if (labelValidacion.innerHTML == 'Mes actual:') {
                                monto.value = datosConfig.monto * 5 + parseInt(
                                    montoInscripcion);
                                unMesSinPagos(5, mesFun, añoFun)
                            }
                            if (labelValidacion.innerHTML == 'Último pago:') {
                                monto.value = datosConfig.monto * 5;
                                unMesConPagos(5, mesFun, añoFun);
                            }
                        }
                        if (valor === "6") {

                            if (labelValidacion.innerHTML == 'Mes actual:') {
                                monto.value = datosConfig.monto * 6 + parseInt(
                                    montoInscripcion);
                                unMesSinPagos(6, mesFun, añoFun)
                            }
                            if (labelValidacion.innerHTML == 'Último pago:') {
                                monto.value = datosConfig.monto * 6;
                                unMesConPagos(6, mesFun, añoFun);
                            }
                        }
                        if (valor === "7") {

                            if (labelValidacion.innerHTML == 'Mes actual:') {
                                monto.value = datosConfig.monto * 7 + parseInt(
                                    montoInscripcion);
                                unMesSinPagos(7, mesFun, añoFun)
                            }
                            if (labelValidacion.innerHTML == 'Último pago:') {
                                monto.value = datosConfig.monto * 7;
                                unMesConPagos(7, mesFun, añoFun);
                            }
                        }
                        if (valor === "8") {

                            if (labelValidacion.innerHTML == 'Mes actual:') {
                                monto.value = datosConfig.monto * 8 + parseInt(
                                    montoInscripcion);
                                unMesSinPagos(8, mesFun, añoFun)
                            }
                            if (labelValidacion.innerHTML == 'Último pago:') {
                                monto.value = datosConfig.monto * 8;
                                unMesConPagos(8, mesFun, añoFun);
                            }
                        }
                        if (valor === "9") {

                            if (labelValidacion.innerHTML == 'Mes actual:') {
                                monto.value = datosConfig.monto * 9 + parseInt(
                                    montoInscripcion);
                                unMesSinPagos(9, mesFun, añoFun)
                            }
                            if (labelValidacion.innerHTML == 'Último pago:') {
                                monto.value = datosConfig.monto * 9;
                                unMesConPagos(9, mesFun, añoFun);
                            }
                        }
                        if (valor === "10") {

                            if (labelValidacion.innerHTML == 'Mes actual:') {
                                monto.value = datosConfig.monto * 10 + parseInt(
                                    montoInscripcion);
                                unMesSinPagos(10, mesFun, añoFun)
                            }
                            if (labelValidacion.innerHTML == 'Último pago:') {
                                monto.value = datosConfig.monto * 10;
                                unMesConPagos(10, mesFun, añoFun);
                            };

                        }
                        if (valor === "11") {

                            if (labelValidacion.innerHTML == 'Mes actual:') {
                                monto.value = datosConfig.monto * 11 + parseInt(
                                    montoInscripcion);
                                unMesSinPagos(11, mesFun, añoFun)
                            }
                            if (labelValidacion.innerHTML == 'Último pago:') {
                                monto.value = datosConfig.monto * 11;
                                unMesConPagos(11, mesFun, añoFun);
                            }
                        }
                        if (valor === "12") {

                            if (labelValidacion.innerHTML == 'Mes actual:') {
                                monto.value = datosConfig.monto * 12 + parseInt(
                                    montoInscripcion);
                                unMesSinPagos(12, mesFun, añoFun);
                            }
                            if (labelValidacion.innerHTML == 'Último pago:') {
                                monto.value = datosConfig.monto * 12;
                                unMesConPagos(12, mesFun, añoFun);
                            }
                        }
                    })
                }
            });
            limpiarBuscador();
        });

        function unMesConPagos(valor, mesBd, añoBd) {
            var arrays = [];
            for (var i = 1; i <= valor; i++) {
                var date = new Date(añoBd, mesBd, 1);
                date.setMonth(date.getMonth() + i);
                var formatted_date = date.getMonth() + "-" + date.getFullYear();
                arrays.push(formatted_date);
            }
            var mesesPagados = document.createElement("input");
            mesesPagados.setAttribute("type", "hidden");
            mesesPagados.setAttribute("name", " mesesPagados");
            mesesPagados.value = arrays;
            var holaNew = document.getElementById('agrega');
            holaNew.appendChild(mesesPagados);

            var boletaItem = document.createElement("input");
            boletaItem.setAttribute("name", "boletaItem");
            boletaItem.setAttribute("type", "hidden");
            boletaItem.value = "noGuardar";
            holaNew.appendChild(boletaItem);

            //console.log(arrays);
        }

        function unMesSinPagos(valor, mesBd, añoBd) {
            var arrays = [];
            for (var i = 0; i < valor; i++) {
                var date = new Date(añoBd, mesBd, 1);
                date.setMonth(date.getMonth() + i);
                var formatted_date = date.getMonth() + "-" + date.getFullYear();
                arrays.push(formatted_date);
            }
            var mesesPagados = document.createElement("input");
            mesesPagados.setAttribute("type", "hidden");
            mesesPagados.setAttribute("name", " mesesPagados");
            mesesPagados.value = arrays;
            var holaNew = document.getElementById('agrega');
            holaNew.appendChild(mesesPagados);

            var boletaItem = document.createElement("input");
            boletaItem.setAttribute("name", "boletaItem");
            boletaItem.setAttribute("type", "hidden");
            boletaItem.value = "siGuardar";
            holaNew.appendChild(boletaItem);

        }

        function limpiar() {
            $("#monto").val("0");
            document.getElementById('inputMonto').value = '';
            document.getElementById('estado').value = '';
            $("#alertaCastigo").css("display", "none");
            $("#castigadoGuardar").remove();
        }

        function limpiarBuscador() {
            document.getElementById('buscador').value = '';
            document.getElementById('mensajeBoleta').remove();

        }

        function estado(mes, año) {
            const fecha = new Date();
            var dateEstado = new Date(año, mes, 1);
            if (dateEstado < fecha) {
                document.getElementById('estado').value = 'Presenta de deuda menor a 3 meses';
            }

            if (fecha < dateEstado) {
                document.getElementById('estado').value = 'Pagos al día';
            }

            fecha.setMonth(fecha.getMonth() - 3)
            if (fecha == dateEstado || dateEstado < fecha) {
                //llenar input estado
                document.getElementById('estado').value = 'Deuda mayor o igual a 3 meses';

                //mensaje de alerta

                const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre',
                    'octubre', 'noviembre', 'diciembre'
                ];
                const dias_semana = ['Domingo', 'Lunes', 'martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                const fecha3 = new Date();

                fecha3.setMonth(fecha3.getMonth() + 3)
                var habilitacion = dias_semana[fecha3.getDay()] + ', ' + fecha3.getDate() + ' de ' + meses[fecha3
                    .getMonth()] + ' de ' + fecha3.getUTCFullYear()
                $("#alertaCastigo").css("display", "Block");
                var spanNuevo = document.getElementById('spanAlerta');
                spanNuevo.innerHTML =
                    'Si realiza la cancelación total de su deuda, su habilitación en el sistema será el día :' +
                    habilitacion;

                //crear input que avisara si se guarda en la tabla castigados
                fecha3.setMonth(fecha3.getMonth() + 1)
                var inputCreado = document.createElement("input");
                inputCreado.setAttribute("type", "hidden");
                inputCreado.setAttribute("name", "castigadoGuardar");
                inputCreado.setAttribute("id", "castigadoGuardar");
                inputCreado.value = fecha3.getFullYear() + "-" + fecha3.getMonth() + "-" + fecha3.getDate();
                var divParaAgregar = document.getElementById('agrega');
                divParaAgregar.appendChild(inputCreado);
            }

            if (fecha.getFullYear() > dateEstado.getFullYear()) {
                const fecha2 = new Date();

                fecha2.setMonth(fecha2.getMonth() - 12)
                if (fecha2 == dateEstado || dateEstado < fecha2) {
                    document.getElementById('estado').value = 'Retirado';


                }

                fecha2.setMonth(fecha2.getMonth() - 3)
                if (fecha2 == dateEstado || dateEstado < fecha2) {
                    document.getElementById('estado').value = 'Deuda mayor o igual a 3 meses';
                }
            }

        }
    </script>
@endsection
@endsection
