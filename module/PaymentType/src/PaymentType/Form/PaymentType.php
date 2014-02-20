<?php

namespace PaymentType\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use PaymentType\Entity\PaymentType as PaymentTypeEntity;

class PaymentType extends Form {

    public function __construct($entityManager) {

        parent::__construct('payment_type_form');

        $this->setAttribute('method', 'post')
                ->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new PaymentTypeEntity())
                ->setInputFilter(new InputFilter());
        
        $paymetType = new Fieldset\PaymentType($entityManager);
        $paymetType->setUseAsBaseFieldset(true);
        $this->add($paymetType);
        
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
                'class' => 'btn btn-default',
                'onclick' => "javascript: window.location.href = '/admin/payment-type'",
            )
        ));
    }
}
