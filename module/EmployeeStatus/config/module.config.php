<?php

namespace EmployeeStatus;

return array(
    'controllers' => array(
        'factories' => array(
            'EmployeeStatus\Controller\EmployeeStatus' => 'EmployeeStatus\Factory\EmployeeStatus',
        )
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'employee-status' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/employee-status[/:page]',
                            'constraints' => array(
                                'page' => '[0-9]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'EmployeeStatus\Controller',
                                'controller' => 'EmployeeStatus',
                                'action' => 'index',
                                'page' => 1
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'add' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/add',
                                    'defaults' => array(
                                        'action' => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit/:id',
                                    'constraints' => array(
                                        'id' => '[0-9]*',
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
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'EmployeeStatus' => __DIR__ . '/../view',
        ),
    ),
    'navigation' => array(
        'admin' => array(
            'admin' => array(
                'label' => 'Home',
                'route' => 'admin',
                'pages' => array(
                    'employee-status' => array(
                        'label' => 'Situações do Funcionário',
                        'route' => 'admin/employee-status',
                        'pages' => array(
                            'add' => array(
                                'label' => 'Nova Situação do Funcionário',
                                'route' => 'admin/employee-status/add'
                            ),
                            'edit' => array(
                                'label' => 'Editar Situação do Funcionário',
                                'route' => 'admin/employee-status/edit'
                            ),
                            'delete' => array(
                                'label' => 'Apagar Situação do Funcionário',
                                'route' => 'admin/employee-status/delete'
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
