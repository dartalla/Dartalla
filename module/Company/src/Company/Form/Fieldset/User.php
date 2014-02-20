<?php

namespace Company\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;

class User extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {

        parent::__construct('user');
        
        $this->setHydrator(new DoctrineHydrator($entityManager, 'User\Entity\User', true))
                ->setObject(new \User\Entity\User());
        
        $this->add(array(
            'name' => 'userId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name' => 'username',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Usuário',
                'class' => 'form-control input-sm'
            ),
            'options' => array(
                'label' => 'Usuário'
            )
        ));
        
        $this->add(array(
            'name' => 'password',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'placeholder' => 'Senha',
                'class' => 'form-control input-sm'
            ),
            'options' => array(
                'label' => 'Senha'
            )
        ));
        
        $this->add(array(
            'name' => 'roles',
            'type' => 'DoctrineORMModule\Form\Element\EntityRadio',
            'attributes' => array(
                'class' => 'form-control input-sm'
            ),
            'options' => array(
                'label' => 'Permissão',
                'empty_option' => 'Permissão',
                'object_manager' => $entityManager,
                'target_class' => 'User\Entity\Role',
                'property' => 'roleId',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy' => array('roleId' => 'ASC')
                    )
                )
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'roles' => array(
                'required' => false
            ),
            'username' => array(
                'required' => false,
                'validators' => array(
                    new \Zend\Validator\StringLength(array(
                        'min' => 6,
                        'max' => 255
                    )),
                ),
            ),
        );
    }
}
