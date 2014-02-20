<?php

namespace Category;

return array(
    'controllers' => array(
        'factories' => array(
            'Category\Controller\Category'      => 'Category\Factory\Category',
        )
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'category' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/category[/:page]',
                            'constraints' => array(
                                'page' => '[0-9]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Category\Controller',
                                'controller' => 'Category',
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
            'Category' => __DIR__ . '/../view',
        ),
    ),
    'navigation' => array(
        'admin' => array(
            'admin' => array(
                'label' => 'Home',
                'route' => 'admin',
                'pages' => array(
                    'category' => array(
                        'label' => 'Categorias',
                        'route' => 'admin/category',
                        'pages' => array(
                            'add' => array(
                                'label' => 'Novo Categoria',
                                'route' => 'admin/category/add'
                            ),
                            'edit' => array(
                                'label' => 'Editar Categoria',
                                'route' => 'admin/category/edit'
                            ),
                            'delete' => array(
                                'label' => 'Apagar Categoria',
                                'route' => 'admin/category/delete'
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
