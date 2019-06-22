<?php

namespace App\ExternalApi\Orders\Pixsoft;

use App\ExternalApi\Orders\ListOrdersResponseContract;
use GuzzleHttp\Psr7\Response;

class ListOrdersResponse implements ListOrdersResponseContract
{
    use FromResponseTrait;

    /**
     * @var Response
     */
    protected $response;

    public function getOrders(): array
    {
        $output = [];
        foreach ($this->response->Array as $item) {
            $output[] = [
                'integration_id' => $item->id,
                'state_id' => $item->state_id,
            ];
        }
        return $output;
    }
}