<?php

namespace Event;

use Event\Factory\EventControllerFactory;
use Event\Factory\EventRepositoryFactory;
use Event\Factory\EventTableGatewayFactory;
use Zend\Router\Http\Segment;
use Zend\Router\Http\Literal;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => Controller\EventController::class,
                        'action'     => 'current'
                    ]
                ]
            ],
            'event' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/event[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => Controller\EventController::class,
                        'action'     => 'index'
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\EventController::class => EventControllerFactory::class
        ]
    ],
    'service_manager' => [
        'factories' => [
            Repository\EventRepository::class   => EventRepositoryFactory::class,
            'Model\EventTableGateway'           => EventTableGatewayFactory::class
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ]
    ],
];