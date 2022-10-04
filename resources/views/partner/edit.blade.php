@extends('adminlte::page')
@section('title', 'SOCIOS')

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
                    <div class="card-header bg-dark text-white">
                        
                        <div>
                            <h5 class="card-title">Socio: {{ $partner->nombre .' '.$partner->apellido_paterno .' '.$partner->apellido_materno }}</h5> 
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se asigno el cargo de forma correcta!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('fallecido'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Se adeclaro a {{ $partner->nombre . ' ' . $partner->apellido_materno }} como fallecido.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif


                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div>
                                    <!-- Modal para asiganar Directivo -->
                                    <div>
                                        <button type="button" class="btn btn-success mr-2" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Asignar Cargo
                                        </button>
    
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Eliga el cargo a
                                                            asignar</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 mt-2">
    
    
                                                            <form action="{{ route('asignar.directivo') }}" method="POST">
                                                                @csrf
                                                                <div>
                                                                    <input type="hidden" name="socio"
                                                                        value="{{ $partner->id }}">
                                                                </div>
                                                                <select class="custom-select" name="cargo">
                                                                    <option value="">Seleccione</option>
                                                                    <option value="Contador">Contador</option>
                                                                    <option value="Presidente">Presidente</option>
                                                                    <option value="Consejo de Vigilancia">Consejo de Vigilancia
                                                                    </option>
                                                                    <option value="Vicepresidente">Vicepresidente</option>
                                                                    <option value="Secretario de actas y archivo">Secretario de
                                                                        actas y
                                                                        archivos</option>
                                                                    <option value="Pro Secretario de actas y archivo">Pro
                                                                        Secretario de
                                                                        actas y archivos</option>
                                                                    <option value="Tesorero">Tesorero</option>
                                                                    <option value="Pro Tesorero">Pro Tesorero</option>
                                                                    <option value="Secretario de prensa y propaganda">Secretario
                                                                        de
                                                                        prensa y propaganda</option>
                                                                    <option value="Secretario de asistencia social">Secretario
                                                                        de
                                                                        asistencia social</option>
                                                                    <option value="Vocal">Vocal</option>
                                                                </select>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit" class="btn btn-primary">Asignar
                                                                        Cargo</button>
                                                                </div>
                                                            </form>
    
                                                        </div>
                                                    </div>
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div>
                                    <!-- Socio Fallecido -->
                                    <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        Declarar fallecido
                                    </button>
    
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered p-3">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <p class="modal-title" id="staticBackdropLabel">
                                                        Declarar a {{ $partner->nomnre . ' ' . $partner->apellido_paterno }}
                                                        como
                                                        fallecido</p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('socio.fallecido') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
    
                                                        <div>
                                                            <input type="hidden" name="socio" value="{{ $partner->id }}">
                                                        </div>
                                                        <div class="mt-2">
                                                            <label for="" class="form-label">Certificado de
                                                                defunción:</label>
                                                            <input class="form-control" type="file" name="certificado"
                                                                accept="image/*">
                                                        </div>
    
                                                        <div class="mt-3">
                                                            <label for="" class="form-label">Acta de defunción:</label>
                                                            <input class="form-control" type="file" name="acta"
                                                                accept="image/*">
                                                        </div>
    
    
    
    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary mt">Declarar
                                                        fallecido</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                        </div>
                    </div>
                    <div class="p-4">
                        <form class="row g-3 " action="{{ route('partner.update', $partner->id) }}" method="POST">
                            @csrf


                            <div class="col-12 ">
                                <label for="inputEmail4" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre2"
                                    value='{{ $partner->nombre }}'>

                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="inputPassword4" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" name="apellido_paterno"
                                    value='{{ $partner->apellido_paterno }}'>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="inputPassword4" class="form-label">Apellido Materno </label>
                                <input type="text" class="form-control" name='apellido_materno'
                                    value='{{ $partner->apellido_materno }}'>
                            </div>


                            <div class="col-6 mt-2">
                                <label for="inputEmail4" class="form-label">Carné</label>
                                <input type="text" class="form-control" name='carne' value='{{ $partner->carne }}'>
                            </div>

                            <div class="col-6 mt-2">
                                <label for="inputEmail4" class="form-label">Fecha de ingreso</label>
                                <input type="datetime-local" class="form-control" name='fecha_de_ingreso'
                                    value='{{ date('Y-m-d\TH:i', strtotime($partner->fecha_de_ingreso)) }}'>
                            </div>

                            <div class="col-12 mt-2">
                                <label for="inputEmail4" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" name='fecha_de_nac'
                                    value='{{ date('Y-m-d', strtotime($partner->fecha_de_nac)) }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Departamento de Nacimiento</label>
                                <input type="text" class="form-control" name='dpto_nac'
                                    value='{{ $partner->dpto_nac }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Provincia de Nacimiento</label>
                                <input type="text" class="form-control" name='provincia_nac'
                                    value='{{ $partner->provincia_nac }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Distrito de Nacimiento</label>
                                <input type="text" class="form-control" name='distrito_nac'
                                    value='{{ $partner->distrito_nac }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Profesión</label>
                                <input type="text" class="form-control" name='profesion'
                                    value='{{ $partner->profesion }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Grado de Instrucción</label>
                                <input type="text" class="form-control" name='grado_de_instruccion'
                                    value='{{ $partner->grado_de_instruccion }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Actividad</label>
                                <input type="text" class="form-control" name='actividad'
                                    value='{{ $partner->actividad }}'>
                            </div>

                            <div class="col-6 mt-2">
                                <label for="inputEmail4" class="form-label">Estado Civil</label>
                                <input type="text" class="form-control" name='estado_civil'
                                    value='{{ $partner->estado_civil }}'>
                            </div>

                            <div class="col-6 mt-2">
                                <label for="inputEmail4" class="form-label">Dni</label>
                                <input type="text" class="form-control" name='dni' value='{{ $partner->Dni }}'>
                            </div>

                            <div class="col-12 mt-2">
                                <label for="inputEmail4" class="form-label">Domicilio</label>
                                <input type="text" class="form-control" name='domicilio'
                                    value='{{ $partner->domicilio }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Departamento actual</label>
                                <input type="text" class="form-control" name='dpto_actual'
                                    value='{{ $partner->dpto_actual }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Provincia actual</label>
                                <input type="text" class="form-control" name='provincia_actual'
                                    value='{{ $partner->provincia_actual }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Distrito actual</label>
                                <input type="text" class="form-control" name='distrito_actual'
                                    value='{{ $partner->distrito_actual }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Celular</label>
                                <input type="text" class="form-control" name='celular' value='{{ $partner->celular }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name='telefono'
                                    value='{{ $partner->teléfono }}'>
                            </div>

                            <div class="col-4 mt-2">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="email" class="form-control" name='email' value='{{ $partner->email }}'>
                            </div>



                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="{{ route('partners.index') }}" class="btn btn-danger">Cancelar </a>
                            </div>

                        </form>



                      




                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
