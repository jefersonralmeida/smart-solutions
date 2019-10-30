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
     * @return void
     */
    public function handle()
    {

        \Log::info('Verificando pedidos no sol...');

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

            \Log::info("Verificando pedidos do dentista {$dentist->name}:{$dentist->cro}...");

            $items = $this->ordersApi->listOrders($dentist)->getOrders();

            if (!empty($items)) {

                \Log::info("Resposta do sol: " . json_encode($items));

                foreach ($items as $item) {

                    // check if the order exists for the dentist
                    /** @var Order $order */
                    $order = $dentist->orders->first(function (Order $order) use ($item) {
                        return $order->integration_id == $item['integration_id'];
                    });

                    // if it don't exists do nothing
                    if (empty($order)) {
                        continue;
                    }

                    switch ($item['state_id']) {

                        // documentação em análise técnica - comentado porque esse é o pedido inicial após integração. Não precisa verificar
//                        case 33:
//                        case 35:
//                            $order->setOrderPlaced();
//                            $order->save();
//                            break;

                        // documentacao com problema
                        case 24:
                        case 25:
                            $order->setFailedDoc();
                            $order->save();
                            break;

                        // pedido em planejamento
                        case 37:
                            $order->setPlanning();
                            $order->save();
                            break;

                        // setup virtual disponível para aprovação
                        case 15:

                            $value = $this->ordersApi->prePlanning($order)->getPrice();

                            // ignore orders without price value
                            if ($value == 0) {
                                \Log::error("Pedido {$order->id} ({$order->integration_id}) sem preço.");
                                break;
                            }

                            // ignore orders without files
                            if (count(getAvailableProjectFiles($order->id)) === 0) {
                                \Log::error("Pedido {$order->id} ({$order->integration_id}) não tem arquivos.");
                                break;
                            }

                            // set the status
                            $order->value = $value;
                            $order->setWaitingApprovement();
                            $order->save();
                            break;

                        // Alteração solicitada - comentado porque esse é o status quando uma alteração é solicitada. Não precisa verificar
//                        case 23:
//                            $order->setChangeRequired();
//                            $order->save();
//                            break;

                        // em produção
                        case 44:
                            $order->setUnderProduction();
                            $order->save();
                            break;

                        // preparando envio
                        case 22:
                            $order->setPreparingShipping();
                            $order->save();
                            break;

                        // pedido enviado
                        case 54:
                            $order->setShipped();
                            $order->save();
                            break;
                    }
                }

            } else {
                \Log::info("Nenhum pedido encontrado para o dentista...");
            }
        }
    }
}
