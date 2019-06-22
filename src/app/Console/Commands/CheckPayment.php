<?php

namespace App\Console\Commands;

use App\Events\OrderApproved;
use App\ExternalApi\Itau\Itau;
use App\Order;
use Illuminate\Console\Command;

class CheckPayment extends Command
{
    /**
     * @var Itau
     */
    protected $itau;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkPayments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check payment status for orders on "Waiting Payment Confirmation" status.';

    /**
     * Create a new command instance.
     *
     * @param Itau $itau
     */
    public function __construct(Itau $itau)
    {
        parent::__construct();
        $this->itau = $itau;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $orders = Order::waitingPaymentConfirmation();
        /** @var Order $order */
        foreach ($orders as $order) {
            $paymentDate = $this->itau->checkPaymentStatus($order);
            if ($paymentDate !== null) {
                $order->payment_confirmed_at = $paymentDate;
                $order->save();
                event(new OrderApproved($order));
            }
        }
    }
}
