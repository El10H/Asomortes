@extends('adminlte::page')
@section('title', 'Entregas de beneficio')


@section('css')
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
                    <div class="card-header  text-white" style="background-color:#004173">
                        Entregas de beneficio
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">

                                    <a href="{{ route('providers.pdf') }}" target="_blank" class="btn btn-success">Exportar PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                
               

              
                    <div class="card-body">
                        <table class="table table-striped" style="width:100%" id="data">
                            <thead>
                                <tr align="center">
                                    <th width= 10% scope="col">Código</th>
                                    <th width= 35% scope="col">Socio fallecido</th>
                                    <th width= 35% scope="col">Tipo de beneficio</th>
                                    <th width= 20% scope="col">Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach ($ultimasEntregas as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->nombre}} {{$item->apellido_paterno}} {{$item->apellido_materno}}</td>
                                    <td>{{$item->tipo_beneficio}}</td>
                                    <td>{{$item->estado}}</td>
                                </tr>
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
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "zeroRecords": "Nada encontrado - disculpa",
                        "info": "Mostrando la página _PAGE_ de _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtrado de _MAX_ registros totales)",
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