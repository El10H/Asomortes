<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use Spatie\Permission\Models\Role;
Use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function __construct(){
        $this->middleware('can:roles')->only('destroy', 'store', 'update');
        $this->middleware('can:roles.index')->only('index');
    }

    public function index()
    {
        //$users=user::all();
        $roles=role::all();
        $permissions=Permission::all();
        //$has_roles=HasRoles::all();
        
        return view('roles.index', ['roles'=>$roles, 'permissions'=>$permissions]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role = role::create($request->all());

        $role->permissions()->sync($request->permissions);

        //return view('roles.index');
        return back()->with('create',"Se registró el rol '$request->name' correctamente.");   
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role=role::findOrFail($id);

        $role->update($request->all());

        $role->permissions()->sync($request->permissions);

        return back()->with('update',"Se actualizó el rol '$request->name' correctamente.");
    }


    public function destroy(role $role)
    {
        $role->delete();
        
        return back()->with('delete',"Se eliminó el rol '$role->name' correctamente.");
    }
}
