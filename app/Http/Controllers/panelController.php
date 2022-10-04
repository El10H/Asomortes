<?php

namespace App\Http\Controllers;
use App\attribute_product;
use App\beneficiary;
use App\buys_product;
use App\partner;
use App\executive;
use App\Month;
use App\option_product;
use App\option_service;
use App\partner_deceased;
use App\Payment;
use App\product;
use App\retired;
use App\service;
use App\sanctioned;
use Illuminate\Auth\Events\Validated;
use Carbon\Carbon;
use Illuminate\Support\Arr;


use Illuminate\Http\Request;

class panelController extends Controller
{
    public function index()
    {

        //Socios con deuda 11 meses y 12 meses
        $sociosDeuda12 = array();
        $sociosDeuda11 = array();
        $partners = partner::all();
        foreach ($partners as $partner) {
            $boleta = Payment::orderBy('created_at', 'DESC')
                ->select('partner_id')->where('partner_id', $partner->id)->take(1)
                ->get();

            if (count($boleta) > 0) {
                $pago = Payment::orderBy('created_at', 'DESC')
                    ->select('id', 'partner_id')->where('partner_id', $partner->id)
                    ->take(1)
                    ->first();

                $mes = month::orderBy('id', 'desc')->select('mes', 'año')
                    ->where('payment_id', $pago->id)
                    ->take(1)
                    ->first();


                if ($mes->mes == 'Enero') {
                    $mesNum = '01';
                }
                if ($mes->mes == 'Febrero') {
                    $mesNum = '02';
                }
                if ($mes->mes == 'Marzo') {
                    $mesNum = '03';
                }
                if ($mes->mes == 'Abril') {
                    $mesNum = '04';
                }
                if ($mes->mes == 'Mayo') {
                    $mesNum = '05';
                }
                if ($mes->mes == 'Junio') {
                    $mesNum = '06';
                }
                if ($mes->mes == 'Julio') {
                    $mesNum = '07';
                }
                if ($mes->mes == 'Agosto') {
                    $mesNum = '08';
                }
                if ($mes->mes == 'Setiembre') {
                    $mesNum = '09';
                }
                if ($mes->mes == 'Octubre') {
                    $mesNum = 10;
                }
                if ($mes->mes == 'Noviembre') {
                    $mesNum = 11;
                }
                if ($mes->mes == 'Diciembre') {
                    $mesNum = 12;
                }

                $date = Carbon::now();
                $date2 = Carbon::now();
                $deuda12 = $date->subMonths(12);
                $deuda11 = $date2->subMonths(11);

                $fechaSocio = Carbon::parse($mes->año . '-' . $mesNum . '-' . '01');


                if ($fechaSocio->format('Y') == $deuda12->format('Y')  && $fechaSocio->format('m') == $deuda12->format('m') && $partner->estado != 'Retirado') {
                    array_push($sociosDeuda12, $partner->id);
                }
                if ($fechaSocio->format('Y') == $deuda11->format('Y')  && $fechaSocio->format('m') == $deuda11->format('m')) {
                    array_push($sociosDeuda11, $partner->id);
                }
            }
        }


        //Socios fallecidos
        $fallecidosContar = partner_deceased::all();

        return view('panel', ['sociosDeuda12' => $sociosDeuda12, 'sociosDeuda11' => $sociosDeuda11 , 'fallecidos' => $fallecidosContar]);
    }
}
