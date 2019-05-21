<?php

namespace App\ExternalApi\Orders\Pixsoft;

use GuzzleHttp\Psr7\Response;

trait FromResponseTrait
{
    public function __construct(Response $response)
    {
        $code = $response->getStatusCode();
        $this->response = $code >= 200 && $code < 300 ? json_decode($response->getBody()->getContents()) : null;
    }
}