<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfile;
use Auth;

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
     * @param string|null $form
     * @return \Illuminate\Http\Response
     */
    public function index(?string $form = null)
    {
        return view('profile', [
            'breadcrumbs' => [
                ['label' => 'Dados Cadastrais']
            ],
            'form' => $form
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
