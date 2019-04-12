<?php

namespace App\ExternalApi\Orders\Pixsoft;

use App\ExternalApi\Orders\DentistCreateResponseContract;

class DentistCreateResponse implements DentistCreateResponseContract
{

    use FromResponseTrait;

    /**
     * @var \stdClass
     */
    protected $response;

    public function getId(): string
    {
        return $this->response->id;
    }
}