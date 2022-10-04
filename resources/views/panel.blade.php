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
            <div class="col-12  col-md-3 mt-5">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Socios con 1 año de deuda</span>
                        <span class="info-box-number">
                            <small></small>
                            {{ count($sociosDeuda12) }}
                        </span>
                        <a href="{{route('deuda12')}}" class="small-box-footer text-secondary">Ver lista <i class="fas fa-arrow-circle-right"></i></a>
                    </div>

                </div>

            </div>

            <div class="col-12 col-md-3 mt-5">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Socios con 11 meses de deuda</span>
                        <span class="info-box-number">{{count($sociosDeuda11)}}</span>
                        <a href="{{route('deuda11')}}" class="small-box-footer text-secondary">Ver lista <i class="fas fa-arrow-circle-right"></i></a>
                    </div>

                </div>

            </div>



            <div class="col-12  col-md-3 mt-5">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Socios con 2 meses de deuda</span>
                        <span class="info-box-number">0</span>
                        <a href="" class="small-box-footer text-secondary">Ver lista <i class="fas fa-arrow-circle-right"></i></a>
                    </div>

                </div>

            </div>

            <div class="col-12  col-md-3 mt-5">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Socios Fallecidos</span>
                        <span class="info-box-number">{{count($fallecidos)}}</span>
                        <a href="" class="small-box-footer text-secondary">Ver lista <i class="fas fa-arrow-circle-right"></i></a>
                    </div>

                </div>

            </div>

        </div>
    </div>







    
   
</div>
@endsection