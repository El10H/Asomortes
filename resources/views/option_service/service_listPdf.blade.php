<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Opciones de Servicios</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    <h2 class="text-center mb-5">Lista de opciones de servicios registrados - ASOMORTES</h2>
    <table class="table table-striped ">
        <thead class="">
            <tr>
                
                <th width= 20% scope="col">Nombre</th>
                <th width= 25% scope="col">Descripción</th>
                <th width= 20% scope="col">Categoría</th>
                <th width= 10% scope="col">Valor</th>
                <th width= 5% scope="col">Stock</th>
                <th width= 5% scope="col">Devolución</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($option_services as $option_service)
                <tr>

                    <td align="left">{{ $option_service->nombre }}</td>
                    <td align="left">{{ $option_service->descripcion }}</td>

                    @foreach ($services as $service)
                        @if ($option_service->id_services == $service->id)
                            <td align="left">{{ $service->nombre}}</td>
                        @endif
                    @endforeach
                                        
                    <td align="center">S/. {{ $option_service->valor}}</td>
                    <td align="center">{{ $option_service->stock}}</td>

                    @foreach ($services as $service)
                        @if ($option_service->id_services == $service->id)
                            <?php
                            $dev=$service->devolucion;
                            ?>
                            
                            @if($dev === "on")
                                <td align="center">Si</td>
                            @else
                                <td align="center">No</td>
                            @endif
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>