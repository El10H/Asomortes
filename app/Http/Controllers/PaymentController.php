<?php

namespace App\Http\Controllers;

use App\datosConfig;
use Illuminate\Http\Request;
use App\partner;
use App\payment;
use App\Month;
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

    public function listaPagos(){
        $pagos = Payment::orderBy('payments.created_at', 'DESC')
        ->select('payments.id','payments.partner_id','payments.fecha_de_pago','payments.monto_total','partners.nombre','partners.apellido_paterno', 'partners.apellido_materno','partners.carne')
        ->join('partners','partners.id','=','payments.partner_id')
        ->get();

        return view ('payment.listaPagos',['pagos'=>$pagos]);
    }

    public function detallePagos($id){
        $detalles = Month::where('payment_id',$id)->get();
        echo json_encode($detalles);
    }

    public function datosSocio($dni)
    {
        $datos = array();
        
        //Llamamos a los datos de la configuracion:
        $datosConfig = datosConfig::Select('monto')->where('descripcion','cuota mensual')->first();
        $inscripcion = datosConfig::Select('monto')->where('descripcion','inscripcion')->first();
        $socios = partner::where('carne', $dni)->select('id', 'Dni', 'nombre', 'apellido_paterno', 'apellido_materno', 'carne', 'estado')->first();

        array_push($datos, $socios);

        $pagosVerifica = payment::orderBy('created_at', 'DESC')
            ->select('id')
            ->where('partner_id', $socios->id)
            ->take(1)
            ->get();

        if (count($pagosVerifica) == 0) {
            $mes = [];
            array_push($datos, $mes);
        }

        if (count($pagosVerifica) > 0) {

            $pagos = payment::orderBy('created_at', 'DESC')
                ->select('id')
                ->where('partner_id', $socios->id)
                ->take(1)
                ->first();

            $mes = Month::orderBy('id', 'desc')
                ->select('mes', 'año')
                ->where('payment_id', $pagos->id)
                ->take(1)
                ->get();
            array_push($datos, $mes);
        }

        array_push($datos, $datosConfig);
        array_push($datos, $inscripcion);

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
    //TODO send info to SUNAT
    public function guardar(Request $request)
    {
        
        Payment::create([
            'partner_id' => $request->idNombre,
            'fecha_de_pago' => $request->fecha_de_pago,
            'monto_total' => $request->monto,
        ]);

        //Llamamos a los datos de la configuracion:
        //$datosConfig = datosConfig::select('pagoMensual')->take(1)->first();
        $datosConfig = datosConfig::Select('monto')->where('descripcion','cuota mensual')->first();
        $inscripcion = datosConfig::Select('monto')->where('descripcion','inscripcion')->first();
   

        $ultimoRegistro = payment::where('created_at', payment::max('created_at'))->orderBy('created_at', 'desc')->firstOrFail();

        $meses = $request->mesesPagados;
        $arregloMeses = explode(",", $meses);


        $datosBoleta = array();

        $dateAño= carbon::now();
        $año = $dateAño->format('Y');

        //Guardamos cuota de inscripción para socios Nuevos
        if($request->boletaItem == 'siGuardar'){
            month::create([
                'payment_id' => $ultimoRegistro->id,
                'mes' =>  'Cuota de inscripción',
                'año' => $año,
                'monto' => $inscripcion->monto 
            ]);

            array_push($datosBoleta,[
                'unidad' => "0",
                'cantidad' => "1",
                'codProducto' => "0",
                'descripcion' => 'Cuota de inscripción',
                'mtoValorUnitario' => $inscripcion->monto ,
                'mtoBaseIgv' => "0",
                'porcentajeIgv' => "0",
                'igv' => "0",
                'tipAfeIgv' => "0",
                'totalImpuestos' => "0",
                'mtoPrecioUnitario' => $inscripcion->monto ,
                'mtoValorVenta' => $inscripcion->monto ,
            ]);
        }

        
        //Arreglo de meses, para guardar los meses de la boleta
        foreach ($arregloMeses as $unico) {
            $mesAño = explode('-', $unico);

            

            if ($mesAño[0] == '0') {
                $mesGuardar = 'Enero';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => $datosConfig->monto
                ]);

                array_push($datosBoleta, [
                    'unidad' => "0",
                    'cantidad' => "1",
                    'codProducto' => "0",
                    'descripcion' => 'Cuota del mes de ' . $mesGuardar . ' del ' . $mesAño[1],
                    'mtoValorUnitario' => $datosConfig->monto,
                    'mtoBaseIgv' => "0",
                    'porcentajeIgv' => "0",
                    'igv' => "0",
                    'tipAfeIgv' => "0",
                    'totalImpuestos' => "0",
                    'mtoPrecioUnitario' => $datosConfig->monto,
                    'mtoValorVenta' => $datosConfig->monto,
                ]);
            }
            if ($mesAño[0] == '1') {
                $mesGuardar = 'Febrero';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => $datosConfig->monto
                ]);

                array_push($datosBoleta, [
                    'unidad' => "0",
                    'cantidad' => "1",
                    'codProducto' => "0",
                    'descripcion' => 'Cuota del mes de ' . $mesGuardar . ' del ' . $mesAño[1],
                    'mtoValorUnitario' => $datosConfig->monto,
                    'mtoBaseIgv' => "0",
                    'porcentajeIgv' => "0",
                    'igv' => "0",
                    'tipAfeIgv' => "0",
                    'totalImpuestos' => "0",
                    'mtoPrecioUnitario' => $datosConfig->monto,
                    'mtoValorVenta' => $datosConfig->monto,
                ]);
            }
            if ($mesAño[0] == '2') {
                $mesGuardar = 'Marzo';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => $datosConfig->monto
                ]);

                array_push($datosBoleta, [
                    'unidad' => "0",
                    'cantidad' => "1",
                    'codProducto' => "0",
                    'descripcion' => 'Cuota del mes de ' . $mesGuardar . ' del ' . $mesAño[1],
                    'mtoValorUnitario' => $datosConfig->monto,
                    'mtoBaseIgv' => "0",
                    'porcentajeIgv' => "0",
                    'igv' => "0",
                    'tipAfeIgv' => "0",
                    'totalImpuestos' => "0",
                    'mtoPrecioUnitario' => $datosConfig->monto,
                    'mtoValorVenta' => $datosConfig->monto,
                ]);
            }
            if ($mesAño[0] == '3') {
                $mesGuardar = 'Abril';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => $datosConfig->monto
                ]);

                array_push($datosBoleta, [
                    'unidad' => "0",
                    'cantidad' => "1",
                    'codProducto' => "0",
                    'descripcion' => 'Cuota del mes de ' . $mesGuardar . ' del ' . $mesAño[1],
                    'mtoValorUnitario' => $datosConfig->monto,
                    'mtoBaseIgv' => "0",
                    'porcentajeIgv' => "0",
                    'igv' => "0",
                    'tipAfeIgv' => "0",
                    'totalImpuestos' => "0",
                    'mtoPrecioUnitario' => $datosConfig->monto,
                    'mtoValorVenta' => $datosConfig->monto,
                ]);
            }
            if ($mesAño[0] == '4') {
                $mesGuardar = 'Mayo';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => $datosConfig->monto
                ]);

                array_push($datosBoleta, [
                    'unidad' => "0",
                    'cantidad' => "1",
                    'codProducto' => "0",
                    'descripcion' => 'Cuota del mes de ' . $mesGuardar . ' del ' . $mesAño[1],
                    'mtoValorUnitario' => $datosConfig->monto,
                    'mtoBaseIgv' => "0",
                    'porcentajeIgv' => "0",
                    'igv' => "0",
                    'tipAfeIgv' => "0",
                    'totalImpuestos' => "0",
                    'mtoPrecioUnitario' => $datosConfig->monto,
                    'mtoValorVenta' => $datosConfig->monto,
                ]);
            }
            if ($mesAño[0] == '5') {
                $mesGuardar = 'Junio';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => $datosConfig->monto
                ]);

                array_push($datosBoleta, [
                    'unidad' => "0",
                    'cantidad' => "1",
                    'codProducto' => "0",
                    'descripcion' => 'Cuota del mes de ' . $mesGuardar . ' del ' . $mesAño[1],
                    'mtoValorUnitario' => $datosConfig->monto,
                    'mtoBaseIgv' => "0",
                    'porcentajeIgv' => "0",
                    'igv' => "0",
                    'tipAfeIgv' => "0",
                    'totalImpuestos' => "0",
                    'mtoPrecioUnitario' => $datosConfig->monto,
                    'mtoValorVenta' => $datosConfig->monto,
                ]);
            }
            if ($mesAño[0] == '6') {
                $mesGuardar = 'Julio';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => $datosConfig->monto
                ]);

                array_push($datosBoleta, [
                    'unidad' => "0",
                    'cantidad' => "1",
                    'codProducto' => "0",
                    'descripcion' => 'Cuota del mes de ' . $mesGuardar . ' del ' . $mesAño[1],
                    'mtoValorUnitario' => $datosConfig->monto,
                    'mtoBaseIgv' => "0",
                    'porcentajeIgv' => "0",
                    'igv' => "0",
                    'tipAfeIgv' => "0",
                    'totalImpuestos' => "0",
                    'mtoPrecioUnitario' => $datosConfig->monto,
                    'mtoValorVenta' =>$datosConfig->monto,
                ]);
            }
            if ($mesAño[0] == '7') {
                $mesGuardar = 'Agosto';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => $datosConfig->monto
                ]);

                array_push($datosBoleta, [
                    'unidad' => "0",
                    'cantidad' => "1",
                    'codProducto' => "0",
                    'descripcion' => 'Cuota del mes de ' . $mesGuardar . ' del ' . $mesAño[1],
                    'mtoValorUnitario' => $datosConfig->monto,
                    'mtoBaseIgv' => "0",
                    'porcentajeIgv' => "0",
                    'igv' => "0",
                    'tipAfeIgv' => "0",
                    'totalImpuestos' => "0",
                    'mtoPrecioUnitario' => $datosConfig->monto,
                    'mtoValorVenta' => $datosConfig->monto,
                ]);
            }
            if ($mesAño[0] == '8') {
                $mesGuardar = 'Setiembre';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => $datosConfig->monto
                ]);
                array_push($datosBoleta, [
                    'unidad' => "0",
                    'cantidad' => "1",
                    'codProducto' => "0",
                    'descripcion' => 'Cuota del mes de ' . $mesGuardar . ' del ' . $mesAño[1],
                    'mtoValorUnitario' => $datosConfig->monto,
                    'mtoBaseIgv' => "0",
                    'porcentajeIgv' => "0",
                    'igv' => "0",
                    'tipAfeIgv' => "0",
                    'totalImpuestos' => "0",
                    'mtoPrecioUnitario' => $datosConfig->monto,
                    'mtoValorVenta' => $datosConfig->monto,
                ]);
            }
            if ($mesAño[0] == '9') {
                $mesGuardar = 'Octubre';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => $datosConfig->monto
                ]);

                array_push($datosBoleta, [
                    'unidad' => "0",
                    'cantidad' => "1",
                    'codProducto' => "0",
                    'descripcion' => 'Cuota del mes de ' . $mesGuardar . ' del ' . $mesAño[1],
                    'mtoValorUnitario' =>$datosConfig->monto,
                    'mtoBaseIgv' => "0",
                    'porcentajeIgv' => "0",
                    'igv' => "0",
                    'tipAfeIgv' => "0",
                    'totalImpuestos' => "0",
                    'mtoPrecioUnitario' => $datosConfig->monto,
                    'mtoValorVenta' => $datosConfig->monto,
                ]);
            }
            if ($mesAño[0] == '10') {
                $mesGuardar = 'Noviembre';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => $datosConfig->monto
                ]);

                array_push($datosBoleta, [
                    'unidad' => "0",
                    'cantidad' => "1",
                    'codProducto' => "0",
                    'descripcion' => 'Cuota del mes de ' . $mesGuardar . ' del ' . $mesAño[1],
                    'mtoValorUnitario' => $datosConfig->monto,
                    'mtoBaseIgv' => "0",
                    'porcentajeIgv' => "0",
                    'igv' => "0",
                    'tipAfeIgv' => "0",
                    'totalImpuestos' => "0",
                    'mtoPrecioUnitario' => $datosConfig->monto,
                    'mtoValorVenta' => $datosConfig->monto,
                ]);
            }
            if ($mesAño[0] == '11') {
                $mesGuardar = 'Diciembre';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => $datosConfig->monto
                ]);

                array_push($datosBoleta, [
                    'unidad' => "0",
                    'cantidad' => "1",
                    'codProducto' => "0",
                    'descripcion' => 'Cuota del mes de ' . $mesGuardar . ' del ' . $mesAño[1],
                    'mtoValorUnitario' => $datosConfig->monto,
                    'mtoBaseIgv' => "0",
                    'porcentajeIgv' => "0",
                    'igv' => "0",
                    'tipAfeIgv' => "0",
                    'totalImpuestos' => "0",
                    'mtoPrecioUnitario' => $datosConfig->monto,
                    'mtoValorVenta' => $datosConfig->monto,
                ]);
            }
        }
        $requestBody = array(
            'ublVersion' => "2.1",
            'tipoOperacion' => "2.1",
            'tipoDoc' => "2.1",
            'serie' => "2.1",
            'correlativo' => "2.1",
            'fechaEmision' => "2.1",
            'formaPago' => array(
                'tipo' => "2.1",
            ),
            'client' => array(
                'tipoDoc' => 'DNI',
                'numDoc' => $request->dni,
                'rznSocial' => $request->nombre . ' ' . $request->apellidos
            ),
            'company' => array(
                'ruc' => "20316643061",
                'razonSocial' => "ASOCIACIÓN PARA EL SERVICIO MORTUORIO DE LA TERCERA EDAD",
                'nombreComercial' => "ASOMORTES",
                'address' => array(
                    'ubigueo' => "200606",
                    'codigoPais' => "PE",
                    'departamento' => "Piura",
                    'provincia' => "Sullana",
                    'distrito' => "Sullana",
                    'urbanizacion' => "-",
                    'direccion' => "Calle San Martín N° 224 - 238",
                ),
            ),
            'tipoMoneda' => "2.1",
            'mtoOperGravadas' => "2.1",
            'mtoIGV' => "2.1",
            'totalImpuestos' => "2.1",
            'valorVenta' => "2.1",
            'subTotal' => "2.1",
            'mtoImpVenta' => "2.1",
            'details' =>  $datosBoleta,
            'legends' => array(
                "code" => "",
                "value" => "",
            ),
        );

        //return $requestBody;

        if (isset($request->castigadoGuardar)) {
            sanctioned::create([
                'partner_id' => $request->idNombre,
                'fecha_pago' => $request->fecha_de_pago,
                'fecha_habilitacion' => $request->castigadoGuardar
            ]);
        } else {
            return view('payment.indexNuevo', ['mensaje' => 'Pago registrado correctamente']);
        }

        return view('payment.indexNuevo', ['mensaje' => 'Pago registrado correctamente']);
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
        $meses = Month::where('payment_id', $id)->get();

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

    public function enviarSunat()
    {
        try {
            #Leemos los datos necesarios para ejecutar la consulta

            $requestBody = array(
                'ublVersion' => "2.1",
                'tipoOperacion' => "2.1",
                'tipoDoc' => "2.1",
                'serie' => "2.1",
                'correlativo' => "2.1",
                'fechaEmision' => "2.1",
                'formaPago' => array(
                    'tipo' => "2.1",
                ),
                'client' => array(
                    'tipoDoc' => "2.1",
                    'numDoc' => "2.1",
                    'rznSocial' => "2.1",
                ),
                'company' => array(
                    'ruc' => "2.1",
                    'razonSocial' => "2.1",
                    'nombreComercial' => "2.1",
                    'address' => array(
                        'ubigueo' => "2.1",
                        'codigoPais' => "2.1",
                        'departamento' => "2.1",
                        'provincia' => "2.1",
                        'distrito' => "2.1",
                        'urbanizacion' => "2.1",
                        'direccion' => "2.1",
                    ),
                ),
                'tipoMoneda' => "2.1",
                'mtoOperGravadas' => "2.1",
                'mtoIGV' => "2.1",
                'totalImpuestos' => "2.1",
                'valorVenta' => "2.1",
                'subTotal' => "2.1",
                'mtoImpVenta' => "2.1",
                'details' => array(
                    array(
                        'unidad' => "2.1",
                        'cantidad' => "2.1",
                        'codProducto' => "2.1",
                        'descripcion' => "2.1",
                        'mtoValorUnitario' => "2.1",
                        'mtoBaseIgv' => "2.1",
                        'porcentajeIgv' => "2.1",
                        'igv' => "2.1",
                        'tipAfeIgv' => "2.1",
                        'totalImpuestos' => "2.1",
                        'mtoPrecioUnitario' => "2.1",
                        'mtoValorVenta' => "2.1",
                    ),
                ),
                'legends' => array(
                    "code" => "",
                    "value" => "",
                ),
            );
            return $requestBody;


            $jsonRequestBody = json_encode($requestBody);

            #Se hace la consulta al reporteador
            $client = new \GuzzleHttp\Client();
            $url = env('SUNAT_HOST') . '/api/v1/invoice/send?token=123456';

            $myBody['name'] = "Demo";
            $request = $client->post($url,  ['body' => $myBody]);
            $response = $request->send();

            $response = Http::withHeaders(
                ['Content-Type' => 'application/json']
            )->post(
                env('SUNAT_HOST') . '/api/v1/invoice/send?token=123456',
                $jsonRequestBody
            );

            #Generamos un uuid con el fin de no repetir el nombre de archivos
            $uuid = Uuid::uuid1();

            #Asignamos el nombre de nuestro reporte (el nombre del pdf)
            $nameFile = "presupuesto/" . $uuid->toString() . ".pdf";

            #Guardamos el archivo en la ubicacion indicada
            Storage::put($nameFile, $response);

            $response_ = response()->json([
                #Devolvemos la ubicacion y el nombre de nuestro archivo
                'data' => "/storage/" . $response,
                'error' => null,
                'message' => 'OK',
            ], 200);
            return $response_;
        } catch (\Exception $e) {
            $response_ = response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'message' => 'BAD',
            ], 400);
            return $response_;
        }
    }
}