<?php

namespace App\Http\Controllers;

use App\Order;
use App\Patient;
use Auth;

class HomeController extends Controller
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

    public function root()
    {
        $loggedUser = Auth()->user();
        $route = $loggedUser !== null && Auth::user()->can('view-dashboard') ? 'home' : 'profile';
        return redirect($route);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordersCount = Order::count();
        $patientsCount = Patient::count();

        $chartData = Order::findLastMonthsCount(7);

        $lastOrders = Order::with('patient')->orderBy('created_at', 'desc')->take(10)->get();

        return view('home', [
            'ordersCount' => $ordersCount,
            'patientsCount' => $patientsCount,
            'chartData' => $chartData,
            'lastOrders' => $lastOrders,
        ]);
    }
}
