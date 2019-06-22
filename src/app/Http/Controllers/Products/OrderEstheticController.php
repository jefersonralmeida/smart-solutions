<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\OrderProductController;
use App\Http\Requests\OrderEsthetic;

class OrderEstheticController extends OrderProductController
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
        return 'Solicitar Esthetic';
    }

    /**
     * The product id (check config/products.php)
     * @return int
     */
    protected function productId(): int
    {
        return 7;
    }

    public function store(OrderEsthetic $request)
    {
        return $this->storeInternal($request);
    }

    /**
     * The view template for the product form
     * @return string
     */
    protected function viewTemplate(): string
    {
        return 'orderEsthetic';
    }
}
