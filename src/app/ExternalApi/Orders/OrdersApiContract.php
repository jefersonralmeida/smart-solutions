<?php

namespace App\ExternalApi\Orders;

use App\Dentist;

interface OrdersApiContract
{
    public function createDentist(Dentist $dentist): DentistCreateResponseContract;
}