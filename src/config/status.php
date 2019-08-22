<?php

return [
    0 => [
        'name' => 'Aguardando arquivos',
        'color' => '#7bdd59',
        'next' => [
            'label' => 'Enviar Arquivos',
            'route' => ['orders.filesForm', ['id']],
        ]
    ],
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
        'name' => 'Pedido Realizado - Aguardando Pre-projeto',
        'color' => '#ddbb53',
    ],
    4 => [
        'name' => 'Pre projeto criado - Aguardando Aprovação',
        'color' => '#9683d5',
        'next' => [
            'label' => 'Aprovar Projeto',
            'route' => ['orders.approve.view', ['id']],
        ]
    ],
    6 => [
        'name' => 'Aguardando Pagamento',
        'color' => '#848484',
        'next' => [
            'label' => 'Realizar Pagamento',
            'route' => ['orders.payments', ['id']],
        ]
    ],
    7 => [
        'name' => 'Aguardando Confirmação de Pagamento',
        'color' => '#848484'
    ],
    8 => [
        'name' => 'Pagamento Confirmado',
        'color' => '#848484'
    ]
];
