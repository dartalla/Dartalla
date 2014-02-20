<?php

namespace Business\Form\Fieldset;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset as ZendFielset;
use Business\Entity\Sale as SaleEntity;

class Sale extends ZendFielset implements InputFilterProviderInterface {

    public function __construct($entityManager, $companyId) {
        parent::__construct('sale');
        
        $classMethod = new \Zend\Stdlib\Hydrator\ClassMethods(false);
        
        $this->setHydrator(new DoctrineHydrator($entityManager, $classMethod))
                ->setObject(new SaleEntity());

        $this->add(array(
            'name' => 'saleId',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $order = new Order($entityManager, $companyId);
        $this->add($order);
    }

    public function getInputFilterSpecification() {
        return array();
    }
}
