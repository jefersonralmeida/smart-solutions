<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\OrderProductController;
use App\Http\Requests\OrderImplantRog;

class OrderImplantRogController extends OrderProductController
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
        return 'Solicitar Implant ROG';
    }

    /**
     * The product id (check config/products.php)
     * @return int
     */
    protected function productId(): int
    {
        return 6;
    }

    public function store(OrderImplantRog $request)
    {
        return $this->storeInternal($request);
    }

    /**
     * The view template for the product form
     * @return string
     */
    protected function viewTemplate(): string
    {
        return 'orderImplantRog';
    }
}
