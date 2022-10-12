<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Productos</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    <h2 class="text-center mb-5">Lista de categorías de productos registrados - ASOMORTES</h2>
    <table class="table table-striped ">
        <thead class="">
            <tr align="center">
                <th width="30%" scope="col">Nombre</th>
                <th width="35%" scope="col">Descripción</th>
                <th width="45%" scope="col">Atributos</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($products as $product)
                <tr>
                    <td align="left">{{ $product->nombre }}</td>
                    <td align="left">{{ $product->descripcion}}</td>
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

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>