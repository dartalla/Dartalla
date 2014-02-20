<?php

namespace Avr;

return array(
    'controllers' => array(
        'invokables' => array(
            'Avr\Controller\Avr' => 'Avr\Controller\AvrController'
        ),
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'child_routes' => array(
                    'avr' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/avr',
                            'defaults' => array(
                                '__NAMESPACE__' => 'Avr\Controller',
                                'controller' => 'Avr',
                                'action' => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'price' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/price',
                                    'defaults' => array(
                                        'action' => 'price',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'validators' => array(
        'invokables' => array(
            'Cnpj' => 'Avr\Validator\Cnpj',
            'Cpf' => 'Avr\Validator\Cpf',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'phone' => 'Avr\View\Helper\Phone',
            'cep' => 'Avr\View\Helper\Cep',
            'currency' => 'Avr\View\Helper\Currency',
            'porcent' => 'Avr\View\Helper\Porcent',
            'date' => 'Avr\View\Helper\Date',
            'cpf' => 'Avr\View\Helper\Cpf',
            'cnpj' => 'Avr\View\Helper\Cnpj',
            'gender' => 'Avr\View\Helper\Gender',
            'birthday' => 'Avr\View\Helper\Birthday',
            'deleteModal' => 'Avr\View\Helper\DeleteModal',
            'avrCollection' => 'Avr\Form\Helper\Collection',
            'avrFormRow' => 'Avr\Form\Helper\AvrFormRow',
            'avrFormDate' => 'Avr\Form\Helper\AvrFormDate',
            'info' => 'Avr\View\Helper\Message\Info',
            'warning' => 'Avr\View\Helper\Message\Warning',
            'error' => 'Avr\View\Helper\Message\Error',
            'success' => 'Avr\View\Helper\Message\Success',
            'block' => 'Avr\View\Helper\Message\Block',
            'dump' => 'Avr\View\Helper\Dump',
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Avr' => __DIR__ . '/../view',
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
        ),
        'configuration' => array(
            'orm_default' => array(
                'types' => array(
                    'datebr' => 'Avr\Doctrine\Type\DateBr'
                )
            )
        ),
    ),
);
