<?php

namespace Admin;

return array(
    'controllers' => array(
        'factories' => array(
            'Admin\Controller\Index' => 'Admin\Factory\Index',
        )
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'loadbanks' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/loadbanks',
                            'defaults' => array(
                                'action' => 'loadbanks'
                            )
                        )
                    ),
                    'loadlocations' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/loadlocations',
                            'defaults' => array(
                                'action' => 'loadlocations'
                            )
                        )
                    ),
                    'migratepersons' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migratepersons',
                            'defaults' => array(
                                'action' => 'migratepersons'
                            )
                        )
                    ),
                    'migratecustomers' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migratecustomers',
                            'defaults' => array(
                                'action' => 'migratecustomers'
                            )
                        )
                    ),
                    'updatecustomers' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/updatecustomers',
                            'defaults' => array(
                                'action' => 'updatecustomers'
                            )
                        )
                    ),
                    'migratecustomersaddons' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migratecustomersaddons',
                            'defaults' => array(
                                'action' => 'migratecustomersaddons'
                            )
                        )
                    ),
                    'migrateemployees' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migrateemployees',
                            'defaults' => array(
                                'action' => 'migrateemployees'
                            )
                        )
                    ),
                    'migratecustomerpatrimonies' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migratecustomerpatrimonies',
                            'defaults' => array(
                                'action' => 'migratecustomerpatrimonies'
                            )
                        )
                    ),
                    'migrateprofessionals' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migrateprofessionals',
                            'defaults' => array(
                                'action' => 'migrateprofessionals'
                            )
                        )
                    ),
                    'migratecustomersaccounts' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migratecustomersaccounts',
                            'defaults' => array(
                                'action' => 'migratecustomersaccounts'
                            )
                        )
                    ),
                    'migratereferences' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migratereferences',
                            'defaults' => array(
                                'action' => 'migratereferences'
                            )
                        )
                    ),
                    'migrateshopman' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migrateshopman',
                            'defaults' => array(
                                'action' => 'migrateshopman'
                            )
                        )
                    ),
                    'migrateseller' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migrateseller',
                            'defaults' => array(
                                'action' => 'migrateseller'
                            )
                        )
                    ),
                    'migrateshopmanproducts' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migrateshopmanproducts',
                            'defaults' => array(
                                'action' => 'migrateshopmanproducts'
                            )
                        )
                    ),
                    'migratespouses' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migratespouses',
                            'defaults' => array(
                                'action' => 'migratespouses'
                            )
                        )
                    ),
                    'migrateusers' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migrateusers',
                            'defaults' => array(
                                'action' => 'migrateusers'
                            )
                        )
                    ),
                    'migrateproposals' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migrateproposals',
                            'defaults' => array(
                                'action' => 'migrateproposals'
                            )
                        )
                    ),
                    'migratebankreports' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migratebankreports',
                            'defaults' => array(
                                'action' => 'migratebankreports'
                            )
                        )
                    ),
                    'migrateproposallogs' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migrateproposallogs',
                            'defaults' => array(
                                'action' => 'migrateproposallogs'
                            )
                        )
                    ),
                    'migratevehicles' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migratevehicles',
                            'defaults' => array(
                                'action' => 'migratevehicles'
                            )
                        )
                    ),
                    'migratecustomervehicles' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migratecustomervehicles',
                            'defaults' => array(
                                'action' => 'migratecustomervehicles'
                            )
                        )
                    ),
                    'migratepaymenttype' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migratepaymenttype',
                            'defaults' => array(
                                'action' => 'migratepaymenttype'
                            )
                        )
                    ),
                    'migratecurrentaccount' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migratecurrentaccount',
                            'defaults' => array(
                                'action' => 'migratecurrentaccount'
                            )
                        )
                    ),
                    'migrateaccountingitem' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/migrateaccountingitem',
                            'defaults' => array(
                                'action' => 'migrateaccountingitem'
                            )
                        )
                    ),
                    'update' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/update',
                            'defaults' => array(
                                'action' => 'update'
                            )
                        )
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Admin' => __DIR__ . '/../view',
        ),
    ),
    'admin' => array(
        'use_admin_layout' => true,
        'admin_layout_template' => 'layout/admin',
    ),
    'module_layouts' => array(
        'Admin' => 'layout/admin.phtml',
    ),
    'navigation' => array(
        'admin' => array()
    ),
);
