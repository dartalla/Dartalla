<?php

namespace Supplier\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Supplier\Entity\Supplier as SupplierEntity;

class Supplier extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager) {
        parent::__construct('supplier');

        $this->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new SupplierEntity());

        $this->add(array(
            'name' => 'supplierId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $person = new \Person\Form\Fieldset\Person($entityManager);
        $person->setName('person')
                ->setLabel('Dados Gerais');
        $this->add($person);
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'companyId',
        ));
    }
    
    public function getInputFilterSpecification() {
        return array(
            'supplierId' => array(
                'required' => false,
            ),
        );
    }
}
