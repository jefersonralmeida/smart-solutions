<?php

namespace App\Http\Controllers;

use App\Dentist;
use App\Events\OrderCreated;
use App\Http\Requests\OrderAligner;
use App\Order;
use App\Patient;

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

    /**
     * @param OrderAligner $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(OrderAligner $request) {

        $order = new Order();
        $order->product = 1;
        $order->fill($request->all());
        $order->status = 1;
        $order->save();

        event(new OrderCreated($order, $request->allFiles()));

        return redirect(route('orders.confirm', ['order' => $order->id]));
    }
}
