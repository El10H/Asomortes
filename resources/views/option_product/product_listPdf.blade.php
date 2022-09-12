<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Opciones Productos</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    <h2 class="text-center mb-5">Lista de productos registrados - ASOMORTES</h2>
    <table class="table table-striped ">
        <thead class="">
            <tr align="center">
                <th width="10%" scope="col">Sku</th>
                <th width="20%" scope="col">Categoría</th>
                <th width="70%" scope="col">Atributos</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($sku_option_products as $sku_option_product)
                <tr>
                    <td align="center">{{ $sku_option_product->sku }}</td>

                    @foreach ($buys_products as $buys_product)
                        @if ($sku_option_product->id_vouchers == $buys_product->id)
                            @foreach ($products as $product)
                                @if ($product->id == $buys_product->id_products)
                                    <td align="left">{{ $product->nombre }}</td>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    <?php $array1 = []; $i = 0; $cadena = ''; ?>

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

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>