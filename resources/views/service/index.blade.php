@extends('adminlte::page')
@section('title', 'SERVICIOS')


@section('css')
    <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
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
                    <div class="card-header text-white" style="background-color:#004173">
                        Servicios
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-left ">
                                        @can('services')
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#agregarServicio">
                                                Agregar Servicio
                                            </button>
                                        @endcan

                                        <a href="{{ route('services.pdf') }}" target="_blank"
                                            class="btn btn-success">Exportar PDF</a>
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
                                    <th width=35% scope="col">Nombre</th>
                                    <th width=35% scope="col">Descripción</th>
                                    <th width=10% scope="col">Devolución</th>
                                    @can('services')
                                        <th width=20%></th>
                                    @endcan
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td align="left">{{ $service->nombre }}</td>
                                        <td align="left">{{ $service->descripcion }}</td>
                                        <?php
                                        $dev = $service->devolucion;
                                        ?>

                                        @if ($dev === 'on')
                                            <td align="center">Si</td>
                                        @else
                                            <td align="center">No</td>
                                        @endif


                                        @can('services')
                                            <td align="center">
                                                <form action="{{ route('services.destroy', $service) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf

                                                    @can('services')
                                                        <button type="submit" class="btn btn-outline-danger"
                                                            onclick="return confirm('¿Desea eliminar?')">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    @endcan

                                                    @can('services')
                                                        <a data-bs-toggle="modal" data-bs-target="#actualizar{{ $service->id }}"
                                                            class="btn btn-outline-success">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                </form>

                                                <!-- Modal para editar Servicio -->
                                                <div class="modal fade" id="actualizar{{ $service->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-m ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar
                                                                    Servicio</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                            </div>

                                                            <div class="modal-body">

                                                                <form class="row g-3 "
                                                                    action="{{ route('services.update', $service->id) }}"
                                                                    method="POST" id="formService-editar{{ $service->id }}">
                                                                    @method('PUT')
                                                                    @csrf

                                                                    <div class="col-12 ">
                                                                        <label for="disabledTextInput" class="form-label">Nombre
                                                                            <span class="rojito">(*)</span></label>
                                                                        <input type="text" id="disabledTextInput"
                                                                            class="form-control" name="nombre"
                                                                            value='{{ $service->nombre }}'>
                                                                    </div>

                                                                    <div class="col-12 mt-2">
                                                                        <label for="disabledTextInput"
                                                                            class="form-label">Descripción <span
                                                                                class="rojito">(*)</span></label>
                                                                        <textarea class="form-control" name="descripcion" id="floatingTextarea">{{ $service->descripcion }}
                                                                        </textarea>
                                                                    </div>


                                                                    <?php
                                                                    $dev = $service->devolucion;
                                                                    ?>

                                                                    @if ($dev === 'on')
                                                                        <div class="col-12 ml-2 form-check">
                                                                            <input type="checkbox" checked
                                                                                class="form-check-input" name="devolucion"
                                                                                id="exampleCheck1">
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">El servicio será
                                                                                devuelto</label>
                                                                        </div>
                                                                    @else
                                                                        <div class="mb-3 ml-2 form-check">
                                                                            <input type="checkbox" class="form-check-input"
                                                                                name="devolucion" id="exampleCheck1">
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">El servicio será
                                                                                devuelto</label>
                                                                        </div>
                                                                    @endif

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
                                            </td>
                                        @endcan

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal para agregar Servicio -->
                    <div class="modal fade" id="agregarServicio" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-m">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Servicio</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>

                                <div class="modal-body">
                                    <form class="row g-3 " action="{{ route('services.store') }}" method="POST"
                                        id="formService">
                                        @csrf
                                        <div class="col-12 mt-2">
                                            <label for="disabledTextInput" class="form-label">Nombre <span
                                                    class="rojito">(*)</span></label>
                                            <input type="text" id="disabledTextInput" class="form-control"
                                                name="nombre">
                                        </div>

                                        <div class="col-12 mt-2">
                                            <label for="disabledTextInput" class="form-label">Descripción <span
                                                    class="rojito">(*)</span></label>
                                            <textarea class="form-control" placeholder="Agregue una descripción del servicio..." name="descripcion"
                                                id="floatingTextarea">
                                            </textarea>
                                        </div>

                                        <div class="mb-3 ml-2 form-check">
                                            <input type="checkbox" class="form-check-input" name="devolucion"
                                                id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">El servicio será
                                                devuelto</label>
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

            $("#formService").validate({
                rules: {
                    nombre: {
                        required: true,
                    },
                    descripcion: {
                        required: true,
                    },

                },

            });


            for (var i = 1; i <= nrows + 5; i++) {
                $("#formService-editar" + i).validate({
                    rules: {
                        nombre: {
                            required: true,
                        },
                        descripcion: {
                            required: true,

                        },
                    },
                });
            }
            console.log(nrows);

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
