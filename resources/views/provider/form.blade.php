@extends('adminlte::page')
@section('title', 'PROVEEDORES')


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
                        Registrar Proveedor
                    </div>

                    <div class="p-4">
                        <form class="row g-3 " action="{{ route('providers.form') }}" method="POST">
                            @csrf


                            <div class="col-12 ">
                                <label for="disabledTextInput" class="form-label">Razon Social</label>
                                <input type="text" id="disabledTextInput" class="form-control" name="razon_social">

                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="disabledTextInput" class="form-label">Ruc</label>
                                <input type="text" id="disabledTextInput" class="form-control" name="ruc">
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="disabledTextInput" class="form-label">Dirección</label>
                                <input type="text" id="disabledTextInput" class="form-control" name="direccion">
                            </div>

                            <div class="col-6 mt-2">
                                <label for="disabledTextInput" class="form-label">Telefono</label>
                                <input type="text" id="disabledTextInput" class="form-control" name="telefono">
                            </div>

                            <div class="col-6 mt-2">
                                <label for="disabledTextInput" class="form-label">Email</label>
                                <input type="text" id="disabledTextInput" class="form-control" name="email">
                            </div>

           
                            <div class="col-4 container mt-5">
                                <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a href="{{ route('providers.index') }}" class="btn btn-danger" onclick="return confirm('¿Desea cancelar?')">Cancelar</a>
                                        <button type="reset" class="btn btn-secondary">Limpiar formulario</button>
                                </div>
                            </div>

                        </form>




                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection