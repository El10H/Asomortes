@extends('adminlte::page')
@section('title', 'REPORTE')


@section('css')
@section('css')
    <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">

@endsection

@endsection

@section('content')
<div class="p-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white" style="background-color:#004173">
                    Reportes
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center ">
                                    <div class="card mt-3 mb-5  mr-1 w-50">
                                        <div class="card-header">
                                            Filtrar por mes
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="d-flex col-12 ml-2">
                                                    <div class="col-8 d-flex">
                                                        <div class="col-6">
                                                            <select name="mes" id="mes" class="custom-select">
                                                                <option value="">Seleccione mes </option>
                                                                <option value="1">Enero</option>
                                                                <option value="2">Febrero</option>
                                                                <option value="3">Marzo</option>
                                                                <option value="4">Abril</option>
                                                                <option value="5">Mayo</option>
                                                                <option value="6">Junio</option>
                                                                <option value="7">Julio</option>
                                                                <option value="8">Agosto</option>
                                                                <option value="9">Setiembre</option>
                                                                <option value="10">Octubre</option>
                                                                <option value="11">Noviembre</option>
                                                                <option value="12">Diciembre</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-6">
                                                            <select name="año" id="año" class="custom-select">
                                                                <option value="">Seleccione año</option>
                                                                <option value="2021">2021</option>
                                                                <option value="2022">2022</option>
                                                                <option value="2023">2023</option>
                                                                <option value="2024">2024</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <input type="button" value="Buscar" id="filtroMes"
                                                            onclick="llenarTabla()" class="btn btn-success">

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mt-3 mb-5 w-50">
                                        <div class="card-header">
                                            Filtrar por día
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-3">

                                                <div class="d-flex col-12 ml-2">
                                                    <div class="col-8 d-flex">
                                                        <div class="col-12">
                                                            <input type="date" class="form-control" id="fecha">
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <input type="button" value="Buscar" id="filtroDia"
                                                            onclick="llenarTablaDia()" class="btn btn-success">

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="d-flex justify-content-center">

                                    <div class="card text-center mt-3 mb-5 w-75">
                                        <div class="card-header text-white" style="background-color:#004173">
                                            Pagos realizados por socios
                                        </div>
                                        <div class="card-body">
                                            <p id="textoPagos" class="card-text"></p>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <input type="button" value="Ver detalles" class="btn"
                                                id="btn_pagos">
                                        </div>
                                    </div>


                                </div>

                                <div class="d-flex justify-content-center">
                                    <div class="card text-center mt-3 mb-5 w-75">
                                        <div class="card-header text-white" style="background-color:#004173">
                                            Compras de productos
                                        </div>
                                        <div class="card-body">
                                            <p id="textoProductos" class="card-text"></p>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <input type="button" value="Ver detalles" class="btn"
                                                id="btn_producto">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div class="card text-center mt-3 mb-5 w-75">
                                        <div class="card-header text-white" style="background-color:#004173">
                                            Compras de servicios
                                        </div>
                                        <div class="card-body">
                                            <p id="textoServicios" class="card-text"></p>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <input type="button" value="Ver detalles" class="btn"
                                            id="btn_servicio">
                                        </div>
                                    </div>
                                </div>




                            </div>


                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        function llenarTabla() {
            var selectMes = document.getElementById('mes');
            var mesSeleccionado = selectMes.options[selectMes
                    .selectedIndex]
                .value;

            var selectAño = document.getElementById('año');
            var añoSeleccionado = selectAño.options[selectAño
                    .selectedIndex]
                .value;

            $.ajax({
                type: "GET",
                url: "../../filtrarMes",
                data: {
                    mes: mesSeleccionado,
                    año: añoSeleccionado
                },
                dataType: 'json',
                success: function(response) {
                    var pagos = response[0];
                    var comprasProductos = response[1];
                    var comprasServicios = response[2];

                    var textoPagos = document.getElementById('textoPagos');
                    $('#btn_pagos').on('click',function(){
                        detallePagos_mesAño();
                    });
                    pagos.forEach(element => {
                        if (element['montoTotal'] == null) {
                            textoPagos.textContent = 'Monto total en pagos:  S/0';
                        } else {
                            textoPagos.textContent = 'Monto total en pagos:  S/' + element[
                                'montoTotal'];
                        }

                    });

                    var textoProductos = document.getElementById('textoProductos');
                    $('#btn_producto').on('click',function(){
                        detalleProductos_mesAño();
                    });
                    comprasProductos.forEach(element => {
                        if (element['totalProducto'] == null) {
                            textoProductos.textContent = 'Monto total en compras de productos:  S/0';
                        } else {
                            textoProductos.textContent = 'Monto total en compras de productos:  S/' +
                                element['totalProducto'];
                        }
                    });

                    var textoServicios = document.getElementById('textoServicios');
                    $('#btn_servicio').on('click',function(){
                        detalleServicios_mesAño()
                    });
                    comprasServicios.forEach(element => {
                        if (element['totalServicio'] == null) {
                            textoServicios.textContent = 'Monto total en compras de servicios:  S/0';
                        } else {
                            textoServicios.textContent = 'Monto total en compras de servicios:  S/' +
                                element['totalServicio'];
                        }
                    });

                }
            })

        }

        function llenarTablaDia() {
            var fecha = document.getElementById('fecha').value;

            $.ajax({
                type: "GET",
                url: "../../filtrarFecha",
                data: {
                    fecha: fecha,

                },
                dataType: 'json',
                success: function(response) {
                    var pagos = response[0];
                    var comprasProductos = response[1];
                    var comprasServicios = response[2];

                    var textoPagos = document.getElementById('textoPagos');
                    $('#btn_pagos').on('click',function(){
                        detallePagos_fecha()
                    });
                    pagos.forEach(element => {
                        if (element['montoTotal'] == null) {
                            textoPagos.textContent = 'Monto total en pagos:  S/0';
                        } else {
                            textoPagos.textContent = 'Monto total en pagos:  S/' + element[
                                'montoTotal'];
                        }

                    });

                    var textoProductos = document.getElementById('textoProductos');
                    $('#btn_producto').on('click',function(){
                        detalleProductos_fecha()
                    });

                    comprasProductos.forEach(element => {
                        console.log(element);
                        if (element['totalProducto'] == null) {
                            textoProductos.textContent = 'Monto total en compras de productos:  S/0';
                        } else {
                            textoProductos.textContent = 'Monto total en compras de productos:  S/' +
                                element['totalProducto'];
                        }
                    });

                    var textoServicios = document.getElementById('textoServicios');
                    $('#btn_servicio').on('click',function(){
                        detalleServicios_fecha()
                    });
                    comprasServicios.forEach(element => {
                        if (element['totalServicio'] == null) {
                            textoServicios.textContent = 'Monto total en compras de servicios:  S/0';
                        } else {
                            textoServicios.textContent = 'Monto total en compras de servicios:  S/' +
                                element['totalServicio'];
                        }
                    });

                }
            })
        }

        function detalleProductos_fecha() {
            var fecha = document.getElementById('fecha').value;
            $('<form action="detallesFechasProductos" method="GET"/>')
                .append($('<input type="hidden" name="fecha" value="' + fecha + '">'))
                .appendTo($(document.body))
                .submit();
        }

        function detalleServicios_fecha() {
            var fecha = document.getElementById('fecha').value;
            $('<form action="detallesFechasServicios" method="GET"/>')
                .append($('<input type="hidden" name="fecha" value="' + fecha + '">'))
                .appendTo($(document.body))
                .submit();
        }

        function detallePagos_fecha() {
            var fecha = document.getElementById('fecha').value;
            $('<form action="detalleFechaPagos" method="GET"/>')
                .append($('<input type="hidden" name="fecha" value="' + fecha + '">'))
                .appendTo($(document.body))
                .submit();
        }

        function detalleProductos_mesAño() {
            var selectMes = document.getElementById('mes');
            var mesSeleccionado = selectMes.options[selectMes
                    .selectedIndex]
                .value;

            var selectAño = document.getElementById('año');
            var añoSeleccionado = selectAño.options[selectAño
                    .selectedIndex]
                .value;

            $('<form action="detallesMesAñoProductos" method="GET"/>')
                .append($('<input type="hidden" name="mes" value="' + mesSeleccionado + '">'))
                .append($('<input type="hidden" name="año" value="' + añoSeleccionado + '">'))
                .appendTo($(document.body))
                .submit();
        }

        function detalleServicios_mesAño() {
            var selectMes = document.getElementById('mes');
            var mesSeleccionado = selectMes.options[selectMes
                    .selectedIndex]
                .value;

            var selectAño = document.getElementById('año');
            var añoSeleccionado = selectAño.options[selectAño
                    .selectedIndex]
                .value;

            $('<form action="detallesMesAñoServicios" method="GET"/>')
                .append($('<input type="hidden" name="mes" value="' + mesSeleccionado + '">'))
                .append($('<input type="hidden" name="año" value="' + añoSeleccionado + '">'))
                .appendTo($(document.body))
                .submit();
        }

        function detallePagos_mesAño() {
            var selectMes = document.getElementById('mes');
            var mesSeleccionado = selectMes.options[selectMes
                    .selectedIndex]
                .value;

            var selectAño = document.getElementById('año');
            var añoSeleccionado = selectAño.options[selectAño
                    .selectedIndex]
                .value;

            $('<form action="detallesMesAñoPagos" method="GET"/>')
                .append($('<input type="hidden" name="mes" value="' + mesSeleccionado + '">'))
                .append($('<input type="hidden" name="año" value="' + añoSeleccionado + '">'))
                .appendTo($(document.body))
                .submit();
        }
    </script>
@endsection
@endsection
