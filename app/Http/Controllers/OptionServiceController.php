<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

USE Carbon\Carbon;
use App\provider;
use App\service;
use App\option_service;
use App\buys_service;
use App\benefit_delivery;
use App\benefit_service;

class OptionServiceController extends Controller
{
    public function index(Request $request){
        $now=Carbon::now();

        $services=service::all();
        $providers=provider::all();
        $option_services=option_service::all();
        $buys_services=buys_service::all();
        $benefit_deliveries=benefit_delivery::all();
        $benefit_services=benefit_service::all();

        if($request){
            $query=trim($request->get('search'));

            $option_services=option_service::where('nombre','LIKE','%'.$query.'%')
            ->orderby('id','desc')->get();
            
            return view('option_service.index', ['option_services'=>$option_services, 'services'=>$services, 'buys_services'=>$buys_services, 'providers'=>$providers, 'benefit_deliveries'=>$benefit_deliveries, '$benefit_services'=>$benefit_services], ['now' => $now]);
        }   
    }


    public function destroy(option_service $option_service){
        $option_service->delete();
        
        return back()->with('delete',"Se eliminó la opción de servicio '$option_service->nombre' correctamente.");
    }


    /*public function ViewCreate(){ 
        return view('option_service.form');
    }*/

    public function store(Request $request){

        $devolucion=service::select('devolucion')
            ->where('id', $request->cat_servicio)->firstOrFail();
        

        if($devolucion->devolucion == 'on'){
            option_service::create([
                'id_services'=>$request->cat_servicio,
                'nombre'=>$request->nombre,
                'valor'=>$request->valor,
                'stock'=>$request->stock,
                'descripcion' => $request->descripcion,
            ]);  
        }else{
            option_service::create([
                'id_services'=>$request->cat_servicio,
                'nombre'=>$request->nombre,
                'valor'=>$request->valor,
                'stock'=>0,
                'descripcion' => $request->descripcion,
            ]);  
        }     
           
        return back()->with('create',"Se registró la opción de servicio '$request->nombre' correctamente.");
    }


    /*public function edit($id, Request $request){
        $option_service=option_service::findOrFail($id);
        return view('option_service.edit',['option_service'=>$option_service]);
    }*/

    public function update(Request $request, $id){      
        $option_service=option_service::findOrFail($id);

        $devolucion=service::select('devolucion')
            ->where('id',$option_service->id_services)->firstOrFail();


        if($devolucion->devolucion == 'on'){
            $option_service->update([
                'nombre' => $request->input('nombre'),
                'valor' => $request->input('valor'),
                'stock' => $request->input('stock'),
                'descripcion' => $request->input('descripcion'),                
            ]);
        }else{
            $option_service->update([
                'nombre' => $request->input('nombre'),
                'valor' => $request->input('valor'),
                'descripcion' => $request->input('descripcion'),             
            ]);
        }

        return back()->with('update',"Se actualizó la opción de servicio '$request->nombre' correctamente.");
    }


    public function pdf(){
        $services=service::all();
        $option_services = option_service::latest()->orderby('id', 'desc')->get();
        $data = compact('option_services');

        $pdf = \PDF::loadView('option_service.pdf', $data, ['services'=>$services]);
        return $pdf->setPaper('a4', 'landscape')->stream();
    }


    public function create_buys(Request $request){
        buys_service::create([        
            'id_services'=>$request->servicio,
            'id_providers'=>$request->proveedor,
            'fecha_compra'=>$request->fecha_compra,
            'cantidad'=>$request->cantidad,
            'valor_unitario'=>$request->valor_unitario,
            'valor_total'=>$request->valor_total,
            'boletaFactura'=>$request->boletaFactura,
            'n_comprobante'=>$request->n_comprobante,
            'estado'=>'Registrada',
        ]);

        
        $services=service::all();
        $opton_services=option_service::all();

        $stock=option_service::select('stock')
           ->where('id',$request->servicio)->firstOrFail();
           

        $id_serv=option_service::select('id_services')
           ->where('id',$request->servicio)->firstOrFail();

        $dev=service::select('devolucion')
            ->where('id',$id_serv->id_services)->firstOrFail();

        $dev2=$dev->devolucion;
        $id_serv2=$id_serv->id_services;
       
        if($dev2 === "on"){
            foreach ($services as $service){
                if ($id_serv2 == $service->id){
                    option_service::where("id", $request->servicio) 
                    ->update(['stock' => $stock->stock + $request->cantidad ]);
                }
            }
        }

        option_service::where("id", $request->servicio) 
            ->update(['valor' => $request->valor_total ]);
    
        return redirect('/option_services');  
    }


    public function cancel($id){
        $buys_service=buys_service::findOrFail($id);

        $buys_service->update([
            'estado' => 'Anulada',
        ]);

        return redirect('/option_services'); 
    }

    public function buysservicePdf(){
        $services = service::latest()->orderby('id', 'asc')->get();
        $option_services = option_service::latest()->orderby('id', 'asc')->get();
        $providers = provider::latest()->orderby('id', 'asc')->get();
        $buys_services = buys_service::latest()->orderby('id', 'asc')->get();

        $data = compact('buys_services', 'services', 'providers', 'option_services');

        $pdf = \PDF::loadView('option_service.buys_service_pdf', $data);
        return $pdf->setPaper('a4', 'landscape')->stream();
    }


    public function acceder($id){
        $dev=service::select('devolucion')
            ->where('id',$id)->firstOrFail();

        echo json_encode($dev);
    }

    public function receptionDelivery(Request $request){
        $benefit_services=benefit_service::all();
        $services=service::all();
        $option_services=option_service::all();

        benefit_delivery::where("id", $request->codigoEntrega) 
            ->update(['estado' => 'Entrega finalizada',
        ]);

        foreach($benefit_services as $benefit_service){
            $nombre=option_service::select('nombre')
                ->where('id', $benefit_service->id_option_services)->firstOrFail();

            foreach($option_services as $option_service){
                if($benefit_service->id_option_services == $option_service->id_services && $nombre->nombre === $option_service->nombre){
                    foreach($services as $service){
                        if($option_service->id_services == $service->id && $service->devolucion === 'on'){

                                $stock=option_service::select('stock')
                                    ->where('id', $benefit_service->id_option_services)->firstOrFail();

                                option_service::where("id", $benefit_service->id_option_services) 
                                    ->update(['stock' => $stock->stock + 1,
                                ]);
                        }
                    }
                }
            }
            
        }

        return redirect('/option_services'); 
    }
}
