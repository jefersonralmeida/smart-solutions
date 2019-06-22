<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\OrderProductController;
use App\Http\Requests\OrderAlignerPP;

class OrderAlignerPPController extends OrderProductController
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
        return 'Solicitar Aligner Pre Protese';
    }

    /**
     * The product id (check config/products.php)
     * @return int
     */
    protected function productId(): int
    {
        return 8;
    }

    public function store(OrderAlignerPP $request)
    {
        return $this->storeInternal($request);
    }
}
