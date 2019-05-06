<?php

namespace App\Http\Controllers;

use App\Address;
use App\ExternalApi\Shipping\ShippingManagerContract;
use App\Order;

class OrdersController extends Controller
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
        return view('orders', [
            'breadcrumbs' => [
                ['label' => 'Pedidos']
            ]
        ]);
    }

    /**
     * @param Order $order
     * @param ShippingManagerContract $shippingManager
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmOrder(Order $order, ShippingManagerContract $shippingManager)
    {
        return view('orders.confirmOrder', [
            'breadcrumbs' => [
                ['label' => 'Pedidos', 'route' => 'orders'],
                ['label' => 'Solicitar Aligner'],
                ['label' => 'Finalização'],
            ],
            'order' => $order,
            'dentist' => $order->dentist,
            'patient' => $order->patient,
            'addresses' => Address::all(),
            'shippingProviders' => $shippingManager->getProviders()
        ]);
    }

    public function confirmOrderStore()
    {
        // TODO -
        // - Check the dentist CRO
        // - Check if the dentist is already on the API;
        //   - if not, include it
        // - Create the order on the API
    }
}
