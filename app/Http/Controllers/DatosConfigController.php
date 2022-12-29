<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\datosConfig;

class DatosConfigController extends Controller
{
    public function index(){
        //Llamamos a los datos de la configuracion:
       $datosConfig = datosConfig::all();
       return view ('datosConfig.datosConfig' ,['datos'=>$datosConfig]);
   }    
   
   public function update(Request $request)
   {
       return $request[1];
   

       return redirect ('/datosConfig');
   }
}
