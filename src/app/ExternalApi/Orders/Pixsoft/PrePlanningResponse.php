<?php

namespace App\ExternalApi\Orders\Pixsoft;

use App\ExternalApi\Orders\PrePlanningResponseContract;
use GuzzleHttp\Psr7\Response;

class PrePlanningResponse implements PrePlanningResponseContract
{
    use FromResponseTrait;

    /**
     * @var Response
     */
    protected $response;

    public function getPrice(): float
    {
        $response = (array) $this->response;
        return $response['valor-total'] ?? 0;
    }
}