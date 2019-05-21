<?php

namespace App\ExternalApi\Orders\Pixsoft;

use App\ExternalApi\Orders\OrderCreateResponseContract;

class OrderCreateResponse implements OrderCreateResponseContract
{

    use FromResponseTrait;

    /**
     * @var \stdClass
     */
    protected $response;

    public function getId(): ?string
    {
        return $this->response->id ?? null;
    }
}