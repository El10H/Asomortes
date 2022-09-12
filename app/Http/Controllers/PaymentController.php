<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\partner;
use App\Payment;
use App\month;
use App\sanctioned;
use Carbon\Carbon;
use Svg\Tag\Rect;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNan;
use function PHPUnit\Framework\isNull;

class PaymentController extends Controller
{
    
    public function nuevoIndex()
    {
        return view('payment.indexNuevo');
    }
    public function datosSocio($dni)
    {
        $datos = array();

        $socios = partner::where('carne', $dni)->select('id', 'nombre', 'apellido_paterno', 'apellido_materno', 'carne','estado')->first();

        array_push($datos, $socios);

        $pagosVerifica = Payment::orderBy('created_at', 'DESC')
            ->select('id')
            ->where('partner_id', $socios->id)
            ->take(1)
            ->get();

        if (count($pagosVerifica) == 0) {
            $mes = [];
            array_push($datos, $mes);
        }
        
        if (count($pagosVerifica) > 0) {

            $pagos = Payment::orderBy('created_at', 'DESC')
                ->select('id')
                ->where('partner_id', $socios->id)
                ->take(1)
                ->first();

            $mes = month::orderBy('id', 'desc')
                ->select('mes','año')
                ->where('payment_id', $pagos->id)
                ->take(1)
                ->get();
            array_push($datos, $mes);
        }

        echo json_encode($datos);
    }


    public function buscador(Request $request)
    {
        $term = $request->get('term');
        $querys = partner::where('carne', 'LIKE', '%' . $term . '%')->get();
        $data = [];

        foreach ($querys as $query) {
            $data[] = [
                'label' => $query->carne
            ];
        }
        return $data;
    }

    public function guardar(Request $request){

        
        Payment::create([
            'partner_id' => $request->idNombre,
            'fecha_de_pago' => $request->fecha_de_pago,
            'monto_total' => $request->monto,
        ]);

        $ultimoRegistro = payment::where('created_at', payment::max('created_at'))->orderBy('created_at', 'desc')->firstOrFail();
        $meses = $request->mesesPagados;
        $arregloMeses = explode(",", $meses);

        foreach($arregloMeses as $unico){
            $mesAño=explode('-',$unico);
            if($mesAño[0]=='0'){
                $mesGuardar='Enero';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => '20'
                ]);
            }
            if($mesAño[0]=='1'){
                $mesGuardar='Febrero';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => '20'
                ]);
            }
            if($mesAño[0]=='2'){
                $mesGuardar='Marzo';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => '20'
                ]);
            }
            if($mesAño[0]=='3'){
                $mesGuardar='Abril';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => '20'
                ]);
            }
            if($mesAño[0]=='4'){
                $mesGuardar='Mayo';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => '20'
                ]);
            }
            if($mesAño[0]=='5'){
                $mesGuardar='Junio';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => '20'
                ]);
            }
            if($mesAño[0]=='6'){
                $mesGuardar='Julio';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => '20'
                ]);
            }
            if($mesAño[0]=='7'){
                $mesGuardar='Agosto';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => '20'
                ]);
            }
            if($mesAño[0]=='8'){
                $mesGuardar='Setiembre';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => '20'
                ]);
            }
            if($mesAño[0]=='9'){
                $mesGuardar='Octubre';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => '20'
                ]);
            }
            if($mesAño[0]=='10'){
                $mesGuardar='Noviembre';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => '20'
                ]);
            }
            if($mesAño[0]=='11'){
                $mesGuardar='Diciembre';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => '20'
                ]);
            }
        }

        if(isset($request->castigadoGuardar)){
            sanctioned::create([
                'partner_id' => $request->idNombre,
                'fecha_pago' => $request->fecha_de_pago,
                'fecha_habilitacion' => $request->castigadoGuardar
            ]);
        }
        else{
            return view('payment.indexNuevo',['mensaje'=>'Pago registrado correctamente']);
        }
        
        return view('payment.indexNuevo',['mensaje'=>'Pago registrado correctamente']);
      
    }


    public function boleta()
    {
        //Boleta a mostrar
        $boleta = payment::where('created_at', payment::max('created_at'))->orderBy('created_at', 'desc')->firstOrFail();

        //Datos del socio
        $id_partner = $boleta->partner_id;
        $partner = partner::where('id', $id_partner)->firstOrFail();;

        //meses relacionados a la boleta
        $id = $boleta->id;
        $meses = month::where('payment_id', $id)->get();

        $data = compact('meses', 'boleta', 'partner');

        //$view = \View::make('partner.ficha', compact())
        $pdf = \PDF::loadView('payment.boleta', $data);
        //return $pdf->download('PartnerFile-'.$id.'.pdf');
        return $pdf->stream();
    }

    public function reportePagos($id)
    {
        $partner = partner::where('id', $id)->firstOrFail();
        $boleta = payment::where('partner_id', $id)->get();

        $idJoin = $partner->id;


        $datos = payment::select(
            'months.mes as mes',
            'months.monto as monto',
            'payments.id as boletaId',
            'payments.fecha_de_pago as fecha',
            'payments.monto_total as monto_total'
        )
            ->where('payments.partner_id', $idJoin)
            ->join('months', 'payments.id', '=', 'months.payment_id')
            ->get();


        $data = compact('partner', 'boleta', 'datos');

        $pdf = \PDF::loadView('payment.reportePagos', $data);
        //return $pdf->download('PartnerFile-'.$id.'.pdf');
        return $pdf->stream();
        //return $datos;
    }
}