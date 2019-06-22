<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\OrderProductController;
use App\Http\Requests\OrderImplantGuiada;

class OrderImplantGuiadaController extends OrderProductController
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
        return 'Solicitar Implant Guiada';
    }

    /**
     * The product id (check config/products.php)
     * @return int
     */
    protected function productId(): int
    {
        return 3;
    }

    public function store(OrderImplantGuiada $request)
    {
        return $this->storeInternal($request);
    }

    /**
     * The view template for the product form
     * @return string
     */
    protected function viewTemplate(): string
    {
        return 'orderImplantGuiada';
    }
}
