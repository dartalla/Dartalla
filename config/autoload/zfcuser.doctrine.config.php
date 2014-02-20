<?php

return array(
    'zfcuser' => array(
        'user_entity_class'       => 'User\Entity\User',
        'enable_default_entities' => false,
    ),
    'factories' => array(
        'zfcuser_user_mapper' => function ($sm) {
            return new \ZfcUserDoctrineORM\Mapper\User(
                    $sm->get('doctrine.entitymanager.orm_default'), 
                    $sm->get('zfcuser_module_options')
            );
        },
    ),
    'bjyauthorize' => array(
        // Using the authentication identity provider, which basically reads the roles from the auth service's identity
        'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',

        'role_providers'        => array(
            // using an object repository (entity repository) to load all roles into our ACL
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
                'object_manager'    => 'doctrine.entitymanager.orm_default',
                'role_entity_class' => 'User\Entity\Role',
             ),
        ),
    ),
);
