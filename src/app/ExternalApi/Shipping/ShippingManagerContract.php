<?php

namespace App\ExternalApi\Shipping;

interface ShippingManagerContract
{

    /**
     * @return string[]
     */
    public function getProviders(): array;

    /**
     * @param string $provider
     * @param string $zipCode
     * @return ShippingContract
     */
    public function getProviderObject(string $provider, string $zipCode): ?ShippingContract;
}