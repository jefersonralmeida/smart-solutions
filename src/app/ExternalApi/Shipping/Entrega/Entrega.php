<?php

namespace App\ExternalApi\Shipping\Entrega;

use App\ExternalApi\Shipping\ShippingContract;

class Entrega implements ShippingContract
{

    /**
     * @var string
     */
    protected $zipCode;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $lowerZipLimit;

    /**
     * @var int
     */
    protected $higherZipLimit;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var string
     */
    protected $prize;

    /**
     * Entrega constructor.
     * @param string $zipCode
     * @param array $params
     */
    public function __construct(string $zipCode, array $params)
    {
        $this->zipCode = $zipCode;
        $this->name = $params['name'];
        $this->lowerZipLimit = $params['lowerZipLimit'];
        $this->higherZipLimit = $params['higherZipLimit'];
        $this->price = $params['price'];
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
        $zipCode = (int) substr($this->zipCode, 0, 5);
        return ($zipCode >= $this->lowerZipLimit && $zipCode <= $this->higherZipLimit);
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getDeliveryPrize(): string
    {
        return $this->prize;
    }
}