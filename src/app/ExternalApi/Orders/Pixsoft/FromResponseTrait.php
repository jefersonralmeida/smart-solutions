<?php

namespace App\ExternalApi\Orders\Pixsoft;

use GuzzleHttp\Psr7\Response;
use Log;

trait FromResponseTrait
{
    public function __construct(Response $response)
    {
        $rawContent = $response->getBody()->getContents();
        $result = json_decode($rawContent);

        if (!empty($result->msgErro)) {
            Log::error('Mensagem de erro do SOL:' . $result->msgErro);
            $this->response = null;
            return;
        }

        if ($response->getStatusCode() >= 400) {
            Log::error('Erro ao consultar a api: ' . print_r($rawContent, true));
            $this->response = null;
            return;
        }

        if (empty($rawContent)) {
            Log::error('Erro ao consultar a api: Resposta vazia.');
            $this->response = null;
            return;
        }

        $this->response = json_decode($rawContent);
    }
}
