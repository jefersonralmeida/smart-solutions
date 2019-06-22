<?php

namespace App\ExternalApi\Orders;

interface ListOrdersResponseContract
{
    public function getOrders(): array;
}