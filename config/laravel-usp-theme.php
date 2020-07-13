
<?php

$submenu1 =  [
    [
        'text' => 'Agendar Defesa',
        'url'  => '/agendamentos/create',
    ],
    [
        'text' => 'Listar Defesas',
        'url'  => '/agendamentos',
    ],
];

return [
    'title'=> 'DEFESAS',
    'dashboard_url' => '/',
    'logout_method' => 'GET',
    'logout_url' => '/logout',
    'login_url' => '/login',
    'menu' => [
        [
            'text'    => 'Agendamentos de Defesas',
            'submenu' => $submenu1,
        ], 
    ],
];
