@extends('adminlte::page')
@section('title', 'SOCIOS')


@section('css')
    
    <script src="{{ asset('js/provinciasActual.js') }}"></script>
    <script src="{{ asset('js/provinciasNac.js') }}"></script>
    
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
                    <div class="card-header bg-dark text-white">
                        Panel de Socios - modificado


                    </div>
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">

                                    <button class="btn text-white btn-primary" type="button" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Agregar Socio
                                    </button>
                                    <a href="{{ route('partner.list') }}"  target="_blank" class="btn btn-success">Exportar PDF</a>
                                    <a href="{{ route('lista.fallecidos') }}" class="btn btn-danger">Socios Fallecidos</a>
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
                                    <th></th>


                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($partners as $partner)
                                    <tr>

                                        <td>{{ $partner->Dni }}</td>
                                        <td>{{ $partner->nombre . ' ' . $partner->apellido_paterno . ' ' . $partner->apellido_materno }}
                                        </td>
                                        <td>{{ $partner->carne }}</td>
                                        <td>{{ $partner->celular }}</td>
                                        <td>{{ $partner->email }}</td>
                                        <td>

                                            <form action="{{ route('partners.destroy', $partner) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger"
                                                    onclick="return confirm('¿Desea eliminar?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                                <a href="{{ route('partners.updateForm', ['id' => $partner->id]) }}"
                                                    class="btn btn-outline-success"><i class="far fa-edit"></i></a>
                                                <a href="{{ route('partner.file', ['id' => $partner->id]) }} "
                                                target="_blank" class="btn btn-outline-primary">
                                                    <i class="far fa-file"></i></a>
                                            </form>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal para agregar sOCIO -->

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Socio</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('partners.form') }}" method="POST">
                                        @csrf
                                        <div class="col-12 d-flex mt-3">
                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" name="nombre" id="nombre2"
                                                    value='{{ old('nombre') }}'>

                                            </div>
                                            <div class="col-4">
                                                <label for="inputPassword4" class="form-label">Apellido Paterno</label>
                                                <input type="text" class="form-control" name="apellido_paterno"
                                                    value='{{ old('apellido_paterno') }}'>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputPassword4" class="form-label">Apellido Materno </label>
                                                <input type="text" class="form-control" name='apellido_materno'
                                                    value='{{ old('apellido_materno') }}'>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex mt-3">
                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Carné</label>
                                                <input type="text" class="form-control" name='carne'
                                                    value='{{ old('carne') }}'>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Fecha de ingreso</label>
                                                <input type="date" class="form-control" name='fecha_de_ingreso'
                                                    value="{{ $now->format('Y-m-d') }}">
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Fecha de nacimiento</label>
                                                <input type="date" class="form-control" name='fecha_de_nac'
                                                    id="fecha_nac" value="{{ old('fecha_de_nac') }}">
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex mt-3">
                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Departamento de
                                                    Nacimiento</label>
                                                <select class="custom-select" name="dpto_nac" onchange="cambia2()"
                                                    required="">
                                                    <option value="">Seleccione</option>
                                                    <option value="Amazonas">Amazonas</option>
                                                    <option value="Ancash">Ancash</option>
                                                    <option value="Apurímac">Apurímac</option>
                                                    <option value="Arequipa">Arequipa</option>
                                                    <option value="Ayacucho">Ayacucho</option>
                                                    <option value="Cajamarca">Cajamarca</option>
                                                    <option value="Callao">Callao</option>
                                                    <option value="Cuzco">Cuzco </option>
                                                    <option value="Huancavelica">Huancavelica</option>
                                                    <option value="Huánuco">Huánuco</option>
                                                    <option value="Ica">Ica</option>
                                                    <option value="Junín">Junín</option>
                                                    <option value="La_Libertad">La Libertad</option>
                                                    <option value="Lambayeque">Lambayeque</option>
                                                    <option value="Lima">Lima</option>
                                                    <option value="Loreto">Loreto</option>
                                                    <option value="Madre_de_Dios">Madre de Dios</option>
                                                    <option value="Moquegua">Moquegua</option>
                                                    <option value="Pasco">Pasco</option>
                                                    <option value="Piura">Piura</option>
                                                    <option value="Puno">Puno</option>
                                                    <option value="San_Martín">San Martín</option>
                                                    <option value="Tacna">Tacna</option>
                                                    <option value="Tumbes">Tumbes</option>
                                                    <option value="Ucayali">Ucayali</option>
                                                </select>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Provincia de
                                                    Nacimiento</label>
                                                <select name="provincia_nac" onchange="cambiaDistrito2()" required=""
                                                    class="custom-select">

                                                </select>

                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Distrito de
                                                    Nacimiento</label>
                                                <select name="distrito_nac" required=""
                                                    class="custom-select"></select>

                                            </div>


                                        </div>


                                        <div class="col-12 d-flex mt-3">
                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Profesión</label>
                                                <input type="text" class="form-control" name='profesion'
                                                    value='{{ old('profesion') }}'>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Grado de Instrucción</label>
                                                <input type="text" class="form-control" name='grado_de_instruccion'
                                                    value='{{ old('grado_de_instruccion') }}'>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Actividad</label>
                                                <input type="text" class="form-control" name='actividad'
                                                    value='{{ old('actividad') }}'>
                                            </div>
                                        </div>


                                        <div class="col-12 d-flex mt-3">
                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Estado Civil</label>
                                                <select class="custom-select" name='estado_civil'>
                                                    <option selected>Seleccione</option>
                                                    <option value="soltero">Soltero</option>
                                                    <option value="casado">Casado</option>
                                                    <option value="divorciado">Divorciado</option>
                                                    <option value="viudo">Viudo</option>
                                                </select>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Dni</label>
                                                <input type="text" class="form-control" name='dni'
                                                    value='{{ old('dni') }}'>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Domicilio</label>
                                                <input type="text" class="form-control" name='domicilio'
                                                    value='{{ old('domicilio') }}'>
                                            </div>
                                        </div>


                                        <div class="col-12 d-flex mt-3">
                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Departamento actual</label>
                                                <select class="custom-select" name="dpto_actual" onchange="cambia()"
                                                    required="">
                                                    <option value="">Seleccione</option>
                                                    <option value="Amazonas">Amazonas</option>
                                                    <option value="Ancash">Ancash</option>
                                                    <option value="Apurímac">Apurímac</option>
                                                    <option value="Arequipa">Arequipa</option>
                                                    <option value="Ayacucho">Ayacucho</option>
                                                    <option value="Cajamarca">Cajamarca</option>
                                                    <option value="Callao">Callao</option>
                                                    <option value="Cuzco">Cuzco </option>
                                                    <option value="Huancavelica">Huancavelica</option>
                                                    <option value="Huánuco">Huánuco</option>
                                                    <option value="Ica">Ica</option>
                                                    <option value="Junín">Junín</option>
                                                    <option value="La_Libertad">La Libertad</option>
                                                    <option value="Lambayeque">Lambayeque</option>
                                                    <option value="Lima">Lima</option>
                                                    <option value="Loreto">Loreto</option>
                                                    <option value="Madre_de_Dios">Madre de Dios</option>
                                                    <option value="Moquegua">Moquegua</option>
                                                    <option value="Pasco">Pasco</option>
                                                    <option value="Piura">Piura</option>
                                                    <option value="Puno">Puno</option>
                                                    <option value="San_Martín">San Martín</option>
                                                    <option value="Tacna">Tacna</option>
                                                    <option value="Tumbes">Tumbes</option>
                                                    <option value="Ucayali">Ucayali</option>
                                                </select>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Provincia actual</label>
                                                <select name="provincia_actual" onchange="cambiaDistrito()"
                                                    required="" class="custom-select"></select>

                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Distrito actual</label>
                                                <select name="distrito_actual" required=""
                                                    class="custom-select"></select>

                                            </div>
                                        </div>

                                        <div class="col-12 d-flex mt-3">
                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Celular</label>
                                                <input type="text" class="form-control" name='celular'
                                                    value='{{ old('celular') }}'>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" name='teléfono'
                                                    value='{{ old('teléfono') }}'>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Email</label>
                                                <input type="email" class="form-control" name='email'
                                                    value='{{ old('email') }}'>
                                            </div>
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


                    <!-- FIN DEL MODAL DE AGREGAR SOCIO :)-->



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