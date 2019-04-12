<?php

namespace App\ExternalApi\Orders\Pixsoft;

use GuzzleHttp\Psr7\Response;

trait FromResponseTrait
{
    public function __construct(Response $response)
    {
        $this->response = json_decode($response->getBody()->getContents());
    }
}