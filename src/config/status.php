<?php

return [
    1 => [
        'name' => 'Pedido Iniciado',
        'color' => '#7bdd59',
        'next' => [
            'label' => 'Finalizar Pedido',
            'route' => ['orders.confirm', ['id']],
        ]
    ],
    2 => [
        'name' => 'Em Processamento',
        'color' => '#59ccdd',
        'next' => [
            'label' => 'Processar novamente',
            'route' => ['orders.forceIntegration', ['id']],
            'condition' => ['integration_failed' => true]
        ]
    ],
    3 => [
        'name' => 'Pedido Realizado',
        'color' => '#ddbb53',
    ],
    4 => [
        'name' => 'Projeto Aprovado',
        'color' => '#9683d5',
    ],
    5 => [
        'name' => 'Aguardando Pagamento',
        'color' => '#848484',
    ],
    6 => [
        'name' => 'Pedido Enviado',
        'color' => '#848484',
    ]
];