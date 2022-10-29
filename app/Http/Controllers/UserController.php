<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use Spatie\Permission\Models\Role;
Use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('can:users')->only('store', 'update', 'destroy');
        $this->middleware('can:users.index')->only('index');
        //$this->middleware('can:users.update')->only('update');
    }

    public function index(Request $request){
         $users=user::all();
        $roles=role::all();
        
        return view('users.index', ['users'=>$users, 'roles'=>$roles]);//, 'has_roles'=>$has_roles]);
    }

    public function store (Request $request){
        user::create([
            'name'=>$request->nombre,
            'email'=>$request->email,
            'password' =>bcrypt($request->password)
        ])->roles()->sync($request->rol);

        return back()->with('create',"Se regsitró el usuario '$request->nombre' correctamente.");
    }

    public function update(Request $request, $id){
        $user=user::findOrFail($id);

        $user->update([
            'name' => $request->input('nombre'),
            'email' => $request->input('email'),        
        ]);
        
        $user->roles()->sync($request->rol);

        return back()->with('create',"Se actualizó el usuario '$request->nombre' correctamente.");
    }


    public function destroy(user $user){
        $user->delete();

        return back()->with('delete',"Se eliminó el usuario '$user->name' correctamente.");
    }
}
