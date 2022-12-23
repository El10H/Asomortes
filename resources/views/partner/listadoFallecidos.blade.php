@extends('adminlte::page')
@section('title', 'SOCIOS FALLECIDOS')


@section('css')
<link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="p-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white" style="background-color:#004173">
                        Socios Fallecidos
                    </div>
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{route('sociosFallecidos_pdf')}}" class="btn btn-success">Exportar PDF</a>   
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <table class="table table-striped" style="width:100%" id="data">
                            <thead>
                                <tr>

                                    <th scope="col">Dni</th>
                                    <th scope="col">Carne</th>
                                    <th scope="col">Nombres y Apellidos</th>
                                    <th scope="col">Fecha de fallecido</th>
                                    <th scope="col">Acta de defunción</th>
                                    <th scope="col">Certificado de defunción</th>
                                    
                                    <th></th>
                                  

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fallecidos as $item)
                                    <tr>
                                        <td>{{$item->dni}}</td>
                                        <td>{{$item->carne}}</td>
                                        <td>{{$item->nombre.' '.$item->apellido_paterno.' '.$item->apellido_materno}}</td>
                                        <td>18/08/24</td>
                                        <td><a href="{{url($item->acta)}}" class="btn btn-outline-secondary btn-sm">Ver acta</a> </td>
                                        <td><a href="{{url($item->certificado)}}" class="btn btn-outline-secondary btn-sm">Ver certificado</a> </td>
                                        
                                        @can('entrega')
                                            <td><a href="{{ route('entrega') }}" class="btn btn-primary ">Entregar beneficio</a></td>
                                        @endcan
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
