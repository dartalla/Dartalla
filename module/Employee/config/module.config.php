<?php

namespace Employee;

return array(
    'controllers' => array(
        'factories' => array(
            'Employee\Controller\Employee' => 'Employee\Factory\Employee',
        )
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'employee' => array(
                        'type' => 'Segment',
                        'priority' => 1000,
                        'options' => array(
                            'route' => '/employee[/:page]',
                            'constraints' => array(
                                'page' => '[0-9]*'
                            ),
                            'defaults' => array(
                                'controller' => 'Employee\Controller\Employee',
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
                                        'controller' => 'Employee\Controller\Employee',
                                        'action' => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit/:id',
                                    'constraints' => array(
                                        'employeeId' => '[0-9]*',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Employee\Controller\Employee',
                                        'action' => 'edit',
                                        'id' => 0
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/delete/:id',
                                    'constraints' => array(
                                        'employeeId' => '[0-9]*',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Employee\Controller\Employee',
                                        'action' => 'delete',
                                        'id' => 0
                                    ),
                                ),
                            ),
                            'view' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/view/:id',
                                    'constraints' => array(
                                        'employeeId' => '[0-9]*',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Employee\Controller\Employee',
                                        'action' => 'view',
                                        'id' => 0
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
            'employee' => __DIR__ . '/../view',
        ),
    ),
    'navigation' => array(
        'admin' => array(
            'admin' => array(
                'label' => 'Home',
                'route' => 'admin',
                'pages' => array(
                    'employee' => array(
                        'label' => 'Funcionários',
                        'route' => 'admin/employee',
                        'pages' => array(
                            'add' => array(
                                'label' => 'Novo Funcionário',
                                'route' => 'admin/employee/add',
                            ),
                            'edit' => array(
                                'label' => 'Editar Funcionário',
                                'route' => 'admin/employee/edit',
                            ),
                            'delete' => array(
                                'label' => 'Apagar Funcionário',
                                'route' => 'admin/employee/delete',
                            ),
                            'view' => array(
                                'label' => 'Detalhes do Funcionário',
                                'route' => 'admin/employee/view',
                            ),
                        ),
                    ),
                ),
            )
        )
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
