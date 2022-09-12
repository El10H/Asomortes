@extends('adminlte::page')
@section('title', 'PRODUCTOS')


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
                        Registrar Producto
                    </div>

                    <div class="p-4">
                        <form class="row g-3 " action="{{ route('products.form') }}" method="POST">
                            @csrf


                            <div class="col-12 ">
                                <label for="disabledTextInput" class="form-label">Nombre</label>
                                <input type="text" id="disabledTextInput" class="form-control" name="nombre">

                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="disabledTextInput" class="form-label">Color</label>
                                <input type="text" id="disabledTextInput" class="form-control" name="color">
                            </div>

                            <div class="col-md-6 mt-2">
                                <label for="disabledTextInput" class="form-label">Material</label>
                                <input type="text" id="disabledTextInput" class="form-control" name="material">
                            </div>

                            <div class="col-6 mt-2">
                                <label for="disabledTextInput" class="form-label">Stock</label>
                                <input type="number" min="1" step="1" id="disabledTextInput" class="form-control" name="stock">
                            </div>

                            <div class="col-6 mt-2">
                                <label for="disabledTextInput" class="form-label">Valor</label>
                                <input type="number" min="1" step="0.01" id="disabledTextInput" class="form-control" name="valor">
                            </div>

                            <div class="col-12 mt-2">
                                <label for="disabledTextInput" class="form-label">Descripción</label>
                                <textarea class="form-control" placeholder="Agregue una descripción del producto..." name="descripcion" id="floatingTextarea"></textarea>
                            </div>
           
                            <div class="col-4 container mt-5">
                                <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a href="{{ route('products.index') }}" class="btn btn-danger" onclick="return confirm('¿Desea cancelar?')">Cancelar</a>
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