<?php
return [
    // Uncomment the following to enable browser-based diagnostics
    'router' =>
    [
        'routes' =>
        [
            'zftool-diagnostics' =>
            [
                'type'  => 'literal',
                'options' =>
                [
                    'route' => '/diagnostics',
                    'defaults' =>
                    [
                        'controller' => 'ZFTool\Controller\Diagnostics',
                        'action'     => 'run'
                    ]
                ]
            ]
        ]
    ],
];