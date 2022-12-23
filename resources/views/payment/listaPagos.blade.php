@extends('adminlte::page')
@section('title', 'LISTA DE PAGOS')


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
                        Pagos realizados
                    </div>

                    @can('payment')
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">

                                        <a href="{{ route('payments.index') }}" class="btn btn-success">Registrar Pago</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan



                    <div class="card-body">

                        <div class="card mt-3 mb-5">
                            <div class="card-header">
                                Filtros de busqueda
                            </div>
                            
                            <div class="card-body">
                                <div class="row">
                                    

                                    <div class="col-md-3">
                                        <label for="" class="form-label">Nombre Socio:</label>
                                    </div>


                                    <div class="col-md-3">
                                        <label for="" class="form-label">Número de Boleta:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="" class="form-label">Fecha de pago:</label>
                                    </div>

                                  

                                    
                                    
                                </div>
                                <div class="row mb-3">
                                    

                                    <div class="col-md-3">
                                        <input type="text" name="user" id="nombre" class="form-control "
                                            data-index="1" />
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" name="user" id="boleta" class="form-control "
                                            data-index="0" />
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <input type="date" name="user" id="fecha" class="form-control "
                                            data-index="4" />
                                    </div>
                                  
                                    

                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" style="width:100%" id="data">
                            <thead>
                                <tr>
                                    <th align="left" width=25% scope="col">N° Boleta</th>
                                    <th width=25% scope="col">Socio</th>
                                    <th width=10% scope="col">Carne</th>
                                    <th width=10% scope="col">Monto pagado</th>
                                    <th width=15% scope="col">Fecha de pago</th>
                                    <th width=15% scope="col">Ver detalles</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($pagos as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nombre . ' ' . $item->apellido_paterno . ' ' . $item->apellido_materno }}
                                        </td>
                                        <td>{{ $item->carne }}</td>
                                        <td>{{ $item->monto_total }}</td>
                                        <td>{{ $item->fecha_de_pago }}</td>
                                        <td><button class="btn btn-outline-success mostrar btn-sm" type="button"
                                                data-bs-toggle="modal"data-bs-target="#detalle"
                                                value="{{ $item->id }}">Ver detalles</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>




                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ver detalle de boleta -->

    <div class="modal fade" id="detalle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalle de boleta
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">

                    <table class="table" id="mostrarDetalles">
                        <thead>
                            <tr>
                            <tr>
                                <th>Mes/Inscripción</th>
                                <th>Año</th>
                                <th>Monto</th>

                            </tr>

                            </tr>
                        </thead>

                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>

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
                    "order": [[1, "desc" ]],
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

            $("#nombre").keyup(function() {
                table.column($(this).data('index')).search(this.value).draw();
            })

            $("#boleta").keyup(function() {
                table.column($(this).data('index')).search(this.value).draw();
            })

            $("#fecha").keyup(function() {
                table.column($(this).data('index')).search(this.value).draw();
            })

            
        })

        $(document).on("click", ".mostrar", function() {
            eliminar();
            var id = $(this).val();

            console.log(id);
            $.ajax({
                type: 'GET',
                url: '../../detallePagos' + id,
                success: function(response) {

                    var arrays = JSON.parse(response);
                    console.log(arrays);
                    arrays.forEach(element => {
                        var tabla = document.getElementById("mostrarDetalles");
                        var fila = tabla.insertRow(-1);
                        fila.setAttribute('id', 'probando');

                        var celdaMes = fila.insertCell(0);
                        celdaMes.textContent = element['mes'];

                        var celdaAño = fila.insertCell(1);
                        celdaAño.textContent = element['año'];

                        var celdaMonto = fila.insertCell(2);
                        celdaMonto.textContent ='S/' + element['monto'];

                        
                    });
                }
            });
        });

        function eliminar() {
            $('#probando').remove();
            $('#probando').remove();
            $('#probando').remove();
            $('#probando').remove();
            $('#probando').remove();
            $('#probando').remove();
        }
    </script>
@endsection
@endsection
