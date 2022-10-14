<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Compras de Servicios</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    <h2 class="text-center mb-5">Lista de compras de servicios registrados - ASOMORTES</h2>
    <table class="table table-striped ">
        <thead class="">
            <tr align="center">
                <th scope="col">Servicio</th>
                <th scope="col">Proveedor</th>
                <th scope="col">Comprobante</th>
                <th scope="col">N° Comprobante</th>
                <th scope="col">Fecha de compra</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Valor unitario</th>
                <th scope="col">Valor total</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($buys_services as $buys_service)
                <tr>
                    @foreach ($option_services as $option_service)
                        @if ($buys_service->id_services == $option_service->id)
                            <td align="left">{{ $option_service->nombre }}</td>
                        @endif
                    @endforeach

                    @foreach ($providers as $provider)
                        @if ($buys_service->id_providers == $provider->id)
                            <td align="left">{{ $provider->razon_social }}</td>
                        @endif
                    @endforeach

                    <td align="left">{{ $buys_service->boletaFactura }}</td>
                    <td align="left">{{ $buys_service->n_comprobante }}</td>
                    <td align="center">{{ $buys_service->fecha_compra }}</td>
                    <td align="center">{{ $buys_service->cantidad }}</td>
                    <td align="center">{{ $buys_service->valor_unitario }}</td>
                    <td align="center">{{ $buys_service->valor_total }}</td>
                    
                
                </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>