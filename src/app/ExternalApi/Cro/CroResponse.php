<?php

namespace App\ExternalApi\Cro;

class CroResponse implements CroResponseContract
{

    protected $name;

    protected $status;

    public function __construct(string $name, string $status)
    {
        $this->name = $name;
        $this->status = $status;
    }

    public static function request(string $cro)
    {


    }

    public function isActive()
    {
        return $this->status === 'ATIVO';
    }

    public function getName()
    {
        return $this->name;
    }
}