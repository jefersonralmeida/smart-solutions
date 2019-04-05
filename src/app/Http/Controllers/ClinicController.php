<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\Http\Requests\CreateClinic;
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
}
