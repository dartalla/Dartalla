<?php

namespace User\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use ZfcUser\Entity\User as UserEntity;

class User extends ZendFielset implements InputFilterProviderInterface {

    public function __construct() {
        parent::__construct('user');
        
        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new UserEntity());

        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'username',
            'attributes' => array (
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'label' => 'Usuário'
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Password',
            'name' => 'password',
            'attributes' => array(
                'class' => 'form-control input-sm'
            ),
            'options' => array(
                'label' => 'Senha'
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array();
    }
}
