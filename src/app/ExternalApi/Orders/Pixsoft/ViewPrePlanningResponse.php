<?php

namespace App\ExternalApi\Orders\Pixsoft;

use App\ExternalApi\Orders\ListOrdersResponseContract;
use App\ExternalApi\Orders\ViewPrePlanningResponseContract;
use GuzzleHttp\Psr7\Response;

class ViewPrePlanningResponse implements ViewPrePlanningResponseContract
{
    use FromResponseTrait;

    /**
     * @var Response
     */
    protected $response;

    public function getPrePlanningData(): array
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