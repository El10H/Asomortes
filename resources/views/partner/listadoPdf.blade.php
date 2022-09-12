<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Socios</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    <h2 class="text-center mb-5">Socios ASOMORTES</h2>
    <table class="table table-striped ">
        <thead class="">
            <tr>
                
                <th scope="col">Dni</th>
                <th scope="col">Nombres y Apellidos</th>
                <th scope="col">Carné</th>
                <th scope="col">Celular</th>
                <th scope="col">Email</th>
                <th scope="col">Fecha de ingreso</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($partners as $partner)
                <tr>

                    <td>{{ $partner->Dni }}</td>
                    <td>{{ $partner->nombre . ' ' . $partner->apellido_paterno . ' ' . $partner->apellido_materno }}
                    </td>
                    <td>{{ $partner->carne }}</td>
                    <td>{{ $partner->celular}}</td>
                    <td>{{ $partner->email}}</td>
                    <td>{{ $partner->fecha_de_ingreso}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>