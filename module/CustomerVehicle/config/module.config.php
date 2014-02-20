<?php

namespace CustomerVehicle;

return array(
    'controllers' => array(
        'factories' => array(
            'CustomerVehicle\Controller\CustomerVehicle' => 'CustomerVehicle\Factory\CustomerVehicle',
        )
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'customer-vehicle' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/customer-vehicle',
                            'defaults' => array(
                                '__NAMESPACE__' => 'CustomerVehicle\Controller',
                                'controller' => 'CustomerVehicle',
                                'action' => 'index'
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'add' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/add/:id',
                                    'constraints' => array(
                                        'id' => '[0-9]*',
                                    ),
                                    'defaults' => array(
                                        'action' => 'add',
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
            'CustomerVehicle' => __DIR__ . '/../view',
        ),
    ),
    'navigation' => array(
        'admin' => array(
            'admin' => array(
                'label' => 'Cliente',
                'route' => 'admin/customer',
                'pages' => array(
                    'customer-vehicle' => array(
                        'label' => 'Veículos do Cliente',
                        'route' => 'admin/customer-vehicle',
                        'pages' => array(
                            'add' => array(
                                'label' => 'Novo Veículo',
                                'route' => 'admin/customer-vehicle/add',
                            ),
                            'edit' => array(
                                'label' => 'Editar Veículo',
                                'route' => 'admin/customer-vehicle/edit',
                            ),
                            'delete' => array(
                                'label' => 'Apagar Veículo',
                                'route' => 'admin/customer-vehicle/delete',
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
