<?php

namespace App\Jobs;

use App\ExternalApi\Orders\OrdersApiContract;
use App\ExternalApi\Spc\SpcApiContract;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReproveOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 10;
    public $tries = 5;

    /**
     * @var Order
     */
    protected $order;

    /**
     * Create a new job instance.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @param OrdersApiContract $ordersApi
     * @return void
     */
    public function handle(OrdersApiContract $ordersApi)
    {
        $this->order->setCancelProcess();
        $this->order->save();
        if (!$ordersApi->reproveOrder($this->order)) {
            \Log::critical("Failed to send reprovement of order {$this->order->id} to the orders api.");
            return;
        }
        $this->order->setCanceled();
        $this->order->save();
    }

}
