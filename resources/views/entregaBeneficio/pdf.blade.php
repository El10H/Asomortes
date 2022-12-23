
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $partners->nombre . ' ' . $partners->apellido_paterno }}</title>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">


</head>


<body>

    <div class="">
        <h1 class="text-center mt-4 mb-4">
            {{ $partners->nombre . ' ' . $partners->apellido_paterno . ' ' . $partners->apellido_materno }}</h1>

        <h4 class="text-center">Ficha de entrega de beneficio N°  {{ $benefit_deliveries->id }}</h4>

        <div class="card mt-5">
            <div class="card-header p-1 ml-2">
                Datos personales del socio fallecido
            </div>
            <div class="m-2 col-6">
                <strong>Dni:</strong> {{ $partners->Dni }} <br>
                <strong>Carné:</strong> {{ $partners->carne }} <br>
                <strong>Fecha de ingreso:</strong> {{ $partners->fecha_de_ingreso }} <br>
            </div>
        </div>


        <div class="card mt-4">
            <div class="card-header p-1 ml-2">Beneficiario</div>
            <div class="m-2 col-6">
                    <strong>Nombre:</strong> {{ $beneficiaries->nombres_apellidos }} <br>
                    <strong>Dni:</strong> {{ $beneficiaries->dni }} <br>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header p-1 ml-2">Servicio entregado</div>
            <div class="m-2 col-12">
                

                @if (strpos($benefit_deliveries->tipo_beneficio, "Productos"))
                    <strong>Productos:</strong><br>

                    <?php $cadena = ''; $producto=0; $count=0?>
                    @foreach ($benefit_products as $benefit_product)
                        @foreach ($option_products as $option_product)
                            @if($benefit_product->sku_option_products == $option_product->sku && $benefit_deliveries->id == $benefit_product->id_benefit_deliveries )
                                @foreach ($attribute_products as $attribute_product)
                                    <?php $producto=$attribute_product->id_products?>

                                    @if($attribute_product->id == $option_product->id_attribute_products)
                                        <?php
                                            if($count==0){
                                                foreach ($products as $product){
                                                    if($product->id == $producto){
                                                        $cadena .= $product->nombre .': '; 
                                                        $count=1;
                                                    }
                                                }
                                            }
                                        
                                            if($attribute_product->atributo === "cantidad"){
                                                $cad = ucfirst($attribute_product->atributo) . ' -> ' . ucfirst(1);
                                                $cadena .= $cad . ' | ';
                                            }else if($attribute_product->atributo != "valor"){
                                                $cad = ucfirst($attribute_product->atributo) . ' -> ' . ucfirst($option_product->opcion);
                                                $cadena .= $cad . ' | ';
                                            }
                                        ?>
                                    @endif 
                                @endforeach
                            @endif
                        @endforeach

                        
                        <?php 
                        if (!empty($cadena)){
                            $cadena = substr($cadena, 0, -3) . '.';
                            echo "<strong>- </strong>";
                            echo "$cadena  <br>";
                        } ?>
                        <?php $cadena = ""; $count=0; ?>
                        
                    @endforeach
                @endif

                @if (strpos($benefit_deliveries->tipo_beneficio, "Servicios"))
                    <strong>Servicios:</strong><br>
                    <?php
                        $cad = '';
                    ?>
                    @foreach ($benefit_services as $benefit_service)
                        @foreach ($option_services as $option_service)
                            @if($benefit_service->id_option_services == $option_service->id && $benefit_deliveries->id == $benefit_service->id_benefit_deliveries )
                                <?php
                                $cad = ucfirst($option_service->nombre). '.';

                                if (!empty($cad)){
                                    echo "<strong>- </strong>";
                                    echo "$cad  <br>";
                                }
                                ?>
                            @endif
                        @endforeach
                    @endforeach
                @endif

                @if (strpos($benefit_deliveries->tipo_beneficio, "Efectivo"))
                    <strong>Efectivo:</strong><br>

                    @foreach ($benefit_cashes as $benefit_cash)
                        @if($benefit_deliveries->id == $benefit_cash->id_benefit_deliveries )
                            <?php
                            $cad = ucfirst($benefit_cash->efectivo). '.';

                            if (!empty($cad)){
                                echo "<strong>- </strong>";
                                echo "$cad  <br>";
                            }
                            ?>
                        @endif
                    @endforeach
                    
                @endif

                

            </div>
        </div>

</body>

</html>
