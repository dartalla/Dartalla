<?php

namespace Business;

return array(
    'controllers' => array(
        'factories' => array(
            'Business\Controller\Index'         => 'Business\Factory\Index',
            'Business\Controller\Sale'          => 'Business\Factory\Sale',
            'Business\Controller\ServiceOrder'  => 'Business\Factory\ServiceOrder',
        )
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'business' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/business',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Business\Controller',
                                'controller' => 'Index',
                                'action' => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'sale' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/sale',
                                    'defaults' => array(
                                        'controller' => 'Business\Controller\Sale',
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
                                    'addproduct' => array(
                                        'type' => 'Literal',
                                        'options' => array(
                                            'route' => '/addproduct',
                                            'defaults' => array(
                                                'action' => 'addproduct',
                                            ),
                                        ),
                                    ),
                                    'listproducts' => array(
                                        'type' => 'Literal',
                                        'options' => array(
                                            'route' => '/listproducts',
                                            'defaults' => array(
                                                'action' => 'listproducts',
                                            ),
                                        ),
                                    ),
                                    'deleteproduct' => array(
                                        'type' => 'Literal',
                                        'options' => array(
                                            'route' => '/deleteproduct',
                                            'defaults' => array(
                                                'action' => 'deleteproduct',
                                            ),
                                        ),
                                    ),
                                    'calculate' => array(
                                        'type' => 'Literal',
                                        'options' => array(
                                            'route' => '/calculate',
                                            'defaults' => array(
                                                'action' => 'calculate',
                                            ),
                                        ),
                                    ),
                                    'updateproduct' => array(
                                        'type' => 'Literal',
                                        'options' => array(
                                            'route' => '/updateproduct',
                                            'defaults' => array(
                                                'action' => 'updateproduct',
                                            ),
                                        ),
                                    ),
                                )
                            ),
                            'service-order' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/service-order',
                                    'defaults' => array(
                                        'controller' => 'Business\Controller\ServiceOrder',
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
            'Business' => __DIR__ . '/../view',
        ),
    ),
    'navigation' => array(
        'admin' => array(
            'admin' => array(
                'label' => 'Home',
                'route' => 'admin',
                'pages' => array(
                    'business' => array(
                        'label' => 'Negócios',
                        'route' => 'admin/business',
                        'pages' => array(
                            'sale' => array(
                                'label' => 'Vendas',
                                'route' => 'admin/business/sale',
                                'pages' => array(
                                    'add' => array(
                                        'label' => 'Adicionar Venda',
                                        'route' => 'admin/business/sale/add',
                                    ),
                                    'edit' => array(
                                        'label' => 'Editar Venda',
                                        'route' => 'admin/business/sale/edit',
                                    ),
                                    'delete' => array(
                                        'label' => 'Apagar Venda',
                                        'route' => 'admin/business/sale/delete',
                                    ),
                                    'view' => array(
                                        'label' => 'Detalhes da Venda',
                                        'route' => 'admin/business/sale/view',
                                    ),
                                ),
                            ),
                            'service-order' => array(
                                'label' => 'Ordens de Serviços',
                                'route' => 'admin/business/service-order',
                                'pages' => array(
                                    'add' => array(
                                        'label' => 'Adicionar Ordem de Serviço',
                                        'route' => 'admin/business/service-order/add',
                                    ),
                                    'edit' => array(
                                        'label' => 'Editar Ordem de Serviço',
                                        'route' => 'admin/business/service-order/edit',
                                    ),
                                    'delete' => array(
                                        'label' => 'Apagar Ordem de Serviço',
                                        'route' => 'admin/business/service-order/delete',
                                    ),
                                    'view' => array(
                                        'label' => 'Detalhes da Ordem de Serviço',
                                        'route' => 'admin/business/service-order/view',
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
