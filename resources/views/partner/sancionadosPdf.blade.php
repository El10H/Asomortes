<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Socios Sancionados</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    <h2 class="text-center mb-5">Socios Fallecidos - ASOMORTES</h2>
    <table class="table table-striped" style="width:100%" id="data">
        <thead>
            <tr>
                <th scope="col">Dni</th>
                <th scope="col">Nombres y Apellidos</th>
                <th scope="col">Carné</th>
                <th scope="col">Fecha de pago</th>
                <th scope="col">Fecha de habilitación</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($socios as $socio)
                <tr>
                    <td>{{ $socio->Dni }}</td>
                    <td>{{ $socio->nombre . ' ' . $socio->apellido_paterno . ' ' . $socio->apellido_materno }}
                    </td>
                    <td>{{ $socio->carne }}</td>
                    <td>{{ $socio->fecha_pago}}</td>
                    <td>{{$socio->fecha_habilitacion}}</td>
         
                </tr>

           
            @endforeach

        </tbody>
    </table>
</body>
</html>