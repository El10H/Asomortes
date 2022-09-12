@extends('adminlte::page')
@section('title', 'SERVICIOS')


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
                        Registrar Servicio
                    </div>

                    <div class="p-4">
                        <form class="row g-3 " action="{{ route('services.form') }}" method="POST">
                            @csrf


                            <div class="col-12 mt-2">
                                <label for="disabledTextInput" class="form-label">Nombre</label>
                                <input type="text" id="disabledTextInput" class="form-control" name="nombre">

                            </div>

                            <div class="col-6 mt-2">
                                <label for="disabledTextInput" class="form-label">Valor</label>
                                <input type="number" min="1" step="0.01" id="disabledTextInput" class="form-control" name="valor">
                            </div>

                            <div class="col-6 mt-2">
                                <label for="disabledTextInput" class="form-label">Stock</label>
                                <input type="number" min="1" step="1" id="disabledTextInput" class="form-control" name="stock">
                            </div>

                            <div class="col-12 mt-2">
                                <label for="disabledTextInput" class="form-label">Descripción</label>
                                <textarea class="form-control" placeholder="Agregue una descripción del servicio..." name="descripcion" id="floatingTextarea"></textarea>
                            </div>

                            <div class="mb-3 ml-2 form-check">
                                <input type="checkbox"  class="form-check-input" name="devolucion" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">El servicio sera devuelto</label>
                            </div>
           
                            <div class="col-4 container mt-5">
                                <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a href="{{ route('services.index') }}" class="btn btn-danger" onclick="return confirm('¿Desea cancelar?')">Cancelar</a>
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