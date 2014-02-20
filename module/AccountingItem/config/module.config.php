<?php

namespace AccountingItem;

return array(
    'controllers' => array(
        'factories' => array(
            'AccountingItem\Controller\AccountingItem' => 'AccountingItem\Factory\AccountingItem',
        )
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'accounting-item' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/accounting-item[/:page]',
                            'constraints' => array(
                                'page' => '[0-9]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'AccountingItem\Controller',
                                'controller' => 'AccountingItem',
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
            'AccountingItem' => __DIR__ . '/../view',
        ),
    ),
    'navigation' => array(
        'admin' => array(
            'admin' => array(
                'label' => 'Home',
                'route' => 'admin',
                'pages' => array(
                    'accounting-item' => array(
                        'label' => 'Item Contábil',
                        'route' => 'admin/accounting-item',
                        'pages' => array(
                            'add' => array(
                                'label' => 'Novo Item Contábil',
                                'route' => 'admin/accounting-item/add'
                            ),
                            'edit' => array(
                                'label' => 'Editar Item Contábil',
                                'route' => 'admin/accounting-item/edit'
                            ),
                            'delete' => array(
                                'label' => 'Apagar Item Contábil',
                                'route' => 'admin/accounting-item/delete'
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
