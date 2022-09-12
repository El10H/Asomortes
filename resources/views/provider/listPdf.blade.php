<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Proveedores</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    <h2 class="text-center mb-5">Lista de proveedores registrados - ASOMORTES</h2>
    <table class="table table-striped ">
        <thead class="">
            <tr align="center">
                
                <th width= 25% scope="col">Razon Social</th>
                <th width= 25% scope="col">Dirección</th>
                <th width= 10% scope="col">Ruc</th>
                <th width= 10% scope="col">Teléfono</th>
                <th width= 15% scope="col">Email</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($providers as $provider)
                <tr>

                    <td align="left">{{ $provider->razon_social }}</td>
                    <td align="left">{{ $provider->direccion}}</td>
                    <td align="left">{{ $provider->ruc }}</td>
                    <td align="left">{{ $provider->telefono}}</td>
                    <td align="left">{{ $provider->email}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>