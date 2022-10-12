@extends('adminlte::page')
@section('title', 'BENEFICIARIOS')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white" style="background-color:#004173">
                        Registrar Nuevo Beneficiario

                        <div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        </div>
                    @endif
                    <div class="p-4">
                        <form class="row g-3 " action="{{ route('beneficiaries.create') }}" method="POST">
                            @csrf

                            <div class="col-6 ">
                                <input type="hidden" class="form-control" name='id_partner' value="{{ $partner->id }}">
                            </div>
                            <div class="col-12 mt-5">
                                <label for="" class="form-label">Nombre Socio:</label>
                                <input type="text" class="form-control" name='nombre_partner'
                                    value="{{ $partner->nombre.' '.$partner->apellido_paterno.' '.$partner->apellido_materno }}" disabled>
                            </div>

                            <div class="col-6 mt-5">
                                <label for="" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name='nombre' value="{{old('nombre')}}">
                            </div>


                            <div class="col-6 mt-5">
                                <label for="" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" name='apellido_paterno' value="{{ old('apellido_paterno')}}">
                            </div>

                            <div class="col-6 mt-2">
                                <label for="" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" name='apellido_materno' value="{{old('apellido_materno')}}">
                            </div>

                            <div class="col-6 mt-2">
                                <label for="" class="form-label">Dni</label>
                                <input type="text" class="form-control" name='dni' value="{{old('dni')}} ">
                            </div>

                            <div class="col-6 mt-2">
                                <label for="" class="form-label">Celular</label>
                                <input type="text" class="form-control" name='celular' value="{{old('celular')}} ">
                            </div>

                            <div class="col-6 mt-2">
                                <label for="" class="form-label">Email</label>
                                <input type="email" class="form-control" name='email' value="{{old('email')}} ">
                            </div>

                            <div class="col-6 mt-2">
                                <label for="" class="form-label">Parentesco:</label>
                                <select class="custom-select" name='parentesco'>
                                    <option selected>Seleccione</option>
                                    <option value="hijo">Hijo</option>
                                    <option value="hermano">Hermano</option>
                                    <option value="esposo">Esposo</option>
                                    <option value="primo">Primo</option>
                                </select>
                            </div>

                            <div class="col-6 mt-2">
                                <label for="" class="form-label">Fecha de ingreso: </label>
                                <input type="date" class="form-control" name='fecha_de_ingreso' value="{{$now->format('Y-m-d')}}">
                            </div>


                            <div class="col-12 mt-4 ">
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
    
 
@endsection
