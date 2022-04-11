
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
];

$submenu2 =  [
    [
        'text' => '<i class="fas fa-plus-square"></i> Cadastrar Docente',
        'url'  => '/docentes/create',
    ],
    [
        'text' => '<i class="fas fa-list-alt"></i> Listar Docentes',
        'url'  => '/docentes',
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
        'text'   => '<i class="fas fa-users"></i>',
        'title'  => 'Pessoas',
        'target' => '_blank',
        'url'    => config('app.url') . '/users',
        'align'  => 'right',
        'can'    => 'admin',
    ],
    [
        'text'   => '<i class="fas fa-user-secret"></i>',
        'title'  => 'Login As',
        'target' => '_blank',
        'url'    => config('app.url') . '/loginas',
        'align'  => 'right',
        'can'    => 'admin',
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
            'text'    => '<i class="fas fa-chalkboard-teacher"></i> Docentes',
            'submenu' => $submenu2,
            'can' => 'admin',
        ],
        [
            'text'    => '<i class="fas fa-chalkboard-teacher"></i> Em desenvolvimento',
            'submenu' => $dev,
            'can' => 'admin',
        ],
        [
            'text'    => '<i class="fas fa-file-export"></i> Publicação',
            'submenu' => $biblioteca,
            'can' => 'biblioteca',
        ],
    ],
    'right_menu' => $right_menu,
];
