<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Dentist;
use App\Http\Requests\CreateClinic;
use App\Http\Requests\CreateSingleDentist;
use App\Http\Requests\UpdateClinic;
use App\User;
use Auth;
use DB;

class ClinicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @param CreateClinic $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(CreateClinic $request)
    {

        DB::beginTransaction();
        // create the clinic
        $clinic = new Clinic();
        $clinic->fill($request->all());
        $clinic->save();

        // make the logged user admin of the created clinic.
        $user = Auth::user();
        $user->clinic_id = $clinic->id;
        $permissions = $user->permissions;
        $permissions[] = 'clinic-admin';
        $user->permissions = $permissions;
        $user->save();
        DB::commit();

        return redirect('profile/create-clinic')->with('success', true);
    }

    public function createSingleDentist()
    {
        return view('clinics.form', [
            'breadcrumbs' => [
                ['label' => 'Completar Cadastro de dentista (sem clínica)'],
            ],
            'action' => route('clinic.storeSingleDentist'),
            'method' => 'post',
        ]);
    }

    public function storeSingleDentist(CreateSingleDentist $request)
    {
        DB::beginTransaction();

        // create the fake clinic
        $clinic = new Clinic();
        $clinic->name = Auth::user()->name;
        $clinic->save();

        // create the dentist and link it to the clinic
        $dentist = new Dentist();
        $dentist->fill($request->all());
        $dentist->clinic_id = $clinic->id;
        $dentist->save();

        // make the logged user admin of the created clinic.
        // link the dentist to the user
        $user = Auth::user();
        $user->clinic_id = $clinic->id;
        $permissions = $user->permissions;
        $permissions[] = 'clinic-admin';
        $user->permissions = $permissions;
        $user->dentist_id = $dentist->id;
        $user->save();

        DB::commit();

        return redirect('profile')->with('success', 'Cadastro concluído com sucesso');
    }

    public function update(Clinic $clinic, UpdateClinic $request)
    {
        $clinic->fill($request->all());
        $clinic->save();

        return redirect('profile')->with('success', 'Clínica Alterada com sucesso');
    }
}
