<?php

namespace App\ExternalApi\Cro;

interface CroApiContract
{
    public function request(string $cro): CroResponseContract;
}