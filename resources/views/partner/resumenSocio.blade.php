@extends('adminlte::page')
@section('title', 'SOCIOS')


@section('css')
@section('css')
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
                <div class="card-header bg-dark text-white">
                    Resumen Socio
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">

                                    <form class="form-inline ml-3">
                                        <div class="d-flex">
                                            <div>
                                                <input type="search" class="form-control mr-2"
                                                    placeholder="Nombre del socio" id="buscador" name="search">
                                            </div>

                                            <div class="input-group-append">
                                                <input type="button" value="Buscar" id="principal"
                                                    onclick="llenarDatos()" class="btn btn-success">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pr-5 pl-5">

                        <div class="card ">
                            <div class="card-header">
                                Información del Socio
                            </div>
                            <div class="card-body">
                                <div class="col-12 d-flex">
                                    <div class="col-md-12 mt-2">
                                        <label for="" class="form-label">Nombre Completo:</label>
                                        <input type="text" class="form-control" id="nombre" value="">
                                    </div>
                                </div>

                                <div class="col-12 d-flex">
                                    <div class="col-md-4 mt-2">
                                        <label for="" class="form-label">Carne:</label>
                                        <input type="text" class="form-control" id="carne" value="">
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label for="" class="form-label">Dni:</label>
                                        <input type="text" class="form-control" id="dni" value="">
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label for="" class="form-label">Fecha de ingreso:</label>
                                        <input type="text" class="form-control" id="ingreso" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                Información del Beneficiario
                            </div>
                            <div class="card-body">

                                <div class="col-12 d-flex">
                                    <div class="col-md-6 mt-2" id="nombreBeneficiario">

                                    </div>
                                    <div class="col-md-6 mt-2" id="dniBeneficiario">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card ">
                            <div class="card-header">
                                Información de Pagos
                            </div>
                            <div class="card-body">
                                <div class="col-12 d-flex">
                                    <div class="col-md-4 mt-2">
                                        <label for="" class="form-label">última boleta:</label>
                                        <input type="text" class="form-control" id="boleta" value="">
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label for="" class="form-label">Último mes pagado:</label>
                                        <input type="text" class="form-control" id="mes" value="">
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label for="" class="form-label">Estado:</label>
                                        <input type="text" class="form-control" id="estado" value="">
                                    </div>
                                </div>
                                <div class="col-6 d-flex">


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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $('#buscador').autocomplete({
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

        function llenarDatos() {
            eliminar();
            var nombreSocio = document.getElementById("buscador").value;
            var uri = encodeURI(nombreSocio);


            $.ajax({
                type: "GET",
                url: "../../resumenDatos" + uri,
                success: function(response) {

                    var arrayDatos = JSON.parse(response);
                    var datosSocio = arrayDatos[0];

                    var inputNombre = document.getElementById('nombre');
                    inputNombre.value = datosSocio.nombre + ' ' + datosSocio.apellido_paterno + ' ' + datosSocio
                        .apellido_materno
                    var inputDni = document.getElementById('dni');
                    inputDni.value = datosSocio.dni;
                    var inputCarne = document.getElementById('carne');
                    inputCarne.value = datosSocio.carne;

                    document.getElementById('ingreso').value = datosSocio.fecha_de_ingreso;


                    var datosBeneficiarios = arrayDatos[1];

                    var recorrerDatosBeneficiarios = datosBeneficiarios.map(function(Beneficiario) {

                        $('#nombreBeneficiario').append(
                            `<label id="labelNuevo" class="form-label mt-1">Nombre Completo</label> <input id="inputNuevo" class="form-control mt-1" value="${Beneficiario['nombres_apellidos']}">`
                        )
                        $('#dniBeneficiario').append(
                            `<label id="labeldninuevo" class="form-label mt-1">Dni</label> <input id="inputdninuevo" class="form-control mt-1" value="${Beneficiario['dni']} ">`
                        )

                    })
                    var datosBoleta = arrayDatos[2];
                    var datosMes = arrayDatos[3];
             
                    if (datosBoleta.length > 0) {
                        var inputBoleta = document.getElementById('boleta');
                        var recorrerDatosBoleta = datosBoleta.map(function(bol) {
                            inputBoleta.value = '000' + bol['id'];
                        });
                        document.getElementById('mes').value = datosMes.mes + ' ' + datosMes.año;
                    }

                    if(datosBoleta.length == 0){
                        var inputBoleta = document.getElementById('boleta');
                        inputBoleta.value='';

                        var inputMes = document.getElementById('mes');
                        inputMes.value='';
                    }

                    var estado=document.getElementById('estado');
                    estado.value=arrayDatos[4];

                    limpiarBuscador();
                    //eliminar2();
                }

            })

            function eliminar() {
                document.getElementById('nombreBeneficiario').innerHTML = ' ';
                document.getElementById('dniBeneficiario').innerHTML = ' ';
            }

            function limpiarBuscador() {
                document.getElementById('buscador').value = "";
            }

            function eliminar2() {
                document.getElementById('mes').innerHTML = ' ';
                document.getElementById('estado').innerHTML = ' ';
                document.getElementById('boleta').innerHTML = ' ';
            }


        }
    </script>
@endsection
@endsection