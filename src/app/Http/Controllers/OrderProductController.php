<?php

namespace App\Http\Controllers;

use App\Dentist;
use App\Order;
use App\Patient;
use App\Price;
use Illuminate\Foundation\Http\FormRequest;

abstract class OrderProductController extends Controller
{

    /**
     * Can be aligner or solutions
     * @return string
     */
    abstract protected function domain(): string;

    /**
     * The title of the form
     * @return string
     */
    abstract protected function title(): string;

    /**
     * The view template for the product form
     * @return string
     */
    abstract protected function viewTemplate(): string;

    /**
     * The product id (check config/products.php)
     * @return int
     */
    abstract protected function productId(): int;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', "can:domain-{$this->domain()}"]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("products.{$this->viewTemplate()}", [
            'breadcrumbs' => [
                ['label' => 'Pedidos', 'route' => 'orders'],
                ['label' => $this->title()],
            ],
            'patients' => Patient::all(),
            'dentists' => Dentist::approved()->get(),
        ]);
    }

    /**
     * @param FormRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function storeInternal(FormRequest $request)
    {
        $order = new Order();
        $order->product = $this->productId();

        // grab the price calculator for the product (it's a callable/closure)
        $valueCalculator = config('price')[$this->productId()];

        // grab the prices table for the product
        /** @var Price $priceObject */
        if ($priceObject = Price::where('product_id', $this->productId())->first()) {
            $order->value = $valueCalculator($request, $priceObject->prices);
        }

        $order->fill($request->all());
        $order->setWaitingFiles();

        $order->save();

        return redirect(route('orders.filesForm', ['order' => $order->id]));

    }
}
