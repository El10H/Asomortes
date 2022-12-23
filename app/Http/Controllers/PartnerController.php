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
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class PartnerController extends Controller
{
    public function __construct(){
        $this->middleware('can:partners')->only('destroy', 'store', 'update');
        $this->middleware('can:partners.index')->only('index');
    }

    // Método para listar datos y buscar
    public function index()
    {
        $partners = partner::all();
        $now = Carbon::now();
        $arreglo = array();

        foreach ($partners as $partner) {
            $boleta = Payment::orderBy('created_at', 'DESC')
                ->select('partner_id')->where('partner_id', $partner->id)->take(1)
                ->get();

            if (count($boleta) > 0) {
                $pago = Payment::orderBy('created_at', 'DESC')
                    ->select('partner_id')->where('partner_id', $partner->id)
                    ->take(1)
                    ->first();

                $mes = month::orderBy('id', 'desc')->select('mes', 'año')
                    ->where('payment_id', $pago->id)
                    ->take(1)
                    ->first();

                array_push($arreglo, $partner->id);
            }
            if (count($boleta) == 0) {
            }
        }

        return view('partner.index', ['partners' => $partners, 'now' => $now, 'pagos' => $arreglo]);

        //return $vector;
    }

    //Métdo para crear un nuevo socio
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellido_paterno' => ['required'],
            'apellido_materno' => ['required'],
            'carne' => ['required', 'numeric', 'min:6'],
            'fecha_de_ingreso' => ['required'],
            'fecha_de_nac' => ['required'],
            'distrito_nac' => ['required'],
            'provincia_nac' => ['required'],
            'dpto_nac' => ['required'],
            'profesion' => ['required'],
            'grado_de_instruccion' => ['required'],
            'actividad' => ['required'],
            'estado_civil' => ['required'],
            'dni' => ['required', 'min:8'],
            'domicilio' => ['required'],
            'distrito_actual' => ['required'],
            'provincia_actual' => ['required'],
            'dpto_actual' => ['required'],
            'celular' => ['required', 'min:9'],
            'teléfono' => ['required', 'numeric', 'min:6'],
            'email' => ['required', 'email', 'unique:partners']
        ]);
        partner::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'carne' => $request->carne,
            'fecha_de_ingreso' => $request->fecha_de_ingreso,
            'fecha_de_nac' => $request->fecha_de_nac,
            'distrito_nac' => $request->distrito_nac,
            'provincia_nac' => $request->provincia_nac,
            'dpto_nac' => $request->dpto_nac,
            'profesion' => $request->profesion,
            'grado_de_instruccion' => $request->grado_de_instruccion,
            'actividad' => $request->actividad,
            'estado_civil' => $request->estado_civil,
            'Dni' => $request->dni,
            'domicilio' => $request->domicilio,
            'distrito_actual' => $request->distrito_actual,
            'provincia_actual' => $request->provincia_actual,
            'dpto_actual' => $request->dpto_actual,
            'celular' => $request->celular,
            'teléfono' => $request->teléfono,
            'email' => $request->email,

        ]);



        $now = Carbon::now();

        $ultimoRegistro = partner::orderBy('created_at', 'DESC')
            ->take(1)
            ->firstOrFail();


        return view('beneficiary.form', ['partner' => $ultimoRegistro, 'now' => $now]);
    }

    //Método para eliminar 
    public function destroy(partner $partner)
    {
        $partner->delete();
        return redirect('/partners');
    }

    //Métodos para actualizar un socio
    public function edit($id, Request $request)
    {
        $partner = partner::findOrFail($id);
        return view('partner.edit', ['partner' => $partner]);
    }

    public function update(Request $request, $id)
    {
        $partner = partner::findOrFail($id);

        $partner->nombre = $request->nombre;
        $partner->apellido_paterno = $request->apellido_paterno;
        $partner->apellido_materno = $request->apellido_materno;
        $partner->carne = $request->carne;
        $partner->distrito_nac = $request->distrito_nac;
        $partner->provincia_nac = $request->provincia_nac;
        $partner->dpto_nac = $request->dpto_nac;
        $partner->profesion = $request->profesion;
        $partner->grado_de_instruccion = $request->grado_de_instruccion;
        $partner->actividad = $request->actividad;
        $partner->estado_civil = $request->estado_civil;
        $partner->Dni = $request->dni;
        $partner->domicilio = $request->domicilio;
        $partner->distrito_actual = $request->distrito_actual;
        $partner->provincia_actual = $request->provincia_actual;
        $partner->dpto_actual = $request->dpto_actual;
        $partner->celular = $request->celular;
        $partner->teléfono = $request->telefono;
        $partner->email = $request->email;

        $partner->save();


        //return view('partner.edit',['partner'=>$partner]);
        //return back()->with('status','Socio actualizado correctamente');
        return redirect('/partners');
    }

    //Método para generar el pdf de la ficha socio
    public function pdf_resumen($id)
    {
        $partner = partner::findOrFail($id);
        $beneficiaries = beneficiary::where('partner_id', '=', $id)->get();
        $data = compact('partner', 'beneficiaries');

        //$view = \View::make('partner.ficha', compact())
        $pdf = \PDF::loadView('partner.ficha', $data);
        //return $pdf->download('PartnerFile-'.$id.'.pdf');
        return $pdf->stream();
    }

    //Método para generar el pdf de la lista general de socios
    public function pdf()
    {
        $partners = partner::latest()->orderby('id', 'desc')->get();
        $data = compact('partners');

        //$view = \View::make('partner.ficha', compact())
        $pdf = \PDF::loadView('partner.pdf', $data);
        //return $pdf->download('PartnerFile-'.$id.'.pdf');
        return $pdf->setPaper('a4', 'landscape')->stream();

        //return $data;
    }

    public function cargoDirectivo(Request $request)
    {
        $date = Carbon::now();
        executive::create([
            'partner_id' => $request->socio,
            'cargo' => $request->cargo,
            'fecha_inicio' => $date,
        ]);

        return back()->with('status', 'Socio actualizado correctamente');
    }

    public function quitarCargo($id)
    {
        $date = Carbon::now();
        $directivo = executive::where('id', $id)->first();
        $directivo->update([
            'fecha_fin' => $date
        ]);

        return back();
    }

    public function vistaDirectivo()
    {
        $directivos = executive::all();
        return view('partner.directivos', ['directivos' => $directivos]);
    }

    public function directivosPdf()
    {
        $directivos = executive::all();

        $data = compact('directivos');

        //$view = \View::make('partner.ficha', compact())
        $pdf = \PDF::loadView('partner.directivosPdf', $data);
        //return $pdf->download('PartnerFile-'.$id.'.pdf');
        return $pdf->setPaper('a4', 'landscape')->stream();

        //return $data;
    }


    public function resumenSocio()
    {
        return view('partner.resumenSocio');
    }

    public function resumenDatos($nombre)
    {

        $partner = partner::select('nombre', 'apellido_paterno', 'apellido_materno', 'dni', 'carne', 'id', 'fecha_de_ingreso')
            ->where('carne', $nombre)
            ->first();

        $beneficiarios = beneficiary::select('nombres_apellidos', 'dni')
            ->where('partner_id', $partner->id)
            ->get();

        $payment = Payment::orderBy('created_at', 'DESC')
            ->select('id')
            ->where('partner_id', $partner->id)
            ->take(1)
            ->get();


        if (count($payment) > 0) {
            $pago = Payment::orderBy('created_at', 'DESC')
                ->select('id')
                ->where('partner_id', $partner->id)
                ->take(1)
                ->first();


            $mes = Month::orderBy('created_at', 'DESC')
                ->select('mes', 'año')
                ->where('payment_id', $pago->id)
                ->take(1)
                ->first();
        }

        if (count($payment) == 0) {
            $mes = '';
        }
        //Sacar estado de socio (socio sancionado)
        $sancionadoValor = '';
        $sancionados = partner::select('partners.id')
            ->where('partners.id', $partner->id)
            ->join('sanctioneds', 'sanctioneds.partner_id', '=', 'partners.id')
            ->get();

        if (count($sancionados) == 0) {
            $sancionadoValor = 'sin sancion';
        }

        if (count($sancionados) > 0) {
            $socioSancionado = sanctioned::where('partner_id', $partner->id)->first();
            $dateActual = Carbon::now();

            if ($dateActual->gt($socioSancionado->fecha_habilitacion)) {
                $sancionadoValor = 'sin sancion';
            }

            if ($dateActual->lt($socioSancionado->fecha_habilitacion)) {
                $sancionadoValor = 'sancionado';
            }
        }

        $fallecido = partner_deceased::where('partner_id', $partner->id)->get();
        $retirado = retired::where('partner_id', $partner->id)->get();

        if (count($fallecido) > 0) {
            $estado = 'Socio fallecido';
        }
        if (count($fallecido) == 0) {
            if (count($retirado) > 0) {
                $estado = 'Socio retirado por falta de pagos';
            }
            if (count($retirado) == 0) {
                if ($sancionadoValor == 'sin sancion') {
                    $estado = 'Socio activo';
                }
                if ($sancionadoValor == 'sancionado') {
                    $estado = 'sancionado';
                }
            }
        }

        $arrayDatos = array();
        array_push($arrayDatos, $partner);
        array_push($arrayDatos, $beneficiarios);
        array_push($arrayDatos, $payment);
        array_push($arrayDatos, $mes);
        array_push($arrayDatos, $estado);

        echo json_encode($arrayDatos);
    }


    //Panel administrativo
    public function panel()
    {
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

        return view('panel', ['sociosDeuda12' => $sociosDeuda12, 'sociosDeuda11' => $sociosDeuda11]);
    }

    public function deuda11()
    {
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

                $date2 = Carbon::now();
                $deuda11 = $date2->subMonths(11);

                $fechaSocio = Carbon::parse($mes->año . '-' . $mesNum . '-' . '01');

                if ($fechaSocio->format('Y') == $deuda11->format('Y')  && $fechaSocio->format('m') == $deuda11->format('m')) {
                    array_push($sociosDeuda11, $partner);
                    $boletaEnviar = $pago;
                    $mesEnviar = $mes;
                    return view('partner.deuda11', ['socios' => $sociosDeuda11, 'boleta' => $boletaEnviar, 'mes' => $mesEnviar]);
                }
            }
        }
        //return $pago;
        return view('partner.deuda11', ['socios' => [], 'boleta' => [], 'mes' => []]);
    }

    public function deuda12()
    {
        $sociosDeuda12 = array();
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

                $date = Carbon::now();
                $deuda12 = $date->subMonths(12);

                $fechaSocio = Carbon::parse($mes->año . '-' . $mesNum . '-' . '01');


                if ($fechaSocio->format('Y') == $deuda12->format('Y')  && $fechaSocio->format('m') == $deuda12->format('m') && $partner->estado != 'Retirado') {
                    array_push($sociosDeuda12, $partner);
                    $boletaEnviar = $pago;
                    $mesEnviar = $mes;
                    return view('partner.deuda12', ['socios' => $sociosDeuda12, 'boleta' => $boletaEnviar, 'mes' => $mesEnviar]);
                }
            }
        }

        return view('partner.deuda12', ['socios' => [], 'boleta' => [], 'mes' => []]);
    }

    public function deuda2()
    {
        $sociosDeuda2 = array();
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

                $date = Carbon::now();
                $deuda2 = $date->subMonths(2);

                $fechaSocio = Carbon::parse($mes->año . '-' . $mesNum . '-' . '01');


                if ($fechaSocio->format('Y') == $deuda2->format('Y')  && $fechaSocio->format('m') == $deuda2->format('m')) {
                    array_push($sociosDeuda2, $partner);
                    $boletaEnviar = $pago;
                    $mesEnviar = $mes;
                    return view('partner.deuda2', ['socios' => $sociosDeuda2, 'boleta' => $boletaEnviar, 'mes' => $mesEnviar]);
                }
            }
        }

        return view('partner.deuda2', ['socios' => [], 'boleta' => [], 'mes' => []]);
    }

    public function socioRetirado($id)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        retired::create([
            'partner_id' => $id,
            'fecha_retiro' => $date
        ]);

        partner::where('id', $id)->update(['estado' => 'Retirado']);
        return back();
    }
    public function listaSociosRetirados()
    {
        $socios = partner::select('carne', 'Dni', 'celular', 'email', 'nombre', 'apellido_paterno', 'apellido_materno', 'fecha_retiro')
            ->join('retireds', 'partner_id', '=', 'partners.id')
            ->get();

        return view('partner.sociosRetirados', ['socios' => $socios]);
    }

    public function listaSociosSancionados()
    {
        $socios = partner::select('carne', 'Dni', 'celular', 'email', 'nombre', 'apellido_paterno', 'apellido_materno', 'fecha_pago', 'fecha_habilitacion')
            ->join('sanctioneds', 'partner_id', '=', 'partners.id')
            ->get();

        return view('partner.sociosSancionados', ['socios' => $socios]);
    }

    public function listaSociosSancionados_Pdf()
    {
        $socios = partner::select('carne', 'Dni', 'celular', 'email', 'nombre', 'apellido_paterno', 'apellido_materno', 'fecha_pago', 'fecha_habilitacion')
            ->join('sanctioneds', 'partner_id', '=', 'partners.id')
            ->get();

            $data = compact('socios');

            //$view = \View::make('partner.ficha', compact())
            $pdf = \PDF::loadView('partner.sancionadosPdf', $data);
            //return $pdf->download('PartnerFile-'.$id.'.pdf');
            return $pdf->setPaper('a4', 'landscape')->stream();
    }


    //Métodos de entrega de beneficios
    public function entrega()
    {
        return view('entregaBeneficio.index');
    }

    public function buscadorEntrega(Request $request)
    {
        $term = $request->get('term');
        $querys = partner::select('partners.carne', 'partner_deceaseds.estado')
            ->where('carne', 'LIKE', '%' . $term . '%')
            ->join('partner_deceaseds', 'partner_deceaseds.partner_id', '=', 'partners.id')
            ->get();


        $data = [];


        foreach ($querys as $query) {
            if ($query->estado == 'ACTO PARA BENEFICIO') {
                $data[] = [
                    'label' => $query->carne
                ];
            }
        }

        return $data;
    }

    public function llenarDatosEntrega($carne)
    {
        $arrayDatos = array();
        $socio = partner::select('id', 'nombre', 'apellido_paterno', 'apellido_materno', 'Dni', 'carne')->where('carne', $carne)
            ->firstOrFail();

        $beneficiarios = beneficiary::select('nombres_apellidos', 'dni', 'id')
            ->where('partner_id', $socio->id)
            ->get();


        array_push($arrayDatos, $socio);
        array_push($arrayDatos, $beneficiarios);

        //array_push($arrayDatos,$mes);

        echo json_encode($arrayDatos);
    }

    public function serviciosProd()
    {

        $datos = array();
        $servicios = service::all();
        $productos = product::all();

        $opcionesServicios = option_service::select('id', 'nombre', 'id_services', 'stock')
            ->distinct('id_services')
            ->get();

        //$opcionesProductos = option_product::select('nombre', 'sku', 'id_products')
        //  ->distinct('sku')->get();

        $opcionesProd2 = option_product::select(
            'option_products.sku',
            'buys_products.id_products',
            'buys_products.id',
            'option_products.opcion',
            'attribute_products.atributo'
        )
            ->join('attribute_products', 'attribute_products.id', '=', 'option_products.id_attribute_products')
            ->join('buys_products', 'buys_products.id', '=', 'option_products.id_vouchers')
            ->distinct('option_products.sku')
            ->get();

        $opcionesProd = option_product::select(
            'option_products.sku',
            'buys_products.id_products',
        )
            ->join('buys_products', 'buys_products.id', '=', 'option_products.id_vouchers')
            ->distinct('option_products.sku')
            ->get();



        //$opcionesProd=option_product::all();
        $compras = buys_product::all();

        $atributos = attribute_product::all();
        $skus = option_product::select('sku', 'id_vouchers')->distinct()->get();


        array_push($datos, $servicios);
        array_push($datos, $opcionesServicios);
        array_push($datos, $productos);
        array_push($datos, $opcionesProd);
        array_push($datos, $skus);
        array_push($datos, $opcionesProd2);
        array_push($datos, $compras);
        echo json_encode($datos);
    }

    public function guardarEntrega(Request $request)
    {
        return $request;
    }
}
