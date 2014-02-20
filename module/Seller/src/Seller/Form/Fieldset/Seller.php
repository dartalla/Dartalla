<?php

namespace Seller\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Seller\Entity\Seller as SellerEntity;

class Seller extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('seller');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new SellerEntity());

        $this->add(array(
            'name' => 'sellerId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $person = new \Person\Form\Fieldset\Person($entityManager);
        $person->setName('person')
                ->setLabel('Dados Gerais');
        $this->add($person);
    }
    
    public function getInputFilterSpecification() {
        return array(
            'sellerId' => array(
                'required' => false,
            ),
        );
    }
}
