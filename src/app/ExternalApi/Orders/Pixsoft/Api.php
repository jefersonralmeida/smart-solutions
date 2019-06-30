<?php

namespace App\ExternalApi\Orders\Pixsoft;

use App\Address;
use App\Dentist;
use App\ExternalApi\Orders\AddressCreateResponseContract;
use App\ExternalApi\Orders\DentistCreateResponseContract;
use App\ExternalApi\Orders\ListOrdersResponseContract;
use App\ExternalApi\Orders\OrderCreateResponseContract;
use App\ExternalApi\Orders\OrdersApiContract;
use App\ExternalApi\Orders\Pixsoft\PrePlanningResponse;
use App\ExternalApi\Orders\PrePlanningResponseContract;
use App\Order;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Model;
use Log;

class Api implements OrdersApiContract
{

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * Api constructor.
     * @param HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    protected function fromModel(Model $model, array $map): array
    {
        $output = [];
        foreach ($map as $to => $from) {
            if (is_numeric($to)) {
                $to = $from;
            }
            $output[$to] = is_callable($from) ? $from($model) : $model->getAttribute($from);
        }
        return $output;
    }

    /**
     * @param Dentist $dentist
     * @return DentistCreateResponseContract
     */
    public function createDentist(Dentist $dentist): DentistCreateResponseContract
    {

        $map = [
            'nome' => 'name',
            'CRO' => function (Model $model) {
                return str_replace('-', '', $model->getAttribute('cro'));
            },
            'CPF' => function (Model $model) {
                return str_replace(['-', '.'], '', $model->getAttribute('cpf'));
            },
            'telefone' => function (Model $model) {
                $phone = $model->getAttribute('cellphone') ?? $model->getAttribute('phone');
                return str_replace('-', '', $phone);
            },
            'email',
        ];

        try {
            $response = $this->httpClient->request('POST', 'profissional', [
                'json' => $this->fromModel($dentist, $map),
            ]);
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return null;
        }

        return new DentistCreateResponse($response);

    }


    /**
     * @param Address $address
     * @param Dentist $dentist
     * @return AddressCreateResponseContract
     */
    public function createAddress(Address $address, Dentist $dentist): AddressCreateResponseContract
    {
        $payload = [
            'dentista' => $dentist->integration_id,
            'descricao_endereco' => $address->identification,
            'logradouro' => $address->street,
            'numero' => $address->street_number,
            'complemento' => $address->address_details,
            'bairro' => $address->district,
            'cidade' => $address->city,
            'estado' => $address->state,
            'cep' => $address->zip_code,
        ];

        try {
            $response = $this->httpClient->request('POST', 'endereco_dentista', [
                'json' => $payload,
            ]);
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return null;
        }

        return new AddressCreateResponse($response);
    }

    /**
     * @param Order $order
     * @return OrderCreateResponseContract
     */
    public function createOrder(Order $order): OrderCreateResponseContract
    {

        $order->load('dentist', 'patient');

        $data = $order->data;
        $data['arquivos'] = [config('paths.uri') . '/' . $order->id];

        $payload = [
            'profissional' => $order->dentist->integration_id,
            'produto' => $order->product,
            'paciente' => [
                'nome' => $order->patient->name,
                'data_nascimento' => $order->patient->birthday->format('Y-m-d'),
                'genero' => $order->patient->gender,
                'email' => $order->patient->email,
                'telefone' => $order->patient->phone,
                'celular' => $order->patient->cellphone,
                'estado' => $order->patient->state,
                'cidade' => $order->patient->city,
            ],
            'dentista' => [
                'nome' => $order->dentist->name,
                'CRO' => $order->dentist->cro,
                'CPF' => $order->dentist->cpf,
                'telefone' => $order->dentist->phone,
                'email' => $order->dentist->email,
            ],
            'forma_envio' => $order->shipping,
            'endereco_envio' => $order->address->identification,
            'forma_pagamento' => $order->payment,
            'dados' => $order->data,
        ];

        try {
            $response = $this->httpClient->request('POST', 'pedidos', [
                'json' => $payload,
            ]);
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return null;
        }

        return new OrderCreateResponse($response);
    }

    /**
     * @param Dentist $dentist
     * @return ListOrdersResponseContract
     */
    public function listOrders(Dentist $dentist): ?ListOrdersResponseContract
    {
        try {
            $response = $this->httpClient->request('GET', "pedidos/profissional/{$dentist->integration_id}");
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return null;
        }
        return new ListOrdersResponse($response);
    }

    public function prePlanning(Order $order): ?PrePlanningResponseContract
    {
        try {
            $response = $this->httpClient->request('GET', "pedidos/{$order->integration_id}/pre-planejamento");
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return null;
        }
        return new PrePlanningResponse($response);
    }

    public function approveOrder(Order $order): bool
    {
        try {
            $this->httpClient->request('PUT', "pedidos/{$order->integration_id}/pre-planejamento/approve");
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return false;
        }
        return true;
    }

    public function reproveOrder(Order $order): bool
    {
        try {
            $this->httpClient->request('PUT', "pedidos/{$order->integration_id}/pre-planejamento/reject");
        } catch (GuzzleException $e) {
            Log::error($e->getMessage());
            return false;
        }
        return true;
    }
}