<?php

namespace App\ExternalApi\Cro;

use GuzzleHttp\Client as Http;
use GuzzleHttp\Exception\GuzzleException;

class CroApi implements CroApiContract
{

    public function request(string $cro): CroResponseContract
    {
        // splitting the CRO
        [$state, $category, $code] = explode('-', $cro);

        // checking if the state is valid
        if (!in_array($state, config('states'))) {
            return null;
        }

        // checking the category
        $categoryMap = config('cro.categoryMap');
        if (!isset($categoryMap[$category])) {
            return null;
        }
        /** @var int $categoryCode */
        $categoryCode = $categoryMap[$category];

        // finally requesting the "API"
        $client = new Http();
        try {
            $response = $client->request('GET', config('cro.url'), [
                'query' => [
                    'cro' => $state,
                    'categoria' => $categoryCode,
                    'especialidade' => 'todas',
                    'inscricao' => $code,
                    'nome' => ''
                ]
            ]);
        } catch (GuzzleException $e) {
            return null;
        }
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