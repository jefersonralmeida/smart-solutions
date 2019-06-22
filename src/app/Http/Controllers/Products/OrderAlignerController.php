<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\OrderProductController;
use App\Http\Requests\OrderAligner;

class OrderAlignerController extends OrderProductController
{

    protected function domain(): string
    {
        return 'aligner';
    }

    protected function title(): string
    {
        return 'Solicitar Aligner';
    }

    protected function productId(): int
    {
        return 1;
    }

    public function store(OrderAligner $orderAligner)
    {
        return $this->storeInternal($orderAligner);
    }

    /**
     * The view template for the product form
     * @return string
     */
    protected function viewTemplate(): string
    {
        return 'orderAligner';
    }
}
