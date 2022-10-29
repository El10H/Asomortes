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
    public function index()
    {
        return view('payment.index');
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
        $datosConfig = datosConfig::Select('monto')->where('descripcion', 'cuota mensual')->first();
        $inscripcion = datosConfig::Select('monto')->where('descripcion', 'inscripcion')->first();
        $socios = partner::where('carne', $dni)->select('id', 'Dni', 'nombre', 'apellido_paterno', 'apellido_materno', 'carne', 'estado','domicilio')->first();

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

    public function store(Request $request)
    {
 
        Payment::create([
            'partner_id' => $request->idNombre,
            'fecha_de_pago' => $request->fecha_de_pago,
            'monto_total' => $request->monto,
        ]);

        //De la BD recuperamos los montos de pago
        //$datosConfig = datosConfig::select('pagoMensual')->take(1)->first();
        $datosConfig = datosConfig::Select('monto')->where('descripcion', 'cuota mensual')->first();
        $inscripcion = datosConfig::Select('monto')->where('descripcion', 'inscripcion')->first();

        $ultimoRegistro = payment::where('created_at', payment::max('created_at'))->orderBy('created_at', 'desc')->firstOrFail();

        $meses = $request->mesesPagados;
        $arregloMeses = explode(",", $meses);

        $detalleBoleta = array();

        $dateAño = carbon::now();
        $año = $dateAño->format('Y');

        //Guardamos cuota de inscripción para socios Nuevos
        if ($request->boletaItem == 'siGuardar') {
            month::create([
                'payment_id' => $ultimoRegistro->id,
                //Podrian cambiar el campo mes a descripcion
                'mes' =>  'Cuota de inscripción',
                'año' => $año,
                'monto' => $inscripcion->monto
            ]);

            array_push($detalleBoleta, [
                'unidad' => "NIU",
                'cantidad' => "1",
                'codProducto' => "BGN", //Por definir
                'descripcion' => 'Cuota de inscripción',
                'mtoValorUnitario' => $inscripcion->monto,
                'mtoBaseIgv' => "0",
                'porcentajeIgv' => "0",
                'igv' => "0",
                'tipAfeIgv' => "0",
                'totalImpuestos' => "0",
                'mtoPrecioUnitario' => $inscripcion->monto,
                'mtoValorVenta' => $inscripcion->monto,
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

                array_push($detalleBoleta, [
                    'unidad' => "niu",
                    'cantidad' => "1",
                    'codProducto' => "BGN",
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

                array_push($detalleBoleta, [
                    'unidad' => "NIU",
                    'cantidad' => "1",
                    'codProducto' => "BGN",
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

                array_push($detalleBoleta, [
                    'unidad' => "NIU",
                    'cantidad' => "1",
                    'codProducto' => "BGN",
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

                array_push($detalleBoleta, [
                    'unidad' => "NIU",
                    'cantidad' => "1",
                    'codProducto' => "BGN",
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

                array_push($detalleBoleta, [
                    'unidad' => "NIU",
                    'cantidad' => "1",
                    'codProducto' => "BGN",
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

                array_push($detalleBoleta, [
                    'unidad' => "NIU",
                    'cantidad' => "1",
                    'codProducto' => "BGN",
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

                array_push($detalleBoleta, [
                    'unidad' => "NIU",
                    'cantidad' => "1",
                    'codProducto' => "BGN",
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
            if ($mesAño[0] == '7') {
                $mesGuardar = 'Agosto';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => $datosConfig->monto
                ]);

                array_push($detalleBoleta, [
                    'unidad' => "NIU",
                    'cantidad' => "1",
                    'codProducto' => "BGN",
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
                array_push($detalleBoleta, [
                    'unidad' => "NIU",
                    'cantidad' => "1",
                    'codProducto' => "BGN",
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

                array_push($detalleBoleta, [
                    'unidad' => "NIU",
                    'cantidad' => "1",
                    'codProducto' => "BGN",
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
            if ($mesAño[0] == '10') {
                $mesGuardar = 'Noviembre';
                month::create([
                    'payment_id' => $ultimoRegistro->id,
                    'mes' =>  $mesGuardar,
                    'año' => $mesAño[1],
                    'monto' => $datosConfig->monto
                ]);

                array_push($detalleBoleta, [
                    'unidad' => "NIU",
                    'cantidad' => "1",
                    'codProducto' => "BGN",
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

                array_push($detalleBoleta, [
                    'unidad' => "NIU",
                    'cantidad' => "1",
                    'codProducto' => "BGN",
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

        //Enviar boleta a la SUNAT
        $requestBodyForSunat = array(
            'ublVersion' => "2.1",
            'tipoOperacion' => "0101",
            'tipoDoc' => "03",
            //TODO definir serie y correlativo
            'serie' => "B001",
            'correlativo' => "8",
            'fechaEmision' => '2021-02-06T12:34:00-05:00', //CAMBIARRR!
            'formaPago' => array(
                'tipo' => "Contado",
            ),
            'client' => array(
                'tipoDoc' => '1',
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
            'tipoMoneda' => "PEN",
            'mtoOperGravadas' => $request->monto,
            'mtoIGV' => "0",
            'totalImpuestos' => "0",
            'valorVenta' => $request->monto,
            'subTotal' => $request->monto,
            'mtoImpVenta' => $request->monto,
            'details' =>  $detalleBoleta,
            'legends' => array(
                array(
                "code" => "",
                "value" => "",
            )),
        );

        $sunatResponse = $this->enviarSunat($requestBodyForSunat);
        $this->write_to_console($sunatResponse);

        if (isset($request->castigadoGuardar)) {
            sanctioned::create([
                'partner_id' => $request->idNombre,
                'fecha_pago' => $request->fecha_de_pago,
                'fecha_habilitacion' => $request->castigadoGuardar
            ]);
        } else {
            return view('payment.index', ['mensaje' => 'Pago registrado correctamente']);
        }

        return view('payment.index', ['mensaje' => 'Pago registrado correctamente']);
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

    public function enviarSunat($requestBodyForSunat)
    {
        try {
            #Leemos los datos necesarios para ejecutar la consulta
            $jsonRequestBody = json_encode($requestBodyForSunat);
            $this->write_to_console ($jsonRequestBody);
            $this->write_to_console ('llegada 1');
            $url = "http://". env('SUNAT_HOST').":".env('SUNAT_PORT').env('SUNAT_PATH')."?token=".env('SUNAT_TOKEN');
            //$url= 'http://18.228.39.118:8000/api/v1/invoice/send?token=123456';
            $this->write_to_console ($url);
            $this->write_to_console ('llegada 2');
            $resp = $this->curlPost($url, $jsonRequestBody);
            $this->write_to_console ('llegada 3');
            return $resp;
        }
        catch (\Exception $e) {
            $this->write_to_console ('llegada try');
            $response_ = response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'message' => 'BAD',
            ], 400);
            return $response_;
        }
    }

    public function curlPost($url, $data = NULL, $headers = NULL)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $response = curl_exec($ch);
        $this->write_to_console ('llegada despues de curl');

        if (curl_error($ch)) {
            $this->write_to_console ('llegada entro if');
            trigger_error('Curl Error:' . curl_error($ch));
        }

        curl_close($ch);
        return $response;
    }

    public function write_to_console($data)
    {
        $console = 'console.log(' . json_encode($data) . ');';
        $console = sprintf('<script>%s</script>', $console);
        echo $console;
    }
}
