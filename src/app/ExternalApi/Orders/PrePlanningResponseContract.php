<?php

namespace App\ExternalApi\Orders;

interface PrePlanningResponseContract
{
    public function getPrice(): float;
}