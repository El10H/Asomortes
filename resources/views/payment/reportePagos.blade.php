<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title> {{ $partner->nombre . ' ' . $partner->apellido_paterno . ' ' . $partner->apellido_materno }}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        .text-right {
            text-align: right;
        }

    </style>

</head>

<body class="login-page" style="background: white">


    <div style="margin-bottom: 0px">&nbsp;</div>

    <div class="row">
        <div class="col-xs-6">
            <h4>ASOMORTES</h4>
            <address>
                <strong>RUC:</strong>123456<br>
                <strong>Email:</strong>hola@asomortes.com<br>
                <strong>Teléfono:</strong>987456321<br>

            </address>
        </div>

        <div class="col-xs-5">

            <div style="margin-bottom: 0px">&nbsp;</div>

            <table style="width: 100%; margin-bottom: 20px">
                <tbody>
                    <tr class="well" style="padding: 5px">
                        <th style="padding: 5px">
                            <div> Fecha de emisión: </div>
                        </th>
                        <td style="padding: 5px" class="text-right"><strong>16/04/2022</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <table class="table">
        <thead style="background: #F5F5F5;">
            <tr>
                <th>Datos del Socio</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Nombre Completo:</strong>
                    {{ $partner->nombre . ' ' . $partner->apellido_paterno . ' ' . $partner->apellido_materno }}
                </td>
                <td><strong>Carné:</strong> {{ $partner->carne }} </td>
            </tr>

        </tbody>
    </table>
    <table class="table table-striped ">
        <thead>
            <th scope="col">Mes</th>
            <th scope="col">Monto</th>
        </thead>

        <tbody>

            @foreach ($datos as $item)
                <tr>    
                    <td>{{ $item->mes }}</td>
                    <td>{{ $item->monto }}</td>
                </tr>
                <div class="row">
                    <div class="col-xs-6"></div>
                    <div class="col-xs-5">
                        <table style="width: 100%">
                            <tbody>
                                <tr class="well" style="padding: 5px">
                                    <th style="padding: 5px">
                                        <div> Total a pagar </div>
                                    </th>
                                    <td style="padding: 5px" class="text-right"><strong> S/ {{$item->monto_total}}.00</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
               
            @endforeach


        </tbody>
    </table>
   




    <div style="margin-bottom: 0px">&nbsp;</div>

    </div>

</body>

</html>
