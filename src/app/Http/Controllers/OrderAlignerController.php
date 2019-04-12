<?php

namespace App\Http\Controllers;

use App\Dentist;
use App\Http\Requests\OrderAligner;
use App\Patient;
use Auth;

class OrderAlignerController extends Controller
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
    public function create()
    {
        return view('orderAligner', [
            'breadcrumbs' => [
                ['label' => 'Pedidos', 'route' => 'orders'],
                ['label' => 'Solicitar Aligner'],
            ],
            'patients' => Patient::all(),
            'dentists' => Dentist::approved()->get(),
        ]);
    }

    public function store(OrderAligner $request) {
        dd($request->toArray());

        // TODO - Save the order on database
        // TODO - Dispatch the job to send it through the API
    }
}
