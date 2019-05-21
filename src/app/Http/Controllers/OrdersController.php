<?php

namespace App\Http\Controllers;

use App\Address;
use App\Events\OrderConfirmed;
use App\ExternalApi\Shipping\ShippingManagerContract;
use App\Http\Requests\ConfirmOrder;
use App\Jobs\CreateOrderJob;
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
        $orders = Order::with('dentist', 'patient')->get();
        return view('orders.index', [
            'breadcrumbs' => [
                ['label' => 'Pedidos']
            ],
            'orders' => $orders
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

    public function confirmOrderStore(Order $order, ConfirmOrder $request)
    {

        $order->address_id = $request->address_id;
        $order->load(['address', 'dentist']);

        if ($request->billing_data == 'auto') {
            $request->billing_name = $order->dentist->name;
            $request->billing_document = $order->dentist->cpf;
            $request->billing_address = "{$order->address->street}, {$order->address->street_number} - {$order->address->city} - {$order->address->state}";
            $request->billing_zip_code = $order->address->zip_code;
            $request->billing_email = $order->dentist->email;
            $request->billing_phone = $order->dentist->phone;
        }

        $order->shipping = $request->shipping;
        $order->payment = $request->payment;
        $order->incrementStatus();

        $order->save();

        event(new OrderConfirmed($order));

        return redirect(route('orders'));
    }

    public function forceIntegration(Order $order)
    {
        CreateOrderJob::dispatch($order);
        return redirect(route('orders'));
    }
}
