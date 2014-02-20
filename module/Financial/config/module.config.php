<?php

namespace Financial;

return array(
    'controllers' => array(
        'factories' => array(
            'Financial\Controller\Index' => 'Financial\Factory\Index',
            'Financial\Controller\Receivable' => 'Financial\Factory\Receivable',
            'Financial\Controller\Payable' => 'Financial\Factory\Payable',
            'Financial\Controller\Revenue' => 'Financial\Factory\Revenue',
            'Financial\Controller\Expense' => 'Financial\Factory\Expense',
            'Financial\Controller\AccountParcel' => 'Financial\Factory\AccountParcel',
            'Financial\Controller\Cash' => 'Financial\Factory\Cash',
        )
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'financial' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/financial',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Financial\Controller',
                                'controller' => 'Index',
                                'action' => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'cash' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/cash',
                                    'defaults' => array(
                                        'controller' => 'Financial\Controller\Cash',
                                        'action' => 'index',
                                    ),
                                ),
                                'may_terminate' => true,
                            ),
                            'account-parcel' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/account-parcel',
                                    'defaults' => array(
                                        'controller' => 'Financial\Controller\AccountParcel',
                                        'action' => 'index',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'create' => array(
                                        'type' => 'Literal',
                                        'options' => array(
                                            'route' => '/create',
                                            'defaults' => array(
                                                'action' => 'create',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                            'receivable' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/receivable',
                                    'defaults' => array(
                                        'controller' => 'Financial\Controller\Receivable',
                                        'action' => 'index',
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
                                    'discharge' => array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => '/discharge/:id',
                                            'constraints' => array(
                                                'id' => '[0-9]*',
                                            ),
                                            'defaults' => array(
                                                'action' => 'discharge',
                                            ),
                                        ),
                                    ),
                                )
                            ),
                            'payable' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/payable',
                                    'defaults' => array(
                                        'controller' => 'Financial\Controller\Payable',
                                        'action' => 'index',
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
                                    'discharge' => array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => '/discharge/:id',
                                            'constraints' => array(
                                                'id' => '[0-9]*',
                                            ),
                                            'defaults' => array(
                                                'action' => 'discharge',
                                            ),
                                        ),
                                    ),
                                )
                            ),
                            'expense' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/expense[/:page]',
                                    'defaults' => array(
                                        'controller' => 'Financial\Controller\Expense',
                                        'constraints' => array(
                                            'page' => '[0-9]*'
                                        ),
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
                                )
                            ),
                            'revenue' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/revenue[/:page]',
                                    'defaults' => array(
                                        'controller' => 'Financial\Controller\Revenue',
                                        'constraints' => array(
                                            'page' => '[0-9]*'
                                        ),
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
                                )
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Financial' => __DIR__ . '/../view',
        ),
    ),
    'navigation' => array(
        'admin' => array(
            'admin' => array(
                'label' => 'Home',
                'route' => 'admin',
                'pages' => array(
                    'financial' => array(
                        'label' => 'Financeiro',
                        'route' => 'admin/financial',
                        'pages' => array(
                            'receivable' => array(
                                'label' => 'Contas a Receber',
                                'route' => 'admin/financial/receivable',
                                'pages' => array(
                                    'add' => array(
                                        'label' => 'Adicionar Conta a Receber',
                                        'route' => 'admin/financial/receivable/add',
                                    ),
                                    'edit' => array(
                                        'label' => 'Editar Conta a Receber',
                                        'route' => 'admin/financial/receivable/edit',
                                    ),
                                    'delete' => array(
                                        'label' => 'Apagar Conta a Receber',
                                        'route' => 'admin/financial/receivable/delete',
                                    ),
                                    'view' => array(
                                        'label' => 'Detalhes da Conta a Receber',
                                        'route' => 'admin/financial/receivable/view',
                                    ),
                                ),
                            ),
                            'payable' => array(
                                'label' => 'Contas a Pagar',
                                'route' => 'admin/financial/payable',
                                'pages' => array(
                                    'add' => array(
                                        'label' => 'Adicionar Conta a Pagar',
                                        'route' => 'admin/financial/payable/add',
                                    ),
                                    'edit' => array(
                                        'label' => 'Editar Conta a Pagar',
                                        'route' => 'admin/financial/payable/edit',
                                    ),
                                    'delete' => array(
                                        'label' => 'Apagar Conta a Pagar',
                                        'route' => 'admin/financial/payable/delete',
                                    ),
                                    'view' => array(
                                        'label' => 'Detalhes da Conta a Pagar',
                                        'route' => 'admin/financial/payable/view',
                                    ),
                                ),
                            ),
                            'revenue' => array(
                                'label' => 'Receitas',
                                'route' => 'admin/financial/revenue',
                                'pages' => array(
                                    'add' => array(
                                        'label' => 'Adicionar Receita',
                                        'route' => 'admin/financial/revenue/add',
                                    ),
                                    'edit' => array(
                                        'label' => 'Editar Receita',
                                        'route' => 'admin/financial/revenue/edit',
                                    ),
                                    'delete' => array(
                                        'label' => 'Apagar Receita',
                                        'route' => 'admin/financial/revenue/delete',
                                    ),
                                    'view' => array(
                                        'label' => 'Detalhes da Receita',
                                        'route' => 'admin/financial/revenue/view',
                                    ),
                                ),
                            ),
                            'expense' => array(
                                'label' => 'Despesas',
                                'route' => 'admin/financial/expense',
                                'pages' => array(
                                    'add' => array(
                                        'label' => 'Adicionar Despesa',
                                        'route' => 'admin/financial/expense/add',
                                    ),
                                    'edit' => array(
                                        'label' => 'Editar Despesa',
                                        'route' => 'admin/financial/expense/edit',
                                    ),
                                    'delete' => array(
                                        'label' => 'Apagar Despesa',
                                        'route' => 'admin/financial/expense/delete',
                                    ),
                                    'view' => array(
                                        'label' => 'Detalhes da Despesa',
                                        'route' => 'admin/financial/expense/view',
                                    ),
                                ),
                            ),
                            'cash' => array(
                                'label' => 'Caixa',
                                'route' => 'admin/financial/cash',
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
