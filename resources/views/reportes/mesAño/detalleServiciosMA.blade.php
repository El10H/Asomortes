@extends('adminlte::page')
@section('title', 'ENTREGA DE BENEFICIOS')


@section('css')
    <script src="{{ asset('js/provinciasActual.js') }}"></script>
    <script src="{{ asset('js/provinciasNac.js') }}"></script>


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
                        Detalle compras
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Compras de servicios realizadas en: {{$mes}} del {{$año}}</h5>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-striped " id="data">
                                        <thead class="">
                                            <tr align="center">
                                                <th scope="col">Servicio</th>
                                                <th scope="col">Proveedor</th>
                                                <th scope="col">Comprobante</th>
                                                <th scope="col">N° Comprobante</th>
                                                <th scope="col">Fecha de compra</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Valor unitario</th>
                                                <th scope="col">Valor total</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($compras as $buys_service)
                                                <tr>
                                                    @foreach ($services as $option_service)
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
                                                    <td align="left">{{ $buys_service->n_comprobante }}</td>
                                                    <td align="center">{{ $buys_service->fecha_compra }}</td>
                                                    <td align="center">{{ $buys_service->cantidad }}</td>
                                                    <td align="center">{{ $buys_service->valor_unitario }}</td>
                                                    <td align="center">{{ $buys_service->valor_total }}</td>
                                                    
                                                
                                                </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            var table;
            if (!$.fn.DataTable.isDataTable('#data')) {
                table = $('#data').DataTable({
                    "order": [
                        [1, "desc"]
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



        })
    </script>

@endsection

@endsection
