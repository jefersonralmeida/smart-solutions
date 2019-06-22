<?php

namespace App\ExternalApi\Orders;

interface ViewPrePlanningResponseContract
{
    public function getPrePlanningData(): array;
}