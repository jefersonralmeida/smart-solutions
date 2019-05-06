<?php

namespace App\ExternalApi\Shipping;

interface ShippingContract
{

    public function __construct(string $zipCode, array $params);

    public function getName(): string;

    public function isCovered(): bool;

    public function getPrice(): float;

    public function getDeliveryPrize(): string;
}
