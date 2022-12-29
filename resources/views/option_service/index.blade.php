@extends('adminlte::page')
@section('title', 'OPCIONES DE SERVICIOS')


@section('css')
    <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script>
        function copiar() {
            document.getElementById("valor_total").value = document.getElementById("cantidad").value * document
                .getElementById("valor_unitario").value;
        }

        //document.getElementById('select_service').addEventListener('change', habilitar);
        function habilitar(services) {

            var id = document.getElementById("select_service").value;
            console.log(id);

            $.ajax({
                type: "GET",
                url: "../accederDatosService" + id,
                success: function(response) {
                    var response = JSON.parse(response);
                    console.log(response['devolucion']);


                    document.getElementById('stock').disabled = false;
                    document.getElementById('stock').removeAttribute("placeholder");

                    if (response['devolucion'] === "off") {
                        document.getElementById('stock').disabled = true;
                        document.getElementById('stock').setAttribute("placeholder", "No requerido");
                    } else {
                        document.getElementById('stock').disabled = false;
                        document.getElementById('stock').removeAttribute("placeholder");
                    }
                }
            });
        }
    </script>
@endsection
<style>
    label.error {
        color: red;
        font-size: 0.8em;
    }

    .rojito {
        color: red;
        font-weight: 500;
    }
</style>

@section('content')
    <div class="p-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white"style="background-color:#004173">
                        Opciones de servicios
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-left ">
                                        @can('option_services')
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#agregarServicio">
                                                Agregar Opción de Servicio
                                            </button>
                                        @endcan

                                        <a href="{{ route('option_services.pdf') }}" target="_blank"
                                            class="btn btn-success">Exportar PDF</a>
                                    </div>

                                    <div class="float-right ">
                                        @can('option_services.create_buys')
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#agregarCompraServicio">
                                                Agregar Compras
                                            </button>
                                        @endcan

                                        <a href="{{ route('vercompras_servicios') }}" class="btn btn-success">Ver
                                            Compras</a>

                                        <!--<button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#verComprasServicio">
                                                    Ver Compras
                                                </button>-->

                                        @can('recepcionEntrega')
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#recepcionEntrega">
                                                Recepción de Servicios post Entrega
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    @if (session('create'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            {{ Session::get('create') }}
                        </div>
                    @elseif (session('update'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            {{ Session::get('update') }}
                        </div>
                    @elseif (session('delete'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            {{ Session::get('delete') }}
                        </div>
                    @endif


                    <div class="card-body">
                        <table class="table" id="data">
                            <thead>
                                <tr align="center">
                                    <th width=20% scope="col">Nombre</th>
                                    <th width=25% scope="col">Descripción</th>
                                    <th width=20% scope="col">Categoría</th>
                                    <th width=10% scope="col">Valor</th>
                                    <th width=5% scope="col">Stock</th>
                                    <th width=10% scope="col">Devolución</th>
                                    @can('option_services')
                                        <th width=10%></th>
                                    @endcan
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($option_services as $option_service)
                                    <tr>
                                        <td align="left">{{ $option_service->nombre }}</td>
                                        <td align="left">{{ $option_service->descripcion }}</td>

                                        @foreach ($services as $service)
                                            @if ($option_service->id_services == $service->id)
                                                <td align="left">{{ $service->nombre }}</td>
                                            @endif
                                        @endforeach

                                        <td align="center">S/. {{ $option_service->valor }}</td>

                                        @if (is_null($option_service->stock))
                                            <td align="center">0</td>
                                        @else
                                            <td align="center">{{ $option_service->stock }}</td>
                                        @endif

                                        @foreach ($services as $service)
                                            @if ($option_service->id_services == $service->id)
                                                <?php
                                                $dev = $service->devolucion;
                                                ?>

                                                @if ($dev === 'on')
                                                    <td align="center">Si</td>
                                                @else
                                                    <td align="center">No</td>
                                                @endif
                                            @endif
                                        @endforeach

                                        @can('option_services')
                                            <td align="center">
                                                <form action="{{ route('option_services.destroy', $option_service) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    @can('option_services')
                                                        <button type="submit" class="btn btn-outline-danger"
                                                            onclick="return confirm('¿Desea eliminar?')">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    @endcan

                                                    @can('option_services')
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#actualizar{{ $option_service->id }}"
                                                            class="btn btn-outline-success">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                </form>

                                                <!-- Modal para editar Servicio -->
                                                <div class="modal fade" id="actualizar{{ $option_service->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-m">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar Opción de
                                                                    Servicio</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                            </div>

                                                            <div class="modal-body">

                                                                <form class="row g-3 "
                                                                    action="{{ route('option_services.update', $option_service->id) }}"
                                                                    method="POST"
                                                                    id="formOptionService-editar{{ $option_service->id }}">
                                                                    @method('PUT')
                                                                    @csrf

                                                                    <div class="col-12 mt-2">
                                                                        <label for="disabledTextInput"
                                                                            class="form-label">Nombre <span
                                                                                class="rojito">(*)</span></label>
                                                                        <input type="text" 
                                                                            class="form-control" name="nombre"
                                                                            value='{{ $option_service->nombre }}'>
                                                                    </div>

                                                                    <div class="col-6 mt-2">
                                                                        <label for="disabledTextInput"
                                                                            class="form-label">Valor <span
                                                                                class="rojito">(*)</span></label>
                                                                        <input type="number" min="0" step="0.01"
                                                                            class="form-control"
                                                                            name="valor"
                                                                            value='{{ $option_service->valor }}'>
                                                                    </div>

                                                                    @foreach ($services as $service)
                                                                        @if ($option_service->id_services == $service->id)
                                                                            <?php
                                                                            $dev = $service->devolucion;
                                                                            ?>

                                                                            @if ($dev === 'off')
                                                                                <div class="col-6 mt-2">
                                                                                    <label for="disabledTextInput"
                                                                                        class="form-label">Stock </label>
                                                                                    <input type="number" min="1"
                                                                                        step="1" 
                                                                                        class="form-control" name="stock"
                                                                                        placeholder="No requerido"
                                                                                        value="" readonly>
                                                                                </div>
                                                                            @else
                                                                                <div class="col-6 mt-2">
                                                                                    <label for="disabledTextInput"
                                                                                        class="form-label">Stock <span
                                                                                            class="rojito">(*)</span></label>
                                                                                    <input type="number" min="0"
                                                                                        step="1" 
                                                                                        class="form-control" name="stock"
                                                                                        value='{{ $option_service->stock }}'>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach

                                                                    <div class="col-12 mt-2">
                                                                        <label for="disabledTextInput"
                                                                            class="form-label">Descripción <span
                                                                                class="rojito">(*)</span></label>
                                                                     

                                                                        <textarea class="form-control" rows="5" placeholder="Agregue la descripción de la compra..."
                                                                        name="descripcion" id="floatingTextarea"> {{ $option_service->descripcion }}</textarea>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger"
                                                                            data-bs-dismiss="modal">Cancelar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-success">Actualizar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal para agregar Servicio-->
                    <div class="modal fade" id="agregarServicio" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-m">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Opción de Servicio</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>

                                <div class="modal-body">
                                    <form class="row g-3 " action="{{ route('option_services.store') }}" method="POST"
                                        id="formOptionService">
                                        @csrf

                                        <div class="col-12 mt-2">
                                            <label for="inputEmail4" class="form-label">Categoría de servicios <span
                                                    class="rojito">(*)</span></label>
                                            <select class="custom-select" id="select_service" name='cat_servicio'
                                                onchange="habilitar()">
                                                <option selected>-Seleccione-</option>

                                                @foreach ($services as $service)
                                                    <option value="{{ $service['id'] }}">{{ $service['nombre'] }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="col-12 mt-2">
                                            <label for="disabledTextInput" class="form-label">Nombre <span
                                                    class="rojito">(*)</span></label>
                                            <input type="text" class="form-control" name="nombre">
                                        </div>

                                        <div class="col-6 mt-2">
                                            <label for="disabledTextInput" class="form-label">Valor <span
                                                    class="rojito">(*)</span></label>
                                            <input type="number" min="0" step="0.01" class="form-control"
                                                name="valor">
                                        </div>

                                        <div class="col-6 mt-2">
                                            <label for="disabledTextInput" class="form-label" align="left">Stock <span
                                                    class="rojito">(*)</span></label>
                                            <input type="number" min="1" step="1" id="stock"
                                                class="form-control" name="stock">
                                        </div>

                                        <div class="col-12 mt-2">
                                            <label for="disabledTextInput" class="form-label">Descripción <span
                                                    class="rojito">(*)</span></label>
                                            <textarea class="form-control" rows="5" placeholder="Agregue la descripción de la compra..."
                                                name="descripcion" id="floatingTextarea"></textarea>
                                        </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                    <button type="reset" class="btn btn-secondary">Limpiar formulario</button>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>


                    <!-- Modal para agregar Compra de Servicios -->
                    <div class="modal fade" id="agregarCompraServicio" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ingresar Compra</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>

                                <div class="modal-body">
                                    <form class="row g-3 " action="{{ route('option_services.create_buys') }}"
                                        method="POST" id="formService-compra">
                                        @csrf


                                        <div class="col-6 mt-2">
                                            <label for="inputEmail4" class="form-label">Opciones de Servicios <span
                                                class="rojito">(*)</span></label>
                                            <select class="custom-select" name='servicio'>
                                                <option selected>Seleccione</option>

                                                @foreach ($option_services as $option_service)
                                                    <option value="{{ $option_service['id'] }}">
                                                        {{ $option_service['nombre'] }}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-6 mt-2">
                                            <label for="inputEmail4" class="form-label">Proveedores <span
                                                class="rojito">(*)</span></label>
                                            <select class="custom-select" name='proveedor'>
                                                <option selected>Seleccione</option>

                                                @foreach ($providers as $provider)
                                                    <option value="{{ $provider['id'] }}">{{ $provider['razon_social'] }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-6 mt-2">
                                            <label for="disabledTextInput" class="form-label">Cantidad <span
                                                class="rojito">(*)</span></label>
                                            <input type="number" min="1" step="1" id="cantidad"
                                                class="form-control" name="cantidad">
                                        </div>



                                        <div class="col-6 mt-2">
                                            <label for="disabledTextInput" class="form-label">Valor Unitario <span
                                                class="rojito">(*)</span></label>
                                            <input type="number" min="1" step="0.01" id="valor_unitario"
                                                class="form-control" name="valor_unitario" oninput="copiar()">
                                        </div>

                                        <div class="col-6 mt-2">
                                            <label for="disabledTextInput" class="form-label">Valor Total <span
                                                class="rojito">(*)</span></label>
                                            <input type="number" min="1" step="0.01" id="valor_total"
                                                class="form-control" name="valor_total">
                                        </div>

                                        <div class="col-6 mt-2">
                                            <label for="inputEmail4" class="form-label">Boleta/Factura <span
                                                class="rojito">(*)</span></label>
                                            <select class="custom-select" name='boletaFactura'>
                                                <option selected>Seleccione</option>
                                                <option value="Boleta">Boleta</option>
                                                <option value="Factura">Factura</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <label for="disabledTextInput" class="form-label">N° de comprobante <span
                                                class="rojito">(*)</span></label>
                                            <input type="text" id="disabledTextInput" class="form-control"
                                                name="n_comprobante">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <label for="inputEmail4" class="form-label">Fecha <span
                                                class="rojito">(*)</span></label>
                                            <input type="date" class="form-control" name='fecha_compra'
                                                value="{{ $now->format('Y-m-d') }}">
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                    <button type="reset" class="btn btn-secondary">Limpiar formulario</button>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>

    
                

                    <!-- Modal para recepcionar Servicio de entrega de beneficio -->
                    <div class="modal fade" id="recepcionEntrega" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xs">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Recepción de Servicios Entregados</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>

                                <div class="modal-body">
                                    <form class="row g-3 " action="{{ route('recepcionEntrega') }}" method="POST">
                                        @csrf

                                        <div class="col-12 mt-2">
                                            <label for="disabledTextInput" class="form-label">Código de entrega de
                                                beneficio: </label>
                                            <select class="custom-select" id="" name='codigoEntrega'>
                                                <option selected>-Seleccione-</option>

                                                @foreach ($benefit_deliveries as $benefit_delivery)
                                                    @if ($benefit_delivery->estado == 'Entrega pendiente')
                                                        <option value="{{ $benefit_delivery['id'] }}">
                                                            {{ $benefit_delivery['id'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            jQuery.extend(jQuery.validator.messages, {
                required: "Este campo es obligatorio.",
                remote: "Por favor, rellena este campo.",
                email: "Por favor, escribe una dirección de correo válida",
                date: "Por favor, escribe una fecha válida.",
                number: "Por favor, escribe un número entero válido.",
                digits: "Por favor, escribe sólo dígitos.",

            });

            var nrows = 0;
            $("table tr").each(function() {
                nrows++;
            })

            $("#formOptionService").validate({
                rules: {
                    nombre: {
                        required: true,
                    },
                    valor: {
                        required: true,
                    },
                    stock: {
                        required: true,
                    },
                    descripcion: {
                        required: true
                    }


                },

            });

            $("#formService-compra").validate({
                rules: {
                    valor_unitario: {
                        required: true,
                    },
                    cantidad: {
                        required: true,
                    },
                    valor_total: {
                        required: true,
                    },
                    n_comprobante: {
                        required: true
                    }


                },

            });


            for (var i = 1; i <= nrows + 5; i++) {
                $("#formOptionService-editar" + i).validate({
                    rules: {
                        nombre: {
                            required: true,
                        },
                        valor: {
                            required: true,
                        },
                        
                        descripcion: {
                            required: true
                        }

                    },
                });
                console.log(nrows);
            }



        });
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
