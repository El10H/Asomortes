<?php

namespace App\Http\Controllers;


use App\service;
use Illuminate\Http\Request;

Use Session;
Use Redirect;
USE Carbon\Carbon;
use App\buys_product;
use App\provider;
use App\buys_service;

class ServiceController extends Controller
{
    public function index(Request $request){


        $now=Carbon::now();

        $services=service::all();
        $providers=provider::all();


        if($request){
            $query=trim($request->get('search'));

            $services=service::where('nombre','LIKE','%'.$query.'%')
            ->orderby('id','desc')->get();
            
            return view('service.index', ['services'=>$services, 'providers'=>$providers], ['now' => $now]);
        }   
    }


    public function destroy(service $service){
        $service->delete();
        
        return back()->with('delete',"Se eliminó el servicio '$service->nombre' correctamente.");
    }


    public function ViewCreate(){ 
        return view('service.form');
    }

    public function create (Request $request){


        ///*if(!$request->has('stock')){
        //    $request->merge(['stock' => '0']);
        //}*/

        if(!$request->has('devolucion'))
        {
            $request->merge(['devolucion' => 'off']);
        }

        

        $devolucion = $request['devolucion'];
        if($devolucion == 'on'){
            service::create([
                'nombre'=>$request->nombre,
                'descripcion'=>$request->descripcion,
                'devolucion'=>$request->devolucion,
            ]);  
        }else{
            service::create([
                'nombre'=>$request->nombre,
                'descripcion'=>$request->descripcion,
                'devolucion'=>$request->devolucion,
            ]);  
        }     
        
                
         return redirect('/services');  
     }



    public function edit($id, Request $request){
        $service=service::findOrFail($id);
        return view('service.edit',['service'=>$service]);
    }

    public function update(Request $request, $id){

        if(!$request->has('devolucion')){
            $request->merge(['devolucion' => 'off']);
        }
        
        $service=service::findOrFail($id);


        $devolucion = $request['devolucion'];
        if($devolucion == 'on'){
            $service->update([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'devolucion' => $request->input('devolucion'),                
            ]);
        }else{
            $service->update([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'devolucion' => $request->input('devolucion'),                
            ]);
        }

        return back()->with('update',"Se actualizó el servicio '$request->nombre' correctamente.");
    }



    public function serviceList()
    {
        $services = service::latest()->orderby('id', 'desc')->get();
        $data = compact('services');

        $pdf = \PDF::loadView('service.listPdf', $data);
        return $pdf->setPaper('a4', 'landscape')->stream();
    }



    public function select(){
        $now=Carbon::now();

        $services=service::all();
        $providers=provider::all();
        return view('service.buys', compact('services', 'providers'), ['now' => $now]);
    }



    public function create_buys (Request $request){
        

        buys_service::create([
        
        'id_services'=>$request->servicio,
        'id_providers'=>$request->proveedor,
        'fecha_compra'=>$request->fecha_compra,
        'cantidad'=>$request->cantidad,
        'monto'=>$request->monto,
        'boletaFactura'=>$request->boletaFactura,
        'n_comprobante'=>$request->n_comprobante,
    ]);

    
    $stock=service::select('stock')
           ->where('id',$request->servicio)->firstOrFail();

    //$nuevoStock = $stock + $request->cantidad;


    
    $dev='on';
    service::where("id", $request->servicio) 
        ->where("devolucion", $dev)
        ->update(['stock' => $stock->stock + $request->cantidad ]);
    


    //service::where("id", $request->servicio) 
      //    ->update(['stock' => $stock->stock + $request->cantidad ]);

    //$product->stock=$request->cantidad;

           
    return redirect('/services');  
    //return ($stock->stock);
}
}