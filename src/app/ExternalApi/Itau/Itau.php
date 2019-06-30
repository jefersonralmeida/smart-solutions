<?php

namespace App\ExternalApi\Itau;

use App\Order;
use Carbon\Carbon;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class Itau
{

    /**
     * @var ItauCripto
     */
    protected $crypto;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $paymentMethodMap = [
        '01' => 'À vista',
        '02' => 'Boleto',
        '03' => 'Cartão de Crédito',
    ];

    public function __construct(HttpClient $httpClient)
    {
        $this->crypto = new ItauCripto();
        $this->code = config('itau.codEmp');
        $this->key = config('itau.key');
        $this->httpClient = $httpClient;
    }

    /**
     * @param Order $order
     * @return string
     * @throws \Exception
     */
    public function getEncryptedData(Order $order): string
    {
        $pedido = $order->id;
        $valor = number_format($order->total_value, 2, ',', '');
        $observacao = "";
        $nomeSacado = $order->billing_name;
        $codigoInscricao = "01";
        $numeroInscricao = removeMask($order->billing_document, config('masks.cpf'));
        $enderecoSacado = $order->billing_address;
        $bairroSacado = $order->billing_district;
        $cepSacado = $order->billing_zip_code;
        $cidadeSacado = $order->billing_city;
        $estadoSacado = $order->billing_state;
        $dataVencimento = now()->addDays(5)->format('dmY');
        $urlRetorna = route('orders.paymentReturn', ['order' => $order->id]);
        $obsAd1 = "";
        $obsAd2 = "";
        $obsAd3 = "";

        try {
            $data = $this->crypto->geraDados($this->code, $pedido, $valor, $observacao, $this->key, $nomeSacado,
                $codigoInscricao, $numeroInscricao, $enderecoSacado, $bairroSacado, $cepSacado, $cidadeSacado, $estadoSacado,
                $dataVencimento, $urlRetorna, $obsAd1, $obsAd2, $obsAd3);
        } catch (\Exception $e) {
            throw $e;
        }
        return $data;
    }

    /**
     * Decrypts the real-time return data
     *
     * @param string $encrypted
     * @return array
     * @throws \Exception
     */
    public function decryptReturn(string $encrypted): array
    {
        try {
            $this->crypto->decripto($encrypted, $this->key);
        } catch (\Exception $e) {
            throw $e;
        }

        $orderId = $this->crypto->retornaPedido();
        $paymentMethodId = $this->crypto->retornaTipPag();

        if ($orderId === null || $paymentMethodId === null) {
            throw new \Exception('Invalid encrypted data');
        }

        $paymentMethod = $this->paymentMethodMap[$paymentMethodId] ?? null;
        if ($paymentMethod === null) {
            throw new \Exception('Invalid payment method');
        }

        return [
            'orderId' => $orderId,
            'paymentMethod' => $this->paymentMethodMap[$paymentMethod],
        ];
    }

    /**
     * Checks the payment status for an order, returning the payment date
     *
     * @param Order $order
     * @return Carbon|null
     */
    public function checkPaymentStatus(Order $order): ?Carbon
    {
        $encrypted = $this->crypto->geraConsulta($this->code, $order->id, '0', $this->key);

        // request the bank api to get the payment status for the order
        $uri = 'https://shopline.itau.com.br/shopline/consulta.aspx';
        try {
            $response = $this->httpClient->request('post', $uri, [
                'form_params' => [
                    'DC' => $encrypted
                ]
            ]);
        } catch (GuzzleException $e) {
            // if the request fail, log the problem (should never happen)
            Log::critical("Wasn't possible to check the payment status for order {$order->id}.");
            return null;
        }

        // first we verify the payment method
        if (!preg_match('/\<param\s+id\=\"tippag\"\s*value\=\"(\d{2})\"/i', $response, $matches)) {
            // if it's not possible to find the payment method, we log the problem (should never happen)
            Log::critical("The order {$order->id} don't have a payment method. Request response: $response");
            return null;
        }
        $paymentMethod = $matches[1];

        // then we verify if the payment method is valid
        if (!in_array($paymentMethod, ['01', '02', '03'])) {
            // if it's not on the list, we log the problem (should never happen)
            Log::critical("The order {$order->id} don't have a valid payment method. Request response: $response");
            return null;
        }

        // then we verify the payment situation
        if (!preg_match('/\<param\s+id\=\"sitpag\"\s*value\=\"(\d{2})\"/i', $response, $matches)) {
            // if it's not possible to get the payment situation, we log the problem (should never happen)
            Log::critical("The order {$order->id} don't have a payment situation. Request response: $response");
            return null;
        }
        $paymentSituation = $matches[1];

        // verify the try again situations
        if (preg_match('/^0[12]$/', $paymentSituation)) {
            // set the order back to waitingPayment status
            $order->setWaitingPayment();
            $order->save();
            return null;
        }

        // verify the not paid normal situations
        if (preg_match('/^0[3456]$/', $paymentSituation)) {
            // just return null, since the payment was not made yet
            return null;
        }

        // the only remaining possibility, is the payment paid, if it's not the case, we have a problem...
        if ($paymentSituation !== '00') {
            // if the payment situation is invalid, we log the problem (should never happen).
            Log::critical("The order {$order->id} don't have a valid payment situation. Request response: $response");
            return null;
        }

        // get the payment date
        if (!preg_match('/\<param\s+id\=\"dtpag\"\s*value\=\"(\d{8})\"/i', $response, $matches)) {
            // if we're here, and don't have a payment date, we have a HUGE problem. Log this shit (Should never happen)
            Log::critical("The order {$order->id} is paid, but don't have a valid payment date. Request response: $response");
            return null;
        }

        return Carbon::createFromFormat('dmY', $matches[1]);
    }
}