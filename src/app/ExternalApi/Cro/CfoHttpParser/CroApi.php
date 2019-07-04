<?php

namespace App\ExternalApi\Cro\CfoHttpParser;

use App\ExternalApi\Cro\CroApiContract;
use App\ExternalApi\Cro\CroResponseContract;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;

class CroApi implements CroApiContract
{

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $categoryMap;

    public function __construct(HttpClient $httpClient, array $categoryMap)
    {
        $this->httpClient = $httpClient;
        $this->categoryMap = $categoryMap;
    }

    /**
     * @param string $cro
     * @return CroResponseContract
     * @throws GuzzleException
     */
    public function request(string $cro): ?CroResponseContract
    {
        // splitting the CRO
        [$state, $category, $code] = explode('-', $cro);

        // checking if the state is valid
        if (!in_array($state, config('states'))) {
            return null;
        }

        // checking the category
        if (!isset($this->categoryMap[$category])) {
            return null;
        }
        /** @var int $categoryCode */
        $categoryCode = $this->categoryMap[$category];

        // finally requesting the "API"
        $response = $this->httpClient->request('GET', '', [
            'query' => [
                'cro' => $state,
                'categoria' => $categoryCode,
                'especialidade' => 'todas',
                'inscricao' => $code,
                'nome' => ''
            ]
        ]);
        $html = $response->getBody()->getContents();

        if (!preg_match('/Totais encontrados: 1.*/is', $html, $matches)) {
            return null;
        }
        $html = trim($matches[0]);

        // extracting the name
        if (!preg_match('/<b>([A-Z ]+)<\/b>/', $html, $matches)) {
            return null;
        }

        $name = sanitizeString($matches[1]);

        // extracting the status
        if (!preg_match('/Situação\:\s+([A-Za-z ]+)/', $html, $matches)) {
            return null;
        }
        $status = sanitizeString($matches[1]);

        return new CroResponse($name, $status);
    }
}