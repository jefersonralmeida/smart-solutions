<?php

namespace App\ExternalApi\Orders\Pixsoft;

use App\Dentist;
use App\ExternalApi\Orders\DentistCreateResponseContract;
use App\ExternalApi\Orders\OrdersApiContract;
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
}