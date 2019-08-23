<?php

namespace App\Http\Controllers;

use App\ExternalApi\Shipping\ShippingManagerContract;

class ShippingController extends Controller
{

    public function info(string $provider, string $zipCode, ShippingManagerContract $shippingManager)
    {

        $provider = $shippingManager->getProviderObject($provider, $zipCode);

        if ($provider === null) {
            return response('', 204);
        }

        return response([
            'name' => $provider->getName(),
            'price' => $provider->getPrice(),
            'deliveryPrize' => $provider->getDeliveryPrize(),
        ]);
    }

}
