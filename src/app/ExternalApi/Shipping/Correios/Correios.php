<?php

namespace App\ExternalApi\Shipping\Correios;

use App\ExternalApi\Shipping\ShippingContract;
use GuzzleHttp\Client as HttpClient;
use Log;

class Correios implements ShippingContract
{

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var int
     */
    protected $prize;

    /**
     * @var bool
     */
    protected $covered = false;

    /**
     * Correios constructor.
     * @param string $zipCode
     * @param array $params
     */
    public function __construct(string $zipCode, array $params)
    {

        $this->name = $params['name'];


        $httpClient = new HttpClient([
            'base_uri' => $params['baseUrl'],
            'timeout' => $params['timeout'],
        ]);

        $requestParams = array_merge($params['requestParams'], ['sCepDestino' => $zipCode]);

        try {
            $response = $httpClient->get('', [
                'query' => $requestParams,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to calculate the shipping using Correios. The api request failed with the params: ' . json_encode($requestParams));
            return;
        }

        $xml = simplexml_load_string($response->getBody()->getContents());

        if (!empty((string) $xml->cServico->erro)) {
            Log::error("Failed to calculate the shipping using Correios. The API responded with the error: '{$xml->cServico->MsgErro}'");
            return;
        }

        $this->price = (float) $xml->cServico->Valor;
        $this->prize = (int) $xml->cServico->PrazoEntrega;
        $this->covered = true;
    }

    protected function requestApi()
    {
        $params = [
            'nCdEmpresa' => '',

        ];
        $this->httpClient->get('', [
            'query' => $params
        ]);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isCovered(): bool
    {
        return $this->covered;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDeliveryPrize(): string
    {
        return $this->prize . ' dias';
    }
}