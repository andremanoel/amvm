<?php

namespace Gestor;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            Controller\GestorController::class => InvokableFactory::class,
            Controller\ImportacaoController::class => InvokableFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'gestor' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/gestor[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\GestorController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'importacao' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/importacao[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ImportacaoController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
];