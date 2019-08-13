<?php

namespace App\Listeners;


use App\Events\OrderConfirmed;
use App\Events\OrderReproved;
use App\ExternalApi\Orders\OrdersApiContract;
use App\Jobs\ApproveOrderJob;
use Illuminate\Events\Dispatcher;

class ReproveOrderOnApi
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

    public function onOrderReproved(OrderReproved $orderReproved)
    {
        $order = $orderReproved->getOrder();
        ApproveOrderJob::dispatch($order);
    }

    public function subscribe(Dispatcher $dispatcher)
    {
        $dispatcher->listen(OrderReproved::class, static::class . '@onOrderReproved');
    }

}
