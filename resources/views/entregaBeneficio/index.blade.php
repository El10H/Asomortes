@extends('adminlte::page')
@section('title', 'ENTREGA DE BENEFICIOS')


@section('css')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">

@endsection

@endsection

@section('content')
<div class="p-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Entrega de Beneficio
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">

                                    <form class="form-inline ml-3">
                                        <div class="d-flex">
                                            <div>
                                                <input type="search" class="form-control mr-2"
                                                    placeholder="Carné del Socio" id="buscador" name="search">
                                            </div>

                                            <div class="input-group-append">
                                                <input type="button" value="Buscar" id="principal"
                                                    onclick="llenarDatos()" class="btn btn-success">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pr-5 pl-5">
                        <form action="{{ route('guardarEntrega') }}" method="POST">
                            @csrf
                            <div class="card ">
                                <div class="card-header">
                                    Información del Socio
                                </div>
                                <div class="card-body">
                                    <div class="col-12 d-flex">
                                        <div class="col-md-12 mt-2">
                                            <label for="" class="form-label">Nombre Completo:</label>
                                            <input type="text" class="form-control" id="nombre" value=""
                                                name="nombreSocio">
                                        </div>
                                    </div>

                                    <input type="hidden" class="form-control" id="idSocio" value=""
                                                name="idSocio">

                                    <div class="col-12 d-flex">
                                        <div class="col-md-6 mt-2">
                                            <label for="" class="form-label">Carné:</label>
                                            <input type="text" class="form-control" id="carne" value=""
                                                name="carneSocio">
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="" class="form-label">Dni:</label>
                                            <input type="text" class="form-control" id="dni" value=""
                                                name="dniSocio">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    Información del Beneficiario
                                </div>
                                <div class="card-body">

                                    <div class="col-12 d-flex">
                                        <div class="col-md-6 mt-2">
                                            <label for="" class="form-label">Beneficiarios</label>
                                            <select class="custom-select" id="selectBeneficiario" name="idBeneficiario">
                                                <option>Seleccione</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <label for="" class="form-label">Dni:</label>
                                            <input type="text" class="form-control" id="dniBeneficiario"
                                                name="dniBeneficiario" value="">
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="card ">
                                <div class="card-header">
                                    Seleccionar Entrega
                                </div>
                                <div class="card-body">
                                    <div id="cajaEntrega">
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <div class="col-md-6 mt-2">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text text-white"
                                                        style="background: #00609C;" id="basic-addon3">Valor de
                                                        Beneficio</span>
                                                    <input type="text" class="form-control" id="valor"
                                                        placeholder="S/00.00" onkeyup="valorCambiar()"
                                                        name="valorBeneficio">
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex">
                                            <div class="col-md-6 mt-2">
                                                <input type="checkbox" class="form-check-input" name="efectivo"
                                                    value="efectivo" id="efectivo">
                                                <label class="form-check-label" for="exampleCheck1">Efectivo</label>
                                            </div>
                                        </div></br>
                                    </div>
                                </div>

                                <div class="col-md-12 d-flex mt-2">
                                    <div class="col-md-6 mt-2">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">Se entregará en
                                                efectivo:</span>
                                            <input type="text" class="form-control" id="total"
                                                placeholder="S/00.00" name="entregaEnEfectivo">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <button type="reset" class="btn btn-secondary">Limpiar formulario</button>
                                <button type="button" class="btn btn-info">Imprimir</button>
                            </div>


                            <div class="oculto" id="oculto">


                            </div>
                        </form>


                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        function valorCambiar() {
            var valor2 = document.getElementById('valor2');
            var v = document.getElementById('valor').value;
            valor2.value = v;
        }

        function restarValor() {
            console.log('evento restar valor');
            var valorBen = document.getElementById('valor');
            var valor_total_elems = document.querySelectorAll('.valoresRestar');
            var suma = 0;
            valor_total_elems.forEach(e => (suma += isNaN(parseInt(e.value)) ? 0 : parseInt(e.value)));

            //console.log(valorBen.value - suma);
            var sumaTotal = isNaN(parseInt(valorBen.value)) - isNaN(parseInt(suma));
            document.querySelector('#total').value = valorBen.value - suma;
        }


        window.onload = function() {
            $('#oculto').hide();
            var caja = document.getElementById('cajaEntrega');
            $.ajax({
                type: "GET",
                url: "../../serviciosProductos",
                success: function(response) {
                    var arrayDatos = JSON.parse(response);
                    var servicios = arrayDatos[0];
                    var productos = arrayDatos[2];
                    var opcionesDeServicios = arrayDatos[1];
                    var opcionesDeProductos = arrayDatos[3];
                    var skuComparar = arrayDatos[4];
                    var probando = arrayDatos[5];
                    var compras = arrayDatos[6];
                    var igual0 = arrayDatos[7];

                    var texto = '';
                    var cad = '';
                    var cadena = '';

                    var divCaja;
                    productos.forEach(element => {
                        var divProducto = document.createElement('div');
                        divProducto.classList.add('col-md-12', 'd-flex');
                        var divLabel = document.createElement('div');
                        divLabel.classList.add('col-md-2', 'mt-2')
                        var divSelectsProducto = document.createElement('div');
                        divSelectsProducto.classList.add('col-md-3', 'mt-2');

                        divCaja = document.createElement('div');
                        divCaja.classList.add('col-md-7', 'mt-2');
                        var cajita = document.createElement('input');
                        cajita.setAttribute('type', 'text');
                        cajita.setAttribute('id', 'cajita' + element['id']);
                        cajita.disabled = true;
                        cajita.classList.add('form-control');

                        divCaja.appendChild(cajita);

                        var checkboxProducto = document.createElement('input');
                        checkboxProducto.type = 'checkbox';
                        checkboxProducto.classList.add('form-check-input');
                        checkboxProducto.setAttribute('id', 'checkProd' + element['id']);
                        checkboxProducto.setAttribute('name', "idProductos[]");
                        checkboxProducto.setAttribute('value', element['id']);
                        checkboxProducto.classList.add('estado');

                        var labelProducto = document.createElement('label')
                        labelProducto.htmlFor = element['nombre'];
                        labelProducto.classList.add('form-check-label');
                        labelProducto.appendChild(document.createTextNode(element['nombre']));

                        var SelectsProducto = document.createElement('select');
                        SelectsProducto.setAttribute('id', 'opciones' + element['id']);
                        SelectsProducto.setAttribute('name', 'skuOpcionesProductos[]');
                        SelectsProducto.classList.add('custom-select');
                        SelectsProducto.disabled = true;
                        var opcion1Prod = document.createElement("option");
                        opcion1ProdTexto = document.createTextNode('Seleccione');
                        opcion1Prod.setAttribute('value', '0');
                        opcion1Prod.appendChild(opcion1ProdTexto);
                        SelectsProducto.appendChild(opcion1Prod);

                        var inputGuardarOculto = document.createElement('input');
                        inputGuardarOculto.setAttribute('type', 'hiden');
                        inputGuardarOculto.setAttribute('id', 'cajaOculta' + element['id']);
                        inputGuardarOculto.classList.add('valoresRestar');
                        inputGuardarOculto.onchange = restarValor;
                        var divOculto = document.getElementById('oculto');
                        divOculto.appendChild(inputGuardarOculto);

                        divLabel.appendChild(checkboxProducto);
                        divLabel.appendChild(labelProducto);

                        divSelectsProducto.appendChild(SelectsProducto)
                        divProducto.appendChild(divLabel);

                        divProducto.appendChild(divSelectsProducto);
                        divProducto.appendChild(divCaja);
                        caja.appendChild(divProducto);

                        for (var e = 0; e < opcionesDeProductos.length; e++) {
                            if (element['id'] == opcionesDeProductos[e].id_products) {
                                opcionProd = document.createElement("option");
                                opcionProd.setAttribute('value',
                                    opcionesDeProductos[e].sku)
                                opcionProd.classList.add('hola');
                                opcion1ProdTexto = document.createTextNode(
                                    opcionesDeProductos[e]
                                    .sku);
                                opcionProd.appendChild(opcion1ProdTexto);
                                SelectsProducto.appendChild(opcionProd);

                                igual0.forEach(prueba => {
                                    if (prueba['sku'] == opcionesDeProductos[e].sku) {
                                        opcionProd.remove();
                                    }
                                })
                            }
                        }
                        
                        $('#opciones' + element['id']).on('change', function() {
                            var cambiar;
                            var textoNuevo = '';
                            var primera = '';
                            var si = element['id'];
                            var resta;

                            var se = document.getElementById('opciones' + element['id']);
                            var selectesOption = se.options[se
                                    .selectedIndex]
                                .value;
                            var cajaGuardar = document.getElementById(
                                'cajaOculta' + element['id']);


                            probando.forEach(op => {
                                if (selectesOption == op['sku']) {
                                    primera = op['atributo'] + ': ' + op[
                                        'opcion'];
                                    textoNuevo = textoNuevo.concat(primera +
                                        ', ');


                                    if (op['atributo'] == 'valor') {
                                        var valorOpcion = (isNaN(parseFloat(op[
                                            'opcion']))) ? 0 : parseFloat(op[
                                            'opcion']);
                                        cajaGuardar.value = valorOpcion;
                                    }
                                    if (op['opcion'] == 0) {
                                        console.log(op['sku']);
                                    }
                                }

                            });
                            restarValor();

                            //No borrar esto:
                            cajita.value = textoNuevo;
                        })

                        //check habilitar y deshabilitar
                        $("#efectivo").on('change', function() {
                            if ($(this).is(':checked')) {
                                document.getElementById("checkProd" + element['id'])
                                    .disabled = true;
                                var valor = document.getElementById('valor').value;
                                document.getElementById('total').value = valor;

                            } else {
                                document.getElementById("checkProd" + element['id'])
                                    .disabled = false;
                                document.getElementById('total').value = '';
                            }
                        });



                        $('#checkProd' + element['id']).on('change', function() {
                            ///restarValor();
                            if ($(this).is(':checked')) {
                                restarValor();
                                document.getElementById('opciones' + element['id'])
                                    .disabled = false;
                                document.getElementById('cajita' + element['id']).disabled =
                                    false;

                            } else {
                                document.getElementById('opciones' + element['id'])
                                    .disabled = true;
                                document.getElementById('cajita' + element['id']).disabled =
                                    true;
                                document.getElementById('cajita' + element['id']).value =
                                    '';
                                $('#opciones' + element['id']).val(0);
                                document.getElementById('cajaOculta' + element['id'])
                                    .value = 0;
                                restarValor();
                            }
                        });


                        $('.estado').on('change', function() {
                            if ($(this).is(':checked')) {
                                document.getElementById('efectivo').disabled = true;
                            } else {
                                validar();
                            }
                        });
                        var x = document.getElementById("opciones"+element['id']).length;
                        console.log(x);
                        if(x == '1'){
                            console.log('acaaa');
                            document.getElementById("checkProd"+element['id']).disabled=true;
                        }
                    });



                    servicios.forEach(elementos => {


var divServicio = document.createElement('div');
divServicio.classList.add('col-md-12', 'd-flex');
var divLabel = document.createElement('div');
divLabel.classList.add('col-md-2', 'mt-2')
var divSelects = document.createElement('div');
divSelects.classList.add('col-md-3', 'mt-2');

var checkboxServicios = document.createElement('input');
checkboxServicios.type = 'checkbox';
checkboxServicios.setAttribute('value', elementos['id']);
checkboxServicios.disabled = true;
checkboxServicios.setAttribute('id', 'checkServicio' + elementos['id']);
checkboxServicios.setAttribute('name', 'idServicios[]');
checkboxServicios.classList.add('form-check-input');

var labelServivios = document.createElement('label')
labelServivios.htmlFor = elementos['nombre'];
labelServivios.classList.add('form-check-label');
labelServivios.appendChild(document.createTextNode(elementos['nombre']));

var selectServicios = document.createElement('select');
selectServicios.classList.add('custom-select');
selectServicios.setAttribute('name', 'idOpcionesServicios[]')
selectServicios.setAttribute('id', 'opcionesServicios' + elementos['id']);
selectServicios.disabled = true;
var opcion1 = document.createElement("option");
opcion1Texto = document.createTextNode('Seleccione');
opcion1.appendChild(opcion1Texto);

selectServicios.appendChild(opcion1);
divSelects.appendChild(selectServicios);
divLabel.appendChild(checkboxServicios);
divLabel.appendChild(labelServivios);

divServicio.appendChild(divLabel);
divServicio.appendChild(divSelects);

caja.appendChild(divServicio);


var stocks = 0;
for (var i = 0; i < opcionesDeServicios.length; i++) {
    if (elementos['id'] == opcionesDeServicios[i].id_services) {
        stocks = stocks + opcionesDeServicios[i].stock;

        //console.log(opcionesDeServicios[i].id)

        if (elementos['devolucion'] == 'on') {
            //console.log(stocks  );
            if (stocks == 1) {
                //console.log(stocks);
                document.getElementById('checkServicio' + elementos['id'])
                    .disabled = false;
            }
        }
        if (elementos['devolucion'] == 'off') {
            document.getElementById('checkServicio' + elementos['id'])
                .disabled = false;
        }
    }


    if (elementos['devolucion'] == 'on') {
        if (elementos['id'] == opcionesDeServicios[i].id_services) {
            if (opcionesDeServicios[i].stock > 0) {

                var opcion2 = document.createElement("option");
                opcion2.setAttribute('value', opcionesDeServicios[i].id)
                opcion2Texto = document.createTextNode(opcionesDeServicios[
                    i].nombre);
                opcion2.appendChild(opcion2Texto);
                selectServicios.appendChild(opcion2);
            }

            if (opcionesDeServicios[i].stock == 0) {
                var opcion3 = document.createElement("option");
                opcion3.setAttribute('value', opcionesDeServicios[i].id)
                opcion3Texto = document.createTextNode(opcionesDeServicios[
                    i].nombre);
                opcion3.disabled = true;
                opcion3.appendChild(opcion3Texto);
                selectServicios.appendChild(opcion3);
            }

        }
    }
    if (elementos['devolucion'] == 'off') {
        if (elementos['id'] == opcionesDeServicios[i].id_services) {
            var opcion2 = document.createElement("option");
            opcion2.setAttribute('value', opcionesDeServicios[i].id)
            opcion2Texto = document.createTextNode(opcionesDeServicios[i]
                .nombre);
            opcion2.appendChild(opcion2Texto);
            selectServicios.appendChild(opcion2);
        }
    }
}


$('#checkServicio' + elementos['id']).on('change', function() {
    if ($(this).is(':checked')) {
        document.getElementById('opcionesServicios' + elementos[
            'id']).disabled = false;
        var to = document.getElementById('total');

    } else {
        document.getElementById('opcionesServicios' + elementos[
            'id']).disabled = true;
    }
})
});


                }
            });
        }

        function limpiar(id) {
            var ca = document.getElementById('cajita' + id);
            ca.innerHTML = ' ';
        }


        $('#buscador').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('buscadorEntrega') }}",
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data)
                    }
                });
            }
        });

        function llenarDatos() {
            var carneSocio = document.getElementById("buscador").value;
            var uri = encodeURI(carneSocio);

            $.ajax({
                type: "GET",
                url: "../../llenarDatosEntrega" + uri,
                success: function(response) {
                    var arrayDatos = JSON.parse(response);
                    var datosSocio = arrayDatos[0];
                    var Beneficiarios = arrayDatos[1];

                    console.log(Beneficiarios);
                    document.getElementById('nombre').value = datosSocio.nombre + ' ' + datosSocio
                        .apellido_paterno + ' ' + datosSocio.apellido_materno;
                    document.getElementById('carne').value = datosSocio.carne;
                    document.getElementById('dni').value = datosSocio.Dni;
                    document.getElementById('idSocio').value = datosSocio.id;


                    Beneficiarios.forEach(element => {
                        $('#selectBeneficiario').append(
                            `<option value="${element['id']}">${element['nombres_apellidos']}</option>`
                        );
                    });

                    var selectBeneficiarios = document.getElementById('selectBeneficiario');



                    $('#selectBeneficiario').on('change', function() {
                        var opcionSeleccionada = selectBeneficiarios.options[selectBeneficiarios
                            .selectedIndex].value;

                        console.log(opcionSeleccionada);

                        Beneficiarios.forEach(element => {
                            if (element['id'] == opcionSeleccionada) {
                                document.getElementById('dniBeneficiario').value = element[
                                    'dni'];
                            }
                        });
                    });

                }
            })
        }

        //Funciones a llamar: 
        function validar() {
            console.log('si');
            var total_seleccionados = 0;
            $('.estado').each(function() {
                if (this.checked) {
                    total_seleccionados += 1;
                }
            })

            if (total_seleccionados == 0) {
                document.getElementById('efectivo').disabled = false;
            }
        }

        function habilitar(id) {
            $('#checkProd' + element['id']).on('change', function() {
                if ($(this).is(':checked')) {
                    document.getElementById('opciones' + element['id']).disabled = false;
                    console.log('sdfdi');
                }
            })
        }
    </script>
@endsection
@endsection