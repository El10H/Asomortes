<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Beneficiarios</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    <h2 class="text-center mb-5">SOCIO - BENEFICIARIO</h2>
    <table class="table table-striped ">
        <thead class="">
            <tr>
                
                <th scope="col">Socio</th>
                <th scope="col">Beneficiario</th>
                <th scope="col">Dni</th>
                <th scope="col">Celular</th>
                <th scope="col">Email</th>
                <th scope="col">Fecha de ingreso</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($beneficiaries as $beneficiary)
                <tr>

                    <td>{{ $beneficiary->nombre_partner . ' ' . $beneficiary->apellidoPaterno_partner. ' ' . $beneficiary->apellidoMaterno_partner }}
                    </td>
                    <td>{{ $beneficiary->nombre_Beneficiary . ' ' . $beneficiary->apellidoPaterno_beneficiary. ' ' . $beneficiary->apellidoMaterno_beneficiary}}</td>
                    <td>{{ $beneficiary->dni_beneficiary}}</td>
                    <td>{{ $beneficiary->celular_beneficiary}}</td>
                    <td>{{ $beneficiary->email_beneficiary}}</td>
                    <td>{{ $beneficiary->ingreso_beneficiary}}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>