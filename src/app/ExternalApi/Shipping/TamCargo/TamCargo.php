<?php

namespace App\ExternalApi\Shipping\TamCargo;

use App\ExternalApi\Shipping\ShippingContract;

class TamCargo implements ShippingContract
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var string
     */
    protected $prize;

    /**
     * @var bool
     */
    protected $covered = false;

    /**
     * TamCargo constructor.
     * @param string $zipCode
     * @param array $params
     */
    public function __construct(string $zipCode, array $params)
    {

        $this->name = $params['name'];
        $this->price = $params['price'];
        $this->prize = $params['prize'];

        $zipCode = (int)$zipCode;
        $count = \DB::table('zip_ranges')
            ->where('provider', '=', 'tamcargo')
            ->where('start', '<=', $zipCode)
            ->where('end', '>=', $zipCode)
            ->count();

        $this->covered = (bool)$count;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isCovered(): bool
    {
        return $this->covered;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDeliveryPrize(): string
    {
        return $this->prize;
    }
}