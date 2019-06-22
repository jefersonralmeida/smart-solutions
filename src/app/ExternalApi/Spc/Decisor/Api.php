<?php

namespace App\ExternalApi\Spc\Decisor;

use App\ExternalApi\Spc\SpcApiContract;

class Api implements SpcApiContract
{

    /**
     * @var \nusoap_client
     */
    protected $client;

    /**
     * @var int
     */
    protected $productCode;

    /**
     * @var array
     */
    protected $lastResponse = [];

    /**
     * @var string
     */
    protected $lastError = '';

    public function __construct(\nusoap_client $client, int $productCode)
    {
        $this->client = $client;
        $this->productCode = $productCode;
    }


    /**
     * @param string $type - [F]isica ou [J]uridica
     * @param string $document
     * @return bool
     * @throws \Exception
     */
    public function isClean(string $type, string $document): bool
    {

        $this->lastResponse = [];
        $this->lastError = '';

        $params = [
            'tipo-consumidor' => $type,
            'codigo-produto' => $this->productCode,
            'documento-consumidor' => $document
        ];

        $response = $this->client->call('consultar', ['filtro' => $params], '', '', false, true);
        $this->lastResponse = $response;
        $this->lastError = $this->client->getError();

        if (!$response) {
            throw new \Exception('Failed to check SPC.');
        }

        if (
            $response['alerta-documento']['resumo']['!quantidade-total'] > 0 ||
            $response['spc']['resumo']['!quantidade-total'] > 0 ||
            $response['cheque-lojista']['resumo']['!quantidade-total'] > 0 ||
            $response['ccf']['resumo']['!quantidade-total'] > 0
        ) {
            return false;
        }

        return true;
    }

    /**
     * Return the last full/unparsed response from the isClean method
     * @return array
     */
    public function getLastFullResponse(): array
    {
        return $this->lastResponse;
    }

    /**
     * Return the last error from the isClean method
     * @return string
     */
    public function getLastError(): string
    {
        return $this->lastError;
    }
}