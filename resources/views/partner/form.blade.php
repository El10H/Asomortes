@extends('adminlte::page')
@section('title', 'SOCIOS')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Registrar Nuevo Socio
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        </div>
                    @endif


                    <div class="p-4">
                        <form class="row g-3 " action="{{ route('partners.form') }}" method="POST">
                            @csrf


                            <div class="col-12 ">
                                <label for="inputEmail4" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre2"
                                    value='{{ old('nombre') }}'>

                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="inputPassword4" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" name="apellido_paterno"
                                    value='{{ old('apellido_paterno') }}'>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="inputPassword4" class="form-label">Apellido Materno </label>
                                <input type="text" class="form-control" name='apellido_materno'
                                    value='{{ old('apellido_materno') }}'>
                            </div>

                            <div class="col-6 mt-2">
                                <label for="inputEmail4" class="form-label">Carné</label>
                                <input type="text" class="form-control" name='carne' value='{{ old('carne') }}'>
                            </div>

                            <div class="col-6 mt-2">
                                <label for="inputEmail4" class="form-label">Fecha de ingreso</label>
                                <input type="date" class="form-control" name='fecha_de_ingreso'
                                    value="{{ $now->format('Y-m-d') }}">
                            </div>

                            <div class="col-12 mt-2">
                                <label for="inputEmail4" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" name='fecha_de_nac' id="fecha_nac"
                                    value='{{ old('fecha_de_nac') }}'>
                            </div>


                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Departamento de Nacimiento</label>
                                <select class="custom-select" name="dpto_nac" onchange="cambia()" required="">
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

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Provincia de Nacimiento</label>
                                <select name="provincia_nac" onchange="cambiaDistrito()" required="" class="custom-select">

                                </select>

                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Distrito de Nacimiento</label>
                                <select name="distrito_nac" required="" class="custom-select"></select>

                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Profesión</label>
                                <input type="text" class="form-control" name='profesion' value='{{ old('profesion') }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Grado de Instrucción</label>
                                <input type="text" class="form-control" name='grado_de_instruccion'
                                    value='{{ old('grado_de_instruccion') }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Actividad</label>
                                <input type="text" class="form-control" name='actividad'
                                    value='{{ old('actividad') }}'>
                            </div>

                            <div class="col-6 mt-2">
                                <label for="inputEmail4" class="form-label">Estado Civil</label>
                                <select class="custom-select" name='estado_civil'>
                                    <option selected>Seleccione</option>
                                    <option value="soltero">Soltero</option>
                                    <option value="casado">Casado</option>
                                    <option value="divorciado">Divorciado</option>
                                    <option value="viudo">Viudo</option>
                                </select>
                            </div>

                            <div class="col-6 mt-2">
                                <label for="inputEmail4" class="form-label">Dni</label>
                                <input type="text" class="form-control" name='dni' value='{{ old('dni') }}'>
                            </div>

                            <div class="col-12 mt-2">
                                <label for="inputEmail4" class="form-label">Domicilio</label>
                                <input type="text" class="form-control" name='domicilio'
                                    value='{{ old('domicilio') }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Departamento actual</label>
                                <select class="custom-select" name="dpto_actual" onchange="cambia()" required="">
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

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Provincia actual</label>
                                <select name="provincia_actual" onchange="cambiaDistrito()" required="" class="custom-select"></select>
                            
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Distrito actual</label>
                                <select name="distrito_actual" required="" class="custom-select"></select>
                              
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Celular</label>
                                <input type="text" class="form-control" name='celular' value='{{ old('celular') }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name='teléfono' value='{{ old('teléfono') }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="email" class="form-control" name='email' value='{{ old('email') }}'>
                            </div>



                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="" class="btn btn-danger">Cancelar </a>
                                <a href="" class="btn btn-secondary">Limpiar Formulario </a>
                            </div>

                        </form>




                    </div>
                </div>
            </div>
        </div>
    </div>


@section('js')

    <script src="{{ asset('js/provinciasNac.js')}}"></script>
    <script src="{{ asset('js/provinciasActual.js')}}"></script>
@endsection


@endsection
