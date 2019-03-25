<?php

namespace App\ExternalApi\Cro;

interface CroResponseContract
{
    public function getName();
    public function isActive();
}