<?php

namespace CustomerSponsor;

return array(
    'controllers' => array(
        'factories' => array(
            'CustomerSponsor\Controller\CustomerSponsor' => 'CustomerSponsor\Factory\CustomerSponsor',
        )
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'customer-sponsor' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/customer-sponsor',
                            'defaults' => array(
                                '__NAMESPACE__' => 'CustomerSponsor\Controller',
                                'controller' => 'CustomerSponsor',
                                'action' => 'index'
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'add' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/add/:id/:type',
                                    'constraints' => array(
                                        'type' => '['.base64_encode(0).base64_encode(1).']*',
                                        'id' => '[0-9]*',
                                    ),
                                    'defaults' => array(
                                        'action' => 'add',
                                        'type' => 'MA==',
                                        'id' => 1
                                    ),
                                ),
                            ),
                            'list' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/list/:id',
                                    'constraints' => array(
                                        'id' => '[0-9]*',
                                    ),
                                    'defaults' => array(
                                        'action' => 'list',
                                        'id' => 1
                                    ),
                                ),
                            ),
                            'post' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/post',
                                    'defaults' => array(
                                        'action' => 'post',
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/delete',
                                    'defaults' => array(
                                        'action' => 'delete',
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
            'CustomerSponsor' => __DIR__ . '/../view',
        ),
    ),
    'navigation' => array(
        'admin' => array(
            'admin' => array(
                'label' => 'Home',
                'route' => 'admin',
                'pages' => array(
                    'customer-sponsor' => array(
                        'label' => 'Referências',
                        'route' => 'admin/customer-sponsor',
                        'pages' => array(
                            'add' => array(
                                'label' => 'Nova Referência',
                                'route' => 'admin/customer-sponsor/add',
                            ),
                            'delete' => array(
                                'label' => 'Apagar Referência',
                                'route' => 'admin/customer-sponsor/delete',
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
