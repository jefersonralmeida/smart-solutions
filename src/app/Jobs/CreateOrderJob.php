<?php

namespace App\Jobs;

use App\ExternalApi\Orders\OrdersApiContract;
use App\ExternalApi\Spc\SpcApiContract;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

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
     * @param OrdersApiContract $ordersApi
     * @param SpcApiContract $spcApi
     * @return void
     */
    public function handle(OrdersApiContract $ordersApi, SpcApiContract $spcApi)
    {

        Log::debug("Enviando pedido '{$this->order->id}' para o SOL.");

        // check if the dentist already exists on the api, if not, create it
        if ($this->order->dentist->integration_status != 'S') {
            Log::debug("Enviando o dentista {$this->order->dentist->name} ({$this->order->dentist->cro}) para o SOL.");
            $response = $ordersApi->createDentist($this->order->dentist);
            if ($response !== null) {
                $this->order->dentist->integration_status = 'S';
                $this->order->dentist->integration_id = $response->getId();
                $this->order->dentist->save();
            }
        }

        // check if the address is already attached to the dentist on the api, if not, attach it
        $addressIntegration = $this->order->address->integration;
        if (!isset($addressIntegration[$this->order->dentist->id])) {
            Log::debug("Enviando o endereço {$this->order->address->id} para o SOL.");
            $response = $ordersApi->createAddress($this->order->address, $this->order->dentist);
            if ($response !== null) {
                $addressIntegration[$this->order->dentist->id] = $response->getId();
                $this->order->address->integration = $addressIntegration;
                $this->order->address->save();
            }
        }

        // creates the order
        Log::debug("Enviando o pedido '{$this->order->id}' para o SOL");
        $orderResponse = $ordersApi->createOrder($this->order);
        if (!empty($id = $orderResponse->getId())) {

            // check spc
            try {
                $spcResult = $spcApi->isClean('F', $this->order->dentist->cpf);
                $spcResponse = $spcApi->getLastFullResponse();
                $spcError = $spcApi->getLastError();
            } catch (\Throwable $e) {
                $spcResult = false;
                $spcResponse = '';
                $spcError = 'Erro na API do SPC.';
            }

            $this->order->setOrderPlaced();
            $this->order->integration_id = $id;
            $this->order->integration_failed = false;
            $this->order->payment_methods = $spcResult
                ? array_keys(config('payments.payment_methods'))
                : config('payments.spcReproved');
            $this->order->spc_result = [
                'response' => $spcResponse,
                'error' => $spcError,
            ];
            $this->order->save();
            return;
        }
        Log::debug("Envio do pedido '{$this->order->id}' falhou.");
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
