<?php

namespace Customer;

return array(
    'controllers' => array(
        'factories' => array(
            'Customer\Controller\Customer' => 'Customer\Factory\Customer',
            'Customer\Controller\CustomerBankAccount' => 'Customer\Factory\CustomerBankAccount',
            'Customer\Controller\CustomerPatrimony' => 'Customer\Factory\CustomerPatrimony',
            'Customer\Controller\CustomerReference' => 'Customer\Factory\CustomerReference',
        )
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'customer' => array(
                        'type' => 'Segment',
                        'priority' => 1000,
                        'options' => array(
                            'route' => '/customer[/:page]',
                            'constraints' => array(
                                'page' => '[0-9]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Customer\Controller',
                                'controller' => 'Customer',
                                'action' => 'index',
                                'page' => 1
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'add' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/add/:type',
                                    'constraints' => array(
                                        'type' => '[' . base64_encode(0) . base64_encode(1) . ']*',
                                    ),
                                    'defaults' => array(
                                        'action' => 'add',
                                        'type' => 'MA=='
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit/:id/:type',
                                    'constraints' => array(
                                        'id' => '[0-9]*',
                                        'type' => '[' . base64_encode(0) . base64_encode(1) . ']*',
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
                            'customer-bank-account' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/customer-bank-account',
                                    'defaults' => array(
                                        '__NAMESPACE__' => 'Customer\Controller',
                                        'controller' => 'CustomerBankAccount',
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
                            'customer-patrimony' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/customer-patrimony',
                                    'defaults' => array(
                                        '__NAMESPACE__' => 'Customer\Controller',
                                        'controller' => 'CustomerPatrimony',
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
                            'customer-reference' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/customer-reference',
                                    'defaults' => array(
                                        '__NAMESPACE__' => 'Customer\Controller',
                                        'controller' => 'CustomerReference',
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
                                                'type' => '[' . base64_encode(0) . base64_encode(1) . ']*',
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
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Customer' => __DIR__ . '/../view',
        ),
    ),
    'navigation' => array(
        'admin' => array(
            'admin' => array(
                'label' => 'Home',
                'route' => 'admin',
                'pages' => array(
                    'customer' => array(
                        'label' => 'Clientes',
                        'route' => 'admin/customer',
                        'pages' => array(
                            'add' => array(
                                'label' => 'Novo Cliente',
                                'route' => 'admin/customer/add',
                            ),
                            'edit' => array(
                                'label' => 'Editar Cliente',
                                'route' => 'admin/customer/edit',
                            ),
                            'delete' => array(
                                'label' => 'Apagar Cliente',
                                'route' => 'admin/customer/delete',
                            ),
                            'view' => array(
                                'label' => 'Detalhes do Cliente',
                                'route' => 'admin/customer/view',
                            ),
                            'customer-bank-account' => array(
                                'label' => 'Conta do Cliente',
                                'route' => 'admin/customer/customer-bank-account',
                                'pages' => array(
                                    'add' => array(
                                        'label' => 'Nova Conta',
                                        'route' => 'admin/customer/customer-bank-account/add',
                                    ),
                                ),
                            ),
                            'customer-patrimony' => array(
                                'label' => 'Patrimônio',
                                'route' => 'admin/customer/customer-patrimony',
                                'pages' => array(
                                    'add' => array(
                                        'label' => 'Novo Bem',
                                        'route' => 'admin/customer/customer-patrimony/add',
                                    ),
                                ),
                            ),
                            'customer-reference' => array(
                                'label' => 'Referências',
                                'route' => 'admin/customer/customer-reference',
                                'pages' => array(
                                    'add' => array(
                                        'label' => 'Nova Referência',
                                        'route' => 'admin/customer/customer-reference/add',
                                    ),
                                ),
                            ),
                            'customer-sponsor' => array(
                                'label' => 'Referências',
                                'route' => 'admin/customer/customer-sponsor',
                                'pages' => array(
                                    'add' => array(
                                        'label' => 'Nova Referência',
                                        'route' => 'admin/customer/customer-sponsor/add',
                                    ),
                                ),
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
