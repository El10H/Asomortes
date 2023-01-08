<?php

namespace App\Http\Controllers;

use App\buys_product;
use App\buys_service;
use App\payment;
use App\product;
use App\provider;
use App\service;
use DB;
use Illuminate\Http\Request;

class reportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reportes.index');
    }

    public function filtrarMes(Request $request)
    {

        $datos = array();
        $pagos = payment::select(
            DB::raw('sum(monto_total) as montoTotal')
        )
            ->whereYear('created_at', $request->año)
            ->whereMonth('created_at', $request->mes)
            ->get();

        $compras_productos = buys_product::select(
            DB::raw('sum(valor_total) as totalProducto')
        )
            ->whereYear('created_at', $request->año)
            ->whereMonth('created_at', $request->mes)
            ->get();

        $compras_servicios = buys_service::select(
            DB::raw('sum(valor_total) as totalServicio')
        )
            ->whereYear('created_at', $request->año)
            ->whereMonth('created_at', $request->mes)
            ->get();


        array_push($datos, $pagos);
        array_push($datos, $compras_productos);
        array_push($datos, $compras_servicios);

        echo json_encode($datos);
    }

    public function filtrarFecha(Request $request)
    {
        $datos = array();
        $pagos = payment::select(
            DB::raw('sum(monto_total) as montoTotal')
        )
            ->where('fecha_de_pago', $request->fecha)
            ->get();

        $compras_productos = buys_product::select(
            DB::raw('sum(valor_total) as totalProducto')
        )
            ->where('fecha_compra', $request->fecha)
            ->get();

        $compras_servicios = buys_service::select(
            DB::raw('sum(valor_total) as totalServicio')
        )
            ->where('fecha_compra', $request->fecha)
            ->get();


        array_push($datos, $pagos);
        array_push($datos, $compras_productos);
        array_push($datos, $compras_servicios);

        echo json_encode($datos);
    }

    
    public function detallesFechasProductos(Request $request)
    {
        $compras_productos = buys_product::where('fecha_compra', $request->fecha)->get();
        $productos = product::all();
        $provider = provider::all();
        return view('reportes.fechas.detallesProductos',['compras'=>$compras_productos ,'products'=>$productos,'providers'=>$provider,'fecha'=>$request->fecha]);
    }

    public function detallesFechasServicios(Request $request)
    {
        $compras_servicios = buys_service::where('fecha_compra', $request->fecha)->get();
        $servicios = product::all();
        $provider = provider::all();
        return view('reportes.fechas.detallesServicios',['compras'=>$compras_servicios ,'services'=>$servicios,'providers'=>$provider,'fecha'=>$request->fecha]);
    }

    public function detalleFechaPagos(Request $request){
        $pagos = payment::orderBy('payments.created_at', 'DESC')
        ->select('payments.id','payments.partner_id','payments.fecha_de_pago','payments.monto_total','partners.nombre','partners.apellido_paterno', 'partners.apellido_materno','partners.carne')
        ->where('fecha_de_pago', $request->fecha)
        ->join('partners','partners.id','=','payments.partner_id')
        ->get();

        return view ('reportes.fechas.detallePagos',['pagos' => $pagos ,'fecha' => $request->fecha]);
    }


    public function detallesMesAñoPagos(Request $request)
    {
        $mes='';
        if($request->mes == '1'){
            $mes = 'Enero';
        }
        if($request->mes == '2'){
            $mes = 'Febrero';
        }
        if($request->mes == '3'){
            $mes = 'Marzo';
        }
        if($request->mes == '4'){
            $mes = 'Abril';
        }
        if($request->mes == '5'){
            $mes = 'Mayo';
        }
        if($request->mes == '6'){
            $mes = 'Junio';
        }
        if($request->mes == '7'){
            $mes = 'Julio';
        }
        if($request->mes == '8'){
            $mes = 'Agosto';
        }
        if($request->mes == '9'){
            $mes = 'Setiembre';
        }
        if($request->mes == '10'){
            $mes = 'Octubre';
        }
        if($request->mes == '11'){
            $mes = 'Noviembre';
        }
        if($request->mes == '12'){
            $mes = 'Diciembre';
        }


        $pagos = payment::orderBy('payments.created_at', 'DESC')
        ->select('payments.id','payments.partner_id','payments.fecha_de_pago','payments.monto_total','partners.nombre','partners.apellido_paterno', 'partners.apellido_materno','partners.carne')
        ->whereYear('payments.created_at', $request->año)
        ->whereMonth('payments.created_at', $request->mes)
        ->join('partners','partners.id','=','payments.partner_id')
        ->get();

        return view ('reportes.mesAño.detallePagosMA',['pagos' => $pagos ,'año' => $request->año , 'mes'=>$mes]);
    }

    public function detallesMesAñoProductos(Request $request)
    {
        $mes='';
        if($request->mes == '1'){
            $mes = 'Enero';
        }
        if($request->mes == '2'){
            $mes = 'Febrero';
        }
        if($request->mes == '3'){
            $mes = 'Marzo';
        }
        if($request->mes == '4'){
            $mes = 'Abril';
        }
        if($request->mes == '5'){
            $mes = 'Mayo';
        }
        if($request->mes == '6'){
            $mes = 'Junio';
        }
        if($request->mes == '7'){
            $mes = 'Julio';
        }
        if($request->mes == '8'){
            $mes = 'Agosto';
        }
        if($request->mes == '9'){
            $mes = 'Setiembre';
        }
        if($request->mes == '10'){
            $mes = 'Octubre';
        }
        if($request->mes == '11'){
            $mes = 'Noviembre';
        }
        if($request->mes == '12'){
            $mes = 'Diciembre';
        }
        $compras_productos = buys_product::whereYear('created_at', $request->año)
        ->whereMonth('created_at', $request->mes)->get();
        $productos = product::all();
        $provider = provider::all();
        return view('reportes.mesAño.detalleProductosMA',['compras'=>$compras_productos ,'products'=>$productos,'providers'=>$provider,'mes'=>$mes, 'año'=>$request->año]);
    }

    public function detallesMesAñoServicios(Request $request)
    {
        $mes='';
        if($request->mes == '1'){
            $mes = 'Enero';
        }
        if($request->mes == '2'){
            $mes = 'Febrero';
        }
        if($request->mes == '3'){
            $mes = 'Marzo';
        }
        if($request->mes == '4'){
            $mes = 'Abril';
        }
        if($request->mes == '5'){
            $mes = 'Mayo';
        }
        if($request->mes == '6'){
            $mes = 'Junio';
        }
        if($request->mes == '7'){
            $mes = 'Julio';
        }
        if($request->mes == '8'){
            $mes = 'Agosto';
        }
        if($request->mes == '9'){
            $mes = 'Setiembre';
        }
        if($request->mes == '10'){
            $mes = 'Octubre';
        }
        if($request->mes == '11'){
            $mes = 'Noviembre';
        }
        if($request->mes == '12'){
            $mes = 'Diciembre';
        }

        $compras_servicios = buys_service::whereYear('created_at', $request->año)
        ->whereMonth('created_at', $request->mes)->get();
        $servicios = service::all();
        $provider = provider::all();
        return view('reportes.mesAño.detalleServiciosMA',['compras'=>$compras_servicios ,'products'=>$servicios,'providers'=>$provider,'mes'=>$mes, 'año'=>$request->año]);
    }


    public function imprimir(){
        $pdf = \PDF::loadView('reportes.fechas.detallePagos');
        return $pdf->download('imprimir.pdf');
    }



    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
