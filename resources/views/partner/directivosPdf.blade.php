<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Socios Directivos</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    <h2 class="text-center mb-5">Socios Directivos - ASOMORTES</h2>
    <table class="table table-striped" style="width:100%" id="data">
        <thead>
            <tr>
                <th scope="col">Cargo</th>
                <th scope="col">Dni</th>
                <th scope="col">Nombres y Apellidos</th>
                <th scope="col">Carné</th>
                <th scope="col">Celular</th>
                <th scope="col">Fecha de inicio</th>
                <th scope="col">Fecha de finalización</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($directivos as $item)
                <tr>
                    <td>{{$item->cargo}}</td>
                    <td>{{$item->partner->Dni}}</td>
                    <td>{{$item->partner->nombre .' '.$item->partner->apellido_paterno .' '.$item->partner->apellido_materno}}</td>
                    <td>{{$item->partner->carne}}</td>
                    <td>{{$item->partner->celular}}</td>
                    <td>{{$item->fecha_inicio}}</td>
                        @if($item->fecha_fin === Null )
                            <td>Actualmente</td>
                        @else 
                            <td>{{$item->fecha_fin}}</td>
                        @endif
                    
                </tr>

                
            @endforeach
        </tbody>
    </table>
</body>
</html>