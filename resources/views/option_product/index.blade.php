@extends('adminlte::page')
@section('title', 'OPCIONES DE PRODUCTOS')


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <script>
        function habilitar(services) {
            var id = document.getElementById("select_comprobante").value;

            console.log(id);

            $.ajax({
                type: "GET",
                url: "../accederDatosProduct" + id,
                success: function(response) {
                    var response = JSON.parse(response);

                    console.log(response);

                    var incluyeVeinte = response.includes('color');

                    if (response.includes('modelo')) {
                        document.getElementById('modelo').disabled = false;
                        document.getElementById('modelo').removeAttribute("placeholder");
                    } else {
                        document.getElementById('modelo').disabled = true;
                        document.getElementById('modelo').setAttribute("placeholder", "No requerido");
                    }

                    if (response.includes('cementerio')) {
                        document.getElementById('cementerio').disabled = false;
                        document.getElementById('cementerio').removeAttribute("placeholder");
                    } else {
                        document.getElementById('cementerio').disabled = true;
                        document.getElementById('cementerio').setAttribute("placeholder", "No requerido");
                    }

                    if (response.includes('sector')) {
                        document.getElementById('sector').disabled = false;
                        document.getElementById('sector').removeAttribute("placeholder");
                    } else {
                        document.getElementById('sector').disabled = true;
                        document.getElementById('sector').setAttribute("placeholder", "No requerido");
                    }

                    

                    if (response.includes('nivel')) {
                        document.getElementById('nivel').disabled = false;
                        document.getElementById('nivel').removeAttribute("placeholder");
                    } else {
                        document.getElementById('nivel').disabled = true;
                        document.getElementById('nivel').setAttribute("placeholder", "No requerido");
                    }
                }
            });
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Opciones de productos
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-left ">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#agregarOptionProducto" onclick="agregarSku()">
                                            Agregar Opción de Producto
                                        </button>
                                        <a href="{{ route('option_product.list') }}" target="_blank" class="btn btn-success">Exportar PDF</a>
                                    </div>

                                    <div class="float-right ">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#agregarCompraProducto">
                                            Agregar Compras
                                        </button>

                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#verComprasProducto">
                                            Ver Compras
                                        </button>
                                    </div>
                                    
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
                                    <th width=10% scope="col">Sku</th>
                                    <th width=20% scope="col">Categoría</th>
                                    <th width=60% scope="col">Atributos</th>
                                    <th width=15%></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sku_option_products as $sku_option_product)
                                    <tr>
                                        <td align="center">{{ $sku_option_product->sku }}</td>
                                        <!--<td align="left">{{ $sku_option_product->nombre }}</td>-->

                                        @foreach ($buys_products as $buys_product)
                                            @if ($sku_option_product->id_vouchers == $buys_product->id)
                                                @foreach ($products as $product)
                                                    @if ($product->id == $buys_product->id_products)
                                                        <td align="left">{{ $product->nombre }}</td>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach

                                        <?php $array1 = [];
                                        $i = 0;
                                        $cadena = ''; ?>

                                        @foreach ($option_products as $option_product)
                                            @if ($sku_option_product->sku == $option_product->sku)
                                                @foreach ($attribute_products as $attribute_product)
                                                    @if ($option_product->id_attribute_products == $attribute_product->id)
                                                        <?php
                                                        $atributo = $attribute_product->atributo . ' = ' . $option_product->opcion;
                                                        $array1[$i] = $atributo;
                                                        
                                                        $cad = ucfirst($attribute_product->atributo) . ' -> ' . ucfirst($option_product->opcion);
                                                        $cadena .= $cad . ' | ';
                                                        ?>
                                                    @endif
                                                @endforeach
                                                <?php $i++; ?>
                                            @endif
                                        @endforeach

                                        <?php $cadena = substr($cadena, 0, -3) . '.'; ?>

                                        <td align="left">{{ $cadena }}</td>

                                        <td>
                                            <form action="{{ route('option_products.destroy', $sku_option_product->sku) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger"
                                                    onclick="return confirm('¿Desea eliminar {{ $sku_option_product->nombre }}?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>

                                                @foreach ($option_products as $option_product)
                                                    @if ($sku_option_product->sku == $option_product->sku)
                                                        <?php $categoria = $option_product->id_products; ?>
                                                    @endif
                                                @endforeach

                                                <a data-bs-toggle="modal"
                                                    data-bs-target="#actualizar{{ $sku_option_product->sku }}"
                                                    class="btn btn-outline-success"
                                                    onclick="camposActualizar('{{ $sku_option_product->sku }}')">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </form>
                                            <!-- Modal para editar Opciones de Producto -->
                                            <div class="modal fade" id="actualizar{{ $sku_option_product->sku }}"
                                                tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-m">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModal">Actualizar Opciones
                                                                Producto</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form class="row g-3" action="{{route('actualizar.option_product',$sku_option_product->sku)}}" method="POST">
                                                                @csrf

                                                                <div class="col-2 mt-2">
                                                                    <label for="disabledTextInput" class="form-label">Sku:
                                                                    </label>
                                                                    <input type="text" id="skuAct"
                                                                        class="form-control" name="skuAct" readonly
                                                                        value="{{ $sku_option_product->sku }}">
                                                                </div>


                                                                <!--<div class="col-10 mt-2">
                                                                    <label for="disabledTextInput"
                                                                        class="form-label">Nombre</label>
                                                                    <input type="text" id="nombreAct"
                                                                        class="form-control" name="nombreAct"
                                                                        value="{{ $sku_option_product->nombre }}">
                                                                </div>-->

                                                                <div class="col-4 mt-2">
                                                                    <label for="disabledTextInput"
                                                                        class="form-label">Valor</label>
                                                                    <input type="number" min="0" step="0.01"
                                                                        id="valorAct{{ $sku_option_product->sku }}" class="form-control"
                                                                        name="valorAct" placeholder="No requerido" disabled>
                                                                </div>

                                                                <div class="col-6 mt-2">
                                                                    <label for="disabledTextInput"
                                                                        class="form-label">Cantidad</label>
                                                                    <input type="number" min="1" step="1"
                                                                        id="cantidadAct{{ $sku_option_product->sku }}" class="form-control"
                                                                        name="cantidadAct" placeholder="No requerido" disabled>
                                                                </div>

                                                                <div class="col-6 mt-2">
                                                                    <label for="disabledTextInput"
                                                                        class="form-label">Modelo</label>
                                                                    <input type="text" id="modeloAct{{ $sku_option_product->sku }}"
                                                                        class="form-control" name="modeloAct" placeholder="No requerido" disabled>
                                                                </div>

                                                                <div class="col-6 mt-2">
                                                                    <label for="disabledTextInput"
                                                                        class="form-label">Cementerio</label>
                                                                    <input type="text" id="cementerioAct{{ $sku_option_product->sku }}"
                                                                        class="form-control" name="cementerioAct" placeholder="No requerido" disabled>
                                                                </div>

                                                                <div class="col-6 mt-2">
                                                                    <label for="disabledTextInput"
                                                                        class="form-label">Sector</label>
                                                                    <input type="text" id="sectorAct{{ $sku_option_product->sku }}"
                                                                        class="form-control" name="sectorAct" placeholder="No requerido" disabled>
                                                                </div>

                                                                
                                                                <div class="col-6 mt-2">
                                                                    <label for="disabledTextInput"
                                                                        class="form-label">Nivel</label>
                                                                    <input type="text" id="nivelAct{{ $sku_option_product->sku }}"
                                                                        class="form-control" name="nivelAct" placeholder="No requerido" disabled>
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar Opciones de Producto -->
    <div class="modal fade" id="agregarOptionProducto" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-m">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Opciones Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="row g-3 " action="{{ route('option_products.create') }}" method="POST">
                        @csrf

                        <div class="col-2 mt-2">
                            <label for="disabledTextInput" class="form-label">Sku: </label>
                            <input type="text" id="sku" class="form-control" name="sku" readonly>
                        </div>

                        <!--<div class="col-10 mt-2">
                            <label for="inputEmail4" class="form-label">Categoría de productos</label>
                            <select class="custom-select" id="select_product" name='cat_producto'
                                onchange="habilitar()">
                                <option selected>-Seleccione-</option>

                                @foreach ($products as $product)
                                    <option value="{{ $product['id'] }}">{{ $product['nombre'] }}</option>
                                @endforeach
                            </select>
                        </div>-->

                        <div class="col-10 mt-2">
                            <label for="inputEmail4" class="form-label">N° comprobante</label>
                            <select class="custom-select" id="select_comprobante" name='comprobante'
                                onchange="habilitar()">
                                <option selected>-Seleccione-</option>

                                @foreach ($buys_products as $buys_product)
                                    @if ($buys_product->estado == 'Registrada')
                                        <option value="{{ $buys_product['id_products'] }}">{{ $buys_product['boletaFactura'] }} N° {{ $buys_product['n_comprobante'] }}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                        

                        <!--<div class="col-12 mt-2">
                            <label for="disabledTextInput" class="form-label">Nombre</label>
                            <input type="text" id="nombre" class="form-control" name="nombre">
                        </div>-->

                        <div class="col-6 mt-2">
                            <label for="disabledTextInput" class="form-label">Valor</label>
                            <input type="number" min="0" step="0.01" id="valor" class="form-control"
                                name="valor">
                        </div>

                        <div class="col-6 mt-2">
                            <label for="disabledTextInput" class="form-label">Cantidad</label>
                            <input type="number" min="1" step="1" id="cantidad" class="form-control"
                                name="cantidad">
                        </div>

                        <div class="col-6 mt-2">
                            <label for="disabledTextInput" class="form-label">Modelo</label>
                            <input type="text" id="modelo" class="form-control" name="modelo">
                        </div>

                        <div class="col-6 mt-2">
                            <label for="disabledTextInput" class="form-label">Cementerio</label>
                            <input type="text" id="cementerio" class="form-control" name="cementerio">
                        </div>

                        <div class="col-6 mt-2">
                            <label for="disabledTextInput" class="form-label">Sector</label>
                            <input type="text" id="sector" class="form-control" name="sector">
                        </div>

                        
                        <div class="col-6 mt-2">
                            <label for="disabledTextInput" class="form-label">Nivel</label>
                            <input type="text" id="nivel" class="form-control" name="nivel">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <button type="reset" class="btn btn-secondary">Limpiar formulario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal para agregar compra de Producto -->
    <div class="modal fade" id="agregarCompraProducto" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Compras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form class="row g-3 " action="{{ route('option_product.updateStock') }}" method="POST">
                        @csrf

                        <div class="col-6 mt-2">
                            <label for="inputEmail4" class="form-label">Productos</label>
                            <select class="custom-select" name='producto'>
                                <option selected>Seleccione</option>

                                @foreach ($products as $product)
                                    <option value="{{ $product['id'] }}">{{ $product['nombre'] }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-6 mt-2">
                            <label for="inputEmail4" class="form-label">Proveedores</label>
                            <select class="custom-select" name='proveedor'>
                                <option selected>Seleccione</option>

                                @foreach ($providers as $provider)
                                    <option value="{{ $provider['id'] }}">{{ $provider['razon_social'] }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-6 mt-2">
                            <label for="inputEmail4" class="form-label">Boleta/Factura</label>
                            <select class="custom-select" name='boletaFactura'>
                                <option selected>Seleccione</option>
                                <option value="Boleta">Boleta</option>
                                <option value="Factura">Factura</option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="disabledTextInput" class="form-label">N° de comprobante</label>
                            <input type="text" id="disabledTextInput" class="form-control"
                                name="n_comprobante">
                        </div>
                        
                        <div class="col-6 mt-2 justify-content-center">
                            <label for="inputEmail4" class="form-label">Fecha</label>
                            <input type="date" class="form-control" name='fecha_compra'
                                value="{{ $now->format('Y-m-d') }}">
                        </div>

                        <div class="col-4 mt-2">
                            <label for="disabledTextInput" class="form-label">Valor total</label>
                            <input type="number" min="1" step="0.01" id="disabledTextInput"
                                class="form-control" name="valorTotal">
                        </div>

                        <div class="col-2 mt-2">
                            <label for="disabledTextInput" class="form-label">T. Artículos</label>
                            <input type="number" min="1" step="1" id="disabledTextInput"
                                class="form-control" name="total_articulos">
                        </div>

                        <div class="col-12 mt-2 form-floating">
                            <textarea class="form-control" rows="5" placeholder="Agregue la descripción de la compra..." name="descripcion" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea">Descripción de la compra...</label>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <button type="reset" class="btn btn-secondary">Limpiar formulario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ver compras de Producto -->
    <div class="modal fade" id="verComprasProducto"
        tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal">Ver Compras de
                        Productos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                <div class="card-body">
                    <table class="table" id="data">
                        <thead>
                            <tr align="center">
                                <th scope="col">Producto</th>
                                <th scope="col">Proveedor</th>
                                <th scope="col">Comprobante</th>
                                <th scope="col">N° Comprobante</th>
                                <th scope="col">Fecha de compra</th>
                                <th scope="col">Valor total</th>
                                <th scope="col">T. Articulos</th>
                                <th scope="col">Descripción</th>  
                                <th scope="col">Estado</th>                               
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($buys_products as $buys_product)
                                <tr>
                                    @foreach ($products as $product)
                                        @if ($buys_product->id_products == $product->id)
                                            <td align="left">{{ $product->nombre }}</td>
                                        @endif
                                    @endforeach

                                    @foreach ($providers as $provider)
                                        @if ($buys_product->id_providers == $provider->id)
                                            <td align="left">{{ $provider->razon_social }}</td>
                                        @endif
                                    @endforeach

                                    <td align="left">{{ $buys_product->boletaFactura }}</td>
                                    <td align="left"><b>{{ $buys_product->n_comprobante }}</b></td>
                                    <td align="center">{{ $buys_product->fecha_compra }}</td>
                                    <td align="center">{{ $buys_product->valor_total }}</td>
                                    <td align="center">{{ $buys_product->total_articulos }}</td>
                                    <td align="left">{{ $buys_product->descripcion }}</td>
                                    <td align="left">{{ $buys_product->estado }}</td>

                                    <td>
                                        <form action="{{ route('buys_product.anular', $buys_product->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger"
                                                onclick="return confirm ('¿Desea anular el comprobante {{ $buys_product->n_comprobante }}?')">
                                                <i class="fas fa-trash "></i>
                                            </button>
                                        </form>
                                           
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <a href="{{ route('buys_product.list') }}" target="_blank" class="btn btn-success">PDF / Imprimir</a>
                    </div>
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
                "order": [
                    [0, "desc"]
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

        function agregarSku() {
            $.ajax({
                type: "GET",
                url: "../../sku",
                success: function(response) {
                    var response = JSON.parse(response);
                    var valorSku = document.getElementById('sku');
                    if (response.length == 0) {
                        valorSku.value = '1';
                    }
                    if (response.length > 0) {

                        valorSku.value = parseInt(response[0]['sku']) + parseInt(1);
                    }
                }

            });
        }

        function camposActualizar(skuActualizar) {
            $.ajax({
                type: "GET",
                url: "../camposact" + skuActualizar,
                success: function(responseActualizar) {
                    
                    var modeloAct=document.getElementById('modeloAct'+skuActualizar);
                    var cementerioAct=document.getElementById('cementerioAct'+skuActualizar);
                    var sectorAct=document.getElementById('sectorAct'+skuActualizar);
                    var nivelAct=document.getElementById('nivelAct'+skuActualizar);
                    var valorAct=document.getElementById('valorAct'+skuActualizar);
                    var cantidadAct=document.getElementById('cantidadAct'+skuActualizar);
                    var response = JSON.parse(responseActualizar);
                    console.log(response);

                    response[1].map(function(atr2){
                        if(atr2['atributo']=='modelo'){
                            modeloAct.disabled=false;
                            modeloAct.removeAttribute("placeholder", "No requerido");
                        }
                        if(atr2['atributo']=='cementerio'){
                            cementerioAct.disabled=false;
                            cementerioAct.removeAttribute("placeholder", "No requerido");
                        }
                        if(atr2['atributo']=='sector'){
                            sectorAct.disabled=false;
                            sectorAct.removeAttribute("placeholder", "No requerido");
                        }
                        if(atr2['atributo']=='nivel'){
                            nivelAct.disabled=false;
                            nivelAct.removeAttribute("placeholder", "No requerido");
                        }
                        if(atr2['atributo']=='valor'){
                            valorAct.disabled=false;
                            valorAct.removeAttribute("placeholder", "No requerido");
                        }
                        if(atr2['atributo']=='cantidad'){
                            cantidadAct.disabled=false;
                            cantidadAct.removeAttribute("placeholder", "No requerido");
                        }
                    })

                    response[0].map(function(atr){
                        if(atr['atributo']=='modelo'){
                            modeloAct.value=atr['opcion'];
                        }
                        if(atr['atributo']=='cementerio'){
                            cementerioAct.value=atr['opcion'];
                        }
                        if(atr['atributo']=='sector'){
                            sectorAct.value=atr['opcion'];
                        }
                        if(atr['atributo']=='nivel'){
                            nivelAct.value=atr['opcion'];
                        }
                        if(atr['atributo']=='valor'){
                            valorAct.value=atr['opcion'];
                        }
                        if(atr['atributo']=='cantidad'){
                            cantidadAct.value=atr['opcion'];
                        }
                        
                    })
                }
            });
        }
    </script>
@endsection
@endsection