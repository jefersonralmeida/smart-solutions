<?php

namespace App\Listeners;


use App\Events\OrderConfirmed;
use App\ExternalApi\Orders\OrdersApiContract;
use App\Jobs\ApproveOrderJob;
use Illuminate\Events\Dispatcher;

class ApproveOrderOnApi
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

    public function onOrderApproved(OrderConfirmed $orderApproved)
    {
        $order = $orderApproved->getOrder();
        ApproveOrderJob::dispatch($order);
    }

    public function subscribe(Dispatcher $dispatcher)
    {
        $dispatcher->listen(OrderConfirmed::class, static::class . '@onOrderApproved');
    }

}
