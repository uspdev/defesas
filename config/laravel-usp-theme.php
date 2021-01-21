
<?php

$submenu1 =  [
    [
        'text' => '<i class="fas fa-plus-square"></i> Agendar Defesa',
        'url'  => '/agendamentos/create',
    ],
    [
        'text' => '<i class="fas fa-list-alt"></i> Listar Defesas',
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

return [
    'title'=> 'DEFESAS',
    'dashboard_url' => config('app.url'),
    'logout_method' => 'GET',
    'logout_url' => '/logout',
    'login_url' => '/login',
    'menu' => [
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
    ],
    'right_menu' => [
        [
            'text' => '<i class="fas fa-cog"></i>',
            'title' => 'Configurações',
            'url' => config('app.url') . '/configs',
            'can' => 'admin',
        ],
    ],
];
