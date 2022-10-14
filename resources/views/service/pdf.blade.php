<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Servicios</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    <h2 class="text-center mb-5">Lista de servicios registrados - ASOMORTES</h2>
    <table class="table table-striped ">
        <thead class="">
            <tr>
                
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Devolución</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($services as $service)
                <tr>

                    <td>{{ $service->nombre }}</td>
                    <td>{{ $service->descripcion}}</td>
                    <?php
                    $dev=$service->devolucion;
                    ?>
                    
                    @if($dev === "on")
                        <td align="center">Si</td>
                    @else
                        <td align="center">No</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>