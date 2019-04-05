<?php

namespace App\ExternalApi\Cro;

interface CroResponseContract
{
    public function getName();
    public function getState();
    public function isActive();
}