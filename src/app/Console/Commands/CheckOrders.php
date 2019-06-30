<?php

namespace App\Console\Commands;

use App\Dentist;
use App\ExternalApi\Orders\OrdersApiContract;
use App\Order;
use App\Scopes\CurrentClinicScope;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
            ->with(['orders' => function (HasMany $query) {
                $query->where('status', 3); // only orders on status 3
                $query->withoutGlobalScope(CurrentClinicScope::class);
            }])
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

                $orders = $dentist->orders->filter(function (Order $order) use ($ordersToChange) {
                    return in_array($order->integration_id, $ordersToChange);
                });

                /** @var Order $order */
                foreach ($orders as $order) {
                    $value = $this->ordersApi->prePlanning($order)->getPrice();

                    // ignore orders without price value
                    if ($value == 0) {
                        \Log::error("Pedido {$order->id} ({$order->integration_id}) sem preço.");
                        continue;
                    }
                    $order->value = $this->ordersApi->prePlanning($order)->getPrice();
                    $order->setWaitingApprovement();
                    $order->save();
                }
            }
        }
    }
}
