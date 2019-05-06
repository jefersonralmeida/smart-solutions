<?php

namespace App\Events;

use App\Order;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\SerializesModels;

class OrderCreated
{
    use SerializesModels;

    /**
     * @var Order
     */
    protected $order;

    /**
     * @var UploadedFile
     */
    protected $files;

    /**
     * Create a new event instance.
     *
     * @param Order $order
     * @param UploadedFile[] $files
     */
    public function __construct(Order $order, array $files)
    {
        $this->order = $order;
        $this->files = $files;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @return UploadedFile[]
     */
    public function getFiles(): array
    {
        return $this->files;
    }

}
