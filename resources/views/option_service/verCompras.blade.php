@extends('adminlte::page')
@section('title', 'Compras de servicios')


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
                        Compras de servicios
                        <div>
                            <span id="hola2"></span>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="card">
                               
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <table class="table table-striped" style="width:100%" id="data">
                            <thead>
                                <tr align="center">

                                    <th scope="col">Servicio</th>
                                    <th scope="col">Proveedor</th>
                                    <th scope="col">Comprobante</th>
                                    <th scope="col">N° Comprobante</th>
                                    <th scope="col">Fecha de compra</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Valor unitario</th>
                                    <th scope="col">Valor total</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buys_services as $buys_service)
                                    <tr>
                                        @foreach ($option_services as $option_service)
                                            @if ($buys_service->id_services == $option_service->id)
                                                <td align="left">{{ $option_service->nombre }}</td>
                                            @endif
                                        @endforeach

                                        @foreach ($providers as $provider)
                                            @if ($buys_service->id_providers == $provider->id)
                                                <td align="left">{{ $provider->razon_social }}</td>
                                            @endif
                                        @endforeach

                                        <td align="left">{{ $buys_service->boletaFactura }}</td>
                                        <td align="left"><b>{{ $buys_service->n_comprobante }}</b></td>
                                        <td align="center">{{ $buys_service->fecha_compra }}</td>
                                        <td align="center">{{ $buys_service->cantidad }}</td>
                                        <td align="center">{{ $buys_service->valor_unitario }}</td>
                                        <td align="center">{{ $buys_service->valor_total }}</td>                                          
                                        <td align="left">{{ $buys_service->estado }}</td>

                                        @can('buys_services.anular')
                                            <td>
                                                <form action="{{ route('buys_services.anular', $buys_service->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        onclick="return confirm ('¿Desea anular el comprobante {{ $buys_service->n_comprobante }}?')">
                                                        <i class="fas fa-trash "></i>
                                                    </button>
                                                </form>
                                                
                                            </td>
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
                "order": [
                    [0, "desc"]
                ],
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