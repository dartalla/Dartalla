<?php

namespace Currency\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Currency\Entity\Currency as CurrencyEntity;

class Currency extends Form {

    public function __construct() {

        parent::__construct('currency_form');

        $this->setAttribute('method', 'post')
                ->setHydrator(new DoctrineHydrator($entityManager))
                ->setObject(new CurrencyEntity())
                ->setInputFilter(new InputFilter());
        
        $this->add(array(
            'type' => 'Currency\Form\Fieldset\Currency',
            'options' => array(
                'use_as_base_fieldset' => true,
            ),
        ));
        
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
                'onclick' => "javascript: window.location.href = '/admin/currency'",
            )
        ));
    }
}
