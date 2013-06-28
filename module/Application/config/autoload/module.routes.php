<?php
/**
 * ZF2 MVC Routing & Controller Configuration.
 *
 * Also defines the controllers to easily reference
 * them when defining new routes.
 *
 * See the link below for more info:
 * @link http://zf2.readthedocs.org/en/latest/modules/zend.mvc.routing.html
 */
return [
    'controllers' =>
    [
        'invokables' =>
        [
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ],
    ],
    'router' =>
    [
        'routes' =>
        [
            'home' =>
            [
                'type' => 'literal',
                'options' =>
                [
                    'route'    => '/',
                    'defaults' =>
                    [
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ],
                ],
            ],

            'application' =>
            [
                'type'    => 'literal',
                'options' =>
                [
                    'route'    => '/application',
                    'defaults' =>
                    [
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' =>
                [
                    'default' =>
                    [
                        'type'    => 'segment',
                        'options' =>
                        [
                            'route'    => '/[:controller[/:action]]',
                            'constraints' =>
                            [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' =>
                            [
                                //
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];