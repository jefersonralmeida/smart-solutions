<?php

namespace App\ExternalApi\Shipping;

class ShippingManager implements ShippingManagerContract
{

    /**
     * @return string[]
     */
    public function getProviders(): array
    {
        return array_keys(config('shipping.providers'));
    }

    /**
     * @param string $provider
     * @param string $zipCode
     * @return ShippingContract|null
     */
    public function getProviderObject(string $provider, string $zipCode): ?ShippingContract
    {
        $class = config("shipping.providers.$provider.class");
        $params = config("shipping.providers.$provider.params");

        /** @var ShippingContract $object */
        $object = new $class($zipCode, $params);
        if (!$object->isCovered()) {
            return null;
        }

        return $object;
    }
}