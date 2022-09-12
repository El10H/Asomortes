<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $partner->nombre . ' ' . $partner->apellido_paterno }}</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">


</head>


<body>

    <div class="">
        <h1 class="text-center mt-4 mb-4">
            {{ $partner->nombre . ' ' . $partner->apellido_paterno . ' ' . $partner->apellido_materno }}</h1>

        <h4 class="text-center">Fecha de ingreso: {{ $partner->fecha_de_ingreso }}</h4>

        <div class="card mt-5">
            <div class="card-header p-1 ml-2">
                Datos Personales
            </div>
            <div class="m-2 col-6">
                <strong>Dni:</strong> {{ $partner->Dni }} <br>
                <strong>Carné:</strong> {{ $partner->carne }} <br>
                <strong>Estado civil:</strong> {{ $partner->estado_civil }}
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header p-1 ml-2">Información de Contacto</div>
            <div class="m-2 col-6">
                <strong>Celular:</strong> {{ $partner->celular }} <br>
                <strong>Teléfono:</strong> {{ $partner->teléfono }} <br>
                <strong>Email:</strong> {{ $partner->email }} <br>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header p-1 ml-2">
                Información de Nacimiento
            </div>
            <div class="m-2 col-6">
                <strong>Fecha de nacimiento:</strong> {{ $partner->fecha_de_nac }} <br>
                <strong>Departamento:</strong> {{ $partner->dpto_nac }} <br>
                <strong>Provincia:</strong> {{ $partner->provincia_nac }} <br>
                <strong>Distrito:</strong> {{ $partner->distrito_nac }}
            </div>
        </div>


        <div class="card mt-4">
            <div class="card-header p-1 ml-2">Domicilio Actual</div>
            <div class="m-2 col-6">
                <strong>Domicilio:</strong> {{ $partner->domicilio }} <br>
                <strong>Departamento:</strong> {{ $partner->dpto_actual }} <br>
                <strong>Provincia:</strong> {{ $partner->provincia_actual }} <br>
                <strong>Distrito:</strong> {{ $partner->distrito_actual }}
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header p-1 ml-2">Información profesional</div>
            <div class="m-2 col-6">
                <strong>Profesión:</strong> {{ $partner->profesion }} <br>
                <strong>Grado de instrucción:</strong> {{ $partner->grado_de_instruccion }} <br>
                <strong>Actividad:</strong> {{ $partner->actividad }} 
                
            </div>
        </div>


        <div class="card mt-4">
            <div class="card-header p-1 ml-2">Beneficiarios</div>
            <div class="m-2 col-6">
                @foreach ($beneficiaries as $beneficiary)
                    <strong>Nombre:</strong>
                    {{ $beneficiary->nombre . ' ' . $beneficiary->apellido_paterno . ' ' . $beneficiary->apellido_materno }}
                    <br>
                    <strong>Dni:</strong> {{ $beneficiary->dni }}

                    <br>
                    <br>
                @endforeach

            </div>
        </div>

</body>

</html>
