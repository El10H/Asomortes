@extends('adminlte::page')
@section('title', 'OPCIONES DE PRODUCTOS')


@section('css')
    <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
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
                    document.getElementById("cantidad").value = 1;

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

    <style>
        label.error {
            color: red;
            font-size: 0.8em;
        }

        .rojito {
            color: red;
            font-weight: 500;
        }
    </style>
@endsection

@section('content')
    <div class="p-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-white" style="background-color:#004173">
                        Opciones de productos
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-left ">
                                        @can('option_products')
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#agregarOptionProducto" onclick="agregarSku()">
                                                Agregar Opción de Producto
                                            </button>
                                        @endcan

                                        <a href="{{ route('option_products.pdf') }}" target="_blank"
                                            class="btn btn-success">Exportar PDF</a>
                                    </div>

                                    <div class="float-right ">
                                        @can('option_products.create_buys')
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#agregarCompraProducto">
                                                Agregar Compras
                                            </button>
                                        @endcan

                                        <a href="{{ route('vercompras_productos') }}" class="btn btn-success">Ver
                                            Compras</a>

                                        <!--<button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                                data-bs-target="#verComprasProducto">
                                                                Ver Compras
                                                            </button>-->
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
                                    @can('option_products')
                                        <th width=15%>Acciones</th>
                                    @endcan
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

                                        @can('option_products')
                                            <td>
                                                <form action="{{ route('option_products.destroy', $sku_option_product->sku) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    @can('option_products')
                                                        <button type="submit" class="btn btn-outline-danger"
                                                            onclick="return confirm('¿Desea eliminar {{ $sku_option_product->nombre }}?')">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    @endcan

                                                    @foreach ($option_products as $option_product)
                                                        @if ($sku_option_product->sku == $option_product->sku)
                                                            <?php $categoria = $option_product->id_products; ?>
                                                        @endif
                                                    @endforeach

                                                    @can('option_products')
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#actualizar{{ $sku_option_product->sku }}"
                                                            class="btn btn-outline-success"
                                                            onclick="camposActualizar('{{ $sku_option_product->sku }}')">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                </form>

                                                <!-- Modal para editar Opciones de Producto -->
                                                <div class="modal fade" id="actualizar{{ $sku_option_product->sku }}"
                                                    tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-m">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModal">Actualizar Opciones
                                                                    Producto</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                                    aria-label="Close"> <span
                                                                        aria-hidden="true">&times;</span></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form class="row g-3"
                                                                    action="{{ route('option_products.update', $sku_option_product->sku) }}"
                                                                    method="POST"
                                                                    id="formOptionProduct-editar{{ $sku_option_product->sku }}">
                                                                    @method('PUT')
                                                                    @csrf

                                                                    <div class="col-2 mt-2">
                                                                        <label for="disabledTextInput" class="form-label">Sku:
                                                                        </label>
                                                                        <input type="text" id="skuAct"
                                                                            class="form-control" name="skuAct" readonly
                                                                            value="{{ $sku_option_product->sku }}">
                                                                    </div>

                                                                    <div class="col-4 mt-2">
                                                                        <label for="disabledTextInput"
                                                                            class="form-label">Valor<span
                                                                                class="rojito">(*)</span></label>
                                                                        <input type="number" min="0" step="0.01"
                                                                            id="valorAct{{ $sku_option_product->sku }}"
                                                                            class="form-control" name="valorAct"
                                                                            placeholder="No requerido" disabled>
                                                                    </div>

                                                                    <div class="col-6 mt-2">
                                                                        <label for="disabledTextInput"
                                                                            class="form-label">Cantidad <span
                                                                                class="rojito">(*)</span></label>
                                                                        <input type="number" min="1" step="1"
                                                                            id="cantidadAct{{ $sku_option_product->sku }}"
                                                                            class="form-control" name="cantidadAct"
                                                                            placeholder="No requerido" disabled>
                                                                    </div>

                                                                    <div class="col-6 mt-2">
                                                                        <label for="disabledTextInput"
                                                                            class="form-label">Modelo <span
                                                                                class="rojito">(*)</span></label>
                                                                        <input type="text"
                                                                            id="modeloAct{{ $sku_option_product->sku }}"
                                                                            class="form-control" name="modeloAct"
                                                                            placeholder="No requerido" disabled>
                                                                    </div>

                                                                    <div class="col-6 mt-2">
                                                                        <label for="disabledTextInput"
                                                                            class="form-label">Cementerio <span
                                                                                class="rojito">(*)</span></label>
                                                                        <input type="text"
                                                                            id="cementerioAct{{ $sku_option_product->sku }}"
                                                                            class="form-control" name="cementerioAct"
                                                                            placeholder="No requerido" disabled>
                                                                    </div>

                                                                    <div class="col-6 mt-2">
                                                                        <label for="disabledTextInput"
                                                                            class="form-label">Sector <span
                                                                                class="rojito">(*)</span></label>
                                                                        <input type="text"
                                                                            id="sectorAct{{ $sku_option_product->sku }}"
                                                                            class="form-control" name="sectorAct"
                                                                            placeholder="No requerido" disabled>
                                                                    </div>


                                                                    <div class="col-6 mt-2">
                                                                        <label for="disabledTextInput"
                                                                            class="form-label">Nivel <span
                                                                                class="rojito">(*)</span></label>
                                                                        <input type="text"
                                                                            id="nivelAct{{ $sku_option_product->sku }}"
                                                                            class="form-control" name="nivelAct"
                                                                            placeholder="No requerido" disabled>
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
                    @endcan
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
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <form class="row g-3 " action="{{ route('option_products.store') }}" method="POST"
                        id="formOptionProduct">
                        @csrf

                        <div class="col-2 mt-2">
                            <label for="disabledTextInput" class="form-label">Sku: </label>
                            <input type="text" id="sku" class="form-control" name="sku" readonly>
                        </div>



                        <div class="col-10 mt-2">
                            <label for="inputEmail4" class="form-label">N° comprobante <span
                                    class="rojito">(*)</span></label>
                            <select class="custom-select" id="select_comprobante" name='comprobante'
                                onchange="habilitar()" required>

                                <option selected>-Seleccione-</option>
                                @foreach ($buys_products as $buys_product)
                                    @if ($buys_product->estado == 'Registrada')
                                        <option value="{{ $buys_product['id_products'] }}">
                                            {{ $buys_product['boletaFactura'] }} N° {{ $buys_product['n_comprobante'] }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>



                        <div class="col-6 mt-2">
                            <label for="disabledTextInput" class="form-label">Valor <span
                                    class="rojito">(*)</span></label>
                            <input type="number" min="0" step="0.01" id="valor" class="form-control"
                                name="valor">
                        </div>

                        <div class="col-6 mt-2">
                            <label for="disabledTextInput" class="form-label">Cantidad <span
                                    class="rojito">(*)</span></label>
                            <input type="number" min="1" step="1" id="cantidad" class="form-control"
                                name="cantidad">
                        </div>

                        <div class="col-6 mt-2">
                            <label for="disabledTextInput" class="form-label">Modelo <span
                                    class="rojito">(*)</span></label>
                            <input type="text" id="modelo" class="form-control" name="modelo">
                        </div>

                        <div class="col-6 mt-2">
                            <label for="disabledTextInput" class="form-label">Cementerio <span
                                    class="rojito">(*)</span></label>
                            <input type="text" id="cementerio" class="form-control" name="cementerio">
                        </div>

                        <div class="col-6 mt-2">
                            <label for="disabledTextInput" class="form-label">Sector <span
                                    class="rojito">(*)</span></label>
                            <input type="text" id="sector" class="form-control" name="sector">
                        </div>


                        <div class="col-6 mt-2">
                            <label for="disabledTextInput" class="form-label">Nivel <span
                                    class="rojito">(*)</span></label>
                            <input type="text" id="nivel" class="form-control" name="nivel">
                        </div>
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




    <!-- Modal para agregar compra de Producto -->
    <div class="modal fade" id="agregarCompraProducto" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Compras</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">

                    <form class="row g-3 " action="{{ route('option_products.create_buys') }}" method="POST"
                        id="hola">
                        @csrf

                        <div class="col-6 mt-2">
                            <label for="inputEmail4" class="form-label">Productos <span
                                class="rojito">(*)</span></label>
                            <select class="custom-select" name='producto'>
                                <option selected>Seleccione</option>

                                @foreach ($products as $product)
                                    <option value="{{ $product['id'] }}">{{ $product['nombre'] }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-6 mt-2">
                            <label for="inputEmail4" class="form-label">Proveedores <span
                                class="rojito">(*)</span></label>
                            <select class="custom-select" name='proveedor'>
                                <option selected>Seleccione</option>

                                @foreach ($providers as $provider)
                                    <option value="{{ $provider['id'] }}">{{ $provider['razon_social'] }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-6 mt-2">
                            <label for="inputEmail4" class="form-label">Boleta/Factura <span
                                class="rojito">(*)</span></label>
                            <select class="custom-select" name='boletaFactura' required>
                                <option selected>Seleccione</option>
                                <option value="Boleta">Boleta</option>
                                <option value="Factura">Factura</option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="disabledTextInput" class="form-label">N° de comprobante <span
                                class="rojito">(*)</span></label>
                            <input type="text" class="form-control" name="n_comprobante">
                        </div>

                        <div class="col-6 mt-2 justify-content-center">
                            <label for="inputEmail4" class="form-label">Fecha</label>
                            <input type="date" class="form-control" name='fecha_compra'
                                value="{{ $now->format('Y-m-d') }}">
                        </div>

                        <div class="col-4 mt-2">
                            <label for="disabledTextInput" class="form-label">Valor total <span
                                class="rojito">(*)</span></label>
                            <input type="number" min="1" step="0.01" class="form-control" name="valorTotal">
                        </div>

                     

                        <div class="col-2 mt-2">
                            <label for="disabledTextInput" class="form-label">T. Artículos <span
                                class="rojito">(*)</span></label>
                            <input type="number" min="1" step="0.01" class="form-control" name="total_articulos">
                        </div>

                        <div class="col-12 mt-2 form-floating">
                            <label for="floatingTextarea">Descripción de la compra... <span
                                class="rojito">(*)</span></label>
                            <textarea class="form-control" rows="5" placeholder="Agregue la descripción de la compra..."
                                name="descripcion" id="floatingTextarea"></textarea>

                        </div>
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


   

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            jQuery.extend(jQuery.validator.messages, {
                required: "Este campo es obligatorio.",
                remote: "Por favor, rellena este campo.",
                email: "Por favor, escribe una dirección de correo válida",
                date: "Por favor, escribe una fecha válida.",
                number: "Por favor, escribe un número entero válido.",
                digits: "Por favor, escribe sólo dígitos.",

            });
            $.validator.addMethod("soloNumeros", function(value, element) {
                var pattern = /^([0-9]{9,9})$/;
                return this.optional(element) || pattern.test(value);
            }, "Ingrese un número válido de 9 dígitos");

            $.validator.addMethod("ruc", function(value, element) {
                var pattern = /^([0-9]{11,11})$/;
                return this.optional(element) || pattern.test(value);
            }, "Ingrese un RUC válido");

            var nrows = 0;
            $("table tr").each(function() {
                nrows++;
            })

            $("#formOptionProduct").validate({
                rules: {
                    valor: {
                        required: true,
                    },
                    cantidad: {
                        required: true,
                    },
                    comprobante: {
                        required: true
                    },
                },

            });

            $("#hola").validate({
                rules: {
                    n_comprobante: {
                        required: true,
                    },
                    fecha_compra: {
                        required: true,
                    },
                    valorTotal: {
                        required: true
                    },
                    total_articulos:{
                        required: true 
                    },
                    descripcion:{
                        required: true 
                    },
                    boletaFactura:{
                        required: true 
                    }
                    
                },
            });



            for (var i = 1; i <= nrows + 5; i++) {
                $("#formOptionProduct-editar" + i).validate({
                    rules: {
                        valorAct: {
                            required: true,
                        },
                        cantidadAct: {
                            required: true,
                        },

                    },
                });
                console.log(nrows);
            }



        });


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

                    var modeloAct = document.getElementById('modeloAct' + skuActualizar);
                    var cementerioAct = document.getElementById('cementerioAct' + skuActualizar);
                    var sectorAct = document.getElementById('sectorAct' + skuActualizar);
                    var nivelAct = document.getElementById('nivelAct' + skuActualizar);
                    var valorAct = document.getElementById('valorAct' + skuActualizar);
                    var cantidadAct = document.getElementById('cantidadAct' + skuActualizar);
                    var response = JSON.parse(responseActualizar);
                    console.log(response);

                    response[1].map(function(atr2) {
                        if (atr2['atributo'] == 'modelo') {
                            modeloAct.disabled = false;
                            modeloAct.removeAttribute("placeholder", "No requerido");
                        }
                        if (atr2['atributo'] == 'cementerio') {
                            cementerioAct.disabled = false;
                            cementerioAct.removeAttribute("placeholder", "No requerido");
                        }
                        if (atr2['atributo'] == 'sector') {
                            sectorAct.disabled = false;
                            sectorAct.removeAttribute("placeholder", "No requerido");
                        }
                        if (atr2['atributo'] == 'nivel') {
                            nivelAct.disabled = false;
                            nivelAct.removeAttribute("placeholder", "No requerido");
                        }
                        if (atr2['atributo'] == 'valor') {
                            valorAct.disabled = false;
                            valorAct.removeAttribute("placeholder", "No requerido");
                        }
                        if (atr2['atributo'] == 'cantidad') {
                            cantidadAct.disabled = false;
                            cantidadAct.removeAttribute("placeholder", "No requerido");
                        }
                    })

                    response[0].map(function(atr) {
                        if (atr['atributo'] == 'modelo') {
                            modeloAct.value = atr['opcion'];
                        }
                        if (atr['atributo'] == 'cementerio') {
                            cementerioAct.value = atr['opcion'];
                        }
                        if (atr['atributo'] == 'sector') {
                            sectorAct.value = atr['opcion'];
                        }
                        if (atr['atributo'] == 'nivel') {
                            nivelAct.value = atr['opcion'];
                        }
                        if (atr['atributo'] == 'valor') {
                            valorAct.value = atr['opcion'];
                        }
                        if (atr['atributo'] == 'cantidad') {
                            cantidadAct.value = atr['opcion'];
                        }

                    })
                }
            });
        }
    </script>
@endsection
@endsection
