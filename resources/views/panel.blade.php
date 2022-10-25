@extends('adminlte::page')
@section('title', 'PANEL ADMINISTRATIVO')

@section('css')
    <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">
@endsection



@section('content')

    <div class="container-fluid">
        <div class="p-2">
            <div class="row">
                <div class="col-12  col-md-4 mt-5">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Socios con 1 año de deuda</span>
                            <span class="info-box-number">
                                <small></small>
                                {{ count($sociosDeuda12) }}
                            </span>
                            <a href="{{ route('deuda12') }}" class="small-box-footer text-secondary">Ver lista <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>

                    </div>

                </div>

                <div class="col-12 col-md-4 mt-5">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Socios con 11 meses de deuda</span>
                            <span class="info-box-number">{{ count($sociosDeuda11) }}</span>
                            <a href="{{ route('deuda11') }}" class="small-box-footer text-secondary">Ver lista <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>

                    </div>

                </div>



                <div class="col-12  col-md-4 mt-5">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Socios con 2 meses de deuda</span>
                            <span class="info-box-number">{{count($sociosDeuda2)}}</span>
                            <a href="{{route('deuda2')}}" class="small-box-footer text-secondary">Ver lista <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>

                    </div>

                </div>


            </div>
        </div>

        <div class="p-2">
            <div class="row">
                
                <div class="col-12  col-md-4 mt-1 mb-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Socios Fallecidos</span>
                            <span class="info-box-number">{{ count($fallecidos) }}</span>
                            <a href="{{route('socioFallecidos.index')}}" class="small-box-footer text-secondary">Ver lista <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>

                    </div>

                </div>

                <div class="col-12  col-md-4 mt-1 mb-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Socios Sancionados</span>
                            <span class="info-box-number">
                                <small></small>
                                -
                            </span>
                            <a href="{{ route('deuda12') }}" class="small-box-footer text-secondary">Ver lista <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>

                    </div>

                </div>

                <div class="col-12 col-md-4 mt-1 mb-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Socios Retirados</span>
                            <span class="info-box-number">{{ count($sociosRetirados) }}</span>
                            <a href="{{ route('vistaSocioRetirado') }}" class="small-box-footer text-secondary">Ver lista <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>

                    </div>

                </div>



                
                

            </div>
        </div>

        <div class="col-12 d-flex ">
            <div class="card col-6 mr-1">
                <div class="card-header border-0">
                    <h3 class="card-title">Últimas entregas realizadas</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Beneficiario</th>
                                <th>Estado</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card col-6">
                <div class="card-header border-0">
                    <h3 class="card-title">Últimas compras</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>Boleta</th>
                                <th>Estado</th>
                                <th>Monto total</th>
                                <th>Ver detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    001
                                </td>
                                <td>Recibida</td>
                                <td>
                                    <small class="text-success mr-1">
                                        <i class="">S/</i>
                                        2500
                                    </small>

                                </td>
                                <td>
                                    <a href="#" class="text-muted">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </td>
                            </tr>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12  col-md-12 mt-3 ">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Registrar pago de mensualidad de socio</span>

                    <a href="{{ route('payments.index') }}" class="text-dark"> <strong>Registrar pago</strong> </a>
                </div>
            </div>
        </div>

        <div class="d-flex mt-4">
            <div class="col-md-3">
                <div class="info-box mb-3 bg-success">
                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Listado de productos</span>
                        <span class="info-box-number"><a href="{{ route('option_products.index') }}"
                                class="text-white">Ver</a></span>
                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box mb-3 bg-info">
                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Listado de servicios</span>
                        <span class="info-box-number"><a href="{{ route('option_services.index') }}"
                                class="text-white">Ver</a></span>
                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box mb-3 bg-success">
                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text text-white">Listado de proveedores</span>
                        <span class="info-box-number"><a href="{{ route('providers.index') }}"
                                class="text-white">Ver</a></span>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box mb-3 bg-info">
                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Listado de socios</span>
                        <span class="info-box-number"><a href="{{ route('partners.index') }}"
                                class="text-white">Ver</a></span>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-12 d-flex">
            <div class="card col-6 mr-1">
                <div class="card-header">
                    <h3 class="card-title">Útimos pagos registrados</h3>
                    <div class="card-tools">

                    </div>
                </div>

                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card">
                        @foreach ($ultimosPagos as $item)
                            <li class="item">
                                <div class="product-info">
                                    <a href="" class="product-title">N° Boleta: {{ $item->id }}
                                        <h5><span class="badge badge-warning float-right">S/. {{ $item->monto_total }}
                                            </span></h5>
                                    </a>
                                    <span class="product-description">
                                        <strong>Socio:</strong>
                                        {{ $item->nombre . ' ' . $item->apellido_paterno . ' ' . $item->apellido_materno }}
                                    </span>
                                </div>
                            </li>
                        @endforeach


                    </ul>
                </div>

                <div class="card-footer text-center">
                    <a href="javascript:void(0)" class="uppercase">Ver Más</a>
                </div>

            </div>
            <div class="card col-6">
                <div class="card-header">
                    <h3 class="card-title">últimos socios registrados</h3>
                    <div class="card-tools">

                    </div>
                </div>

                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card">
                        @foreach ($ultimosSocios as $item2)
                            <li class="item">
                                <div class="product-info">
                                    <a href="{{ route('partners.pdf_resumen', ['id' => $item2->id]) }}" class="product-title">{{ $item2->nombre . ' ' . $item2->apellido_paterno . ' ' . $item2->apellido_materno }}
                                        <h5><span class="badge badge-info float-right">Carné: {{$item2->carne}}</span></h5>
                                    </a>
                                    <span class="product-description">
                                        Fecha de ingreso: {{$item2->fecha_de_ingreso}}
                                    </span>

                                </div>
                            </li>
                        @endforeach


                    </ul>
                </div>

                <div class="card-footer text-center">
                    <a href="javascript:void(0)" class="uppercase">Ver Más</a>
                </div>

            </div>

        </div>









    </div>
@endsection
