<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\OrderProductController;
use App\Http\Requests\OrderSurgery;

class OrderSurgeryController extends OrderProductController
{

    /**
     * Can be aligner or solutions
     * @return string
     */
    protected function domain(): string
    {
        return 'solutions';
    }

    /**
     * The title of the form
     * @return string
     */
    protected function title(): string
    {
        return 'Solicitar Surgery';
    }

    /**
     * The product id (check config/products.php)
     * @return int
     */
    protected function productId(): int
    {
        return 4;
    }

    /**
     * The view template for the product form
     * @return string
     */
    protected function viewTemplate(): string
    {
        return 'orderSurgery';
    }

    public function store(OrderSurgery $request)
    {
        return $this->storeInternal($request);
    }
}
