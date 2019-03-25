<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfile;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile', [
            'breadcrumbs'=> [
                ['label' => 'Dados Cadastrais']
            ]
        ]);
    }

    public function update(UpdateProfile $request)
    {

        $user = Auth::user();

        $user->fill($request->all());
        $user->save();

        return redirect('profile')->with('success', true);
    }
}
