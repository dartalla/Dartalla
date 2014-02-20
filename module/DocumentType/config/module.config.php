<?php

namespace DocumentType;

return array(
    'controllers' => array(
        'factories' => array(
            'DocumentType\Controller\DocumentType' => 'DocumentType\Factory\DocumentType',
        )
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'document-type' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/document-type[/:page]',
                            'constraints' => array(
                                'page' => '[0-9]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'DocumentType\Controller',
                                'controller' => 'DocumentType',
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
            'DocumentType' => __DIR__ . '/../view',
        ),
    ),
    'navigation' => array(
        'admin' => array(
            'admin' => array(
                'label' => 'Home',
                'route' => 'admin',
                'pages' => array(
                    'document-type' => array(
                        'label' => 'Tipos de Documentos',
                        'route' => 'admin/document-type',
                        'pages' => array(
                            'add' => array(
                                'label' => 'Novo Tipo de Documento',
                                'route' => 'admin/document-type/add'
                            ),
                            'edit' => array(
                                'label' => 'Editar Tipo de Documento',
                                'route' => 'admin/document-type/edit'
                            ),
                            'delete' => array(
                                'label' => 'Apagar Tipo de Documento',
                                'route' => 'admin/document-type/delete'
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
