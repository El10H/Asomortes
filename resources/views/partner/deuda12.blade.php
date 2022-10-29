@extends('adminlte::page')
@section('title', 'SOCIOS')


@section('css')
    <script src="{{ asset('js/provinciasActual.js') }}"></script>

    <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

@endsection

@section('content')
    <div class="p-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white" style="background-color:#004173">
                        Socios con 1 año de deuda
                    </div>
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                   
                                    <a href="{{route('vistaSocioRetirado')}}" class="btn btn-danger">Lista de Socios Retirados</a>
                                </div>
                               
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <table class="table table-striped" style="width:100%" id="data">
                            <thead>
                                <tr>

                                    <th scope="col">Dni</th>
                                    <th scope="col">Nombres y Apellidos</th>
                                    <th scope="col">Carné</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Última Boleta </th>
                                    <th scope="col">Último mes de pago</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($socios as $socio)
                                    <tr>
                                        <td>{{ $socio->Dni }}</td>
                                        <td>{{ $socio->nombre . ' ' . $socio->apellido_paterno . ' ' . $socio->apellido_materno }}
                                        </td>
                                        <td>{{ $socio->carne }}</td>
                                        <td>{{ $socio->celular }}</td>
                                        <td>{{ $socio->email }}</td>


                                        @if ($boleta->partner_id == $socio->id)
                                            <td>{{ $boleta->id }}</td>
                                            @if ($mes->payment_id == $boleta->id)
                                                <td>{{ $mes->mes . ' ' . $mes->año }}</td>
                                            @endif
                                        @endif

                                        <td>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#retirar{{$socio->id}}" >
                                                Retirar socio
                                            </button>
                                        </td>

                                    </tr>

                                    <div class="modal fade" id="retirar{{$socio->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">MENSAJE DE CONFIRMACIÓN</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Desea retirar al socio <strong>{{$socio->nombre .' '.$socio->apellido_paterno .' '.$socio->apellido_materno}}</strong>  del sistema?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <a class="btn btn-danger" href="{{route('socioRetirado',$socio->id)}}">Retirar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    

@section('js')


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        if (!$.fn.DataTable.isDataTable('#data')) {
            $('#data').dataTable({
                "language": {
                    "lengthMenu": "Mostrar MENU registros por página",
                    "zeroRecords": "Nada encontrado - disculpa",
                    "info": "Mostrando la página PAGE de PAGES",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtrado de MAX registros totales)",
                    "search": "Buscar",
                    "paginate": {
                        'next': 'Siguiente',
                        'previous': 'anterior'
                    }
                }
            });
        }
    </script>

@endsection
@endsection