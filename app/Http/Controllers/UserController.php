<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use Spatie\Permission\Models\Role;
Use Spatie\Permission\Models\Permission;
//Use Spatie\Permission\table_names\HasRoles;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('can:users.index');//->only('index');
        //$this->middleware('can:users.update')->only('update');
    }

    public function index(Request $request){

        //$query=trim($request->get('search'));

        //$Users=User::where('name','LIKE','%'.$query.'%')
        //->orderby('id','desc')->get();

        $users=user::all();
        $roles=role::all();
        //$has_roles=HasRoles::all();
        
        return view('users.index', ['users'=>$users, 'roles'=>$roles]);//, 'has_roles'=>$has_roles]);

        //return view('users.index');
    }

    public function store (Request $request){

        //return $request->rol;
        user::create([
            'name'=>$request->nombre,
            'email'=>$request->email,
            'password' =>bcrypt($request->password)
        ])->roles()->sync($request->rol);

        return back()->with('create',"Se regsitró el usuario '$request->nombre' correctamente.");
    }


    public function destroy(user $user){
        $user->delete();

        return back()->with('delete',"Se eliminó el usuario '$user->name' correctamente.");
    }
}
