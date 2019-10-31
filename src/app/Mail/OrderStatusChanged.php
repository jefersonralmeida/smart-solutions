<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Order
     */
    protected $order;

    /**
     * @var int
     */
    protected $oldStatus;

    /**
     * @var int
     */
    protected $newStatus;

    /**
     * Create a new message instance.
     *
     * @param Order $order
     * @param int $oldStatus
     * @param int $newStatus
     */
    public function __construct(Order $order, int $oldStatus, int $newStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.orderStatusChanged', [
            'order' => $this->order,
            'oldStatus' => config('status')[$this->oldStatus]['name'] ?? '',
            'newStatus' => config('status')[$this->oldStatus]['name'] ?? '',
        ]);
    }
}
