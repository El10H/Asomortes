<?php

namespace App\Http\Controllers;

use App\product;
use App\buys_product;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\provider;
USE Carbon\Carbon;
use App\option_product;
use App\attribute_product;

Use Session;
Use Redirect;

class ProductController extends Controller
{

    public function __construct(){
        $this->middleware('can:products.store')->only('store');
        $this->middleware('can:products.destroy')->only('destroy');
        $this->middleware('can:products.update')->only('update');
    }

    public function index(Request $request){
        $now=Carbon::now();

        $products=product::all();
        $providers=provider::all();
        $option_products=option_product::all();
        $attribute_products=attribute_product::all();

        return view('product.index', ['attribute_products'=>$attribute_products, 'products'=>$products, 'providers'=>$providers], ['now' => $now]);
    }

    public function checkAtributos($id){
       $atributos= attribute_product::where('id_products',$id)->select('atributo')->get();
       echo json_encode($atributos);
    }

    public function destroy(product $product){
        $id=$product->id;

        $product->delete();
        
        return back()->with('delete',"Se eliminó el producto '$product->nombre' y sus atributos correctamente.");
    }


    /*public function ViewCreate(){ 
        return view('product.form');
    }*/

    public function store (Request $request){

        product::create([
        'nombre'=>$request->nombre,
        'descripcion'=>$request->descripcion,
         ]);

        $id = product::latest()->first()->id;
        $modelo = $request['modelo'];
        $cementerio = $request['cementerio'];
        $sector = $request['sector'];
        $nivel = $request['nivel'];

        attribute_product::create([
            'id_products'=>$id,
            'atributo'=>'valor',
        ]);

        attribute_product::create([
            'id_products'=>$id,
            'atributo'=>'cantidad',
        ]);

        if($modelo === 'modelo'){
            attribute_product::create([
                'id_products'=>$id,
                'atributo'=>$request['modelo'],
            ]);
        }

        if($cementerio === 'cementerio'){
            attribute_product::create([
                'id_products'=>$id,
                'atributo'=>$request['cementerio'],
            ]);
        }

        if($sector === 'sector'){
            attribute_product::create([
                'id_products'=>$id,
                'atributo'=>$request['sector'],
            ]);
        }

        if($nivel === 'nivel'){
            attribute_product::create([
                'id_products'=>$id,
                'atributo'=>$request['nivel'],
            ]);
        }
      
        return back()->with('create',"Se registró el producto '$request->nombre' correctamente.");
    }   


    /*public function edit($id){
        $product=product::findOrFail($id);
        return view('product.edit',['product'=>$product]);
    }*/

    public function update(Request $request ,$id){
        $product=product::findOrFail($id);
        $attribute_products=attribute_product::all();

        $color=attribute_product::select('atributo')
            ->where('id',$id)->firstOrFail();

                    $modelo = $request['modelo'];
                    $cementerio = $request['cementerio'];
                    $sector = $request['sector'];
                    $nivel = $request['nivel'];

                    
                    $array_attributes=array();
                    $i=0;

                    foreach ($attribute_products as $attribute_product){
                        if ($attribute_product->id_products == $product->id){
                                    
                            $atributo=$attribute_product->atributo;

                            $array_attributes[$i]=($atributo);
                            $i++; 
                            //return ($array_attributes);
                            
                            if($attribute_product->atributo === 'modelo' && empty($modelo)){
                                attribute_product::where("id_products", $product->id) 
                                    ->where("atributo", 'modelo')
                                    ->delete();
                            }

                            if($attribute_product->atributo === 'cementerio' && empty($cementerio)){
                                attribute_product::where("id_products", $product->id) 
                                    ->where("atributo", 'cementerio')
                                    ->delete();
                            }

                            if($attribute_product->atributo === 'sector' && empty($sector)){
                                attribute_product::where("id_products", $product->id) 
                                    ->where("atributo", 'sector')
                                    ->delete();
                            }

                            if($attribute_product->atributo === 'nivel' && empty($nivel)){
                                attribute_product::where("id_products", $product->id) 
                                    ->where("atributo", 'nivel')
                                    ->delete();
                            }
                        }
                    } 


                    if($modelo === 'modelo'){
                        $busca=array_search ("modelo",$array_attributes);
                        if(strval($busca)===""){
                            attribute_product::create([
                                'id_products'=>$product->id,
                                'atributo'=>$request['modelo'],
                            ]);
                        } 
                    }

                    if($cementerio === 'cementerio'){
                        $busca=array_search ("cementerio",$array_attributes);
                        if(strval($busca)===""){
                            attribute_product::create([
                                'id_products'=>$product->id,
                                'atributo'=>$request['cementerio'],
                            ]);
                        } 
                    }

                    if($sector === 'sector'){
                        $busca=array_search ("sector",$array_attributes);
                        if(strval($busca)===""){
                            attribute_product::create([
                                'id_products'=>$product->id,
                                'atributo'=>$request['sector'],
                            ]);
                        } 
                    }

                    if($nivel === 'nivel'){
                        $busca=array_search ("nivel",$array_attributes);
                        if(strval($busca)===""){
                            attribute_product::create([
                                'id_products'=>$product->id,
                                'atributo'=>$request['nivel'],
                            ]);
                        } 
                    }      
                                        
        $product->update([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),   
        ]);


        return back()->with('update',"Se actualizó el producto '$request->nombre' correctamente.");   
    }
    

    public function pdf()
    {
        $products = product::latest()->orderby('id', 'asc')->get();
        $attribute_products = attribute_product::latest()->orderby('id', 'asc')->get();
        $data = compact('products', 'attribute_products');

        $pdf = \PDF::loadView('product.pdf', $data);
        return $pdf->setPaper('a4', 'landscape')->stream();
    }


    /*public function select(){
        $now=Carbon::now();

        $products=product::all();
        $providers=provider::all();
        return view('product.buys', compact('products', 'providers'), ['now' => $now]);
    }*/
    
}