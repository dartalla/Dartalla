<?php

namespace Business\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Business\Entity\Sale as SaleEntity;

class Sale extends Form {

    public function __construct($entityManager, $companyId) {

        parent::__construct('sale_form');

        $classMethod = new \Zend\Stdlib\Hydrator\ClassMethods(false);
        
        $this->setAttribute('method', 'post')
                ->setHydrator(new DoctrineHydrator($entityManager, $classMethod))
                ->setObject(new SaleEntity())
                ->setInputFilter(new InputFilter());
        
        $sale = new Fieldset\Sale($entityManager, $companyId);
        $sale->setUseAsBaseFieldset(true);
        $this->add($sale);
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'security'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-primary'
            )
        ));

        $this->add(array(
            'name' => 'cancel',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Cancel',
                'class' => 'btn',
                'onclick' => "javascript: window.location.href = '/admin/business/sale'",
            )
        ));
    }
}
