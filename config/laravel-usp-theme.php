
<?php

$submenu1 =  [
    [
        'text' => '<i class="fas fa-plus-square"></i> Agendar Defesa',
        'url'  => '/agendamentos/create',
    ],
    [
        'text' => '<i class="fas fa-list-alt"></i> Listar Agendamentos',
        'url'  => '/agendamentos',
    ],
    [
        'text' => '<i class="fas fa-search"></i> Pendência de sala virtual',
        'url' => '/pendencia_sala_virtual'
    ],
];

$submenu3 =  [
    [
        'text' => '<i class="fas fa-forward"></i> Listar Próximas Defesas',
        'url'  => '/',
    ],
    [
        'text' => '<i class="fas fa-certificate"></i> Listar Defesas Anteriores',
        'url'  => '/anteriores',
    ],
];

$submenu4 =  [
    [
        'text' => 'Defesas defendidas',
        'url'  => '/comunicacao',
    ]
];

$dev =  [
    [
        'text' => '<i class="fas fa-plus-square"></i> Bancas Aprovadas',
        'url'  => '/dev/bancas_aprovadas',
    ],
];

$biblioteca =  [
    [
        'text' => '<i class="fas fa-plus-square"></i> Defesas a serem Publicadas',
        'url'  => '/teses',
    ],
    [
        'text' => '<i class="fas fa-plus-square"></i> Defesas Publicadas',
        'url'  => '/teses/publicadas',
    ],
];

$right_menu = [
    [
        'key' => 'senhaunica-socialite',
    ],
    [
        'text' => '<i class="fas fa-cog"></i>',
        'title' => 'Configurações',
        'target' => '_blank',
        'url' => config('app.url') . '/configs',
        'align' => 'right',
        'can'   => 'admin'
    ],
    [
        'text' => '<i class="fas fa-hard-hat"></i>',
        'title' => 'logs',
        'target' => '_blank',
        'url' => config('app.url') . '/logs',
        'align' => 'right',
        'can'   => 'admin'
    ],
];

return [
    'title' => config('app.name'),
    'skin' => env('USP_THEME_SKIN', 'uspdev'),
    'app_url' => config('app.url'),
    'logout_method' => 'POST',
    'logout_url' => config('app.url') . '/logout',
    'login_url' => config('app.url') . '/login',
    'menu' => [
        [
            'text'    => '<i class="fas fa-graduation-cap"></i> Defesas',
            'submenu' => $submenu3,
        ],
        [
            'text'    => '<i class="fas fa-calendar-alt"></i> Agendamentos',
            'submenu' => $submenu1,
            'can' => 'admin',
        ],
        [
            'text'    => '<i class="fas fa-file-export"></i> Publicação',
            'submenu' => $biblioteca,
            'can' => 'biblioteca',
        ],
        [
            'text' => '<i class="fas fa-bullhorn"></i> Comunicação',
            'submenu' => $submenu4,
            'can' => 'comunicacao'
        ],
    ],
    'right_menu' => $right_menu,
];
