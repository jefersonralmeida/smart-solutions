<?php

namespace App\ExternalApi\Shipping\Retirada;

use App\ExternalApi\Shipping\ShippingContract;

class Retirada implements ShippingContract
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $prize;

    /**
     * Retirada constructor.
     * @param array $params
     */
    public function __construct(string $zipCode, array $params)
    {
        $this->name = $params['name'];
        $this->prize = $params['prize'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isCovered(): bool
    {
        return true;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return 0;
    }

    public function getDeliveryPrize(): string
    {
        return $this->prize;
    }
}