<?php

namespace App\Jobs;

use App\ExternalApi\Orders\OrdersApiContract;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateOrderJob implements ShouldQueue
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
     * @param OrdersApiContract $api
     * @return void
     */
    public function handle(OrdersApiContract $api)
    {

        // check if the dentist already exists on the api, if not, create it
        if ($this->order->dentist->integration_status != 'S') {
            $response = $api->createDentist($this->order->dentist);
            $this->order->dentist->integration_status = 'S';
            $this->order->dentist->integration_id = $response->getId();
            $this->order->dentist->save();
        }

        // check if the address is already attached to the dentist on the api, if not, attach it
        $addressIntegration = $this->order->address->integration;
        if (!isset($addressIntegration[$this->order->dentist->id])) {
            $response = $api->createAddress($this->order->address, $this->order->dentist);
            $addressIntegration[$this->order->dentist->id] = $response->getId();
            $this->order->address->integration = $addressIntegration;
            $this->order->address->save();
        }

        $response = $api->createOrder($this->order);

        if (($id = $response->getId()) !== false) {
            $this->order->incrementStatus();
            $this->order->integration_id = $id;
            $this->order->integration_failed = false;
            $this->order->save();
        }

    }

    /**
     * @param \Exception $e
     */
    public function failed(\Exception $e)
    {
        $this->order->integration_failed = true;
        $this->order->save();
    }
}
