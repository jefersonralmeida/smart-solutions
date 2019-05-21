<?php

namespace App\ExternalApi\Orders\Pixsoft;

use App\Address;
use App\Dentist;
use App\ExternalApi\Orders\AddressCreateResponseContract;
use App\ExternalApi\Orders\DentistCreateResponseContract;
use App\ExternalApi\Orders\OrderCreateResponseContract;
use App\ExternalApi\Orders\OrdersApiContract;
use App\Order;
use App\Patient;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Database\Eloquent\Model;

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
     * @throws \GuzzleHttp\Exception\GuzzleException
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

        $response = $this->httpClient->request('POST', 'profissional', [
            'json' => $this->fromModel($dentist, $map),
        ]);

        return new DentistCreateResponse($response);

    }


    /**
     * @param Address $address
     * @param Dentist $dentist
     * @return AddressCreateResponseContract
     * @throws \GuzzleHttp\Exception\GuzzleException
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

        $response = $this->httpClient->request('POST', 'endereco_dentista', [
            'json' => $payload,
        ]);

        return new AddressCreateResponse($response);
    }

    /**
     * @param Order $order
     * @return OrderCreateResponseContract
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createOrder(Order $order): OrderCreateResponseContract
    {
        $payload = [
            'profissional' => $order->dentist->integration_id,
            'produto' => $order->product,
            'patient' => [
                'nome' => $order->patient->name,
                'data_nascimento' => $order->patient->birthday->format('Y-m-d'),
                'genero' => $order->patient->gender,
                'email' => $order->patient->email,
                'telefone' => $order->patient->phone,
                'celular' => $order->patient->cellphone,
                'estado' => $order->patient->state,
                'cidade' => $order->patient->city,
            ],
            'forma_envio' => $order->shipping,
            'endereco_envio' => $order->address->identification,
            'forma_pagamento' => $order->payment,
            'dados' => $order->data,
        ];

        $response = $this->httpClient->request('POST', 'pedidos', [
            'json' => $payload,
        ]);

        return new OrderCreateResponse($response);
    }
}