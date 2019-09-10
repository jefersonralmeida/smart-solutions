<?php

return [
    0 => [
        'name' => 'Aguardando arquivos',
        'next' => [
            'label' => 'Enviar Arquivos',
            'route' => ['orders.filesForm', ['id']],
        ]
    ],
    1 => [
        'name' => 'Pedido Iniciado',
        'next' => [
            'label' => 'Finalizar Pedido',
            'route' => ['orders.confirm', ['id']],
        ]
    ],
    2 => [
        'name' => 'Em Processamento',
        'next' => [
            'label' => 'Processar novamente',
            'route' => ['orders.forceIntegration', ['id']],
            'condition' => ['integration_failed' => true]
        ]
    ],
    3 => [
        'name' => 'Pedido Realizado - Aguardando Pre-projeto',
    ],
    4 => [
        'name' => 'Pre projeto criado - Aguardando Aprovação',
        'next' => [
            'label' => 'Aprovar Projeto',
            'route' => ['orders.approve.view', ['id']],
        ]
    ],
    6 => [
        'name' => 'Aguardando Pagamento',
        'next' => [
            'label' => 'Realizar Pagamento',
            'route' => ['orders.payments', ['id']],
        ]
    ],
    7 => [
        'name' => 'Aguardando Confirmação de Pagamento',
    ],
    8 => [
        'name' => 'Pagamento Confirmado',
    ]
];
