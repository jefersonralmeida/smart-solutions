 <?php

return [
    'providers' => [
        'Retirada na Smart Solutions' => [
            'class' => \App\ExternalApi\Shipping\Retirada\Retirada::class,
            'params' => [
                'name' => env('LOCAL_PICK_NAME', 'Retirada na Smart Solutions.'),
                'prize' => env('LOCAL_PICK_PRIZE')
            ]
        ],
        'Entrega feita pela Smart Solutions' => [
            'class' => \App\ExternalApi\Shipping\Entrega\Entrega::class,
            'params' => [
                'name' => env('LOCAL_SHIPPING_NAME', 'Entrega feita pela Smart Solutions (Grande Rio e Niteroi)'),
                'lowerZipLimit' => env('LOCAL_SHIPPING_LOWER_ZIP_LIMIT', 20000),
                'higherZipLimit' => env('LOCAL_SHIPPING_HIGHER_ZIP_LIMIT', 26600),
                'price' => env('LOCAL_SHIPPING_PRICE'),
                'prize' => env('LOCAL_SHIPPING_PRIZE')
            ]
        ],
        'Correios | SEDEX' => [
            'class' => \App\ExternalApi\Shipping\Correios\Correios::class,
            'params' => [
                'name' => env('CORREIOS_NAME', 'Correios | SEDEX'),
                'baseUrl' => env('CORREIOS_BASE_URL', 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx'),
                'timeout' => env('CORREIOS_TIMEOUT', 10),
                'requestParams' => [
                    'nCdEmpresa' => env('CORREIOS_COD_EMPRESA', ''),
                    'sDsSenha' => env('CORREIOS_SENHA_CONTRATO', ''),
                    'nCdServico' => env('CORREIOS_CODIGO_SERVICO', 04014),
                    'sCepOrigem' => env('CORREIOS_CEP_ORIGEM', '22041080'),
                    'nVlPeso' => env('CORREIOS_PESO', 1),
                    'nCdFormato' => env('CORREIOS_FORMATO', 1),
                    'nVlComprimento' => env('CORREIOS_COMPRIMENTO', 20),
                    'nVlAltura' => env('CORREIOS_ALTURA', 20),
                    'nVlLargura' => env('CORREIOS_LARGURA', 20),
                    'nVlDiametro' => env('CORREIOS_DIAMETRO', 20),
                    'sCdMaoPropria' => env('CORREIOS_MAO_PROPRIA', 'N'),
                    'nVlValorDeclarado' => env('CORREIOS_VALOR_DECLARADO', 0),
                    'sCdAvisoRecebimento' => env('CORREIOS_AVISO_RECEBIMENTO', 'N'),
                    'StrRetorno' => 'XML',
                    'nIndicaCalculo' => 3
                ]

            ],
        ],
        'Entrega pela TAM ao destino final' => [
            'class' => \App\ExternalApi\Shipping\TamCargo\TamCargo::class,
            'params' => [
                'name' => env('TAM_CARGO_NAME', 'Transporte aéreo (TAM Cargo)'),
                'price' => env('TAM_CARGO_PRICE', 100),
                'prize' => env('TAM_CARGO_PRIZE', '5 dias'),
                'zip_range_file' => resource_path(env('TAM_CARGO_FILE', 'extra/diretorio_ceps_tam_cargo.xlsx')) ?? env('TAM_CARGO_FILE'),
                'startLine' => env('TAM_CARGO_START_LINE',2),
                'endLine' => env('TAM_CARGO_END_LINE', 8658),
                'startColumn' => env('TAM_CARGO_START_COLUMN', 'E'),
                'endColumn' => env('TAM_CARGO_END_COLUMN', 'F'),
                'cacheTTL' => env('TAM_CARGO_CACHE_TTL', 10),
            ]
        ],
    ]
];
