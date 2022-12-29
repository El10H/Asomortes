<?php

namespace App\Http\Controllers;

Use App\provider;
use Illuminate\Http\Request;

Use Session;
Use Redirect;

class ProviderController extends Controller
{

    public function __construct(){
        $this->middleware('can:providers')->only('destroy', 'store', 'update');
        $this->middleware('can:providers.index')->only('index');
        //$this->middleware('can:providers.destroy')->only('destroy');
        //$this->middleware('can:providers.update')->only('update');
    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('search'));

            $providers=provider::where('razon_social','LIKE','%'.$query.'%')
            ->orderby('id','desc')->get();
            
            return view('provider.index',[
                'providers'=>$providers,
                'search'=>$query
            ]);
        }   
    }


    public function destroy(provider $provider){
        $provider->delete();

        return back()->with('delete',"Se eliminó el proveedor '$provider->razon_social' correctamente.");
    }

    public function store(Request $request){
             provider::create([
             'razon_social'=>$request->razon_social,
             'ruc'=>$request->ruc,
             'direccion'=>$request->direccion,
             'telefono'=>$request->telefono,
             'email'=>$request->email,
         ]);
 
        return back()->with('create',"Se regsitró el proveedor '$request->razon_social' correctamente.");
    }


    public function pdf(){
        $providers = provider::latest()->orderby('id', 'desc')->get();
        $data = compact('providers');

        $pdf = \PDF::loadView('provider.pdf', $data);
        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function update(Request $request, $id){
        
        $provider=provider::findOrFail($id);

        $provider->update([

            'razon_social' => $request->input('razon_social'),
            'ruc' => $request->input('ruc'),
            'direccion' => $request->input('direccion'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email'),
            
        ]);
 
        //return back()->with('update',"Se actualizó el proveedor '$request->razon_social' correctamente.");

        return back();
    }
}