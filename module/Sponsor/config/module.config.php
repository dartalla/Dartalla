<?php

namespace Sponsor;

return array(
    'controllers' => array(
        'factories' => array(
            'Sponsor\Controller\Sponsor' => 'Sponsor\Factory\Sponsor',
        )
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'sponsor' => array(
                        'type' => 'Segment',
                        'priority' => 1000,
                        'options' => array(
                            'route' => '/sponsor[/:page]',
                            'constraints' => array(
                                'page' => '[0-9]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Sponsor\Controller',
                                'controller' => 'Sponsor',
                                'action' => 'index',
                                'page' => 1
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'add' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/add/:type/:id',
                                    'constraints' => array(
                                        'type' => '['.base64_encode(0).base64_encode(1).']*',
                                        'id' => '[0-9]*'
                                    ),
                                    'defaults' => array(
                                        'action' => 'add',
                                        'type' => 'MA==',
                                        'id' => 1,
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit/:id/:type',
                                    'constraints' => array(
                                        'id' => '[0-9]*',
                                        'type' => '['.base64_encode(0).base64_encode(1).']*',
                                    ),
                                    'defaults' => array(
                                        'action' => 'edit',
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/delete/:id',
                                    'constraints' => array(
                                        'id' => '[0-9]*',
                                    ),
                                    'defaults' => array(
                                        'action' => 'delete',
                                    ),
                                ),
                            ),
                            'view' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/view/:id',
                                    'constraints' => array(
                                        'id' => '[0-9]*',
                                    ),
                                    'defaults' => array(
                                        'action' => 'view',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Sponsor' => __DIR__ . '/../view',
        ),
    ),
    'navigation' => array(
        'admin' => array(
            'admin' => array(
                'label' => 'Home',
                'route' => 'admin',
                'pages' => array(
                    'sponsor' => array(
                        'label' => 'Avalista / Cônjuges',
                        'route' => 'admin/sponsor',
                        'pages' => array(
                            'add' => array(
                                'label' => 'Novo Avalista / Cônjuge',
                                'route' => 'admin/sponsor/add',
                            ),
                            'edit' => array(
                                'label' => 'Editar Avalista / Cônjuge',
                                'route' => 'admin/sponsor/edit',
                            ),
                            'delete' => array(
                                'label' => 'Apagar Avalista / Cônjuge',
                                'route' => 'admin/sponsor/delete',
                            ),
                            'view' => array(
                                'label' => 'Detalhes do Avalista / Cônjuge',
                                'route' => 'admin/sponsor/view',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    )
);
