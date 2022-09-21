@extends('adminlte::page')
@section('title', 'CONFIGURACIÓN')


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
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
                    <div class="card-header bg-dark text-white">
                        Datos de configuración
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">

                                    <form action="{{route('datosConfigUpdate')}}" method="post">
                                        @csrf

                                        @foreach ($datos as $item)
                                        <div class="col-4 mt-3">
                                            <label for="form-label">Monto de {{$item->descripcion}}</label>
                                            <input type="text" class="form-control" value="{{ $item->monto }}" name="{{$item->descripcion}}">
                                        </div>

                                        @endforeach
                                       

                                        <div class="col-4 mt-3">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>






                    <div class="card-body">

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