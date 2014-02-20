<?php

namespace Purchase;

return array(
    'controllers' => array(
        'factories' => array(
            'Purchase\Controller\Purchase' => 'Purchase\Factory\Purchase',
        )
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'purchase' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/purchase',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Purchase\Controller',
                                'controller' => 'Purchase',
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
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Purchase' => __DIR__ . '/../view',
        ),
    ),
    'navigation' => array(
        'admin' => array(
            'admin' => array(
                'label' => 'Home',
                'route' => 'admin',
                'pages' => array(
                    'purchase' => array(
                        'label' => 'Compras',
                        'route' => 'admin/purchase',
                        'pages' => array(
                            'add' => array(
                                'label' => 'Adicionar Compra',
                                'route' => 'admin/purchase/add',
                            ),
                            'edit' => array(
                                'label' => 'Editar Compra',
                                'route' => 'admin/purchase/edit',
                            ),
                            'delete' => array(
                                'label' => 'Apagar Compra',
                                'route' => 'admin/purchase/delete',
                            ),
                            'view' => array(
                                'label' => 'Detalhes da Compra',
                                'route' => 'admin/purchase/view',
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
