<?php

namespace App\Console\Commands;

use App\Dentist;
use App\ExternalApi\Orders\OrdersApiContract;
use App\Order;
use App\Scopes\CurrentClinicScope;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class CheckOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkOrders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for orders on "waiting approval" status.';

    /**
     * @var OrdersApiContract
     */
    protected $ordersApi;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(OrdersApiContract $ordersApi)
    {
        parent::__construct();
        $this->ordersApi = $ordersApi;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dentists = Dentist::withPendingOrders()
            ->withoutGlobalScope(CurrentClinicScope::class)
            ->with('orders')
            ->where(function (Builder $query) {
                return $query
                    ->orWhereNull('last_order_check')
                    ->orWhereDate('last_order_check', '<', now()->subMinutes(config('orderCheck.checkTimeout')));
            })
            ->get();
        /** @var Dentist $dentist */
        foreach ($dentists as $dentist) {

            $items = $this->ordersApi->listOrders($dentist)->getOrders();
            if (!empty($items)) {
                $ordersToChange = [];
                foreach ($items as $item) {
                    if ($item['state_id'] == config('orderCheck.checkApiStatus')) {
                        $ordersToChange[] = (int)$item['integration_id'];
                    }
                }

                $orders = $dentist->orders->filter(function (Order $item) use ($ordersToChange) {
                    return in_array($item->integration_id, $ordersToChange);
                });

                /** @var Order $order */
                foreach ($orders as $order) {
                    $order->setWaitingApprovement();
                    $order->save();
                }
            }
        }
    }
}
