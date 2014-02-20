<?php

namespace Purchase\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Purchase\Entity\Purchase as PurchaseEntity;

class Purchase extends Form {

    public function __construct($entityManager, $companyId) {

        parent::__construct('purchase_form');

        $classMethod = new \Zend\Stdlib\Hydrator\ClassMethods(false);
        
        $this->setAttribute('method', 'post')
                ->setHydrator(new DoctrineHydrator($entityManager, $classMethod))
                ->setObject(new PurchaseEntity())
                ->setInputFilter(new InputFilter());
        
        $purchase = new Fieldset\Purchase($entityManager, $companyId);
        $purchase->setUseAsBaseFieldset(true);
        $this->add($purchase);
        
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
                'onclick' => "javascript: window.location.href = '/admin/purchase/purchase'",
            )
        ));
    }
}
