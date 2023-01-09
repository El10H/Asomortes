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
use App\payment;
use App\product;
use App\provider;
use App\retired;
use App\service;
use App\sanctioned;
use App\benefit_delivery;
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
        $sociosDeuda2 = array();
        $partners = partner::all();
        foreach ($partners as $partner) {
            $boleta = payment::orderBy('created_at', 'DESC')
                ->select('partner_id')->where('partner_id', $partner->id)->take(1)
                ->get();

            if (count($boleta) > 0) {
                $pago = payment::orderBy('created_at', 'DESC')
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
                $deuda2 = $date2->subMonths(2);

                $fechaSocio = Carbon::parse($mes->año . '-' . $mesNum . '-' . '01');


                if ($fechaSocio->format('Y') == $deuda12->format('Y')  && $fechaSocio->format('m') == $deuda12->format('m') && $partner->estado != 'Retirado') {
                    array_push($sociosDeuda12, $partner->id);
                }
                if ($fechaSocio->format('Y') == $deuda11->format('Y')  && $fechaSocio->format('m') == $deuda11->format('m')) {
                    array_push($sociosDeuda11, $partner->id);
                }
                if ($fechaSocio->format('Y') == $deuda2->format('Y')  && $fechaSocio->format('m') == $deuda2->format('m')) {
                    array_push($sociosDeuda2, $partner->id);
                }
            }
        }


        //Socios fallecidos
        $fallecidosContar = partner_deceased::all();

        //Últimos pagos:
        $ultimosPagos = payment::orderBy('payments.created_at', 'DESC')
        ->select('payments.id','payments.partner_id','payments.fecha_de_pago','payments.monto_total','partners.nombre','partners.apellido_paterno', 'partners.apellido_materno')
        ->join('partners','partners.id','=','payments.partner_id')
        ->take(5)
        ->get();

        $ultimasEntregas = Benefit_delivery::orderBy('benefit_deliveries.created_at', 'DESC')
        ->select('benefit_deliveries.id','benefit_deliveries.id_partners', 'benefit_deliveries.tipo_beneficio', 'benefit_deliveries.estado','partners.nombre','partners.apellido_paterno', 'partners.apellido_materno')
        ->join('partners','partners.id','=','benefit_deliveries.id_partners')
        ->take(5)
        ->get();

        $providers=provider::orderBy('id','DESC')
        ->take(5)
        ->get();
        
        //últimos socios registrados

        $ultimosSociosRegistrados=partner::orderBy('fecha_de_ingreso','DESC')
        ->take(5)
        ->get();


        //Socios retirados
        $sociosRetirados = retired::all();
        $sociosSancionados = sanctioned::all();
        

        return view('panel', [
            'sociosDeuda12' => $sociosDeuda12, 
            'sociosDeuda11' => $sociosDeuda11,
            'sociosDeuda2' => $sociosDeuda2 , 
            'fallecidos' => $fallecidosContar , 
            'ultimosPagos' => $ultimosPagos ,
            'ultimasEntregas' => $ultimasEntregas,
            'providers' => $providers,
            'ultimosSocios' =>$ultimosSociosRegistrados,
            'sociosRetirados' => $sociosRetirados,
            'sociosSancionados' => $sociosSancionados
             ] );

      
    }
}
