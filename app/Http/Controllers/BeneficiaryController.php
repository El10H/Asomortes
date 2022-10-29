<?php

namespace App\Http\Controllers;

use App\beneficiary;
use App\partner;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Carbon\Carbon;


class BeneficiaryController extends Controller
{

    public function index(Request $request)
    {
        
        $beneficiaries = beneficiary::select(
            'beneficiaries.id as beneficiary_id',
            'beneficiaries.nombres_apellidos as nombre_Beneficiary',
            'beneficiaries.dni',
            'partners.id as id_partner',
            'partners.nombre as nombre_partner',
            'partners.apellido_paterno as apellidoPaterno_partner',
            'partners.apellido_materno as apellidoMaterno_partner'
        )
            ->join('partners', 'beneficiaries.partner_id', '=', 'partners.id')
            
            ->get();

        return view('beneficiary.index', ['beneficiaries' => $beneficiaries]);
    }


    public function formulario(partner $partner)
    {
        $now = Carbon::now();
        return view('beneficiary.form', ['partner' => $partner, 'now' => $now]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombres_apellidos' => ['required'],
            'dni' => ['required', 'numeric', 'min:8'],
            'celular' => ['required', 'numeric', 'min:9'],
            'parentesco' => ['required'],
            'email' => ['required', 'email']
        ]);

        beneficiary::create([
            'partner_id' => $request->id_partner,
            'nombres_apellidos' => $request->nombres_apellidos,
            'dni' => $request->dni,
            'celular' => $request->celular,
            'email' => $request->email,
            'parentesco'=>$request->parentesco,
            'fecha_de_ingreso' => $request->fecha_de_ingreso
        ]);


        return redirect('/beneficiariesIndex');
    }

    //Método para eliminar 
    public function destroy($id)
    {
        $beneficiary = beneficiary::find($id);
        $beneficiary->delete();
        return redirect('/beneficiariesIndex');
    }

    public function edit($beneficiary, $partnerId)
    {
        $beneficiaries = beneficiary::findOrFail($beneficiary);
        $partners = partner::findOrFail($partnerId);

        //return $beneficiaries;
        return view('beneficiary.edit', ['beneficiaries' => $beneficiaries, 'partners' => $partners]);
    }


    public function update(Request $request, $id)
    {
        $beneficiaries = beneficiary::findOrFail($id);

        $beneficiaries->partner_id = $request->id_partner;
        $beneficiaries->nombres_apellidos = $request->nombre;
        $beneficiaries->dni = $request->dni;
        $beneficiaries->celular = $request->celular;
        $beneficiaries->email = $request->email;
        //$beneficiaries->fecha_de_ingreso=$request->fecha_de_ingreso;

        $beneficiaries->save();

        //return back()->with('status','beneficiario actualizado correctamente');
        return redirect('/beneficiaries');
    }

    //Método para exportar PDF
    public function list()
    {
        $beneficiaries = beneficiary::select(
            'beneficiaries.id as beneficiary_id',
            'beneficiaries.nombres_apellidos as nombre_Beneficiary',
            'beneficiaries.dni as dni_beneficiary',
            'beneficiaries.celular as celular_beneficiary',
            'beneficiaries.email as email_beneficiary',
            'beneficiaries.fecha_de_ingreso as ingreso_beneficiary',
            'partners.id as id_partner',
            'partners.nombre as nombre_partner',
            'partners.apellido_paterno as apellidoPaterno_partner',
            'partners.apellido_materno as apellidoMaterno_partner'
        )
            ->join('partners', 'beneficiaries.partner_id', '=', 'partners.id')
            ->get();

            $data=compact('beneficiaries');
            $pdf = \PDF::loadView('beneficiary.listadoPdf', $data);
            return $pdf->setPaper('a4','landscape')->stream();
            //return $data;
            
    }
   
}