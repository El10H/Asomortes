@extends('adminlte::page')
@section('title', 'PRODUCTOS')
@extends('product.modalAdd')



@section('css')
<link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/validacion.css">
@endsection

@section('content')
    <div class="p-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white" style="background-color:#004173">
                        Productos
                    </div>
                  

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-left">
                                    @can('products.store')
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#agregarProducto">
                                            Agregar Producto
                                        </button>
                                    @endcan

                                        <a href="{{ route('products.pdf') }}" target="_blank"
                                            class="btn btn-success">Exportar PDF</a>
                                    </div>

                                    <!-- <div class="float-right ">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#agregarCompraProducto">
                                            Agregar Compras
                                        </button>
                                    </div> -->
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
                        <table class="table" id="data">
                            <thead>
                                <tr align="center">
                                    <th width="25%" scope="col">Nombre</th>
                                    <th width="35%" scope="col">Descripción</th>
                                    <th width="25%" scope="col">Atributos</th>
                                    @can('products') <th width="15%"></th> @endcan

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td align="left">{{ $product->nombre }}</td>
                                        <td align="left">{{ $product->descripcion }}</td>

                                        <td align="left">
                                            <?php $cadena = ''; ?>
                                            @foreach ($attribute_products as $attribute_product)
                                                @if ($attribute_product->id_products == $product->id)
                                                    <?php
                                                    //$cadena="5";
                                                    $atributo = $attribute_product->atributo;
                                                    $cadena .= ucfirst($atributo) . ', ';
                                                    ?>
                                                @endif
                                            @endforeach

                                            <?php empty($cadena) ? ($cadena = '') : ($cadena = substr($cadena, 0, -2) . '.'); ?>

                                            {{ $cadena }}
                                        </td>


                                        @can('products')
                                            <td align="center">
                                                <form action="{{ route('products.destroy', $product) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    
                                                    @can('products.destroy')
                                                        <button type="submit" class="btn btn-outline-danger"
                                                            onclick="return confirm('¿Desea eliminar?')">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    @endcan

                                                    @can('products.update')
                                                        <a data-bs-toggle="modal" data-bs-target="#actualizar{{ $product->id }}"
                                                            class="btn btn-outline-success" onclick="atributos('{{$product->id}}')">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                </form>


<<<<<<< HEAD
                                                <!-- Modal para editar Producto -->
                                                <div class="modal fade" id="actualizar{{$product->id}}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-m">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Actualizar Producto
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
=======
                                            <!-- Modal para editar Producto -->
                                            <div class="modal fade" id="actualizar{{$product->id}}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-m">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Actualizar Producto
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"><i
                                                                class="fas fa-times"></i></button>
                                                        </div>
>>>>>>> fbd8d5c6e1dbcf8fcb56f8b2fda02a657ccd8d75

                                                            <div class="modal-body">
                                                                <form class="row g-3 " action="{{ route('products.update', $product->id) }}" 
                                                                    method="POST">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <div class="col-12 mt-2">
                                                                        <label for="disabledTextInput"
                                                                            class="form-label">Nombre</label>
                                                                        <input type="text" id="disabledTextInput"
                                                                            class="form-control" name="nombre" value="{{$product->nombre}}">
                                                                    </div>

                                                                    <div class="col-12 mt-2">
                                                                        <label for="disabledTextInput"
                                                                            class="form-label">Descripción</label>
                                                                        <textarea class="form-control" placeholder="Agregue una descripción del servicio..." name="descripcion"
                                                                            id="floatingTextarea" > {{$product->descripcion}}
                                                                    </textarea>
                                                                    </div>

                                                                    <label>Seleccionar atributos del producto:</label>
                                                                    <div class="container text-center">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                id="modelo{{$product->id}}" name="modelo"
                                                                                value="modelo">
                                                                            <label class="form-check-label"
                                                                                for="inlineCheckbox1">Modelo</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                id="cementerio{{$product->id}}" name="cementerio"
                                                                                value="cementerio">
                                                                            <label class="form-check-label"
                                                                                for="inlineCheckbox2">Cementerio</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                id="sector{{$product->id}}" name="sector"
                                                                                value="sector">
                                                                            <label class="form-check-label"
                                                                                for="inlineCheckbox3">Sector</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                id="nivel{{$product->id}}" name="nivel"
                                                                                value="nivel">
                                                                            <label class="form-check-label"
                                                                                for="inlineCheckbox4">Nivel</label>
                                                                        </div>
                                                                    </div>


<<<<<<< HEAD

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger"
                                                                            data-bs-dismiss="modal">Cancelar</button>
                                                                        <button type="submit"
                                                                            class="btn btn-success">Guardar</button>
                                                                        <button type="reset"
                                                                            class="btn btn-secondary">Limpiar
                                                                            formulario</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
=======
                                                            </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-bs-dismiss="modal">Cancelar</button>
                                                                    <button type="submit"
                                                                        class="btn btn-success">Guardar</button>
                                                                    <button type="reset"
                                                                        class="btn btn-secondary">Limpiar
                                                                        formulario</button>
                                                                </div>
                                                            </form>
                                                        
>>>>>>> fbd8d5c6e1dbcf8fcb56f8b2fda02a657ccd8d75
                                                    </div>
                                                </div>

                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <!-- Modal para agregar Producto -->
                    @include('product.modalAdd')

                    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
                </div>
            </div>
        </div>
    </div>

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>


    <script>
        function atributos(id){
            $.ajax({
                type:"GET",
                url:"../../atributosCheck"+id,
                success:function(response){
                    var response = JSON.parse(response);
                    //console.log(response);
                    //$('#color'+id).prop("checked", true);

                    response.map(function(atr){
                        //console.log(atr['atributo']);
                        if(atr['atributo']=='modelo'){
                            $('#modelo'+id).prop("checked", true);
                        }
                        if(atr['atributo']=='cementerio'){
                            $('#cementerio'+id).prop("checked", true);
                        }
                        if(atr['atributo']=='sector'){
                            $('#sector'+id).prop("checked", true);
                        }
                        if(atr['atributo']=='nivel'){
                            $('#nivel'+id).prop("checked", true);
                        }
                        
                    });
                }
            });
        }
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