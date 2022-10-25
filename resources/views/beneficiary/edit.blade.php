@extends('adminlte::page')
@section('title', 'BENEFICIARIOS')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="p-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white" style="background-color:#004173">
                        Actualizar Beneficiario
                        
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
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif


                    <div class="p-4">

                        <form class="row g-3 " action="{{route('beneficiaries.update',$beneficiaries->id)}}" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="col-12">
                                <input type="hidden" class="form-control" name='id_partner' value="{{$partners->id}}" >
                            </div>
                            
                            <div class="col-12 mt-5">
                                <label for="inputEmail4" class="form-label">Nombre Socio:</label>
                                <input type="text" class="form-control" name='nombre_partner' value="{{$partners->nombre . ' '.$partners->apellido_paterno.' '.$partners->apellido_materno}}" disabled>
                            </div>

                            <div class="col-12 mt-5">
                                <label for="inputEmail4" class="form-label">Beneficiario Nombres y Apellidos</label>
                                <input type="text" class="form-control" name='nombre' value="{{$beneficiaries->nombres_apellidos}}">
                            </div>


                            <div class="col-6 mt-2">
                                <label for="inputEmail4" class="form-label">Dni</label>
                                <input type="text" class="form-control" name='dni'value="{{$beneficiaries->dni}}">
                            </div>

                            <div class="col-6 mt-2">
                                <label for="" class="form-label">Celular</label>
                                <input type="text" class="form-control" name='celular' value="{{$beneficiaries->celular}}">
                            </div>

                            <div class="col-6 mt-2">
                                <label for="" class="form-label">Email</label>
                                <input type="email" class="form-control" name='email' value="{{$beneficiaries->email}}" >
                            </div>

                            <div class="col-6 mt-2">
                                <label for="" class="form-label">Parentesco:</label>
                                <select class="custom-select" name='parentesco'>
                                    <option value="hijo">Hijo</option>
                                    <option value="hermano">Hermano</option>
                                    <option value="esposo">Esposo</option>
                                    <option value="primo">Primo</option>
                                </select>
                            </div>

                            <div class="col-6 mt-2">
                                <label for="" class="form-label">Fecha de ingreso</label>
                                <input type="date" class="form-control" name='fecha_de_ingreso' value="{{date('Y-m-d', strtotime($beneficiaries->fecha_de_ingreso))}}">
                            </div>

                            <div class="col-12 mt-4 ">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="" class="btn btn-danger">Cancelar </a>
                                <a href="{{ route('beneficiaries.index') }}" class="btn btn-success">Volver </a>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection