<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Socios Fallecidos</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    <h2 class="text-center mb-5">Socios Fallecidos - ASOMORTES</h2>
    <table class="table table-striped" style="width:100%" id="data">
        <thead>
            <tr>

                <th scope="col">Dni</th>
                <th scope="col">Carne</th>
                <th scope="col">Nombres y Apellidos</th>
                <th scope="col">Fecha de fallecido</th>
                <th scope="col">Acta de defunción</th>
                <th scope="col">Certificado de defunción</th>
                
                <th></th>
              

            </tr>
        </thead>
        <tbody>
            @foreach ($fallecidos as $item)
                <tr>
                    <td>{{$item->dni}}</td>
                    <td>{{$item->carne}}</td>
                    <td>{{$item->nombre.' '.$item->apellido_paterno.' '.$item->apellido_materno}}</td>
                    <td>18/08/24</td>
                    <td><a href="{{url($item->acta)}}" class="btn btn-outline-secondary btn-sm">Ver acta</a> </td>
                    <td><a href="{{url($item->certificado)}}" class="btn btn-outline-secondary btn-sm">Ver certificado</a> </td>
                   
                </tr>
            @endforeach
         



        </tbody>
    </table>
</body>
</html>