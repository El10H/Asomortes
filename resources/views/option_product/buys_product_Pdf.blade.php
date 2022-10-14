<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Compras de Productos</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    <h2 class="text-center mb-5">Lista de compras de productos registrados - ASOMORTES</h2>
    <table class="table table-striped ">
        <thead class="">
            <tr align="center">
                <th scope="col">Producto</th>
                <th scope="col">Proveedor</th>
                <th scope="col">Comprobante</th>
                <th scope="col">N° Comprobante</th>
                <th scope="col">Fecha de compra</th>
                <th scope="col">Valor total</th>
                <th scope="col">T. Articulos</th>
                <th scope="col">Descripción</th>                             
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
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>