<?php

namespace App\Http\Controllers;

Use App\provider;
use Illuminate\Http\Request;

Use Session;
Use Redirect;

class ProviderController extends Controller
{
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
        //return redirect('/providers');

        return back()->with('delete',"Se eliminó el proveedor '$provider->razon_social' correctamente.");

    }



    //public function ViewCreate(){ 
      //  return view('provider.form');
    //}

    public function create (Request $request){
             provider::create([
             'razon_social'=>$request->razon_social,
             'ruc'=>$request->ruc,
             'direccion'=>$request->direccion,
             'telefono'=>$request->telefono,
             'email'=>$request->email,
         ]);
 
                
         //return redirect('/providers');  

         //Session::flash('create',"Se registró el proveedor '$request->razon_social' correctamente.");
        // return Redirect::to('/providers');

        return back()->with('create',"Se regsitró el proveedor '$request->razon_social' correctamente.");
     }


    public function providerList(){
        $providers = provider::latest()->orderby('id', 'desc')->get();
        $data = compact('providers');

        $pdf = \PDF::loadView('provider.listPdf', $data);
        return $pdf->setPaper('a4', 'landscape')->stream();
    }


    //public function edit($id, Request $request){
    //    $provider=provider::findOrFail($id);
    //    return view('provider.edit',['provider'=>$provider]);
    //}

    public function update(Request $request, $id){
        
        $provider=provider::findOrFail($id);

        $provider->update([

            'razon_social' => $request->input('razon_social'),
            'ruc' => $request->input('ruc'),
            'direccion' => $request->input('direccion'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email'),
            
        ]);
        //$provider->save();

        //Session::flash('update',"Se actualizó el proveedor '$request->razon_social' correctamente.");
        //return Redirect::to('/providers');

        return back()->with('update',"Se actualizó el proveedor '$request->razon_social' correctamente.");

    }
}