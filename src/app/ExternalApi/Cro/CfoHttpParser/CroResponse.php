<?php

namespace App\ExternalApi\Cro\CfoHttpParser;

use App\ExternalApi\Cro\CroResponseContract;

class CroResponse implements CroResponseContract
{

    protected $name;

    protected $status;

    public function __construct(string $name, string $status)
    {
        $this->name = $name;
        $this->status = $status;
    }

    public function isActive()
    {
        return $this->status === 'ATIVO';
    }

    public function getName()
    {
        return $this->name;
    }

    public function getState()
    {

    }
}