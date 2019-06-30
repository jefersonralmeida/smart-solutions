<?php

namespace App\Events;

use App\Order;
use Illuminate\Queue\SerializesModels;

class OrderReproved
{
    use SerializesModels;

    protected $order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }
}
