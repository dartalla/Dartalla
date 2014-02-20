<?php

/**
 * ZfcRbac Configuration
 *
 * If you have a ./config/autoload/ directory set up for your project, you can
 * drop this config file in it and change the values as you wish.
 */
$settings = array(
    /**
     * The default role that is used if no role is found from the
     * role provider.
     */
    'anonymousRole' => 'anonymous',
    /**
     * Flag: enable or disable the routing firewall.
     */
    'firewallRoute' => false,
    /**
     * Flag: enable or disable the controller firewall.
     */
    'firewallController' => false,
    /**
     * Set the view template to use on a 403 error.
     */
    'template' => 'error/403',
    /**
     * flag: enable or disable the use of lazy-loading providers.
     */
    'enableLazyProviders' => true,
    'firewalls' => array(
        'ZfcRbac\Firewall\Route' => array(
            array('route' => 'index', 'roles' => 'guest'),
            array('route' => 'admin', 'roles' => 'admin'),
        ),
        'ZfcRbac\Firewall\Controller' => array(
            array('controller' => 'index', 'actions' => 'index', 'roles' => 'guest'),
        ),
    ),
    'providers' => array(
        'ZfcRbac\Provider\AdjacencyList\Role\DoctrineDbal' => array(
            'connection' => 'doctrine.connection.orm_default',
            'options' => array(
                'table' => 'rbac_role',
                'id_column' => 'role_id',
                'name_column' => 'role_name',
                'join_column' => 'parent_role_id'
            )
        ),
        'ZfcRbac\Provider\Generic\Permission\DoctrineDbal' => array(
            'connection' => 'doctrine.connection.orm_default',
            'options' => array(
                'permission_table' => 'rbac_permission',
                'role_table' => 'rbac_role',
                'role_join_table' => 'rbac_role_permission',
                'permission_id_column' => 'perm_id',
                'permission_join_column' => 'perm_id',
                'role_id_column' => 'role_id',
                'role_join_column' => 'role_id',
                'permission_name_column' => 'perm_name',
                'role_name_column' => 'role_name'
            )
        ),
    ),
    /**
     * Set the identity provider to use. The identity provider must be retrievable from the
     * service locator and must implement \ZfcRbac\Identity\IdentityInterface.
     */
    'identity_provider' => 'standard_identity'
);

$serviceManager = array(
    'factories' => array(
        'standard_identity' => function ($sm) {
            $roles = array('guest', 'user', 'admin');
            $identity = new \ZfcRbac\Identity\StandardIdentity($roles);
            return $identity;
        },
    )
);

/**
 * You do not need to edit below this line
 */
return array(
    'zfcrbac' => $settings,
    'service_manager' => $serviceManager,
);
