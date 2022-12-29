@extends('adminlte::page')
@section('title', 'PROVEEDORES')

@section('css')
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
                    <div class="card-header  text-white" style="background-color:#004173">
                        Proveedores
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">

                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#agregarProveedor">
                                        Agregar Proveedor
                                    </button>


                                    <a href="{{ route('providers.pdf') }}" target="_blank" class="btn btn-success">Exportar
                                        PDF</a>
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
                        <table class="table table-striped" style="width:100%" id="data">
                            <thead>
                                <tr align="center">
                                    <th width=25% scope="col">Razón Social</th>
                                    <th width=25% scope="col">Dirección</th>
                                    <th width=10% scope="col">Ruc</th>
                                    <th width=10% scope="col">Teléfono</th>
                                    <th width=15% scope="col">Email</th>
                                    <th width=10%></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($providers as $provider)
                                    <tr>
                                        <td align="left">{{ $provider->razon_social }}</td>
                                        <td align="left">{{ $provider->direccion }}</td>
                                        <td align="center">{{ $provider->ruc }}</td>
                                        <td align="center">{{ $provider->telefono }}</td>
                                        <td align="left">{{ $provider->email }}</td>


                                        <td>
                                            <form action="{{ route('providers.destroy', $provider) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                @can('providers')
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        onclick="return confirm('¿Desea eliminar?')">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                @endcan

                                                @can('providers')
                                                    <a data-bs-toggle="modal" data-bs-target="#actualizar{{ $provider->id }}"
                                                        class="btn btn-outline-success">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                @endcan
                                            </form>

                                            <!-- Modal para editar Proveedor -->
                                            <div class="modal fade" id="actualizar{{ $provider->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-xl ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Editar
                                                                Proveedor</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close"> <span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <form class="row g-3 "
                                                                action="{{ route('providers.update', $provider->id) }}"
                                                                method="POST"
                                                                id="formProveedor-editar{{ $provider->id }}">
                                                                @method('PUT')
                                                                @csrf

                                                                <div class="col-12 ">
                                                                    <label class="form-label">Razon Social <span
                                                                        class="rojito">(*)</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="razon_social"
                                                                        value='{{ $provider->razon_social }}'>
                                                                </div>

                                                                <div class="col-6 mt-2">
                                                                    <label class="form-label">Ruc <span
                                                                        class="rojito">(*)</span></label>
                                                                    <input type="number" min="1" step="0.01"
                                                                        class="form-control" name="ruc"
                                                                        value='{{ $provider->ruc }}'>
                                                                </div>

                                                                <div class="col-6 mt-2">
                                                                    <label class="form-label">Dirección <span
                                                                        class="rojito">(*)</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="direccion"
                                                                        value='{{ $provider->direccion }}'>
                                                                </div>

                                                                <div class="col-6 mt-2">
                                                                    <label class="form-label">Telefono <span
                                                                        class="rojito">(*)</span></label>
                                                                    <input type="number" min="1" step="1"
                                                                        class="form-control" name="telefono"
                                                                        value='{{ $provider->telefono }}'>
                                                                </div>

                                                                <div class="col-6 mt-2">
                                                                    <label class="form-label">Email <span
                                                                        class="rojito">(*)</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="email" value='{{ $provider->email }}'>
                                                                </div>

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

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <!-- Modal para agregar Proveedor -->
                    <div class="modal fade" id="agregarProveedor" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Proveedor</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>

                                <div class="modal-body">
                                    <form class="row g-3 " action="{{ route('providers.store') }}" method="POST"
                                        id="formProveedor">
                                        @csrf

                                        <div class="col-12 ">
                                            <label class="form-label">Razon Social <span
                                                class="rojito">(*)</span></label>
                                            <input type="text" class="form-control" name="razon_social">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <label class="form-label">Ruc <span
                                                class="rojito">(*)</span></label>
                                            <input type="text" class="form-control" name="ruc">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <label class="form-label">Dirección <span
                                                class="rojito">(*)</span></label>
                                            <input type="text" class="form-control" name="direccion">
                                        </div>

                                        <div class="col-6 mt-2">
                                            <label class="form-label">Telefono <span
                                                class="rojito">(*)</span></label>
                                            <input type="text" class="form-control" name="telefono">
                                        </div>

                                        <div class="col-6 mt-2">
                                            <label class="form-label">Email <span
                                                class="rojito">(*)</span></label>
                                            <input type="text" class="form-control" name="email">
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
            $.validator.addMethod("soloNumeros", function(value, element) {
                var pattern = /^([0-9]{9,9})$/;
                return this.optional(element) || pattern.test(value);
            }, "Ingrese un número válido de 9 dígitos");

            $.validator.addMethod("ruc", function(value, element) {
                var pattern = /^([0-9]{11,11})$/;
                return this.optional(element) || pattern.test(value);
            }, "Ingrese un RUC válido");


            var nrows = 0;
            $("table tr").each(function() {
                nrows++;
            })

            $("#formProveedor").validate({
                rules: {
                    razon_social: {
                        required: true,
                    },
                    ruc: {
                        required: true,
                        ruc: true 
                    },
                    direccion: {
                        required: true,
                    },
                    telefono: {
                        required: true,
                        soloNumeros: true
                    },
                    email: {
                        required: true,
                        email: true 
                    }
                },

            });


            for (var i = 1; i <= nrows+5; i++) {
                $("#formProveedor-editar" + i).validate({
                    rules: {
                        razon_social: {
                        required: true,
                    },
                    ruc: {
                        required: true,
                        ruc: true 
                    },
                    direccion: {
                        required: true,
                    },
                    telefono: {
                        required: true,
                        soloNumeros: true
                    },
                    email: {
                        required: true,
                        email: true 
                    }

                    },
                });
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
