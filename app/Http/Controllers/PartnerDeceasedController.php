<?php

namespace App\Http\Controllers;

use App\partner;
use App\partner_deceased;
use App\Payment;
use App\Month;
use App\sanctioned;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PartnerDeceasedController extends Controller
{

    public function index()
    {
        $fallecidos = partner_deceased::select(
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'dni',
            'carne',
            'acta',
            'certificado',

        )
            ->join('partners', 'partner_deceaseds.partner_id', '=', 'partners.id')
            ->get();

        return view('partner.listadoFallecidos', ['fallecidos' => $fallecidos]);
    }

    public function pdf()
    {
        $fallecidos = partner_deceased::select(
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'dni',
            'carne',
            'acta',
            'certificado',

        )
            ->join('partners', 'partner_deceaseds.partner_id', '=', 'partners.id')
            ->get();

        $data = compact('fallecidos');

        //$view = \View::make('partner.ficha', compact())
        $pdf = \PDF::loadView('partner.fallecidosPdf', $data);
        //return $pdf->download('PartnerFile-'.$id.'.pdf');
        return $pdf->setPaper('a4', 'landscape')->stream();

        //return $data;
    }



    public function store(Request $request)
    {
        $partner = $request->socio;
        $request->validate([
            'acta' => 'required|image|max:2048',
            'certificado' => 'required|image|max:2048'
        ]);

        $acta = $request->file('acta')->store('public/ActaDeDefunción');
        $certificado = $request->file('certificado')->store('public/certiificadoDeDefunción');

        $urlActa = Storage::url($acta);
        $urlCertificado = Storage::url($certificado);

        $socio = partner::where('id', $partner)->first();

        //datos para valida fecha de ingreso
        $fechaIngreso = Carbon::parse($socio->fecha_de_ingreso);
        $actual = Carbon::now();
        $resta = $actual->subMonths(12);

        //datos para valida mes de pago
        $boleta = Payment::orderBy('created_at', 'DESC')
            ->select('partner_id')->where('partner_id', $socio->id)->take(1)
            ->get();

        $pagosAlDia='No';
        if (count($boleta) > 0) {
            $fechaParaVlidarPagos= Carbon::now();

            $pago = Payment::orderBy('created_at', 'DESC')
                ->select('id', 'partner_id')->where('partner_id', $socio->id)
                ->take(1)
                ->first();

            $mes = month::orderBy('id', 'desc')->select('mes', 'año', 'payment_id')
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
            
            if($fechaParaVlidarPagos->format('m') == $mesNum && $fechaParaVlidarPagos->format('Y') == $mes->año){
                $pagosAlDia='Si';
            }
        }

        //Datos para validar si esta sancionado

        $sancionadoValor='';
        $sancionados= partner::select('partners.id')
        ->where('partners.id',$partner)
        ->join('sanctioneds','sanctioneds.partner_id','=','partners.id')
        ->get();

    
        if(count($sancionados)==0){
            $sancionadoValor='sin sancion';
        }

        if(count($sancionados)>0){
           
            $socioSancionado=sanctioned::where('partner_id',$partner)->firstOrFail();
            $dateActual=Carbon::now();
        

            if($dateActual->gt($socioSancionado->fecha_habilitacion)){
                $sancionadoValor='sin sancion';
            }

            if($dateActual->lt($socioSancionado->fecha_habilitacion)){
                $sancionadoValor='sancionado';
            }
        }
        //mayor que
        if ($resta->gte($fechaIngreso) && $pagosAlDia=='Si' && $sancionadoValor=='sin sancion') {
            partner_deceased::create([
                'partner_id'=>$partner,
                'acta'=>$urlActa,
                'certificado'=>$urlCertificado,
                'estado'=>'ACTO PARA BENEFICIO'    
            ]);
        } else {
            partner_deceased::create([
                'partner_id'=>$partner,
                'acta'=>$urlActa,
                'certificado'=>$urlCertificado,
                'estado'=>'NO ACTO PARA BENEFICIO'
            ]);
        }
        return back()->with('fallecido','Socio actualizado correctamente');
    }
}