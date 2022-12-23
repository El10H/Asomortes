@extends('adminlte::page')
@section('title', 'SOCIOS')


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

    /*input.error {
    border: 1px dashed red;
    font-weight: 300;
    color: red;
}*/
</style>

@section('content')
    <div class="p-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white" style="background-color:#004173">
                        Panel de Socios
                    </div>
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    @can('partners')
                                        <button class="btn text-white btn-primary" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Agregar Socio
                                        </button>
                                    @endcan

                                    <a href="{{ route('partners.pdf') }}" target="_blank" class="btn btn-success">Exportar
                                        PDF</a>

                                    @can('sociosFallecidos_pdf')
                                        <a href="{{ route('socioFallecidos.index') }}" class="btn btn-danger">Socios
                                            Fallecidos</a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="card mt-3 mb-5">
                            <div class="card-header">
                                Filtros de busqueda
                            </div>

                            <div class="card-body">
                                <div class="row">


                                    <div class="col-md-3">
                                        <label for="" class="form-label">Nombre o Apellido:</label>
                                    </div>


                                    <div class="col-md-3">
                                        <label for="" class="form-label">Número de DNI:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="" class="form-label">Carné de socio:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="" class="form-label">Fecha de ingreso:</label>
                                    </div>

                                </div>
                                <div class="row mb-3">

                                    <div class="col-md-3">
                                        <input type="text" name="user" id="nombre" class="form-control "
                                            data-index="1" />
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" name="user" id="dni" class="form-control "
                                            data-index="0" />
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" name="user" id="carne" class="form-control "
                                            data-index="2" />
                                    </div>

                                    <div class="col-md-3">
                                        <input type="date" name="user" id="fecha" class="form-control "
                                            data-index="3" />
                                    </div>



                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" style="width:100%" id="data">
                            <thead>
                                <tr>

                                    <th scope="col">Dni</th>
                                    <th scope="col">Nombres y Apellidos</th>
                                    <th scope="col">Carné</th>
                                    <th scope="col">Fecha de ingreso</th>
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
                                        <td>{{ $partner->fecha_de_ingreso }}</td>
                                        <td>{{ $partner->celular }}</td>
                                        <td>{{ $partner->email }}</td>
                                        <td>

                                            <form action="{{ route('partners.destroy', $partner) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                @can('partners')
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        onclick="return confirm('¿Desea eliminar?')">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                @endcan
                                                
                                                @can('partners')
                                                    <a href="{{ route('partners.edit', $partner->id) }}"
                                                        class="btn btn-outline-success"><i class="far fa-edit"></i></a>
                                                @endcan

                                                <a href="{{ route('partners.pdf_resumen', ['id' => $partner->id]) }} "
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
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                {{ $error }} <br>
                                            @endforeach
                                        </div>
                                    @endif

                                    <form action="{{ route('partners.store') }}" method="POST" id="form-socios">
                                        @csrf
                                        <div class="col-12 d-flex mt-3">
                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" name="nombre" id="nombre"
                                                    value='{{ old('nombre') }}'>

                                            </div>
                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Apellido Paterno</label>
                                                <input type="text" class="form-control" name="apellido_paterno"
                                                    id="apellido_paterno" value='{{ old('apellido_paterno') }}'>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputPassword4" class="form-label">Apellido Materno </label>
                                                <input type="text" class="form-control" name='apellido_materno'
                                                    id='apellido_materno' value='{{ old('apellido_materno') }}'>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex mt-3">
                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Carné</label>
                                                <input type="text" class="form-control" name='carne' id="carne"
                                                    value='{{ old('carne') }}'>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Fecha de ingreso</label>
                                                <input type="date" class="form-control" name='fecha_de_ingreso'
                                                    id="fecha_de_ingreso" value="{{ $now->format('Y-m-d') }}">
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Fecha de nacimiento</label>
                                                <input type="date" class="form-control" name='fecha_de_nac'
                                                    id="fecha_de_nac" id="fecha_nac" value="{{ old('fecha_de_nac') }}">
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
                                                    id="profesion" value='{{ old('profesion') }}'>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Grado de Instrucción</label>
                                                <input type="text" class="form-control" name='grado_de_instruccion'
                                                    id="grado_de_instruccion" value='{{ old('grado_de_instruccion') }}'>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Actividad</label>
                                                <input type="text" class="form-control" name='actividad'
                                                    id="actividad" value='{{ old('actividad') }}'>
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
                                                <input type="text" class="form-control" name='dni' id="dni"
                                                    value='{{ old('dni') }}'>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Domicilio</label>
                                                <input type="text" class="form-control" name='domicilio'
                                                    id="domicilio" value='{{ old('domicilio') }}'>
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
                                                <input type="text" class="form-control" name='celular' id="celular"
                                                    value='{{ old('celular') }}'>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" name='telefono'
                                                    id="telefono" value='{{ old('teléfono') }}'>
                                            </div>

                                            <div class="col-4">
                                                <label for="inputEmail4" class="form-label">Email</label>
                                                <input type="email" class="form-control" name='email' id="email"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $.validator.addMethod("soloLetras", function(value, element) {
                var pattern = /^[a-zA-ZÀ-ÿ\s]{1,50}$/;
                return this.optional(element) || pattern.test(value);
            }, "El campo no acepta números o signos");

            $.validator.addMethod("soloNumeros", function(value, element) {
                var pattern = /^([0-9]{9,9})$/;
                return this.optional(element) || pattern.test(value);
            }, "Ingrese un número válido de 9 dígitos");

            $.validator.addMethod("dniValidar", function(value, element) {
                var pattern = /^([0-9]{1,8})$/;
                return this.optional(element) || pattern.test(value);
            }, "Ingrese un número de DNI válido");

            $.validator.addMethod("carneValidar", function(value, element) {
                var pattern = /^([0-9]{1,5})$/;
                return this.optional(element) || pattern.test(value);
            }, "Ingrese un número de carné válido");

            $.validator.addMethod("numerosLetras", function(value, element) {
                var pattern =  /^[a-zA-Z0-9\_\-]{1,50}$/;
                return this.optional(element) || pattern.test(value);
            }, "No puede ingresar signos");
            
            $("#form-socios").validate({
                rules: {
                    nombre: {
                        required: true,
                        soloLetras: true
                    },
                    apellido_paterno: {
                        required: true,
                        soloLetras: true
                    },
                    apellido_materno:{
                        required: true,
                        soloLetras: true
                    },
                    profesion:{
                        required:true,
                        soloLetras:true 
                    },
                    grado_de_instruccion:{
                        required:true,
                        soloLetras:true  
                    },
                    actividad:{
                        required:true ,
                        soloLetras:true 
                    },
                    carne :{
                        required: true ,
                        carneValidar:true 
                    },
                    dni:{
                        required: true ,
                        dniValidar:true 
                    },
                    celular:{
                        required: true ,
                        soloNumeros: true
                    },
                    domicilio: {
                        required : true ,
                        
                    },
                    telefono : {
                        required:true,
                        soloNumeros:true,
                        
                    },
                    email : {
                        required : true ,
                        email:true 
                    }, 
                    dpto_nac : {
                        required:true 
                    },
                    provincia_nac : {
                        required:true
                    },
                    distrito_nac : {
                        required:true 
                    },
                    estado_civil: {
                        required:true 
                    },
                    dpto_actual: {
                        required:true 
                    },
                    provincia_actual:{
                        required: true 
                    },
                    distrito_actual : {
                        required: true 
                    },
                    fecha_de_ingreso: {
                        required: true 
                    },
                    fecha_de_nac : {
                        required: true 
                    }


                },
                messages: {
                    nombre: {
                        required: "El campo nombre es obligatorio",
                    },
                    apellido_paterno: {
                        required: "El campo apellido paternno es obligatorio"
                    },
                    apellido_materno :{
                        required: "El campo apellido materno es obligatorio"
                    },
                    profesion:{
                        required: "El campo profesión es obligatorio"
                    },
                    grado_de_instruccion:{
                        required:  "El campo grado de instrucción e sobligatorio"
                    },
                    actividad:{
                        required: "El campo actividad es obligatorio"
                    },
                    carne:{
                        required: "El campo carne es obligatorio",
                        maxlength: "Solo 5 caráctares como máximo",
                    },
                    dni :{
                        required :"El campo DNI es obligatorio"
                    },
                    celular: {
                        required: "El campo celular es obligatorio"
                    },
                    domicilio : {
                        required: "El campo domicilio es obligatorio",
                    },
                    telefono :{
                        required : "El campo teléfono es obligatorio",
                    },
                    email: {
                        required : "El campo email es obligatorio",
                        email: "El fomato no es válido"
                    },
                    dpto_nac:{
                        required: "Eliga una opción"
                    },
                    provincia_nac:{
                        required: "Eliga una opción"
                    },
                    distrito_nac: {
                        required: "Eliga una opción"
                    },
                    estado_civil: {
                        required:"Eliga una opción"
                    },
                    dpto_actual: {
                        required:"Eliga una opción"
                    },
                    provincia_actual:{
                        required: "Eliga una opción" 
                    },
                    distrito_actual : {
                        required: "Eliga una opción" 
                    },
                    fecha_de_ingreso: {
                        required: "El campo fecha de ingrese es obligatorio" 
                    },
                    fecha_de_nac : {
                        required: "El campo fecha de nacimiento es obligatorio" 
                    }


                    
                }
            });
        });

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

            $("#nombre").keyup(function() {
                table.column($(this).data('index')).search(this.value).draw();
            })

            $("#dni").keyup(function() {
                table.column($(this).data('index')).search(this.value).draw();
            })

            $("#carne").keyup(function() {
                table.column($(this).data('index')).search(this.value).draw();
            })
            $("#fecha").keyup(function() {
                table.column($(this).data('index')).search(this.value).draw();
            })


        })
    </script>

@endsection
@endsection
