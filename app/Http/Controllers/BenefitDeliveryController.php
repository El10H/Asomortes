<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\beneficiary;
use App\product;
use App\attribute_product;
use App\buys_product;
use App\option_product;
use App\service;
use App\option_service;
use App\buys_service;
use App\partner;
use App\benefit_delivery;
use App\benefit_product;
use App\benefit_service;
use App\benefit_cash;
use App\partner_deCeased;
use Illuminate\Auth\Events\Validated;
//use Illuminate\Http\Request;
use Carbon\Carbon;

class BenefitDeliveryController extends Controller
{

    public function __construct(){
        $this->middleware('can:entrega');
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

        $opcionesProdDif0 = option_product::select(
            'option_products.sku',
            'buys_products.id_products',
        )
            ->where('option_products.opcion', '=', '0')
            ->join('buys_products', 'buys_products.id', '=', 'option_products.id_vouchers')
            ->distinct('option_products.sku')
            ->get();
        
        
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
        array_push($datos, $opcionesProdDif0);

        echo json_encode($datos);
    }

    public function guardarEntrega(Request $request){
        //echo $request->idOpcionesServicios == 0 ? "yes" : "no";
        //return $request;
        $attribute_products=attribute_product::all();
        $option_products=option_product::all();
        $services=service::all();
        $option_services=option_service::all();
        $date = Carbon::now();
        $date = $date->format('Y-m-d');


        $tipo_beneficio = "";

        if($request->entregaEnEfectivo == $request->valorBeneficio && is_countable($request->idServicios) < 0){
            $tipo_beneficio = "Efectivo, ";
        }

        if(is_countable($request->idProductos) > 0){
            $tipo_beneficio .= " Productos, ";
        }

        if(is_countable($request->idServicios) > 0){
            $tipo_beneficio .= " Servicios, ";
        }

        if($request->entregaEnEfectivo > 0){
            $tipo_beneficio .= " Efectivo, ";
        }

        $tipo_beneficio = substr($tipo_beneficio, 0, -2);

        //return $tipo_beneficio;

        $estadoEntrega = 'Entrega finalizada';

        if ($request->idOpcionesServicios > 0){
            foreach ($request->idOpcionesServicios as $idOpcionesServicios){
                foreach ($option_services as $option_service){
                    if($option_service->id == $idOpcionesServicios){
                        foreach ($services as $service){
                            if($option_service->id_services == $service->id && $service->devolucion === 'on'){   
                                $estadoEntrega='Entrega pendiente';
                            }
                        }
                    }
                }
            }
        }


        benefit_delivery::create([
            'id_partners' => $request->idSocio,
            'id_beneficiaries' => $request->idBeneficiario,
            'fecha_entrega' => $date,
            'tipo_beneficio' => $tipo_beneficio,
            'estado' => $estadoEntrega,
        ]);

        

        //agregamos datos de los sku y id a la tabla benefit
        $id_benefit = benefit_delivery::select('id')->orderBy('id', 'desc')->first();

        if ($request->skuOpcionesProductos > 0){
            foreach ($request->skuOpcionesProductos as $skuOpcionesProductos){
                benefit_product::create([
                    'id_benefit_deliveries' => $id_benefit->id,
                    'sku_option_products' => $skuOpcionesProductos,
                    //'id_option_services' => 0,
                    //'efectivo' => 0,
                ]);
                
                foreach ($option_products as $option_product){
                    if($option_product->sku == $skuOpcionesProductos){
                        foreach ($attribute_products as $attribute_product){
                            if($option_product->id_attribute_products == $attribute_product->id && $attribute_product->atributo === 'cantidad'){

                                $cantidad=option_product::select('opcion')
                                    ->where('sku', $skuOpcionesProductos)
                                    ->where("id_attribute_products", $attribute_product->id)
                                    ->firstOrFail();
            
                                option_product::where("sku", $skuOpcionesProductos) 
                                    ->where("id_attribute_products", $attribute_product->id) 
                                    ->update(['opcion' => $cantidad->opcion - 1 ]);
                            }
                        }
                    }
                     
                }
            }
        }

        
        
        if ($request->idOpcionesServicios > 0){
            foreach ($request->idOpcionesServicios as $idOpcionesServicios){
                benefit_service::create([
                    'id_benefit_deliveries' => $id_benefit->id,
                    //'sku_option_products' => 0,
                    'id_option_services' => $idOpcionesServicios,
                    //'efectivo' => 0,
                ]);

                foreach ($option_services as $option_service){
                    if($option_service->id == $idOpcionesServicios){
                        foreach ($services as $service){
                            if($option_service->id_services == $service->id && $service->devolucion === 'on'){

                                $cantidad=option_service::select('stock')
                                    ->where('id', $idOpcionesServicios)
                                    ->where("id_services", $service->id)
                                    ->firstOrFail();

                                option_service::where("id", $idOpcionesServicios) 
                                    ->where("id_services", $service->id) 
                                    ->update(['stock' => $cantidad->stock - 1 ]);
                            }
                        }
                    }
                }
            }
        }


        if($request->entregaEnEfectivo > 0){
            benefit_cash::create([
                'id_benefit_deliveries' => $id_benefit->id,
                //'sku_option_products' => 0,
                //'id_option_services' => 0,
                'efectivo' => $request->entregaEnEfectivo,
            ]);
        }



        //actualizamos estado a socio fallecido
        partner_deCeased::where("partner_id", $request->idSocio) 
            ->update(['estado' => "BENEFICIO ENTREGADO" ]);

        return redirect('/entrega');  

        return $date;

        
    }

}
