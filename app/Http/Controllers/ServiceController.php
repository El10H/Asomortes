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

    public function __construct(){
        $this->middleware('can:services')->only('destroy', 'store', 'update');
        $this->middleware('can:services.index')->only('index');
        //$this->middleware('can:services.store')->only('store');
        //$this->middleware('can:services.destroy')->only('destroy');
        //$this->middleware('can:services.update')->only('update');
    }

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


    /*public function ViewCreate(){ 
        return view('service.form');
    }*/

    public function store (Request $request){
        if(!$request->has('devolucion')){
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
        
        return back()->with('create',"Se registró el servicio '$request->nombre' correctamente.");      
     }


    /*public function edit($id, Request $request){
        $service=service::findOrFail($id);
        return view('service.edit',['service'=>$service]);
    }*/

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

    public function pdf()
    {
        $services = service::latest()->orderby('id', 'desc')->get();
        $data = compact('services');

        $pdf = \PDF::loadView('service.pdf', $data);
        return $pdf->setPaper('a4', 'landscape')->stream();
    }


    public function select(){
        $now=Carbon::now();

        $services=service::all();
        $providers=provider::all();
        return view('service.buys', compact('services', 'providers'), ['now' => $now]);
    }


    public function create_buys(Request $request){
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

        
        $dev='on';
        service::where("id", $request->servicio) 
            ->where("devolucion", $dev)
            ->update(['stock' => $stock->stock + $request->cantidad ]);
            
        return redirect('/services');  
    }
}