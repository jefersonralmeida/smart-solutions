<?php

namespace App\Jobs;

use App\ExternalApi\Orders\OrdersApiContract;
use App\ExternalApi\Spc\SpcApiContract;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ApproveOrderJob implements ShouldQueue
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
        $order->load('dentist', 'address');
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
        if (!$ordersApi->approveOrder($this->order)) {
            \Log::critical("Failed to send approvement   of order {$this->order->id} to the orders api.");
            return;
        }
        $this->order->setPaymentConfirmed();
        $this->order->save();
    }

}
