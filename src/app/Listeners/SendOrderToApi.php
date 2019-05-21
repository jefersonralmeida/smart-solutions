<?php

namespace App\Listeners;


use App\Events\OrderConfirmed;
use App\ExternalApi\Orders\OrdersApiContract;
use App\Jobs\CreateOrderJob;
use Illuminate\Events\Dispatcher;

class SendOrderToApi
{

    /**
     * @var OrdersApiContract
     */
    protected $ordersApi;

    /**
     * Create the event listener.
     *
     * @param OrdersApiContract $ordersApi
     */
    public function __construct(OrdersApiContract $ordersApi)
    {
        $this->ordersApi = $ordersApi;
    }

    public function onOrderConfirmed(OrderConfirmed $orderConfirmed)
    {
        $order = $orderConfirmed->getOrder();
        CreateOrderJob::dispatch($order);
    }

    public function subscribe(Dispatcher $dispatcher)
    {
        $dispatcher->listen(OrderConfirmed::class, static::class . '@onOrderConfirmed');
    }

}
