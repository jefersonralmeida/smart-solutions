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
        'name' => 'Pedido em Planejamento',
    ],
    4 => [
        'name' => 'SETUP VIRTUAL disponível para aprovação',
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
    ],
    9 => [
        'name' => 'Documentação em análise técnica',
    ],
    10 => [
        'name' => 'Documentação com problema / incompleta',
    ],
    11 => [
        'name' => 'Alteração Solicitada',
    ],
    12 => [
        'name' => 'Em produção',
    ],
    13 => [
        'name' => 'Preparando envio',
    ],
    14 => [
        'name' => 'Pedido enviado',
    ],
    15 => [
        'name' => 'Pedido em cancelamento',
        'next' => [
            'label' => 'Processar novamente o cancelamento',
            'route' => ['orders.forceCancel', ['id']],
        ]
    ],
    16 => [
        'name' => 'Pedido cancelado - Aguardando Pagamento de Multa',
        'next' => [
            'label' => 'Realizar Pagamento',
            'route' => ['orders.cancel.penalty', ['id']],
        ]
    ],
    17 => [
        'name' => 'Pedido cancelado'
    ]

];
