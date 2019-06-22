<?php

namespace App\ExternalApi\Orders\Pixsoft;

use App\ExternalApi\Orders\OrderCreateResponseContract;
use GuzzleHttp\Psr7\Response;

class OrderCreateResponse implements OrderCreateResponseContract
{

    use FromResponseTrait;

    /**
     * @var Response
     */
    protected $response;

    public function getId(): ?string
    {
        return $this->response->id ?? null;
    }
}