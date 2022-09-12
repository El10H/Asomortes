<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Boleta</title>

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
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <th> Fecha de pago: </th>
                        <td class="text-right">{{$boleta->fecha_de_pago}}</td>
                    </tr>
                </tbody>
            </table>

            <div style="margin-bottom: 0px">&nbsp;</div>

            <table style="width: 100%; margin-bottom: 20px">
                <tbody>
                    <tr class="well" style="padding: 5px">
                        <th style="padding: 5px">
                            <div> Número de Boleta </div>
                        </th>
                        <td style="padding: 5px" class="text-right"><strong>000{{$boleta->id}} </strong></td>
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
                    {{$partner->nombre .' '.$partner->apellido_paterno.' '.$partner->apellido_materno}}
                </td>
                <td><strong>Carné:</strong> {{$partner->carne}}</td>
            </tr>

        </tbody>
    </table>

    <table class="table">
        <thead style="background: #F5F5F5;">
            <tr>
                <th>Mes pagado</th>
                <th></th>
                <th class="text-right">Monto</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($meses as $mes)
            <tr>
                <td>
                    <p>{{$mes->mes}}</p>
                </td>
                <td></td>
                <td class="text-right">S/ {{$mes->monto}}.00</td>
            </tr>
            @endforeach
            

           
        </tbody>
    </table>

    <div class="row">
        <div class="col-xs-6"></div>
        <div class="col-xs-5">
            <table style="width: 100%">
                <tbody>
                    <tr class="well" style="padding: 5px">
                        <th style="padding: 5px">
                            <div> Total a pagar </div>
                        </th>
                        <td style="padding: 5px" class="text-right"><strong> S/ {{$boleta->monto_total}}.00</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-bottom: 0px">&nbsp;</div>

    </div>

</body>

</html>
