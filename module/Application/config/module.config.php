<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return [
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
                        'controller' => 'Application\Index',
                        'action'     => 'index',
                    ],
                ],
            ],

            'application' =>
            [
                'type'    => 'literal',
                'options' =>
                [
                    'route'    => '/app',
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
    'service_manager' =>
    [
        'abstract_factories' =>
        [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ],
        'aliases' =>
        [
            'translator' => 'MvcTranslator',
        ],
    ],
    'translator' =>
    [
        'locale' => 'en_US',
        'translation_file_patterns' =>
        [
            [
                'type'     => 'phparray',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.php',
            ],
        ],
    ],
    'controllers' =>
    [
        'invokables' =>
        [
            'Application\Index' => 'Application\Controller\IndexController'
        ],
    ],
    'view_manager' =>
    [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' =>
        [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' =>
        [
            __DIR__ . '/../view',
        ],
    ],
];