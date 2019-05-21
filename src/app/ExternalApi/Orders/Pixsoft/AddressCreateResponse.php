<?php

namespace App\ExternalApi\Orders\Pixsoft;

use App\ExternalApi\Orders\AddressCreateResponseContract;

class AddressCreateResponse implements AddressCreateResponseContract
{

    use FromResponseTrait;

    /**
     * @var \stdClass|null
     */
    protected $response;

    public function getId(): string
    {
        return $this->response->id ?? null;
    }
}